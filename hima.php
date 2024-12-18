<?php include('../include/header.php');?>

<section class="about-section section-container">

        <div class="vertical-card">
            <div class="vertical-card-image-container">
                <img src="https://via.placeholder.com/500x300" alt="Pendidikan Jasmani" class="vertical-card-image">
            </div>
            <div class="vertical-card-content">
                <p class="section-subheader">Tentang</p>
                <h2 class="vertical-card-header">Himpunan Mahasiswa Pendidikan Jasmani</h2>
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
                    <iframe src="../resource/SK.pdf" type="application/pdf" width="100%" height="100%">
                        Browser Anda tidak mendukung tampilan PDF. 
                        <a href="">Unduh PDF</a>
                    </iframe>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="data-hima section-container">
        <h2 class="section-subheader">Data Anggota</h2>
        <h1 class="section-header">Himpunan Mahasiswa Penjas</h1>
        <p></p>
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
                <tr>
                    <td>1</td>
                    <td>Johntor</td>
                    <td>Mahasiswa</td>
                    <td>12345678</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Doe</td>
                    <td>Mahasiswa</td>
                    <td>87654321</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>John Smith</td>
                    <td>Mahasiswa</td>
                    <td>11223344</td>
                </tr>
                <!-- Tambahkan baris tambahan sesuai kebutuhan -->
            </tbody>
        </table>
        </div>
    </section>

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

<?php include('../include/footer.php') ?>