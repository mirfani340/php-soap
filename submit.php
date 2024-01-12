<?php
require_once 'config.php';
require 'vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// jika tombol daftar ditekan, ambil data dari form dan simpan ke database
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $mata_kuliah = $_POST['mata_kuliah'];
    $berkas = $_FILES['berkas']['name'];
    $status_ajuan = "pending";

    $queryNIM = "SELECT id FROM mahasiswa WHERE nama='$nama'";

    //jalankan query dan simpan hasilnya
    $resultyNIM = mysqli_query($conn, $queryNIM);
    $nim = mysqli_fetch_assoc($resultyNIM)['id'];

    //folder tujuan upload file
    $target_dir = "uploads/";

    // nama file yang diupload beserta path-nya
    $target_file = $target_dir . basename($_FILES["berkas"]["name"]);

    // ekstensi file yang diupload
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //  simpan file ke folder tujuan upload
    move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file);

    //  query untuk memasukkan data ke database
    $query = "INSERT INTO krs (mata_kuliah, berkas, status_ajuan, mahasiswa_id) 
              VALUES ('$mata_kuliah', '$berkas', '$status_ajuan', '$nim')";

    //jalankan query dan simpan hasilnya
    $result = mysqli_query($conn, $query);
}

mysqli_close($conn);
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{($active === "daftar") ? 'active' : ''}} " href="index.php">Registrasi KRS</a>
                    <a class="nav-link {{($active === "pendaftar") ? 'active' : ''}} " href="daftar_mahasiswa.php">Daftar Mahasiswa</a>
                    <a class="nav-link {{($active === "pendaftar") ? 'active' : ''}} " href="hasil.php">KRS</a>
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