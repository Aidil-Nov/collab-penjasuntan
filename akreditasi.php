<?php include './include/header.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik|Akreditasi</title>
    <style>
        /* BAGIAN AKREDITASI IMAGE */
        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
        }

        .card-image {
            margin-top: 1rem;
            padding: 10px;
            width: 100%;
            box-shadow: var(--shadow);
        }

        .card-image h3 {
            text-align: center;
            font-weight: 300;
        }

        .card-image img {
            display: flex;
            justify-content: center;
            margin: auto;
            width: 80%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- Bagian Akreditasi -->
    <section class="akreditasi-section section-container">
        <h1 class="section-subheader">Akreditasi</h1>
        <div class="card-grid">
            <div class="card-image">
                <img src="./assets/Akreditasi B 2020-2025.png" alt="">
                <h3>
                    Akreditsi Tahun 2020 hingga 2025
                </h3>
            </div>
        </div>
    </section>
    

    <section class="kurikulum-section section-container">
        <!-- About Kurikulum -->
        <div class="vertical-card">
            <div class="vertical-card-content">
                <h2 class="section-header">Prodi Pendidikan Jasmani</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates vel deserunt aliquid
                    repellendus nulla inventore quidem officia, officiis et sapiente nam quibusdam, quae labore ab
                    minima, magni qui tenetur?</p>
                <p class="vertical-card-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo consequatur nulla praesentium ex,
                    explicabo laborum vitae modi. Dolor ducimus repudiandae sequi ipsam, aliquid repellendus
                    deleniti
                    corrupti quod optio magni. Reprehenderit?
                </p>
                <button id="showPDFBtn" class="btn">Kurikulum</button>
            </div>
        </div>
    </section>
    <!-- About Kurikulum END-->
    <!-- PDF -->
    <section>
        <div id="pdf-container" style="display: none;">
            <div class="pdf-wrapper">
                <button id="closePDFBtn" class="btn">Tutup PDF</button>
                <iframe src="./assets/SK.pdf" width="100%" height="500px"></iframe>
            </div>
        </div>
    </section>
    <!-- PDF END -->


    <script src="./js/swipeup.js"></script>
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>

    <script src="./js/pdf.js"></script>
</body>

</html>


<?php include('./include/footer.php') ?>