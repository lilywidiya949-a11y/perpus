<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "lab_management"; // Ganti sesuai nama database-mu

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
