<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

ob_start();
session_start(); //pega a sessao do usuario
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

$qrcodeequip = $_POST['qrcode']; // RECEBE O QR DO SALACHECK.PHP
$arrayqrcode = explode(',', $qrcodeequip);
$ocupada = $_GET['ocupada'];








// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 



for ($i=0; $i < count($qrcodeequip) ; $i++) { 
 
$codigoQrcodes = $qrcodeequip[$i];

$stmtSelect = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$codigoQrcodes'")->fetch(); // REALIZANDO A QUERY
//var_dump($stmtSelect);
//echo "<br>";
//echo $stmtSelect['QRCODE']."<BR>";
//echo strtoupper(utf8_decode($stmtSelect['SALA']));

//recebendo do formulario do consultaON.php
$R_usuario_post = strtoupper($_SESSION['email']);
$R_qrcode = strtoupper($stmtSelect['QRCODE']);
$R_ativo =  strtoupper($stmtSelect['TIPO_DE_EQUIPAMENTO']);
$R_caract = strtoupper($stmtSelect['CARACTERISTICA']);
$R_modelo = strtoupper($stmtSelect['MODELO']);
$R_marca = strtoupper($stmtSelect['MARCA']);
$R_predio = strtoupper(utf8_encode($stmtSelect['PREDIO']));
$R_andar = strtoupper($stmtSelect['ANDAR']);
$R_setor = strtoupper(utf8_encode($stmtSelect['SETOR']));
$R_sala = strtoupper(utf8_encode($stmtSelect['SALA']));
$R_qrsala = strtoupper($stmtSelect['QRSALA']);
$R_situacao = strtoupper($stmtSelect['SITUACAO']);
$R_info = strtoupper(utf8_encode($stmtSelect['OBSERVACAO']));
$R_status = strtoupper($stmtSelect['STATUS']);
$R_serie =  strtoupper($stmtSelect['N_SERIE']);
$R_horaLamp =  strtoupper($stmtSelect['HORAS_LAMP']);
$R_preventiva = 'NAO';
$R_cliente =  strtoupper($stmtSelect['CLIENTE']);
$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$hora = date('H:i:s');

//echo $R_sala;
// Preparando statement 

    $stmt = $pdo->prepare("INSERT INTO TABLE_CHECK(DATA_2,MES,ANO,QRCODE,TIPO_DE_EQUIPAMENTO,CARACTERISTICA,MARCA,MODELO,PREDIO,ANDAR,SETOR,SALA,QRSALA,SITUACAO,OBSERVACAO,NOME_USER,STATUS,SERIE,HORAS_LAMP,OCUPADA,HORAS,PREVENTIVA,CLIENTE) 
      values ('$data_2','$mes','$ano','$R_qrcode','$R_ativo','$R_caract','$R_marca','$R_modelo','$R_predio','$R_andar','$R_setor','$R_sala','$R_qrsala', '$R_situacao','$R_info','$R_usuario_post','$R_status','$R_serie','$R_horaLamp','$ocupada','$hora','$R_preventiva','$R_cliente')"); 

// Executando statement 
$stmt->execute(); 


$contagem = $stmt->rowCount();
$conteste  += $teste;




//echo "window.location.href = 'salacheck.php'";



//header('Location: ./camsala.php?user='.$R_usuario_post);

};
/*
define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/d5da74e9f60849b58391886fd25152b3/f69d8532-4ecd-4add-9072-a2c3e06820ef');

  $messageTeams = json_encode(array('text' => 'O '.$R_usuario_post.'<br>'.' está no predio '.$R_predio.' no '.$R_andar.' andar na sala '.$R_sala.' e fez check-in em '.$conteste.' equipamentos'));

  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);
  curl_exec($c);
  curl_close($c);

  header('Location: ./camsala.php?user='.$R_usuario_post);

*/


//===========================================================================================>>>>>>>>

//=========================================================================================>>>>>>>>>







// ENVIA PARA TEAMS
  /*
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
header("Location: http://kvminformatica.com.br/qrteste/principal.php");
} else { 
echo "Erro ao gravar"; 


} 
*/