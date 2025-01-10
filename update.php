<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Anggota</title>
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

// Cek apakah ada nilai yang dikirim menggunakan metode GET dengan nama id_peserta
if (isset($_GET['id_peserta'])) {
    $id_peserta = input($_GET["id_peserta"]);

    // Query untuk mengambil data peserta berdasarkan id_peserta
    $sql = "SELECT * FROM peserta WHERE id_peserta = '$id_peserta'";
    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        $data = mysqli_fetch_assoc($hasil);
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
        exit;
    }
}

// Cek apakah ada kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil dan memproses data form
    $id_peserta = htmlspecialchars($_POST["id_peserta"]);
    $nama = input($_POST["nama"]);
    $sekolah = input($_POST["sekolah"]);
    $jurusan = input($_POST["jurusan"]);
    $no_hp = input($_POST["no_hp"]);
    $alamat = input($_POST["alamat"]);

    // Query update data pada tabel peserta
    $sql = "UPDATE peserta SET 
                nama = '$nama',
                sekolah = '$sekolah',
                jurusan = '$jurusan',
                no_hp = '$no_hp',
                alamat = '$alamat'
            WHERE id_peserta = '$id_peserta'";

    // Mengeksekusi atau menjalankan query di atas
    $hasil = mysqli_query($kon, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
    if ($hasil) {
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
    }
}

?>

<h2>Update Data</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <div class="form-group">
        <label>Nama: </label>
        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required />
    </div>

    <div class="form-group">
        <label>Sekolah:</label>
        <input type="text" name="sekolah" class="form-control" value="<?php echo $data['sekolah']; ?>" required />
    </div>

    <div class="form-group">
        <label>Jurusan: </label>
        <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan']; ?>" required />
    </div>

    <div class="form-group">
        <label>No HP:</label>
        <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>" required />
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea name="alamat" class="form-control" rows="5" required><?php echo $data['alamat']; ?></textarea>
    </div>

    <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</div>

</body>
</html>
