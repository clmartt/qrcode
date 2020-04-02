<?php

include('../conectar.php');
//$idPost = $_POST['idPost'];

$idPost = $_POST['idPost'];
$sql = $pdo->query("SELECT * FROM POST_RESPOSTA WHERE ID_POST = $idPost");


/*



*/
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
   
<?php
    foreach ($sql as $r) {
        echo' <div class="card shadow p-3 mb-5 bg-white rounded">';
        echo'<div class="card-body ">';
        echo'<h6 class="card-subtitle mb-2 text-muted">'.$r['USER_RESP'].'</h6>';
        echo'<p class="card-text">'.$r['RESPOSTA'].'</p>';
        echo'<p class="card-text">'.$r['DATA_RESP'].' - '.$r['HORA_RESP'].'</p>';
       
        echo'</div>';
        echo'</div>';
        
    }

           


?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>