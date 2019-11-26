<?php



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

$mailer->Username = 'claudio.martt@kvminformatica.com.br'; //Login de autenticação do SMTP

$mailer->Password = 'Emmanuel16'; //Senha de autenticação do SMTP

$mailer->FromName = 'Qrcode KVM'; //Nome que será exibido

$mailer->From = 'claudio.martt@kvminformatica.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP

$mailer->AddAddress('claudio.martt@kvminformatica.com.br');//Destinatários freshservice@kvminformatica.com.br

$mailer->Subject = 'Problema na pagina insert check sala enviado via Sistema QRCODE KVM';

$mailer->Body = 'Enviado porque houve um erro de contagem na pagina insertchecksala.php';

if(!$mailer->Send())

{

echo "Message was not sent";

echo "Mailer Error: " . $mailer->ErrorInfo; exit; }

print "E-mail enviado!"

?>



