<?php
include "../koneksi.php";
if(isset($_POST['btnRegister'])){
    $get_id = mysqli_query($con, "select max(id) from karyawan");
    $data_id = mysqli_fetch_array($get_id);
    $no_id = $data_id[0];

    $no_urut = (int) substr($no_id, 3, 9);

    $no_urut++;
    $char = "KR";
    $kd_karyawan = $char . sprintf("%09s", $no_urut);
    $foto = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $jeniskelamin = $_POST['jk'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $admin = $_POST['admin'];

    if($foto == ''){
        $tambah = mysqli_query($con, "insert into karyawan values('$kd_karyawan', 'default.png', '$nama', '$jeniskelamin', '$hp', '$alamat', '$admin', '$user', '$pass', current_timestamp())");
        if(!$tambah){
            $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
            echo $error;
        }else{
            echo "<script>
            alert('Sukses Menambah Data');
            window.location='../login';
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
                move_uploaded_file($file_sementara, '../img/foto_karyawan/'.$nama_baru);
                $tambah = mysqli_query($con, "insert into karyawan values('$kd_karyawan', '$nama_baru', '$nama', '$jeniskelamin', '$hp', '$alamat', '$admin', '$user', '$pass', current_timestamp())");

                if(!$tambah){
                    $error = "Error : " . mysqli_error($con) . "Errno : " . mysqli_errno($con);
                    echo $error;
                }else{
                    echo "<script>
                    alert('Sukses Register');
                    window.location = '../login';
                    </script>";
                }
            }else{
                echo "<script>alert('Format file tidak didukung'); window.location = '../login'</script>";
            }
            
        }
    }
}