<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>

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
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="../">Kembali</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
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
                    <th>Id</th>
                    <th>Gambar Produk</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Terakhir Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../koneksi.php";
                $query = mysqli_query($con, "select * from barang");
                while($data = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td>" . $data[0] . "</td>";
                    echo "<td><img src = '../../img/gambar_produk/" . $data[1] . "' height='100'></td>";
                    echo "<td>" . $data[2] . "</td>";
                    echo "<td>" . $data[3] . "</td>";
                    echo "<td>" . $data[4] . "</td>";
                    echo "<td>" . $data[5] . "</td>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready(function() {
    $('#tabeldata').DataTable();
    });
    </script>
</body>
</html>