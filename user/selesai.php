<?php

include "../koneksi.php";
mysqli_query($con, "delete from tmp_transaksi");
header("Location: index.php");