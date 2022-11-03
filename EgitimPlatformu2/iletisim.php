<?php
$sayfa = "İletişim";

include ("inc/vt.php");

/*
$tanimlama=$sonuc["tanimlama"];
$key=$sonuc["anahtar"];
*/
include("inc/head.php");

?>

	<div class="row">
		
		<div class="col-md-12 bg-white sagicerik iletisimformu" style="top: -140px;">
		  <form action="" method="POST" class="form-header">
			<h3>Bize Ulaş</h3>
			<div class="d-flex">
				<div class="form-group mr-2 flex-grow-1">
				  <label for="">Adınız Soyadınız</label>
				  <input type="text" class="form-control" id="name" name="txtAd" required placeholder="Adınız Soyadınız *" data-validation-required-message="Lütfen Adınızı ve Soyadınızı girin." >
				</div>
			  </div>			
			<div class="form-group">
			  <label for="">E-posta</label>
			  <input type="email" class="form-control" id="email" name="txtEmail" required placeholder="E-posta adresiniz *" data-validation-required-message="Lütfen email adresinizi girin.">
			</div>
		
			<div class="form-group">
			  <img src="inc/captcha.php" alt="" style="width: 120px; height:30px;">
			  <input type="text" class="form-control" required placeholder="Güvenlik kodunu giriniz *" name="captcha">
			</div>

			<div class="form-group form-group-textarea">
			  <textarea class="form-control" name="txtMesaj" id="message" placeholder="Mesajınız *" required  cols="30" rows="10" data-validation-required-message="Lütfen mesajınızı giriniz."></textarea>
			  
			</div>

			<div class="form-group">
			  <input type="submit" class="btn btn-primary w-100" value="Gönder" id="sendMessageButton">
			</div>
		  </form>

		<script type="text/javascript" src="js/sweetalert2.all.min.js"></script>

		<?php

        if ($_POST) {
            if ($_SESSION['captcha'] == $_POST['captcha']) {

                $sorgu = $baglanti->prepare(query: "INSERT INTO iletisimformu SET ad=:ad, mail=:mail, mesaj=:mesaj");
                $ekle = $sorgu->execute(
                    [
                        'ad' => htmlspecialchars($_POST["txtAd"]),
                        'mail' => htmlspecialchars($_POST["txtEmail"]),
                        'mesaj' => htmlspecialchars($_POST["txtMesaj"]),
                    ]
                );

                if ($ekle) {

                    function mailgonder()
                    {
                        require "inc/class.phpmailer.php"; // PHPMailer dosyamızı çağırıyoruz  
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->From     = ""; //Gönderen kısmında yer alacak e-mail adresi  
                        $mail->Sender   = $_POST["txtEmail"];
                        $mail->FromName = $_POST["txtAd"];
                        $mail->Host     = ""; //SMTP server adresi  
                        $mail->SMTPAuth = true;
                        $mail->Username = ""; //SMTP kullanıcı adı  
                        $mail->Password = "*****"; //SMTP şifre  
                        $mail->SMTPSecure = "";
                        $mail->Port = "587";
                        $mail->CharSet = "utf-8";
                        $mail->WordWrap = 50;
                        $mail->IsHTML(true); //Mailin HTML formatında hazırlanacağını bildiriyoruz.  
                        $mail->Subject  = "Web Mesaj" . $_POST["txtAd"];

                        $mail->Body = "mesaj";
                        $mail->AltBody = strip_tags("mesaj");
                        $mail->AddAddress("");
                        return ($mail->Send()) ? true : false;
                        $mail->ClearAddresses();
                        $mail->ClearAttachments();
                    }

					echo "<script> Swal.fire({title:'Başarılı!', text:'Mesajınız bize ulaştı', icon:'success', confirmButtonText:'Kapat'}) </script>";

                    /*if (mailgonder()) {
                        echo "<script> Swal.fire({title:'Başarılı!', text:'Mesajınız bize ulaştı', icon:'success', confirmButtonText:'Kapat'}) </script>";
                    } else {
                        echo "<script> Swal.fire('Hata!', 'Tüm alanları doğru doldurun', 'error') </script>";
                    }*/
                }
            } else {
                echo "<script> Swal.fire('Hata!', 'Tüm alanları doğru doldurun', 'error') </script>";
            }
        }

        ?>

		</div>
	  </div>



    </div>




</section>



<?php
include("inc/footer.php");
?>