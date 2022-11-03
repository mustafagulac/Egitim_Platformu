<?php
$sayfa = "Hakkımızda";
include('inc/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })
         </script>";
    exit;
}
$sorgu = $baglanti->prepare(query: "select*from hakkimizda");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Hakkımızda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Hakkımızda</li>

        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Üst Başlık</th>
                                <th>Ana Başlık</th>
                                <th>Paragraf 1</th>
                                <th>Paragraf 2</th>
                                <th>Paragraf 3</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td contenteditable="true" onBlur="veriKaydet(this,'ustBaslik','<?php echo $sonuc["id"] ?>')" onClick="duzenle(this);"><?= $sonuc["ustBaslik"] ?></td>
                                <td contenteditable="true" onBlur="veriKaydet(this,'anaBaslik','<?php echo $sonuc["id"] ?>')" onClick="duzenle(this);"><?= $sonuc["anaBaslik"] ?></td>
                                <td contenteditable="true" onBlur="veriKaydet(this,'paragraf1','<?php echo $sonuc["id"] ?>')" onClick="duzenle(this);"><?= $sonuc["paragraf1"] ?></td>
                                <td contenteditable="true" onBlur="veriKaydet(this,'paragraf2','<?php echo $sonuc["id"] ?>')" onClick="duzenle(this);"><?= $sonuc["paragraf2"] ?></td>
                                <td contenteditable="true" onBlur="veriKaydet(this,'paragraf3','<?php echo $sonuc["id"] ?>')" onClick="duzenle(this);"><?= $sonuc["paragraf3"] ?></td>
                                <td class="text-center">

                                    <?php if ($_SESSION["yetki"] == "1") {
                                    ?>
                                        <a href="hakkimizdaGuncelle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-edit fa-2x"></span>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>

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
    function duzenle(deger) {
        $(deger).css("background", "#fffacd");
        //seçilen hücrenin rengini değiştiriyoruz
    }

    function veriKaydet(deger, alan, id) {
        $(deger).css("background", "#FFF url(yukleniyor.gif) no-repeat right");

        $.ajax({
            url: "inc/duzenleKaydet.php", //verileri göndereceğimiz url
            type: "POST", //post ile gönderilecek
            data: 'tablo=hakkimizda&alan=' + alan + '&deger=' + deger.innerHTML.split('+').join('{0}') + '&id=' + id,
            // verileri alan deger ve id olarak yolluyoruz
            //+ (artı) post edilirken boşluk ile değişiyor 
            //bunu engellemek için + değeri {0} ile değiştirdim 
            //kayıt yaparkende index.php de geri değişimini yapıyoruz 
            success: function(data) {
                if (data == true) {
                    $(deger).css("background", "#fff");
                    // eğer veriler veri tabanına yazılmış ise hücrenin
                    //arka plan rengini beyaza geri döndürüyoruz
                } else {
                    $(deger).css("background", "#f00");
                    $("#sonuc").text("Hata veri düzenlenmedi");

                    //Eğer hata varsa hücre rengini kırmızı ve
                    // tablo altında hata mesajı yazdırıyoruz
                }
            }
        });
    }
</script>