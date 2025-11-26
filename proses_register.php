<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $role = $_POST['role']; // <== Ambil role dari form

    // Validasi awal
    if ($password !== $password_confirm) {
        header("Location: register.php?error=Konfirmasi password tidak cocok");
        exit;
    }

    // Cek apakah username atau email sudah digunakan
    $cek = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $cek->bind_param("ss", $username, $email);
    $cek->execute();
    $hasil = $cek->get_result();

    if ($hasil->num_rows > 0) {
        header("Location: register.php?error=Username atau email sudah digunakan");
        exit;
    }

    // Simpan ke database (tanpa hash sesuai permintaan kamu)
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    
    if ($stmt->execute()) {
        header("Location: register.php?success=Registrasi berhasil. Silakan login.");
        exit;
    } else {
        header("Location: register.php?error=Gagal menyimpan data");
        exit;
    }
}
?>
