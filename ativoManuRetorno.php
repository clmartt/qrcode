<?php 
include('conectar.php');
include('timezone.php');

$idManu = $_POST['idManu'];
$qr = $_POST['qrcode'];

$selecao = $pdo->query("SELECT QRCODE FROM MANUTENCAO WHERE ID_MANU = '$idManu'");
foreach ($selecao as $res) {
    $pegaqrcode = $res['QRCODE'];
}

$upload = $pdo->prepare("UPDATE MANUTENCAO SET SITUACAO = 'FECHADO' WHERE ID_MANU = '$idManu'");
$upativo = $pdo->prepare("UPDATE QRCODETABLE SET SITUACAO = 'OK' WHERE QRCODE = '$pegaqrcode'");

if($upload->execute()){
    $upativo->execute();
   echo "Ativo Devolvido"; 

}else{
    echo $upload->error_reporting;
}






?>