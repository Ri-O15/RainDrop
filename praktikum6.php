<?php
var_dump($_GET);

$servername = "localhost";
$username = "root";
$password = "@Ayambebek21";
$dbname = "uap_pirdas";

// Periksa apakah parameter sudah diatur
if (isset($_GET["sensor_cahaya"], $_GET["sensor_rain"], $_GET["led"], $_GET["servo"])) {
    $sensor_cahaya = $_GET["sensor_cahaya"];
    $sensor_rain = $_GET["sensor_rain"];
    $led = $_GET["led"];
    $servo = $_GET["servo"];
    
} else {
    // Tangani kasus ketika beberapa parameter tidak diatur
    echo "Error: Beberapa parameter tidak diisi.";
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "INSERT INTO uap(sensor_cahaya, sensor_rain, led, servo) VALUES (" . $sensor_cahaya . ", " . $sensor_rain . ", '" . $led . "', '" . $servo . "')";

if ($conn->query($sql) === TRUE) {
    echo "Data Ldr Value berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
exit();
?>
