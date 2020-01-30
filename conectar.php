<?php


ob_start();
session_start(); //pega a sessao do usuario


header('Content-Type: text/html; charset=utf-8');

ini_set('default_charset','UTF-8');

header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');


//conexao com banco de dadso

$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

// Conectando 
// se nao conectar informa o erro
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

?>