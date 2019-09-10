<?php

ob_start();
session_start();

header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

$email = $_SESSION['email'];

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 


$idChamado = $_GET['id_do_chamado'];
$data_2 = date('d/m/y');

$update = $pdo->query("UPDATE CHAMADOS SET status = 'RESOLVIDO', data_fechado = '$data_2', fechado_por = '$email' WHERE id_chamado = $idChamado");
$update-> execute();




header("Location: http://kvminformatica.com.br/qrteste/chamado/listaChamado.php");

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