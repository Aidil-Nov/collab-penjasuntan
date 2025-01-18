<?php include './include/header.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik|Kurikulum</title>
    <style>

        .kurikulum-section {
            
        }
        .kurikulum-section img {
            width: 100%;
            
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
            margin: 0;
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

        /* Responsive Breakpoints */

        @media screen and (max-width: 480px) {
            
        }

        @media screen and (min-width: 481px) and (max-width: 768px) {
        }

        @media screen and (min-width: 769px) and (max-width: 1024px) {
            
        }
    </style>
</head>

<body>
    <section class="kurikulum-section section-container">
        <!-- About Kurikulum -->
            <div class="vertical-card">
                <div class="vertical-card-content">
                    <h3 class="section-subheader">Kurikulum</h3>
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
    <script>
        
    </script>   

    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>   
    <script src="./js/swipeup.js"></script> 
    <script src="./js/pdf.js"></script>
</body>

</html>
<?php include './include/footer.php' ?>