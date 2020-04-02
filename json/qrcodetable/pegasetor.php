<?php
include("../../conectar.php");
$predio = $_GET['predios'];
$andar = $_GET['andares'];
$sala = $_GET['salas'];
$setor = $pdo->query("SELECT SETOR FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar'  AND SALA = '$sala' GROUP BY SETOR ORDER BY SETOR")->fetchAll();




echo json_encode($setor);

?>