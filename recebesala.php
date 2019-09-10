<?php
ob_start();
session_start();
$email = strtoupper($_SESSION['email']);

$salainteira = $_POST['nsala'];
$sala = explode("-", $salainteira);
$predio = $sala[0];
$andar = $sala[1];
$setor = $sala[2];
$sala_2 = utf8_decode($sala[3]);
$hora = date('H:i:s');

header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 

$data_2 = date('Y/m/d');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');
	
$stmt = $pdo->prepare("INSERT INTO TABLE_CHECK(data_2,mes,ano,predio,andar,setor,sala,nome_user,ocupada,horas) 
values ('$data_2','$mes','$ano','$predio','$andar','$setor','$sala_2','$email','SIM','$hora')"); 

// Executando statement 
$stmt->execute(); 



?>