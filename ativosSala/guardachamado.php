<?php
ob_start();
session_start();

include('../conectar.php');
include('../timezone.php');
 
include("../IOS/misc/examples/phpmailer/class.phpmailer.php");
include("../IOS/misc/examples/phpmailer/class.smtp.php");

$data_2 = date('Y-m-d');
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');


$getqrcode = strtoupper($_POST['qrcode']);
$problema = strtoupper($_POST['problema']);
$usuario_post = strtoupper($_POST['usuario_post']);
$getobs = strtoupper($_POST['obs']);
$statusChamado = strtoupper($_POST['statusChamado']);
$dataBrasil = date('d-m-Y');
$getOs = strtoupper($_POST['solicitante']);
$solucao = strtoupper($_POST['solucao']);
$solicitante = $_post['solicitante'];

$selecao = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$getqrcode' "); // PEGAS AS INFORMAÇÕES DO ATIVO

foreach ($selecao as $sel) {
   $R_string_id = "KVM: ".$sel['PREDIO']." - ".$sel['SALA']." - ".$sel['ANDAR'];
   $qrcode = strtoupper($sel['QRCODE']);
   $ativo = strtoupper($sel['TIPO_DE_EQUIPAMENTO']);
   $carac = strtoupper($sel['CARACTERISTICA']);
   $marca = strtoupper($sel['MARCA']);
   $modelo = strtoupper($sel['MODELO']);
   $serie = strtoupper($sel['N_SERIE']);
   $predio = strtoupper($sel['PREDIO']);
   $andar = strtoupper($sel['ANDAR']);
   $setor = strtoupper($sel['SETOR']);
   $sala = strtoupper($sel['SALA']);
   $qrsala = strtoupper($sel['QRSALA']);
   $horaL = strtoupper($sel['HORAS_LAMP']);
   $situacao = strtoupper($sel['SITUACAO']);
   $cliente = strtoupper($sel['CLIENTE']);

};

//----------------------------------------------------------------------------------------------------------------------------------
//verificando se o usuario é ibba
//include("../IOS/misc/examples/insertchamadosalafresh.php");

if($cliente=='IBBA'){
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
  $mailer->Body = 'O '.$usuario_post.' enviou um chamado para o - '.$predio.' - Andar: '.$andar.' - '.$sala.'- QRCODE : '.$qrcode.' informando o problema: '. $problema.' | '.$getobs;

  if(!$mailer->Send()){

  echo "A mensagem não foi enviada para o FRESH, porem o chamado foi armazenado na base!"."<br>";
  //echo "Mailer Error: " . $mailer->ErrorInfo; exit; 

  };
}
     


// fim do envio de email.......

//----------------------------------------------------------------------------------------------------------------------------------







// verificando se o chamado foi aberto com andamento ou resolvido
//----------------------------------------------------------------------------------------------------------------------------
if($statusChamado == 'ANDAMENTO'){ // SE O CHAMADO FOR CLASSIFICADO COMO ANDAMENTO 
            $stmt = $pdo->prepare("INSERT INTO CHAMADOS(
              string_id,horas,data_2,mes,ano,qrcode,ativo,caracteristica,modelo,marca,predio,andar,sala,situacao,problema,observacao,nome_user,status,serie,horas_lamp,OS_BANCO,solucao,cliente)value('$R_string_id','$horas','$data_2','$mes','$ano','$qrcode','$ativo','$carac','$modelo','$marca','$predio','$andar','$sala','PROBLEMA','$problema','$getobs','$usuario_post','$statusChamado','$serie','$horaL','$getOs','$solucao','$cliente')");
            $upsituacao = $pdo->query("UPDATE QRCODETABLE SET SITUACAO = 'PROBLEMA' WHERE QRCODE = '$qrcode'");

          if($stmt->execute()){

              $upsituacao->execute();  
              header("Location: ativodetalhe.php?qrcode=".$qrcode."&obs=".$getobs);



          }else{

              var_dump($stmt->errorInfo());
          }

}else{

          $stmt = $pdo->prepare("INSERT INTO CHAMADOS(
            string_id,horas,data_2,mes,ano,qrcode,ativo,caracteristica,modelo,marca,predio,andar,sala,situacao,problema,observacao,nome_user,status,serie,horas_lamp,OS_BANCO,data_fechado,fechado_por,solucao,cliente)value('$R_string_id','$horas','$data_2','$mes','$ano','$qrcode','$ativo','$carac','$modelo','$marca','$predio','$andar','$sala','PROBLEMA','$problema','$getobs','$usuario_post','$statusChamado','$serie','$horaL','$getOs','$data_2','$usuario_post','$solucao','$cliente')");
            $upsituacao = $pdo->query("UPDATE QRCODETABLE SET SITUACAO = 'OK' WHERE QRCODE = '$qrcode'");

        if($stmt->execute()){

           $upsituacao->execute();  
            header("Location: ativodetalhe.php?qrcode=".$qrcode);



        }else{

            var_dump($stmt->errorInfo());
}

}


    

    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  </head>
  <body>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>