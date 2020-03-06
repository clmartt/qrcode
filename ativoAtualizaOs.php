<?php 
include('conectar.php');
include('timezone.php');

$numeroOs = $_POST['nos'];
$idManu = $_POST['idManus'];

$upload = $pdo->prepare("UPDATE MANUTENCAO SET OS = '$numeroOs' WHERE ID_MANU = '$idManu'");

if($upload->execute()){
   echo "OS Inserida!!!"; 

}else{
    echo $upload->error_reporting;
}






?>