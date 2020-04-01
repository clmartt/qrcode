<?php
include("../conectar.php");
$predio = $_GET['predios'];
$andar = $pdo->query("SELECT andar FROM CHAMADOS WHERE predio = '$predio' GROUP BY andar ORDER BY andar asc")->fetchAll();
echo json_encode($andar);

?>