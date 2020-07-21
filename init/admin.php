<?php 
include '../config/db.php';

global $db;

if(!$_POST){
    header('Location: ../index.php');
}


switch ($_GET['act']) {
    case 'login':

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $hp = $_POST['noHp'];
        $pass = $_POST['pass'];


        $query = "INSERT INTO user (nama, email, hp, password) VALUE ('$nama', '$email', ' $hp', '$pass')";
        $insert = mysqli_query($db,$query);
        if($insert){
            echo 'berhasil';
        }else{
            echo 'gagal';
        }


    break;

    case 'tambahBarang':

        if(isset($_POST['submit'])){
            $namaBarang = $_POST['barang'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];
            $ket = $_POST['ket'];
            
            
            $ekstensi_diperbolehkan	= array('png','jpg','PNG','jpeg','JPEG','JPG');
            $foto = $_FILES['file']['name'];
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];	
        
        //die($kode.' '.$nama.' '.$tanggal.' '.$jenis.' '.$kerusakan.' '.$kondisi.' '.$lokasi.' '.$foto);

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 5044070){			
                move_uploaded_file($file_tmp, '../file/'.$foto);
                $sql = "INSERT INTO dataBarang (nama, stok, harga,ket, gambar) VALUES ('$namaBarang','$stok','$harga','$ket','$foto')";

                $data = mysqli_query ($db, $sql);
                
    // 			$data=mysqli_query ($connection, "INSERT INTO pelaksana VALUES ('','$kode','$nama','$tanggal','$jenis','$kerusakan','$kondisi','$lokasi','$foto') ") or die (mysql_error());

                    if($data){
                      
                   echo "<script type='text/javascript'>alert('Data Anda Berhasil!! ;) '); document.location='../admin/barang.php';</script>";
                    }else{
                        echo "<script type='text/javascript'>alert('Data Yang Anda Masukkan Salah. Silahkan ulang kembali.'); document.location='pelaksana.php';</script>";
                    }

                }else{
                    echo 'UKURAN FILE TERLALU BESAR';
                }
            }else{
                echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            }
        }else{
            header('Location: ../index.php');
        }

        
    



    break;


}

