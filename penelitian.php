<?php include('../include/header.php');?>

<section class="table-section section-container">    
    <h2 class="section-subheader">Penelitian</h2>
    <div class="table-container">
        <table class="table-main">
            <thead>
                <tr>
                    <th id="no" class="t-header">No</th>
                    <th id="name" class="t-header">Judul</th>
                    <th id="jabatan" class="t-header">Tahun</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul...</td>
                    <td>Tahun</td>
                </tr>
                <!-- Tambahkan baris tambahan sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</section>


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

.t-header:last-child, td:first-child, td:last-child {
    width: 100px;
    text-align: center;
}

/* Mobile Phones (up to 480px) */

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

</style>

<?php include('../include/footer.php') ?>