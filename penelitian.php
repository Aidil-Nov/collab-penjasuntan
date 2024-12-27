<?php include('./include/header.php');?>
<?php include './Data/db_connect.php'; ?>


<section class="table-section section-container">    
    <h2 class="section-subheader">Penelitian</h2>
    <div class="table-container">
        <table class="table-main">
            <thead>
                <tr>
                    <th id="no" class="t-header">No</th>
                    <th id="name" class="t-header">Judul</th>
                    <th id="tahun" class="t-header">Tahun</th>
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
<section class="berita-section section-container">
    <?php 
    // Query untuk mengambil 3 berita terbaru berdasarkan tanggal_upload
    $sql = "SELECT id, foto, judul, highlight, tanggal_upload FROM berita ORDER BY tanggal_upload DESC LIMIT 3";
    $result = $conn->query($sql);
    ?>
    <h3 class="section-subheader">Berita</h3>
    <h2 class="section-header">Pendidikan Jasmani</h2>
    <div class="card-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Jalur gambar, diasumsikan folder uploads berada di direktori root server
                $imagePath = 'uploads/' . $row['foto'];
                ?>
                <!-- Card -->
                <div class="card">
                    <a href="blog.php?id=<?=htmlspecialchars($row['id'])?>">
                        <img src="<?= htmlspecialchars($imagePath); ?>" alt="Gambar Berita" class="card-image">
                        <div class="card-content">
                            <h2 class="card-title head-news"><?= htmlspecialchars($row['judul']); ?></h2>
                            <p class="section-description"><?= date('d M Y', strtotime($row['tanggal_upload'])); ?></p>
                            <p class="card-description highlight-news">
                                <?= htmlspecialchars($row['highlight']); ?>
                            </p>
                            <button type="button" class="btn">Selengkapnya</button>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "<p>Tidak ada berita tersedia.</p>";
        }
        ?>
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

/* Card Berita */
.card-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }
    
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.2s ease;
        }
    
        .card:hover {
            transform: translateY(-5px);
        }
    
        .card-image {
            width: 100%;
            max-width: 700px;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            transform: scale(1);
            transition: ease-in;
        }
    
        .card-content .btn {
            margin-top: 10px;
            float: right;
            margin: 10px;
        }
    
        .card-content {
            padding: 15px;
        }
    
        .card-title {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 10px;
        }
    
        .card-description {
            font-size: 14px;
            color: #555;
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
@media screen and (max-width: 768px) {
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

    .card-grid {
                grid-template-columns: repeat(1, 1fr);
                /* 2 kolom untuk card */
            }
    
            .card a{
                display: flex;
                align-items: center;
            }
    
            .card .btn {
                display: none;
            }
    
    
            .card-image {
                max-width: 150px;
                max-height: 150px;
                height: 250px;
            }
    
            .card-content {
                padding: 10px;
                /* Mengurangi padding untuk layar kecil */
            }
    
            .card-title {
                font-size: 16px;
                /* Ukuran font lebih kecil */
            }
    
            .card-description {
                font-size: 13px;
                /* Ukuran font deskripsi lebih kecil */
            }

}

/* Laptops and Smaller Desktops (769px - 1024px) */
@media screen and (max-width: 1024px) {
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

<?php include('./include/footer.php') ?>