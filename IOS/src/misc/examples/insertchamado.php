<?php
header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login
$R_string_id = "KVM: ".$_POST['R_predio']." - ".$_POST['R_sala']." - ".$_POST['R_andar'];
$R_usuario_post = $_POST['R_usuario'];
$R_qrcode = $_POST['R_qrcode'];
$R_ativo =  utf8_decode($_POST['R_ativo']);
$R_modelo = $_POST['R_modelo'];
$R_marca = $_POST['R_marca'];
$R_predio = $_POST['R_predio'];
$R_andar = $_POST['R_andar'];
$R_sala = utf8_decode($_POST['R_sala']);
$R_situacao = $_POST['situacao'];
$R_info = utf8_decode($_POST['info']);
$R_os_banco = $_POST['os_banco'];
$R_status = $_POST['status'];
$R_serie =  $_POST['R_serie'];
$R_horaLamp =  $_POST['R_horaLamp'];
$data_2 = date('d/m/y');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');



echo "<script> alert('do inserts')</script>";
// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 
	
$stmt = $pdo->prepare("INSERT INTO CHAMADOS(string_id,horas,data_2,mes,ano,qrcode,ativo,modelo,marca,predio,andar,sala,situacao,observacao,nome_user,status,serie,horas_lamp,OS_BANCO) 
values ('$R_string_id','$horas','$data_2','$mes','$ano','$R_qrcode','$R_ativo','$R_modelo','$R_marca','$R_predio','$R_andar','$R_sala','$R_situacao','$R_info','$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$R_os_banco')"); 

// Executando statement 
$stmt->execute(); 

// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 
echo 'Chamado aberto!!!';

//header('Location: http://www.uol.com.br');  direciona para outra pagina
//header("Location: https://kvm1000.websiteseguro.com/qrteste/IOS/misc/examples/consultaON.php");
} else { 
echo "Erro ao gravar chamados"; 


} 
