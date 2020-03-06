<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
ob_start();
session_start(); //pega a sessao do usuario
$cliente = $_SESSION['cliente'];


include("./phpmailer/class.phpmailer.php"); 
include("./phpmailer/class.smtp.php"); 





//recebendo o qrcode 
$qrcodeequipamento = $_POST['qrcode'];
$problema = $_POST['problema'];
$dproblema = $_POST['dproblema'];
$R_os_banco = $_POST['os'];


if($_POST['situacao']=='ANDAMENTO'){
	$R_status = strtoupper('ANDAMENTO');
}else{
	$R_status = strtoupper('RESOLVIDO');

};


include("../../../conectar.php");

// Preparando statement PEGANDO OS DADOS DO EQUIPAMENTO PELO QRCODE-----------------------------------------------------------------------------------------------------------------


$stmtSelect = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcodeequipamento'")->fetch();// fetch() usado para retornar somente um registro

//alocando variaveis na memoria-----------------------------------------------------------------------------------------------------------------

$R_string_id = "KVM: ".$stmtSelect['PREDIO']." - ".$stmtSelect['SALA']." - ".$stmtSelect['ANDAR'];
$R_usuario_post = strtoupper($_SESSION['email']);
$R_qrcode = strtoupper($stmtSelect['QRCODE']);
$R_ativo =  strtoupper(utf8_decode($stmtSelect['TIPO_DE_EQUIPAMENTO']));
$R_caract = strtoupper(utf8_decode($stmtSelect['CARACTERISTICA']));
$R_modelo = strtoupper($stmtSelect['MODELO']);
$R_marca = strtoupper($stmtSelect['MARCA']);
$R_predio = strtoupper($stmtSelect['PREDIO']);
$R_andar = strtoupper($stmtSelect['ANDAR']);
//$R_setor = = strtoupper(utf8_decode($_POST['R_setor']));
$R_sala = strtoupper($stmtSelect['SALA']);
$R_situacao = strtoupper('PROBLEMA');
$R_problema = strtoupper($_POST['problema']);
$R_info = strtoupper($_POST['dproblema']);
$R_serie =  strtoupper($stmtSelect['N_SERIE']);
$R_horaLamp =  strtoupper($stmtSelect['HORAS_LAMP']);
$cliente = strtoupper($stmtSelect['CLIENTE']);
$data_2 = date('Y-m-d');
$dataBrasil = date('d-m-Y');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');

// enviao de email para o freshservice --------------------------------------------------------------------------------------------
	
$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->SMTPDebug = 1;
$mailer->Port = 587; //Indica a porta de conexão 
$mailer->Host = 'smtp.office365.com';//Endereço do Host do SMTP 
$mailer->SMTPAuth = true; //define se haverá ou não autenticação 
$mailer->Username = 'sistema.qrcode@kvminformatica.com.br'; //Login de autenticação do SMTP
$mailer->Password = 'f6YPnzrpnauI'; //Senha de autenticação do SMTP
$mailer->FromName = 'Qrcode KVM'; //Nome que será exibido
$mailer->From = 'sistema.qrcode@kvminformatica.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
$mailer->AddAddress('freshservice@kvminformatica.com.br');//Destinatários freshservice@kvminformatica.com.br
$mailer->Subject = 'Chamado enviado via Sistema QRCODE KVM';
$mailer->Body = 'O '.$R_usuario_post.' enviou um chamado para o - '.$R_predio.' - Andar: '.$R_andar.' - '.$R_sala.'- QRCODE : '.$R_qrcode.' informando o problema: '. $problema.' | '.$Dproblema;

if(!$mailer->Send()){

echo "A mensagem não foi enviada para o FRESH, porem o chamado foi armazenado na base!"."<br>";
//echo "Mailer Error: " . $mailer->ErrorInfo; exit; 

};
/// fim do envio de email-----------------------------------------------------------------------------------------------------------------



// inseri chamado na base-----------------------------------------------------------------------------------------------------------------


	$stmt = $pdo->prepare("INSERT INTO CHAMADOS(
	string_id,horas,data_2,mes,ano,qrcode,ativo,caracteristica,modelo,marca,predio,andar,sala,situacao,problema,observacao,nome_user,status,serie,horas_lamp,OS_BANCO,cliente) 
	values ('$R_string_id','$horas','$data_2','$mes','$ano','$R_qrcode','$R_ativo','$R_caract','$R_modelo','$R_marca','$R_predio','$R_andar','$R_sala','$R_situacao','$R_problema','$R_info',
	'$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$R_os_banco','$cliente')");

	// Executando statement

	if($stmt->execute()){
		echo '<img src="./images/fresh.jpg" width="30" height="30">';
	}else{
		$stmt->error_reporting;
	}; 


