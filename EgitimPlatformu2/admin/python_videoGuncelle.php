<?php
$sayfa = "Python";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1" && $_SESSION["yetki"] != "2") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='python_video.php'}
        })
         </script>";
    exit;
}

                            $id=$_GET['id'];
                            $sorgu = $baglanti->prepare(query: "select*from python_video where id=:id");
                            $sorgu->execute(['id'=>$id]);
                            $sonuc = $sorgu->fetch();
                            

if ($_POST) {


    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $foto= '';
    $video= '';

    if ($_POST["sira"] != '' && $_FILES["kucukResim"]['name'] != '' && $_FILES["video"]['name'] != '') {
        if ($_FILES['kucukResim']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['kucukResim']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Dosya boyutu 2 MB dan büyük olamaz.';
        }   else if ($_FILES['video']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['video']['size'] > (1024 * 1024 * 200)) {
            $hata .= 'Dosya boyutu 200 MB dan büyük olamaz.';
        } else {
            copy($_FILES['kucukResim']['tmp_name'], to: '../images/thumbnail/python/' . strtolower($_FILES["kucukResim"]['name']));
            unlink('../images/thumbnail/python/'.$sonuc['kucukResim']);
            $foto=strtolower($_FILES["kucukResim"]['name']);
            copy($_FILES['video']['tmp_name'], to: '../videos/python/' . strtolower($_FILES["video"]['name']));
            unlink('../videos/python/'.$sonuc['video']);
            $video=strtolower($_FILES["video"]['name']);              
        }

        if ($hata!='') {
            echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat'})</script>";
        }

    }else{
        $foto=$sonuc['kucukResim'];
        $video=$sonuc['video'];
    }

    if($_POST["sira"] != '' && $hata=='')
    {
        $Sorgu = $baglanti->prepare(query: 'UPDATE python_video SET kucukResim=:kucukResim,kucukResimBaslik=:kucukResimBaslik,kucukResimKategori=:kucukResimKategori,video=:video,videoBaslik=:videoBaslik,videoAciklama=:videoAciklama,sira=:sira,aktif=:aktif WHERE id=:id');
            $guncelle= $Sorgu->execute([
                'kucukResim' => $foto,
                'kucukResimBaslik' => $_POST['kucukResimBaslik'],
                'kucukResimKategori' => $_POST['kucukResimKategori'],
                'video' => $video,
                'videoBaslik' => $_POST['videoBaslik'],
                'videoAciklama' => $_POST['videoAciklama'],
                'sira' => $_POST['sira'],
                'aktif' => $aktif,
                'id' => $id
            ]);
            if ($guncelle) {
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Başarılı!', text:'Ekleme Başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                    if(value.isConfirmed){window.location.href='python_video.php'}
                }) </script>";
            }
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Video Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Video Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <img width="200" src="../images/thumbnail/python/<?= $sonuc['kucukResim']?>" alt=""> <br>
                        <label>Küçük Resim (Değiştirme işlemi sonucunda mevcut resim klasörden tamamen silinecektir.)</label>
                        <input type="file" name="kucukResim" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Küçük Resim Başlık</label>
                        <input type="text" name="kucukResimBaslik" required class="form-control" value="<?= $sonuc["kucukResimBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Küçük Resim Kategori</label>
                        <input type="text" name="kucukResimKategori" required class="form-control" value="<?= $sonuc["kucukResimKategori"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Video (Değiştirme işlemi sonucunda mevcut video klasörden tamamen silinecektir.)</label>
                        <input type="file" name="video" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Video Başlık</label>
                        <input type="text" name="videoBaslik" required class="form-control" value="<?= $sonuc["videoBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Video Açıklama</label>
                        <input type="text" name="videoAciklama" required class="form-control" value="<?= $sonuc["videoAciklama"] ?>">
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