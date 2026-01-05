<?php
include "../includes/config.php";
include "../includes/function.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ===============================
    // AMBIL DATA FORM
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
    $nama_komoditas    = mysqli_real_escape_string($conn, $_POST['nama_komoditas']);
    $jenis_psat        = mysqli_real_escape_string($conn, $_POST['jenis_psat']);
    $klaim             = mysqli_real_escape_string($conn, $_POST['klaim']);
    $kemasan_berat     = mysqli_real_escape_string($conn, $_POST['kemasan_berat']);
    $label             = mysqli_real_escape_string($conn, $_POST['label']);
    $tgl_terbit        = $_POST['tgl_terbit'];
    $tgl_berakhir      = $_POST['tgl_berakhir'];

    // ===============================
    // UPLOAD FILE
    // ===============================

    // Sertifikat PDF
    $file_sertifikat = null;
    if (!empty($_FILES['file_sertifikat']['name'])) {
        $file_sertifikat = uploadFile(
            $_FILES['file_sertifikat'],
            "uploads/sertifikat",
            ['pdf']
        );
    }

    // Foto kemasan (MULTIPLE)
    $foto_kemasan = null;
    if (!empty($_FILES['foto_kemasan']['name'][0])) {
        $uploadedFotos = uploadMultipleFiles(
            $_FILES['foto_kemasan'],
            "uploads/kemasan",
            ['jpg','jpeg','png']
        );
        // simpan sebagai JSON
        $foto_kemasan = json_encode($uploadedFotos);
    }

    // ===============================
    // INSERT DATABASE
    // ===============================
    $query = "
        INSERT INTO registrasi_psat (
            jenis_registrasi,
            nomor_registrasi,
            nama_unit,
            alamat_unit,
            telepon,
            email,
            kabupaten,
            kecamatan,
            alamat_penanganan,
            nama_ilmiah,
            nama_komoditas,
            jenis_psat,
            klaim,
            kemasan_berat,
            label,
            tgl_terbit,
            tgl_berakhir,
            file_sertifikat,
            foto_kemasan,
            created_at
        ) VALUES (
            '$jenis_registrasi',
            '$nomor_registrasi',
            '$nama_unit',
            '$alamat_unit',
            '$telepon',
            '$email',
            '$kabupaten',
            '$kecamatan',
            '$alamat_penanganan',
            '$nama_ilmiah',
            '$nama_komoditas',
            '$jenis_psat',
            '$klaim',
            '$kemasan_berat',
            '$label',
            '$tgl_terbit',
            '$tgl_berakhir',
            " . ($file_sertifikat ? "'$file_sertifikat'" : "NULL") . ",
            " . ($foto_kemasan ? "'$foto_kemasan'" : "NULL") . ",
            NOW()
        )
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    header("Location: data.php?status=sukses");
    exit;
}
