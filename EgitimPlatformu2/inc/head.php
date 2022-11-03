<?php 
include("vt.php");
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo $sayfa ?> | Sınırsız Eğitim  </title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="jqueryui/jquery-ui.css">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body>
<!--bolum1 başlangıc-->
<section class="container-fluid bolum1" id="ilkbolum">
  
	<div class="overlay"></div>
  <div class="container"> 
    <!--		navigasyon Başlangıc-->
    <nav class="navbar navbar-expand-xl navbar-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <a class="navbar-brand" href="#"> <span class="logo p-3"> <img src="images/icon/sonsuz.png" alt=""></span> <span class="boyut renk1">SINIRSIZ</span> <span class="boyut">EĞİTİM</span> </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item normal <?php if($sayfa=="Ana Sayfa") echo "active" ?>"> <a class="nav-link " href="anasayfa">Ana Sayfa <span class="sr-only">(current)</span></a> </li>
          <li class="nav-item normal <?php if($sayfa=="İçerik") echo "active" ?>"> <a class="nav-link" href="icerik">İçerik</a> </li>
          <li class="nav-item normal <?php if($sayfa=="Hakkımızda") echo "active" ?>"> <a class="nav-link " href="hakkimizda">Hakkımızda</a> </li>
          <li class="nav-item normal <?php if($sayfa=="İletişim") echo "active" ?>"> <a class="nav-link " href="iletisim">İletişim</a> </li>
          <?php if (!isset($_SESSION["yetki"]) == "" ) { ?>
                            <li class="nav-item dropdown">
                            
                <a style="color: white; font-weight:700" class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["kadi"] ?></a>
                <div style="background-color: #ff00fb;" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="parolaGuncelle.php">Parola Değiştir</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../../EgitimPlatformu2/admin/logout.php">Çıkış</a>
                </div>

            
                            </li>
                        <?php } else {  ?> <li class="nav-item"> <a class="nav-link btn buton" href="../../EgitimPlatformu2/admin/login.php">Eğitmen Girişi</a> </li>
                          <li class="nav-item"> <a class="nav-link btn buton" href="../../EgitimPlatformu2/admin/login.php">Kullanıcı Girişi</a> </li> <?php } ?> 
          
        </ul>
      </div>
    </nav>
    <!--		navigasyon bitiş-->

                        