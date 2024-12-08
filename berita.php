<?php include('./include/header.php'); ?>
<?php include './Data/db_connect.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

.carousel-container {
    width: 1200px;
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background: #fff;
}

.carousel {
    display: flex;
    transition: transform 0.5s ease;
}

.carousel-item {
    min-width: 100%;
}

.carousel-item img {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
}

.carousel-content {
    padding: 20px;
    text-align: left;
}

.carousel-content h3 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
}

.carousel-content .date {
    font-size: 14px;
    color: #888;
    margin-bottom: 10px;
}

.carousel-content .description {
    font-size: 16px;
    color: #555;
}

.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 10;
}

.carousel-btn.left {
    left: 10px;
}

.carousel-btn.right {
    right: 10px;
}

.carousel-btn:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

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
    <section class="news-carousel section-container">
        <div class="news-carousel__container">
            <div class="news-carousel__wrapper">
                <!-- News cards akan dirender oleh JavaScript -->
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn carousel-btn-prev"> &#10094;</button>
                <button class="carousel-btn carousel-btn-next"> &#10095;</button>
            </div>
        </div>
    </section>

    <!-- Carousel Berhasil -->
    <div class="carousel-container">
        <div class="carousel">
            <div class="carousel-item">
                <img src="image1.jpg" alt="Image 1">
                <div class="carousel-content">
                    <h3>Teknologi AI Membantu Dunia Kesehatan</h3>
                    <p class="date">04 November 2024</p>
                    <p class="description">
                        AI digunakan untuk mendiagnosis penyakit lebih cepat dan akurat di rumah sakit besar.
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image2.jpg" alt="Image 2">
                <div class="carousel-content">
                    <h3>Judul Artikel 2</h3>
                    <p class="date">05 November 2024</p>
                    <p class="description">
                        Deskripsi singkat untuk artikel kedua.
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image3.jpg" alt="Image 3">
                <div class="carousel-content">
                    <h3>Judul Artikel 3</h3>
                    <p class="date">06 November 2024</p>
                    <p class="description">
                        Deskripsi singkat untuk artikel ketiga.
                    </p>
                </div>
            </div>
        </div>
        <button class="carousel-btn left">&lt;</button>
        <button class="carousel-btn right">&gt;</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>


    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="./assets/about.png" alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="vertical-card-subheader">Tentang</p>
                <h2 class="vertical-card-header">Pendidikan Jasmani</h2>
                <p class="vertical-card-description">
                    Program Studi Pendidikan Jasmani (Penjas) bertujuan mencetak tenaga pendidik dan profesional di
                    bidang olahraga, kesehatan, dan rekreasi. Mahasiswa mempelajari teori dan praktik seperti pendidikan
                    jasmani, teknik olahraga, serta manajemen kebugaran. Lulusannya
                    dapat berkarier sebagai guru, pelatih, atau pengelola program rekreasi, dengan fokus pada gaya hidup
                    sehat dan pengembangan olahraga.
                </p>
                <button class="btn" role="button"><a href="/public/uploads/profil-dosen.html">Selengkapnya</a></button>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function () {
    const $carousel = $('.carousel');
    const $items = $('.carousel-item');
    const itemCount = $items.length;
    let currentIndex = 0;
    let autoSlide;

    function showSlide(index) {
        const offset = -index * 100; // Offset sesuai lebar item
        $carousel.css('transform', `translateX(${offset}%)`);
        currentIndex = index;
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % itemCount;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentIndex - 1 + itemCount) % itemCount;
        showSlide(prevIndex);
    }

    function startAutoSlide() {
        autoSlide = setInterval(nextSlide, 3000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlide);
    }

    $('.carousel-btn.right').click(function () {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
    });

    $('.carousel-btn.left').click(function () {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
    });

    $carousel.hover(stopAutoSlide, startAutoSlide);

    // Initialize carousel
    startAutoSlide();
    });
</script>

    <section class="berita-section section-container">
        <!-- Left Section (Card Grid) -->
        <div class="card-grid">
            <!-- Card 1 -->
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="" class="card-image">
                <div class="card-content">
                    <h2 class="card-title">Judul Berita 1</h2>
                    <p class="card-description">
                        Deskripsi singkat berita pertama untuk memberikan informasi kepada pembaca.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="" class="card-image">
                <div class="card-content">
                    <h2 class="card-title">Judul Berita 2</h2>
                    <p class="card-description">
                        Deskripsi singkat berita kedua untuk memberikan informasi kepada pembaca.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="" class="card-image">
                <div class="card-content">
                    <h2 class="card-title">Judul Berita 3</h2>
                    <p class="card-description">
                        Deskripsi singkat berita ketiga untuk memberikan informasi kepada pembaca.
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>


<?php include('./include/footer.php') ?>