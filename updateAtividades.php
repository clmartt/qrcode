<?php 
include('conectar.php');
include("timezone.php");

session_start();




$id = $_POST['idAtividade']; // ID DO AGENDAMENTO
$situacao = $_POST['txtSituacao'];// SITUAÇÃO DO AGENDAMENTO (ABERTO, ANDAMENTO OU FINALIZADO)
$feedback = $_POST['feedback'];//  SE É SHOW - NO_SHOW ETC
$obs = strtoupper(utf8_decode($_POST['obs'])); // COMENTARIOS DO TECNICO QUE FECHOU 
$hora = date("H:i:s");
$user = strtoupper($_POST['user']);


if($situacao!=='FINALIZADO'){

    $selecao = $pdo->query("UPDATE AGENDAMENTO SET SITUACAO = '$situacao',HFECHADO ='',FECHADO_POR = '',RETORNO = '',CONSIDERACAO = ''  WHERE ID_AGENDAMENTO = '$id'");
}else{

    $selecao = $pdo->query("UPDATE AGENDAMENTO SET SITUACAO = '$situacao',HFECHADO ='$hora',FECHADO_POR = '$user',RETORNO = '$feedback',CONSIDERACAO = '$obs'  WHERE ID_AGENDAMENTO = '$id'");

}




if($selecao->execute()){

    echo $situacao;


};





?>