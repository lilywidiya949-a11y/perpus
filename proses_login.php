<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "lab_management";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah request POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Ambil user berdasarkan username atau email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Cek user dan password secara langsung (tanpa hash)
    if ($user && $password === $user['password']) {
        // Set session user
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard_admin.php");
        } elseif ($user['role'] === 'user') {
            header("Location: user/dashboard_user.php");
        }
        exit;
    } else {
        header("Location: login.php?error=Username atau password salah");
        exit;
    }
}
