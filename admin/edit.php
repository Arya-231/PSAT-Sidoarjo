<?php
$title = "Edit Data Registrasi";
$custom_css = "admin.css";

include "../includes/config.php";
include "header.php";
include "sidebar.php";

if (!isset($_GET['id'])) {
    echo "<p>Data tidak ditemukan</p>";
    exit;
}

$id = intval($_GET['id']);

$q = mysqli_query($conn, "SELECT * FROM registrasi_psat WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<p>Data tidak ditemukan</p>";
    exit;
}
?>

<div class="content-wrapper">
<div class="card shadow-sm p-4">

<h5 class="section-title mb-4">Edit Data Registrasi</h5>

<form method="POST" action="edit_process.php" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $data['id']; ?>">

<div class="mb-3">
    <label class="form-label">Nama Unit Usaha</label>
    <input type="text" name="nama_unit" class="form-control"
           value="<?= htmlspecialchars($data['nama_unit']); ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Nama Komoditas</label>
    <input type="text" name="nama_komoditas" class="form-control"
           value="<?= htmlspecialchars($data['nama_komoditas']); ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Jenis PSAT</label>
    <input type="text" name="jenis_psat" class="form-control"
           value="<?= htmlspecialchars($data['jenis_psat']); ?>">
</div>

<div class="mb-3">
    <label class="form-label">Kemasan & Berat</label>
    <input type="text" name="kemasan_berat" class="form-control"
           value="<?= htmlspecialchars($data['kemasan_berat']); ?>">
</div>

<div class="mb-3">
    <label class="form-label">Label</label>
    <select name="label" class="form-select">
        <option value="Hijau" <?= $data['label']=="Hijau"?'selected':'' ?>>Hijau</option>
        <option value="Putih" <?= $data['label']=="Putih"?'selected':'' ?>>Putih</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Berakhir</label>
    <input type="date" name="tgl_berakhir" class="form-control"
           value="<?= $data['tgl_berakhir']; ?>">
</div>

<div class="mb-3">
    <label class="form-label">Ganti Foto Kemasan</label>
    <input type="file" name="foto_kemasan" class="form-control">
</div>

<button type="submit" class="btn btn-success">Update</button>
<a href="data.php" class="btn btn-secondary">Batal</a>

</form>
</div>
</div>

<?php include "footer.php"; ?>
