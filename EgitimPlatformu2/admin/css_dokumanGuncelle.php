<?php
$sayfa = "CSS Doküman";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1" && $_SESSION["yetki"] != "2") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='css_dokuman.php'}
        })
         </script>";
    exit;
}

                            $id=$_GET['id'];
                            $sorgu = $baglanti->prepare(query: "select*from css_dokuman where id=:id");
                            $sorgu->execute(['id'=>$id]);
                            $sonuc = $sorgu->fetch();
                            

if ($_POST) {


    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $dokumanIcon= '';
    $dokuman= '';

    if ($_POST["sira"] != '' && $_FILES["dokumanIcon"]['name'] != '' && $_FILES["dokuman"]['name'] != '') {
        if ($_FILES['dokumanIcon']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['dokumanIcon']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Dosya boyutu 2 MB dan büyük olamaz.';
        }   else if ($_FILES['dokuman']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['dokuman']['size'] > (1024 * 1024 * 100)) {
            $hata .= 'Dosya boyutu 100 MB dan büyük olamaz.';
        } else {
            copy($_FILES['dokumanIcon']['tmp_name'], to: '../images/icon/' . strtolower($_FILES["dokumanIcon"]['name']));
            unlink('../images/icon/'.$sonuc['dokumanIcon']);
            $dokumanIcon=strtolower($_FILES["dokumanIcon"]['name']);
            copy($_FILES['dokuman']['tmp_name'], to: '../document/css3/' . strtolower($_FILES["dokuman"]['name']));
            unlink('../document/css3/'.$sonuc['dokuman']);
            $dokuman=strtolower($_FILES["dokuman"]['name']);              
        }

        if ($hata!='') {
            echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat'})</script>";
        }

    }else{
        $dokumanIcon=$sonuc['dokumanIcon'];
        $dokuman=$sonuc['dokuman'];
    }

    if($_POST["sira"] != '' && $hata=='')
    {
        $Sorgu = $baglanti->prepare(query: 'UPDATE css_dokuman SET dokumanIcon=:dokumanIcon,dokumanBaslik=:dokumanBaslik,dokumanKategori=:dokumanKategori,dokuman=:dokuman,sira=:sira,aktif=:aktif WHERE id=:id');
            $guncelle= $Sorgu->execute([
                'dokumanIcon' => $dokumanIcon,
                'dokumanBaslik' => $_POST['dokumanBaslik'],
                'dokumanKategori' => $_POST['dokumanKategori'],
                'dokuman' => $dokuman,
                'sira' => $_POST['sira'],
                'aktif' => $aktif,
                'id' => $id
            ]);
            if ($guncelle) {
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Başarılı!', text:'Ekleme Başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                    if(value.isConfirmed){window.location.href='css_dokuman.php'}
                }) </script>";
            }
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Doküman Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Doküman Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <img width="200" src="../images/icon/<?= $sonuc['dokumanIcon']?>" alt=""> <br>
                        <label>Doküman Icon (Değiştirme işlemi sonucunda mevcut icon klasörden tamamen silinecektir.)</label>
                        <input type="file" name="dokumanIcon" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Doküman Başlık</label>
                        <input type="text" name="dokumanBaslik" required class="form-control" value="<?= $sonuc["dokumanBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Doküman Kategori</label>
                        <input type="text" name="dokumanKategori" required class="form-control" value="<?= $sonuc["dokumanKategori"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Doküman (Değiştirme işlemi sonucunda mevcut doküman klasörden tamamen silinecektir.)</label>
                        <input type="file" name="dokuman" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="text" name="sira" required class="form-control" value="<?= $sonuc["sira"] ?>">
                    </div>

                    <div class="form-group form-check">
                        <label>
                            <input type="checkbox" name="aktif" class="form-check-input" <?=$sonuc['aktif'] ==1?'checked':''?>> Aktif mi ?</label>
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