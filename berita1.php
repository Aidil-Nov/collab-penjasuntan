<?php include('./include/header.php');?>
<?php include './Data/db_connect.php'; ?>

<?php
$sql = "SELECT judul AS title, foto AS image, DATE_FORMAT(tanggal_upload, '%d %M %Y') AS date, 'Berita' AS category, highlight AS description 
        FROM berita 
        ORDER BY tanggal_upload DESC 
        LIMIT 10";

$result = $conn->query($sql);

// Siapkan data berita
$newsData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['image'] = 'uploads/' . $row['image']; // Path folder uploads
        $newsData[] = $row;
    }
}

$conn->close(); // Tutup koneksi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .news-carousel .carousel-inner img {
        height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .news-card {
        padding: 15px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .news-card h5 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .news-card p {
        color: #555;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Responsivitas Slider */
    @media screen and (max-width: 480px) {
        .news-card__image {
            height: 200px;
        }
        .news-card__title {
            font-size: 1.1rem;
        }
        .news-card__metadata {
            font-size: 0.8rem;
        }
    }

    /* Kartu Vertikal */
    .vertical-card {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        align-items: center;
        padding: 1rem;
        background: #fff;
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
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .vertical-card-description {
        font-size: 14px;
        color: #333;
        margin-bottom: 1.5rem;
    }

    /* Berita Section */
    .berita-section {
        margin: 0 auto;
        padding: 20px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-content {
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-description {
        font-size: 14px;
        color: #555;
    }

    /* Responsivitas */
    @media screen and (max-width: 1024px) {
        .vertical-card {
            grid-template-columns: 1fr;
        }
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .card-image {
            height: 250px;
        }
    }

    @media screen and (max-width: 768px) {
        .vertical-card-header {
            font-size: 20px;
        }
        .vertical-card-description {
            font-size: 13px;
        }
        .card-grid {
            grid-template-columns: 1fr;
        }
        .card-content {
            padding: 10px;
        }
        .card-title {
            font-size: 16px;
        }
        .card-description {
            font-size: 13px;
        }
    }

    @media screen and (max-width: 480px) {
        .vertical-card {
            padding: 0.5rem;
        }
        .vertical-card-header {
            font-size: 18px;
        }
        .vertical-card-description {
            font-size: 12px;
        }
        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-image {
            height: 180px;
        }
        .card-title {
            font-size: 15px;
        }
        .card-description {
            font-size: 12px;
        }
        .news-title {
            font-size: 14px;
        }
        .news-date {
            font-size: 12px;
        }
    }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Berita Terbaru</h1>
        <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <?php foreach ($newsData as $index => $news): ?>
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true"></button>
                <?php endforeach; ?>
            </div>
            
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <?php foreach ($newsData as $index => $news): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-6">
                                <img src="<?= htmlspecialchars($news['image']) ?>" alt="Gambar Berita" class="d-block w-100">
                            </div>
                            <div class="col-md-6">
                                <div class="news-card">
                                    <h5><?= htmlspecialchars($news['title']) ?></h5>
                                    <p class="text-muted"><small><?= htmlspecialchars($news['date']) ?> - <?= htmlspecialchars($news['category']) ?></small></p>
                                    <p><?= htmlspecialchars($news['description']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
</body>
</html>

<?php include('./include/footer.php') ?>