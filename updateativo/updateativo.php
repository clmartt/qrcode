<?php

include("../conectar.php");

//recebendo do formulario os campos de login
$id = $_POST['id'];
$qrcode = $_POST['qrcode'];
$ativo = strtoupper($_POST['ativo']);
$caract = strtoupper($_POST['caract']);
$modelo =  strtoupper($_POST['modelo']);
$marca = strtoupper($_POST['marca']);
$predio = strtoupper($_POST['predio']);
$sala = strtoupper($_POST['sala']);
$qrsala = strtoupper($_POST['qrsala']);
$andar = strtoupper($_POST['andar']);
$setor = strtoupper($_POST['setor']);
$serie = strtoupper($_POST['serie']);
$horas = intval($_POST['horas']);
$situEqui = strtoupper($_POST['situacaoequi']);



$select = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcode'");
$result = $select->fetchAll(PDO::FETCH_ASSOC);
echo $result['QRCODE'];

$update = $pdo->query("UPDATE QRCODETABLE SET QRCODE = '$qrcode',TIPO_DE_EQUIPAMENTO = '$ativo',CARACTERISTICA = '$caract',MARCA = '$marca',MODELO = '$modelo', N_SERIE = '$serie',PREDIO = '$predio', ANDAR = '$andar', SETOR = '$setor',SALA = '$sala',QRSALA = '$qrsala', HORAS_LAMP = $horas, SITUACAO = '$situEqui' WHERE ID_REGISTRO = '$id'");

$update-> execute();

echo "<script>alert('atualizado')</script>";
header("Location: http://kvminformatica.com.br/qrteste2/principal.php");

/*

// Preparando statement 
	
// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 

ECHO "foi selecionado ".$qrcode;
//header('Location: http://www.uol.com.br');  direciona para outra pagina
//header("Location: http://kvminformatica.com.br/qrteste/principal.php");

} else { 
echo "Erro ao gravar"; 


} 

*/