<?php
include("../conectar.php");
$predio = $_GET['predios'];
$andar = $_GET['andares'];

$problema = $pdo->query("SELECT problema FROM CHAMADOS WHERE predio = '$predio' AND andar = '$andar' AND status = 'ANDAMENTO' GROUP BY problema ORDER BY problema")->fetchAll();
echo json_encode($problema);

?>