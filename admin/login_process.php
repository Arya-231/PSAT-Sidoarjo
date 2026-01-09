<?php
session_start();
include "../includes/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admin WHERE username = '$username' LIMIT 1"
    );

    if ($query && mysqli_num_rows($query) === 1) {

        $admin = mysqli_fetch_assoc($query);

     if (password_verify($password, $admin['password'])) {
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_id']    = $admin['id'];
    $_SESSION['admin_nama']  = $admin['nama'];
    header("Location: dashboard.php");
    exit;
}

    }

    header("Location: index.php?error=1");
    exit;
}
