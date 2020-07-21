<?php   
include '../config/db.php';
session_start();

if(!$_SESSION['admin']){
	header("Location:../");
}
global $db;
$query1 = "SELECT * FROM transaksi ORDER BY id DESC";
$data1 = mysqli_query($db,$query1);
$no = 1;

$query2 = "SELECT * FROM dataBarang ";
$data2 = mysqli_query($db,$query2);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
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
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<ul class="nav menu">
			<li><a href="admin.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="barang.php"><em class="fa fa-desktop">&nbsp;</em> Data Barang</a></li>
			<li class="active"><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan Keuangan</a></li>
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
				<li class="active">Laporan Keuangan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Laporan Keuangan</h1>
			</div>
		</div><!--/.row-->
		<?php 

			$terjual = 0;					
			$total2 = 0;
			
			while($loop2 = mysqli_fetch_assoc($data2)){
				$total2 += $loop2['stok'];
				$terjual += $loop2['terjual'];
			}

			$sisa = $total2 - $terjual;
			?>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart"  data-percent="56" ><span class="percent"><?= $total2?></span>Total Barang Masuk</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart"  data-percent="92" ><span class="percent"><?= $terjual ?></span>Total Barang Keluar</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" data-percent="65" ><span class="percent"><?= $sisa  ?></span>Sisa Stok</div>
					</div>
				</div>
			</div>

			<?php 

						 
					$tota = 0;
					while($data = mysqli_fetch_assoc($data1)){
						$tota += $data['total'];
					}
			?>

			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart"  ><span class="percent"><span style="font-size:13px;">Rp.</span><?= number_format($tota,0,',','.')?></span>Pemasukan</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					Laporan
					<input class="tgl" style="width: 150px; outline:none; border: 4px; font-size:13px; margin-left:690px;" type="date" class=" "/>
						<ul class="pull-right panel-settings panel-button-tab-right">
						
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								
								<em class="fa fa-print print"></em>
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
								<th scope="col"  width="30%" align="center">Nama</th>
								<th scope="col">Terjual</th>
								<th scope="col"  >Harga</th>
								<th scope="col"  >Tanggal</th>
								<th scope="col"  >Jumlah</th>
								
								</tr>
							</thead>
							<?php    
							 $query = "SELECT * FROM transaksi ORDER BY id DESC";
							 global $db;
							 $data1 = mysqli_query($db,$query);
							 $no = 1;
							 	
							$tot = 0;
							
							 ?>
							<tbody>
								<?php  while($data = mysqli_fetch_assoc($data1)){ ?>
								<tr>
									<td><?=$no ?></td>
									<td><?= $data['orderan'] ?></td>
									<td><?= $data['jumlah'] ?></td>
									<td><?='Rp.  '. number_format($data['harga'],0,',','.') ?></td>
									<td><?= $data['tanggal'] ?></td>
									<td><?='Rp.  '. number_format($data['harga']* $data['jumlah'],0,',','.')  ?></td>
									<?php $tot += $data['harga']* $data['jumlah'];$no++; } ?>
									
								</tr>
								<tr>
								<td  colspan=4></td>
								<td align="right">Total:</td>
								<td ><b> <?= 'Rp. '. number_format($tot,0,',','.');?></b></td>
								</tr>
								
							</tbody>

							
						</table>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
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
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart5 = document.getElementById("radar-chart").getContext("2d");
	window.myRadarChart = new Chart(chart5).Radar(radarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.05)",
	angleLineColor: "rgba(0,0,0,.2)"
	});
	var chart6 = document.getElementById("polar-area-chart").getContext("2d");
	window.myPolarAreaChart = new Chart(chart6).PolarArea(polarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	segmentShowStroke: false
	});
};
	</script>	

	<script type="text/javascript">
		$(document).ready(function(){


			$('.tgl').change(function(){
				var tgl = $(this).val();
				$.ajax({
				url	     : '../ajax/admin.php?act=transaksiFilter',
				type     : 'POST',
				dataType : 'html',
				data     : {'tgl' : tgl},
				success  : function(a){
					$('tbody').html(a)

			
				},
			})
				
			})

			$('.print').click(function(){
				var tgl = $('.tgl').val();
					$.ajax({
					url	     : '../ajax/admin.php?act=printKeuangan',
					type     : 'POST',
					dataType : 'html',
					data     : {'tgl' : tgl},
					success  : function(a){
						console.log(a)

						document.location='cetak/keuangan.php?tgl='+tgl+'';
					},
				})
			})
		})
	</script>
</body>
</html>
