<?php 
if($_POST){
    include('../../inc/vt.php');
    $id=(int)$_POST["id"];
    $tablo=$_POST["tablo"];

    $sorgu=$baglanti->query("UPDATE $tablo SET okundu=1 where id=$id");

    if($sorgu) echo true;
    else echo false;


}

?>