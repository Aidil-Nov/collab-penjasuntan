<?php include './include/header.php' ; ?>
<?php include './Data/db_connect.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <style>
        

        /* Responsive Media Queries */
        @media screen and (max-width: 480px) {
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

<?php
// Ensure your database connection is established
$sql = "SELECT foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 3";
$result = $conn->query($sql);
?>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const newsSlider = new NewsSlider('newsSlider');

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Prepare data for JavaScript
                $image = 'uploads/' . htmlspecialchars($row['foto']);
                $title = htmlspecialchars($row['judul']);
                $description = htmlspecialchars($row['highlight']);
                $date = date('d M Y', strtotime($row['tanggal_upload']));
        ?>
        newsSlider.addSlide({
            image: '<?= $image ?>',
            title: '<?= $title ?>',
            author: 'Admin',
            date: '<?= $date ?>',
            description: '<?= $description ?>'
        });
        <?php
            }
        }
        ?>
    });
    </script>
    <div class="news-slider" id="newsSlider">
            <!-- Slider akan diisi secara dinamis -->
    </div>
    <script>
        class NewsSlider {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        this.slides = [];
        this.currentSlideIndex = 0;
        this.isHovering = false;
        this.sliderInterval = null;

        this.initSlider();
    }

    initSlider() {
        this.createSliderContainer();
        this.createNavButtons();
        this.createIndicators();
        this.addHoverListeners();
    }

    createSliderContainer() {
        const sliderContainer = document.createElement('div');
        sliderContainer.classList.add('slider-container');
        this.container.appendChild(sliderContainer);
        this.sliderContainer = sliderContainer;
    }

    createNavButtons() {
        const navContainer = document.createElement('div');
        navContainer.classList.add('slide-navigation');

        const prevButton = document.createElement('button');
        prevButton.classList.add('nav-button', 'prev-button');
        prevButton.innerHTML = '&lt;';
        prevButton.addEventListener('click', () => this.prevSlide());

        const nextButton = document.createElement('button');
        nextButton.classList.add('nav-button', 'next-button');
        nextButton.innerHTML = '&gt;';
        nextButton.addEventListener('click', () => this.nextSlide());

        navContainer.appendChild(prevButton);
        navContainer.appendChild(nextButton);
        this.container.appendChild(navContainer);
    }

    createIndicators() {
        const indicatorContainer = document.createElement('div');
        indicatorContainer.classList.add('slide-indicators');
        this.container.appendChild(indicatorContainer);
        this.indicatorContainer = indicatorContainer;
    }

    addSlide(slideData) {
        this.slides.push(slideData);
        this.renderSlides();
        this.updateIndicators();
        
        // Start auto-slide only when first slide is added
        if (this.slides.length === 1) {
            this.startAutoSlide();
        }
    }

    renderSlides() {
        this.sliderContainer.innerHTML = '';
        this.slides.forEach(slide => {
            const slideElement = document.createElement('div');
            slideElement.classList.add('slide');

            const image = document.createElement('img');
            image.src = slide.image;
            image.alt = slide.title;
            image.classList.add('slide-image');

            const content = document.createElement('div');
            content.classList.add('slide-content');

            const title = document.createElement('h2');
            title.textContent = slide.title;

            const metaInfo = document.createElement('div');
            metaInfo.innerHTML = `<span>${slide.author} | ${slide.date}</span>`;

            const description = document.createElement('p');
            description.textContent = slide.description;

            content.appendChild(title);
            content.appendChild(metaInfo);
            content.appendChild(description);

            slideElement.appendChild(image);
            slideElement.appendChild(content);

            this.sliderContainer.appendChild(slideElement);
        });

        this.updateSliderPosition();
    }

    updateSliderPosition() {
        const offset = this.currentSlideIndex * -100;
        this.sliderContainer.style.transform = `translateX(${offset}%)`;
    }

    updateIndicators() {
        this.indicatorContainer.innerHTML = '';
        this.slides.forEach((_, index) => {
            const indicator = document.createElement('button');
            indicator.classList.add('slide-indicator');
            if (index === this.currentSlideIndex) {
                indicator.classList.add('active');
            }
            indicator.addEventListener('click', () => this.goToSlide(index));
            this.indicatorContainer.appendChild(indicator);
        });
    }

    nextSlide() {
        this.currentSlideIndex = (this.currentSlideIndex + 1) % this.slides.length;
        this.updateSliderPosition();
        this.updateIndicators();
    }

    prevSlide() {
        this.currentSlideIndex = (this.currentSlideIndex - 1 + this.slides.length) % this.slides.length;
        this.updateSliderPosition();
        this.updateIndicators();
    }

    goToSlide(index) {
        this.currentSlideIndex = index;
        this.updateSliderPosition();
        this.updateIndicators();
    }

    startAutoSlide() {
        // Clear any existing interval
        if (this.sliderInterval) {
            clearInterval(this.sliderInterval);
        }

        // Start new auto-slide interval
        this.sliderInterval = setInterval(() => {
            if (!this.isHovering && this.slides.length > 1) {
                this.nextSlide();
            }
        }, 3000);
    }

    addHoverListeners() {
        this.container.addEventListener('mouseenter', () => {
            this.isHovering = true;
        });

        this.container.addEventListener('mouseleave', () => {
            this.isHovering = false;
        });
    }
}

// Initialize the slider
const newsSlider = new NewsSlider('newsSlider');
    </script>
    <style>
        .news-slider {
            max-width: var(--max-width);
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .slider-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            flex: 0 0 100%;
            width: 100%;
        }

        .slide-image {
            width: 100%;
            aspect-ratio: 16/9;
            height: 500px;
            object-fit: cover;
        }

        .slide-content {
            padding: 15px;
            background-color: #f4f4f4;
        }

        .slide-navigation {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .nav-button {
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .slide-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .slide-indicator {
            width: 10px;
            height: 10px;
            background-color: #ccc;
            border-radius: 50%;
            cursor: pointer;
        }

        .slide-indicator.active {
            background-color: #333;
        }
    </style>


    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="./assets/about.png" alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="section-subheader">Tentang</p>
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

    <?php // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
    $sql = "SELECT foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 10";
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


<?php include './include/footer.php'  ?>