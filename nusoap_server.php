<?php
require 'vendor/autoload.php';

$server = new soap_server();
$server->configureWSDL('PKMWebService', 'urn:PKMWebService');

// Change the parameters to match the ones sent from submit.php
$server->register('getData', 
    array(
        'name' => 'xsd:string',
        'email' => 'xsd:string',
        'hp' => 'xsd:string',
        'semester' => 'xsd:string',
        'jenis_matakuliah' => 'xsd:string',
        'berkas' => 'xsd:string',
        'status_ajuan' => 'xsd:string',
        'status_bayar' => 'xsd:string'
    ),
    array('return' => 'xsd:string'),
    'urn:PKMWebService',
    'urn:PKMWebService#getData'
);

function getData($name, $email, $hp, $semester, $jenis_matakuliah, $berkas, $status_ajuan) {
    require_once 'config.php';
    
    // Your CRUD logic using NuSOAP goes here
    // For example, retrieve data based on the name
    $query = "SELECT * FROM pendaftar WHERE nama = '$name'";
    $result = mysqli_query($conn, $query);
    
    // Process the $result and return data as a string
    $data = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $data .= "Nama: " . $row['nama'] . "\n";
        // Add other fields as needed
    }

    return $data;
}

$server->service(file_get_contents("php://input"));
?>
