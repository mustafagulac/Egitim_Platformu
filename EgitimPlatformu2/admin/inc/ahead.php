<?php
session_start();
if (!(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789")) {
    header(header: "Location:login.php");
}
include("../inc/vt.php");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $sayfa ?> - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">SEP Yönetim Paneli</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>    
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-md-0">
        <a style="font-weight: 700;" class="nav-link" id="userDropdown" href="../../../EgitimPlatformu2/anasayfa" role="button"  aria-haspopup="true" aria-expanded="false">Siteye Git  <i class="fas fa-home"></i></a>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="kullaniciParolaGuncelleGenel.php">Parola Değiştir</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Çıkış</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Çıkış yapmak istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <a href="logout.php" class="btn btn-danger">Çıkış</a>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                       <br>
                        <a class="nav-link <?= $sayfa == "Dashboard" ? "active" : "" ?>" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Hoşgeldiniz
                        </a>
                        <div class="sb-sidenav-menu-heading">Sayfalar</div>
                        <?php if ($_SESSION["yetki"] == "1") { ?>
                        <a class="nav-link <?= $sayfa == "Ana Sayfa" ? "active" : "" ?>" href="anasayfa.php">
                            Ana Sayfa
                        </a>
                        
                        <a class="nav-link <?= $sayfa == "Hakkımızda" ? "active" : "" ?>" href="hakkimizda.php">
                            Hakkımızda
                        </a>
                        <?php } ?>
                        <a class="nav-link collapsed <?= $sayfa == "HTML" || $sayfa == "CSS" || $sayfa == "Flutter" || $sayfa == "React Native" || $sayfa == "Java" || $sayfa == "Python" ? "active" : ""  ?>" href="#" data-toggle="collapse" data-target="#videolar" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Videolar
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="videolar" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $sayfa == "HTML" ? "active" : "" ?>" href="html_video.php">HTML 5</a>
                                <a class="nav-link <?= $sayfa == "CSS" ? "active" : "" ?>" href="css_video.php">CSS 3</a>
                                <a class="nav-link <?= $sayfa == "Flutter" ? "active" : "" ?>" href="flutter_video.php">FLUTTER</a>
                                <a class="nav-link <?= $sayfa == "React Native" ? "active" : "" ?>" href="react_video.php">REACT NATIVE</a>
                                <a class="nav-link <?= $sayfa == "Java" ? "active" : "" ?>" href="java_video.php">JAVA</a>
                                <a class="nav-link <?= $sayfa == "Python" ? "active" : "" ?>" href="python_video.php">PYTHON</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed <?= $sayfa == "HTML Doküman" || $sayfa == "CSS Doküman" || $sayfa == "Flutter Doküman" || $sayfa == "React Native Doküman" || $sayfa == "Java Doküman" || $sayfa == "Python Doküman" ? "active" : ""  ?>" href="#" data-toggle="collapse" data-target="#dokumanlar" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Dökümanlar
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="dokumanlar" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $sayfa == "HTML Doküman" ? "active" : "" ?>" href="html_dokuman.php">HTML 5</a>
                                <a class="nav-link <?= $sayfa == "CSS Doküman" ? "active" : "" ?>" href="css_dokuman.php">CSS 3</a>
                                <a class="nav-link <?= $sayfa == "Flutter Doküman" ? "active" : "" ?>" href="flutter_dokuman.php">FLUTTER</a>
                                <a class="nav-link <?= $sayfa == "React Native Doküman" ? "active" : "" ?>" href="react_dokuman.php">REACT NATIVE</a>
                                <a class="nav-link <?= $sayfa == "Java Doküman" ? "active" : "" ?>" href="java_dokuman.php">JAVA</a>
                                <a class="nav-link <?= $sayfa == "Python Doküman" ? "active" : "" ?>" href="python_dokuman.php">PYTHON</a>
                            </nav>
                        </div>

                        <?php
                        $sorguOkundu = $baglanti->prepare(query: "SELECT COUNT(*) AS sayi FROM iletisimformu WHERE okundu=0");
                        $sorguOkundu->execute();
                        $sonucOkundu = $sorguOkundu->fetch();
                        ?>
                        <a class="nav-link <?= $sayfa == "İletişim Formu" ? "active" : "" ?>" href="iletisimformu.php">İletişim Formu &nbsp; <span id="okunmaSayisi" class="badge badge-success"> <?= $sonucOkundu["sayi"] ?></span></a>

                        <?php if ($_SESSION["yetki"] == "1") { ?>
                            <a class="nav-link <?= $sayfa == "Kullanıcılar" ? "active" : "" ?>" href="kullanici.php">Kullanıcılar</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Giriş yapan:</div>
                    <?= $_SESSION["kadi"] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">