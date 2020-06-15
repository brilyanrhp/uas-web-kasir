<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>

    <!-- css dan script -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.dataTables.min.js"></script>
    <script src="../../js/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/all.min.js"></script>
    
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="../">Kembali</a>
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
    <div class="container-fluid pt-4">
        <table class="table table-bordered" id="tabeldata">
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Gambar Produk</th>
                    <th>Nama Barang</th>
                    <th>Nama Karyawan</th>
                    <th>Harga</th>
                    <th>Qty.</th>
                    <th>Harga Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../koneksi.php";
                $query = mysqli_query($con, "SELECT transaksi.id, barang.gambar, barang.nama, karyawan.nama, barang.harga, transaksi.qty, transaksi.total FROM (( transaksi INNER JOIN karyawan ON transaksi.id_karyawan = karyawan.id) INNER JOIN barang on barang.id = transaksi.id_barang)");
                
                while($data = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td>" . $data[0] . "</td>";
                    echo "<td><img src = '../../img/gambar_produk/" . $data[1] . "' height='100'></td>";
                    echo "<td>" . $data[2] . "</td>";
                    echo "<td>" . $data[3] . "</td>";
                    echo "<td>" . $data[4] . "</td>";
                    echo "<td>" . $data[5] . "</td>";
                    echo "<td>" . $data[6] . "</td>";
                    echo "<td><a href=\"hapus.php?id=". $data[0] ."\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>";
                }
                ?>
            </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $('#tabeldata').DataTable();
        });
        </script>
</body>

</html>