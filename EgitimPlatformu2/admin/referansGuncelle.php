<?php
$sayfa = "Referanslar";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='referans.php'}
        })
         </script>";
    exit;
}

                            $id=$_GET['id'];
                            $sorgu = $baglanti->prepare(query: "select*from referans where id=:id");
                            $sorgu->execute(['id'=>$id]);
                            $sonuc = $sorgu->fetch();
                            

if ($_POST) {


    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $foto= '';

    if ($_POST["link"] != '' && $_POST["sira"] != '' && $_FILES["foto"]['name'] != '') {
        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti.';
        } else if (file_exists(filename: '../assets/img/logos/' . strtolower($_FILES["foto"]['name']))) {
            $hata .= 'Aynı dosyadan mevcut.';
        } else if ($_FILES['foto']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Dosya boyutu 2 MB dan büyük olamaz.';
        } else if (!in_array($_FILES['foto']['type'], ['image/png', 'image/jpeg'])) {
            $hata .= 'Hata:Dosya türü png veya jpeg olmalı.';
        } else {
            copy($_FILES['foto']['tmp_name'], to: '../assets/img/logos/' . strtolower($_FILES["foto"]['name']));
            unlink('../assets/img/logos/'.$sonuc['foto']);
            $foto=strtolower($_FILES["foto"]['name']);           
        }

        if ($hata!='') {
            echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
            echo "<script> Swal.fire({title:'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat'})</script>";
        }

    }else{
        $foto=$sonuc['foto'];
    }

    if($_POST["link"] != '' && $_POST["sira"] != '' && $hata=='')
    {
        $Sorgu = $baglanti->prepare(query: 'UPDATE referans SET foto=:foto,link=:link,sira=:sira,aktif=:aktif WHERE id=:id');
            $guncelle= $Sorgu->execute([
                'foto' => $foto,
                'link' => $_POST['link'],
                'sira' => $_POST['sira'],
                'aktif' => $aktif,
                'id' => $id
            ]);
            if ($guncelle) {
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
                echo "<script> Swal.fire({title:'Başarılı!', text:'Ekleme Başarılı', icon:'success', confirmButtonText:'Kapat'}).then((value)=>{
                    if(value.isConfirmed){window.location.href='referans.php'}
                }) </script>";
            }
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Referans Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Referans Güncelle</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <img width="200" src="../assets/img/logos/<?= $sonuc['foto']?>" alt=""> <br>
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" required class="form-control" value="<?= $sonuc["link"] ?>">
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