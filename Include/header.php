<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendidikan Jasmani</title>
    <link rel="icon" href="http://localhost/Pendidikan%20Jasmani/assets/Icon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Qwitcher+Grypen:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
            font-family: "Poppins", sans-serif;
        }

        a {
            color: var(--text-dark);
        }

        h1,
        h2,
        h3 {
            font-weight: 500;
        }

        html,
        body {
            scroll-behavior: smooth;
        }

        :root {
            --padding: 1rem;
            --padding-sm: 0.5rem;
            --padding-md: 0.8rem;
            --font-sm: 12px;
            --font-md: 14px;
            --font-lg: 24px;
            --gap: 1.4rem;
            --primary-color: #FAB12F;
            --primary-color-dark: #e8a127;
            --text-dark: #0c0a09;
            --text-light: #78716c;
            --white: #ffffff;
            --max-width: 1200px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* REUSABLE CLASS*/

        .container {
            max-width: 1200px;
            margin-inline: 1.5rem;
        }

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
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .section-description-black {
            max-width: 600px;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .highlight-news {
            display: -webkit-box;
            /* Untuk mendukung pemotongan multi-line */
            -webkit-line-clamp: 2;
            /* Tentukan jumlah baris yang ingin ditampilkan */
            -webkit-box-orient: vertical;
            /* Membuat teks tetap vertikal */
            overflow: hidden;
            /* Sembunyikan teks yang tidak muat */
            text-overflow: ellipsis;
            /* Tampilkan "..." jika teks terpotong */
        }

        .head-news {
            display: -webkit-box;
            /* Untuk mendukung pemotongan multi-line */
            -webkit-line-clamp: 2;
            /* Tentukan jumlah baris yang ingin ditampilkan */
            -webkit-box-orient: vertical;
            /* Membuat teks tetap vertikal */
            overflow: hidden;
            /* Sembunyikan teks yang tidak muat */
            text-overflow: ellipsis;
            /* Tampilkan "..." jika teks terpotong */
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

        /* BAGIAN NAVIGASI BAR */

        .header {
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            position: sticky;
            z-index: 200;
        }

        .nav {
            height: 5.2rem;
        }

        .nav-logo img {
            width: 100%;
            max-width: 250px;
        }

        .nav-burger,
        .nav-close {
            color: var(--text-dark);
        }

        .nav-data {
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: inline-flex;
            align-items: center;
            column-gap: .25rem;
        }

        .nav-toggle {
            position: relative;
            width: 32px;
            height: 32px;
            font-size: 2rem;
        }

        .nav-burger,
        .nav-close {
            position: absolute;
            width: max-content;
            height: max-content;
            margin: auto;
            cursor: pointer;
            inset: 0;
            transition: opacity .1s, transform .4s;
        }

        .nav-close {
            opacity: 0;
        }

        .show-icon .nav-burger {
            opacity: 0;
            transform: rotate(90deg);
        }

        .show-icon .nav-close {
            opacity: 1;
            transform: rotate(90deg);
        }

        .nav-link {
            color: var(--text-dark);
            background-color: var(--primary-color-dark);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }



        .nav-link.active {
            width: 100%;
            transform-origin: bottom right;
        }

        /* BAGIAN NAVBAR DROPDOWN*/

        .dropdown-item {
            cursor: pointer;
        }

        .dropdown-arrow {
            font-size: 1.25rem;
            font-weight: initial;
            transition: transform .4s;
        }

        .dropdown-link {
            padding: 1rem 1rem 1rem 2rem;
            color: var(--text-dark);
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            column-gap: .5rem;
            transition: background-color .3s;
        }

        .dropdown-link:hover {
            background-color: var(--primary-color-dark);
        }

        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height .4s ease-out;
            z-index: 9999;
            position: relative;
        }

        .contact-container a {
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 1rem;
        }

        .contact-card a {
            display: flex;
            align-items: center;
            column-gap: 1rem;
        }

        .nav-link .contact-card span {
            font-size: var(--font-lg);
            color: var(--text-dark);
        }

        .nav-link .contact-card p {
            font-size: var(--font-md);
            font-weight: 600;
            color: var(--text-dark);
        }

        .nav-link .contact-card h4 {
            font-size: var(--font-sm);
            font-weight: 600;
            color: var(--text-dark);
        }

        /* BAGIAN YANG MENAMPILKAN DROPDOWN MENU */

        .dropdown-item:hover .dropdown-menu {
            max-height: 200px;
            transition: max-height .4s ease in;
        }

        .dropdown-menu .contact-card span {
            font-size: var(--font-lg);
            color: var(--text-dark);
        }

        /* ====== BREAKPOINT RESPONSIF ======*/

        /* UNTUK DEVICE KECIL */

        @media screen and (max-width:340px) {
            .container {
                margin-inline: 1rem;
            }

            .nav-link {
                padding-inline: 1rem;
            }

            .fasilitas {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                grid-template-rows: repeat(6, 1fr);
                gap: 10px;
            }
        }

        @media screen and (max-width: 576px) {
            .card-image .section-header {
                font-size: 1.5rem;
                margin-bottom: 0;
                line-height: normal;
            }
        }

        @media screen and (max-width: 576px) {
            .card-image .section-header {
                font-size: 1.5rem;
                margin-bottom: 0;
                line-height: normal;
            }
        }

        /* UNTUK DEVICE BESAR  */

        @media screen and (max-width:1118px) {
            .nav-menu {
                position: absolute;
                left: 0;
                top: 3.5rem;
                width: 100%;
                height: calc((100vh - 3.5rem));
                overflow: auto;
                pointer-events: none;
                opacity: 0;
                transition: top .4s, opacity .3s;
            }

            .nav-menu::-webkit-scrollbar {
                width: 0;
            }

            .nav-list {
                background-color: var(--primary-color-dark);
                padding-top: 1rem;
            }

            .show-menu {
                opacity: 1;
                top: 5.2rem;
                pointer-events: initial;
                z-index: 100;
            }

            .nav-link:hover {
                background-color: var(--primary-color);
            }
        }

        @media screen and (min-width:1118px) {
            .container {
                margin-inline: auto;
            }

            .nav {
                display: flex;
                justify-content: space-between;
            }

            .nav-toggle {
                display: none;
            }

            .nav-list {
                height: 100%;
                display: flex;
                align-items: center;
            }

            .nav-link {
                padding: 0.7rem;
                justify-content: initial;
                background-color: #ffffff;
                justify-content: center;
            }

            .dropdown-item {
                position: relative;
            }

            .dropdown-menu {
                max-height: initial;
                overflow: initial;
                position: absolute;
                left: 0;
                opacity: 0;
                pointer-events: none;
                transition: opacity .3s, top .3s;
            }

            .dropdown-link {
                padding-inline: 1rem 2.5rem;
            }

            .dropdown-item:hover .dropdown-menu {
                opacity: 1;
                pointer-events: initial;
                transition: top .3s;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                width: 0%;
                height: 3px;
                bottom: 5;
                left: 0;
                background-color: var(--primary-color);
                transform-origin: bottom right;
                transition: width 0.2s ease-in;
                border-radius: 10px;
            }

            .nav-link:hover::after {
                width: 100%;
                transform-origin: bottom left;
            }
        }

        /* BAGIAN YANG MENAMPILKAN DROPDOWN MENU END */
    </style>
</head>

<body>
    <!-- NavBar -->
    <header class="header">
        <nav class="nav container">
            <div class="nav-data">
                <a href="" class="nav-logo">
                    <img src=".\assets\Logo.svg" alt="">
                </a>
                <div class="nav-toggle" id="nav-toggle">
                    <i class="ri-menu-line nav-burger">
                    </i>
                    <i class="ri-close-line nav-close"></i>
                </div>
            </div>

            <!-- nav menu -->
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <li>
                        <a href="index.php" class="nav-link">Beranda</a>
                    </li>
                    <li>
                        <a href="berita.php" class="nav-link">Berita</a>
                    </li>

                    <!-- dropdown menu 1 -->
                    <li class="dropdown-item">
                        <div class="nav-link">
                            Profil <i class="ri-arrow-down-s-fill dropdown-arrow"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="visi-misi.php" class="dropdown-link">Visi Misi</a>
                            </li>
                            <li>
                                <a href="profil-dosen.php" class="dropdown-link">Dosen</a>
                            </li>
                            <li>
                                <a href="struktur-organisasi.php" class="dropdown-link">Struktur Organisasi</a>
                            </li>
                        </ul>
                    </li>

                    <!-- dropdown menu 2 -->
                    <li class="dropdown-item">
                        <div class="nav-link">
                            Akademik <i class="ri-arrow-down-s-fill dropdown-arrow"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="kurikulum.php" class="dropdown-link">Kurikulum</a>
                            </li>
                            <li>
                                <a href="akreditasi.php" class="dropdown-link">Akreditasi</a>
                            </li>
                            <li>
                                <a href="pkm.php" class="dropdown-link">PKM</a>
                            </li>
                            <li>
                                <a href="prestasi.php" class="dropdown-link">Prestasi Mahasiswa</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="penelitian.php" class="nav-link">Penelitian</a>
                    </li>
                    <li>
                        <a href="hima.php" class="nav-link">HIMA</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script>
        /*=============== SHOW MENU ===============*/
        const showMenu = (toggleId, navId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId)

            toggle.addEventListener('click', () => {
                // Add show-menu class to nav menu
                nav.classList.toggle('show-menu')

                // Add show-icon to show and hide the menu icon
                toggle.classList.toggle('show-icon')
            })
        }

        showMenu('nav-toggle', 'nav-menu');

        // Mendapatkan referensi tombol dan kontainer PDF
        const showPDFBtn = document.getElementById("showPDFBtn");
        const pdfContainer = document.getElementById("pdf-container");
        const closePDFBtn = document.getElementById("closePDFBtn");

        // Menambahkan event listener untuk tombol tampilkan PDF
        showPDFBtn.addEventListener("click", function () {
            pdfContainer.style.display = "flex"; // Menampilkan PDF
        });

        // Menambahkan event listener untuk tombol tutup PDF
        closePDFBtn.addEventListener("click", function () {
            pdfContainer.style.display = "none"; // Menyembunyikan PDF
        });

        // Menutup PDF saat mengklik area di luar modal
        pdfContainer.addEventListener("click", function (event) {
            if (event.target === pdfContainer) {
                pdfContainer.style.display = "none";
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const navLinks = document.querySelectorAll(".nav-link a");

            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    navLinks.forEach(nav => nav.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    </script>
</body>
</html>
