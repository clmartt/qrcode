<?php
include('../conectar.php');

$idPost = $_POST['idPost'];
$userResp = $_POST['usuario'];
$resposta = $_POST['resposta'];
$dataR = date("Y-m-d");
$horaR = date("H:i:s");


$sql = $pdo->prepare("INSERT INTO POST_RESPOSTA (ID_POST,USER_RESP,RESPOSTA,DATA_RESP,HORA_RESP)VALUES('$idPost','$userResp','$resposta','$dataR','$horaR')");

$sql->execute();



?>