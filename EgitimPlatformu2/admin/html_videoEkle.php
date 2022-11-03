<?php
$sayfa = "HTML";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1" && $_SESSION["yetki"] != "2") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='html_video.php'}
        })
         </script>";
    exit;
}



if ($_POST) {


    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';

    if ($_POST["sira"] != '' && $_FILES["kucukResim"]['name'] != '' && $_FILES["video"]['name'] != '') {
        if ($_FILES['kucukResim']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        } else if ($_FILES['kucukResim']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Dosya boyutu 2 MB dan büyük olamaz.';
        }  else if ($_FILES['video']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['video']['size'] > (1024 * 1024 * 200)) {
            $hata .= 'Dosya boyutu 200 MB dan büyük olamaz.';
        } 
        
        
        else {
            copy($_FILES['kucukResim']['tmp_name'], to: '../images/thumbnail/html5/' . strtolower($_FILES["kucukResim"]['name']));
            copy($_FILES['video']['tmp_name'], to: '../videos/html5/' . strtolower($_FILES["video"]['name']));
            $ekleSorgu = $baglanti->prepare(query: 'INSERT INTO html_video SET kucukResim=:kucukResim, kucukResimBaslik=:kucukResimBaslik, kucukResimKategori=:kucukResimKategori, video=:video, videoBaslik=:videoBaslik, videoAciklama=:videoAciklama, aktif=:aktif, sira=:sira');
            $ekle = $ekleSorgu->execute([
                'kucukResim' => strtolower($_FILES["kucukResim"]['name']),
                'kucukResimBaslik' => $_POST['kucukResimBaslik'],
                'kucukResimKategori' => $_POST['kucukResimKategori'],
                'video' => strtolower($_FILES["video"]['name']),
                'videoBaslik' => $_POST['videoBaslik'],
                'videoAciklama' => $_POST['videoAciklama'],
                'aktif' => $aktif,
                'sira' => $_POST['sira']
                


            ]);

            if ($ekle) {
                echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Başarılı!', text:'Ekleme başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                if(value.isConfirmed){window.location.href='html_video.php'}})</script>";
            }
        }

        if ($hata!='') {
            echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat'})</script>";
        }

    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Video Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Video Ekle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Küçük Resim</label>
                        <input type="file" name="kucukResim" required class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Küçük Resim Başlık</label>
                        <input type="text" name="kucukResimBaslik" required class="form-control" value="<?= @$_POST["kucukResimBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Küçük Resim Kategori</label>
                        <input type="text" name="kucukResimKategori" required class="form-control" value="<?= @$_POST["kucukResimKategori"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Video (.mp4 uzantılı video seçiniz!)</label>
                        <input type="file" name="video" required  class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Video Başlık</label>
                        <input type="text" name="videoBaslik" required class="form-control" value="<?= @$_POST["videoBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Video Açıklama</label>
                        <input type="text" name="videoAciklama" required class="form-control" value="<?= @$_POST["videoAciklama"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="text" name="sira" required class="form-control" value="<?= @$_POST["sira"] ?>">
                    </div>

                    <div class="form-group form-check">
                        <label>
                            <input type="checkbox" name="aktif" class="form-check-input"> Aktif mi ?</label>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Ekle" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php
include('inc/afooter.php');
?>