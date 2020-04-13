<?php

include("conectar.php");

$predio = $_POST['predio'];
$andar = $_POST['andar'];
$sala = $_POST['sala'];
$setor = $_POST['setor'];

$sql = $pdo->query("SELECT * FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar' AND SALA = '$sala' AND SETOR = '$setor'");
$qtd = $sql->rowCount();



?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>ATIVOS</title>
  </head>
  <body>
    <?php
        echo '<a href="#" class="card-link"> Quantidade de Equipamentos : '.$qtd.'</a>';
        echo '<p></p>';
        foreach ($sql as $r) {
          $qrAtivo = $r['QRCODE'];
          $pegadata = $pdo->query("SELECT MAX(DATA_2) as mData FROM TABLE_CHECK WHERE QRCODE = '$qrAtivo'")->fetch();
            echo '<div class="card shadow p-3 mb-5 bg-white rounded ">';
            echo '  <div class="card-body">';
            echo '      <h5 class="card-title">'.$r['QRCODE'].'</h5>';
            echo '      <h6 class="card-subtitle mb-2 text-muted">'.$r['TIPO_DE_EQUIPAMENTO'].' | '.$r['MARCA'].'</h6>';
            echo '      <a href="#" class="card-link"> Ultimo Check : '.date("d-m-Y",strtotime($pegadata['mData'])).'</a>';
            echo '  </div>';
            echo '</div>';
            

        }
            
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>