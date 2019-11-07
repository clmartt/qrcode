<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predio']);
$ANDAR = $_GET['andar'];


$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT SETOR, SALA FROM QRCODETABLE WHERE PREDIO ='$PREDIO' and ANDAR = '$ANDAR'  GROUP BY SALA  ORDER BY SETOR,SALA";
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
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
<?php include("menu.php"); ?>
<br>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><ion-icon src="./icon/md-search.svg"  size="small" ></ion-icon></span>
  </div>
  <input type="text" class="form-control" placeholder="Digite a sala" aria-label="Usuário" aria-describedby="basic-addon1" id="txtBusca" >
</div>




  <?php 
  
  echo '<br>'; 
  echo '<div class="table-responsive">';
  echo '<table class="table table-sm" height="100%">';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th scope="col">Setor</th>';
  echo '<th scope="col">Sala</th>';
  echo '<th scope="col">Escolher</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  foreach($result as $res){
    $pegasala = utf8_encode($res['SALA']);
    $pegasetor = $res['SETOR'];
    echo '<tr>';
    echo '<th scope="row" >'.$res['SETOR'].'</th>';
    echo '<td>'.utf8_encode($res['SALA']).'</td>';
    echo '<td><a class="navbar-brand" href="./insertativo/formInsert.php?andar='.$ANDAR.'&predio='.$PREDIO.'&sala='.$pegasala.'&setor='.$pegasetor.'"><ion-icon src="./icon/md-checkmark-circle-outline.svg"  size="small" ></ion-icon></a></td>';
    echo '</tr>';
      
 
   


}

echo '</tbody>';
echo '</table>';
echo '</div>';
echo "<br>";
   echo "<br>";
   echo "<br>";


  ?>
  
  
</BODY>