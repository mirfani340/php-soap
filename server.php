<?php
require_once 'vendor/autoload.php';

// Inisialisasi server
$server = new nusoap_server();

// Konfigurasi WSDL
$namespace = 'http://localhost/php-soap';
$server->configureWSDL('SistemRegistrasi', $namespace);

// Registrasi operasi
$server->register(
    'checkPaymentStatus',    // Nama operasi
    array('nim' => 'xsd:string'), // Parameter input
    array('return' => 'xsd:boolean'), // Tipe data kembalian
    $namespace,              // Namespace
    false,                   // SoapAction
    'rpc',                   // Style
    'encoded',               // Encoding
    'Check payment status'   // Dokumentasi
);

// Operasi untuk memeriksa status pembayaran
function checkPaymentStatus($nim) {
    // Logika bisnis untuk memeriksa status pembayaran
    // Implementasikan logika sesuai dengan kebutuhan
    // Return true jika sudah bayar, false jika belum
    return true; // Contoh sederhana, selalu mengembalikan true
}

// Proses permintaan web service
$rawPostData = file_get_contents("php://input");
$server->service($rawPostData);
?>
