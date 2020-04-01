<?php
include("./phpmailer/class.phpmailer.php"); 

include("./phpmailer/class.smtp.php"); 

$dinicio = "18/03/2020 18:30:00"; 
$dfim = "18/03/2020 19:30:00"; 

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


$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host ='smtp.office365.com';
$mail->Port =587;
$mail->Username = 'sistema.qrcode@kvminformatica.com.br';
$mail->Password = 'f6YPnzrpnauI';
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$message ='corpo do invite body';
$subject ='teste assunto';
$to_id='claudio.martt@kvminformatica.com.br';
$mail->From ='sistema.qrcode@kvminformatica.com.br';
$mail->FromName= 'Qrcode KVM';
$mail->addAddress($to_id);
$mail->Subject = 'teste de assunto';
$mail->isHTML(true);
$mail->msgHTML($message);
//For sending ical
if(!empty($ical)){
$mail->addStringAttachment($ical_content,'ical.ics','base64','text/calendar');
}

$mail->send();




?>