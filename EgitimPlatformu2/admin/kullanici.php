<?php
$sayfa = "Kullanıcılar";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })
         </script>";
    exit;
}

?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $sayfa ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $sayfa ?></li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <a href="kullaniciEkle.php" class="btn btn-primary">Kullanıcı Ekle</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kullanıcı Adı</th>
                                <th>Yetki</th>
                                <th>Email</th>
                                <th>Aktif</th>
                                <th>Parola<br>Güncelle</th>
                                <th>Güncelle</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $sorgu = $baglanti->prepare(query: "select*from kullanici");
                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch()) {
                            ?>


                                <tr>
                                    <td><?= $sonuc["kadi"] ?></td>
                                    <td><?= $sonuc["yetki"] == 1 ? 'Admin' : ($sonuc["yetki"] == 2 ? 'Eğitmen' : 'Öğrenci' )?></td>
                                    <td><?= $sonuc["email"] ?></td>
                                    <td class="text-center">
                                        <link href="css/switch.css" rel="stylesheet" />
                                        <label class="switch">
                                            <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                            <input type="checkbox" id='<?php echo $sonuc['id'] ?>' class="aktifPasif" <?php echo $sonuc['aktif'] == 1 ? 'checked' : '' ?> />
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <a href="kullaniciParolaGuncelle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-key fa-2x"></span>
                                        </a>

                                    </td>
                                    <td class="text-center">
                                        <a href="kullaniciGuncelle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-edit fa-2x"></span>
                                        </a>

                                    </td>
                                    <td class="text-center">


                                        <a href="#" data-toggle="modal" data-target="#silModal<?= $sonuc["id"] ?>"><span class="fa fa-trash fa-2x text-danger"></span></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="silModal<?= $sonuc["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        Silmek istediğinize emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?> &tablo=kullanici" class="btn btn-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include('inc/afooter.php');
?>

<script>
    $(document).ready(function() {
        $('.aktifPasif').click(function(event) {
            var id = $(this).attr("id"); //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'inc/aktifPasif.php', //işlem yaptığımız sayfayı belirtiyoruz
                data: {
                    id: id,
                    tablo: 'kullanici',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function(result) {
                    $('#sonuc').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function() {
                    alert('Hata');
                }
            });
        });
    });
</script>