<?php
require_once 'vendor/autoload.php';

// Inisialisasi client
$client = new nusoap_client('http://localhost/php-soap/server.php?wsdl', true);

// Check for errors
$err = $client->getError();
if ($err) {
    echo 'Error: ' . $err;
    exit();
}

// Memanggil operasi untuk memeriksa status pembayaran
$nim = '20104037'; // Ganti dengan NIM mahasiswa yang ingin dicek
$result = $client->call('checkPaymentStatus', array('nim' => $nim));

// Menampilkan hasil
if ($client->fault) {
    echo 'Fault: ';
    print_r($result);
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        echo 'Error: ' . $err;
    } else {
        // Display the result
        if ($result) {
            echo "Mahasiswa dengan NIM $nim sudah melakukan pembayaran.";
        } else {
            echo "Mahasiswa dengan NIM $nim belum melakukan pembayaran.";
        }
    }
}
?>
