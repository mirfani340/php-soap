<?php
require_once 'vendor/autoload.php';

// Create NuSOAP client
$client = new nusoap_client('http://localhost:32772/nusoap_server.php?wsdl', true);

// jika tombol daftar ditekan, ambil data dari form dan simpan ke database
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $semester = $_POST['semester'];
    $jenis_matakuliah = $_POST['jenis_matakuliah'];
    $berkas = $_FILES['berkas']['name'];
    $status_ajuan = "belum di verifikasi";

    //folder tujuan upload file
    $target_dir = "uploads/";

    // nama file yang diupload beserta path-nya
    $target_file = $target_dir . basename($_FILES["berkas"]["name"]);

    // ekstensi file yang diupload
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //  simpan file ke folder tujuan upload
    move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file);

    // Prepare data to be sent to the NuSOAP server
    $params = array(
        'name' => $nama,
        'email' => $email,
        'hp' => $hp,
        'semester' => $semester,
        'jenis_matakuliah' => $jenis_matakuliah,
        'berkas' => $berkas,
        'status_ajuan' => $status_ajuan
    );

    // Call the NuSOAP server's getData method
    $result = $client->call('getData', $params);

    // Check if the NuSOAP call was successful
    if ($client->fault) {
        // Handle NuSOAP error
        $error = 'NuSOAP Error: ' . $client->faultstring;
        echo $error;
    } else {
        // Check if there was an error in the NuSOAP response
        $err = $client->getError();
        if ($err) {
            // Handle NuSOAP response error
            $error = 'NuSOAP Response Error: ' . $err;
            echo $error;
        } else {
            // NuSOAP call was successful, you can use the $result data
            // Capture the email from the form submission
            $email = $_POST['email'];
            // Rest of your code...
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Pendaftaran Beasiswa</title>
    <link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container">
            <a class="navbar-brand" href="index.php">PKM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{($active === " home ") ? 'active' : ''}} " href="index.php">Home</a>
                    <a class="nav-link {{($active === " daftar ") ? 'active' : ''}} " href="form.php">Daftar KRS</a>
                    <a class="nav-link {{($active === " pendaftar ") ? 'active' : ''}} " href="hasil.php">Pendaftar</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <div class="row">
        <div class="col-md-5">
            <img src="img/success.png" alt="" class="img-fluid">
        </div>
        <div class="col-md mt-5">
            <h3 class="mt-5">Data Anda Berhasil Disimpan </h3>
            <p class="text-justify">
                Untuk melihat data, dan status pengecekan beasiswa anda, klik tombol <a href="hasil.php"><b>Hasil</b></a>
            </p>

        </div>
    </div>
</body>

</html>