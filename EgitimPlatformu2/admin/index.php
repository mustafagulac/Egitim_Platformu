<?php 
$sayfa="Dashboard";
include('inc/ahead.php');

if ($_SESSION["yetki"] == "3") {
    echo ' <script type="text/javascript" src="../js/sweetalert2.all.min.js"> </script>';
    echo "<script> Swal.fire({title:'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat'}).then((value)=>{
            if(value.isConfirmed){window.location.href='../icerik.php'}
        })
         </script>";
    exit;
}

?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Sınırsız Eğitim Platformu Yönetim Paneli</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Sınırsız Eğitim Platformu Yönetim Paneli</li>
        </ol>
      
            <div class="container text-center" style="background: url(../images/1.jfif); background-size: cover; background-position: 50% 0; ">
                
            <p class="text-white" style="font-size: 50px; font-weight:900;"> Sayın  "<?= $_SESSION["kadi"] ?>", <br> Sınırsız Eğitim Platformu Yönetim Paneline Hoşgeldiniz  </p> <br><br>
            <p class="text-white text-left" style="font-size: 30px;">Sol taraftaki menüyü kullanarak ; <br> <br>
            🔘 Videolar ve Dokümanlara erişerek istediğiniz işlemi uygulayabilir, <br>
            🔘 İletişim Formu ile öğrencilerinizden gelen mesajlara erişebilirsiniz.
                
            
            </p>   
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>


            </div>
        
    </div>
</main>
<?php 
include('inc/afooter.php');
?>