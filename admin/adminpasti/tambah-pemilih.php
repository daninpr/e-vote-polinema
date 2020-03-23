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
		$nim=$_POST['nim'];
		$nama_lengkap=$_POST['nama_lengkap'];
		$password=md5($_POST['password']);
		$id_organisasi=$_POST['id_organisasi'];
		$id_event=$_POST['id_event'];

		$sql="INSERT INTO mhs(nim, nama_lengkap, password, id_organisasi, id_event) 
		VALUES(:nim, :nama_lengkap, :password, :id_organisasi, :id_event)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':nim', $nim, PDO::PARAM_STR);
		$query->bindParam(':nama_lengkap', $nama_lengkap, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->bindParam(':id_organisasi', $id_organisasi, PDO::PARAM_STR);
		$query->bindParam(':id_event', $id_event, PDO::PARAM_STR);
		$query->execute();
		
		$msg="Pemilih posted successfully";
		

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
	
	<title>Pemilu Polinema | Admin Post pemilih</title>

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
					
						<h2 class="page-title">Tambah Pemilih</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
			
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">NIM<span style="color:red">*</span></label>
													<div class="col-sm-4">
													<input type="text" name="nim" class="form-control" required>
													</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Nama<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="nama_lengkap" class="form-control" required>
												</div>
											</div>

                                            <div class="form-group">
												<label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="password" class="form-control" required>
												</div>
											</div>

                                            <div class="form-group">
												<label class="col-sm-2 control-label">Organisasi<span style="color:red">*</span></label>
												<div class="col-sm-4">
												<select class="selectpicker" data-size="7" name="id_organisasi" required>
												<option value=""> Select </option>

												<?php $ret="select id_organisasi, nama_org from organisasi";
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
												<label class="col-sm-2 control-label">Event<span style="color:red">*</span></label>
												<div class="col-sm-4">
												<select class="selectpicker" data-size="7" name="id_event" required>
												<option value=""> Select </option>

												<?php $ret="select id_event, nama_event from tblevent";
												$query= $dbh -> prepare($ret);
												//$query->bindParam(':id',$id, PDO::PARAM_STR);
												$query-> execute();
												$results = $query -> fetchAll(PDO::FETCH_OBJ);
												if($query -> rowCount() > 0)
													{
												foreach($results as $result)
													{
												?>
												<option value="<?php echo htmlentities($result->id_event);?>"><?php echo htmlentities($result->nama_event);?></option>
												<?php }} ?>
												</select>
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