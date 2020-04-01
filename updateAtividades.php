<?php 
include('./conectar.php');
include("./timezone.php");

session_start();




$id = $_POST['idAtividade']; // ID DO AGENDAMENTO
$situacao = $_POST['txtSituacao'];// SITUAÇÃO DO AGENDAMENTO (ABERTO, ANDAMENTO OU FINALIZADO)
$feedback = $_POST['feedback'];//  SE É SHOW - NO_SHOW ETC
$obs = strtoupper($_POST['obs']); // COMENTARIOS DO TECNICO QUE FECHOU 
$hora = date("H:i:s");
$user = strtoupper($_POST['user']);
$dataFechado = date("Y-m-d");




if($situacao!=='FINALIZADO'){

    $selecao = $pdo->prepare("UPDATE AGENDAMENTO SET SITUACAO = '$situacao' WHERE ID_AGEN = '$id' ");
}

else{

    $selecao = $pdo->prepare("UPDATE AGENDAMENTO SET SITUACAO = '$situacao', FECHADO_POR = '$user' , DATA_FECHADO = '$dataFechado', HORA_FECHADO = '$hora', OBSERVACAO = '$obs', ST_RETORNO = '$feedback' WHERE ID_AGEN = '$id' ");

}


$selecao->execute();


?>