<?php
// =============================================
// Konfigurasi Dasar Website PSAT Sidoarjo
// =============================================

// Informasi Koneksi Database
$host     = "localhost";       // Nama host (biasanya localhost)
$user     = "root";            // Username database
$pass     = "";                // Password database
$db       = "psat_sidoarjo";   // Nama database

// Koneksi ke Database
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// =============================================
// Konfigurasi Umum Website
// =============================================

// Nama dan informasi situs
define("SITE_NAME", "PSAT Kabupaten Sidoarjo");
define("SITE_URL", "http://localhost/PSAT-SIDOARJO/");
define("SITE_EMAIL", "psat.sidoarjo@gmail.com");

// =============================================
// Konfigurasi Email Notifikasi (Gmail SMTP)
// =============================================
// Gunakan jika kamu ingin kirim email notifikasi otomatis
define("SMTP_HOST", "smtp.gmail.com");
define("SMTP_PORT", 587);
define("SMTP_USER", "psat.sidoarjo@gmail.com");     // Email pengirim
define("SMTP_PASS", "app_password_kamu");           // Gunakan App Password Gmail

// =============================================
// Konfigurasi WhatsApp Gateway (Opsional)
// =============================================
// Contoh untuk API Fonnte atau Wablas
define("WA_API_URL", "https://api.fonnte.com/send");
define("WA_API_TOKEN", "YOUR_WA_TOKEN_HERE");

// =============================================
// Pengaturan Zona Waktu
// =============================================
date_default_timezone_set("Asia/Jakarta");

// =============================================
// Fungsi Dasar yang Sering Dipakai
// =============================================

// Fungsi kirim notifikasi via WhatsApp
function sendWhatsapp($nomor, $pesan) {
    if (empty(WA_API_TOKEN) || empty(WA_API_URL)) return false;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => WA_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $nomor,
            'message' => $pesan,
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: " . WA_API_TOKEN
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Fungsi kirim email sederhana
function sendEmail($to, $subject, $body) {
    $headers  = "From: " . SITE_EMAIL . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $body, $headers);
}
?>
