<?php
// KONFIGURASI GAMBAR
$banner     = "banner.jpg";        // gambar besar atas
$logoFooter = "logo-dinas.png";    // logo di footer

$iconLokasi = "lokasi.png";
$iconEmail  = "email.png";
$iconWA     = "wa.png";
$iconJam    = "jam.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontak Resmi</title>

<style>
    body {
        margin: 0;
        background: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .wrapper {
        max-width: 900px;
        margin: 20px auto 50px auto;
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Banner seperti gambar */
    .banner {
        width: 100%;
        height: 220px;
        overflow: hidden;
    }

    .banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Judul putih di tengah seperti gambar */
    .judul {
        text-align: center;
        margin-top: -55px;
        color: white;
        font-size: 28px;
        font-weight: bold;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    }

    .content {
        padding: 30px 40px;
    }

    /* Setiap baris info */
    .row {
        display: flex;
        align-items: start;
        margin-bottom: 18px;
        font-size: 18px;
        color: #333;
    }

    .row img {
        width: 26px;
        margin-right: 15px;
        margin-top: 3px;
    }

    .footer {
        background: #0A8A47;
        color: white;
        padding: 30px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .footer img {
        width: 70px;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="wrapper">

    <!-- Banner -->
    <div class="banner">
        <img src="<?php echo $banner; ?>" alt="Banner">
    </div>

    <!-- Judul putih seperti gambar -->
    <div class="judul">Saluran Komunikasi Resmi</div>

    <div class="content">

        <div class="row">
            <img src="<?php echo $iconLokasi; ?>">
            Jl. Pahlawan No.KM.2, Jetis, Lemahputro, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213
        </div>

        <div class="row">
            <img src="<?php echo $iconEmail; ?>">
            panpperta@gmail.com
        </div>

        <div class="row">
            <img src="<?php echo $iconWA; ?>">
            0825478961358
        </div>

        <div class="row">
            <img src="<?php echo $iconJam; ?>">
            08.00 – 16.00 WIB
        </div>

    </div>

    <div class="footer">
        <img src="<?php echo $logoFooter; ?>" alt="Logo">
        Dinas Ketahanan Pangan dan Pertanian Kabupaten Sidoarjo
    </div>

</div>

</body>
</html>
