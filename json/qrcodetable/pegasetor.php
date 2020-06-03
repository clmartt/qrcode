<?php
include("../../conectar.php");
$predio = $_GET['predios'];
$andar = $_GET['andares'];
$sala = $_GET['salas'];
$setor = $pdo->query("SELECT SETOR,QRSALA FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar'  AND SALA = '$sala' GROUP BY SETOR,QRSALA ORDER BY SETOR")->fetchAll();




echo json_encode($setor);

?>