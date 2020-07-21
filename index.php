<?php
session_start();
error_reporting(0);
include 'config/db.php';
?>

<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Page- Ustora Demo</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/css.css"> -->
    <!-- <script type="text/javascript" src="js/jq.inview.js"></script> -->
  </head>
  <body>
   
    <div class="header-area mainmenu-area" >
        <div class="container" >
            <div class="row" >
                <div class="col-md-8" >
                    <div class="user-menu" >
                       <?php if(!$_SESSION['user']): ?>
                       <ul >
                            <li><a href="#" class="ca"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="#" class="ck"><i class="fa fa-user"></i> Checkout</a></li>
                            <li><a href="daftar.php"><i class="fa fa-user"></i> Register</a></li>
                        </ul>
                        <?php endif; ?>
                        <?php if($_SESSION['user']): ?>
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['user']; ?></a></li>
                            <li><a href="#" class="cek" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Checkout</a></li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        
                        <ul class="list-unstyled list-inline">
                        <?php if(!$_SESSION['user']):?>
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-user">Login :</span></a>
                                <ul class="dropdown-menu" style="width: 250%; margin-left:-100px">
                                    <li >
                                        <form method="post" action="init/init.php?act=login">
                                            <div class="container">
                                            <div class="form-group" style="width: 18%">
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group" style="width: 18%">
                                                <input type="password" class="form-control" name="pass" placeholder="Password">
                                            </div>
                                            <div class="checkbox" style="width: 18%">
                                                <label><input type="checkbox"> Remember me</label>
                                            </div>
                                            <div style="width: 18%; ">
                                            <input  type="submit" class="btn btn-primary" value="Login" name="submit" />

                                            </div>
                                            </div>
                                            
                                        </form>


                                    </li>
                                    
                                </ul>
                            </li>
                            <?php endif; if($_SESSION['user']):?>
                            <a href="init/init.php?act=logout"><span style="margin-top: 10px;" class="fa fa-sign-out">Logout</span></a>
                        <?php endif ?>
                        </ul>

                        
                    </div>
                </div>
            </div>
        </div>

            
        <div class="site-branding-area ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <h1><a href="./"><img src="img/atkLogo.png" style="width:25%; height:20%;"></a></h1>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                    <?php  if($_SESSION['user']): ?>
                        <div class="shopping-item">
                            <a href="#" data-toggle="modal" class="cek" data-target="#exampleModal">Troli<span class="cart-amunt"></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?= $_SESSION['count']?></span></a>
                        </div>
                    <?php endif;  ?>

                    <?php  if(!$_SESSION['user']): ?>
                        <div class="shopping-item">
                            <a href="#" data-toggle="modal"  class="log">Troli<span class="cart-amunt"></span> <i class="fa fa-shopping-cart"></i> <span class=""></span></a>
                        </div>
                    <?php endif;  ?>
                    </div>
                </div>
            </div>
        </div> <!-- End site branding area -->
    </div> <!-- End header area -->

    


    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row data">
            <?php 
                $query = "SELECT * FROM dataBarang ORDER BY id DESC";
                $data = mysqli_query($db,$query);
                $no = 1;
                if($data){
                    // for ($i=0; $i < 8 ; $i++) {
            
            
                     while($loop = mysqli_fetch_assoc($data)){
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="" >
                            <!-- <img src="img/product-2.jpg" alt=""> -->
                            <img style="width:190px; height:243px; border-radius:10px;" src="file/<?= $loop['gambar']?>" alt="">
                            <input type="hidden" class="gambar-<?= $loop['id']?> ?>"  value="<?= $loop['gambar'] ?>" />

                        </div>
                        <h2><a href=""><?= $loop['nama'] ?></a>
                        <input type="hidden" class="nama-<?= $loop['id']?> ?>"  value="<?= $loop['nama'] ?>" />
                        </h2>
                        <div class="product-carousel-price">
                        <input type="hidden" class="harga-<?= $loop['id']?> ?>"  value="<?= $loop['harga'] ?>" />

                            <ins><?= 'Rp. '.number_format($loop['harga'],0,',','.') ?></ins> 
                            <!-- <del>$999.00</del> -->
                            <span style="font-size:10px;"><b><?=  $loop['ket']?></b></span>&nbsp&nbsp&nbsp&nbsp&nbsp
                            <span style="font-size:11px;">Tersisa : <?=  $loop['stok']?></span>
                        </div>  
                        
                        <div class="product-option-shop">
                            <?php if($_SESSION['user']):  ?>
                            <span style="width:190px; cursor:pointer;" align=center class="add_to_cart_button beli" id="<?= $loop['id']?>"  data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow">BELI</span>
                            <?php endif;?>
                            <?php if(!$_SESSION['user']):  ?>
                            <span style="width:190px; cursor:pointer;" align=center class="add_to_cart_button beli1" id="<?= $loop['id']?>"  data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow">BELI</span>
                            <?php endif;?>
                            <input type="hidden" class="jumlah-<?= $loop['id']?> count"  value="0" />
                        </div>                       
                    </div>
                </div>
                    <?php $no++; }}?>      
            </div>

            <!-- Modal 1 -->
            <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">TROLI <i class="fa fa-shopping-cart"></i></h4>

                        </div>
                        <div class="modal-body">
                        <table class="table table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="col">1</td>
                                            <td scope="col"><img src="file/map.jpg" style="width :50px; height:50px;"></td>
                                            <td scope="col">Buku</td>
                                            <td scope="col">20000</td>
                                            <td scope="col">2</td>
                                            <td scope="col">40000</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary pay" data-target="#exampleModal2">Lanjut Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EndModal 1 -->

          
            
<!-- 
            <div class="row">
                <div class="col-md-12">
                    <div class="bawah" id="bawah">
                        <div class="loader">
                            <img src="img/loading.gif" class="load" id="load" style="visibility: hidden;">
                        </div>		
                    </div>
                </div>
            </div> -->
        </div>
    </div>


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>ATK<span>STORE</span></h2>
                        <p>ATK STORE adalah aplikasi layanan pemesanan Alat Tulis Kantor (ATK) yang berpusat di Parepare. Aplikasi ini sangat membatu bagi para pekerja kantoran untuk memesan sebuah alat tulis tanpa harus keluar kantor. </p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Layanan Kami </h2>
                        <ul>
                            <li><a href="#">Pengiriman Cepat</a></li>
                            <li><a href="#">Dukungan Pembayaran OVO</a></li>
                            <li><a href="#">Dapat Diakses Di Mana Saja</a></li>
                            <li><a href="#">Tersedia ATK Yang Lengkap</a></li>
                            <li><a href="#">Aplikasi Yang Mudah Di Gunakan</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="">Buku Tulis</a></li>
                            <li><a href="">Aneka Jenis Kertas</a></li>
                            <li><a href="">Alat Tulis</a></li>
                            <li><a href="">Penggaris</a></li>
                            <li><a href="">Dll</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Kontak Support</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2020 ATK STORE. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i ><img src="img/obo1.jpg"  style="width:50px; height: 30px;" /></i>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
		//   $(document).ready(function(){
             
        //      $('#bawah').on('inview', function(event, isInView) {
        //      	$('#load').attr('style', 'visibility:visible');
        //          if (isInView) {                 	
                     
        //              $.ajax({
        //                  type: 'POST',
        //                  url: 'init/init.php?act=show',
        //                  data: { page: 3 },
        //                  success: function(data){
        //                      console.log(data)
        //                      if(data != ''){							 
        //                          $('.data').append(data);
        //                          // $('#load').attr('style', 'visibility:hidden');
        //                      } else {								 
        //                          $("#loader").hide();
        //                      }
        //                  }
        //              });
        //          }
        //      });
        //  });


        $(document).ready(function(){
            $('.beli').click(function(){
                var id = $(this).attr('id')
                var jumlah = $('.jumlah-'+id).val();
                var total = parseInt(jumlah) + parseInt(1);
                var total1  = $('.jumlah-'+id).val(total);

                var nama = $('.nama-'+id).val();
                var harga = $('.harga-'+id).val();
                var gambar = $('.gambar-'+id).val();
                var jumlah1 = $('.jumlah-'+id).val();
                var total = parseInt(jumlah1) * parseInt(harga);
                 
                 
                
                
                $.ajax({
                        url	     : 'init/init.php?act=cekout',
                        type     : 'POST',
                        dataType : 'html',
                        data     : {'id': id , 'nama': nama, 'harga': harga, 'gambar':gambar, 'jumlah': jumlah1, 'total': total},
                        success  : function(a){
                           $('.product-count').html(a)

                      
                        },
                    })
            })


            $('.cek').click(function(){
                $.ajax({
                        url	     : 'init/troli.php?act=showCekout',
                        type     : 'POST',
                        dataType : 'html',
                        data     : {'id': 'nsdns'},
                        success  : function(a){
                        //    $('.product-count').html(a)
                        $('tbody').html(a);

                    
                        },
                    })
            })

            $('.pay').click(function(){
                $.ajax({
                        url	     : 'init/troli.php?act=bayar',
                        type     : 'POST',
                        dataType : 'html',
                        data     : {'id': 'nsdns'},
                        success  : function(a){
                        //    $('.product-count').html(a)
                        $('.modal-content').html(a);


                    
                        },
                    })
            })

            $('.log').click(function(){
                alert('Anda Harus Login Dulu');
            })

            $('.ck').click(function(){
                alert('Anda Harus Login Dulu');
            })
            $('.ca').click(function(){
                alert('Anda Harus Login Dulu');
            })
            $('.beli1').click(function(){
                alert('Anda Harus Login Dulu');
            })
            beli1
            


        })
	</script>
    <!-- Latest jQuery form server -->

    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>