<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        // Query untuk memasukkan data ke dalam tabel peserta
        $sql = "INSERT INTO peserta (nama, sekolah, jurusan, no_hp, alamat) VALUES ('$nama', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

        // Menjalankan query
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
        if ($hasil) {
            header("Location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>

    <h2>Input Data Peserta</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required />
        </div>

        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Nama Sekolah" required />
        </div>

        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required />
        </div>

        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No HP" required />
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukkan Alamat" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>
