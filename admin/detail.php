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

/* ===============================
   LOGIKA PESAN OTOMATIS BERDASARKAN TANGGAL
================================ */
$nama_usaha = htmlspecialchars($data['nama_unit']);
$produk     = htmlspecialchars($data['nama_komoditas']);
$tgl_akhir  = $data['tgl_berakhir']; // Format YYYY-MM-DD dari DB

// Hitung selisih hari
$today = new DateTime();
$expired_date = new DateTime($tgl_akhir);
$diff = $today->diff($expired_date);
$hari_tersisa = (int)$diff->format("%r%a"); // Mengambil angka selisih (negatif jika sudah lewat)

// Tentukan Template Pesan Berdasarkan Kondisi Tanggal
if ($hari_tersisa < 0) {
    // KONDISI 1: SUDAH KADALUARSA
    $status_teks = "⚠️ *PEMBERITAHUAN MASA BERLAKU HABIS* ⚠️";
    $isi_pesan = "Kami menginformasikan bahwa masa berlaku sertifikat PSAT Anda untuk produk *{$produk}* telah *HABIS* pada tanggal " . date('d/m/Y', strtotime($tgl_akhir)) . ". Mohon segera melakukan pengurusan perpanjangan.";
} elseif ($hari_tersisa <= 30) {
    // KONDISI 2: HAMPIR HABIS (30 Hari sebelum)
    $status_teks = "🔔 *PENGINGAT MASA BERLAKU* 🔔";
    $isi_pesan = "Kami ingin mengingatkan bahwa masa berlaku sertifikat PSAT Anda untuk produk *{$produk}* akan berakhir dalam *{$hari_tersisa} hari lagi* (Tanggal: " . date('d/m/Y', strtotime($tgl_akhir)) . "). Mohon persiapkan dokumen perpanjangan.";
} else {
    // KONDISI 3: MASIH AKTIF LAMA
    $status_teks = "✅ *INFORMASI SERTIFIKASI PSAT* ✅";
    $isi_pesan = "Sertifikat PSAT Anda untuk produk *{$produk}* saat ini berstatus *AKTIF* sampai tanggal " . date('d/m/Y', strtotime($tgl_akhir)) . ". Terima kasih telah menjaga kualitas pangan segar.";
}

$teks_wa = "Halo Bapak/Ibu dari *{$nama_usaha}*,\n\n"
         . $status_teks . "\n"
         . $isi_pesan . "\n\n"
         . "Pesan ini dikirim otomatis melalui Sistem Informasi PSAT.";

$url_pesan = urlencode($teks_wa);

// Format Nomor WA agar diawali 62
$no_wa = preg_replace('/[^0-9]/', '', $data['telepon']);
if (substr($no_wa, 0, 1) === '0') {
    $no_wa = '62' . substr($no_wa, 1);
}
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

    <div class="d-flex flex-wrap gap-2">
    <?php
    if (!empty($data['foto_kemasan'])) :
        // 1. Dekode JSON dari database
        $fotos = json_decode($data['foto_kemasan'], true);

        // 2. Fallback jika data di database berupa string pisahan koma (format lama)
        if (!is_array($fotos)) {
            $fotos = array_filter(explode(',', $data['foto_kemasan']));
        }

        foreach ($fotos as $foto) :
            // 3. Tentukan path file yang benar
            // Sesuaikan path ini dengan folder tempat Anda menyimpan file (uploads/kemasan/)
            $file_path = "../uploads/kemasan/" . trim($foto);
            
            // 4. Cek apakah file ada di folder sebelum ditampilkan
            if (file_exists($file_path)) :
    ?>
                <a href="<?= $file_path ?>" target="_blank">
                    <img src="<?= $file_path ?>" 
                         class="preview-img img-thumbnail" 
                         style="width: 150px; height: 150px; object-fit: cover;"
                         alt="Foto Kemasan Produk">
                </a>
    <?php 
            else :
                // Tampilkan placeholder jika file hilang di folder
                echo '<div class="alert alert-light border p-2" style="width:150px; font-size:12px;">File tidak ditemukan: '.htmlspecialchars($foto).'</div>';
            endif;
        endforeach;
    else :
    ?>
        <p class="text-muted italic">Tidak ada foto kemasan yang diunggah.</p>
    <?php endif; ?>
    </div>
</div>


    <!-- SECTION 7 — NOTIFIKASI -->
    <div class="card-section">
    <h3 class="section-title">Kirim Notifikasi</h3>
    
    <div style="margin-bottom: 10px; font-size: 14px;">
        Status Pesan: 
        <?php 
            if($hari_tersisa < 0) echo "<span style='color:red; font-weight:bold;'>Sudah Kadaluarsa</span>";
            elseif($hari_tersisa <= 30) echo "<span style='color:orange; font-weight:bold;'>Hampir Habis</span>";
            else echo "<span style='color:green; font-weight:bold;'>Masih Aktif</span>";
        ?>
    </div>

    <div class="notif-buttons">
        <?php if (!empty($data['telepon'])) : ?>
            <a href="https://wa.me/<?= $no_wa ?>?text=<?= $url_pesan ?>" 
               target="_blank" 
               class="btn btn-wa">
                📱 Kirim Pesan Otomatis (WA)
            </a>
        <?php endif; ?>

        <?php if (!empty($data['email'])) : ?>
            <a href="mailto:<?= htmlspecialchars($data['email']) ?>?subject=Info Sertifikat PSAT - <?= $nama_usaha ?>&body=<?= $url_pesan ?>" 
               class="btn btn-email">
                📧 Email
            </a>
        <?php endif; ?>
    </div>
</div>
</div>

</div>

<?php include "footer.php"; ?>
