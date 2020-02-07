<?php



// Definindo parametros de conexao 

$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 

$usuario = 'qrcodekvm'; 

$senha = 'qrcodekvm';  



//recebendo do formulario os campos de login

$email = $_POST['email'];
$cliente = $_POST['cliente'];
$perfil = $_POST['perfil'];
$permissao = $_POST['cliente'];

$senha_user = $_POST['senha'];

$nome = $_POST['nome'];







// Conectando 

try { 

$pdo = new PDO($dsn, $usuario, $senha); 

} catch (PDOException $e) { 

echo $e->getMessage(); 

exit(1); 

} 



// Preparando statement 





$stmt = $pdo->prepare("INSERT INTO login_usuario (email,senha,nome,acesso,cliente,perfil,permissao) values ('$email','$senha_user','$nome','APROVADO','$cliente','$perfil','$permissao')"); 



  



// Executando statement 

$stmt->execute(); 



// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 

if ($stmt) { 

$_SESSION['email'] = $email; 

$sessao = $email;

echo "<script>

	alert('Ótimo, Você agora faz parte da nossa equipe!'); location= './login.html';

	</script>"; 





define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/59ecd3aec6764b5ebcfe96e848f08107/f69d8532-4ecd-4add-9072-a2c3e06820ef');



  $messageTeams = json_encode(array('text' => 'Oba,  :'.$nome.' <br> acabou de se cadastrar com o e-mail: '.$email.'Para aprovar o acesse: <br>'.'https://kvm1000.websiteseguro.com/qrteste/aprovar/listauser.php'));



  // Usando o curl para enviar

  $c = curl_init(TEAMS_WEBHOOK);

  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt($c, CURLOPT_POST, true);

  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);

  curl_exec($c);

  curl_close($c);





//header('Location: http://www.uol.com.br');  direciona para outra pagina

echo 'inserido meu rapaz';

} else { 

echo "Erro ao gravar"; 





} 

