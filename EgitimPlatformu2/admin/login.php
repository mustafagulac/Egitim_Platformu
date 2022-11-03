<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Giriş Yap | Sınırsız Eğitim</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body style="background:#ff00fb;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Giriş Yap</h3>
                                </div>
                                <div class="card-body">

                                    <?php
                                    session_start();
                                    include("../inc/vt.php");


                                    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
                                        /*
                                        if($_SESSION["yetki"]==3){
                                            header(header: "location:icerik.php");
                                        }
                                        else
                                        */
                                        header(header: "location:index.php");
                                    } elseif (isset($_COOKIE["cerez"])) {
                                        $sorgu = $baglanti->prepare(query: "SELECT kadi,yetki FROM kullanici WHERE aktif=1");
                                        $sorgu->execute();
                                        while ($sonuc = $sorgu->fetch()) {
                                            if ($_COOKIE["cerez"] == md5("aa" . $sonuc["kadi"] . "bb")) {
                                                $_SESSION["Oturum"] = "6789";
                                                $_SESSION["kadi"] = $sonuc["kadi"];
                                                $_SESSION["yetki"] = $sonuc["yetki"];
                                                header(header: "location:index.php");
                                            }
                                        }
                                    }





                                    if ($_POST) {
                                        $kadi = $_POST["txtKadi"];
                                        $parola = $_POST["txtParola"];
                                    }

                                    //echo md5(string:"56"."1234"."23");

                                    ?>

                                    <form method="post" action="login.php">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Kullanıcı Adı</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="txtKadi" value="<?= @$kadi ?>" type="text" placeholder="Kullanıcı Adı giriniz" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Parola</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="txtParola" placeholder="Parola giriniz" />
                                        </div>
                                        <div class="form-group">
                                            <img src="../inc/captcha.php" alt="">
                                            <input class="form-control py-4" id="inputPassword" type="text" name="captcha" placeholder="Güvenlik kodu giriniz" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" name="cbHatirla" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Beni Hatırla</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input style="background: #ff00fb;" type="submit" class="btn text-white" value="Giriş">
                                        </div>
                                    </form>

                                    <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>

                                    <?php

                                    if ($_POST) {
                                        if ($_SESSION["captcha"] == $_POST["captcha"]) {


                                            $sorgu = $baglanti->prepare(query: "SELECT parola,yetki FROM kullanici WHERE kadi=:kadi AND aktif=1");
                                            $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                            $sonuc = $sorgu->fetch();


                                            if (md5(string: "56" . $parola . "23") == $sonuc["parola"]) {

                                                $_SESSION["Oturum"] = "6789";
                                                $_SESSION["kadi"] = $kadi;
                                                $_SESSION["yetki"] = $sonuc["yetki"];

                                                if (isset($_POST["cbhatirla"])) {
                                                    setcookie("cerez", md5("aa" . $kadi . "bb"), time() + (60 * 60 * 24 * 7));
                                                }
                                                    if($sonuc["yetki"] == 3){
                                                        header(header: "Location:../icerik");
                                                    }
                                                    else
                                                header(header: "Location:index.php");
                                            } else {
                                                echo "<script> Swal.fire('Hata!', 'Kullanıcı adı veya parola hatalı', 'error') </script>";
                                            }
                                        } else {
                                            echo "<script> Swal.fire('Hata!', 'Güvenlik kodu hatalı', 'error') </script>";
                                        }
                                    }

                                    ?>

                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a style="color: #ff00fb;" href="../../EgitimPlatformu2/anasayfa">Hesabınız yok mu? Kayıt olun!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Grup 17</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>