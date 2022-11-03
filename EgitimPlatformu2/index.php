<?php
$sayfa = "Ana Sayfa";

include ("inc/vt.php");
$sorgu = $baglanti->prepare( query: "select*from anasayfa");
$sorgu->execute();
$sonuc = $sorgu->fetch();
/*
$tanimlama=$sonuc["tanimlama"];
$key=$sonuc["anahtar"];
*/
include("inc/head.php");

if ($_POST) {


    $aktif = 1;
	$yetki = 3;



    if ($_POST["kadi"] != '' && $_POST["parola"] != '' && $_POST["email"] != '') {

        $ekleSorgu = $baglanti->prepare(query: 'INSERT INTO kullanici SET kadi=:kadi, parola=:parola, email=:email, aktif=:aktif ,yetki=:yetki');
        $ekle = $ekleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'parola' => md5(string: "56" . $_POST['parola'] . "23"),
            'email' => $_POST['email'],
            'yetki' => $yetki,
            'aktif' => $aktif


        ]);

        if ($ekle) {
            echo ' <script type="text/javascript" src="js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Başarılı!', text:'Platforma başarıyla kayıt oldunuz.', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                if(value.isConfirmed){window.location.href='icerik.php'}})</script>";
        } else {
            echo ' <script type="text/javascript" src="js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Hata!', text:'Kayıt olma başarısız!', icon:'error', confirmButtonText:'Kapat'})</script>";
        }
    }
}



?>

	<div class="row">
		<div class="col-md-6 text-white p-0 py-4">
		  <h2 class="display-4">Eğitimin<br>
			En düzenli haline <br>
			Hoşgeldin
		</h2> 
		  <p><?php echo $sonuc["ustAciklama"]?></p>
		</div>
		<?php if (!isset($_SESSION["yetki"]) != ""  ) { ?>
		<div class="col-md-4 offset-md-2 bg-white sagicerik">
		  <form action="" method="POST" class="form-header" enctype="multipart/form-data">
			<h3>Bize Katıl</h3>
			<div class="form-group">
			  <label for="">Kullanıcı Adı</label>
			  <input type="text" name="kadi" class="form-control" required placeholder="Kullanıcı adınız"  value="<?= @$_POST["kadi"] ?>">
			</div>			
			<div class="form-group">
			  <label for="">E-posta</label>
			  <input type="email" name="email" class="form-control" required placeholder="E-posta adresiniz" value="<?= @$_POST["email"] ?>">
			</div>
		
			<div class="form-group">
			  <label for="">Şifre</label>
			  <input type="password" name="parola" class="form-control" required placeholder="Şifreniz" >
			</div>
			<div class="form-group">
			  <input type="submit" class="btn btn-primary w-100" value="Kayıt Ol">
			</div>
		  </form>
		</div>
		<?php } ?>
		
	  </div>
	  



    </div>




</section>

<!--Bölüm 5 Başlangıç -->
<section class="container-fluid bolum5">
	<div class="overlay"></div>
	<div class="container">
		<p><?php echo $sonuc["ustNedenBiz"]?></p>
		<h2><?php echo $sonuc["nedenBizBaslik"]?></h2>
		<div class="row">
			<div class="col-md-4">
				<div class="icerik">
					<div class="resim"><i class="fas fa-comments-dollar"></i></div>
					<h3><?php echo $sonuc["altBaslik1"]?></h3>
					<p><?php echo $sonuc["aciklama1"]?></p>
				</div>
			
			</div><div class="col-md-4">
				<div class="icerik">
					<div class="resim"><i class="fas fa-folder"></i></div>
					<h3><?php echo $sonuc["altBaslik2"]?></h3>
					<p><?php echo $sonuc["aciklama2"]?></p>
				</div>
			
			</div>
			<div class="col-md-4">
				<div class="icerik">
					<div class="resim"><i class="fas fa-edit"></i></div>
					<h3><?php echo $sonuc["altBaslik3"]?></h3>
					<p><?php echo $sonuc["aciklama3"]?></p>
				</div>
			
			</div>
			
		</div>
		
		
	</div>
</section>
<!--	Bölüm5 Sonu-->

<?php
include("inc/footer.php");
?>