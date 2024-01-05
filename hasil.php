<?php
require_once 'config.php'; // mengimpor konfigurasi koneksi database

$query = "SELECT * FROM pendaftar"; // menyimpan query untuk mengambil seluruh data pendaftar
$result = mysqli_query($conn, $query); // mengeksekusi query dan menyimpan hasilnya pada variabel $result
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pendaftaran Masuk</title>
    <link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                    <a class="nav-link {{($active === "pendaftar") ? 'active' : ''}} " href="hasil.php">Pendaftar</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Hasil Pendaftaran</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Semester</th>
                    <th>Status Bayar</th>
                    <th>Jenis Matakuliah</th>
                    <th>Berkas</th>
                    <th>Status Ajuan</th>
                </tr>
            </thead>

            <tbody>

                <!-- mengambil data secara berulang dari variabel $result hingga data yang tersedia habis. -->
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <!-- akan ditampilkan data dalam bentuk tabel dengan menggunakan tag <tr> untuk setiap baris data, dan tag <td> untuk setiap kolom data yang diambil dari variabel $row sesuai dengan nama kolom di tabel database. 
                    Nilai dari setiap kolom data tersebut ditampilkan menggunakan fungsi echo untuk mencetak nilainya ke dalam HTML.
                     -->
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['hp']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo ($row['status_bayar'] == 0) ? 'Belum' : 'Sudah'; ?></td>
                        <td><?php echo $row['jenis_matakuliah']; ?></td>
                        <td><?php echo $row['berkas']; ?></td>
                        <td><?php echo $row['status_ajuan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>


        </table>
        <button><a href="index.php">Back</a></button>
    </div>
        </script>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>