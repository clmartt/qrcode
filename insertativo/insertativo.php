<?php
header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login
$qrcode = strtoupper($_POST['qrcode']);
$ativo = utf8_decode(strtoupper($_POST['ativo']));
$caract = utf8_decode(strtoupper($_POST['caract']));
$modelo =  utf8_decode(strtoupper($_POST['modelo']));
$marca = utf8_decode(strtoupper($_POST['marca']));
$predio = utf8_decode(strtoupper($_POST['predio']));
$sala = utf8_decode(strtoupper($_POST['sala']));
$qrsala =  strtoupper($_POST['qrsala']);
$andar = utf8_decode(strtoupper($_POST['andar']));
$setor = utf8_decode(strtoupper($_POST['setor']));
$serie = utf8_decode(strtoupper($_POST['serie']));
$horas = $_POST['horas'];
$situacao = utf8_decode(strtoupper($_POST['situacao']));

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 
	
$stmt = $pdo->prepare("INSERT INTO QRCODETABLE(QRCODE,TIPO_DE_EQUIPAMENTO,CARACTERISTICA,MARCA,MODELO,N_SERIE,PREDIO,ANDAR,SETOR,SALA,QRSALA,HORAS_LAMP,SITUACAO)
	values ('$qrcode','$ativo','$caract','$marca','$modelo','$serie','$predio','$andar','$setor','$sala','$qrsala',$horas,'$situacao')"); 

// Executando statement 
$stmt->execute(); 

// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
echo  "<script>alert('Isso ai!, Mais um ativo registrado!');</script>";
if ($stmt) { 


header("Location: http://kvminformatica.com.br/qrteste2/insertativo/formInsert.php");
} else { 
echo "Erro ao gravar"; 


} 
