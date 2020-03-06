<?php
ob_start();
session_start();

include('../conectar.php');
include('../timezone.php');

$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');


$getqrcode = strtoupper($_POST['qrcode']);
$retirado = strtoupper($_POST['retirado']);
$getOs = strtoupper($_POST['os']);
$destino = strtoupper($_POST['destino']);
$problema = strtoupper($_POST['problema']);
$usuario_post = strtoupper($_POST['usuario']);



$solicitante = $_post['solicitante'];

$selecao = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$getqrcode' ");

foreach ($selecao as $sel) {
   
   $qrcode = strtoupper($sel['QRCODE']);
   $ativo = strtoupper($sel['TIPO_DE_EQUIPAMENTO']);
   $carac = strtoupper($sel['CARACTERISTICA']);
   $marca = strtoupper($sel['MARCA']);
   $modelo = strtoupper($sel['MODELO']);
   $serie = strtoupper($sel['N_SERIE']);
   $predio = strtoupper($sel['PREDIO']);
   $andar = strtoupper($sel['ANDAR']);
   $setor = strtoupper($sel['SETOR']);
   $sala = strtoupper($sel['SALA']);
   $qrsala = strtoupper($sel['QRSALA']);
   $horaL = strtoupper($sel['HORAS_LAMP']);
   $situacao = strtoupper($sel['SITUACAO']);
   $cliente = strtoupper($sel['CLIENTE']);

};




            $stmt = $pdo->prepare("INSERT INTO MANUTENCAO(QRCODE,ATIVO,PREDIO,ANDAR,SETOR,SALA,QRSALA,DATA_RETIRADA,MES,ANO,HORA,DATA_RETORNO,ABERTO_POR,RETIRADO_POR,DESTINO,OS,PROBLEMA,SITUACAO,CLIENTE)VALUES('$qrcode','$ativo','$predio','$andar','$setor','$sala','$qrsala','$data_2','$mes','$ano','$horas','','$usuario_post','$retirado','$destino','$getOs','$problema','ABERTO','$cliente')");

            $manu = $pdo->query("UPDATE QRCODETABLE SET SITUACAO ='RETIRADO PARA MANUTENÇÃO' WHERE QRCODE = '$getqrcode' ");


    if($stmt->execute()){
      $manu->execute();
      header("Location: ativodetalhe.php?qrcode=".$qrcode);

    } else{

      $stmt->error_reporting;
      
    } 

    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  </head>
  <body>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>