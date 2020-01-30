<?php
include('conectar.php');

$id = $_POST['idAtividade'];


$sql = "DELETE FROM AGENDAMENTO WHERE ID_AGENDAMENTO =  :ATVID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':ATVID', $id, PDO::PARAM_INT);	

if($stmt->execute()){

    echo "OK";
};



?>