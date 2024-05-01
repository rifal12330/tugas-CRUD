<!DOCTYPE html>
<html>
<head>
    <title>Sekolah Sepak Bola</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        /* Custom CSS untuk tampilan yang lebih menarik */
        .jumbotron 
        {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 10px;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">FASILKOM UNSIKA</span>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="jumbotron">
            <h4 class="mb-4 text-center">DAFTAR MAHASISWA</h4>
            <?php
            // Include file koneksi.php
            include "koneksi.php";  

            // Cek jika ada request delete
            if (isset($_GET['id_peserta'])) {
                $id_peserta = htmlspecialchars($_GET["id_peserta"]);

                $sql = "DELETE FROM peserta WHERE id_peserta='$id_peserta'";
                $hasil = mysqli_query($db, $sql);

                // Periksa apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'>Data gagal dihapus.</div>";
                }
            }
            ?>
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah</th>
                        <th>Jurusan</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th colspan='2' class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data peserta dari database
                    $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
                    $hasil = mysqli_query($db, $sql);
                    $no = 0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data["nama"]; ?></td>
                            <td><?php echo $data["sekolah"]; ?></td>
                            <td><?php echo $data["jurusan"]; ?></td>
                            <td><?php echo $data["no_hp"]; ?></td>
                            <td><?php echo $data["alamat"]; ?></td>
                            <td class="text-center">
                                <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning btn-sm" role="button">Update</a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger btn-sm" role="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-primary btn-block">Tambah Data</a>
        </div>
    </div>
</body>
</html>
