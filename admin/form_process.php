<?php
include "../includes/config.php";
include "../includes/function.php";
include 'auth_check.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ===============================
    // AMBIL DATA FORM (Gunakan mysqli_real_escape_string untuk keamanan)
    // ===============================
    $jenis_registrasi  = mysqli_real_escape_string($conn, $_POST['jenis_registrasi']);
    $nomor_registrasi  = mysqli_real_escape_string($conn, $_POST['nomor_registrasi']);
    $nama_unit         = mysqli_real_escape_string($conn, $_POST['nama_unit']);
    $alamat_unit       = mysqli_real_escape_string($conn, $_POST['alamat_unit']);
    $telepon           = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email             = mysqli_real_escape_string($conn, $_POST['email']);
    $kabupaten         = mysqli_real_escape_string($conn, $_POST['kabupaten']);
    $kecamatan         = mysqli_real_escape_string($conn, $_POST['kecamatan']);
    $alamat_penanganan = mysqli_real_escape_string($conn, $_POST['alamat_penanganan']);
    $nama_ilmiah       = mysqli_real_escape_string($conn, $_POST['nama_ilmiah']);
    $nama_komoditas     = mysqli_real_escape_string($conn, $_POST['nama_komoditas']);
    $jenis_psat        = mysqli_real_escape_string($conn, $_POST['jenis_psat']);
    $klaim             = mysqli_real_escape_string($conn, $_POST['klaim']);
    $kemasan_berat     = mysqli_real_escape_string($conn, $_POST['kemasan_berat']);
    $label             = mysqli_real_escape_string($conn, $_POST['label']);
    
    // Penanganan Tanggal agar tidak error jika kosong
    $tgl_terbit   = !empty($_POST['tgl_terbit']) ? "'" . mysqli_real_escape_string($conn, $_POST['tgl_terbit']) . "'" : "NULL";
    $tgl_berakhir = !empty($_POST['tgl_berakhir']) ? "'" . mysqli_real_escape_string($conn, $_POST['tgl_berakhir']) . "'" : "NULL";

    // ===============================
    // UPLOAD FILE
    // ===============================

    // Sertifikat PDF
    $file_sertifikat = null;
    if (!empty($_FILES['file_sertifikat']['name'])) {
        $file_sertifikat = uploadFile(
            $_FILES['file_sertifikat'],
            "../uploads/sertifikat", // Tambahkan ../ jika folder uploads di luar folder admin
            ['pdf']
        );
    }

    // Foto kemasan (MULTIPLE)
    $foto_kemasan = null;
    if (!empty($_FILES['foto_kemasan']['name'][0])) {
        $uploadedFotos = uploadMultipleFiles(
            $_FILES['foto_kemasan'],
            "../uploads/kemasan",
            ['jpg','jpeg','png']
        );
        // simpan sebagai JSON string
        $foto_kemasan = json_encode($uploadedFotos);
    }

    // ===============================
    // INSERT DATABASE
    // ===============================
    $sql_file_sertifikat = $file_sertifikat ? "'$file_sertifikat'" : "NULL";
    $sql_foto_kemasan    = $foto_kemasan ? "'$foto_kemasan'" : "NULL";

    $query = "INSERT INTO registrasi_psat (
                jenis_registrasi, nomor_registrasi, nama_unit, alamat_unit, 
                telepon, email, kabupaten, kecamatan, alamat_penanganan, 
                nama_ilmiah, nama_komoditas, jenis_psat, klaim, 
                kemasan_berat, label, tgl_terbit, tgl_berakhir, 
                file_sertifikat, foto_kemasan
            ) VALUES (
                '$jenis_registrasi', '$nomor_registrasi', '$nama_unit', '$alamat_unit', 
                '$telepon', '$email', '$kabupaten', '$kecamatan', '$alamat_penanganan', 
                '$nama_ilmiah', '$nama_komoditas', '$jenis_psat', '$klaim', 
                '$kemasan_berat', '$label', $tgl_terbit, $tgl_berakhir, 
                $sql_file_sertifikat, $sql_foto_kemasan
            )";

    if (mysqli_query($conn, $query)) {
        header("Location: data.php?status=sukses");
        exit;
    } else {
        die("Error: " . mysqli_error($conn));
    }
}