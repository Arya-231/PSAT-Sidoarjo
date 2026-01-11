<?php
$title = "Dashboard Admin";
$custom_css = "dashboard.css";

include "../includes/config.php";
include 'header.php'; 
include 'sidebar.php';

/* ===============================
    1. LOGIKA STATISTIK UTAMA
================================ */

// Total pelaku usaha (Unik)
$total_pelaku = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT nama_unit) AS total FROM registrasi_psat"))['total'] ?? 0;

// Total produk tersertifikasi
$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrasi_psat"))['total'] ?? 0;

// Status label (Putih, Hijau, Merah)
$q_label = mysqli_query($conn, "SELECT label, COUNT(*) AS total FROM registrasi_psat GROUP BY label");
$label_count = ['putih' => 0, 'hijau' => 0, 'merah' => 0];
while ($l = mysqli_fetch_assoc($q_label)) {
    $label_count[strtolower($l['label'])] = $l['total'];
}

// Menghitung Kadaluarsa & Mendekati Kadaluarsa
$akan_habis = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrasi_psat WHERE tgl_berakhir BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)"))['total'] ?? 0;
$kadaluarsa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrasi_psat WHERE tgl_berakhir < CURDATE()"))['total'] ?? 0;

/* ===============================
    2. DATA GRAFIK (QUERY TUNGGAL)
================================ */

// Query mengambil jumlah pendaftaran 6 bulan terakhir
$query_grafik = mysqli_query($conn, "
    SELECT 
        DATE_FORMAT(tgl_terbit, '%M %Y') AS bulan, 
        COUNT(*) AS total
    FROM registrasi_psat 
    WHERE tgl_terbit >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY YEAR(tgl_terbit), MONTH(tgl_terbit)
    ORDER BY tgl_terbit ASC
");

$labels_bulan = [];
$data_pertumbuhan = [];

while ($row = mysqli_fetch_assoc($query_grafik)) {
    $labels_bulan[] = $row['bulan'];
    $data_pertumbuhan[] = $row['total'];
}

// Konversi data ke format JSON untuk JavaScript
$json_labels = json_encode($labels_bulan);
$json_data_pertumbuhan = json_encode($data_pertumbuhan);
$json_data_label = json_encode([$label_count['putih'], $label_count['hijau'], $label_count['merah']]);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard Analitik PSAT</h4>
            <p class="text-muted small">Visualisasi data sertifikasi dan pemantauan masa berlaku.</p>
        </div>
        <div class="badge bg-white shadow-sm text-dark p-2 px-3 border border-light rounded-pill">
            <i class="bi bi-calendar3 me-2 text-primary"></i> <?= date('d F Y') ?>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card p-3 shadow-sm border-0 card h-100 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-primary-light text-primary"><i class="bi bi-building"></i></div>
                    <div class="ms-3">
                        <small class="text-muted d-block">Pelaku Usaha</small>
                        <span class="fs-4 fw-bold"><?= number_format($total_pelaku) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-3 shadow-sm border-0 card h-100 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-success-light text-success"><i class="bi bi-box-seam"></i></div>
                    <div class="ms-3">
                        <small class="text-muted d-block">Total Produk</small>
                        <span class="fs-4 fw-bold"><?= number_format($total_produk) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-3 shadow-sm border-0 card h-100 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-warning-light text-warning"><i class="bi bi-clock-history"></i></div>
                    <div class="ms-3">
                        <small class="text-muted d-block">Akan Habis</small>
                        <span class="fs-4 fw-bold"><?= $akan_habis ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-3 shadow-sm border-0 card h-100 rounded-4">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-danger-light text-danger"><i class="bi bi-exclamation-octagon"></i></div>
                    <div class="ms-3">
                        <small class="text-muted d-block">Kadaluarsa</small>
                        <span class="fs-4 fw-bold"><?= $kadaluarsa ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 h-100 rounded-4">
                <h6 class="fw-bold mb-4 text-secondary small text-uppercase">Tren Registrasi 6 Bulan Terakhir</h6>
                <div style="height: 300px;">
                    <canvas id="chartPertumbuhan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
                <h6 class="fw-bold mb-3 text-secondary small text-uppercase text-center">Distribusi Status Label</h6>
                <div style="height: 180px;">
                    <canvas id="chartLabel"></canvas>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h6 class="fw-bold mb-3">Pusat Notifikasi</h6>
                <div class="notif-box">
                    <?php if ($kadaluarsa > 0): ?>
                        <div class="alert alert-danger border-0 small py-2 d-flex align-items-center">
                            <i class="bi bi-x-circle-fill me-2"></i> 
                            <span><b><?= $kadaluarsa ?></b> produk sudah expired.</span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($akan_habis > 0): ?>
                        <div class="alert alert-warning border-0 small py-2 d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                            <span><b><?= $akan_habis ?></b> sertifikat hampir habis.</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($kadaluarsa == 0 && $akan_habis == 0): ?>
                        <div class="text-center py-3">
                            <i class="bi bi-shield-check text-success fs-2"></i>
                            <p class="text-muted small mt-2 mb-0">Semua sertifikat terpantau aktif.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <hr class="text-light">
                <a href="data.php" class="btn btn-primary rounded-pill btn-sm w-100 py-2">
                    <i class="bi bi-arrow-right-circle me-1"></i> Kelola Data Lengkap
                </a>
            </div>
        </div>
    </div>


<script>
// Ambil data dari PHP
const labelsBulan = <?= $json_labels ?>;
const dataPertumbuhan = <?= $json_data_pertumbuhan ?>;
const dataLabel = <?= $json_data_label ?>;

// 1. Grafik Batang (Tren Bulanan)
const ctxBar = document.getElementById('chartPertumbuhan').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: labelsBulan,
        datasets: [{
            label: 'Produk Terdaftar',
            data: dataPertumbuhan,
            backgroundColor: '#0d6efd',
            hoverBackgroundColor: '#0b5ed7',
            borderRadius: 8,
            barThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { display: false } 
        },
        scales: { 
            x: { grid: { display: false } },
            y: { 
                beginAtZero: true, 
                ticks: { stepSize: 1 },
                grid: { borderDash: [5, 5] }
            } 
        }
    }
});

// 2. Grafik Doughnut (Komposisi Label)
const ctxPie = document.getElementById('chartLabel').getContext('2d');
new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: ['Putih', 'Hijau', 'Merah'],
        datasets: [{
            data: dataLabel,
            backgroundColor: ['#e2e8f0', '#22c55e', '#ef4444'],
            borderWidth: 0,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { 
                position: 'bottom', 
                labels: { 
                    padding: 15,
                    usePointStyle: true,
                    boxWidth: 8
                } 
            } 
        },
        cutout: '75%'
    }
});
</script>

<?php include 'footer.php'; ?>