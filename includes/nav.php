<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar-psat">
  <div class="navbar-container">

    <!-- Logo -->
    <div class="navbar-logo">
      <img src="assets/img/dinpanperta.png" alt="Logo PSAT">
      <span>PSAT Sidoarjo</span>
    </div>

    <!-- Menu -->
    <ul class="navbar-menu">
      <li>
        <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
          Beranda
        </a>
      </li>
      <li>
        <a href="layanan.php" class="<?= ($current_page == 'layanan.php') ? 'active' : '' ?>">
          Layanan
        </a>
      </li>
      <li>
        <a href="panduan.php" class="<?= ($current_page == 'panduan.php') ? 'active' : '' ?>">
          Panduan
        </a>
      </li>
    </ul>

  </div>
</nav>
