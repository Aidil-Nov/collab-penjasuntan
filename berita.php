<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>

<?php
// Array untuk menyimpan ID berita yang sudah digunakan
$excludedIds = [];

// Query untuk mengambil berita slider
$sqlSlider = "SELECT id, foto, judul, tanggal_upload, highlight FROM berita ORDER BY tanggal_upload DESC LIMIT 3";
$resultSlider = $conn->query($sqlSlider);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <style>
        /* Slider */
        .slider-card h2:hover,
        .about-section h2:hover,
        .card h2:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .btn {
            margin-top: 10px;
        }

        .slider-container {
            position: relative;
            width: 90%;
            max-width: 1200px;
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            margin: auto;
            margin-top: 1rem;
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
            font-weight: 550;
            max-width: 800px;
            font-size: 2rem;
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
            transition: 0.4s ease-in-out;
        }

        .card:hover {
            transform: scale(1.04);
        }

        .card-image {
            width: 100%;
            height: 200px;
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
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 14px;
            color: #555;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination-item,
        .pagination-arrow {
            margin: 0;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .pagination-item:hover,
        .pagination-arrow:hover {
            background-color: var(--primary-color-dark);
            color: #fff;
            box-shadow: var(--shadow);
            cursor: pointer;
        }

        .pagination-item.active {
            background-color: var(--primary-color);
            color: #fff;
            box-shadow: var(--shadow);
            pointer-events: none;
        }

        .pagination-arrow {
            font-size: 1.2rem;
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
            <?php
            if ($resultSlider->num_rows > 0) {
                while ($rowSlider = $resultSlider->fetch_assoc()) {
                    $excludedIds[] = $rowSlider['id']; // Simpan ID ke array
            
                    // Tampilkan berita slider
                    echo '
                        <div class="slider-card">
                            <img src="uploads/' . htmlspecialchars($rowSlider["foto"]) . '" alt="News Image">
                            <div class="content">
                                <h2 class="section-header head-news">' . htmlspecialchars($rowSlider["judul"]) . '</h2>
                                <p class="date">' . htmlspecialchars($rowSlider["tanggal_upload"]) . '</p>
                                <p class="highlight highlight-news">' . htmlspecialchars($rowSlider["highlight"]) . '</p>
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
        let autoSlideInterval;

        function moveSlide(direction) {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slider-card');
            const totalSlides = slides.length;

            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                moveSlide(1);
            }, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Memulai slider otomatis
        startAutoSlide();

        // Menambahkan event listener untuk hover
        const sliderContainer = document.querySelector('.slider-container');

        sliderContainer.addEventListener('mouseenter', stopAutoSlide);
        sliderContainer.addEventListener('mouseleave', startAutoSlide);
    </script>
    <!-- Slider End -->

    <!-- About -->
    <section class="about-section section-container">
        <h3 class="section-subheader">Berita Terbaru</h3>
        <?php // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
        // About Section Ambil 1 berita terbaru yang tidak termasuk di slider
        $sqlAbout = "SELECT id, foto, judul, tanggal_upload, highlight FROM berita ORDER BY tanggal_upload DESC LIMIT 1";
        $resultAbout = $conn->query($sqlAbout);
        if ($resultAbout->num_rows > 0) {
            while ($rowAbout = $resultAbout->fetch_assoc()) {
                $excludedIds[] = $rowAbout['id']; // Tambahkan ID ke array
        
                // Tampilkan berita about
                echo '
                    <div class="vertical-card">
                        <div class="vertical-card-image-container">
                            <img src="uploads/' . htmlspecialchars($rowAbout["foto"]) . '" alt="Gambar Berita" class="vertical-card-image">
                        </div>
                        <div class="vertical-card-content">
                            <h2 class="vertical-card-header head-news">' . htmlspecialchars($rowAbout["judul"]) . '</h2>
                            <p class="meta-data section-description">' . date('d M Y', strtotime($rowAbout["tanggal_upload"])) . '</p>
                            <p class="vertical-card-description highlight-news">' . htmlspecialchars($rowAbout["highlight"]) . '</p>
                            <button type="button" class="btn">Selengkapnya</button>
                        </div>
                    </div>
                ';
            }
        } else {
            echo "<p>Tidak ada berita tersedia.</p>";
        }
        ?>

    </section>
    <!-- About End -->

    <section>
        <?php
        $limit = 6;

        // Ambil halaman saat ini dari parameter URL (default ke 1)
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $page = max(1, $page); // Pastikan minimal halaman adalah 1
        
        // Hitung offset untuk query SQL
        $offset = ($page - 1) * $limit;

        // Query untuk mengambil berita dengan batasan pagination
        $sqlCard = "SELECT id, foto, judul, highlight, tanggal_upload
        FROM berita
        WHERE id NOT IN (" . implode(',', $excludedIds) . ")
        ORDER BY tanggal_upload DESC
        LIMIT $limit OFFSET $offset";
        $resultCard = $conn->query($sqlCard);

        // Hitung total berita
        $totalSql = "SELECT COUNT(*) AS total FROM berita WHERE id NOT IN (" . implode(',', $excludedIds) . ")";
        $totalResult = $conn->query($totalSql);
        $totalRow = $totalResult->fetch_assoc();
        $totalBerita = $totalRow['total'];

        // Hitung jumlah halaman
        $totalPages = ceil($totalBerita / $limit);
        ?>

        <!-- Berita Card Section -->
        <section class="berita-section section-container">
            <h3 class="section-subheader">Berita</h3>
            <h2 class="section-header">Pendidikan Jasmani</h2>
            <div class="card-grid">
                <?php
                if ($resultCard->num_rows > 0) {
                    while ($rowCard = $resultCard->fetch_assoc()) {
                        $excludedIds[] = $rowCard['id']; // Tambahkan ID ke array
                
                        // Tampilkan berita
                        echo '
                    <div class="card">
                        <img src="uploads/' . htmlspecialchars($rowCard["foto"]) . '" alt="Gambar Berita" class="card-image">
                        <div class="card-content">
                            <h2 class="card-title head-news">' . htmlspecialchars($rowCard["judul"]) . '</h2>
                            <p class="meta-data section-description">' . date('d M Y', strtotime($rowCard["tanggal_upload"])) . '</p>
                            <p class="card-description highlight-news">' . htmlspecialchars($rowCard["highlight"]) . '</p>
                            <button type="button" class="btn">Selengkapnya</button>
                        </div>
                    </div>
                ';
                    }
                } else {
                    echo "<p>Tidak ada berita tersedia.</p>";
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                if ($totalPages > 1) {
                    // Tombol panah kiri
                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '" class="pagination-arrow">&laquo;</a>';
                    } else {
                        echo '<a href="?page=' . ($page + 1) . '" class="pagination-arrow">&laquo;</a>';
                    }

                    // Tampilkan halaman
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo '<span class="pagination-item active">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '" class="pagination-item">' . $i . '</a>';
                        }
                    }

                    // Tombol panah kanan
                    if ($page < $totalPages) {
                        echo '<a href="?page=' . ($page + 1) . '" class="pagination-arrow">&raquo;</a>';
                    } else {
                        echo '<a href="?page=' . ($page - 1) . '" class="pagination-arrow">&laquo;</a>';
                    }
                }
                ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const paginationLinks = document.querySelectorAll('.pagination a');

                    paginationLinks.forEach(link => {
                        link.addEventListener('click', event => {
                            event.preventDefault(); // Mencegah refresh halaman

                            const url = event.target.href;

                            // Fetch data dari URL pagination
                            fetch(url)
                                .then(response => response.text())
                                .then(data => {
                                    const parser = new DOMParser();
                                    const htmlDoc = parser.parseFromString(data, 'text/html');
                                    const newCards = htmlDoc.querySelector('.card-grid').innerHTML;
                                    const newPagination = htmlDoc.querySelector('.pagination').innerHTML;

                                    // Update konten card-grid dan pagination
                                    document.querySelector('.card-grid').innerHTML = newCards;
                                    document.querySelector('.pagination').innerHTML = newPagination;

                                    // Tambahkan kembali event listener ke link baru
                                    document.querySelectorAll('.pagination a').forEach(newLink => {
                                        newLink.addEventListener('click', event => {
                                            event.preventDefault();
                                            const newUrl = event.target.href;
                                            fetch(newUrl)
                                                .then(response => response.text())
                                                .then(newData => {
                                                    const newDoc = parser.parseFromString(newData, 'text/html');
                                                    const updatedCards = newDoc.querySelector('.card-grid').innerHTML;
                                                    const updatedPagination = newDoc.querySelector('.pagination').innerHTML;
                                                    document.querySelector('.card-grid').innerHTML = updatedCards;
                                                    document.querySelector('.pagination').innerHTML = updatedPagination;
                                                });
                                        });
                                    });
                                });
                        });
                    });
                });
            </script>

        </section>
</body>

</html>

<?php include './include/footer.php' ?>