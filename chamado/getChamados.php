<?php

include("../conectar.php");
$predio = $_GET['predios'];
$andar = $_GET['andares'];
$problema = $_GET['problemas'];


$getChamado = $pdo->query("SELECT * FROM CHAMADOS WHERE predio = '$predio' AND andar ='$andar' AND problema = '$problema' AND status = 'ANDAMENTO' ORDER BY id_chamado,andar");


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h5>Lista de Chamados</h5>

    <div class="container">
        <div class="table-responsive">
        <table class="table table-hover table-sm">
                <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Andar</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Problema</th>
                        <th scope="col">Tempo</th>
                      </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($getChamado as $r) {
                          $datahoje = date('Y-m-d'); // converte a data de hoje para o padrao ano - mes - dia
                          $dataChamado = $r['data_2']; // pega a data do chamado retornada do banco de dados
                          $data1 = date_create($datahoje); // converte em data
                          $data2 = date_create($dataChamado);// converte em data
                          $dif = date_diff($data2,$data1); // calcula a diferença entre as datas
                          $dias = $dif->format('%a'); // formata em numero o resultado da diferença
                          if($dias>=10){
                              echo' <tr id="linha">';
                              echo'<th scope="row"><a href="detalheChamado.php?idChamado='.$r['id_chamado'].'" class="btn btn-danger">'.$r['id_chamado'].'</a></th>';
                              echo'<td>'.$r['andar'].'</td>';
                              echo'<td>'.$r['sala'].'</td>';
                              echo'<td>'.$r['problema'].'</td>';
                              echo'<td>'.$dias.'</td>';
                              echo'</tr>';
                          }else{
                              echo' <tr>';
                              echo'<th scope="row"><a href="detalheChamado.php?idChamado='.$r['id_chamado'].'" class="btn btn-info">'.$r['id_chamado'].'</a></th>';
                              echo'<td>'.$r['andar'].'</td>';
                              echo'<td>'.$r['sala'].'</td>';
                              echo'<td>'.$r['problema'].'</td>';
                              echo'<td>'.$dias.'</td>';
                              echo'</tr>';
                          }
                        }
                        
                    ?>
                </tbody>
        </table>
        </div>





    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>