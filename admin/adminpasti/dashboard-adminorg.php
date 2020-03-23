<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin_adminpasti'])==0)
	{	
		header('location:index.php');
	}
	else{
	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<link rel="shortcut icon" href="img/favicon-icon/favicon.png">
	<title>Pemilu Polinema | Admin Dashboard</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('includes/header-adminorg.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar-adminorg.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard ADMIN ORGANISASI</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<?php 
														$sql ="SELECT mhs.nim from mhs join tblauth on mhs.id_organisasi=tblauth.id_organisasi where mhs.id_organisasi =307";
														$query = $dbh -> prepare($sql);
														$query->execute();
														$results=$query->fetchAll(PDO::FETCH_OBJ);
														$totalmhs=$query->rowCount();
													// }
													
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($totalmhs);?></div>
													<div class="stat-panel-title text-uppercase">Pemilih</div>
												</div>
											</div>
											<a href="manage-pemilih.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
													<?php 
														$sql2 ="SELECT calon_ketum.idcalon from calon_ketum join tblauth on calon_ketum.id_organisasi=tblauth.id_organisasi where calon_ketum.id_organisasi =307";
														$query2= $dbh -> prepare($sql2);
														$query2->execute();
														$results2=$query2->fetchAll(PDO::FETCH_OBJ);
														$totalcaketum=$query2->rowCount();
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($totalcaketum);?></div>
													<div class="stat-panel-title text-uppercase">Calon Ketua</div>
												</div>
											</div>
											<a href="manage-caketum.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
													<?php 
													$sql3 ="SELECT tblevent.id_event from tblevent join tblauth on tblevent.id_organisasi=tblauth.id_organisasi where tblevent.id_organisasi =307";
														
													// $sql3 ="SELECT id_event from tblevent ";
													$query3= $dbh -> prepare($sql3);
													$query3->execute();
													$results3=$query3->fetchAll(PDO::FETCH_OBJ);
													$totalevent=$query3->rowCount();
													?>												
													<div class="stat-panel-number h1 "><?php echo htmlentities($totalevent);?></div>
													<div class="stat-panel-title text-uppercase">Event</div>
												</div>
											</div>
											<a href="manage-event.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>