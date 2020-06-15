<?php
include "../../koneksi.php";
$id = $_GET['id'];
$q = mysqli_query($con, "delete from transaksi where id = '$id'");
header('Location: index.php');
?>
