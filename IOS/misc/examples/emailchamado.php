<?php







$qrcode = $_POST['qrcode'];

$problema = $_POST['problema'];

$Dproblema = $_POST['dproblema'];

$usuarioL = $_POST['usuario'];







//conexao com banco de dadso



$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 

$usuario = 'qrcodekvm'; 

$senha = 'qrcodekvm';  



// Conectando 

// se nao conectar informa o erro

try { 

$pdo = new PDO($dsn, $usuario, $senha); 

} catch (PDOException $e) { 

echo $e->getMessage(); 

exit(1); 

} 





// primeira forma	

$select = "SELECT * FROM  QRCODETABLE WHERE QRCODE = '$qrcode'"; // query de consulta ao banco

$result = $pdo->query($select); // guardando o resultado da query acima na variavel



foreach ($result as $res) {

	

	$predio = $res['PREDIO'];

	$andar = $res['ANDAR'];

	$sala = $res['SALA'];

	



}















//require_once('./phpmailer/class.phpmailer.php');

include("./phpmailer/class.phpmailer.php"); 

include("./phpmailer/class.smtp.php"); 



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

$mailer->Body = 'O '.$usuarioL.' enviou um chamado para o - '.$predio.' - Andar: '.$andar.' - '.$sala.'- QRCODE : '.$qrcode.' informando o problema: '. $problema.' | '.$Dproblema;

if(!$mailer->Send())

{

echo "Message was not sent"."<br>";

echo "Mailer Error: " . $mailer->ErrorInfo; exit; 
//$mailer->error_reporting;
}else{
	echo "E-mail enviado!";
};

 

?>



