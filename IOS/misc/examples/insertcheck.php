<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Recife');
ob_start();
session_start();

$cliente = $_SESSION['cliente'];

//recebendo do formulario do consultaON.php
$R_usuario_post = strtoupper($_POST['R_usuario']);
$R_qrcode = strtoupper($_POST['R_qrcode']);
$R_ativo =  strtoupper($_POST['R_ativo']);
$R_caract = strtoupper($_POST['R_caract']);
$R_modelo = strtoupper($_POST['R_modelo']);
$R_marca = strtoupper($_POST['R_marca']);
$R_predio = strtoupper(utf8_decode($_POST['R_predio']));
$R_andar = strtoupper($_POST['R_andar']);
$R_setor = strtoupper(utf8_decode($_POST['R_setor']));
$R_sala = strtoupper(utf8_decode($_POST['R_sala']));
$R_situacao = strtoupper($_POST['situacao']);
$R_info = strtoupper(utf8_DECODE($_POST['info']));
$R_status = strtoupper($_POST['status']);
$R_serie =  strtoupper($_POST['R_serie']);
$R_horaLamp =  strtoupper($_POST['R_horaLamp']);
$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$hora = date('H:i:s');


include("../../../conectar.php");




// Preparando statement 
	
$stmt = $pdo->prepare("INSERT INTO TABLE_CHECK(DATA_2,MES,ANO,QRCODE,TIPO_DE_EQUIPAMENTO,CARACTERISTICA,MARCA,MODELO,PREDIO,ANDAR,SETOR,SALA,SITUACAO,OBSERVACAO,NOME_USER,STATUS,SERIE,HORAS_LAMP,HORAS,PREVENTIVA,CLIENTE) 
values ('$data_2','$mes',$ano,'$R_qrcode','$R_ativo','$R_caract','$R_modelo','$R_marca','$R_predio','$R_andar','$R_setor','$R_sala','$R_situacao','$R_info','$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$hora','SIM','$cliente')"); 

//para guarda o log
$stmtlog = $pdo->prepare("INSERT INTO log_atividade(data,hora,user,atividade,predio,sala,andar) values ('$data_2','$hora','$R_usuario_post','fez check list  - QRCODE: $R_qrcode - HORA DE LAMPADAS :  $R_horaLamp','$R_predio','$R_sala','$R_andar')"); 	

// Executando statement 
$stmt->execute(); 
$stmtlog->execute(); 


//===========================================================================================>>>>>>>>

//=========================================================================================>>>>>>>>>







// ENVIA PARA TEAMS
  
  define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/d5da74e9f60849b58391886fd25152b3/f69d8532-4ecd-4add-9072-a2c3e06820ef');

  $messageTeams = json_encode(array('text' => 'O '.$R_usuario_post.'<br>'.' está no predio '.$R_predio.' no '.$R_andar.' andar'.' na sala '.$R_sala.' e acabou de fazer o check list no equipamento: <br><hr>'.$R_qrcode.' - '.$R_ativo.' - Marca '.$R_marca.' - horas de lampada '.$R_horaLamp));

  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);
  curl_exec($c);
  curl_close($c);
//=======================================================================================================>>>>>>>>>>>>>>>>>.
// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 
//


  
//header('Location: http://www.uol.com.br');  direciona para outra pagina
header("Location: https://kvm1000.websiteseguro.com/qrteste2/IOS/misc/examples/demo.php?user=".$R_usuario_post);
} else { 
echo "Erro ao gravar"; 


} 
