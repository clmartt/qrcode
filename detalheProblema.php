<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$predio = $_POST['prediotxt'];
$problema = trim($_POST['problema']);



$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM CHAMADOS WHERE  predio = '$predio' and problema ='$problema' ORDER BY status asc";
$result = $mysqli->query($sql);


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KVM INFORMATICA - QR CODE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>


</head>
<script type="text/javascript">
  

</script>
<BODY>
<BR>
<BR>
 
  <?php

  foreach ($result as $res) {
    if($res['problema'] != ""){

      if($res['status'] == 'ANDAMENTO'){
                echo '<div class="card">
                      <div class="card-header">
                        '.date('d-m-Y',strtotime($res['data_2'])).' - '.'<span class="text-warning">'.$res['status'].'</span>'.'
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">'.'Andar : '.$res['andar'].' - Sala : '.utf8_encode($res['sala']).'</h5>
                        <p class="card-text">'.'<b>Problema </b>: '.utf8_encode($res['observacao']).'</p>
                        <p class="card-text">'.'<b>Solução </b>: '.utf8_encode($res['solucao']).'</p>
                        <p class="card-text">'.'<b>Fechado em : </b>: '.$res['data_fechado'].'</p>
                        
                      </div>
                    </div>';

      }else{
                    echo '<div class="card">
                      <div class="card-header">
                        '.date('d-m-Y',strtotime($res['data_2'])).' - '.'<span class="text-success">'.$res['status'].'</span>'.'
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">'.'Andar : '.$res['andar'].' - Sala : '.utf8_encode($res['sala']).'</h5>
                        <p class="card-text">'.'<b>Problema </b>: '.utf8_encode($res['observacao']).'</p>
                        <p class="card-text">'.'<b>Solução </b>: '.utf8_encode($res['solucao']).'</p>
                        <p class="card-text">'.'<b>Fechado em : </b>: '.$res['data_fechado'].'</p>
                        
                      </div>
                    </div>';

      };
            
            
    };

  };
  
  echo '<br>';
  echo '<br>';
  echo '<br>';
?>


  
 
</BODY>