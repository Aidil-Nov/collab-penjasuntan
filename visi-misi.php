<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>
<?php
// Array untuk menyimpan ID berita yang sudah digunakan
$excludedIds = [];

// Query untuk mengambil berita slider
$sql = "SELECT id, foto, judul, tanggal_upload, highlight FROM berita ORDER BY view_count DESC LIMIT 3";
$result = $conn->query($sql);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi Misi</title>
    <style>
       /* Visi dan Misi */
       .section-container {
            margin-top: 0;
            padding-top: 1rem ;
        }
        
        .visi-headline-section {
            display: flex;
            gap: 2rem;
        }

        /* Visi misi */

        .visi-misi-wrapper {
            background-color: #fff;
            border-radius: 8px;
            width: 70%;
        }

        .vision-mission-content {
            text-align: justify;
            line-height: 1.8;
        }


        /* Headline Berita */

        .headline-wrapper {
            background-color: #fff; 
            border-radius: 8px;
            width: 30%;
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
            margin: 0.3rem 0 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Visi dan Misi End*/


        /* Berita Card */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.4s ease-in-out;
        }

        .card:hover {
            transform: scale(1.04);
        }

        .card-image {
            width: 100%;
            max-width: 700px;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            transform: scale(1);
            transition: ease-in;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 10px;
        }

        .card-description {
            font-size: 14px;
            color: #555;
        }

        .card .btn {
            margin-top: 1rem;
        }

        /* Berita Card End */

        /* Responsive Adjustments */

        /* Mobile Phones (up to 480px) */
        @media screen and (max-width: 480px) {
            .visi-headline-section {
                gap: 1rem;
            }

            .visi-misi-wrapper {
                padding: 1rem;
                margin-bottom: 1rem;
                width: 100%;
            }
            .headline-wrapper{
                display: none;
            }

            .vision-mission-content {
                text-align: left;
                /* Adjust text alignment for smaller screens */
                line-height: 1.6;
            }

            .headline-item {
                padding: 0.5rem 0;
            }

            .headline-item h3 {
                font-size: 0.9rem;
            }

            .headline-item p {
                font-size: 0.8rem;
            }
        }

        /* Tablets (up to 768px) */
        @media screen and (max-width: 768px) {
            .visi-headline-section {
                /* Two-column layout */
                gap: 1.5rem;
            }

            .visi-misi-wrapper,
            .headline-wrapper {
                padding: 1.5rem;
            }

            .vision-mission-content {
                line-height: 1.7;
            }

            .headline-item {
                padding: 0.75rem 0;
            }
            .card-grid {
            grid-template-columns: repeat(2, 1fr);
            /* 2 kolom untuk card */
        }

        .card {
            display: flex;
            align-items: center;
        }

        .card .btn {
            display: none;
        }


        .card-image {
            max-width: 150px;
            max-height: 150px;
            height: 250px;
        }
        }

        /* Laptops and Smaller Desktops (up to 1024px) */
        @media screen and (max-width: 1024px) {
            .visi-headline-section {
                gap: 1.5rem;
            }

            .visi-misi-wrapper,
            .headline-wrapper {
                padding: 1.5rem;
            }

            .vision-mission-content {
                line-height: 1.7;
            }

            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }  
    </style>
</head>

<body>
    <!-- Visi misi dan Headline -->
    <section class="visi-headline-section section-container">
        <!-- Visi Misi -->
        <div class="visi-misi-wrapper">
            <div class="vision-mission-content">
                <h3 class="section-subheader">Visi</h3>
                <p>Unggul dan Bersaing Dalam Peradaban Melalui Pendidikan Jasmani Dengan Keragaman Budaya Lokal</p>
                <br>
                <h3 class="section-subheader">Misi</h3>
                <p>Menyelenggarakan kegiatan pendidikan berdasarkan Kerangka Kualifikasi Nasional Indonesia agar
                    menghasilkan tenaga pendidik dalam berbagai jenjang dan jenis pendidikan serta tenaga kependidikan
                    yang mampu berpikir global dan berbudaya lokal.
                    Melaksanakan penelitian dalam kajian Pendidikan Jasmani. Memberdayakan seluruh potensi yang dimiliki
                    secara optimal, serta mendorong sivitas akademika untuk mengimplementasikan hasil penelitian dan
                    gagasan sebagai bentuk responsif
                    terhadap permasalahan yang ada di masyarakat.</p>
            </div>
        </div>

        <!-- Headline -->
        <div class="headline-wrapper">
            <div class="headline-list">
                <h2 class="section-header">Headline Berita</h2>
                <div class="headline-item">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $excludedIds[] = $row['id']; // Simpan ID ke array
                    
                            // Tampilkan berita slider
                            echo '
                        <div class="headline-item">
                            <a href="">
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

                </div>
            </div>
    </section>
    <!-- Visi misi dan Headline END-->

    <!-- Berita Card -->
    <section class="berita-section section-container">
        <?php
        $limit = 3;
        // Query untuk mengambil berita dengan batasan pagination
        $sqlCard = "SELECT id, foto, judul, highlight, tanggal_upload
        FROM berita
        WHERE id NOT IN (" . implode(',', $excludedIds) . ")
        ORDER BY view_count DESC
        LIMIT $limit ";
        $resultCard = $conn->query($sqlCard);
        ?>
        <h3 class="section-subheader"><a href="./berita.php">Berita</a></h3>
        <div class="card-grid">
            <?php
            if ($resultCard->num_rows > 0) {
                while ($rowCard = $resultCard->fetch_assoc()) {
                    $excludedIds[] = $rowCard['id']; // Tambahkan ID ke array
            
                    // Tampilkan berita
                    echo '
                    <div class="card">
                        <a href="blog.php?id=' . htmlspecialchars($rowCard["id"]) . '">
                            <img src="uploads/' . htmlspecialchars($rowCard["foto"]) . '" alt="Gambar Berita" class="card-image">
                            <div class="card-content">
                                <h2 class="card-title head-news">' . htmlspecialchars($rowCard["judul"]) . '</h2>
                                <p class="meta-data section-description">' . date('d M Y', timestamp: strtotime($rowCard["tanggal_upload"])) . '</p>
                                <p class="card-description highlight-news">' . htmlspecialchars($rowCard["highlight"]) . '</p>
                                <button type="button" class="btn">Selengkapnya</button>
                            </div>
                        </a>
                    </div>
                ';
                }
            } else {
                echo "<p>Tidak ada berita tersedia.</p>";
            }
            ?>
        </div>
    </section>
    <!-- Berita Card END-->

</body>

</html>
<?php include './include/footer.php' ?>