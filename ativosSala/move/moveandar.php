<?php
ob_start();
session_start();
$email = $_SESSION['email'];
$permissao = $_SESSION['permissao'];
$qrcode = $_GET['qrcode'];

$predio = $_GET['predio'];

if(!isset($_SESSION['email'])){
    header("Location: ../../login.html");

};

include("../../conectar.php");

$pegaandar = $pdo->query("SELECT ANDAR FROM QRCODETABLE WHERE PREDIO = '$predio' GROUP BY  ANDAR");

    ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>

  	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ATIVIDADES DE HOJE </title>

	<script src="jquery-3.2.1.min.js"></script>
    <script>
    	
    	
    	$(document).ready(function(){


    		//espaço reservado para biblioteca jquery caso seja necessário o uso

    	});

    </script>

      <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

  </head>
  <body>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" onclick="history.go(-1)" href="#">
      Retornar 
    </a>
  </nav>
  


  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
 
    <?PHP 

  
    
    echo "<div class='text-center font-weight-bold'>Escolhar o Andar de Destino<div> ";
    echo "</br>";

    foreach ($pegaandar as $linha) {
   
    echo '<div class="shadow p-3 mb-5 bg-white rounded">';
     echo '<nav class="navbar navbar-light bg-light">';
      echo '<a class="navbar-brand" href="./movesala.php?andar='.$linha['ANDAR'].'&qrcode='.$qrcode.'&predio='.$predio.'">';
       echo '<ion-icon src="../../icon/md-arrow-forward.svg"  size="small" class=btn btn-light"  ></ion-icon>';
        echo '  '.$linha['ANDAR'];
         echo '</a>';
          echo '</nav>';
     echo '</div>';


     ?>
    


<?php
};

echo '<br>';
echo '<br>';
?>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

    <?php include('Jmodal.php');?>
  </body>
</html>