<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>
<?php
// Array untuk menyimpan ID berita yang sudah digunakan
$excludedIds = [];
?>
<?php
// Ambil data berita berdasarkan ID yang diberikan
$id = $_GET['id'] ?? 0; // Pastikan untuk memvalidasi dan membersihkan input ini
$sql = 'SELECT id, foto, judul, tanggal_upload, isi, highlight FROM berita WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Berita tidak ditemukan.');
}

$row = $result->fetch_assoc();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <style>
        .blog-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 16/9;
        }

        .date {
            color: gray;
            font-size: 0.9rem;
        }

        .blog-content h2 {
            font-size: 2rem;
            font-weight: 500;
            max-width: 800px;
        }

        .blog-content p {
            font-size: 1rem;
            line-height: 1.5;
            max-width: 800px;
        }

        .social {
            display: flex;
            gap: 1rem;
            font-size: 2rem;
            margin-top: 0.5rem;
            max-width: 50%;
        }

        .blog-headline-section {
            display: flex;
            /* Visi lebih lebar, headline lebih kecil */
            gap: 2rem;
            justify-content: space-between;
            overflow: hidden;
        }

        .blog-wrapper {
            background-color: #fff;
            border-radius: 8px;

        }

        .blog-content {}

        /* Headline Berita */

        .headline-wrapper {
            width: 40%;
            max-width: 300px;
            min-width: 250px;
        }

        .headline-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .headline-item {
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            padding: 1rem 0;
        }

        .headline-item:last-child {
            border-bottom: none;
        }

        .headline-item p {
            font-size: 0.9rem;
            color: #666;
        }



        /* Responsive Breakpoints */

        @media screen and (max-width: 480px) {}

        @media screen and (max-width: 768px) {
            .headline-wrapper {
                display: none;
            }
        }
    </style>
</head>

<body>

    <section class="blog-headline-section section-container">
        <div class="blog-wrapper">
            <div class="blog-content">
                <?php
                // Ambil ID dari parameter URL
                $id = (int) $_GET['id'] ?? 0;
                $excludedIds[] = $row['id']; // Simpan ID ke array
                
                // Query untuk mengambil berita berdasarkan ID
                $sqlBlog = "SELECT * FROM berita WHERE id = $id";
                $resultBlog = $conn->query($sqlBlog);

                if ($resultBlog->num_rows > 0) {
                    $rowBlog = $resultBlog->fetch_assoc();
                    // Tampilkan data berita
                    echo '<h2 class="">' . htmlspecialchars($rowBlog["judul"]) . '</h2>';
                    echo '<p class="date">' . htmlspecialchars(date('d M Y', strtotime($row['tanggal_upload']))) . '</p>';
                    echo '<img src="uploads/' . htmlspecialchars($rowBlog["foto"]) . '" alt="Gambar Berita" class="blog-image   ">';
                    echo '<p>' . htmlspecialchars($rowBlog["isi"]) . '</p>';

                    // Tambahkan konten berita lainnya sesuai kebutuhan
                } else {
                    echo '<p>Berita tidak ditemukan.</p>';
                }
                ?>
            </div>
        </div>
        <div class="headline-wrapper">
            <div class="headline-list">
                <h1 class="section-subheader">Headline Berita</h1>
                <?php
                // Query untuk mengambil berita dengan batasan pagination
                $sqlHeadline = "SELECT id, foto, judul, highlight, tanggal_upload
                    FROM berita
                    WHERE id NOT IN (" . implode(',', $excludedIds) . ")
                    ORDER BY view_count DESC LIMIT 5";
                $resultHeadline = $conn->query($sqlHeadline);


                if ($resultHeadline->num_rows > 0) {
                    while ($row = $resultHeadline->fetch_assoc()) {
                        $excludedIds[] = $row['id']; // Simpan ID ke array
                
                        // Tampilkan berita slider
                        echo '
                        <div class="headline-item">
                            <a href="?id=' . $row['id'] . '">
                                <h3 class="head-news">' . htmlspecialchars($row["judul"]) . '</h3>
                                <p class="meta-data">' . date('d M Y', strtotime($row["tanggal_upload"])) . '</p>
                            </a>
                        </div>
                    ';
                    }
                } else {
                    echo "<p>Tidak ada berita ditemukan.</p>";
                }
                ?>
                <div class="social">
                    <a href="https://www.instagram.com/penjas.untan_official?igsh=MXdweHg3MzdiNjB1Ng=="><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.instagram.com/penjas.untan_official?igsh=MXdweHg3MzdiNjB1Ng=="><i
                            class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.instagram.com/penjas.untan_official?igsh=MXdweHg3MzdiNjB1Ng=="><i
                            class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php include './include/footer.php' ?>