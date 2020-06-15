<?php
include "../koneksi.php";
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Transaksi</title>

    <!-- css dan script -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/all.min.js"></script>
</head>

<body onload="clockStart()">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#"><i class="fas fa-clock"></i> <span id="time"></span></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown pl-2 pr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i> Lihat Data</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="barang">Data Barang</a>
                        <a class="dropdown-item" href="transaksi">Data Transaksi</a>
                    </div>
                </li>
                <li class="nav-item dropdown pl-2 pr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="user" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['nama'] ?></a>
                    <div class="dropdown-menu" aria-labelledby="user">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-3">
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Barang" id="barang"
                            list="baranglist" autocomplete="off">
                        <datalist id="baranglist">
                            <?php
                                $result = mysqli_query($con, "select nama from barang");
                                while($row = mysqli_fetch_array($result)){
                                    $data = $row['nama'];
                                    echo "<option value='$data'>";
                                }
                            ?>
                        </datalist>

                    </div>
                    <div class="form-group">
                        <input type="text" name="qty" class="form-control" placeholder="Quantity" autocomplete="off">
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="btnTambah">Tambah</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#selesai">
                            Selesai
                        </button>
                    </center>
                </form>
            </div>
            <div class="col-md-9">
                <h1 align="right">
                    Bayar : Rp
                    <?php 
                    $get_harga = mysqli_query($con, "select sum(total) as bayar from tmp_transaksi");
                    $bayar = mysqli_fetch_array($get_harga);
                    echo number_format($bayar[0], 2, ',', '.');
                    ?>
                </h1>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <td>No Transaksi</td>
                            <td>Gambar Produk</td>
                            <td>Nama Barang</td>
                            <td>Nama Karyawan</td>
                            <td>Harga</td>
                            <td>Qty.</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $transaksi = mysqli_query($con, "SELECT tmp_transaksi.id, barang.gambar, barang.nama, karyawan.nama, barang.harga, tmp_transaksi.qty, tmp_transaksi.total FROM (( tmp_transaksi INNER JOIN karyawan ON tmp_transaksi.id_karyawan = karyawan.id) INNER JOIN barang on barang.id = tmp_transaksi.id_barang)");
                            
                            while($data = mysqli_fetch_array($transaksi)){
                                echo "<tr>";
                                echo "<td>" . $data[0] . "</td>";
                                echo "<td><img src = '../img/gambar_produk/" . $data[1] . "' height='100'></td>";
                                echo "<td>" . $data[2] . "</td>";
                                echo "<td>" . $data[3] . "</td>";
                                echo "<td>" . $data[4] . "</td>";
                                echo "<td>" . $data[5] . "</td>";
                                echo "<td>" . $data[6] . "</td>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="titleSelesai" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaksi Selesai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="cetak.php" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="">Total Bayar</label>
                        <input type="text" class="form-control" id="totalharga" value=<?php echo "'".$bayar[0]."'"; ?> name="total">
                        </div>
                        <div class="form-group">
                        <label for="">Uang</label>
                        <input type="text" class="form-control" id="uangbayar" oninput="kembalian()" name="bayar" autocomplete="off"> 
                        </div>
                        <div class="form-group">
                        <label for="">Kembali</label>
                        <input type="text" class="form-control" id="kembali" name="kembali">
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function kembalian(){
        var total = document.getElementById('totalharga').value;
        var bayar = document.getElementById('uangbayar').value;
        document.getElementById('kembali').value = bayar-total;
    }
    function clockStart() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        m = checkTime(m);
        h = checkTime(h);

        document.getElementById('time').innerHTML = h + " : " + m;
        var t = setTimeout(clockStart, 500);
    }

    function checkTime(t) {
        if (t < 10) {
            t = "0" + t;
        }
        return t;
    }
    </script>
</body>

</html>