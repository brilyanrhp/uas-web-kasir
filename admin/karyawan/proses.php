<?php
include "../../koneksi.php";

if(isset($_POST['btnUbah'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $admin = $_POST['admin'];
    $nama_foto = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];

    // mendapatkan file foto lama
    $data_foto = mysqli_fetch_array(mysqli_query($con, "select foto from karyawan where id = '$id'"));
    $nama_foto_lama = $data_foto['foto'];
    
    // cek apakah ada input foto atau tidak
    if($nama_foto == ''){
        $sql = "update karyawan set nama = '$nama', hp = '$hp', alamat = '$alamat', admin = '$admin', jenis_kelamin = '$jk',last_update = current_timestamp() where id = '$id'";

        $ubah = mysqli_query($con, $sql);
        if(!$ubah){
            $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
            echo $error;
            echo "<script>
            alert('Error');
            window.location='index.php';
            </script>";
        }else{
            echo "<script>
            alert('Sukses Mengubah Data');
            window.location='index.php';
            </script>";
        }
    }else{

        // cek ukuran foto
        if($ukuran > 500000){
            echo "<script>alert('Foto harus < 500kb'); window.location = 'index.php'</script>";
        }else{
            $ekstensi_diperbolehkan = array('jpg', 'jpeg', 'png');
            $x = explode('.', $nama_foto);
            $ekstensi = strtolower(end($x));
            $file_sementara = $_FILES['foto']['tmp_name'];
            $waktu = strtotime("now");
            $angka_random = rand(1000,9999);
            $nama_baru = $waktu . "_" . $angka_random . "." . $ekstensi;

            // cek apakah ekstensi foto sesuai dengan yang diperbolehkan
            if(in_array($ekstensi, $ekstensi_diperbolehkan)){
                move_uploaded_file($file_sementara, '../../img/foto_karyawan/'.$nama_baru);
                $sql = "update karyawan set nama = '$nama', foto = '$nama_baru', hp = '$hp', alamat = '$alamat', admin = '$admin', last_update = current_timestamp(), jenis_kelamin = '$jk' where id = '$id'";

                $ubah = mysqli_query($con, $sql);
                if(!$ubah){
                    $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
                    echo "<script>
                    alert($error);
                    window.location='index.php';
                    </script>";
                }else{
                    if($nama_foto_lama != 'default.png'){
                        unlink("../../img/foto_karyawan/".$nama_foto_lama);
                    }
                    echo "<script>
                    alert('Sukses Mengubah Data');
                    window.location='index.php';
                    </script>";
                }
            }else{
                echo "<script>alert('Format gambar tidak didukung!'); window.location = 'index.php'</script>";
            }
        }
    }
}

if(isset($_POST['btnHapus'])){
    $id = $_POST['id'];
    $hapus = mysqli_query($con, "delete from karyawan where id = '$id'");
    if(!$hapus){
        $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
        echo "<script>
        alert($error);
        window.location='index.php';
        </script>";
    }else{
        echo "<script>
        alert('Sukses Menghapus Data');
        window.location='index.php';
        </script>";
    }
}