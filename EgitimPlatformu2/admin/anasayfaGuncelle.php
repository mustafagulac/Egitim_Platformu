<?php
$sayfa = "Ana Sayfa";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
        echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })
         </script>";
         exit;
}

$sorgu = $baglanti->prepare(query: "select*from anasayfa where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

if ($_POST) { //veri güncelle

    $guncelleSorgu=$baglanti->prepare(query:"Update anasayfa set ustAciklama=:ustAciklama, ustNedenBiz=:ustNedenBiz, altBaslik1=:altBaslik1, aciklama1=:aciklama1, altBaslik2=:altBaslik2, aciklama2=:aciklama2, altBaslik3=:altBaslik3, aciklama3=:aciklama3 where id=:id");
    $guncelle=$guncelleSorgu->execute([
        'ustAciklama'=>$_POST["ustAciklama"],
        'ustNedenBiz'=>$_POST["ustNedenBiz"],
        'altBaslik1'=>$_POST["altBaslik1"],
        'aciklama1'=>$_POST["aciklama1"],
        'altBaslik2'=>$_POST["altBaslik2"],
        'aciklama2'=>$_POST["aciklama2"],
        'altBaslik3'=>$_POST["altBaslik3"],
        'aciklama3'=>$_POST["aciklama3"],
        'id'=>(int)$_GET["id"],
    ]);

    if($guncelle){
        echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
        echo "<script> Swal.fire({title:'Başarılı!', text:'Güncelleme başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })
         </script>";
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Ana Sayfa Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Ana Sayfa Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Üst Açıklama</label>
                        <input type="text" name="ustAciklama" required class="form-control" value="<?= $sonuc["ustAciklama"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Neden Biz Üst</label>
                        <input type="text" name="ustNedenBiz" required class="form-control" value="<?= $sonuc["ustNedenBiz"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz AltBaşlık 1</label>
                        <input type="text" name="altBaslik1" required class="form-control" value="<?= $sonuc["altBaslik1"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz Açıklama 1</label>
                        <input type="text" name="aciklama1" required class="form-control" value="<?= $sonuc["aciklama1"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz AltBaşlık 2</label>
                        <input type="text" name="altBaslik2" required class="form-control" value="<?= $sonuc["altBaslik2"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz Açıklama 2</label>
                        <input type="text" name="aciklama2" required class="form-control" value="<?= $sonuc["aciklama2"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz AltBaşlık 3</label>
                        <input type="text" name="altBaslik3" required class="form-control" value="<?= $sonuc["altBaslik3"] ?>">
                    </div>

                    <div class="form-group">
                        <label>NedenBiz Açıklama 3</label>
                        <input type="text" name="aciklama3" required class="form-control" value="<?= $sonuc["aciklama3"] ?>">
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