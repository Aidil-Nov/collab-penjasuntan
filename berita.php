<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <style>
        /* Slider */
        .slider-container {
            position: relative;
            width: 90%;
            max-width: 1200px;
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            margin: auto;
        }

        .slider-container .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-container .slider-card {
            min-width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .slider-container .slider-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            aspect-ratio: 16/9;
            border-bottom: 1px solid #ddd;
        }

        .slider-container .content {
            text-align: left;
            padding: 10px 1rem;
        }

        .slider-container h2 {
            margin: 0 0 8px;
            font-size: 24px;
            color: #333;
        }

        .slider-container .date {
            margin: 0 0 12px;
            font-size: 14px;
            color: #666;
        }

        .slider-container .highlight {
            font-size: 16px;
            color: #444;
        }

        .slider-container button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 12px;
            cursor: pointer;
            z-index: 10;
        }

        .slider-container button.prev {
            left: 10px;
        }

        .slider-container button.next {
            right: 10px;
        }

        .slider-container button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Slider End*/

        /* Responsive Media Queries */
        /* @media screen and (max-width: 480px) {
            .slide-content {
                padding: 10px;
            }
            .slide-content h2 {
                font-size: 16px;
            }
            .slide-content p {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 768px) {
            .slide-content {
                padding: 12px;
            }
        }

        @media screen and (max-width: 1024px) {
            .slide-content {
                padding: 14px;
            }
        }
     */
        /* BAGIAN CARD VERTIKAL */

        .vertical-card {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            align-items: center;
            overflow: hidden;
            padding: 1rem;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: var(--shadow);
        }

        .vertical-card-image-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 5px;
        }

        .vertical-card-image {
            width: 100%;
            object-fit: cover;
            aspect-ratio: 16/9;
        }

        .vertical-card-content {
            display: block;
        }

        .vertical-card-subheader {
            font-size: 16px;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .vertical-card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .vertical-card-description {
            font-size: 14px;
            color: #333;
            margin-bottom: 1.5rem;
        }


        /* BAGIAN CARD DIBAWAH VERTIKAL */


        /* BERITA */

        .berita-section {
            margin: 0 auto;
            padding: 20px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 14px;
            color: #555;
        }

        /* BERITA END */

        /* Responsivitas slider*/

        @media screen and (max-width: 768px) {
            .vertical-card {
                grid-template-columns: 1fr;
            }

            .vertical-card-header {
                font-size: 20px;
            }

            .vertical-card-description {
                font-size: 13px;
            }

            .card-grid {
                grid-template-columns: 1fr;
                /* Menampilkan satu kolom penuh */
            }

            .card-image {
                height: 220px;
                /* Menyesuaikan tinggi gambar */
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

            .card-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 2 kolom untuk card */
            }
        }

        @media screen and (max-width: 480px) {
            .vertical-card {
                grid-template-columns: 1fr;
                padding: 0.5rem;
            }

            .vertical-card-header {
                font-size: 18px;
            }

            .vertical-card-description {
                font-size: 12px;
            }

            .vertical-card-button {
                padding: 0.4rem 0.8rem;
                font-size: 14px;
            }

            .card-grid {
                grid-template-columns: 1fr;
                /* Tetap satu kolom */
            }

            .card {
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                /* Mengurangi bayangan */
            }

            .card-image {
                height: 180px;
                /* Gambar lebih kecil untuk layar sempit */
            }

            .card-title {
                font-size: 15px;
                /* Ukuran font lebih kecil */
            }

            .card-description {
                font-size: 12px;
                /* Ukuran font deskripsi lebih kecil */
            }

            .card-grid {
                grid-template-columns: 1fr;
                /* 1 kolom untuk card */
            }

            .news-title {
                font-size: 14px;
            }

            .news-date {
                font-size: 12px;
            }

            .card-title {
                font-size: 16px;
            }

            .card-description {
                font-size: 12px;
            }

            .slider-container {
                margin-top: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Slider -->
    <div class="slider-container">
        <div class="slider">
            <!-- Slider items akan di-load dari database menggunakan PHP -->
            <?php
            // Koneksi ke database
            $conn = new mysqli('localhost', 'root', '', 'KampusDB');

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil berita terbaru
            $sql = "SELECT foto, judul, tanggal_upload, highlight FROM berita ORDER BY tanggal_upload DESC LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="slider-card">
                            <img src="uploads/' . $row["foto"] . '" alt="News Image">
                            <div class="content">
                                <h2 class="head-highlight-news">' . htmlspecialchars($row["judul"]) . '</h2>
                                <p class="date highlight-news">' . htmlspecialchars($row["tanggal_upload"]) . '</p>
                                <p class="highlight">' . htmlspecialchars($row["highlight"]) . '</p>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "<p>Tidak ada berita ditemukan.</p>";
            }
            ?>
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
    <script>
        let currentSlide = 0;

        function moveSlide(direction) {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slider-card');
            const totalSlides = slides.length;

            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        // Slider otomatis bergeser setiap 5 detik
        setInterval(() => {
            moveSlide(1);
        }, 5000);
    </script>
    <!-- Slider End -->

    <!-- About -->
    <section class="about-section section-container">
        <?php // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
        $sql = "SELECT foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 1";
        $result = $conn->query($sql);
        ?>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Jalur gambar, diasumsikan folder uploads berada di direktori root server
                $imagePath = 'uploads/' . $row['foto'];
                ?>
                <!-- Card -->
                <div class="vertical-card">
                    <div class="vertical-card-image-container">
                        <img src="<?= htmlspecialchars($imagePath); ?>" alt="Gambar Berita" class="vertical-card-image">
                    </div>
                    <div class="vertical-card-content">
                        <h2 class="vertical-card-header head-news"><?= htmlspecialchars($row['judul']); ?></h2>
                        <p class="meta-data section-description"><?= date('d M Y', strtotime($row['tanggal_upload'])); ?></p>
                        <p class="vertical-card-description highlight-news" maxlength="10">
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
    <!-- About End -->

    <section class="berita-section section-container">
        <h3 class="section-subheader">Berita</h3>
        <h2 class="section-header">Pendidikan Jasmani</h2>
        <div class="card-grid">
            <?php // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
            $sql = "SELECT foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 10";
            $result = $conn->query($sql);
            ?>
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
                            <p class="meta-data section-description"><?= date('d M Y', strtotime($row['tanggal_upload'])); ?>
                            </p>
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