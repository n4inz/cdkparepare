<?php 
session_start();
include '../config/db.php';

if(!$_SESSION['admin']){
	header("Location:../");
}
global $db;

$query1 = "SELECT * FROM orderan WHERE ket=1 ORDER BY id DESC";
$data1 = mysqli_query($db,$query1);
$no = 1;
$totalOrder = mysqli_num_rows($data1);

$query2 = "SELECT * FROM user";
$data2 = mysqli_query($db,$query2);
$totalUser = mysqli_num_rows($data2);

$query3 = "SELECT * FROM dataBarang";
$data3 = mysqli_query($db,$query3);
$totalBarang = mysqli_num_rows($data3);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
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
			<li class="active"><a href="admin.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="barang.php"><em class="fa fa-desktop">&nbsp;</em> Data Barang</a></li>
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
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large"><?=  $totalOrder?></div>
							<div class="text-muted">Orderan</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
							<div class="large">0</div>
							<div class="text-muted">Kotak Masuk</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"><?= $totalUser ?></div>
							<div class="text-muted">User</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-archive  "></em>
							<div class="large"><?= $totalBarang ?></div>
							<div class="text-muted">Data Barang</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Orderan
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>

							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
						<table class="table table-sm">
							<thead class="thead-dark">
								<tr>
								<th scope="col">No</th>
								<th scope="col">Nama</th>
								<th scope="col" width="30%">Orderan</th>
								<th scope="col" >Total</th>
								<th scope="col">Rek OVO</th>
								<th scope="col">Alamat</th>
								<th scope="col">Tanggal</th>
								<!-- <th scope="col">Status</th> -->
								</tr>
							</thead>

							<tbody>
							<?php  while($loop = mysqli_fetch_assoc($data1)){ ?>
								<tr>
									<th scope="row"><?= $no ?></th>
									<!-- <td><span id="" class="tampil" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal"><?= $loop['kode'] ?></span></td> -->
									<td><?=  $loop['nama'] ?></td>
									<td><?=  $loop['orderan'] ?></td>
									<!-- <td>'.$loop['harga'].'</td> -->
									<td><?= number_format($loop['totalbayar'],0,',','.')?></td>        
									
									<td><?= $loop['rekening'] ?></td>
									<td><?= $loop['alamat'] ?></td>        
									<td><?= $loop['tanggal'] ?></td>
									<!-- <td>sts</td> -->
									</tr>

							<?php $no++; } ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				
				
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
		</div>
		<!-- Modal -->
		
		
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>

	<script type="text/javascript" >
		$(document).ready(function(){
			// $.ajax({
			// 	url	     : '../ajax/admin.php?act=showDataTransaksi',
			// 	type     : 'POST',
			// 	dataType : 'html',
			// 	//data     : 'data='+val,
			// 	success  : function(a){
			// 		$('tbody').html(a)

			
			// 	},
			// })

			$('.tampil').click(function(){
				var id = $(this).attr('id');
		
				$.ajax({
					url	     : '../ajax/admin.php?act=modalShow',
					type     : 'POST',
					dataType : 'html',
					data     : {'id': id},
					success  : function(a){
						// $('tboddy').html(a)
						alert(a)
				
					},
				})
			})
		})
	</script>
		
</body>
</html>