<?php

if(!$_POST){
    header("Location: ./login.html");

};
// cabeçalho para utf8 

ob_start();
session_start(); //pega a sessao do usuario


include('../conectar.php');



$predio = strtoupper($_POST['predio']);
$andar = strtoupper($_POST['andar']);
$sala = strtoupper($_POST['sala']);
$atividade = strtoupper($_POST['atividade']);
$tipo = strtoupper($_POST['tipo']);
$datac = $_POST['paraData'];
$hinicio = $_POST['hinicio'];
$hfim = $_POST['hfim'];
$recurso = strtoupper($_POST['recurso']);
$situacao = strtoupper('ABERTO');
$resumo = strtoupper(substr($atividade,0,3)."-".$predio."-".$andar."-".$sala." | ".$hinicio."-".$hfim);
$aberto_por = strtoupper($_SESSION['email']);
$solicitante = strtoupper($_POST['solicitante']);
$obs = strtoupper($_POST['observacao']);
$cliente = strtoupper($_SESSION['permissao']);

$stm = $pdo->prepare("INSERT INTO AGENDAMENTO(PREDIO,ANDAR,SALA,ATIVIDADE,TIPO,DATAC,HINICIO,HFIM,RECURSO,SITUACAO,RESUMO,ABERTO_POR,SOLICITANTE,OBSERVACAO,CLIENTE)VALUES('$predio','$andar','$sala','$atividade','$tipo','$datac','$hinicio','$hfim','$recurso','$situacao','$resumo','$aberto_por','$solicitante','$obs','$cliente')");

if($stm->execute()){

    header("Location: formagen.php?retorno=1");
}else{

    echo $stm->errorInfo();
};

?>