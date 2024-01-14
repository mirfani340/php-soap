<?php
require_once 'config.php';

// Membuat query untuk mengambil nilai email, hp, semester, dan status_bayar_bpp dari tabel pendaftar di database berdasarkan nama yang diterima dari file JavaScript.
$query = "SELECT nama FROM mata_kuliah";

// Menjalankan query pada database menggunakan koneksi database yang dibuat sebelumnya. Hasil dari query disimpan di variabel $result.
$result = mysqli_query($conn, $query);

$names = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $names[] = $row["nama"];
    }
}

mysqli_close($conn);

// Return names as JSON
echo json_encode($names);
?>