<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_user.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Registrasi Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 360px;
        }

        .form-title {
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .text-small {
            font-size: 0.85rem;
        }

        .alert {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="register-container">
            <div class="form-title">Registrasi Akun</div>

            <form action="proses_register.php" method="POST">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                <?php elseif (isset($_GET['success'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
                <?php endif; ?>

                <div class="mb-2">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control form-control-sm" required autofocus>
                </div>

                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" class="form-control form-control-sm" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select form-select-sm" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="user">Pengguna</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-sm">Daftar</button>

                <div class="mt-3 text-center text-small">
                    Sudah punya akun? <a href="login.php">Login di sini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
