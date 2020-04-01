<?php
include('./conectar.php');

$id = $_POST['idAtividade'];


$sql = $pdo->prepare("DELETE FROM AGENDAMENTO WHERE ID_AGEN = '$id' ");


if($sql->execute()){

    echo "OK";
}else{

    echo $id.'Nao feito';

};



?>