<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/dinpanperta.png">
    <link rel="stylesheet" href="../assets/CSS/admin/login.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">

        <h2>Admin Panel</h2>
        <p>Silakan login</p>

        <?php if (isset($_GET['error'])): ?>
            <p style="color:red;">Username atau password salah</p>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

    </div>
</div>

</body>
</html>
