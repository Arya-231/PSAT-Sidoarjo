<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/css/admin/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <div class="login-box">

        <div class="login-header">
            <img src="../assets/img/dinpanperta.png" alt="Logo">
            <h2>Admin Panel</h2>
            <p>Masukkan akun Anda untuk melanjutkan</p>
        </div>

        <form action="dashboard.php" method="POST" class="login-form">
            
            <div class="input-group">
                <label>Username</label>
                <div class="input-field">
                    <i class="bi bi-person"></i>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-field">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Login</button>

            <p class="footer-text">© 2025 Dinas Ketahanan Pangan — Admin Panel</p>
        </form>

    </div>
</div>

</body>
</html>
