<?php
$servername = "localhost";
$username = "root"; // sesuaikan dengan username MySQL Anda
$password = ""; // sesuaikan dengan password MySQL Anda
$dbname = "sensor_data";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi variabel untuk menyimpan nilai POST
$analog_value = isset($_POST['analogValue']) ? $_POST['analogValue'] : null;
$voltage = isset($_POST['voltage']) ? $_POST['voltage'] : null;
$resistance = isset($_POST['resistance']) ? $_POST['resistance'] : null;
$ppm = isset($_POST['ppm']) ? $_POST['ppm'] : null;

// Cek apakah semua variabel POST ada
if ($analog_value !== null && $voltage !== null && $resistance !== null && $ppm !== null) {
    // Query untuk menyimpan data
    $sql = "INSERT INTO mq137_readings (analog_value, voltage, resistance, ppm) VALUES ('$analog_value', '$voltage', '$resistance', '$ppm')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Missing data. Please ensure all fields are sent.";
}

// Tutup koneksi
$conn->close();
?>
