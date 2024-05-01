<!DOCTYPE html>
<html>
<head>
    <title>Form Absensi Fasilkom</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = input($_POST["nama"]);
            $sekolah = input($_POST["sekolah"]);
            $jurusan = input($_POST["jurusan"]);
            $no_hp = input($_POST["no_hp"]);
            $alamat = input($_POST["Alamat"]);

            $sql = "INSERT INTO peserta (nama, sekolah, jurusan, no_hp, alamat) VALUES ('$nama', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

            $hasil = mysqli_query($db, $sql);

            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>

    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required />
        </div>
        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Sekolah" required/>
        </div>
        <div class="form-group">
        <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-select" aria-label="Default select example">
                <option selected disabled>Pilih Jurusan</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
            </select>
        </div>
        <div class="form-group">
            <label>No. HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No. HP" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="Alamat" class="form-control" rows="5" placeholder="Masukkan Alamat" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
</body>
</html>
