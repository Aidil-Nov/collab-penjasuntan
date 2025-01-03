<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMA|Himpunan Mahasiswa Penjas</title>
    <style>
        .vertical-card {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            align-items: center;
            overflow: hidden;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .vertical-card-image-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 5px;
        }

        .vertical-card-image {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
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



        .button-close {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }

        /* tabel */
        .table-section {
            padding-top: 2rem 1rem;
        }

        .table-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            box-shadow: var(--shadow);

        }

        .table-main {
            margin-top: 1rem;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            box-shadow: var(--shadow);
            border-radius: 8px;
        }

        th,
        td {
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem;
            text-align: center;
        }

        .t-header {
            color: var(--text-dark);
            font-weight: 600;
            text-align: center;
            background-color: var(--primary-color);
        }

        #no {
            width: 10px;
        }

        .data-hima h1 {
            font-size: 2rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination-item,
        .pagination a,
        .pagination-arrow {
            margin: 0;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .pagination a:hover,
        .pagination-arrow:hover {
            background-color: var(--primary-color-dark);
            color: #fff;
            box-shadow: var(--shadow);
            cursor: pointer;
        }

        .pagination-item.active {
            background-color: var(--primary-color);
            color: #fff;
            box-shadow: var(--shadow);
            pointer-events: none;
        }

        .pagination-arrow {
            font-size: 1.2rem;
        }


        @media screen and (max-width: 480px) {
            .table-section {
                padding: 1rem 0.5rem;
            }

            .table-container {
                gap: 1rem;
            }

            /* Responsive Table Layout */
        }

        /* Tablets (481px - 768px) */
        @media screen and (min-width: 481px) and (max-width: 768px) {
            .table-section {
                padding: 1.5rem 1rem;
            }

            .table-container {
                gap: 1.25rem;
            }

            .table-main {
                font-size: 0.95rem;
            }

            th,
            td {
                padding: 0.9rem;
            }

        }

        /* Laptops and Smaller Desktops (769px - 1024px) */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .table-section {
                padding: 2rem 1rem;
            }

            .table-container {
                gap: 1.5rem;
            }

            .table-main {
                font-size: 1rem;
            }

            th,
            td {
                padding: 1rem;
            }

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


        /* Responsiveness */

        @media screen and (max-width: 1024px) {
            .table-wrapper {
                width: 85%;
            }

            .vertical-card {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 768px) {

            button {
                font-size: 15px;
                /* Ukuran font tombol sedikit lebih besar */
            }

            .table-wrapper {
                width: 90%;
            }

            table {
                font-size: 14px;
            }

            .vertical-card {
                grid-template-columns: 1fr;
            }

            .vertical-card-header {
                font-size: 20px;
            }

            .vertical-card-description {
                font-size: 13px;
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

            table-wrapper {
                width: 95%;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 8px 10px;
            }

            button {
                font-size: 14px;
                /* Menyesuaikan ukuran font tombol pada layar kecil */
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    <!-- About Hima -->
    <section class="about-section section-container">
        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="./uploads/1732442475_6742f96b1fe57.png" alt=""
                    class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="section-subheader">Tentang</p>
                <h2 class="vertical-card-header">Himpunan Mahasiswa Pendidikan Jasmani</h2>
                <p class="vertical-card-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo consequatur nulla praesentium ex,
                    explicabo laborum vitae modi. Dolor ducimus repudiandae sequi ipsam, aliquid repellendus deleniti
                    corrupti quod optio magni. Reprehenderit?
                </p>
                <button id="showPDFBtn" class="btn">Tampilkan SK</button>
            </div>
        </div>
    </section>
    <!-- About Hima -->

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

    <!-- Data Mahasiswa Hima -->
    <section class="data-hima section-container">
        <h3 class="section-subheader">Data Anggota</h3>
        <h2 class="section-header">Himpunan Mahasiswa Penjas</h2>
        <div class="table-container">
            <table class="table-main">
                <thead>
                    <tr>
                        <th id="no" class="t-header">Nomor</th>
                        <th id="name" class="t-header">Nama</th>
                        <th id="jabatan" class="t-header">Jabatan</th>
                        <th id="nim" class="t-header">NIM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Jumlah entri per halaman
                    $limit = 10;

                    // Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Hitung total entri
                    $total_sql = "SELECT COUNT(*) FROM organisasi";
                    $total_result = $conn->query($total_sql);
                    $total_row = $total_result->fetch_row();
                    $total_entries = $total_row[0];

                    // Hitung jumlah halaman
                    $total_pages = ceil($total_entries / $limit);

                    // Ambil data untuk halaman saat ini
                    $sql = "SELECT id, nama, jabatan, nim FROM organisasi ORDER BY id ASC LIMIT $limit OFFSET $offset";
                    $result = $conn->query($sql);
                    $counter = $offset + 1; // Inisialisasi penghitung
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                        <tr>
                            <td>' . $counter . '</td>
                            <td>' . htmlspecialchars($row["nama"]) . '</td>
                            <td>' . htmlspecialchars($row["jabatan"]) . '</td>
                            <td>' . htmlspecialchars($row["nim"]) . '</td>
                        </tr>
                        ';
                            $counter++;
                        }
                    } else {
                        echo "<p>Tidak ada berita ditemukan.</p>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Navigasi Pagination -->
            <!-- Navigasi Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="pagination-arrow">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $page)
                           echo 'class="pagination-item active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="pagination-arrow">&raquo;</a>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <!-- Data Mahasiswa Hima END -->

    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>
    <script src="./js/swipeup.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
        });
    </script>

</body>

</html>

<?php include './include/footer.php' ?>