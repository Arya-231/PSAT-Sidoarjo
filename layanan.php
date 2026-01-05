<?php
$title = "Layanan";
$custom_css = "layanan.css";

include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';

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

  <!-- ================= UJI LAB ================= -->
  <div class="layanan-section">
    <h3>Uji Laboratorium</h3>
    <p class="section-desc">
      Dinas Pangan dan Pertanian Kabupaten Sidoarjo menyediakan layanan pengujian keamanan pangan.
    </p>

    <div class="cards">
      <div class="card"><h4>Uji Residu Pestisida</h4><p>Mendeteksi residu pestisida.</p></div>
      <div class="card"><h4>Uji Logam Berat</h4><p>Analisis Pb, Hg, Cd.</p></div>
      <div class="card"><h4>Uji Mikrobiologi</h4><p>Deteksi mikroba.</p></div>
      <div class="card"><h4>Uji Kimia</h4><p>pH & kadar air.</p></div>
    </div>
  </div>

  <!-- ================= CEK STATUS ================= -->
  <div class="layanan-section">
    <h3>Cek Status Registrasi PSAT</h3>
    <p class="section-desc">
      Masukkan nama produk atau usaha untuk melihat status registrasi PSAT Anda.
    </p>

    <div class="search-box">
      <input 
        type="text" 
        id="searchInput" 
        placeholder="Cari nama produk atau nama usaha..."
      >
      <button type="button">Cari</button>
    </div>

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
        <?php while ($row = mysqli_fetch_assoc($q)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['nama_komoditas']) ?></td>
            <td><?= htmlspecialchars($row['nama_unit']) ?></td>
            <td>
              <span class="badge badge-<?= htmlspecialchars($row['status']) ?>">
                <?= ucfirst($row['status']) ?>
              </span>
            </td>
            <td><?= date('d-m-Y', strtotime($row['tgl_terbit'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>
</div>

<!-- ================= SEARCH SCRIPT ================= -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('#psatTable tbody tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
