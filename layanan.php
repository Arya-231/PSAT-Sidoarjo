<?php
$title = "Layanan";
$custom_css = "layanan.css";

include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';

// Gunakan COALESCE atau pengecekan untuk kolom status jika Anda belum menambahkannya, 
// tapi sangat disarankan menambahkannya di database seperti langkah di atas.
$q = mysqli_query($conn, "
    SELECT 
        nama_komoditas,
        nama_unit,
        status, 
        tgl_terbit
    FROM registrasi_psat
    ORDER BY tgl_terbit DESC
");
?>

<div class="layanan-container">
    <h2 class="layanan-title">Layanan Informasi PSAT</h2>
    <p class="layanan-subtitle">
        Temukan layanan pengujian laboratorium dan fitur pengecekan status registrasi PSAT Kabupaten Sidoarjo.
    </p>

    <div class="layanan-section">
        <h3>Uji Laboratorium</h3>
        <p class="section-desc">
            Dinas Pangan dan Pertanian Kabupaten Sidoarjo menyediakan layanan pengujian keamanan pangan.
        </p>

        <div class="cards">
            <div class="card shadow-sm"><h4>Uji Residu Pestisida</h4><p>Mendeteksi residu pestisida.</p></div>
            <div class="card shadow-sm"><h4>Uji Logam Berat</h4><p>Analisis Pb, Hg, Cd.</p></div>
            <div class="card shadow-sm"><h4>Uji Mikrobiologi</h4><p>Deteksi mikroba.</p></div>
            <div class="card shadow-sm"><h4>Uji Kimia</h4><p>pH & kadar air.</p></div>
        </div>
    </div>

    <div class="layanan-section">
        <h3>Cek Status Registrasi PSAT</h3>
        <p class="section-desc">Masukkan nama produk atau usaha untuk melihat status registrasi PSAT Anda.</p>

        <div class="search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" placeholder="Cari nama produk atau nama usaha...">
        </div>

        <div class="table-responsive">
            <table id="psatTable" class="result-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Nama Usaha</th>
                        <th>Status</th>
                        <th>Tanggal Registrasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($q) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($q)) : 
                            // Logika warna badge berdasarkan status
                            $status = strtolower($row['status'] ?? 'aktif');
                            $badge_class = ($status == 'aktif') ? 'bg-success' : (($status == 'kadaluarsa') ? 'bg-danger' : 'bg-warning');
                        ?>
                            <tr>
                                <td class="fw-bold"><?= htmlspecialchars($row['nama_komoditas']) ?></td>
                                <td><?= htmlspecialchars($row['nama_unit']) ?></td>
                                <td>
                                    <span class="badge <?= $badge_class ?> px-3 py-2 shadow-sm">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($row['tgl_terbit'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Data registrasi tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('#psatTable tbody tr');
    let found = false;

    rows.forEach(row => {
        // Jangan filter baris "Data tidak ditemukan" jika ada
        if(row.cells.length > 1) {
            const text = row.innerText.toLowerCase();
            const isVisible = text.includes(keyword);
            row.style.display = isVisible ? '' : 'none';
            if(isVisible) found = true;
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>