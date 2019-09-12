<?php
header('Content-Type: text/html; charset=utf-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login
$R_string_id = "KVM: ".$_POST['R_predio']." - ".$_POST['R_sala']." - ".$_POST['R_andar'];
$R_usuario_post = strtoupper($_POST['R_usuario']);
$R_qrcode = strtoupper($_POST['R_qrcode']);
$R_ativo =  strtoupper(utf8_decode($_POST['R_ativo']));
$R_caract = strtoupper(utf8_decode($_POST['R_caract']));
$R_modelo = strtoupper($_POST['R_modelo']);
$R_marca = strtoupper($_POST['R_marca']);
$R_predio = strtoupper($_POST['R_predio']);
$R_andar = strtoupper($_POST['R_andar']);
//$R_setor = = strtoupper(utf8_decode($_POST['R_setor']));
$R_sala = strtoupper(utf8_decode($_POST['R_sala']));
$R_situacao = strtoupper($_POST['situacao']);
$R_problema = strtoupper($_POST['problema']);
$R_info = strtoupper(utf8_decode($_POST['info']));
$R_os_banco = strtoupper($_POST['os_banco']);
$R_status = strtoupper($_POST['status']);
$R_serie =  strtoupper($_POST['R_serie']);
$R_horaLamp =  strtoupper($_POST['R_horaLamp']);
$data_2 = date('Y-m-d');
$dataBrasil = date('d-m-Y');
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

// caso o status for resolvido ele insere a data do fechamento
if($R_status == "RESOLVIDO"){

	$stmt = $pdo->prepare("INSERT INTO CHAMADOS(
	string_id,horas,data_2,mes,ano,qrcode,ativo,caracteristica,modelo,marca,predio,andar,sala,situacao,problema,observacao,nome_user,status,serie,horas_lamp,OS_BANCO,data_fechado,fechado_por,solucao) 
	values ('$R_string_id','$horas','$data_2','$mes','$ano','$R_qrcode','$R_ativo','$R_caract','$R_modelo','$R_marca','$R_predio','$R_andar','$R_sala','$R_situacao','$R_problema','$R_info','$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$R_os_banco','$dataBrasil','$R_usuario_post','$R_info')"); 
	// Executando statement 
	$stmt->execute(); 

}else{

	$stmt = $pdo->prepare("INSERT INTO CHAMADOS(
	string_id,horas,data_2,mes,ano,qrcode,ativo,caracteristica,modelo,marca,predio,andar,sala,situacao,problema,observacao,nome_user,status,serie,horas_lamp,OS_BANCO) 
	values ('$R_string_id','$horas','$data_2','$mes','$ano','$R_qrcode','$R_ativo','$R_caract','$R_modelo','$R_marca','$R_predio','$R_andar','$R_sala','$R_situacao','$R_problema','$R_info',
	'$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$R_os_banco')");

	// Executando statement
	$stmt->execute(); 

}
	

// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 
echo 'Chamado aberto!!!';

//header('Location: http://www.uol.com.br');  direciona para outra pagina
//header("Location: https://kvm1000.websiteseguro.com/qrteste/IOS/misc/examples/consultaON.php");
} else { 
echo "Erro ao gravar chamados"; 


} 
