<?php
header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login

$hora_nova = intval($_POST['vhora_nova']);
$N_qrcode = trim($_POST['vn_qrcode']);



$R_string_id = "KVM: ".$_POST['R_predio']." - ".$_POST['R_sala']." - ".$_POST['R_andar'];
$R_usuario_post = $_POST['R_usuario'];
$R_qrcode = $_POST['R_qrcode'];
$R_ativo =  $_POST['R_ativo'];
$R_modelo = $_POST['R_modelo'];
$R_marca = $_POST['R_marca'];
$R_predio = $_POST['R_predio'];
$R_andar = $_POST['R_andar'];
$R_sala = $_POST['R_sala'];
$R_situacao = $_POST['situacao'];
$R_info = utf8_decode($_POST['info']);
$R_status = $_POST['status'];
$R_serie =  $_POST['R_serie'];
$R_horaLamp =  $_POST['R_horaLamp'];
$data_2 = date('d/m/y');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');




// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 
	
$stmt = $pdo->prepare("UPDATE QRCODETABLE SET HORAS_LAMP = '$hora_nova' WHERE QRCODE = '$N_qrcode'"); 

// Executando statement 
$stmt->execute();
$registro = $stmt->rowCount();
if($registro == 1){
 echo 'ATUALIZADO';

}else{
//$stmt->execute();

	echo 'FORAM ENCONTRADOS MAIS DE UM REGISTRO COM ESTE QRCODE';
};
 

