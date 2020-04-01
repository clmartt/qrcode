<?php
include("../conectar.php");
$idPost = $_POST['idPost'];

$sql = $pdo->query("DELETE FROM POST_CHAMADOS WHERE ID_POST = '$idPost'");
$sql->execute();



?>