<?php
$sayfa = "Hakkımızda";

include ("inc/vt.php");
$sorgu = $baglanti->prepare( query: "select*from hakkimizda");
$sorgu->execute();
$sonuc = $sorgu->fetch();
/*
$tanimlama=$sonuc["tanimlama"];
$key=$sonuc["anahtar"];
*/
include("inc/head.php");
?>

<!--	Bölüm 7 Başlangıç -->

<div class="container bolum7">
	<div class="row">
		<article class="col-md-12 bos">
			<div class="baslik">
				<p><?php echo $sonuc["ustBaslik"]?></p>
				<h3><?php echo $sonuc["anaBaslik"]?></h3>
			</div>
			<p class="icerik"><?php echo $sonuc["paragraf1"]?></p>
			<p class="icerik"><?php echo $sonuc["paragraf2"]?></p>
			<p class="icerik"><?php echo $sonuc["paragraf3"]?></p>
			<button class="btn"><a class="text-white" href="iletisim">Bize Ulaş</a></button>
		</article>
	</div>	
</div>
	
<!--	Bölüm 7 Sonu------->


</section>


<?php
include("inc/footer.php");
?>
