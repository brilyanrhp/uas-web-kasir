<?php
include "../../koneksi.php";

if(isset($_POST['btnTambah'])){
    $get_id = mysqli_query($con, "select max(id) from barang");
    $data_id = mysqli_fetch_array($get_id);
    $no_id = $data_id[0];

    $no_urut = (int) substr($no_id, 3, 9);

    $no_urut++;
    $char = "BR";
    $kd_barang = $char . sprintf("%09s", $no_urut);
    $foto = $_FILES['foto']['name'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $ukuran = $_FILES['foto']['size'];

    if($foto == ''){
        $tambah = mysqli_query($con, "insert into barang values ('$kd_barang', 'default.png', '$nama', '$harga','$stok', current_timestamp())");
        if(!$tambah){
            $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
            echo $error;
        }else{
            echo "<script>
            alert('Sukses Menambah Data');
            window.location='index.php';
            </script>";
        }
    }else{
        if($ukuran > 500000){
            echo "<script>alert('Ukuran file > 500kb'); window.location = 'index.php'</script>";
        }else{
            $ekstensi_diperbolehkan = array('jpg', 'jpeg', 'png');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_sementara = $_FILES['foto']['tmp_name'];
            $waktu = strtotime("now");
            $angka_random = rand(1000,9999);
            $nama_baru = $waktu . "_" . $angka_random . "." . $ekstensi;

            if(in_array($ekstensi, $ekstensi_diperbolehkan)){
                move_uploaded_file($file_sementara, '../../img/gambar_produk/'.$nama_baru);
                $tambah = mysqli_query($con, "insert into barang values ('$kd_barang', '$nama_baru', '$nama', '$harga','$stok', current_timestamp())");

                if(!$tambah){
                    $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
                    echo "<script>
                    alert('Error');
                    window.location='index.php';
                    </script>";
                }else{
                    echo "<script>
                    alert('Sukses Menambah Data');
                    window.location = 'index.php';
                    </script>";
                }
            }else{
                echo "<script>alert('Format file tidak didukung'); window.location = 'index.php'</script>";
            }
            
        }
    }
}

if(isset($_POST['btnUbah'])){
    $id = $_POST['id'];
    $foto = $_FILES['foto']['name'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $ukuran = $_FILES['foto']['size'];

    $data_foto = mysqli_fetch_array(mysqli_query($con, "select gambar from barang where id = '$id'"));
    $nama_foto_lama = $data_foto['gambar'];

    if($foto == ''){
        $ubah = mysqli_query($con, "update barang set nama = '$nama', harga='$harga', stok='$stok', last_upd = current_timestamp() where id = '$id'");
        if(!$ubah){
            $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
            echo $error;
        }else{
            echo "<script>
            alert('Sukses Mengubah Data');
            window.location='index.php';
            </script>";
        }
    }else{
        if($ukuran > 500000){
            echo "<script>alert('Ukuran file > 500kb'); window.location = 'index.php'</script>";
        }else{
            $ekstensi_diperbolehkan = array('jpg', 'jpeg', 'png');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_sementara = $_FILES['foto']['tmp_name'];
            $waktu = strtotime("now");
            $angka_random = rand(1000,9999);
            $nama_baru = $waktu . "_" . $angka_random . "." . $ekstensi;

            if(in_array($ekstensi, $ekstensi_diperbolehkan)){
                move_uploaded_file($file_sementara, '../../img/gambar_produk/'.$nama_baru);
                $ubah = mysqli_query($con, "update barang set gambar = '$nama_baru', nama = '$nama', harga='$harga', stok='$stok', tgl_update = current_timestamp() where id = '$id'");

                if(!$ubah){
                    $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
                    echo "<script>
                    alert('Error');
                    window.location='index.php';
                    </script>";
                }else{
                    if($nama_foto_lama != 'default.png'){
                        unlink("../../img/gambar_produk/".$nama_foto_lama);
                    }
                    echo "<script>
                    alert('Sukses Mengubah Data');
                    window.location='index.php';
                    </script>";
                }
            }else{
                echo "<script>alert('Format file tidak didukung'); window.location = 'index.php'</script>";
            }
            
        }
    }
}

if(isset($_POST['btnHapus'])){
    $id = $_POST['id'];
    $hapus = mysqli_query($con, "delete from barang where id = '$id'");
    if(!$hapus){
        echo "Error : " . mysqli_error($con);
    }else{
        echo "<script>alert('Berhasil Menghapus Data'); window.location = 'index.php'</script>";
    }
}