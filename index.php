<?php
$title = "Beranda";
$custom_css = "index.css";

include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';
?>
<!-- HERO SECTION -->
<section class="hero-section d-flex align-items-center text-white">
    <div class="container mt-3 pt-2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">Pangan Segar Asal Tumbuhan<br>Kabupaten Sidoarjo</h1>

                <div class="highlight-box mb-3">
                    <h5 class="fw-bold text-white m-0">Apa Itu PSAT?</h5>
                </div>

                <p class="fs-6 lh-lg">
                    PSAT (Pangan Segar Asal Tumbuhan) adalah bahan pangan yang berasal dari tumbuhan 
                    dan belum diolah, seperti buah, sayur, kacang-kacangan, dan umbi. PSAT wajib 
                    memenuhi standar keamanan, mutu, dan kelayakan edar sesuai regulasi 
                    Kementerian Pertanian.
                </p>
            </div>

            <div class="col-lg-6 text-center">
                <img src="assets/img/sidak.png" alt="Pertanian" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: Jenis PSAT -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Jenis PSAT</h3>

        <div class="row g-4">
            <!-- Box 1 -->
            <div class="col-md-4">
                <div class="info-box shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h5 class="fw-bold mb-2">PSAT Segar</h5>
                    <p class="text-muted mb-0">
                        Pangan yang langsung dikonsumsi tanpa pengolahan seperti sayur, buah segar, dan umbi.
                    </p>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="col-md-4">
                <div class="info-box shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h5 class="fw-bold mb-2">PSAT Olahan Minimal</h5>
                    <p class="text-muted mb-0">
                        Pangan yang mengalami proses minimal seperti pencucian, pengupasan, pemotongan, atau pengemasan.
                    </p>
                </div>
            </div>

            <!-- Box 3 -->
            <div class="col-md-4">
                <div class="info-box shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h5 class="fw-bold mb-2">PSAT Bermutu</h5>
                    <p class="text-muted mb-0">
                        Produk dengan standar mutu tertentu sesuai ketentuan keamanan pangan nasional.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: Alur Penerbitan Sertifikat -->
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Alur Penerbitan Sertifikat PSAT</h3>

        <div class="timeline mx-auto p-4">

            <div class="timeline-step">
                <span class="circle">1</span>
                <div class="content">
                    <h6 class="fw-bold">Pengajuan Registrasi</h6>
                    <p class="text-muted">Pelaku usaha mengisi formulir dan melengkapi dokumen.</p>
                </div>
            </div>

            <div class="timeline-step">
                <span class="circle">2</span>
                <div class="content">
                    <h6 class="fw-bold">Verifikasi Administrasi</h6>
                    <p class="text-muted">Petugas memeriksa kelengkapan dan kevalidan berkas.</p>
                </div>
            </div>

            <div class="timeline-step">
                <span class="circle">3</span>
                <div class="content">
                    <h6 class="fw-bold">Pemeriksaan Lapangan</h6>
                    <p class="text-muted">Dilakukan pengecekan lokasi, proses produksi, dan standar kebersihan.</p>
                </div>
            </div>

            <div class="timeline-step">
                <span class="circle">4</span>
                <div class="content">
                    <h6 class="fw-bold">Penerbitan Sertifikat</h6>
                    <p class="text-muted">Sertifikat diterbitkan jika seluruh persyaratan terpenuhi.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 3: Hak & Kewajiban -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center">Hak & Kewajiban Pelaku Usaha</h3>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="rounded-4 shadow-sm p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 text-success">Hak Pelaku Usaha</h5>
                    <ul class="text-muted lh-lg">
                        <li>Mendapat pendampingan dalam proses registrasi.</li>
                        <li>Mendapatkan hasil evaluasi atau verifikasi.</li>
                        <li>Menerima sertifikat PSAT jika memenuhi persyaratan.</li>
                        <li>Berhak mengajukan pembaruan atau perubahan data.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="rounded-4 shadow-sm p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 text-danger">Kewajiban Pelaku Usaha</h5>
                    <ul class="text-muted lh-lg">
                        <li>Memenuhi standar keamanan pangan yang berlaku.</li>
                        <li>Menyampaikan data sesuai kondisi sebenarnya.</li>
                        <li>Menerapkan sanitasi dan higienis pada proses produksi.</li>
                        <li>Melakukan perpanjangan sertifikat sesuai masa berlaku.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
