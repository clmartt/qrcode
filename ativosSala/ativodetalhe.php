

<?php

ob_start();

session_start();

$logado = $_GET['usuario'];

$qrcode = $_GET['qrcode'];


include('../conectar.php');


// PARA PREENCHER O SELECT DO HTML COM O PREDIO

$select = "SELECT * FROM QRCODETABLE where QRCODE = '$qrcode' ";

$result = $pdo->query($select);




// faz o select dos chamados



$selectcheck = "SELECT DATA_2 FROM TABLE_CHECK where QRCODE = '$qrcode' ";
$resultcheck = $pdo->query($selectcheck);


$selectchamado = "SELECT * FROM CHAMADOS where QRCODE = '$qrcode' ";

$resultchamado = $pdo->query($selectchamado);















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



    <title>DETALHES ATIVO</title>



	 <script src="jquery-3.2.1.min.js"></script>



   <script type="text/javascript">

  

              $(document).ready(function(){



                       

              });









</script>





  </head>

  <body>

  <nav class="navbar navbar-dark bg-dark">

  <a class="navbar-brand" href="../principal.php">

   

    Retornar

  </a>

 

  </nav>

 <p></p>

 <?php

 foreach ($result as $resultado) {

  echo '<div class="card">';

  echo '<div class="card-header">';

  echo 'Detalhes do Ativo';

  echo '</div>';

  echo '<div class="card-body">';

  echo '<h5>'.$resultado["QRCODE"].'</h5>';

  echo '<p class="card-text">PREDIO : '.$resultado["PREDIO"].' - '.'ANDAR : '.$resultado["ANDAR"].'  <br> SETOR : '.$resultado["SETOR"].' - SALA : '.$resultado["SALA"].'</p>';

   echo '<p class="card-text">'.$resultado["TIPO_DE_EQUIPAMENTO"].' - CARACTERISTICA : '.$resultado["CARACTERISTICA"].'<BR>HORAS LAMP : '.$resultado["HORAS_LAMP"].'<BR>MARCA : '.$resultado["MARCA"].' <br> MODELO : '.$resultado["MODELO"].'<BR>N_SERIE : '.$resultado["N_SERIE"].'</p>';

  echo '</div>';

  echo '</div>';

  





 }

  

?>

  <p></p>



  <?php

  $dataarray = array();

 foreach ($resultcheck as $rescheck) {

  array_push($dataarray,$rescheck['DATA_2']);

  

  





 };



 echo '<div class="card">';

  echo '<div class="card text-white bg-info mb-3" align="center">';

  echo 'Ultimo Check List : '.date("d/m/Y", strtotime(array_pop($dataarray)));

  echo '</div>';

  echo '</div>';

  echo '<p></p>';

  

?>





  <?php



 echo '<div class="card">';

  echo '<div class="card text-white bg-warning mb-3" align="center">';

  echo 'Lista de chamados: ';

  echo '</div>';

  echo '</div>';

  echo '<p></p>';





  echo '<table class="table table-sm">';

  echo '<thead>';

  echo '<tr>';

  echo '<th scope="col">Data</th>';

  echo '<th scope="col">Status</th>';

  echo '<th scope="col">Problema</th>';

  echo '<th scope="col">Descrição</th>';

  echo '</tr>';

  echo '</thead>';

 foreach ($resultchamado as $reschamado) {

  echo '<tbody>';

  echo '<tr>';

  echo '<th scope="row">'.date("d/m/Y",strtotime($reschamado['data_2'])).'</th>';

  echo '<td>'.$reschamado['status'].'</td>';

  echo '<td>'.$reschamado['problema'].'</td>';

  echo '<td>'.utf8_encode($reschamado['observacao']).'</td>';

  echo '</tr>';



  echo '</tbody>';

  





 }

  

?>



  </body>





</html>