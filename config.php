<?php
// untuk menghubungkan database
$servername = "database";
$username = "lamp";
$password = "lamp";
$dbname = "lamp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
