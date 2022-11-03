<?php
$sayfa = "İçerik";

include("inc/vt.php");
/*
$tanimlama=$sonuc["tanimlama"];
$key=$sonuc["anahtar"];
*/
include("inc/head.php");
?>

<!--		sayfa içi yönlendirme  başlangıç-->
<div class="row">
    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-4 yonlendirme">
        <h3 class="display-6 text-white mb-4  baslik">Web Programlama</h3>
        <a class="btn  mb-3 yButon" href="#icerikHtml">HTML 5</a><br>
        <a class="btn  mb-3 yButon" href="#icerikCss">CSS 3</a><br>
    </div>

    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-4 yonlendirme">
        <h3 class="display-6 text-white mb-4  baslik">Mobil Programlama</h3>
        <a class="btn  mb-3 yButon" href="#icerikFlutter">Flutter</a><br>
        <a class="btn  mb-3 yButon" href="#icerikReact">React Native</a><br>
    </div>

    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-4 yonlendirme">
        <h3 class="display-6 text-white mb-4 baslik">Programlama Dilleri</h3>
        <a class="btn  mb-3 yButon" href="#icerikJava">Java</a><br>
        <a class="btn  mb-3 yButon" href="#icerikPython">Python</a><br>
    </div>

    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-4 yonlendirme">
        <h3 class="display-6 text-white mb-4 baslik">Kategori</h3>
        <a class="btn  mb-3 yButon" href="#">Kurs Adı</a><br>
        <a class="btn  mb-3 yButon" href="#">Kurs Adı</a><br>
    </div>
</div>
<!--		sayfa içi yönlendirme  bitiş-->

</section>

<!--bolum1 bitiş-->


<?php if (!isset($_SESSION["yetki"]) != ""  ) { ?>
<section class="uyari" style="background: #ff00fb;">
        <div class="container">
    <p style="font-size: 50px;">İÇERİKLERİ GÖRMEK İÇİN LÜTFEN GİRİŞ YAPINIZ!</p>
        </div>
</section>
<?php } ?>







<?php if (!isset($_SESSION["yetki"]) == ""  ) { ?>
<!--Burası HTML5 Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikHtml">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası HTML5 Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">HTML 5</h3>
        </div>
        <div class="row">
            <?php

            $sorgu2 = $baglanti->prepare(query: "select*from html_video WHERE aktif=1 ORDER BY sira ");
            $sorgu2->execute();
            while ($sonuc2 = $sorgu2->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalHtml<?php echo $sonuc2["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/html5/<?php echo $sonuc2["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc2["kucukResimBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc2["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalHtml<?php echo $sonuc2["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc2["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc2["videoAciklama"] ?>
                                            </p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/html5/<?php echo $sonuc2["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası HTML5 Videolar Kısmı Bitiş-->

    <!--Burası HTML5 Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">HTML 5</h3>
        </div>
        <div class="row">
            <?php

            $sorgu8 = $baglanti->prepare(query: "select*from html_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu8->execute();
            while ($sonuc8 = $sorgu8->fetch()) {
            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokumanHtml">

                            <a href="document/html5/<?php echo $sonuc8["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc8["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc8["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc8["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası HTML5 Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası HTML5 Section Bitiş-->






<!--Burası CSS3 Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikCss">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası CSS3 Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">CSS 3</h3>
        </div>
        <div class="row">
            <?php

            $sorgu3 = $baglanti->prepare(query: "select*from css_video WHERE aktif=1 ORDER BY sira ");
            $sorgu3->execute();
            while ($sonuc3 = $sorgu3->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalCss<?php echo $sonuc3["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/css3/<?php echo $sonuc3["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc3["kucukResimBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc3["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalCss<?php echo $sonuc3["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc3["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc3["videoAciklama"] ?></p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/css3/<?php echo $sonuc3["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası CSS3 Videolar Kısmı Bitiş-->

    <!--Burası CSS3 Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">CSS 3</h3>
        </div>
        <div class="row">
            <?php

            $sorgu9 = $baglanti->prepare(query: "select*from css_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu9->execute();
            while ($sonuc9 = $sorgu9->fetch()) {
            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokuman">

                            <a href="document/css3/<?php echo $sonuc9["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc9["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc9["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc9["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası CSS3 Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası CSS3 Section Bitiş-->






<!--Burası Flutter Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikFlutter">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası Flutter Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">Flutter</h3>
        </div>
        <div class="row">
            <?php

            $sorgu4 = $baglanti->prepare(query: "select*from flutter_video WHERE aktif=1 ORDER BY sira ");
            $sorgu4->execute();
            while ($sonuc4 = $sorgu4->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalFlutter<?php echo $sonuc4["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/flutter/<?php echo $sonuc4["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc4["kucukResimBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc4["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalFlutter<?php echo $sonuc4["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc4["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc4["videoAciklama"] ?></p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/flutter/<?php echo $sonuc4["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası Flutter Videolar Kısmı Bitiş-->

    <!--Burası Flutter Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">Flutter</h3>
        </div>
        <div class="row">

            <?php

            $sorgu10 = $baglanti->prepare(query: "select*from flutter_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu10->execute();
            while ($sonuc10 = $sorgu10->fetch()) {
            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokuman">

                            <a href="document/flutter/<?php echo $sonuc10["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc10["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc10["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc10["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
                <?php
            }
    ?>
        </div>
    </div>
    <!--Burası Google Flutter Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası Google Flutter Section Bitiş-->





<!--Burası React Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikReact">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası React Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">React Native</h3>
        </div>
        <div class="row">
            <?php

            $sorgu5 = $baglanti->prepare(query: "select*from react_video WHERE aktif=1 ORDER BY sira ");
            $sorgu5->execute();
            while ($sonuc5 = $sorgu5->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalReact<?php echo $sonuc5["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/react/<?php echo $sonuc5["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"> <?php echo $sonuc5["kucukResimBaslik"] ?> </div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc5["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalReact<?php echo $sonuc5["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc5["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc5["videoAciklama"] ?></p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/react/<?php echo $sonuc5["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası React Videolar Kısmı Bitiş-->

    <!--Burası React Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">React Native</h3>
        </div>
        <div class="row">

            <?php

            $sorgu11 = $baglanti->prepare(query: "select*from react_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu11->execute();
            while ($sonuc11 = $sorgu11->fetch()) {
            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokuman">

                            <a href="document/react/<?php echo $sonuc11["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc11["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc11["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc11["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası React Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası React Section Bitiş-->







<!--Burası Java Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikJava">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası Java Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">Java</h3>
        </div>
        <div class="row">
            <?php

            $sorgu6 = $baglanti->prepare(query: "select*from java_video WHERE aktif=1 ORDER BY sira ");
            $sorgu6->execute();
            while ($sonuc6 = $sorgu6->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalJava<?php echo $sonuc6["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/java/<?php echo $sonuc6["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc6["kucukResimBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc6["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalJava<?php echo $sonuc6["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc6["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc6["videoAciklama"] ?></p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/java/<?php echo $sonuc6["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası Java Videolar Kısmı Bitiş-->

    <!--Burası Java Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">Java</h3>
        </div>
        <div class="row">

            <?php

            $sorgu12 = $baglanti->prepare(query: "select*from java_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu12->execute();
            while ($sonuc12 = $sorgu12->fetch()) {
            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokuman">

                            <a href="document/java/<?php echo $sonuc12["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc12["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc12["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc12["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası Java Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası Java Section Bitiş-->




<!--Burası Python Section Başlangıç-->
<section class="page-section bg-light icerik-arkaplan" id="icerikPython">
    <a class="btn  yukaricik" href="#ilkbolum"><i class="fas fa-arrow-up"></i></a>
    <!--Burası Python Videolar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">VİDEOLAR</h2>
            <h3 class="section-subheading">Python</h3>
        </div>
        <div class="row">
            <?php

            $sorgu7 = $baglanti->prepare(query: "select*from python_video WHERE aktif=1 ORDER BY sira ");
            $sorgu7->execute();
            while ($sonuc7 = $sorgu7->fetch()) {


            ?>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModalPython<?php echo $sonuc7["id"] ?>">
                            <div class="icerik-hover">
                                <div class="icerik-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/thumbnail/python/<?php echo $sonuc7["kucukResim"] ?>" alt="" />
                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc7["kucukResimBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc7["kucukResimKategori"] ?></div>
                        </div>
                    </div>
                </div>

                <div class="icerik-modal modal fade" id="icerikModalPython<?php echo $sonuc7["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img class="kapatmaisaret" src="images/icon/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase"><?php echo $sonuc7["videoBaslik"] ?></h2>
                                            <p class="item-intro text-muted"><?php echo $sonuc7["videoBaslik"] ?></p>

                                            <video class="video-fluid d-block mx-auto" width="1280" height="720" controls>
                                                <source src="videos/python/<?php echo $sonuc7["video"] ?>" type="video/mp4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası Python Videolar Kısmı Bitiş-->

    <!--Burası Python Dökümanlar Kısmı Başlangıç-->
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3">Dökümanlar</h2>
            <h3 class="section-subheading">Python</h3>
        </div>
        <div class="row">
            <?php

            $sorgu13 = $baglanti->prepare(query: "select*from python_dokuman WHERE aktif=1 ORDER BY sira ");
            $sorgu13->execute();
            while ($sonuc13 = $sorgu13->fetch()) {


            ?>


                <div class="col-lg-2 col-sm-4 mb-4">
                    <div class="icerik-item">
                        <a class="icerik-link" data-toggle="modal" href="#icerikModaldokuman">

                            <a href="document/python/<?php echo $sonuc13["dokuman"] ?>" download>
                                <img class="img-fluid" src="images/icon/<?php echo $sonuc13["dokumanIcon"] ?>">
                            </a>

                        </a>
                        <div class="icerik-caption">
                            <div class="icerik-caption-heading"><?php echo $sonuc13["dokumanBaslik"] ?></div>
                            <div class="icerik-caption-subheading text-muted"><?php echo $sonuc13["dokumanKategori"] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Burası Python Dökümanlar Kısmı Bitiş-->




</section>
<!--Burası Python Section Bitiş-->

<?php } ?>


<?php
include("inc/footer.php");
?>