<?php
$title = "Dashboard Admin";
$custom_css = "dashboard.css";

include "../includes/config.php";
include 'auth_check.php';
include 'header.php'; 
include 'sidebar.php';

// Ambil daftar nama unit yang akan habis dalam 30 hari
$list_akan_habis = mysqli_query($conn, "
    SELECT nama_unit, tgl_berakhir 
    FROM registrasi_psat 
    WHERE tgl_berakhir BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    ORDER BY tgl_berakhir ASC LIMIT 5
");

// Ambil daftar nama unit yang sudah kadaluarsa
$list_kadaluarsa = mysqli_query($conn, "
    SELECT nama_unit, tgl_berakhir 
    FROM registrasi_psat 
    WHERE tgl_berakhir < CURDATE()
    ORDER BY tgl_berakhir DESC LIMIT 5
");

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

$label = ['putih' => 0, 'hijau' => 0, 'merah' => 0];
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
$q_kadaluarsa_count = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM registrasi_psat 
    WHERE tgl_berakhir < CURDATE()
");
$kadaluarsa = mysqli_fetch_assoc($q_kadaluarsa_count)['total'] ?? 0;
?>

<div class="content-wrapper">

    <div class="row g-3 dashboard-cards mb-4">
        <div class="col-md-3 col-6">
            <div class="cardd border-start border-primary border-4">
                <h5>Total Pelaku Usaha</h5>
                <div class="value text-primary"><?= $total_pelaku ?></div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="cardd border-start border-info border-4">
                <h5>Produk Sertifikasi</h5>
                <div class="value text-info"><?= $total_produk ?></div>
            </div>
        </div>

        <div class="col-md-3 col-12">
            <div class="cardd border-start border-secondary border-4">
                <h5>Status Label</h5>
                <div class="label-status">
                    <div class="label-item">
                        <span><span class="label-dot putih"></span> Putih</span>
                        <span class="count"><?= $label['putih'] ?></span>
                    </div>
                    <div class="label-item">
                        <span><span class="label-dot hijau"></span> Hijau</span>
                        <span class="count"><?= $label['hijau'] ?></span>
                    </div>
                    <div class="label-item">
                        <span><span class="label-dot merah"></span> Merah</span>
                        <span class="count"><?= $label['merah'] ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="cardd border-start border-warning border-4">
                <h5>Akan Habis</h5>
                <div class="value text-warning"><?= $akan_habis ?></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card chart-card bg-white border-0 shadow-sm h-100">
                <h5 class="fw-bold mb-4"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>Statistik Produk</h5>
                <canvas id="chartSertifikat"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card chart-card bg-white border-0 shadow-sm h-100">
                <h5 class="fw-bold mb-4"><i class="bi bi-bell-fill me-2 text-warning"></i>Notifikasi</h5>
                <div class="alert-list">
                    
                    <?php if ($kadaluarsa > 0): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-3">
                        <i class="bi bi-x-circle-fill fs-4 me-3"></i>
                        <div>
                            <small class="fw-bold d-block">Sertifikat Kadaluarsa</small>
                            <small><?= $kadaluarsa ?> Produk telah expired.</small>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($akan_habis > 0): ?>
                    <div class="alert alert-warning d-flex align-items-center mb-3">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                        <div>
                            <small class="fw-bold d-block">Mendekati Kadaluarsa</small>
                            <small><?= $akan_habis ?> Produk berakhir < 30 hari.</small>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($label['hijau'] > 0): ?>
                    <div class="alert alert-success d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>
                            <small class="fw-bold d-block">Label Hijau</small>
                            <small><?= $label['hijau'] ?> Produk terpantau aman.</small>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($kadaluarsa == 0 && $akan_habis == 0 && $label['hijau'] == 0): ?>
                    <div class="text-center py-4">
                        <i class="bi bi-info-circle text-muted fs-2"></i>
                        <p class="text-muted small mt-2">Tidak ada notifikasi baru.</p>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>