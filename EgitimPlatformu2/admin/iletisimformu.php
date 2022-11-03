<?php
$sayfa = "İletişim Formu";
include('inc/ahead.php');


if ($_SESSION["yetki"] == "3") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='../icerik.php'}
        })
         </script>";
    exit;
}

if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    //Seçilenleri pdo ile toplu silme kodu:
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM iletisimformu WHERE id IN (' . $silinecekler . ')');
    $sorgu->execute();
}



?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $sayfa ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $sayfa ?></li>

        </ol>

        <form action="" method="POST">
            <div class="card mb-4">
                <div class="card-header">

                    <?php if ($_SESSION["yetki"] == "1") {
                    ?>

                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#silModal"><span class="fa fa-trash"></span> Seçilenleri Sil</a>
                        <!-- Modal -->
                        <div class="modal fade" id="silModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <button type="submit" class="btn btn-danger my-3"> Seçilenleri Sil</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="">
                                    </th>
                                    <th>No</th>
                                    <th>Ad</th>
                                    <th>Email</th>
                                    <th>Mesaj</th>
                                    <th>Tarih</th>
                                    <th></th>

                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sorgu = $baglanti->prepare(query: "select*from iletisimformu order by okundu");
                                $sorgu->execute();
                                while ($sonuc = $sorgu->fetch()) {
                                ?>


                                    <tr <?php if($sonuc["okundu"]==0) echo 'class="font-weight-bold"' ?>>
                                        <td>
                                            <input class="cbSil" type="checkbox" name="sil[]" value="<?= $sonuc['id']; ?>">
                                        </td>
                                        <td><?= $sonuc["id"] ?></td>
                                        <td><?= $sonuc["ad"] ?></td>
                                        <td><?= $sonuc["mail"] ?></td>
                                        <td>

                                            <a id="<?= $sonuc["id"] ?>" href="#" class="btn btn-primary oku" data-toggle="modal" data-target="#okuModal<?= $sonuc["id"] ?>">
                                                Oku</span></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="okuModal<?= $sonuc["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Mesaj</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?= $sonuc["mesaj"] ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td><?= $sonuc["tarih"] ?></td>


                                        <td class="text-center">
                                            <?php if ($_SESSION["yetki"] == "1") {
                                            ?>

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
                                                                <a href="sil.php?id=<?= $sonuc["id"] ?> &tablo=iletisimformu" class="btn btn-danger">Sil</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
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
        </form>
    </div>
</main>
<?php
include('inc/afooter.php');
?>

<script type="text/javascript">
    //Tümünü seçme işlemi yapan script kodları:
    $(document).ready(function() {
        $('#tumunuSec').on('click', function() {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            } else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });

        $('.oku').click(function(event){
            var id=$(this).attr("id");
            var veri=$(this);
            var sayi= parseInt($('#okunmaSayisi').text());

            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php',
                data:{id:id, tablo:'iletisimformu'},
                success: function (result){
                    if(result==true){
                        veri.closest('tr').removeClass("font-weight-bold");
                        if(sayi>0) $("#okunmaSayisi").text(sayi-1);
                    }
                },
            });
        });

    });
</script>