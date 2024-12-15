<?php include './include/header.php'; ?>
<?php include './Data/db_connect.php'; ?>

<?php
$sql = 'SELECT id, foto, judul, tanggal_upload, isi, highlight FROM berita';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($query)
    ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Berita</title>
    <style>
        .grid {
            display: grid;
            grid-template-columns: 2fr 2fr;
            gap: 2rem;
        }

        .blog-image {
            width: 100%;
            object-fit: cover;
            aspect-ratio: 16/9;
        }

        .section-header {
            max-width: 1200;
        }
    </style>
</head>

<body>
    <section class="grid">
        <div class="section-container">
            <h2 class="section-header">
                <?= $row['judul']; ?>
            </h2>
            <p class="date">
                <i class=""></i><?= $row['tanggal_upload'] ?>
            </p>
            <div>
                <?=
                    '
            <div class="slider-card">
            <img src="uploads/' . htmlspecialchars($row["foto"]) . '" class="blog-image" alt="News Image">
            '; ?>
            </div>
            <p>
                <?= $row['isi'] ?>
            </p>
        </div>
        <div class="headline">
            <div class="headline-list">
                <h2 class="section-header">Headline Berita</h2>
                <div class="headline-item">
                    <a href="">
                        <h3>Judul Berita 1</h3>
                        <p>20 November 2024</p>
                    </a>
                </div>
                <div class="headline-item">
                    <a href="">
                        <h3>Judul Berita 1</h3>
                        <p>20 November 2024</p>
                    </a>
                </div>
                <div class="headline-item">
                    <a href="">
                        <h3>Judul Berita 1</h3>
                        <p>20 November 2024</p>
                    </a>
                </div>
            </div>
    </section>


</body>

</html>