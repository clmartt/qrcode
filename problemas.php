<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predio']);



$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT count(problema) as qtd, problema FROM CHAMADOS WHERE predio = '$PREDIO' GROUP BY problema ORDER BY qtd desc";
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

  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>
<script type="text/javascript">
  
</script>
<BODY>
<?php 
  include("menu.php");
  ?>
  
<BR>
 
<?php
 echo '<div class="shadow p-3 mb-5 bg-white rounded">';
     echo '<nav class="navbar navbar-light bg-light">';
      echo '<a class="navbar-brand" href="problemas.php?predio='.$PREDIO.'">';
       echo '<ion-icon src="./icon/md-business.svg"  size="large" class="btn btn-warning"  ></ion-icon>';
        echo '  '.$PREDIO;
         echo '</a>';
          echo '</nav>';
     echo '</div>';

?>
<input type="hidden" name="predio" id="prediotxt" value="<?php echo $PREDIO?>">
<table class="table table-hover">
  <thead>
    <tr class="table-info">
      <th scope="col" >Problemas</th>
      <th scope="col">Qtd</th>
      </tr>
  </thead>
  <?php

  foreach ($result as $res) {
    if($res['problema'] != ""){
            echo'<tbody>
            <tr>
              <td class="table-light" >'.$res['problema'].'</th>
              <td class="table-light">'.utf8_encode($res['qtd']).'</td>
              
            </tr>
             </tbody>';
    };

  };
  
  echo '</table>';
  echo '<br>';
  echo '<br>';
  echo '<br>';
?>









<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes dos Chamados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detalhes">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</BODY>