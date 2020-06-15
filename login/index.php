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
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</head>
<body>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-5 p-4 white">
                <h2 class="login">Login</h2>
                <hr>
                <form action="proses.php" method="post">
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
                    <center>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="../register" class="btn btn-secondary">Register</a>
                    </center>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>