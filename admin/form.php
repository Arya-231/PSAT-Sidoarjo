<?php
$css_file = "admin.css";
$title = "Formulir Registrasi";
include "header.php";
include "sidebar.php";
?>

<div class="content-wrapper">

  <div class="card shadow-sm p-4">

    <h5 class="section-title mb-4">Tambah Data Registrasi</h5>

    <form method="POST" action="form_process.php" enctype="multipart/form-data">

      <!-- Row 1 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Jenis Registrasi</label>
          <input type="text" name="jenis_registrasi" class="form-control bg-light" value="Registrasi PDUK" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nomor Registrasi</label>
          <input type="text" name="nomor_registrasi" class="form-control" placeholder="Nomor Registrasi">
        </div>
      </div>

      <!-- Row 2 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Nama Unit Usaha</label>
          <input type="text" name="nama_unit" class="form-control" placeholder="Nama Unit Usaha">
        </div>

        <div class="col-md-6">
          <label class="form-label">Alamat Unit Usaha</label>
          <input type="text" name="alamat_unit" class="form-control" placeholder="Alamat Unit Usaha">
        </div>
      </div>

      <!-- Row 3 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Nomor Telepon Unit Usaha</label>
          <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon">
        </div>

        <div class="col-md-6">
          <label class="form-label">Email Unit Usaha</label>
          <input type="text" name="email" class="form-control" placeholder="Email Unit Usaha">
        </div>
      </div>

      <!-- Row 4 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Kabupaten/Kota</label>
          <input type="text" name="kabupaten" class="form-control bg-light" value="KAB. SIDOARJO" readonly>
        </div>

        <div class="col-md-6">
          <label class="form-label">Kecamatan</label>
          <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan">
        </div>
      </div>

      <!-- Row 5 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Alamat Unit Penanganan</label>
          <input type="text" name="alamat_penanganan" class="form-control" placeholder="Alamat Unit Penanganan">
        </div>

        <div class="col-md-6">
          <label class="form-label">Nama Ilmiah</label>
          <input type="text" name="nama_ilmiah" class="form-control" placeholder="contoh: Amorphophallus muelleri">
        </div>
      </div>

      <!-- Komoditas -->
      <div class="mb-3">
        <label class="form-label">Nama Komoditas</label>
        <input type="text" name="nama_komoditas" class="form-control" placeholder="Nama Komoditas">
      </div>

      <!-- Nama Dagang / Merek -->
      <div class="mb-3">
        <label class="form-label">Nama Dagang / Merek</label>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_merek" value="teks" checked>
          <label class="form-check-label">Nama (teks)</label>
        </div>

        <input type="text" name="nama_merek" class="form-control mb-2" placeholder="Nama (teks)">

        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_merek" value="logo">
          <label class="form-check-label">Logo (.jpg/.png)</label>
        </div>

        <input type="file" name="file_logo" class="form-control mt-2" accept=".jpg,.jpeg,.png">
      </div>

      <!-- Row 6 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Jenis PSAT</label>
          <input type="text" name="jenis_psat" class="form-control" placeholder="Isi sesuai lampiran teknis">
        </div>

        <div class="col-md-6">
          <label class="form-label">Klaim</label>
          <select class="form-select" name="klaim">
            <option value="">Pilih Klaim</option>
            <option value="klaim_gizi">Klaim Gizi</option>
            <option value="klaim_kesehatan">Klaim Kesehatan</option>
            <option value="klaim_fortifikasi">Klaim Fortifikasi</option>
            <option value="halal">Halal</option>
            <option value="organik">Organik</option>
            <option value="kelas_mutu">Kelas Mutu</option>
            <option value="klaim_beras_khusus">Klaim Beras Khusus</option>
            <option value="tidak_ada_klaim">Tidak ada klaim</option>
          </select>
        </div>
      </div>

      <!-- Kemasan -->
      <div class="mb-3">
        <label class="form-label">Kemasan dan Berat Bersih</label>
        <input type="text" name="kemasan_berat" class="form-control" placeholder="cth: 10 kg, 5 plastik">
      </div>

      <!-- Label -->
      <div class="mb-3">
        <label class="form-label">Label (Hijau / Putih)</label>
        <select class="form-select" name="label">
          <option value="">Pilih</option>
          <option value="Hijau">Hijau</option>
          <option value="Putih">Putih</option>
        </select>
      </div>

      <!-- Tanggal -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Tanggal Penerbitan Sertifikat</label>
          <input type="date" name="tgl_terbit" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Berakhir Sertifikat</label>
          <input type="date" name="tgl_berakhir" class="form-control">
        </div>
      </div>

      <!-- File -->
      <div class="mb-3">
        <label class="form-label">File Sertifikat (.pdf)</label>
        <input type="file" name="file_sertifikat" class="form-control" accept=".pdf">
      </div>

      <div class="mb-3">
        <label class="form-label">Foto Kemasan (maks 3 file .jpg)</label>
        <input type="file" name="foto_kemasan[]" class="form-control" accept=".jpg,.jpeg,.png" multiple>
      </div>

      <button type="submit" class="btn btn-success px-4 mt-3">Simpan</button>

    </form>
  </div>

</div>

<?php include "footer.php"; ?>
