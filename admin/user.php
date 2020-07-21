<?php
session_start();
include '../config/db.php';

if(!$_SESSION['admin']){
	header("Location:../");
}
global $db;
$query2 = "SELECT * FROM user ORDER BY id DESC";
$data2 = mysqli_query($db,$query2);
$no =1;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino UI Elements</title>
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
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="admin.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="barang.php"><em class="fa fa-desktop">&nbsp;</em> Data Barang</a></li>
			<li><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan Keuangan</a></li>
			<li class="active"><a href="user.php"><em class="fa fa-user">&nbsp;</em> User</a></li>
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
				<li class="active">Data User</li>
			</ol>
		</div><!--/.row-->
		

				
		
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Data User</div>
					<div class="panel-body">
					<table class="table table-sm">
							<thead class="thead-dark">
								<tr>
								<th scope="col">No</th>
								<th scope="col">Nama</th>
								<th scope="col">Email</th>
								<th scope="col" >No Handphone</th>
								<!-- <th scope="col">Status</th> -->
								</tr>
							</thead>

							<tbody>
							<?php  while($loop = mysqli_fetch_assoc($data2)){ ?>
								<tr>
									<th scope="row"><?= $no ?></th>
									<td><?=  $loop['nama'] ?></td>
									<td><?=  $loop['email'] ?></td>
									
									<td><?= $loop['hp'] ?></td>
									</tr>

							<?php $no++; } ?>
							</tbody>
						</table>
					</div>
				</div><!-- /.panel-->
				
				
				

		</div><!-- /.row -->
	</div><!--/.main-->
	
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
