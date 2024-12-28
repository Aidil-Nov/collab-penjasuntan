<?php include './include/header.php';?>
<?php include './Data/db_connect.php' ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil|Struktur Organisasi</title>
    <style>
    .struktur-organisasi {
        width: 100%;
        padding-top: 1rem;
    }

    .struktur-organisasi img {
        width: 100%;
        height: auto;
        object-fit: cover;
        box-shadow:var(--shadow);
        margin-top:2rem;
    }
</style>
</head>

<body>
    <!-- Struktur Organiasi -->
    <section class="struktur-organisasi section-container">
        <h3 class="section-subheader">Struktur</h3>
        <h2 class="section-header">organisasi</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, ea mollitia! Voluptas nostrum molestiae enim possimus aliquid exercitationem repellat suscipit, sequi voluptatem iure distinctio. Architecto ea eius praesentium ullam amet.</p>
        <img src="./assets/struktur_organisasi/struktur-organisasi.jpg" alt="">
    </section>
    <!-- Struktur Organiasi END -->
    <button id="swipeUpBtn" style="display: none;"><i class="fa-solid fa-chevron-up"></i></button>   
    <script src="./js/swipeup.js"></script> 
</body>
</html>

<?php include './include/footer.php' ?>