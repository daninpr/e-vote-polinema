<?php 
session_start();


include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0) { 
  header('location:index.php');
  
} else{
  if(isset($_POST['submitvote'])) {
    $idmhs=$_SESSION["login"];
    $statuspilih=$_POST['statuspilih'];
    // $id_event=$_GET['id_event'];

    $sql="update mhs set statuspilih=:statuspilih where nim=:idmhs ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':idmhs', $idmhs, PDO::PARAM_STR);
    $query->bindParam(':statuspilih', $statuspilih, PDO::PARAM_STR);
    // $query->bindParam(':id_event', $id_event, PDO::PARAM_STR);
    $query->execute();
  }
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Pemilu Polinema</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>


<body>
  <?php include('includes/colorswitcher.php');?>
  <?php include('includes/header.php');?>
  <div class="container">
    <div class="row"> 
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
        </ul>
      </div>
      <div class="tab-content">
      <form method="post" action="vote-event.php" class="form-horizontal" >
        <div class="row">
          <div class="col-md-12">
            <div role="tabpanel" class="tab-pane active" id="id_caketum">
         
                <?php
                  if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                  <?php 
                  $id_event=intval($_GET['id_event']);
                  // $sql = "SELECT calon_ketum.nim, calon_ketum.nama_calon, calon_ketum.tmp_lhr, calon_ketum.tgl_lahir, 
                  //       calon_ketum.agama, calon_ketum.visi, calon_ketum.misi,calon_ketum.CKimage, tblevent.nama_event, mhs.id_event, mhs.idmhs
                  //           from calon_ketum join tblevent 
                  //           on tblevent.id_event = calon_ketum.id_event
                  //           join mhs
                  //           on mhs.id_event = tblevent.id_event
                  //           where mhs.id_event=:id_event";
                  $sql = "SELECT calon_ketum.nim, calon_ketum.nama_calon, calon_ketum.tmp_lhr, calon_ketum.tgl_lahir, 
                        calon_ketum.agama, calon_ketum.visi, calon_ketum.misi,calon_ketum.CKimage, tblevent.nama_event
                            from calon_ketum join tblevent 
                            on tblevent.id_event = calon_ketum.id_event
                            where calon_ketum.id_event=:id_event";

                  $query = $dbh -> prepare($sql);
                  $query-> bindParam(':id_event', $id_event, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                  foreach($results as $key=>$result)
                  {  
                    echo "ini event atas $id_event";
                ?>  
         
            <div class="col-list-3">
              <div class="recent-car-list">
                <div class="car-info-box"> <img src="calon_ketum/<?php echo htmlentities($result->CKimage);?>" class="img-responsive" alt="image"></a>
                  <ul>
                    <li><i class="fa fa-user" aria-hidden="true"></i>Calon Ketua Umum <?php echo $key+1 ?> </li>
                    <li><i aria-hidden="true"><input type="radio" name="statuspilih" value="<?php echo $key+1 ?>"> Calon Ketua Umum <br></i></li>
                    <li><i aria-hidden="true"></i></li>
                  </ul>
                </div>
                <div class="car-title-m">
                  <h6><a href="profile_caketum.php?nim=<?php echo $result->nim;?>"><?php echo htmlentities($result->nama_calon);?> </a></h6>
                  <span class="price"><?php echo htmlentities($result->nama_event);?> </span> 
                  <p><?php echo htmlentities($result->id_event);?> </p>
                </div>
              </div>
            </div>

            <?php 
              }
              }
            ?>
             
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div role="tabpanel" class="tab-pane active" id="id_caketum" style="margin-top:20px;">
              <div class="col-md-12">
                <button class="btn btn-primary" name="submitvote" type="submit">Vote</button>
              </div>
            </div>
          </div>
      </div>
      </form>

      <?php
      if(isset($_POST['submitvote'])) {
          $idmhs=$_SESSION["idmhs"];
          $statuspilih=$_POST['statuspilih'];
          $id_event=$_GET['id_event'];

          echo $idmhs;
          echo "$statuspilih \n";
          echo "ini event $id_event";
      }
      ?>

    </div>
  </div>
<!-- /Resent Cat --> 
  </div>


<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>