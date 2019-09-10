<?php

ob_start();
session_start();


header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
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


$iduser = $_GET['id_user'];

$update = $pdo->query("UPDATE login_usuario SET acesso = 'APROVADO' WHERE id_user = $iduser");
$update-> execute();




header("Location: https://kvm1000.websiteseguro.com/qrteste/aprovar/listauser.php");

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