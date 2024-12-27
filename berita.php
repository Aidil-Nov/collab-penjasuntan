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
            border-radius: 8px;

            margin: auto;
            margin-top: 1rem;
            box-shadow: var(--shadow);
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
            height: auto;
            object-fit: cover;
            aspect-ratio: 16/9;
            border-bottom: 1px solid #ddd;
            object-position: center top;
            transition: 0.4s ease-in-out;
        }

        .slider-container .slider-card img:hover {}


        .slider-container .content {
            text-align: left;
            padding: 10px 1rem;
        }

        .slider-container h2 {
            margin: 0 0 8px;
            font-weight: 550;
            max-width: 900px;
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
            background-color: var(--primary-color-dark);
            color: #000;
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
            background-color: var(--primary-color);
        }

        /* BAGIAN CARD VERTIKAL */

        .vertical-card a {
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

        a .vertical-card-image-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 5px;
        }

        a .vertical-card-image {
            width: 100%;
            object-fit: cover;
            aspect-ratio: 16/9;
        }

        a .vertical-card-content {
            display: block;
        }

        a .vertical-card-subheader {
            font-size: 16px;
            color: #555;
            margin-bottom: 0.5rem;
        }

        a .vertical-card-header {
            font-size: 24px;
            margin-bottom: 1rem;
        }

        a .vertical-card-description {
            font-size: 14px;
            color: #333;
            margin-bottom: 1.5rem;
        }


        /* BAGIAN CARD DIBAWAH VERTIKAL */


        /* BERITA */
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

        .flag {
            position: absolute;
            background-color: var(--primary-color);
            top: 2%;
            left: 2%;
            z-index: 9;
            font-size: 1rem;
            border-radius: 5px;
            padding: 0px 10px;
        }

        /* BERITA END */

        /* Responsivitas slider*/

        @media screen and (max-width: 768px) {
            .vertical-card a{
                grid-template-columns: 1fr;
            }

            a .vertical-card-header {
                font-size: 20px;
            }

            a .vertical-card-description {
                font-size: 13px;
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

            .slider-container button {
                top: 40%;
            }

            .btn {
                display: none;
            }
        }

        @media screen and (max-width: 480px) {
            .vertical-card a {
                grid-template-columns: 1fr;
                padding: 0.5rem;
            }

            a .vertical-card-header {
                font-size: 18px;
            }

            a .vertical-card-description {
                font-size: 12px;
            }

            a .vertical-card-button {
                padding: 0.4rem 0.8rem;
                font-size: 14px;
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

            .highlight-news {
                -webkit-line-clamp: 1;
                /* Tentukan jumlah baris yang ingin ditampilkan */
            }

            .card-image {
                max-width: 100px;
                max-height: 100px;
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
    <!-- Slider Mengambil Berita Terbaru Di Upload-->
    <div class="slider-container">
        <h3 class="section-header flag">Berita Populer</h3>
        <div class="slider">
            <?php
            if ($resultSlider->num_rows > 0) {
                while ($rowSlider = $resultSlider->fetch_assoc()) {
                    $excludedIds[] = $rowSlider['id']; // Simpan ID ke array
            
                    // Tampilkan berita slider
                    echo '
                    <div class="slider-card">
                        <a href="blog.php?id=' . htmlspecialchars($rowSlider["id"]) . '">
                            <img src="uploads/' . htmlspecialchars($rowSlider["foto"]) . '" alt="News Image">
                            <div class="content">
                                <h2 class="section-header head-news">' . htmlspecialchars($rowSlider["judul"]) . '</h2>
                                <p class="meta-data">' . date('d M Y', strtotime($rowSlider["tanggal_upload"])) . '</p>
                                <p class="highlight highlight-news">' . htmlspecialchars($rowSlider["highlight"]) . '</p>
                            </div>
                        </a>
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

    <!-- Slider End -->

    <!-- About -->
    <section class="about-section section-container">
        <h3 class="section-subheader">Berita Populer</h3>
        <?php
        $sqlAbout = "SELECT id, foto, judul, tanggal_upload, highlight FROM berita ORDER BY view_count DESC LIMIT 1";
        $resultAbout = $conn->query($sqlAbout);
        if ($resultAbout->num_rows > 0) {
            while ($rowAbout = $resultAbout->fetch_assoc()) {
                echo '
                <div class="vertical-card">
                    <a href="blog.php?id=' . htmlspecialchars($rowAbout["id"]) . '">
                        <div class="vertical-card-image-container">
                            <img src="uploads/' . htmlspecialchars($rowAbout["foto"]) . '" alt="Gambar Berita" class="vertical-card-image">
                        </div>
                        <div class="vertical-card-content">
                            <h2 class="vertical-card-header head-news">' . htmlspecialchars($rowAbout["judul"]) . '</h2>
                            <p class="meta-data section-description">' . date('d M Y', strtotime($rowAbout["tanggal_upload"])) . '</p>
                            <p class="vertical-card-description highlight-news">' . htmlspecialchars($rowAbout["highlight"]) . '</p>
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

    </section>
    <!-- About End -->

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
            
                    // Tampilkan berita dengan tautan ke blog.php
                    echo '
                    <div class="card">
                        <a href="blog.php?id=' . htmlspecialchars($rowCard["id"]) . '">
                            <img src="uploads/' . htmlspecialchars($rowCard["foto"]) . '" alt="Gambar Berita" class="card-image">
                            <div class="card-content">
                                <h2 class="card-title head-news">' . htmlspecialchars($rowCard["judul"]) . '</h2>
                                <p class="meta-data section-description">' . date('d M Y', strtotime($rowCard["tanggal_upload"])) . '</p>
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
                    echo '<a href="?page=' . ($page - 1) . '" class="pagination-arrow">&raquo;</a>';
                }
            }
            ?>
        </div>
        <!-- Pagination END -->
    </section>
    <!-- Berita Card Section END-->


    <script>
        let currentSlide = 0;
        let autoSlideInterval;
        let isSliding = false; // Flag untuk mencegah animasi berulang

        function moveSlide(direction) {
            if (isSliding) return; // Cegah aksi jika animasi masih berjalan

            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slider-card');
            const totalSlides = slides.length;

            isSliding = true; // Set flag
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Atur jeda sebelum tombol bisa ditekan lagi
            setTimeout(() => {
                isSliding = false; // Reset flag setelah animasi selesai
            }, 500); // Sesuaikan dengan durasi animasi CSS
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

        // Event listener untuk tombol navigasi
        document.querySelector('.prev-button').addEventListener('click', () => moveSlide(-1));
        document.querySelector('.next-button').addEventListener('click', () => moveSlide(1));


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
</body>

</html>

<?php include './include/footer.php' ?>