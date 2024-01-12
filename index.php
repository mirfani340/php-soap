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

    <!-- form pendaftaran -->
    <div class="container">
        <h2 class="text-center mt-5 mb-5">Form Pendaftaran KRS</h2>
        <form action="submit.php" method="post" enctype="multipart/form-data" class="mb-5">

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Masukkan Nama</label>
                <div class="col-sm-10">
                    <select class="form-control" id="nama" name="nama" required>
                        <option value="">-- Pilih nama mahasiswa --</option>
                    </select>
                    <!-- <input type="text" class="form-control" id="nama" name="nama" required> -->
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
                <label for="status_bayar_bpp" class="col-sm-2 col-form-label">Status Pembayaran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="status_bayar_bpp" name="status_bayar_bpp" value="" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="mata_kuliah" class="col-sm-2 col-form-label">Mata Kuliah</label>
                <div class="col-sm-10">
                    <select class="form-control" id="mata_kuliah" name="mata_kuliah" required>
                        <option value="">-- Mata Kuliah --</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="berkas" class="col-sm-2 col-form-label">Upload Berkas Syarat</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="berkas" name="berkas" accept=".pdf" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="daftar" id="daftar">Registrasi KRS</button>
            <button type="reset" class="btn btn-danger" name="batal" id="batal">Batal</button>
        </form>
    </div>
    <!-- end form pendaftaran -->

    <script>
    // Script dijalankan saat halaman sudah siap ditampilkan.
    $(document).ready(function () {
        // Disable all fields except 'nama' on initial load
        $('#email, #hp, #semester, #status_bayar_bpp, #mata_kuliah, #berkas, #daftar').prop('disabled', true);

        $.ajax({
            url: 'get_names.php',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // Populate the dropdown with fetched names
                var select = $('#nama');
                $.each(response, function (index, value) {
                    select.append($('<option>', {
                        value: value,
                        text: value
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        $.ajax({
            url: 'get_matakuliah.php',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // Populate the dropdown with fetched names
                var select = $('#mata_kuliah');
                $.each(response, function (index, value) {
                    select.append($('<option>', {
                        value: value,
                        text: value
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        // Menangani input dari user pada elemen dengan id 'nama' ketika terjadi event 'input'
        $('#nama').on('input', function () {

            // Mengambil nilai input dari elemen dengan id 'nama' yang diinputkan oleh user.
            var nama = $(this).val();

            // Check if the selected option is '-- Pilih nama mahasiswa --'
            if (nama === '') {
                // If it is, disable all remaining fields and clear their values
                $('#email, #hp, #semester, #status_bayar_bpp, #mata_kuliah, #berkas, #daftar').prop('disabled', true).val('');
            } else {
                // If not, enable all remaining fields
                $('#email, #hp, #semester, #status_bayar_bpp, #mata_kuliah, #berkas, #daftar').prop('disabled', false);

                // Melakukan ajax request ke server menggunakan fungsi ajax() dengan mengirim data berupa nama yang diinputkan oleh user pada form pendaftaran.
                $.ajax({
                    url: 'get_status_bayar.php',
                    type: 'post',
                    data: {
                        nama: nama
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response); // Log the response to the console for debugging

                        // Verify that the properties are accessible
                        console.log(response.email);
                        console.log(response.hp);
                        console.log(response.semester);
                        console.log(response.status_bayar_bpp);

                        // Set the values to the new fields
                        $('#email').val(response.email);
                        $('#hp').val(response.hp);
                        $('#semester').val(response.semester);
                        $('#status_bayar_bpp').val(response.status_bayar_bpp);

                        // Disable/enable other fields based on the status
                        if (response.status_bayar_bpp == 'Belum Bayar') {
                            $('#mata_kuliah, #berkas, #daftar').prop('disabled', true);
                        } else {
                            $('#mata_kuliah, #berkas, #daftar').prop('disabled', false);
                        }
                    }
                });
            }
        });

        // Jangan perlu menangani perubahan nilai pada elemen '#status_bayar_bpp', karena nilainya sudah diatur oleh PHP dan tidak boleh diubah oleh user.
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