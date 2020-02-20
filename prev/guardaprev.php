<?php
ob_start();
session_start();
$usuario = $_SESSION['email'];
$atividade = $_POST['categoria'];
$obs = $_POST['obs'];
if($usuario == ''){

    header("Location: ../login.html");
}

include('../conectar.php');
include('../timezone.php');

$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');


$getqrcode = $_POST['qrcode'];

$selecao = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$getqrcode' ");

foreach ($selecao as $sel) {
    $R_string_id = "KVM: ".$sel['PREDIO']." - ".$sel['SALA']." - ".$sel['ANDAR'];
   $qrcode = $sel['QRCODE'];
   $ativo = $sel['TIPO_DE_EQUIPAMENTO'];
   $carac = $sel['CARACTERISTICA'];
   $marca = $sel['MARCA'];
   $modelo = $sel['MODELO'];
   $serie = $sel['N_SERIE'];
   $predio = $sel['PREDIO'];
   $andar = $sel['ANDAR'];
   $setor = $sel['SETOR'];
   $sala = $sel['SALA'];
   $qrsala = $sel['QRSALA'];
   $horaL = $sel['HORAS_LAMP'];
   $situacao = $sel['SITUACAO'];
   $cliente = $sel['CLIENTE'];

};


$stmt = $pdo->prepare("INSERT INTO PREVENTIVAS(DATA_PREV,MES,ANO,HORA,QRCODE,ATIVO,PREDIO,ANDAR,SETOR,SALA,ATIVIDADE,USUARIO,OBS,CLIENTE)
value('$data_2','$mes','$ano','$horas','$qrcode','$ativo','$predio','$andar','$setor', '$sala','$atividade','$usuario','$obs','$cliente')");

if($stmt->execute()){
    header("Location: ../ativosSala/ativodetalhe.php?qrcode=".$getqrcode);
}else{

    echo $stmt->errorInfo();
}
    

    








?>