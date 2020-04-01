<?php
ob_start();
session_start();
include("./conectar.php");

$PREDIO = urldecode($_GET['predio']);
$ANDARES = $_GET['andar'];

$sql = $pdo->query("SELECT * FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDARES' GROUP BY SALA,QRSALA ORDER BY SALA");

   echo '<nav class="navbar fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="./principal.php">
   
    Retornar
  </a>
</nav>';
echo "<p></p>";
echo "</br>";
echo "</br>";
echo "</br>";


    


 
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
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<script type="text/javascript">
  
$(document).ready(function(){

          $('button').mousedown(function(){
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
  
echo '<div class="container">';

  foreach($sql as $res){
    $pegasala = $res['SALA'];
    $pegaQrsala = $res['QRSALA'];
    echo '<div class="card">';
    echo '<div class="card-header">';
    echo '  Sala : '.$res['SALA'].' - Qrsala : '.$res['QRSALA'].'';
    echo '</div>';
    echo '</div>';
    if($pegaQrsala==''){
        $sqlAtivo = $pdo->query("SELECT * FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDARES' AND SALA = '$pegasala'");
    }else{

        $sqlAtivo = $pdo->query("SELECT * FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDARES' AND SALA = '$pegasala' AND QRSALA = '$pegaQrsala'");
    };
    
    foreach ($sqlAtivo as $at) {
        $totalAtivo = count($at);
        echo '<br>';
        echo '<ul class="list-group list-group-flush">';
        echo '<li class="list-group-item">'.'<a href="./IOS/misc/examples/seletor.php?qrcode='.$at['QRCODE'].'">'.$at['QRCODE'].'</a> - '.$at['TIPO_DE_EQUIPAMENTO'].' - '.$at['MARCA'].'</li>';
        echo '</ul>';
        
      
    }
    echo '<br>';

        
}
echo '</div>';

  ?>
  
  
</BODY>