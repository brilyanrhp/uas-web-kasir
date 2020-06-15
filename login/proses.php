<?php
include "../koneksi.php";
session_start();
$username = $_POST['username'];
$password = md5($_POST['password']);
$result = mysqli_query($con, "select * from karyawan where username='$username' and password='$password'");
$data = mysqli_fetch_array($result);
$cek = mysqli_num_rows($result);

if($cek > 0){
    $_SESSION['username'] = $username;
    $_SESSION['admin'] = $data['admin'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id'] = $data['id'];
    $_SESSION['login'] = true;
    echo "<script>alert('Login Sukses'); window.location = '../index.php'</script>";
}else{
    echo "<script>alert('Login Gagal'); window.location = 'index.php'</script>";
}