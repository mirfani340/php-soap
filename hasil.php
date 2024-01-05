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
                    <a class="nav-link {{($active === " daftar ") ? 'active' : ''}} " href="form.php">Daftar</a>
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
                    <th>Jenis Beasiswa</th>
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
                        <td><?php echo $row['jenis_beasiswa']; ?></td>
                        <td><?php echo $row['berkas']; ?></td>
                        <td><?php echo $row['status_ajuan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>


        </table>
        <button><a href="index.php">Back</a></button>
    </div>

    <h4 class="text-center mt-5">Grafik Data Peminatan</h4>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <canvas id="myChart" width="400" height="400"></canvas>
        <script>
            // Mengambil data dari database
            <?php
            // membuat koneksi database
            $conn = mysqli_connect('database', 'lamp', 'lamp', 'lamp');
            // membuat query untuk mengambil data jenis_beasiswa dan jumlah pendaftar
            $query = mysqli_query($conn, "SELECT jenis_beasiswa, COUNT(*) AS jumlah FROM pendaftar GROUP BY jenis_beasiswa");
            // menyimpan hasil query dalam bentuk array
            $data = array();
            // melakukan perulangan untuk memasukkan data ke dalam array
            while ($row = mysqli_fetch_assoc($query)) {
                $jenis_beasiswa = '';
                // mengubah kode jenis beasiswa menjadi nama jenis beasiswa
                if ($row['jenis_beasiswa'] == 'A') {
                    $jenis_beasiswa = 'Beasiswa Akademik';
                } else if ($row['jenis_beasiswa'] == 'B') {
                    $jenis_beasiswa = 'Beasiswa Non-Akademik';
                } else if ($row['jenis_beasiswa'] == 'C') {
                    $jenis_beasiswa = 'Beasiswa Internasional';
                }
                // menambahkan data ke dalam array
                $data[] = array(
                    'jenis_beasiswa' => $jenis_beasiswa,
                    'jumlah' => $row['jumlah'],
                );
            }
            ?>

            // Menyiapkan data untuk grafik lingkaran
            // membuat objek data untuk grafik lingkaran
            var data = {
                // menambahkan label dari jenis beasiswa pada objek data menggunakan json_encode
                labels: <?php echo json_encode(array_column($data, 'jenis_beasiswa')); ?>,
                // menambahkan data jumlah pendaftar pada objek data menggunakan json_encode
                datasets: [{
                    data: <?php echo json_encode(array_column($data, 'jumlah')); ?>,
                    // menambahkan warna pada setiap bagian grafik lingkaran
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                    ],
                }, ],
            };

            // Membuat grafik lingkaran
            // memilih element HTML tempat grafik akan ditampilkan
            var ctx = document.getElementById('myChart').getContext('2d');
            // membuat objek Chart dan menambahkan data dan option
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    // menambahkan judul pada grafik
                    title: {
                        display: true,
                        text: 'Persentase Peminatan Beasiswa',
                    },
                    // menonaktifkan responsif pada grafik
                    responsive: false,
                    // menonaktifkan pengaturan rasio aspek pada grafik
                    maintainAspectRatio: false,
                    // mengatur padding pada grafik
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        </script>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>