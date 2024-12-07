<?php include('./include/header.php');?>
<?php include './Data/db_connect.php'; ?>


    <!-- Carousel Berhasil -->
    <?php
    // Query untuk mengambil berita
    $sql = "SELECT judul AS title, foto AS image, DATE_FORMAT(tanggal_upload, '%d %M %Y') AS date, 'Berita' AS category, highlight AS description FROM berita ORDER BY tanggal_upload DESC LIMIT 10";
    $result = $conn->query($sql);

    // Siapkan data untuk JavaScript
    $newsData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['image'] = 'uploads/' . $row['image']; // Tambahkan jalur folder uploads
            $newsData[] = $row;
        }
    }

    // Encode data menjadi JSON
    $newsDataJson = json_encode($newsData);

    // Tutup koneksi
    $conn->close();
    ?>
    <section class="news-carousel">
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

    <script>
        // Ambil data dari PHP
        const newsData = <?php echo $newsDataJson; ?>;

        // Definisi class NewsCarousel
        class NewsCarousel {
            constructor(data) {
                this.data = data;
                this.currentIndex = 0;
                this.wrapper = document.querySelector('.news-carousel__wrapper');
                this.prevBtn = document.querySelector('.carousel-btn-prev');
                this.nextBtn = document.querySelector('.carousel-btn-next');

                this.renderCards();
                this.addEventListeners();
                this.startAutoPlay();
            }

            renderCards() {
                this.wrapper.innerHTML = this.data.map(news => `
                    <div class="news-card">
                        <img src="${news.image}" alt="Gambar Berita" class="news-card__image">
                        <div class="news-card__content">
                            <h2 class="news-card__title">${news.title}</h2>
                            <div class="news-card__metadata">
                                <span>${news.date}</span>
                                <span>${news.category}</span>
                            </div>
                            <p class="news-card__description">${news.description}</p>
                        </div>
                    </div>
                `).join('');
            }

            addEventListeners() {
                this.prevBtn.addEventListener('click', () => this.prev());
                this.nextBtn.addEventListener('click', () => this.next());
            }

            next() {
                this.currentIndex++;
                if (this.currentIndex >= this.data.length) {
                    this.currentIndex = 0;
                }
                this.updateCarousel();
            }

            prev() {
                this.currentIndex--;
                if (this.currentIndex < 0) {
                    this.currentIndex = this.data.length - 1;
                }
                this.updateCarousel();
            }

            updateCarousel() {
                const offset = -this.currentIndex * 100;
                this.wrapper.style.transform = `translateX(${offset}%)`;
            }

            startAutoPlay() {
                this.autoPlayInterval = setInterval(() => {
                    this.next();
                }, 5000);
            }
        }

        // Inisialisasi Carousel
        new NewsCarousel(newsData);
    </script>

    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="./assets/about.png"  alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="vertical-card-subheader">Tentang</p>
                <h2 class="vertical-card-header">Pendidikan Jasmani</h2>
                <p class="vertical-card-description">
                    Program Studi Pendidikan Jasmani (Penjas) bertujuan mencetak tenaga pendidik dan profesional di bidang olahraga, kesehatan, dan rekreasi. Mahasiswa mempelajari teori dan praktik seperti pendidikan jasmani, teknik olahraga, serta manajemen kebugaran. Lulusannya
                    dapat berkarier sebagai guru, pelatih, atau pengelola program rekreasi, dengan fokus pada gaya hidup sehat dan pengembangan olahraga.
                </p>
                <button class="btn" role="button"><a href="/public/uploads/profil-dosen.html">Selengkapnya</a></button>
            </div>
        </div>
    </section>

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
    <style>
.news-carousel {
    width: 100%;
    position: relative;
    overflow: hidden;
    margin: auto;
    box-shadow: var(--shadow);
}

.news-carousel__wrapper {
    display: flex;
    width: 100%;
    transition: transform 0.5s ease;
}

.news-card {
    flex: 0 0 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    overflow: hidden;
}

.news-card__image {
    width: 100%;
    height: 600px;
    object-fit: cover;
}

.news-card__content {
    padding: 20px;
    background-color: white;
}

.news-card__title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.news-card__metadata {
    display: flex;
    justify-content: space-between;
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.news-card__description {
    color: #555;
    font-size: 1rem;
}

.carousel-controls {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}

.carousel-btn {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    z-index: 10;
}


/* Responsive Breakpoints */

@media screen and (max-width: 480px) {
    .news-card__image {
        height: 200px;
    }
    .news-card__title {
        font-size: 1.1rem;
    }
    .news-card__metadata {
        font-size: 0.8rem;
    }
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

@media screen and (max-width: 1024px) {
    .vertical-card {
        grid-template-columns: 1fr;
    }
    .card-grid {
        grid-template-columns: 1fr;
    }
    .card-image {
        height: 250px;
        /* Menyesuaikan tinggi gambar agar lebih proporsional */
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

<?php include('./include/footer.php') ?>