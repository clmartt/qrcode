<?php

include("../../../conectar.php");

$pegaqrs = $pdo->query("SELECT qrcode FROM CHAMADOS WHERE status='ANDAMENTO'");
$codes = array();
foreach ($pegaqrs as $qrs) {
   array_push($codes,$qrs['qrcode']);
}

echo $codes;

?>