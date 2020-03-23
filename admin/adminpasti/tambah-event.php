<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin_adminpasti'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  	{
		$nama_event = $_POST['nama_event'];
		$nama_org = $_POST['nama_org'];
		$thn_pemilu = $_POST['thn_pemilu'];

		$sql="INSERT INTO tblevent(nama_event,id_organisasi,thn_pemilu) VALUES(:nama_event,:nama_org,:thn_pemilu)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':nama_event', $nama_event, PDO::PARAM_STR);
		$query->bindParam(':nama_org', $nama_org, PDO::PARAM_STR);
		$query->bindParam(':thn_pemilu', $thn_pemilu, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
		$msg="Event berhasil ditambahkan";
		}
		else 
		{
		$error="Something went wrong. Please try again";
		}
}
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
	
	<title>Pemilu Polinema | Tambah Event</title>

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
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header-adminorg.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar-adminorg.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Tambah Event</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											

											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Event<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="nama_event" id="nama_event" class="form-control" required>
												</div>
											</div>

                                            <div class="form-group">

												<label class="col-sm-2 control-label">Organisasi<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="selectpicker" data-size="4" name="nama_org" id="nama_org" required>
													<option value=""> Select </option>
														<?php $ret="select id_organisasi,nama_org from organisasi";
														$query= $dbh -> prepare($ret);
														//$query->bindParam(':id',$id, PDO::PARAM_STR);
														$query-> execute();
														$results = $query -> fetchAll(PDO::FETCH_OBJ);
														if($query -> rowCount() > 0)
														{
															foreach($results as $result)
														{
														?>
														<option value="<?php echo htmlentities($result->id_organisasi);?>"><?php echo htmlentities($result->nama_org);?></option>
														<?php }} ?>

													</select>
												</div>
											</div>

                                            <div class="form-group">
												<label class="col-sm-2 control-label">Tahun Pemilu<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="thn_pemilu" id="thn_pemilu" class="form-control" required>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>
								
										
							



										</form>
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
</body>
</html>
<?php } ?>