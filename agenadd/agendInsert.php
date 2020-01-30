<?php

if(!$_POST){
    header("Location: ./login.html");

};
// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
ob_start();
session_start(); //pega a sessao do usuario


include('../conectar.php');



$predio = strtoupper($_POST['predio']);
$andar = strtoupper($_POST['andar']);
$sala = strtoupper(utf8_decode($_POST['sala']));
$atividade = strtoupper(utf8_decode($_POST['atividade']));
$datac = $_POST['paraData'];
$hinicio = $_POST['hinicio'];
$hfim = $_POST['hfim'];
$recurso = strtoupper($_POST['recurso']);
$situacao = strtoupper('ABERTO');
$resumo = strtoupper(substr($atividade,0,3)."-".$predio."-".$andar."-".$sala." | ".$hinicio."-".$hfim);
$aberto_por = strtoupper($_SESSION['email']);
$solicitante = strtoupper(utf8_decode($_POST['solicitante']));
$obs = strtoupper(utf8_decode($_POST['observacao']));
$cliente = strtoupper($_SESSION['cliente']);

$stm = $pdo->prepare("INSERT INTO AGENDAMENTO(PREDIO,ANDAR,SALA,ATIVIDADE,DATAC,HINICIO,HFIM,RECURSO,SITUACAO,RESUMO,ABERTO_POR,SOLICITANTE,OBSERVACAO,CLIENTE)VALUES('$predio','$andar','$sala','$atividade','$datac','$hinicio','$hfim','$recurso','$situacao','$resumo','$aberto_por','$solicitante','$obs','$cliente')");

if($stm->execute()){

    header("Location: formagen.php?retorno=1");
}else{

    echo $stm->errorInfo();
};

?>