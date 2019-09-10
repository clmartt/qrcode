<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predios']);
$ANDARES = $_GET['andar'];


$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT DISTINCT SALA, SETOR, ANDAR,PREDIO FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDARES'  ORDER BY SETOR ";
$result = $mysqli->query($sql);



   echo '<nav class="navbar fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/principal.php">
   
    Retornar
  </a>
</nav>';
echo "<p></p>";
echo "</br>";


    foreach($result as $res){
        
           echo '<div class="card">';
          
          echo '<div class="card-header">';
          echo '<h5 class="card-title">'.'Setor : '.utf8_encode($res['SETOR']).'</h5>';
          echo '<p class="card-text">'.'ANDAR : '.$res['ANDAR'].' - SETOR : '.$res['SETOR'].' - SALA : - '.utf8_encode($res['SALA']).'</p> <br>
          <button class="btn btn-primary">'.$res['PREDIO'].'-'.$res['ANDAR'].'-'.utf8_encode($res['SETOR']).'-'.utf8_encode($res['SALA']).'</button></div></div>';
          echo "<br>";







    }
    



 
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
  
$(document).ready(function(){

          $('button').mousedown(function(){
           var sala = $(this).text();
           var sala_split = sala.split(" ");
           
             $.post('recebesala.php',{nsala:sala},function(data) {
                   
                });
             
              $(this).fadeOut('slow');
              $(this).prop('disabled','true');
           
              
          });




});




</script>
<BODY>
  <?php 
  include("menu.php");
  ?>
  
<DIV></DIV>

</BODY>