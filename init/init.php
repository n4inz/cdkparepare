<?php 
include '../config/db.php';



global $db;

if(!$_POST){
    header('Location: ../daftar.php');
}


switch ($_GET['act']) {
    case 'daftar':

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $hp = $_POST['noHp'];
    $pass = $_POST['pass'];

    $cek_user=mysqli_num_rows(mysqli_query($db,"SELECT * FROM user WHERE email='$email'"));
    $cek_hp=mysqli_num_rows(mysqli_query($db,"SELECT * FROM user WHERE hp='$hp'"));

    if($cek_user > 0){
        echo 'Email sudah terdaftar';
    }elseif($cek_hp > 0){
        echo 'Nomor ini sudah terdaftar';
    }else{
        // $query1 = "INSERT INTO orderan (nama,orderan,totalbayar,rekening,alamat,ket,tanggal) VALUE ('$nama','',0,0,'',0,'')";
        // $insert1 = mysqli_query($db,$query1);
        $query = "INSERT INTO user (nama, email, hp, password) VALUE ('$nama', '$email', ' $hp', '$pass')";
        $insert = mysqli_query($db,$query);
        if($insert){
        //    echo "<script type='text/javascript'>alert('Registrasi Berhasil'); document.location='../daftar.php';</script>";
            echo 'berhasil';
        }else{
            // echo "<script type='text/javascript'>alert('Registrasi Gagal'); document.location='../daftar.php';</script>";
            echo 'Gagal';
        }
    }




    break;

    case 'login':
    session_start();
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $data = mysqli_query($db,"SELECT * FROM user WHERE email='$email' AND password='$pass'");
            $keluar = mysqli_fetch_array($data);
            $cek = mysqli_num_rows($data);


            
            if($cek > 0){

                $_SESSION['user'] = $keluar['nama'];
                $_SESSION['no'] = $keluar['hp'];
                
                echo "<script type='text/javascript'>alert('Login Berhasil'); document.location='../index.php';</script>";
            }else{
                echo "<script type='text/javascript'>alert('Login Gagal'); document.location='../index.php';</script>";
            }
        }


    break;


    case 'logout':
    session_start();
    session_unset();
    session_destroy();
    header("Location:../index.php");

    break;

    case 'cekout':
    session_start();
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $_POST['total'];
        $gambar = $_POST['gambar'];

        $query = "SELECT * FROM store WHERE id='$id'";
        $insert = mysqli_query($db,$query);
        $data = mysqli_num_rows($insert);


        if($data != 0){
            $assoc = mysqli_fetch_assoc($insert);
            $totalJumlah = $assoc['jumlah'] + $jumlah ;
            $totalHarga = $totalJumlah * $harga;
            
            $query = "UPDATE store SET nama='$nama', harga='$harga', jumlah='$totalJumlah', total='$totalHarga', gambar='$gambar' WHERE id='$id'";
            $insert = mysqli_query($db,$query);
        }else{
            $query = "INSERT INTO store (id, nama, harga, jumlah, gambar,total) VALUE ($id,'$nama', '$harga', ' $jumlah', '$gambar','$total')";
            $insert = mysqli_query($db,$query);
        }


        if (!isset($_SESSION['count'])){
            $_SESSION['count'] = 1;
        }else{
            ++$_SESSION['count'];
        }
        echo $_SESSION['count'];

    
    break;
}






