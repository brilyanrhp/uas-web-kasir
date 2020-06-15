<?php
session_start();
include "../koneksi.php";
$total = $_GET['total'];
$bayar = $_GET['bayar'];
$kembali = $_GET['kembali'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['nama']?></title>
</head>
<body>
    <center>
        <h1>TOKO ABC</h1>
        <h3>Blora</h3>
    </center>
    <h4>Tanggal : <?php echo date("d-m-Y") ?></h4>
    <h4>Kasir   : <?php echo $_SESSION['nama'] ?></h4>
    <hr>
    <center>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Harga</td>
                    <td>Qty</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($con, "SELECT tmp_transaksi.id, barang.gambar, barang.nama, karyawan.nama, barang.harga, tmp_transaksi.qty, tmp_transaksi.total FROM (( tmp_transaksi INNER JOIN karyawan ON tmp_transaksi.id_karyawan = karyawan.id) INNER JOIN barang on barang.id = tmp_transaksi.id_barang)");

                while($data = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td>" . $data[2] . "</td>";
                    echo "<td>" . $data[4] . "</td>";
                    echo "<td>" . $data[5] . "</td>";
                    echo "<td>" . $data[6] . "</td>";
                }
                ?>
            </tbody>
        </table>
    </center>
    <hr>
    <h5>TOTAL     : <?php echo number_format($total, 2, ',', '.') ?></h5>
    <h5>BAYAR     : <?php echo number_format($bayar, 2, ',', '.') ?></h5>
    <h5>KEMBALIAN : <?php echo number_format($kembali, 2, ',', '.') ?></h5>

    <center>
        <h4>**** TERIMAKASIH ****</h4>
    </center>
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
        window.print();
        setTimeout("closePrintView()", 2500);
        });
        function closePrintView() {
            document.location.href = 'selesai.php';
        }
    </script>
</body>
</html>