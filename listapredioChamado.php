
<?php
ob_start();
session_start(); //pega a sessao do usuario
$permissao = $_SESSION['permissao'];
include("./conectar.php");


// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = $_GET['usuario']; // guardando usuario logado na variavel




if($_SESSION['permissao']=='KVM'){
  // primeira forma	
  $select = "SELECT predio, count(id_chamado) as qtd FROM  CHAMADOS WHERE status = 'ANDAMENTO' GROUP BY predio"; // query de consulta ao banco
  $result = $pdo->query($select); // guardando o resultado da query acima na variavel
  $qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query
  
  }else{
  
    // primeira forma	
  $select = "SELECT predio, count(id_chamado) as qtd FROM  CHAMADOS WHERE CLIENTE= '$permissao' AND status = 'ANDAMENTO' GROUP BY predio"; // query de consulta ao banco
  $result = $pdo->query($select); // guardando o resultado da query acima na variavel
  $qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query
  
  };



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

  <?php include("menu.php");?>
  
 <div class="container">
      <p></p>
      <div class="text-center">
        <h6>Chamados em Andamento</h6>
      </div>
      <hr>

      <div class="table-responsive">
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Prédio</th>
              <th scope="col">Qtd</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result as $linha) {
             echo' <tr>';
             echo'<th scope="row"> <a href="./chamado/listaChamado.php?predio='.$linha['predio'].'">'.$linha['predio'].'</a></th>';
             echo'<td>'.$linha['qtd'].'</td>';
             echo'</tr>';
            }
             
            ?>
          </tbody>
    </table>


      </div>
      
 </div>
 
   


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

    <?php include('Jmodal.php');?>
  </body>
</html>