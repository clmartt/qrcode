<?php

$email = $_POST['email'];
$cliente = $_POST['cliente'];
$perfil = $_POST['perfil'];



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

$mailer->Password = 'Kvm@3255!'; //Senha de autenticação do SMTP

$mailer->FromName = 'Qrcode KVM'; //Nome que será exibido

$mailer->From = 'sistema.qrcode@kvminformatica.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP

$mailer->AddAddress($email);//Destinatários 

$mailer->Subject = 'Convite Sistema ReQuest';

$mailer->Body = "Convite para o sistema ReQuest  - Para finalizar o Cadastro acesse : ". "https://kvm1000.websiteseguro.com/qrteste2/cadastro.php?email=".$email."&cliente=".$cliente."&perfil=".$perfil;

if(!$mailer->Send())

{

echo "Message was not sent"."<br>";

//echo "Mailer Error: " . $mailer->ErrorInfo; exit; 
 $mailer->error_reporting;
}else{
	echo "foi enviado <br>";
	 echo "Erro: " . $mailer->ErrorInfo;
};

 

?>



