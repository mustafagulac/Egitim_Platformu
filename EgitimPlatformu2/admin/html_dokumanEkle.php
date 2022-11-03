<?php
$sayfa = "HTML Doküman";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1" && $_SESSION["yetki"] != "2") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='html_dokuman.php'}
        })
         </script>";
    exit;
}



if ($_POST) {


    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';

    if ($_POST["sira"] != '' && $_FILES["dokumanIcon"]['name'] != '' && $_FILES["dokuman"]['name'] != '') {
        if ($_FILES['dokumanIcon']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        } else if ($_FILES['dokumanIcon']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Dosya boyutu 2 MB dan büyük olamaz.';
        }  else if ($_FILES['dokuman']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        }  else if ($_FILES['dokuman']['size'] > (1024 * 1024 * 100)) {
            $hata .= 'Dosya boyutu 100 MB dan büyük olamaz.';
        } 
        
        
        else {
            copy($_FILES['dokumanIcon']['tmp_name'], to: '../images/icon/' . strtolower($_FILES["dokumanIcon"]['name']));
            copy($_FILES['dokuman']['tmp_name'], to: '../document/html5/' . strtolower($_FILES["dokuman"]['name']));
            $ekleSorgu = $baglanti->prepare(query: 'INSERT INTO html_dokuman SET dokumanIcon=:dokumanIcon, dokumanBaslik=:dokumanBaslik, dokumanKategori=:dokumanKategori, dokuman=:dokuman, aktif=:aktif, sira=:sira');
            $ekle = $ekleSorgu->execute([
                'dokumanIcon' => strtolower($_FILES["dokumanIcon"]['name']),
                'dokumanBaslik' => $_POST['dokumanBaslik'],
                'dokumanKategori' => $_POST['dokumanKategori'],
                'dokuman' => strtolower($_FILES["dokuman"]['name']),
                'aktif' => $aktif,
                'sira' => $_POST['sira']
                


            ]);

            if ($ekle) {
                echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Başarılı!', text:'Ekleme başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                if(value.isConfirmed){window.location.href='html_dokuman.php'}})</script>";
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
        <h1 class="mt-4">Doküman Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Doküman Ekle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Doküman Icon</label>
                        <input type="file" name="dokumanIcon" required class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Doküman Başlık</label>
                        <input type="text" name="dokumanBaslik" required class="form-control" value="<?= @$_POST["dokumanBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Doküman Kategori</label>
                        <input type="text" name="dokumanKategori" required class="form-control" value="<?= @$_POST["dokumanKategori"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Doküman</label>
                        <input type="file" name="dokuman" required  class="form-control-file">
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