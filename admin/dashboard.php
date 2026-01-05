<?php
$title = "Dashboard Admin";
$custom_css = "dashboard.css";

include "../includes/config.php";
include 'header.php'; 
include 'sidebar.php';

/* ===============================
   QUERY RINGKASAN
================================ */

// Total pelaku usaha (distinct)
$q_pelaku = mysqli_query($conn, "SELECT COUNT(DISTINCT nama_unit) AS total FROM registrasi_psat");
$total_pelaku = mysqli_fetch_assoc($q_pelaku)['total'] ?? 0;

// Total produk tersertifikasi
$q_produk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrasi_psat");
$total_produk = mysqli_fetch_assoc($q_produk)['total'] ?? 0;

// Status label
$q_label = mysqli_query($conn, "
    SELECT label, COUNT(*) AS total
    FROM registrasi_psat
    GROUP BY label
");

$label = [
    'putih' => 0,
    'hijau' => 0,
    'merah' => 0
];

while ($l = mysqli_fetch_assoc($q_label)) {
    $label[strtolower($l['label'])] = $l['total'];
}

// Sertifikat akan habis (< 30 hari)
$q_habis = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM registrasi_psat 
    WHERE tgl_berakhir BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
");
$akan_habis = mysqli_fetch_assoc($q_habis)['total'] ?? 0;

// Kadaluarsa
$q_kadaluarsa = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM registrasi_psat 
    WHERE tgl_berakhir < CURDATE()
");
$kadaluarsa = mysqli_fetch_assoc($q_kadaluarsa)['total'] ?? 0;
?>

<div class="content-wrapper">

<!-- RINGKASAN CEPAT -->
<div class="row g-3 dashboard-cards">

    <div class="col-md-3 col-6">
        <div class="cardd">
            <h5>Total Pelaku Usaha</h5>
            <div class="value"><?= $total_pelaku ?></div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="cardd">
            <h5>Produk Tersertifikasi</h5>
            <div class="value"><?= $total_produk ?></div>
        </div>
    </div>

    <div class="col-md-3 col-12">
        <div class="cardd">
            <h5>Status Label</h5>

            <div class="label-status">
                <div class="label-item">
                    <span class="label-dot putih"></span>
                    Putih
                    <span class="count"><?= $label['putih'] ?></span>
                </div>

                <div class="label-item">
                    <span class="label-dot hijau"></span>
                    Hijau
                    <span class="count"><?= $label['hijau'] ?></span>
                </div>

                <div class="label-item">
                    <span class="label-dot merah"></span>
                    Merah
                    <span class="count"><?= $label['merah'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="cardd">
            <h5>Sertifikat Akan Habis</h5>
            <div class="value"><?= $akan_habis ?></div>
        </div>
    </div>

</div>

<br>

<!-- GRAFIK (STATIS / OPTIONAL JS) -->
<div class="card chart-card">
    <h5>Grafik Sertifikat Aktif / Kadaluarsa</h5>
    <canvas id="chartSertifikat"></canvas>
</div>

<br>

<!-- NOTIFIKASI DINAMIS -->
<div class="card list-card">
    <h5>Pengingat Sertifikat</h5>

    <div class="alert-list">

        <?php if ($akan_habis > 0): ?>
        <div class="alert-item warning">
            <i class="bi bi-exclamation-circle"></i>
            <span>
                <b><?= $akan_habis ?> Sertifikat</b> akan habis dalam <b>&lt; 30 hari</b>.
                Segera lakukan komunikasi dengan pelaku usaha.
            </span>
        </div>
        <?php endif; ?>

        <?php if ($kadaluarsa > 0): ?>
        <div class="alert-item danger">
            <i class="bi bi-x-circle"></i>
            <span>
                <b><?= $kadaluarsa ?> Sertifikat</b> telah <b>kadaluarsa</b>.
                Perlu tindakan lanjutan.
            </span>
        </div>
        <?php endif; ?>

        <?php if ($label['hijau'] > 0): ?>
        <div class="alert-item success">
            <i class="bi bi-check-circle"></i>
            <span>
                <b><?= $label['hijau'] ?> Produk</b> berstatus <b>Label Hijau</b>.
                Kondisi aman.
            </span>
        </div>
        <?php endif; ?>

    </div>
</div>

</div>

<?php include 'footer.php'; ?>
