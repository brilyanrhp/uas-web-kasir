<?php
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>

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
            <h1 class="mb-3">Tambah Data Barang</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5>Foto saat ini</h5>
                    <img src = '../../img/gambar_produk/default.png' height="300" class="mb-2">
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" class="form-control-file" name="foto" id="foto" placeholder="foto">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" autocomplete="off">
                    </div>
                </div>
            </div>
            <hr class="my-2">
            <center class="p-5">
                <button type="submit" class="btn btn-primary btn-lg mr-3" name="btnTambah">Tambah</button>
                <a href="index.php" class="btn btn-secondary btn-lg ml-3">Batal</a>
            </center>
        </div>
    </form>
</body>
</html>