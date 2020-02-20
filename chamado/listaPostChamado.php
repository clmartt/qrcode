<?php

include("../conectar.php");
$id_chamado = $_POST['idchamado'];

$selecao = "SELECT * FROM POST_CHAMADOS WHERE ID_CHAMADO = '$id_chamado' ORDER BY DATA_POST,HORA_POST";
$resultado = $pdo->query($selecao);



?>



<!doctype html>
<html >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Lista Post Chamados</title>
  </head>
  <body>
    
    <div class="container">
        <?php 

            foreach ($resultado as $res) {
                $horabanco = explode('.',$res['HORA_POST']);
                          
                   echo '<div class="card">';
                   echo '<div class="card-header">';
                   echo date('d-m-Y',strtotime($res['DATA_POST'])).' - '.$horabanco[0];
                   echo '</div>';
                   echo '<div class="card-body">';
                   echo '<h5 class="card-title">'.$res['TITULO'].'</h5>';
                   echo '<p class="card-text">'.$res['DESCRICAO'].'</p>';
                   echo '<span class="text-primary center">'.$res['USUARIO'].'</span>';
                   echo '</div>';
                   echo '</div>';

            };

            echo '<p></p>';

        ?>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>