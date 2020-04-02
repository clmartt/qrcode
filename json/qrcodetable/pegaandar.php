<?php
include("../../conectar.php");
$predio = $_GET['predios'];
$andar = $pdo->query("SELECT ANDAR FROM QRCODETABLE WHERE PREDIO = '$predio' GROUP BY ANDAR ORDER BY ANDAR asc")->fetchAll();
echo json_encode($andar);

?>