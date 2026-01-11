<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Admin" ?> - PSAT Sidoarjo</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/dinpanperta.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin/admin.css">
    <?php if (!empty($custom_css)) : ?>
        <link rel="stylesheet" href="../assets/css/admin/<?= $custom_css ?>">
    <?php endif; ?>
</head>
<body>

<header class="header d-flex align-items-center justify-content-between px-3 shadow-sm bg-white">
    <div class="d-flex align-items-center">
        <div class="hamburger me-3" onclick="toggleSidebar()" style="cursor:pointer; font-size: 22px;">
            <i class="bi bi-list"></i>
        </div>
        <h5 class="m-0 fw-bold text-dark"><?= $title ?? "Admin Panel" ?></h5>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="admin-profile d-none d-md-flex align-items-center text-muted">
            <i class="bi bi-person-circle fs-5 me-2"></i>
            <span class="small fw-semibold">Administrator</span>
        </div>
        
        <div class="vr d-none d-md-block" style="height: 20px;"></div>

        <a href="logout.php" 
           class="btn btn-outline-danger btn-sm d-flex align-items-center px-3" 
           onclick="return confirm('Yakin ingin keluar?')">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
        </a>
    </div>
</header>

<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location: index.php");
    exit;
}
