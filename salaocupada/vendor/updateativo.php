<?php
header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login
$qrcode = trim($_POST['qrcode']);
$ativo = utf8_decode($_POST['ativo']);
$modelo =  utf8_decode($_POST['modelo']);
$marca = utf8_decode($_POST['marca']);
$predio = utf8_decode($_POST['predio']);
$sala = utf8_decode($_POST['sala']);
$andar = utf8_decode($_POST['andar']);
$serie = utf8_decode($_POST['serie']);
$horas = intval($_POST['horas']);

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 
	
$stmt = $pdo->prepare("UPDATE QRCODETABLE SET QRCODE = '$qrcode',NOME_ATIVO = '$ativo',MODELO = '$modelo',MARCA = '$marca',
	PREDIO = '$predio',
	SALA = '$sala',
	ANDAR = '$andar',
	SERIE = '$serie',
	HORAS_LAMP = $horas	WHERE QRCODE LIKE '$qrcode' "); 

// Executando statement 
$stmt->execute(); 

// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 
/*
echo '-----'.gettype($qrcode);
echo '-----'.gettype($ativo);
echo '-----'.gettype($modelo); 
echo '-----'.gettype($marca); 
echo '-----'.gettype($predio); 
echo '-----'.gettype($sala); 
echo '-----'.gettype($andar); 
echo '-----'.gettype($serie); 
echo '-----'.gettype($horas);
*/ 
//header('Location: http://www.uol.com.br');  direciona para outra pagina
header("Location: http://kvminformatica.com.br/qrteste/principal.php");
} else { 
echo "Erro ao gravar"; 


} 
