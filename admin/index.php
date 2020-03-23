<?php
	session_start();
	include('includes/config1.php');
	if(isset($_POST['login']))
	{
		$username=$_POST['username'];
		// $password=$_POST['password'];
		$password=md5($_POST['password']);
		$flag = 'true';

		$result = $mysqli->query('SELECT id,username,password,userType,id_organisasi from tblauth order by id asc');

		// $result = $mysqli->query('SELECT id,username,password,userType,id_organisasi,creationdate, updationdate from tblauth order by id asc');

		if($result === FALSE){
		die(mysql_error());
		}
		if($result){
			while($obj = $result->fetch_object()){
			  if($obj->username === $username && $obj->password === $password ) {
		  
				$_SESSION['username'] = $username;
				$_SESSION['userType'] = $obj->userType;
				$_SESSION['id'] = $obj->id;
				$_SESSION['id_organisasi'] = $obj->id_organisasi;
				$_SESSION['creationdate'] = $obj->creationdate;
				$_SESSION['updationdate'] = $obj->updationdate;
				  if($obj->userType == "sa" && $obj->id_organisasi == "101") {
						$_SESSION['alogin']=$_POST['username']; 
					  	header("location:dashboard.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "310"){
						$_SESSION['alogin_adminrispol']=$_POST['username'];
					 	header("location:adminrispol/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "206"){
						$_SESSION['alogin_adminhmti']=$_POST['username'];
						header("location:adminhmti/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "101"){
						$_SESSION['alogin_adminbem']=$_POST['username'];
						header("location:adminbem/dashboard-adminorg.php");
			  	  } else if($obj->userType == "admin" && $obj->id_organisasi == "102"){
						$_SESSION['alogin_admindpm']=$_POST['username'];
						header("location:admindpm/dashboard-adminorg.php");
			  	  } else if($obj->userType == "admin" && $obj->id_organisasi == "201"){
						$_SESSION['alogin_adminhimania']=$_POST['username'];
						header("location:adminhimania/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "202"){
						$_SESSION['alogin_adminhma']=$_POST['username'];
						header("location:adminhma/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "203"){
						$_SESSION['alogin_adminhme']=$_POST['username'];
						header("location:adminhme/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "204"){
						$_SESSION['alogin_adminhmm']=$_POST['username'];
						header("location:adminhmm/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "205"){
						$_SESSION['alogin_adminhms']=$_POST['username'];
						header("location:adminhms/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "207"){
						$_SESSION['alogin_adminhmtk']=$_POST['username'];
						header("location:adminhmtk/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "301"){
						$_SESSION['alogin_adminbkm']=$_POST['username'];
						header("location:adminbkm/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "302"){
						$_SESSION['alogin_adminkmkst']=$_POST['username'];
						header("location:adminkmkst/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "303"){
						$_SESSION['alogin_adminkompen']=$_POST['username'];
						header("location:adminkompen/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "304"){
						$_SESSION['alogin_adminmenwa']=$_POST['username'];
						header("location:adminmenwa/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "305"){
						$_SESSION['alogin_adminopagg']=$_POST['username'];
						header("location:adminopagg/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "306"){
						$_SESSION['alogin_adminukmor']=$_POST['username'];
						header("location:adminukmor/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "307"){
						$_SESSION['alogin_adminpasti']=$_POST['username'];
						header("location:adminpasti/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "308"){
						$_SESSION['alogin_adminplfm']=$_POST['username'];
						header("location:adminplfm/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "309"){
						$_SESSION['alogin_adminukmpp']=$_POST['username'];
						header("location:adminukmpp/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "311"){
						$_SESSION['alogin_adminukmseni']=$_POST['username'];
						header("location:adminukmseni/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "312"){
						$_SESSION['alogin_admintalitakum']=$_POST['username'];
						header("location:admintalitakum/dashboard-adminorg.php");
				  } else if($obj->userType == "admin" && $obj->id_organisasi == "313"){
						$_SESSION['alogin_adminusma']=$_POST['username'];
						header("location:adminusma/dashboard-adminorg.php");
				  } else {
						echo "<script>alert('Invalid Details');</script>";
					}
			  } else {
		  
				  if($flag === 'true'){
					echo '<h1>Invalid Login! Redirecting...</h1>';
					header("Refresh: 3; url=index.php");
					$flag = 'false';
				  }
			  }
			}
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
	<link rel="shortcut icon" href="img/favicon-icon/favicon.png">
	<title>Pemilu Polinema | Admin Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>

								</form>
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