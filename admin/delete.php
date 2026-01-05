<?php
include "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: data.php");
    exit;
}

$id = intval($_GET['id']);

// ambil data foto dulu
$q = mysqli_query($conn, "SELECT foto_kemasan FROM registrasi_psat WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if ($data && !empty($data['foto_kemasan'])) {
    $file = "../uploads/kemasan/".$data['foto_kemasan'];
    if (file_exists($file)) unlink($file);
}

// hapus data
mysqli_query($conn, "DELETE FROM registrasi_psat WHERE id=$id");

header("Location: data.php");
exit;
