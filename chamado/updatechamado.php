<?php

ob_start();
session_start();


header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

$email = $_GET['logado'];// recebe o nome do usuario logado

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

$predio = $_GET['predio'];
$idChamado = $_GET['id_do_chamado']; // recebe o id do chamado
$qr = $_GET['qrcode'];
$data_2 = date('d/m/y');
$solucao = $_GET['solucao'];

$update = $pdo->query("UPDATE CHAMADOS SET status = 'RESOLVIDO', data_fechado = '$data_2', fechado_por = '$email', solucao='$solucao' WHERE id_chamado = '$idChamado' ");
$update-> execute();

$upativo = $pdo->query("UPDATE QRCODETABLE SET SITUACAO = 'OK' WHERE QRCODE = '$qr' ");
$upativo->execute();




header("Location: http://kvminformatica.com.br/qrteste2/chamado/listaChamado.php?predio=".$predio);

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