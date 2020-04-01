<?php
include("../conectar.php");
$mes = date("F");
$ano = date("Y");
$email = strtoupper($_POST['emails']);
$cliente = strtoupper($_POST['clientes']);

$dia = $_POST['dias'];
$horaInicio= $_POST['horaI'];
$horafim= $_POST['horaF'];
$recurso= strtoupper($_POST['recursos']);
$responsavel= strtoupper($_POST['resp']);
$descricao= strtoupper($_POST['desc']);
$titulo= strtoupper($_POST['titulo']);

/*
echo $mes."<br>";
echo $ano."<br>";
echo $email."<br>";
echo $cliente."<br>";

echo "do form <br>";
echo $dia."<br>";
echo $horaInicio."<br>";
echo $horafim."<br>";
echo $recurso."<br>";
echo $responsavel."<br>";
echo $descricao."<br>";
echo $titulo."<br>";

*/

 $sql = $pdo->prepare("INSERT INTO AGENDAMENTO (DATA_AGEN,MES,ANO,TITULO,HORA_INICIO,HORA_FIM,DESCRICAO,RESPONSAVEL,SITUACAO,RECURSO,ABERTO_POR,CLIENTE)VALUES('$dia','$mes','$ano','$titulo','$horaInicio','$horafim','$descricao','$responsavel','ABERTO','$recurso','$email','$cliente')");

$sql->execute();

if($sql){
    echo "Agendamento Inserido!!!";
}else{
    $sql->error_reporting;

}


?>