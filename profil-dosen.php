<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil|Profil Dosen</title>
    <style>
        /* Dosen */

        .dosen-grid-container {
            display: flex;
            flex-direction: column;
            gap: 5rem;
            margin-top: 5rem;
        }

        .dosen-grid {
            display: grid;
            justify-items: center;
            align-items: center;
            gap: 5rem ;
        }

        /* Grid pertama: satu card di tengah */
        .dosen-grid-single {
            grid-template-columns: 1fr;
            justify-content: center;
        }

        /* Grid kedua: beberapa card */
        .dosen-grid-multiple {
            grid-template-columns: repeat(3, 1fr);
        }

        /* Card */
        .dosen-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
            width: 100%;
            max-width: 300px;
            min-width: 100px;

        }

        .dosen-card:hover {
            transform: translateY(-10px);
        }

        .dosen-card img {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
        }

        .dosen-info {
            padding: 10px;
            font-size: 0.7rem;
        }

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
            margin-bottom: 1rem;
        }

        .vertical-card-description {
            font-size: 14px;
            color: #333;
            margin-bottom: 1.5rem;
        }

        /* Responsiveness */

        @media screen and (max-width: 1024px) {
            .dosen-grid-multiple {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 768px) {
            .dosen-grid-multiple {
                grid-template-columns: repeat(2, 1fr);
            }
            .dosen-info {
            padding: 10px;
            font-size: 0.5rem;
        }
        }

        @media screen and (max-width: 480px) {
            .dosen-grid-multiple {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <!-- About Penjas -->
    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="https://via.placeholder.com/500x300" alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="vertical-card-subheader">Tentang</p>
                <h2 class="vertical-card-header">Pendidikan Jasmani</h2>
                <p class="vertical-card-description">
                    Program Studi Pendidikan Jasmani (Penjas) bertujuan mencetak tenaga pendidik dan profesional di bidang
                    olahraga, kesehatan, dan rekreasi. Mahasiswa mempelajari teori dan praktik seperti pendidikan jasmani,
                    teknik olahraga, serta manajemen kebugaran. Lulusannya
                    dapat berkarier sebagai guru, pelatih, atau pengelola program rekreasi, dengan fokus pada gaya hidup
                    sehat dan pengembangan olahraga.
                </p>
            </div>
        </div>
    </section>
    <!-- About Penjas END-->
    
    <!-- Dosen -->
    <section class="dosen-section section-container">
        <h1 class="section-subheader">Dosen Penjas </h1>
        <p class="section-description-black">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit repellat, quia
            quis dolorum unde ad temporibus, similique cumque omnis velit est libero quos quae hic delectus doloremque
            reprehenderit nesciunt necessitatibus.</p>
        <div class="dosen-grid-container">
             <!-- Card untuk Dosen Dekan -->
            <div class="dosen-grid dosen-grid-single">
                <?php
                // Query untuk mengambil data dosen dengan jabatan Dekan
                $queryDekan = "SELECT * FROM dosen WHERE jabatan = 'Dekan'";
                $resultDekan = mysqli_query($conn, $queryDekan);
                
                if ($rowDekan = mysqli_fetch_assoc($resultDekan)) {
                    echo '<div class="dosen-card">';
                    echo '<img src="' . $rowDekan['foto'] . '" alt="' . $rowDekan['nama'] . '">';
                    echo '<div class="dosen-info">';
                    echo '<h2>' . $rowDekan['nama'] . '</h2>';
                    echo '<p>NIP. ' . $rowDekan['nip'] . '</p>';
                    echo '</div></div>';
                }
                ?>
            </div>
    
            <!-- Grid untuk Dosen selain Dekan -->
            <div class="dosen-grid dosen-grid-multiple">
                <?php
                // Query untuk mengambil data dosen dengan jabatan selain Dekan
                $queryNonDekan = "SELECT * FROM dosen WHERE jabatan != 'Dekan'";
                $resultNonDekan = mysqli_query($conn, $queryNonDekan);
                
                while ($rowNonDekan = mysqli_fetch_assoc($resultNonDekan)) {
                    echo '<div class="dosen-card">';
                    echo '<img src="' . $rowNonDekan['foto'] . '" alt="' . $rowNonDekan['nama'] . '">';
                    echo '<div class="dosen-info">';
                    echo '<h2>' . $rowNonDekan['nama'] . '</h2>';
                    echo '<p>NIP. ' . $rowNonDekan['nip'] . '</p>';
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Dosen END -->
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>   
    <script src="./js/swipeup.js"></script> 
</body>
</html>
<?php include './include/footer.php' ?>