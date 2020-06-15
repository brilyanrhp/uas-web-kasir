<?php
include "../koneksi.php";
session_start();

if(isset($_POST['btnTambah'])){
    $get_id = mysqli_query($con, "select max(id) from transaksi");
    $data_id = mysqli_fetch_array($get_id);
    $no_id = $data_id[0];

    $no_urut = (int) substr($no_id, 3, 9);

    $no_urut++;
    $char = "TR";
    $kd_transaksi = $char . sprintf("%09s", $no_urut);

    $id_karyawan = $_SESSION['id'];
    $nama_barang = $_POST['nama'];
    $qty = $_POST['qty'];
    $result_barang = mysqli_query($con, "select * from barang where nama = '$nama_barang'");
    $data_barang = mysqli_fetch_array($result_barang);
    $id_barang = $data_barang['id'];
    $harga = $data_barang['harga'];
    $stok = $data_barang['stok'];
    $total = $harga * $qty;
    
    $cek_stok = $stok - $qty;

    if($cek_stok > 0){
        $ins = mysqli_query($con, "insert into transaksi values ('$kd_transaksi', '$id_barang', '$id_karyawan', '$qty', '$total', current_timestamp())");
    }else{
        echo "<script> alert('Stok Tidak Mencukupi. Sisa : " . $stok . "'); window.location='index.php'</script>";
    }

    if(!$ins){
        print_r($_SESSION);
        echo "Error : " . mysqli_error($con);
    }else{
        header("Location: index.php");
    }
}