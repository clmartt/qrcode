<?php 
include('conectar.php');
include('timezone.php');

$idManu = $_POST['idManu'];

$upload = $pdo->prepare("UPDATE MANUTENCAO SET SITUACAO = 'FECHADO' WHERE ID_MANU = '$idManu'");

if($upload->execute()){
   echo "Super Update Ativado"; 

}else{
    echo $upload->error_reporting;
}






?>