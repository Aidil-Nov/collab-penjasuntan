<?php include './include/header.php';?>
<?php include './Data/db_connect.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi dan Misi</title>
    <style>
        /* Visi dan Misi */
        .visi-headline-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            /* Visi lebih lebar, headline lebih kecil */
            gap: 2rem;
        }
        

        
        .visi-misi-wrapper {
            background-color: #fff;
            box-shadow: var(--shadow);
            padding: 2rem;
            border-radius: 8px;
        }
        
        .vision-mission-content {
            text-align: justify;
            line-height: 1.8;
        }
        
        
        /* Headline Berita */
        
        .headline-wrapper {
            background-color: #fff;
            box-shadow: var(--shadow);
            padding: 2rem;
            border-radius: 8px;
        }
        
        .headline-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .headline-item {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
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
            height: 300px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
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
                grid-template-columns: 1fr; /* Stack columns vertically */
                gap: 1rem;
            }

            .visi-misi-wrapper,
            .headline-wrapper {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .vision-mission-content {
                text-align: left; /* Adjust text alignment for smaller screens */
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
        @media screen and (min-width: 481px) and (max-width: 768px) {
            .visi-headline-section {
                grid-template-columns: 1fr 1fr; /* Two-column layout */
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
        }

        /* Laptops and Smaller Desktops (up to 1024px) */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .visi-headline-section {
                grid-template-columns: 2fr 1fr;
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
        @media screen and (max-width: 1024px) {
            .section-container {
                padding: 1rem;
            }

            .card-image {
                height: 250px;
            }

            .card-title {
                font-size: 16px;
            }

            .card-description {
                font-size: 13px;
            }
        }

    </style>
</head>
<body>
    <section class="visi-headline-section section-container">  
            <div class="visi-misi-wrapper">
                <div class="vision-mission-content">
                    <h3 class="section-subheader">Visi</h3>
                    <p>Unggul dan Bersaing Dalam Peradaban Melalui Pendidikan Jasmani Dengan Keragaman Budaya Lokal</p>
                    <br>
                    <h3 class="section-subheader">Misi</h3>
                    <p>Menyelenggarakan kegiatan pendidikan berdasarkan Kerangka Kualifikasi Nasional Indonesia agar menghasilkan tenaga pendidik dalam berbagai jenjang dan jenis pendidikan serta tenaga kependidikan yang mampu berpikir global dan berbudaya lokal.
                        Melaksanakan penelitian dalam kajian Pendidikan Jasmani. Memberdayakan seluruh potensi yang dimiliki secara optimal, serta mendorong sivitas akademika untuk mengimplementasikan hasil penelitian dan gagasan sebagai bentuk responsif
                        terhadap permasalahan yang ada di masyarakat.</p>
                </div>
            </div>
            <div class="headline-wrapper">
                <div class="headline-list">
                    <h2 class="section-header">Headline Berita</h2>
                    <div class="headline-item">
                        <a href="">
                            <h3>Judul Berita 1</h3>
                            <p>20 November 2024</p>
                        </a>
                    </div>
                    <div class="headline-item">
                        <a href="">
                            <h3>Judul Berita 1</h3>
                            <p>20 November 2024</p>
                        </a>
                    </div>
                    <div class="headline-item">
                        <a href="">
                            <h3>Judul Berita 1</h3>
                            <p>20 November 2024</p>
                        </a>
                    </div>
                </div>
            </div>
    </section>

    <?php // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
    $sql = "SELECT foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 9";
    $result = $conn->query($sql);
    ?>
    <section class="berita-section section-container">
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
                        <img src="<?= htmlspecialchars($imagePath); ?>" alt="Gambar Berita" class="card-image">
                        <div class="card-content">
                            <h2 class="card-title head-news"><?= htmlspecialchars($row['judul']); ?></h2>
                            <p class="meta-data section-description"><?= date('d M Y', strtotime($row['tanggal_upload'])); ?></p>
                            <p class="card-description highlight-news" maxlength="10">
                                <?= htmlspecialchars($row['highlight']); ?>
                            </p>
                            <button type="button" class="btn">Selengkapnya</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Tidak ada berita tersedia.</p>";
            }
            ?>
        </div>
    </section>

    

</body>
</html>


    

<?php include './include/footer.php' ?>