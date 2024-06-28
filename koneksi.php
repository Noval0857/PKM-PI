<?php
// Mengatur informasi koneksi
$servername = "localhost"; // Nama host, biasanya "localhost"
$username = "root"; // Nama pengguna MySQL Anda
$password = ""; // Kata sandi MySQL Anda
$dbname = "sensor_data"; // Nama basis data yang akan dihubungkan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} 
?>
