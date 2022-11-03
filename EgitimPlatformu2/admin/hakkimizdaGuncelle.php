<?php
$sayfa = "Hakkımızda";
include('inc/ahead.php');

if($_SESSION["yetki"]!="1"){
    echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
        echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='hakkimizda.php'}
        })
         </script>";
         exit;
}

$sorgu = $baglanti->prepare(query: "select*from hakkimizda where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

if ($_POST) { //veri güncelle

    $guncelleSorgu=$baglanti->prepare(query:"Update hakkimizda set ustBaslik=:ustBaslik, anaBaslik=:anaBaslik, paragraf1=:paragraf1, paragraf2=:paragraf2, paragraf3=:paragraf3 where id=:id");
    $guncelle=$guncelleSorgu->execute([
        'ustBaslik'=>$_POST["ustBaslik"],
        'anaBaslik'=>$_POST["anaBaslik"],
        'paragraf1'=>$_POST["paragraf1"],
        'paragraf2'=>$_POST["paragraf2"],
        'paragraf3'=>$_POST["paragraf3"],
        'id'=>(int)$_GET["id"],
    ]);

    if($guncelle){
        echo' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
        echo "<script> Swal.fire({title:'Başarılı!', text:'Güncelleme başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='hakkimizda.php'}
        })
         </script>";
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Hakkımızda Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Hakkımızda Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Üst Başlık</label>
                        <input type="text" name="ustBaslik" required class="form-control" value="<?= $sonuc["ustBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Ana Başlık</label>
                        <input type="text" name="anaBaslik" required class="form-control" value="<?= $sonuc["anaBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Paragraf 1</label>
                        <input type="text" name="paragraf1" required class="form-control" value="<?= $sonuc["paragraf1"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Paragraf 2</label>
                        <input type="text" name="paragraf2" required class="form-control" value="<?= $sonuc["paragraf2"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Paragraf 3</label>
                        <input type="text" name="paragraf3" required class="form-control" value="<?= $sonuc["paragraf3"] ?>">
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