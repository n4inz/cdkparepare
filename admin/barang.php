<?php
session_start();


if(!$_SESSION['admin']){
	header("Location:../");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Barang</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Admin</span>Penjualan</a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="admin.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="active"><a href="barang.php"><em class="fa fa-desktop">&nbsp;</em> Data Barang</a></li>
			<li><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan Keuangan</a></li>
			<li><a href="user.php"><em class="fa fa-user">&nbsp;</em> User</a></li>
			<li><a href="#"><em class="fa fa-comment-o">&nbsp;</em> Kotak Masuk</a></li>
			<li><a href="../ajax/admin.php?act=logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-desktop"></em>
				</a></li>
				<li class="active">Data Barang</li>
			</ol>
		</div><!--/.row-->
		
		<!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Data Barang

						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
						<table class="table table-sm">
							<thead class="thead-dark">
								<tr>
								<th scope="col">No</th>
								<th scope="col"  width="40%" align="center">Nama</th>
								<th scope="col"  width="15%">Stok</th>
								<th scope="col" width="10%">Terjual</th>
								<th scope="col"  width="10%">Harga</th>
								<th scope="col"  width="10%">Ket</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	<div class="row">
		<div class="col-md-6">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				Tambah Barang
			
				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
			<div class="panel-body">
				<form class="form-horizontal" action="../init/admin.php?act=tambahBarang" method="post" enctype="multipart/form-data">
					<fieldset>
						<!-- barang input-->
						<div class="form-group">
							<label class="col-md-3 control-label" for="name">Jenis Barang</label>
							<div class="col-md-9">
								<input  name="barang" type="text" placeholder="Jenis Barang" class="form-control">
							</div>
						</div>
					
						<!-- stok input-->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email">Jumlah Stok </label>
							<div class="col-md-9">
								<input  name="stok" type="text" placeholder="Jumlah Stok" class="form-control">
							</div>
						</div>

						<!-- Harga-->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email">Harga </label>
							<div class="col-md-9">
								<input  name="harga" type="number" placeholder="Harga" class="form-control">
							</div>
						</div>

						<!-- Ket-->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email">Keterangan </label>
							<div class="col-md-9">
								<input  name="ket" type="text" placeholder="Keterangan" class="form-control">
							</div>
						</div>
						
						<!-- Message body -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="message">Gambar</label>
							<div class="col-md-9">
							<input type="file" name="file" accept="image/*" capture="camera" id="camera">
                        	
							</div>
						</div>
						
						<!-- Form actions -->
						<div class="form-group">
							<div class="col-md-12 widget-right">
								<input type="submit" name="submit" class="btn btn-default btn-md pull-right" />
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!--/.col-->
			
			<div class="col-md-6">
		
				<div class="panel panel-default">
					<div class="panel-heading">
						Gambar

						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
					<div class="form-group">
							<div class="col-md-12 widget-right" style="height:250px;">
							<img id="frame" width="50%">
							</div>
						</div>

					</div>
				</div>
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->
	  
    <script>
		var camera = document.getElementById('camera');
		var frame = document.getElementById('frame');

		camera.addEventListener('change', function(e) {
			var file = e.target.files[0]; 
			// Do something with the image file.
			frame.src = URL.createObjectURL(file);
		});
	</script>
	<script>
		$(document).ready(function(){
				$.ajax({
				url	     : '../ajax/admin.php?act=showData',
				type     : 'POST',
				dataType : 'html',
				//data     : 'data='+val,
				success  : function(a){
					$('tbody').html(a)

			
				},
			})


		

			
    	})
	</script>
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
