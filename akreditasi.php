<?php include './include/header.php';?>
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
                <img src=".//Akreditasi B 2020-2025.png" alt="">
                <h3>
                    Akreditsi Tahun 2020 hingga 2025
                </h3>
            </div>
            <div class="card-image">
                <img src=".//Akreditasi B 2015-2020.png" alt="">
                <h3>
                    Akreditsi Tahun 2015 hingga 2020
                </h3>   
            </div>
            <div class="card-image">
                <img src=".//AKREDITASI C TAHUN 2011-2016.png" alt="">
                    <h3>
                        Akreditsi Tahun 2011 hingga 2016
                    </h3>
            </div>
        </div>
    </section>
</body>
</html>


<?php include('./include/footer.php') ?>