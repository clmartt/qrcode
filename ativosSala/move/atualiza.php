<?php 


$dataAtual = date('Y-m-d');
$hora = date('H:i:s');

include("../../conectar.php");

//ESTAS VARIAVEIS SAO DO PARA ----DESTINO --- 
$qrcode = $_POST['qrcode'];
$predio = $_POST['predio'];
$andar = $_POST['andar'];
$sala = $_POST['sala'];
$setor = $_POST['setor'];
$qrsala = $_POST['qrsala'];
$motivo = $_POST['motivo'];
$usuario = $_POST['usuario'];
$permissao = $_POST['permissao'];


//pega as informações atuais do ativo
$pegaativo = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcode'");
foreach ($pegaativo as $at) {
    $de_predio = $at['PREDIO'];
    $de_andar = $at['ANDAR'];
    $de_setor = $at['SETOR'];
    $de_sala = $at['SALA'];
    $de_qrsala = $at['QRSALA'];
};
// guarda na tabela move
$guarda = $pdo->prepare("INSERT INTO MOVER (DATA_2,HORA,QRCODE,DE_PREDIO,DE_ANDAR,DE_SETOR,DE_SALA,DE_QRSALA,PARA_PREDIO,PARA_ANDAR,PARA_SETOR,PARA_SALA,PARA_QRSALA,NOME_USER,MOTIVO,CLIENTE)VALUES('$dataAtual','$hora','$qrcode','$de_predio','$de_andar','$de_setor','$de_sala','$de_qrsala','$predio','$andar','$setor','$sala','$qrsala','$usuario','$motivo','$permissao')");
$guarda->execute();


// faz o update na tabela qrcode
$update = $pdo->query("UPDATE QRCODETABLE SET PREDIO = '$predio', ANDAR ='$andar',SALA = '$sala', SETOR = '$setor', QRSALA = '$qrsala' WHERE QRCODE = '$qrcode'");
$qtd = count($update);

if($update->execute()){
    $feito = 1;
    echo "Movimentação foi executada!";
}else{
    $update->error_reporting;
}

?>