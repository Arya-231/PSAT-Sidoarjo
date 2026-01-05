<?php
include "../includes/config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: data.php");
    exit;
}

$id = intval($_POST['id']);

$nama_unit = $_POST['nama_unit'];
$nama_komoditas = $_POST['nama_komoditas'];
$jenis_psat = $_POST['jenis_psat'];
$kemasan_berat = $_POST['kemasan_berat'];
$label = $_POST['label'];
$tgl_berakhir = $_POST['tgl_berakhir'];

// upload foto kemasan (opsional)
$foto_sql = "";
if (!empty($_FILES['foto_kemasan']['name'])) {
    $folder = "../uploads/kemasan/";
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $nama_file = time().'_'.$_FILES['foto_kemasan']['name'];
    move_uploaded_file($_FILES['foto_kemasan']['tmp_name'], $folder.$nama_file);

    $foto_sql = ", foto_kemasan='$nama_file'";
}

mysqli_query($conn, "
    UPDATE registrasi_psat SET
    nama_unit='$nama_unit',
    nama_komoditas='$nama_komoditas',
    jenis_psat='$jenis_psat',
    kemasan_berat='$kemasan_berat',
    label='$label',
    tgl_berakhir='$tgl_berakhir'
    $foto_sql
    WHERE id=$id
");

header("Location: data.php");
exit;
