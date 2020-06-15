<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/register.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</head>
<body>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 white p-4">
                <h2 class="register">Register</h2>
                <hr>
                <form action="proses.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="">Foto</label>
                      <input type="file" class="form-control-file" name="foto" id="" placeholder="" aria-describedby="fotoo">
                      <small id="fotoo" class="form-text text-muted"> >500kb (jpeg, jpg, png) </small>
                    </div>
                    <div class="form-group">
                      <label for="Nama">Nama</label>
                      <input type="text"
                        class="form-control" name="nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text"
                        class="form-control" name="username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password"
                        class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label> <br>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="jk" id="" value="L"> Laki - Laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="jk" id="" value="P"> Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="hp">Handphone</label>
                      <input type="text"
                        class="form-control" name="hp" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <input type="text"
                        class="form-control" name="alamat" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="">Admin</label>
                      <select class="form-control" name="admin" id="">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                      </select>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="btnRegister">Register</button>
                    </center>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>