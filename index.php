<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendidikan Jasmani Untan</title>
    <style>
        .section-container {
            max-width: var(--max-width);
            margin: auto;
            padding: 3rem 1rem;
        }

        .section-subheader {
            margin-bottom: 0.5rem;
            font-weight: 500;
            letter-spacing: 2px;
            color: var(--text-dark);
            position: relative;
        }

        .section-subheader::after {
            position: absolute;
            content: "";
            top: 50%;
            transform: translate(1rem, -50%);
            height: 2px;
            width: 4rem;
            background-color: var(--primary-color);
        }

        .section-header {
            max-width: 600px;
            margin-bottom: 1rem;
            font-size: 2.5rem;
            font-weight: 500;
            line-height: 3rem;
            color: var(--text-dark);
        }

        .section-description {
            max-width: 600px;
            margin-bottom: 0.5rem;
            color: var(--text-light);
        }

        .section-description-black {
            max-width: 600px;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .btn {
            padding: 0.5rem 1rem;
            background-color: var(--primary-color-dark);
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--primary-color);
        }

        .btn-black {
            padding: 0.75rem 1.5rem;
            outline: none;
            border: none;
            font-size: 1rem;
            font-weight: 500;
            color: var(--white);
            background-color: var(--text-dark);
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-color);
        }

        .btn-black:hover {
            background-color: var(--white);
            color: var(--text-dark);
        }


        /* REUSABLE CLASS END */
        /* Hero */
        .hero-section {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8)), url('./assets/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .hero-text {
            color: rgb(255, 255, 255);
            font-size: 1.4rem;
        }


        /* Vertical Card */
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
            height: 100%;
            object-fit: cover;
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
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .vertical-card-description {
            font-size: 14px;
            color: #333;
            margin-bottom: 1.5rem;
        }

        /* Fasilitas */
        .fasilitas-section {
            margin: 0 auto;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 2rem;
        }

        .facility-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .facility-item:hover {
            transform: translateY(-5px);
        }

        .facility-item span {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .facility-title {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
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

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            border-radius: 5px;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }



        /* Responsifitas */
        @media screen and (max-width: 1024px) {
            .vertical-card {
                grid-template-columns: 1fr;
            }

            .facility-grid {
                grid-template-columns: repeat(3, 1fr);
                /* 2 kolom */
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                /* Hanya 2 kolom */
            }
        }

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

            .facility-icon {
                width: 50px;
            }

            .facility-title {
                font-size: 0.9rem;
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

            .gallery-header {
                font-size: 1.8rem;
            }

            .gallery-subheader {
                font-size: 1rem;
            }

            .gallery-description {
                font-size: 0.9rem;
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

            .vertical-card {
                grid-template-columns: 1fr;
                padding: 0.5rem;
            }

            .vertical-card-image {
                height: 250px;
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

            .facility-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 1 kolom */
                gap: 10px;
            }

            .facility-item {
                padding: 0.8rem;
            }

            .facility-icon {
                width: 40px;
            }

            .facility-title {
                font-size: 0.85rem;
            }

            .card-grid {
                grid-template-columns: repeat(1, 1fr);
                /* 2 kolom untuk card */
            }

            .card {
                display: flex;
                align-items: center;
            }

            .card .btn {
                display: none;
            }

            .highlight-news {
                -webkit-line-clamp: 1;
                /* Tentukan jumlah baris yang ingin ditampilkan */
            }

            .card-image {
                max-width: 100px;
                max-height: 100px;
            }


            .gallery-header {
                font-size: 1.5rem;
            }

            .gallery-subheader {
                font-size: 0.9rem;
            }

            .gallery-description {
                font-size: 0.8rem;
            }

            .gallery-image {
                border-radius: 3px;
                /* Border radius lebih kecil */
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <!-- Hero  -->
    <section class="hero-section">
        <div class="hero-text">
            <h1 class="">Selamat Datang di laman Prodi Pendidikan Jasmani <br> FKIP Universitas Tanjungpura</h1>
        </div>
    </section>
    <!-- Hero End -->


    <!-- Aout Penjas -->
    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="./assets/about.png" alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <a href="profil-dosen.php">
                    <p class="section-subheader">Tentang</p>
                    <h2 class="vertical-card-header">Pendidikan Jasmani</h2>
                    <p class="vertical-card-description">
                        Program Studi Pendidikan Jasmani atau biasa disebut penjas bertujuan mencetak tenaga pendidik
                        dan
                        profesional di
                        bidang olahraga, kesehatan, dan rekreasi. Mahasiswa mempelajari teori dan praktik seperti
                        pendidikan
                        jasmani, teknik olahraga, serta manajemen kebugaran. Lulusannya
                        dapat berkarier sebagai guru, pelatih, atau pengelola program rekreasi, dengan fokus pada gaya
                        hidup
                        sehat dan pengembangan olahraga.
                    </p>
                    <button class="btn" role="button">Selengkapnya</button>
                </a>
            </div>
        </div>
    </section>
    <!-- About Penjas End-->

    <!-- Fasilitas -->
    <section class="fasilitas-section section-container">
        <h3 class="section-subheader">Fasilitas</h3>
        <h2 class="section-header">Prodi</h2>
        <div class="facility-grid">
            <div class="facility-item">
                <span><i class="fa-solid fa-mosque"></i></span>
                <h3 class="facility-title">Masjid</h3>
            </div>
            <div class="facility-item">
                <span><i class="fa-solid fa-wifi"></i></span>
                <h3 class="facility-title">Free Wifi</h3>
            </div>
            <div class="facility-item">
                <span><i class="fa-solid fa-book"></i></span>
                <h3 class="facility-title">Perpustakaan</h3>
            </div>
            <div class="facility-item">
                <span><i class="fa-solid fa-utensils"></i></span>
                <h3 class="facility-title">Kantin</h3>
            </div>
            <div class="facility-item">
                <span><i class="fa-solid fa-school"></i></span>
                <h3 class="facility-title">Auditorium</h3>
            </div>
            <div class="facility-item">
                <span><i class="fa-solid fa-dumbbell"></i></span>
                <h3 class="facility-title">Gym</h3>
            </div>
        </div>
    </section>
    <!-- Fasilitas End -->

    <!-- Berita Card Section -->
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
    <!-- Berita Card Section END -->


    <!-- Galeri Mahasiswa -->
    <section class="gallery-section section-container">
        <?php // Query untuk mengambil 9 foto terbaru berdasarkan tanggal_upload
        $sql = "SELECT foto FROM galeri ORDER BY tanggal_upload DESC LIMIT 9";
        $result = $conn->query($sql);
        ?>
        <h3 class="section-subheader">Galeri Mahasiswa</h3>
        <div class="gallery-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Jalur gambar, diasumsikan folder uploads berada di direktori root server
                    $imagePath = 'uploads/' . $row['foto'];
                    ?>
                    <img src="<?= htmlspecialchars($imagePath); ?>" class="gallery-image" alt="Gallery Image">
                    <?php
                }
            } else {
                echo "<p>Tidak ada foto di galeri.</p>";
            }
            ?>
        </div>
    </section>
    <!-- Galeri Mahasiswa END-->

    
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>   
    <script src="./js/swipeup.js"></script> 

</body>

</html>

<?php include './include/footer.php'; ?>