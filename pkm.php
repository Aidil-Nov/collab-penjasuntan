<?php include './include/header.php';?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik|PKM</title>
    <style>
    /* tabel */
    .table-section {
        padding-top: 2rem 1rem;
    }
    .table-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap:1.5rem;
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
        text-align: left;
    
    }
    
    .t-header {
        color: var(--text-dark);
        font-weight: 600;
        text-align: center;
        background-color: var(--primary-color);
    } 
    
    .t-header:last-child, td:last-child {
        width: 100px;
        text-align: center;
    }
    
    /* Mobile Phones (up to 480px) */
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
    
        th, td {
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
    
        th, td {
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
    
    </style>
</head>
<body>
    <!-- Tabel PKM -->
    <section class="table-section section-container">
        <h3 class="section-subheader">PKM</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates accusamus ullam vitae porro id vel harum architecto magni quaerat, officia eveniet qui est numquam repellendus reiciendis aperiam enim fugit tempore.</p>
        <div class="table-container">
            <table class="table-main">
                <thead>
                    <tr>
                        <th class="t-header">Judul</th>
                        <th class="t-header">Gambar</th>
                        <th class="t-header">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Judul">Pemanfaatan Artificial Intellegence (AI) dalam Pembellajaran Pendidikan Jasmani Olahraga dan Kesehatan</td>
                        <td data-label="Gambar"><img src="" alt=""></td>
                        <td data-label="Tahun">2024</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="table-main">
                <thead>
                    <tr>
                        <th class="t-header">Judul</th>
                        <th class="t-header">Gambar</th>
                        <th class="t-header">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Judul">Pelatihan Perwasitan Olahraga Permainan Tingkat Provinsi</td>
                        <td data-label="Gambar"><img src="" alt=""></td>
                        <td data-label="Tahun">2023</td>
                    </tr>
                    <tr>
                        <td data-label="Judul">Peningkatan Kompetensi Mahasiswa Dalam Perwasitan</td>
                        <td data-label="Gambar"><img src="" alt=""></td>
                        <td data-label="Tahun">2023</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="table-main">
                <thead>
                    <tr>
                        <th class="t-header">Judul</th>
                        <th class="t-header">Gambar</th>
                        <th class="t-header">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Judul">Sosialisasi Penyusunan Portofolio Seleksi Masuk Prodi Pendidikan Jasmani Fakultas Keguruan Dan Ilmu Pendidikan Universitas Tanjungpura Tahun 2022</td>
                        <td data-label="Gambar"><img src="" alt=""></td>
                        <td data-label="Tahun">2022</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="table-main">
                <thead>
                    <tr>
                        <th class="t-header">Judul</th>
                        <th class="t-header">Gambar</th>
                        <th class="t-header">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Judul">Peningkatan Pendidikan Karakter Nasionalisme Melalui Pendidikan Jasmani</td>
                        <td data-label="Gambar"><img src="" alt=""></td>
                        <td data-label="Tahun">2021</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>  
    <!-- Tabel PKM END -->
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>   
    <script src="./js/swipeup.js"></script> 
</body>
</html>
<?php include './include/footer.php' ?>