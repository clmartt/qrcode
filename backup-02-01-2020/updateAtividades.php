<?php 
include('conectar.php');

session_start();




$id = $_POST['idAtividade'];
$situacao = $_POST['txtSituacao'];

$selecao = $pdo->query("UPDATE AGENDAMENTO SET SITUACAO = '$situacao' WHERE ID_AGENDAMENTO = '$id'");


if($selecao->execute()){

    echo $situacao;


};





?>