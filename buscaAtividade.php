<?php

include("./conectar.php");

$atividade =  $_POST['atividade'];
$cliente = strtoupper($_POST['clientes']);
$situacao = strtoupper($_POST['situacao']);
$usuario = strtoupper($_POST['usuarios']);
$datahoje = date('Y-m-d');

if($atividade == 'Minhas'){

    $sql = $pdo->query("SELECT * FROM AGENDAMENTO WHERE RECURSO = '$usuario' AND SITUACAO = '$situacao' and DATA_AGEN = '$datahoje' and CLIENTE = '$cliente'");


}else{

    $sql = $pdo->query("SELECT * FROM AGENDAMENTO WHERE SITUACAO = '$situacao' and DATA_AGEN = '$datahoje' and CLIENTE = '$cliente'");


}





?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Busca Atividade</title>

    
    <script>
            

    </script>

  </head>
  <body>
    
  <?php 
        foreach ($sql as $res) {
            if($res['SITUACAO']=='ABERTO'){
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo $res['TITULO'];
                echo '   </div>';
                echo '   <div class="card-body">';
                echo '       <h5 class="card-title">'.$res['RESPONSAVEL'].'</h5>';
                echo '       <p class="card-text">'.$res['DESCRICAO'].'</p>';
                echo '       <p class="card-text">'.$res['RECURSO'].'</p>';
                echo '       <div class="text-center"><button class="btn btn-danger" id="status" value="'.$res['ID_AGEN'].'">'.$res['SITUACAO'].'</button></div>';
                echo '   </div>';
                echo '</div>';
                echo '<br>';

            }
            if($res['SITUACAO']=='ANDAMENTO'){
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo $res['TITULO'];
                echo '   </div>';
                echo '   <div class="card-body">';
                echo '       <h5 class="card-title">'.$res['RESPONSAVEL'].'</h5>';
                echo '       <p class="card-text">'.$res['DESCRICAO'].'</p>';
                echo '       <p class="card-text">'.$res['RECURSO'].'</p>';
                echo '       <div class="text-center"><button  class="btn btn-warning" id="status" value="'.$res['ID_AGEN'].'">'.$res['SITUACAO'].'</button> </div>';
                echo '   </div>';
                echo '</div>';
                echo '<br>';

            }
            if($res['SITUACAO']=='FINALIZADO'){
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo $res['TITULO'];
                echo '   </div>';
                echo '   <div class="card-body">';
                echo '       <h5 class="card-title">'.$res['RESPONSAVEL'].'</h5>';
                echo '       <p class="card-text">'.$res['DESCRICAO'].'</p>';
                echo '       <p class="card-text">'.$res['RECURSO'].'</p>';
                echo '       <div class="text-center"><button class="btn btn-success" id="status" value="'.$res['ID_AGEN'].'">'.$res['SITUACAO'].'</button></div>';
                echo '   </div>';
                echo '</div>';
                echo '<br>';

            }
           
        }
        

?>

<br>
<br>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>