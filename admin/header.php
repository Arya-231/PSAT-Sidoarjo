<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Admin" ?> - PSAT Sidoarjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin/admin.css">
    <?php if (!empty($custom_css)) : ?>
        <link rel="stylesheet" href="../assets/css/admin/<?= $custom_css ?>">
    <?php endif; ?>
</head>
<body>

<header class="header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <div class="hamburger" onclick="toggleSidebar()">☰</div>
        <h4 class="m-0"><?= $title ?? "Admin Panel" ?></h4>
    </div>

    <div class="admin-info">
        <i class="bi bi-person-circle"></i> Admin
    </div>
</header>

