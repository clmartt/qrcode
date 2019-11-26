<?php

ob_start();
session_start(); //pega a sessao do usuario
$cliente = $_SESSION['cliente'];


// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = $_GET['usuario']; // guardando usuario logado na variavel

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

if($_SESSION['cliente']=='KVM'){
// primeira forma	
$select = "SELECT * FROM  QRCODETABLE GROUP BY PREDIO"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query

}else{

  // primeira forma	
$select = "SELECT * FROM  QRCODETABLE WHERE CLIENTE= '$cliente' GROUP BY PREDIO"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query

};




?>