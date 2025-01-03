<?php include('./include/header.php'); ?>
<?php include './Data/db_connect.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penelitian</title>
    <style>
        body {
            display: grid;
        }


        /* Card Berita */
        .card-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
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

        .card-content .btn {
            margin-top: 10px;
            float: right;
            margin: 10px;
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

        /* General Styling for the Section */
        .penelitian-section {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 1rem auto;
        }

        .penelitian {
            border-bottom: 0.5px grey solid;
            border-top: 0.5px grey solid;
            padding: 1rem;
        }

        /* Styling for the Journal Title */
        .judul-jurnal {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        /* Styling for the Journal Description */
        .deskripsi-jurnal {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Styling for the Authors Title */
        .nama-penulis {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }

        /* Styling for the Authors List */
        .daftar-penulis {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .daftar-penulis li {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        /* Styling for the Download Button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-download:hover {
            background-color: #0056b3;
        }

        /* Mobile Phones (up to 480px) */

        /* Mobile Phones (up to 480px) */
        @media screen and (max-width: 480px) {
            .table-section {
                padding: 1rem 0.5rem;
            }

            .table-container {
                gap: 1rem;
            }

            /* Responsive Table Layout */
        }

        /* Tablets (481px - 768px) */
        @media screen and (max-width: 768px) {
            .table-section {
                padding: 1.5rem 1rem;
            }

            .table-container {
                gap: 1.25rem;
            }

            .table-main {
                font-size: 0.95rem;
            }

            th,
            td {
                padding: 0.9rem;
            }

            .card-grid {
                grid-template-columns: repeat(1, 1fr);
                /* 2 kolom untuk card */
            }

            .card a {
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

            .card-content {
                padding: 10px;
                /* Mengurangi padding untuk layar kecil */
            }

            .card-title {
                font-size: 16px;
                /* Ukuran font lebih kecil */
            }

            .card-description {
                font-size: 13px;
                /* Ukuran font deskripsi lebih kecil */
            }

        }

        /* Laptops and Smaller Desktops (769px - 1024px) */
        @media screen and (max-width: 1024px) {
            .table-section {
                padding: 2rem 1rem;
            }

            .table-container {
                gap: 1.5rem;
            }

            .table-main {
                font-size: 1rem;
            }

            th,
            td {
                padding: 1rem;
            }


        }
    </style>
</head>

<body>
    <section class="penelitian-section section-container">
        <h2 class="section-subheader">Penelitian</h2>

        <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/40340">
            <div class="penelitian">
                <h2>PENGARUH LATIHAN PLIOMETRIK TERHADAP HASIL LONG PASSING SEPAK BOLA</h2>
                <p>Ahmad Ridwan, Eka Supriatna, Fitriana Puspa Hidasari</p>
                <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/40340/75676585732  "
                    class="btn">Download</a>
            </div>
        </a>

        <a href="https://jurnal.untan.ac.id/index.php/JPJK/article/view/63050">
            <div class="penelitian">
                <h2>Kepercayaan Diri Dan Kondisi Fisik Mahasiswa Pendidikan Jasmani Dalam Perkuliahan Gulat</h2>
                <p>Andika Wahyudi</p>
                <a href="https://jurnal.untan.ac.id/index.php/JPJK/article/view/63050/75676597653"
                    class="btn">Download</a>
            </div>
        </a>

        <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/63588">
            <div class="penelitian">
                <h2>KONTRIBUSI PANJANG TUNGKAI DAN KECEPATAN LARI TERHADAP MENGGIRING PADA PERMAINAN SEPAK BOLA</h2>
                <p>Franciskus Efendi Situmorang, Ahmad Atiq, Mimi Haetami</p>
                <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/63588/75676596709"
                    class="btn">Download</a>
            </div>
        </a>

        <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/viewFile/53726/75676592651">
            <div class="penelitian">
                <h2>PEMBINAAN SEPAKBOLA KLUB
                    GAPURA FOOTBALL CLUB KABUPATEN SAMBAS</h2>
                <p></p>
                <a href="" class="btn">Download</a>
            </div>
        </a>

        <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/viewFile/53726/75676592651">
            <div class="penelitian">
                <h2>PLAYING HAND EYE COORDINATION ON PPLP ARREST PERFORMANCE WEST KALIMANTAN</h2>
                <p>Zakaria Zakaria, Edi Purnomo, Y Touvan Juni Samodra</p>
                <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/30488/75676579631" class="btn">Download</a>
            </div>
        </a>
        <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/49907">
            <div class="penelitian">
                <h2>PENGARUH PASSIVE STRETCHING TERHADAP KEMAMPUAN KAYANG SENAM LANTAI MAHASISWA PENDIDIKAN JASMANI UNTAN</h2>
                <p>Serin Serin, Mimi Haetami, Novi Yanti</p>
                <a href="https://jurnal.untan.ac.id/index.php/jpdpb/article/view/49907/75676590836" class="btn">Download</a>
            </div>
        </a>
    </section>




    <section class="berita-section section-container">
        <?php
        // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
        $sql = "SELECT id, foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 3";
        $result = $conn->query($sql);
        ?>
        <h3 class="section-subheader">Berita</h3>
        <h2 class="section-header">Pendidikan Jasmani</h2>
        <div class="card-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Jalur gambar, diasumsikan folder uploads berada di direktori root server
                    $imagePath = 'uploads/' . $row['foto'];
                    ?>
                    <!-- Card -->
                    <div class="card">
                        <a href="blog.php?id=<?= htmlspecialchars($row['id']) ?>">
                            <img src="<?= htmlspecialchars($imagePath); ?>" alt="Gambar Berita" class="card-image">
                            <div class="card-content">
                                <h2 class="card-title head-news"><?= htmlspecialchars($row['judul']); ?></h2>
                                <p class="section-description"><?= date('d M Y', strtotime($row['tanggal_upload'])); ?></p>
                                <p class="card-description highlight-news">
                                    <?= htmlspecialchars($row['highlight']); ?>
                                </p>
                                <button type="button" class="btn">Selengkapnya</button>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Tidak ada berita tersedia.</p>";
            }
            ?>
        </div>
    </section>
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>
    <script src="./js/swipeup.js"></script>

</body>

</html>

<?php include('./include/footer.php') ?>