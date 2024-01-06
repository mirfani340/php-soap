<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Beasiswa</title>
    <link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js">
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
                    <a class="nav-link {{($active === "pendaftar") ? 'active' : ''}} " href="hasil.php">Pendaftar</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- form pendaftaran -->
    <div class="container">
        <h2 class="text-center mt-5 mb-5">Form Pendaftaran KRS</h2>
        <form action="submit.php" method="post" enctype="multipart/form-data" class="mb-5">

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Masukkan Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Masukkan Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+\.[a-zA-Z]{2,}$" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hp" class="col-sm-2 col-form-label">No. HP</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="hp" name="hp" pattern="[0-9]+" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <select class="form-control" id="semester" name="semester" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>

            <!-- Status Pembayaran (Read-only indicator) -->
            <div class="mb-3 row">
                <label for="status_bayar" class="col-sm-2 col-form-label">Status Pembayaran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="status_bayar" name="status_bayar" value="<?php echo (isset($status_bayar) && $status_bayar === 0) ? 'Belum Bayar' : (($status_bayar === 1) ? 'Sudah Bayar' : 'Null'); ?>" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jenis_matakuliah" class="col-sm-2 col-form-label">Matakuliah</label>
                <div class="col-sm-10">
                    <select class="form-control" id="jenis_matakuliah" name="jenis_matakuliah" required>
                        <option value="">-- Pilih Jenis Matakuliah --</option>
                        <option value="A">DPW 1</option>
                        <option value="B">DPW 2</option>
                        <option value="C">Microservice</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="berkas" class="col-sm-2 col-form-label">Upload Berkas Syarat</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="berkas" name="berkas" accept=".pdf" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="daftar" id="daftar">Daftar KRS</button>
            <button type="reset" class="btn btn-danger" name="batal" id="batal">Batal</button>
        </form>
    </div>
    <!-- end form pendaftaran -->

    <script>
    // Script dijalankan saat halaman sudah siap ditampilkan.
    $(document).ready(function() {
        // Menangani input dari user pada elemen dengan id 'nama' ketika terjadi event 'input'
        $('#nama').on('input', function() {

            // Mengambil nilai input dari elemen dengan id 'nama' yang diinputkan oleh user.
            var nama = $(this).val();

            // Melakukan ajax request ke server menggunakan fungsi ajax() dengan mengirim data berupa nama yang diinputkan oleh user pada form pendaftaran.
            $.ajax({
                url: 'get_status_bayar.php',
                type: 'post',
                data: {
                    nama: nama
                },

                // Ketika ajax request sukses, script akan mengambil nilai ipk yang diterima dari server dan memasukkan nilai tersebut ke dalam elemen dengan id 'ipk'. Jika nilai ipk kurang dari 3, maka tombol 'jenis_matakuliah', 'berkas', dan 'daftar' akan dinonaktifkan dengan menggunakan fungsi prop(). Jika nilai ipk lebih atau sama dengan 3, maka tombol-tombol tersebut akan diaktifkan kembali.
                success: function(response) {
                    // Map the numeric value to text value
                    var statusText = (response == 0) ? 'Belum Bayar' : 'Sudah Bayar';
                    
                    // Set the text value to the #status_bayar field
                    $('#status_bayar').val(statusText);

                    // Disable/enable other fields based on the status
                    if (response == 0) {
                        $('#jenis_matakuliah').prop('disabled', true);
                        $('#berkas').prop('disabled', true);
                        $('#daftar').prop('disabled', true);
                    } else {
                        $('#jenis_matakuliah').prop('disabled', false);
                        $('#berkas').prop('disabled', false);
                        $('#daftar').prop('disabled', false);
                    }
                }
            });
        });
    });
</script>

</body>
<footer class="bg-light text-center text-lg-start fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright PKM
    </div>
    <!-- Copyright -->
</footer>

</html>