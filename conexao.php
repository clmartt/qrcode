<?php

//sessao
ob_start();
session_start();


// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm'; 

//recebendo do formulario os campos de login
$email = $_POST['email'];
$senha_user = $_POST['senha'];
$_SESSION['email'] = $email;

$data_2 = date('d/m/y'); // guarda a data
 // Criando configuraçaõ do Slack
  define('SLACK_WEBHOOK', 'https://hooks.slack.com/services/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');
 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// Preparando statement 
$stmt = $pdo->prepare("SELECT * FROM login_usuario WHERE email = '$email' and senha = '$senha_user' and acesso = 'APROVADO' "); 
 


// Executando statement 
$stmt->execute(); 

// Obter linha consultada 
$obj = $stmt->fetchObject(); 

// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($obj) { 

$_SESSION['email'] = $_POST['email']; 
$Vsessao = $_SESSION['email'];
echo $Vsessao;

$message = array('payload' => json_encode(array('text' => 'Acesso realizado por : '.$email )));
  // Usando o curl para enviar
  $c = curl_init(SLACK_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
  curl_exec($c);
  curl_close($c);


  define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/59ecd3aec6764b5ebcfe96e848f08107/f69d8532-4ecd-4add-9072-a2c3e06820ef');

 
  $messageTeams = json_encode(array('text' => 'Ops! Acesso realizado em :'.$data_2.' <br> por '.$email ));

  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);
  curl_exec($c);
  curl_close($c);

header("Location: principal.php?user='$Vsessao'"); 

} else { 
echo "<script>
	alert('Ops, desculpa, mas acho que você deve se cadastrar!!'); location= './login.html';
	</script>"; 



} 
