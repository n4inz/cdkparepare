<?php 
include '../config/db.php';

global $db;


switch ($_GET['act']) {

    case 'login':
    session_start();

    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
    
        
     
    
            $data = mysqli_query($db,"SELECT * FROM admin WHERE user='$user' AND pass='$pass'");
            $keluar = mysqli_fetch_array($data);
            $cek = mysqli_num_rows($data);
    
    
            
            if($cek > 0){
    
                $_SESSION['admin'] = $keluar['user'];
                
                header("Location:../admin/admin.php");
        //        echo "<script type='text/javascript'> document.location='../admin/admin.php';</script>";;
            }else{
                echo "<script type='text/javascript'>alert('Login Gagal'); document.location='../admin/';</script>";
    }
    }

    

    break;

    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        header("Location:../");
    break;

    case 'showData':



    $query = "SELECT * FROM dataBarang ORDER BY id DESC";
    $data = mysqli_query($db,$query);

    $no = 1;
    if($data){
        while($loop = mysqli_fetch_assoc($data)){
            echo '
            <tr>
            <th scope="row">'.$no.'</th>
            <td ><input class="nama-'.$loop['id'].'" style="border:none; width: 80%; box-shadow:red; outline-color: black;" type="text" value="'.$loop['nama'].'" /></td>
            <td><input class="stok-'.$loop['id'].'" style="border:none; width: 25%; box-shadow:red; outline-color: black;" type="text" value="'.$loop['stok'].'" /></td>
            <td>'.$loop['terjual'].'</td>
            <td><input class="harga-'.$loop['id'].'" style="border:none; width: 50%; box-shadow:red; outline-color: black;" type="text" value="'.$loop['harga'].'" /></td>
            <td><input class="ket-'.$loop['id'].'" style="border:none; width: 80%; box-shadow:red; outline-color: black;" type="text" value="'.$loop['ket'].'" /></td>
            
            <td>
            <span class="fa fa-pencil edit" id="'.$loop['id'].'" ></span><br><br>
            <span class="fa fa-eraser hapus" id="'.$loop['id'].'">&nbsp;</span>
            
            </td>
            </tr>
            
            
            ';

            $no++;
        }
    }else{
        echo '
        
        <tr>
        <td colspan="5"><h3 align="center">Data tidak di temukan</h3></td>
        </tr>
        
        
        ';
    }


    break;

    case 'hapus':

    $id = $_POST['id'];
    $query = "DELETE FROM dataBarang WHERE id='$id'";
    $data = mysqli_query($db,$query);

    if(!$data){
        echo "<script type='text/javascript'>alert('Data Gagal Di Hapus;) '); document.location='../admin/barang.php';</script>";

    }

    break;

    case 'edit':

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $ket = $_POST['ket'];
    $query = "UPDATE dataBarang SET nama='$nama', stok='$stok', harga='$harga', ket='$ket' WHERE id='$id'";
    $data = mysqli_query($db,$query);

    if(!$data){
        echo "<script type='text/javascript'>alert('Data Gagal Di Hapus;) '); document.location='../admin/barang.php';</script>";

    }

    break;

    case 'showDataTransaksi':
    $query = "SELECT * FROM transaksi ORDER BY id DESC";

    
    $data = mysqli_query($db,$query);

    $no = 1;
    if($data){
        while($loop = mysqli_fetch_assoc($data)){
            echo '
            <tr>
            <th scope="row">'.$no.'</th>
            <td>'.$loop['kode'].'</td>
            <td>'.$loop['orderan'].'</td>
            <td>'.$loop['harga'].'</td>
            <td>'.$loop['jumlah'].'</td>        
            <td>'.$loop['total'].'</td>
            <td>'.$loop['rekening'].'</td>
            <td>'.$loop['alamat'].'</td>        
            <td>'.$loop['tanggal'].'</td>
            <td>sts</td>
            </tr>
            
            
            ';

            $no++;
        }
    }else{
        echo '
        
        <tr>
        <td colspan="5"><h3 align="center">Data tidak di temukan</h3></td>
        </tr>
        
        
        ';
    }
    break;

    case 'transaksiFilter':

    $tgl = $_POST['tgl'];

    $query = "SELECT * FROM transaksi WHERE tanggal='$tgl'";
    $data1 = mysqli_query($db,$query);

    $no = 1;

    if(mysqli_num_rows($data1)){
        while($data = mysqli_fetch_assoc($data1)){
                echo '
                <tr>
                <td>'.$no.'</td>
                <td>'.$data['orderan'].'</td>
                <td>'.$data['jumlah'].'</td>
                <td>'.number_format($data['harga'],0,',','.').'</td>
                <td>'.$data['tanggal'].'</td>
                <td>'.number_format($data['harga'] * $data['jumlah'],0,',','.').'</td>
                
                
                </tr>

                
                ';
                $tot += $data['harga']* $data['jumlah'];
            $no++;
        }
            echo '                <tr>
            <td  colspan=4></td>
            <td align="right">Total:</td>
            <td ><b>'.number_format($tot,0,',','.').'</b></td>
            </tr>';
       
    }else{
        echo '
        <tr>
        <td align=center colspan=6><b>Data Tidak Di Temukan</b></td>
       
        </tr>';
    }

    break;

    case 'printKeuangan':
        $tgl = $_POST['tgl'];
       // echo "<script type='text/javascript'>alert('Login Gagal'); document.location='../admin/';</script>";
    //    header("Location:../admin/admin.php");

         echo $tgl;
    break;

    case 'modalShow':

    $kode = $_POST['id'];
    $query = "SELECT * FROM transaksi WHERE kode='$kode'";  
    $data5 = mysqli_query($db,$query);

    $no = 1;
    while($loop = mysqli_fetch_assoc($data5)){


       $array = array($loop['nama']);
       $no++;
    }

    print_r($array);


    break;


}


?>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".hapus").click(function(){
        var data = $(this).attr('id')
        $.ajax({
				url	     : '../ajax/admin.php?act=hapus',
				type     : 'POST',
				dataType : 'html',
				data     : {'id' : data},
				success  : function(){
					
                    $.ajax({
                        url	     : '../ajax/admin.php?act=showData',
                        type     : 'POST',
                        dataType : 'html',
                        //data     : 'data='+val,
                        success  : function(a){
                            $('tbody').html(a)

                    
                        },
                    })
			
				},
			})
    })

    $(".edit").click(function(){
        var id = $(this).attr('id');
        var nama = $(".nama-"+id).val();
        var stok = $(".stok-"+id).val();
        var harga = $(".harga-"+id).val();
        var ket = $(".ket-"+id).val();

       
        $.ajax({
				url	     : '../ajax/admin.php?act=edit',
				type     : 'POST',
				dataType : 'html',
				data     : {'id' : id, 'nama': nama,'stok':stok,'harga':harga, 'ket': ket},
				success  : function(){
					
                    $.ajax({
                        url	     : '../ajax/admin.php?act=showData',
                        type     : 'POST',
                        dataType : 'html',
                        //data     : 'data='+val,
                        success  : function(a){
                            $('tbody').html(a)

                    
                        },
                    })
			
				},
			})
    })
})
</script>
