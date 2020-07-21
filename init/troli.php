<?php  


include '../config/db.php';



global $db;

if(!$_POST){
    header('Location: ../daftar.php');
}

switch ($_GET['act']) {
    case 'showCekout':
    $query = "SELECT * FROM store";
    $insert = mysqli_query($db,$query);
    
    $total = 0;
    $no=1;
    while($data = mysqli_fetch_assoc($insert)){

        echo '
            <tr>
                <td scope="col">'.$no.'</td>
                <td scope="col"><img src="file/'.$data['gambar'].'" style="width :50px; height:50px;"></td>
                <td scope="col">'.$data['nama'].'</td>
                <td scope="col">'.number_format($data['harga'],0,',','.').'</td>
                <td scope="col">'.$data['jumlah'].'</td>
                <td scope="col">'.number_format($data['total'],0,',','.').'</td>
            </tr>
        ';

        $total += $data['total'];

        $no++;

    }

    echo '
    <tr>
        <td colspan=6 align=right><b>Total : Rp. '.number_format($total,0,',','.').'</b></td>
    </tr>
    
    ';

    break;

    case 'bayar':
    session_start();
    $nama = $_SESSION['user'];

    $query = "SELECT * FROM store";
    $insert = mysqli_query($db,$query);
    $tgl=date('Y-m-d');
    $total = 0;
    $no=1;
    $belanja = '';

    while($data = mysqli_fetch_array($insert)){
        // $nama = array($data['nama']);
        // $orderan = implode('/',$nama);
       
        $belanja .=   $data['nama'].', ';

        $total += $data['total'];
        $no++;
    }

    // $query1 = "UPDATE orderan SET orderan='$belanja', totalbayar='$total', tanggal='$tgl' WHERE nama='$nama'";
    // $insert1 = mysqli_query($db,$query1);
        $query1 = "INSERT INTO orderan (nama, orderan, totalbayar, rekening, alamat, ket, tanggal) VALUE ('$nama', '$belanja', $total , '', '', 0, '$tgl')";
        $insert1 = mysqli_query($db,$query1);
    
        
    echo '
    <div class="modal-header" align=center>
    <img src="img/ovo.jpg"  style="width: 30%; height:60px;">
    
    </div>
    <div class="modal-body" align=center>
    <div>
    <img src="img/qrCode.jpg"  style="width: 70%; height:70%;" >
    
    </div>
    <div>
    <i>Silahkan Scane QR-CODE Di Atas Dan Melakukan Pembayaran Sebesar Rp. '.number_format($total,0,',','.').'</i>
    
    </div>
    </div>
    <div class="modal-footer">
    <button style="width: 20%;" type="button" class="btn btn-primary alamat" data-target="#exampleModal2">Lanjut</button>

    </div>
    
    
     ';
    break;

    case 'alamat':
    session_start();

    $query = "SELECT * FROM store";
    $insert = mysqli_query($db,$query);
    $nama = $_SESSION['user'];
    $hp = $_SESSION['no'];
    $tgl=date('Y-m-d');
    
    $query0 = "UPDATE orderan SET rekening='$hp' WHERE nama='$nama'";
    $insert0 = mysqli_query($db,$query0);
    $kode = rand(100, 5000);



    $no1 = 1;

    $no = 1;
    while($data = mysqli_fetch_assoc($insert)){
        $namaBarang = $data['nama'];
        $harga = $data['harga'];
        $jumlah = $data['jumlah'];
        $total = $data['total'];
        $query1 = "INSERT INTO transaksi (kode, nama, orderan, harga, jumlah, total, rekening, alamat, sts, tanggal) VALUE ('$kode','$nama', '$namaBarang', $harga , $jumlah, $total, '$hp', '',0, '$tgl')";
        $insert1 = mysqli_query($db,$query1);
        $no++;

        $query2 = "SELECT * FROM dataBarang  WHERE nama='$namaBarang'";
        $insert2 = mysqli_query($db,$query2);

        while($data1 = mysqli_fetch_assoc($insert2)){
            $tot = $data1['terjual'] + $jumlah;
            $query3 = "UPDATE dataBarang SET terjual='$tot' WHERE nama='$namaBarang'";
            $insert3 = mysqli_query($db,$query3);
            $no1++;
        }


    }


    echo '
    <form method="post" action="init/troli.php?act=addAlamat">

    <div class="modal-header" align=center>
    <img src="img/atkLogo.png"  style="width: 30%; height:60px;">
    
    </div>
    <div class="modal-body" align=center>
    <div>
    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Pengirim"></textarea>
    
    </div>
    <div>
    
    </div>
    </div>
    <div class="modal-footer">
    <input type="submit" name="submit" style="width: 20%;" type="button" class="btn btn-primary" data-target="#exampleModal2" value="Selesai">
    
    </div>
    </form>
    
    ';
    break;

    case 'addAlamat';
    session_start();
    $query = "DELETE FROM store";
    $insert = mysqli_query($db,$query);
    if($insert){
        $nama = $_SESSION['user'];
        $alamat = $_POST['alamat'];
        $_SESSION['count'] = 0;
        $query = "UPDATE transaksi SET alamat='$alamat' WHERE nama='$nama'";
        $insert = mysqli_query($db,$query);
        $query1 = "UPDATE orderan SET alamat='$alamat', ket=1 WHERE nama='$nama'";
        $insert1 = mysqli_query($db,$query1);
        header('Location: ../');
    }
    
    

    break;


}

?>

<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('.alamat').click(function(){
            $.ajax({
                        url	     : 'init/troli.php?act=alamat',
                        type     : 'POST',
                        dataType : 'html',
                        data     : {'id': 'nsdns'},
                        success  : function(a){
                        //    $('.product-count').html(a)
                        $('.modal-content').html(a);


                    
                        },
                    })
            })
    })


</script>
