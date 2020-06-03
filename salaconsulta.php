<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_POST['predio']);
$ANDARES = $_POST['andar'];



$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli -> set_charset("utf8");
$sql = "SELECT DISTINCT SALA, SETOR, ANDAR,PREDIO FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDARES'  ORDER BY ANDAR, SALA, SETOR ";
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

  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<script type="text/javascript">
  
$(document).ready(function(){

          $('.btn-outline-warning').mousedown(function(){
           var sala = $(this).val();
           var sala_split = sala.split(" ");
           
             $.post('recebesala.php',{nsala:sala},function(data) {
                   
                });
             
              $(this).fadeOut('slow');
              $(this).prop('disabled','true');
           
              
          });


          $("#txtBusca").keyup(function(){
              var texto = $(this).val();
              var textm = texto.toString();
              
              
              
              $("tr").css("display", "block");
              $("tr").each(function(){
                if($(this).text().indexOf(textm.toUpperCase()) < 0){
                    
                     
                     $(this).hide();
                     
                  };
              });
          });




});




</script>


<BODY>
<br>

  <?php 

  foreach($result as $res){
    echo '<div class="card shadow-sm p-3 mb-5 bg-white rounded">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">'.$res['SALA'].'</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">'.$res['SETOR'].'</h6>';
    echo '<td>'.'<div class="text-right"><button class="btn btn-outline-warning" Value="'.$res['PREDIO'].'-'.$res['ANDAR'].'-'.$res['SETOR'].'-'.$res['SALA'].'">'.'<ion-icon src="./icon/md-contacts.svg"  size="small" ></ion-icon></button></div>'.'</td>';
    echo '</div>';
    echo '</div>';

      
    
}


echo '</table>';
echo '</div>';
echo "<br>";
   echo "<br>";
   echo "<br>";


  ?>
  
  
</BODY>