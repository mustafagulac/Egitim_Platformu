<?php
$sayfa = "Kullanıcılar";
include('inc/ahead.php');





if ($_POST) {


    if ($_POST["guncelParola"] != '' && $_POST["parola"] != '' && $_POST["parola"] == $_POST["pTekrar"] ) {

            $sorgu=$baglanti->prepare(query:"select parola from kullanici where kadi=:kadi");
            $sorgu->execute(['kadi'=>$_SESSION["kadi"]]);
            $sonuc=$sorgu->fetch();

            if($sonuc["parola"]==md5(string:"56".$_POST["guncelParola"]."23")){

                $guncelleSorgu = $baglanti->prepare(query: 'UPDATE kullanici SET parola=:parola where kadi=:kadi');
                $guncelle = $guncelleSorgu->execute([
                    'kadi'=>$_SESSION["kadi"],
                    'parola' => md5(string: "56" . $_POST['parola'] . "23")
                ]);
        
                if ($guncelle) {
                    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                    echo "<script> Swal.fire({title:'Başarılı!', text:'Güncelleme başarılı', icon:'success', confirmButtonText:'Kapat'})</script>";
                } 
        
            }else {
                echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Hata!', text:'Güncel parola yanlış!!', icon:'error', confirmButtonText:'Kapat'})</script>";
            }

            }




       
}

?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kullanıcı Parola Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Kullanıcı Parola Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST">
            
                    <div class="form-group">
                        <label>Güncel Parola</label>
                        <input type="password" name="guncelParola" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Parola</label>
                        <input type="password" name="parola" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Parola Tekrarla</label>
                        <input type="password" name="pTekrar" required class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Güncelle" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php
include('inc/afooter.php');
?>