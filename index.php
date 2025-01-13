<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESERTA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <span class="navbar-brand mb-0 h1">PENDAFTARAN PELATIHAN SISWA</span>
    </nav>

    <div class="container">
        <br>
        <h4 class="text-center">DAFTAR PESERTA </h4>

        <?php
        include "koneksi.php";

        // Cek apakah ada permintaan penghapusan data
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);

            // Query untuk menghapus data peserta
            $sql = "DELETE FROM peserta WHERE id_peserta='$id_peserta'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
            }
        }

        // Query untuk menampilkan data peserta
        $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
        $hasil = mysqli_query($kon, $sql);
        $no = 1;

        if (mysqli_num_rows($hasil) > 0) {
        ?>
        <table class="table table-bordered my-3">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Jurusan</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_array($hasil)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["sekolah"]; ?></td>
                    <td><?php echo $data["jurusan"]; ?></td>
                    <td><?php echo $data["no_hp"]; ?></td>
                    <td><?php echo $data["alamat"]; ?></td>
                    <td>
                        <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<div class='alert alert-info'>Belum ada data peserta.</div>";
        }
        ?>
        <a href="create.php" class="btn btn-primary">Tambah Data</a>
    </div>
</body>
</html>
