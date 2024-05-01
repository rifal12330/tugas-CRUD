<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        /* Custom CSS untuk tampilan yang lebih menarik */
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET['id_peserta'])) {
        $id_peserta = input($_GET["id_peserta"]);
        $sql = "SELECT * FROM peserta WHERE id_peserta=$id_peserta";
        $hasil = mysqli_query($db, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peserta = input($_POST["id_peserta"]);
        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        $sql = "UPDATE peserta SET
            nama='$nama',
            sekolah='$sekolah',
            jurusan='$jurusan',
            no_hp='$no_hp',
            alamat='$alamat'
            WHERE id_peserta=$id_peserta";

        $hasil = mysqli_query($db, $sql);

        if ($hasil) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4">Update Data</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="<?php echo $data['nama']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Sekolah:</label>
                        <input type="text" name="sekolah" class="form-control" placeholder="Masukan Nama Sekolah" value="<?php echo $data['sekolah']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Jurusan:</label>
                        <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" value="<?php echo $data['jurusan']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>No HP:</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" value="<?php echo $data['no_hp']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Alamat:</label>
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo $data['alamat']; ?></textarea>
                    </div>
                    <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />
                    <button type="submit" name="submit" class="btn btn-primary btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
