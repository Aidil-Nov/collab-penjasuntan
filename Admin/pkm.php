<?php
session_start();

// Jika sesi belum ada, cek cookie
if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_id'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    $_SESSION['username'] = $_COOKIE['username'];
}

// Jika tidak ada sesi atau cookie, redirect ke login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../Admin/index.php");
    exit;
}
?>

<?php include '../include/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>