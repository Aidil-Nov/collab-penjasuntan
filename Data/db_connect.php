<?php
$host = "localhost";
$username = "root"; // Ganti sesuai dengan username MySQL Anda
$password = "";     // Ganti sesuai dengan password MySQL Anda
$dbname = "KampusDB"; // Nama database

$conn = new mysqli($host, $username, $password, $dbname);

// Koneksi database
$conn = mysqli_connect("localhost", "root", "", "KampusDB");
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
