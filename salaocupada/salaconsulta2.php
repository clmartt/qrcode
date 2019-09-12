<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$ANDAR = $_POST['andar'];


$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM QRCODETABLE WHERE ANDAR LIKE '%$ANDAR%' order by SALA";
$result = $mysqli->query($sql);



    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "<table border='1' class = 'table table-dark'>";
    $dadosXls .= "<thead class='thead-dark'>";
    $dadosXls .= "<tr>";
    $dadosXls .= "<th scope='col'>PREDIO</th>";
    $dadosXls .= "<th scope='col'>ANDAR</th>";
    $dadosXls .= "<th scope='col'>SETOR</th>";
    $dadosXls .= "<th scope='col'>SALA</th>";
    $dadosXls .= "</tr>";
    $dadosXls .= "</thead>";



    foreach($result as $res){
        $dadosXls .= "<tr>";
        $dadosXls .= "<td>".$res['PREDIO']." ></td>";
        $dadosXls .= "<td>".$res['ANDAR']." ></td>";
        $dadosXls .= "<td>".$res['SETOR']." ></td>";
        $dadosXls .= "<td>".utf8_encode($res['SALA'])."</td>";
        $dadosXls .= "</tr>";
    }
    $dadosXls .= "</table>";


 
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

          $('tr').mousedown(function(){
           var sala = $(this).text();
             $.post('recebesala.php',{nsala:sala},function(data) {
                   
                });
              alert(sala);
              $(this).css('background-color','yellow');
              $(this).fadeOut('slow');
              
          });




});




</script>
<BODY>
  
<DIV class="card-body"> <?PHP echo $dadosXls; ?></DIV>





<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</BODY>