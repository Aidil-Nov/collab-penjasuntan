<?php include './include/header.php';?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik | Kurikulum</title>
    <style>
        .kurikulum-section img {
            width: 100%;
            margin-top: 10px;
            box-shadow: var(--shadow);
        }
        .kurikulum-section .btn {
            margin: 10px;
        }
        
        .btn {
            margin-top: 0.5rem;
        }

        #showPDFBtn {
            border: none;
            cursor: pointer;
        }

        #pdf-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .pdf-wrapper {
            background-color: #ffffff;
            border-radius: 8px;
            width: 100%;
            max-width: 1000px;
            max-height: 90vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .button-close {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }

        .btn {
            padding: 8px 16px;
        }

        .pdf-content {
            width: 100%;
            height: 80vh;
            overflow: auto;
        }

        .pdf-content iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .button-close {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }
        /* Responsive Breakpoints */

        @media screen and (max-width: 480px) {
            .pdf-wrapper {
                width: 95%;
                max-height: 95vh;
            }
            .pdf-content {
                height: 85vh;
            }
        }

        @media screen and (min-width: 481px) and (max-width: 768px) {
            .pdf-wrapper {
                width: 90%;
                max-height: 92vh;
            }
            .pdf-content {
                height: 88vh;
            }
        }

        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .pdf-wrapper {
                width: 85%;
                max-height: 90vh;
            }
        }
    </style>

</head>
<body>
    <section class="kurikulum-section section-container">
        </section>
        
        
        <section class="about-section section-container">
            <div class="vertical-card">
                <div class="vertical-card-content">
                    <h3 class="section-subheader">Kurikulum</h3>
                    <h2 class="section-header">Prodi Pendidikan Jasmani</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates vel deserunt aliquid repellendus nulla inventore quidem officia, officiis et sapiente nam quibusdam, quae labore ab minima, magni qui tenetur?</p>
                    <p class="vertical-card-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo consequatur nulla praesentium ex, explicabo laborum vitae modi. Dolor ducimus repudiandae sequi ipsam, aliquid repellendus deleniti corrupti quod optio magni. Reprehenderit?
                    </p>
                    <button id="showPDFBtn" class="btn">Tampilkan SK</button>
                </div>
            </div>
    </section>
    <section>
        <div id="pdf-container">
            <div class="pdf-wrapper">
                <div class="button-close">
                    <button class="btn" id="closePDFBtn">Tutup PDF</button>
                </div>
                <div class="pdf-content">
                    <!--
                        Ganti URL di bawah dengan URL PDF yang ingin Anda tampilkan 
                        Pastikan URL PDF dapat diakses secara publik
                    -->
                    <iframe src="./assets/SK.pdf" type="application/pdf" width="100%" height="100%">
                        Browser Anda tidak mendukung tampilan PDF. 
                        <a href="">Unduh PDF</a>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Mendapatkan referensi tombol dan kontainer PDF
    const showPDFBtn = document.getElementById("showPDFBtn");
    const pdfContainer = document.getElementById("pdf-container");
    const closePDFBtn = document.getElementById("closePDFBtn");

    // Menambahkan event listener untuk tombol tampilkan PDF
    showPDFBtn.addEventListener("click", function() {
        pdfContainer.style.display = "flex"; // Menampilkan PDF
    });

    // Menambahkan event listener untuk tombol tutup PDF
    closePDFBtn.addEventListener("click", function() {
        pdfContainer.style.display = "none"; // Menyembunyikan PDF
    });

    // Menutup PDF saat mengklik area di luar modal
    pdfContainer.addEventListener("click", function(event) {
        if (event.target === pdfContainer) {
            pdfContainer.style.display = "none";
        }
    });

    document.addEventListener("DOMContentLoaded", () => {
        const navLinks = document.querySelectorAll(".nav-link a");

        navLinks.forEach(link => {
            link.addEventListener("click", function() {
                navLinks.forEach(nav => nav.classList.remove("active"));
                this.classList.add("active");
            });
        });
    });
</script>
</body>
</html>



<?php include './include/footer.php'?>