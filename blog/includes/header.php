<?php

include "../mysql_connect.php";

$settings=$db->prepare("SELECT * FROM ayarlar ");
$settings->execute();
$check_settings=$settings->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
  <head>
    <title><?php echo $check_settings['site_title'];?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $check_settings['site_desc'];?>">
    <meta name="keywords" content="<?php echo $check_settings['site_keyw'];?>">
    <meta name="author" content="Sedanur Çevik">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="Shortcut Icon" href="../blog/images/logo-favicon/<?php echo $check_settings['site_favicon'];?>">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
      <!--sweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    <div class="container">
	     <div id = "logo">
            <a href="index"><img src="images/logo-favicon/<?php echo $check_settings['site_logo'];?>" alt="Sayfa logosu" width="45px" height="45px"/></a>
         </div>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menü
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="index" class="nav-link"><span>Anasayfa</span></a></li>
	          <li class="nav-item"><a href="#about-section" class="nav-link"><span>Hakkımda</span></a></li>
            <li class="nav-item"><a href="#services-section" class="nav-link"><span>Hizmetler</span></a></li>
	          <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Projeler</span></a></li>
	          <li class="nav-item"><a href="blog" class="nav-link"><span>Blog</span></a></li>
	          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>İletişim</span></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>