<?php

ob_start();
session_start();
$cliente = $_SESSION['cliente'];

include("../conectar.php");
include("../timezone.php");

$qrcode = $_POST['qrcode'];
$R_usuario_post = strtoupper($_POST['usuario']);
$desc = $_POST['descs'];
$R_situacao  =$_POST['stats'];

$selecao = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcode'");


foreach ($selecao as $res) {
  //recebendo do formulario do consultaON.php

$R_qrcode = strtoupper($res['QRCODE']);
$R_ativo =  strtoupper($res['TIPO_DE_EQUIPAMENTO']);
$R_caract = strtoupper($res['CARACTERISTICA']);
$R_modelo = strtoupper($res['MODELO']);
$R_marca = strtoupper($res['MARCA']);
$R_predio = strtoupper($res['PREDIO']);
$R_andar = strtoupper($res['ANDAR']);
$R_setor = strtoupper($res['SETOR']);
$R_sala = strtoupper($res['SALA']);


$R_status ="";
$R_serie =  strtoupper($res['N_SERIE']);
$R_horaLamp =  strtoupper($res['HORAS_LAMP']);
$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$hora = date('H:i:s');  
}









// Preparando statement 
	
$stmt = $pdo->prepare("INSERT INTO TABLE_CHECK(DATA_2,MES,ANO,QRCODE,TIPO_DE_EQUIPAMENTO,CARACTERISTICA,MARCA,MODELO,PREDIO,ANDAR,SETOR,SALA,SITUACAO,OBSERVACAO,NOME_USER,STATUS,SERIE,HORAS_LAMP,HORAS,PREVENTIVA,CLIENTE) 
values ('$data_2','$mes',$ano,'$R_qrcode','$R_ativo','$R_caract','$R_modelo','$R_marca','$R_predio','$R_andar','$R_setor','$R_sala','$R_situacao','$desc','$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$hora','SIM','$cliente')"); 



// Executando statement 
if($stmt->execute()){
    "";

} else{

    $stmt->error_reporting;
};
 


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

