<?php
$title = "Daftar Pelaku Usaha / Produk";
$custom_css = "detail.css";

include '../includes/config.php';
include 'header.php';
include 'sidebar.php';

/* ===============================
   VALIDASI ID
================================ */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='padding:20px'>Data tidak ditemukan.</p>";
    exit;
}

$id = (int) $_GET['id'];

/* ===============================
   QUERY DATA
================================ */
$query = mysqli_query($conn, "SELECT * FROM registrasi_psat WHERE id = $id LIMIT 1");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<p style='padding:20px'>Data tidak ditemukan.</p>";
    exit;
}

/* ===============================
   HELPER DATA
================================ */
$tgl_terbit   = !empty($data['tgl_terbit']) ? date('d F Y', strtotime($data['tgl_terbit'])) : '-';
$tgl_berakhir = !empty($data['tgl_berakhir']) ? date('d F Y', strtotime($data['tgl_berakhir'])) : '-';
$status_label = strtolower($data['label']) === 'hijau' ? 'badge-hijau' : 'badge-putih';
?>

<div class="detail-container">

    <!-- Tombol kembali -->
    <a href="data.php" class="btn-back">← Kembali</a>

    <h2 class="detail-title">Detail Pelaku Usaha</h2>

    <!-- SECTION 1 — DATA PELAKU USAHA -->
    <div class="card-section">
        <h3 class="section-title">Data Pelaku Usaha</h3>
        <div class="detail-grid">
            <div><span>Nama Usaha:</span> <?= htmlspecialchars($data['nama_unit']) ?></div>
            <div><span>Alamat:</span> <?= htmlspecialchars($data['alamat_unit']) ?></div>
            <div><span>No. Telepon:</span> <?= htmlspecialchars($data['telepon']) ?></div>
            <div><span>Email:</span> <?= htmlspecialchars($data['email']) ?></div>
            <div><span>Kecamatan:</span> <?= htmlspecialchars($data['kecamatan']) ?></div>
            <div><span>Kabupaten:</span> <?= htmlspecialchars($data['kabupaten']) ?></div>
        </div>
    </div>

    <!-- SECTION 2 — DATA PRODUK -->
    <div class="card-section">
        <h3 class="section-title">Data Produk</h3>
        <table class="detail-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jenis PSAT</th>
                    <th>Kemasan</th>
                    <th>Status Label</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($data['nama_komoditas']) ?></td>
                    <td><?= htmlspecialchars($data['jenis_psat']) ?></td>
                    <td><?= htmlspecialchars($data['kemasan_berat']) ?></td>
                    <td>
                        <span class="badge <?= $status_label ?>">
                            <?= htmlspecialchars($data['label']) ?>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- SECTION 3 — RIWAYAT -->
    <div class="card-section">
        <h3 class="section-title">Riwayat Pembaruan</h3>
        <div class="timeline">
            <div class="timeline-item">
                <div class="dot"></div>
                <div class="timeline-content">
                    <b><?= $tgl_terbit ?></b> — Sertifikat Diterbitkan
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4 — STATUS LABEL -->
    <div class="card-section">
        <h3 class="section-title">Status Label Saat Ini</h3>
        <div class="label-current">
            <span class="badge <?= $status_label ?>">Aktif Hingga</span>
            <div class="date-info"><?= $tgl_berakhir ?></div>
        </div>
    </div>

    <!-- SECTION 5 — DOKUMEN PDF -->
    <div class="card-section">
        <h3 class="section-title">Dokumen Sertifikat (PDF)</h3>
        <?php if (!empty($data['file_sertifikat'])) : ?>
            <a href="../uploads/sertifikat/<?= urlencode($data['file_sertifikat']) ?>" target="_blank" class="btn-download">
                📄 Download Sertifikat
            </a>
        <?php else : ?>
            <p>Dokumen tidak tersedia</p>
        <?php endif; ?>
    </div>

    <!-- SECTION 6 — FOTO PRODUK -->
    <div class="card-section">
    <h3 class="section-title">Foto Kemasan Produk</h3>

    <?php
    if (!empty($data['foto_kemasan'])) :

        // jika disimpan sebagai JSON
        $fotos = json_decode($data['foto_kemasan'], true);

        // fallback jika pakai koma
        if (!is_array($fotos)) {
            $fotos = explode(',', $data['foto_kemasan']);
        }

        foreach ($fotos as $foto) :
    ?>
            <img src="uploads/kemasan/<?= htmlspecialchars(trim($foto)) ?>"
                 class="preview-img"
                 alt="Foto Kemasan Produk">
    <?php
        endforeach;
    else :
    ?>
        <p>Tidak ada foto kemasan</p>
    <?php endif; ?>
</div>


    <!-- SECTION 7 — NOTIFIKASI -->
    <div class="card-section">
        <h3 class="section-title">Kirim Notifikasi</h3>

        <div class="notif-buttons">
            <?php if (!empty($data['telepon'])) : ?>
                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $data['telepon']) ?>" target="_blank" class="btn btn-wa">
                    📱 WhatsApp
                </a>
            <?php endif; ?>

            <?php if (!empty($data['email'])) : ?>
                <a href="mailto:<?= htmlspecialchars($data['email']) ?>" class="btn btn-email">
                    📧 Email
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>
