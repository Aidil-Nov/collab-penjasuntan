<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Username dan password yang valid
    $validUsername = "penjas@fkip.untan.ac.id";
    $validPassword = "PendidikanPenjas2025";

    // Data dari form
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validasi username dan password
    if ($username === $validUsername && $password === $validPassword) {
        // Jika valid, buat session dan redirect ke dashboard
        $_SESSION['admin_id'] = "admin"; // Session sederhana
        header("Location: ../Admin/dashboard.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pendidikan Jasmani</title>
    <link rel="icon" href="http://localhost/Pendidikan%20Jasmani/assets/Icon.svg" type="image/svg+xml">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            width: 100%;
            max-width: 360px;
        }
        .logo img {
            max-height: 80px;
        }
        .btn-primary {
            background-color: #ff7e00;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e66d00;
        }
        .form-control:focus {
            border-color: #ff7e00;
            box-shadow: 0 0 5px rgba(255, 126, 0, 0.5);
        }
        .error-message {
            color: #e63946;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Logo -->
        <div class="logo text-center mb-4">
            <img src="../assets/Icon.svg" alt="Logo Universitas" class="img-fluid">
        </div>
        <!-- Title -->
        <h3 class="text-center text-warning">Pendidikan Jasmani</h3>
        <p class="text-center text-muted">Universitas Tanjungpura Pontianak</p>
        <hr class="mb-4">
        <!-- Login Form -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <!-- Error Message -->
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <!-- Footer -->
        <div class="text-center mt-4">
            <p class="text-muted" style="font-size: 0.85rem;">&copy; 2024 Universitas Tanjungpura Pontianak</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
