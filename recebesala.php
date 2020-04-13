<?php
include('timezone.php');
include('./conectar.php');
ob_start();
session_start();
$email = strtoupper($_SESSION['email']);
$cliente = $_SESSION['cliente'];

$salainteira = $_POST['nsala'];
$sala = explode("-", $salainteira);
$predio = $sala[0];
$andar = $sala[1];
$setor = $sala[2];
$sala_2 = utf8_decode($sala[3]);
$hora = date('H:i:s');



// Preparando statement 

$data_2 = date('Y/m/d');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');
	
$stmt = $pdo->prepare("INSERT INTO TABLE_CHECK(data_2,mes,ano,predio,andar,setor,sala,nome_user,ocupada,horas,preventiva,cliente) 
values ('$data_2','$mes','$ano','$predio','$andar','$setor','$sala_2','$email','SIM','$hora','NÃO','$cliente')"); 

// Executando statement 
$stmt->execute(); 



?>