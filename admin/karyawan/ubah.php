<?php
include "../../koneksi.php";
$id = $_GET['id'];
$q = mysqli_query($con, "select * from karyawan where id = '$id'");
$data = mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>

    <!-- css dan script -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Kembali</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                </li>
            </ul>
        </div>
    </nav>
    <form action="proses.php" method="post" enctype="multipart/form-data">
        <div class="container pt-4">
            <h1 class="mb-3">Ubah Data Karyawan</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5>Foto saat ini</h5>
                    <img <?php echo "src = '../../img/foto_karyawan/" . $data['foto'] . "'"; ?> height="300" class="mb-2">
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" class="form-control-file" name="foto" id="foto" placeholder="foto">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" name="id" id="id" readonly
                            <?php echo "value='" . $data['id'] . "'" ?>>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" <?php echo "value='" . $data['nama'] . "'" ?>>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option>Jenis Kelamin</option>
                            <?php
                            if($data['jenis_kelamin'] == 'L'){
                                echo "<option value=\"L\" selected>Laki - Laki</option>";
                                echo "<option value=\"P\">Perempuan</option>";
                            }else{
                                echo "<option value=\"L\">Laki - Laki</option>";
                                echo "<option value=\"P\" selected>Perempuan</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" class="form-control" name="hp" id="hp" <?php echo "value='" . $data['hp'] . "'" ?>>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat"
                            <?php echo "value='" . $data['alamat'] . "'" ?>>
                    </div>
                    <div class="form-group">
                        <label for="admin">Admin</label>
                        <select class="form-control" name="admin" id="admin">
                            <option>Status Admin</option>
                            <?php
                            if($data['admin'] == 1){
                                echo "<option value=\"1\" selected>Ya</option>";
                                echo "<option value=\"0\">Tidak</option>";
                            }else{
                                echo "<option value=\"1\">Ya</option>";
                                echo "<option value=\"0\" selected>Tidak</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr class="my-2">
            <center class="p-5">
                <button type="submit" class="btn btn-warning btn-lg mr-3" name="btnUbah">Ubah</button>
                <a href="index.php" class="btn btn-secondary btn-lg ml-3">Batal</a>
            </center>
        </div>
    </form>
</body>

</html>