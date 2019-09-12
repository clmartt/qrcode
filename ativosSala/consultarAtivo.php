<?php
ob_start();
session_start();
$email = $_SESSION['email'];

$valorinteiro = $_POST['valores'];
$sala = explode(" ", $valorinteiro);
$predio = $sala[0];
$andar = $sala[1];
$sala_2 = utf8_decode($sala[2]);

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
} ;


$select = "SELECT QRCODE FROM QRCODETABLE ";
$result = $pdo->query($select);
$teste = 0;
foreach ($result as $res) {
	$teste = $teste + 1; 
};
echo $teste;
echo $predio.'<p>';
echo $sala_2.'<p>';
echo $andar.'<p>';



?>