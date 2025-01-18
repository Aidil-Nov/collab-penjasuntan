<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Pastikan file CSS utama -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet"> <!-- CDN untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Footer Styles */
        :root {
            --white: #ffffff;
            --text-dark: #333333;
        }

        .footer {
            background-color: #282828;
            color: var(--white);
            padding: 3rem 2rem;
            bottom: 0;
            position: relative;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
        }

        .footer-logos {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }

        .footer-logos img {
            max-width: 110px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .footer-logos img:hover {
            transform: scale(1.1);
        }

        .footer-address,
        .footer-contact {
            line-height: 1.6;
        }

        .footer-address h3,
        .footer-contact h3 {
            color: var(--white);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .footer-contact a {
            color: var(--white);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-contact a:hover {
            color: #ccc;
        }

        .footer-map iframe {
            width: 100%;
            height: 250px;
            border: none;
            border-radius: 8px;
        }

        /* Responsiveness */
        @media screen and (max-width: 1024px) {
            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .footer-logos {
                justify-content: center;
            }
            .footer-logos img {
                max-width: 100px;
            }
        }

        @media screen and (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .footer-logos {
                flex-wrap: wrap;
                justify-content: center;
            }
            .footer-logos img {
                max-width: 90px;
            }
        }

        @media screen and (max-width: 480px) {
            .footer-logos img {
                max-width: 80px;
            }
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <!-- Logo Section -->
            <div class="footer-logos">
                <img src="./assets/logo-untan.png" alt="Logo Universitas 1">
                <img src="./assets/Logo_Kampus_Merdeka_Kemendikbud.png" alt="Logo Universitas 2">
                <img src="./assets/Logo-Tut-Wuri-Handayani-PNG-Warna.png" alt="Logo Universitas 3">
            </div>

            <!-- Address Section -->
            <div class="footer-address">
                <h3>Alamat</h3>
                <p><i class="fa-solid fa-location-dot"></i> Jl. Profesor Dokter H. Hadari Nawawi</p>
                <p>Bansir Laut, Kec. Pontianak Tenggara, Kota Pontianak,</p>
                <p>Kalimantan Barat 78124</p>
                <p>Indonesia</p>
            </div>

            <!-- Contact Section -->
            <div class="footer-contact">
                <h3>Kontak</h3>   
                <a href="mailto:penjas@untan.ac.id">penjas@untan.ac.id</a>
                <div class="social-media">
                    <a href="https://www.instagram.com/penjas.untan_official?igsh=MXdweHg3MzdiNjB1Ng=="><i class="ri-instagram-line"></i> Instagram</a>
                    <a href="https://youtube.com/@penjasuntan3826?si=dIo2ZsZjrkm_-qr4"><i class="ri-youtube-line"></i> Youtube</a>
                </div>
            </div>

            <!-- Map Section -->
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d392.8774071153481!2d109.344065!3d-0.059338!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5990f4cd7fef%3A0x1ca9fe3658d81f3b!2sFakultas%20Keguruan%20dan%20Ilmu%20Pendidikan%20(FKIP)!5e1!3m2!1sid!2sid!4v1732271869284!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </footer>
</body>
</html>
