<?php 
session_start();
include('includes/config.php');
error_reporting(0);


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

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!-- Banners -->
<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content"></div> 
        </div>

      </div>
    </div>
  </div>
</section>
<!-- /Banners --> 



<!-- Resent Cat-->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Pemilu OKI Polinema</h2>
      <p>OKI Polinema atau singkatan dari Organisasi Kemahasiswaan Intra Politeknik Negeri Malang adalah wadah perjuangan bersama yang menghimpun mahasiswa Politeknik Negeri Malang dalam suatu ikatan moral dan intelektual. Organisasi yang tergabung dalam OKI Polinema terdiri dari dua lembaga tinggi (LT), enam himpunan mahasiswa jurusan (HMJ), dan tiga belas unit kegiatan mahasiswa (UKM).</p>
    </div>
    <div class="row"> 
      
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#nim" role="tab" data-toggle="tab">Pemilihan</a></li>
        </ul>
      </div>
      
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="nim">

        <?php 
        $nim=$_SESSION['login'];
        $sql = "SELECT tblevent.id_event,tblevent.nama_event, organisasi.nama_org, tblevent.thn_pemilu, mhs.id_organisasi
        from tblevent join organisasi
        on tblevent.id_organisasi = organisasi.id_organisasi
        join mhs
        on mhs.id_organisasi = organisasi.id_organisasi
        where mhs.nim =:nim";

        $query = $dbh -> prepare($sql);
        $query-> bindParam(':nim', $nim, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $result)
        {  
        ?>  

        <div class="col-list-3">
          <div class="recent-car-list">
            <div class="car-info-box"> 
            </div>
            <div class="car-title-m">
              <h6><a href="vote-event.php?id_event=<?php echo htmlentities($result->id_event);?>"><?php echo htmlentities($result->nama_event);?> </a></h6>
            </div>
            <div class="inventory_info_m">
              <p><?php echo substr($result->nama_org,0,70);?></p>
            </div>
            <div class="car-title-m">
              <h6>
                <a href="hasil-vote.php?id_event=<?php echo htmlentities($result->id_event);?>"> 
                  <button class="btn btn-primary" name="" type="submit">Hasil</button>
                </a>
              </h6>
            </div>
           
          </div>
        </div>
        <?php }}?>
       
      </div>
    </div>
  </div>
</section>
<!-- /Resent Cat --> 




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