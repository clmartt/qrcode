<?php

ob_start();
session_start();
include("../conectar.php");


$email = $_POST['logado'];// recebe o nome do usuario logado
$idChamado = $_POST['id_do_chamado']; // recebe o id do chamado
$qr = $_POST['qrcode'];
$data_2 = date('d/m/y');
$solucao = $_POST['solucao'];

$update = $pdo->query("UPDATE CHAMADOS SET status = 'RESOLVIDO', data_fechado = '$data_2', fechado_por = '$email', solucao='$solucao' WHERE id_chamado = '$idChamado' ");
$update-> execute(); // atualiza como Resolvido 

$upativo = $pdo->query("UPDATE QRCODETABLE SET SITUACAO = 'OK' WHERE QRCODE = '$qr' ");
$upativo->execute(); // na tabela de ativos inseri ok para os ativos que estava com problema




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