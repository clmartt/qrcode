<?php
include("../conectar.php");
$predio = $_GET['predios'];
$andar = $_GET['andares'];
$sala = $pdo->query("SELECT SALA FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar' GROUP BY SALA ORDER BY SALA")->fetchAll();
echo json_encode($sala);

?>