

<?php

ob_start();

session_start();

$logado = $_GET['usuario'];

$qrcode = $_GET['qrcode'];







header('Content-Type: text/html; charset=utf-8');

ini_set('default_charset','UTF-8');







$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 

$usuario = 'qrcodekvm'; 

$senha = 'qrcodekvm';  



// Conectando 

try { 

$pdo = new PDO($dsn, $usuario, $senha); 

} catch (PDOException $e) { 

echo $e->getMessage(); 

exit(1); 

} 



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



  	

    

    <!-- Meta tags Obrigatórias -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>



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

  echo '<h5>'.$resultado["QRCODE"].' - <ion-icon src="../icon/md-create.svg"  size="small" ></ion-icon></h5> ';

  echo '<p class="card-text">PREDIO : '.$resultado["PREDIO"].' - '.'ANDAR : '.$resultado["ANDAR"].'  <br> SETOR : '.utf8_encode($resultado["SETOR"]).' - SALA : '.utf8_encode($resultado["SALA"]).'</p>';

   echo '<p class="card-text">'.utf8_encode($resultado["TIPO_DE_EQUIPAMENTO"]).' - CARACTERISTICA : '.$resultado["CARACTERISTICA"].'<BR>HORAS LAMP : '.$resultado["HORAS_LAMP"].'<BR>MARCA : '.utf8_encode($resultado["MARCA"]).' <br> MODELO : '.$resultado["MODELO"].'<BR>N_SERIE : '.$resultado["N_SERIE"].'</p>';

  echo '</div>';

  echo '</div>';

  echo '<hr>';

  echo '<div class="text-center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Abrir Chamado</button></div>';

  





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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  </body>





</html>