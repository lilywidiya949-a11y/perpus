<?php
session_start();

// Jika sudah login, arahkan sesuai role
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: admin/dashboard_admin.php");
    } else {
        header("Location: user/dashboard_user.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Virtual Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
     <link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (eye icon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            max-width: 420px;
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 1.2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .form-title {
            font-weight: bold;
            font-size: 1.8rem;
            color: #0d6efd;
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .register-link {
            font-size: 0.9rem;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper i {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container">
            <div class="form-title">Login Virtual Lab</div>
            <form action="proses_login.php" method="POST">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Username atau Email</label>
                    <input type="text" name="username_email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" class="form-control" id="password-field" required>
                        <i class="fa-solid fa-eye" id="toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="mt-3 text-center register-link">
                    Belum punya akun? <a href="register.php">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle password visibility -->
    <script>
        const togglePassword = document.getElementById("toggle-password");
        const passwordField = document.getElementById("password-field");

        togglePassword.addEventListener("click", function() {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>