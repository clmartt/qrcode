<?php
include("../../../conectar.php");

$qrcode = $_GET['qrcode'];

$pegaAtivo = $pdo->query("SELECT QRCODE FROM QRCODETABLE WHERE QRCODE = '$qrcode'");
$pegaAtivo->execute();
$qtd = $pegaAtivo->rowCount();
echo $qtd;

if($qtd>0){
    header("Location: ../../../ativosSala/ativodetalhe.php?qrcode=".$qrcode);

    

}else{

   
    header("Location: salacheck.php?qrcodesala=".$qrcode);
}








?>