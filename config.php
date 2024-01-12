<?php
// untuk menghubungkan database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_soap";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
