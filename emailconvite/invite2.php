<?php

$email = 'claudio.martt@kvminformatica.com.br';
$cliente = 'teste cliente';
$perfil = 'TESTE PERFIL';
$dinicio = "18-03-2020 18:30:00"; 
$dfim = "18-03-2020 19:30:00"; 

$ical_content = 'BEGIN:VCALENDAR
VERSION:2.0
PRODID://Drupal iCal API//EN
BEGIN:VEVENT
UID:http://www.icalmaker.com/event/d8fefcc9-a576-4432-8b20-40e90889affd
DTSTAMP:'.date("Ymd\TGis").'
DTSTART:'.date("Ymd\THis", strtotime($dinicio)).'
DTEND:'.date("Ymd\THis", strtotime($dfim)).'
SUMMARY:Party in Daawat
LOCATION:Hotel Daawat, Ground Floor, Phase 5, Sector 59, Near Post Office, Mohali 160059.
DESCRIPTION:Dinner
END:VEVENT
END:VCALENDAR';


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

$mailer->Password = 'Kvm@325S'; //Senha de autenticação do SMTP

$mailer->FromName = 'Qrcode KVM'; //Nome que será exibido

$mailer->From = 'claudio.martt@kvminformatica.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP

$mailer->AddAddress($email);//Destinatários 

$mailer->Subject = 'Convite Sistema ReQuest';

$mailer->Body = "novo com as data arrumada";
$mailer->addStringAttachment($ical_content,'ical.ics','base64','text/calendar');

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



