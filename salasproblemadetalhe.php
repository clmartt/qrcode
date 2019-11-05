
<?php
ob_start();
session_start(); //pega a sessao do usuario
$cliente = $_SESSION['cliente'];


// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = $_GET['usuario']; // guardando usuario logado na variavel
$predio = $_GET['predio'];

//conexao com banco de dadso

$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

// Conectando 
// se nao conectar informa o erro
try { 

  
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

if($_SESSION['cliente']=='KVM'){
// primeira forma	
$select = "SELECT * FROM  CHAMADOS WHERE predio = '$predio' and status = 'ANDAMENTO' group by andar "; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query

}else{

  // primeira forma	
$select = "SELECT * FROM  CHAMADOS WHERE predio= '$predio' and status = 'ANDAMENTO' group by andar"; // query de consulta ao banco
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


   <?php  include('home.php');?>
  


  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
 
    <?PHP 

    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
    
    echo "<div class='text-center font-weight-bold'>Salas com Problemas - ".$qtd."<div> ";
    echo "</br>";
   
    foreach ($result as $linha) {
     
      echo 'Andar  - '.$linha['andar'].'<br>';
     
      $pegapredio = $linha['predio'];
      $pegasala = $linha['sala'];
      $pegaandar = $linha['andar'];

     $select2 = "SELECT * FROM CHAMADOS WHERE predio = '$pegapredio' AND sala = '$pegasala' AND andar = '$pegaandar' and status = 'ANDAMENTO' "; 
     $result2 = $pdo->query($select2);

                foreach ($result2 as $linha2) {
                $date = new DateTime( $linha2['data_2'] );
                
                 echo '<div class="card">';
                 echo '<div class="card-header">';
                 echo 'Sala - '. $linha2['sala'];
                 echo '</div>';
                 echo '<div class="card-body">';
                 echo '<h5 class="card-title">'.$linha2['problema'].'</h5>';
                 echo '<p class="card-text">'.$linha2['observacao'].'</p>';
                 echo '<br>';
                 echo '<p class="card-text">'.$linha2['nome_user'].'</p>';
                 echo '</div>';
                 echo '<div class="card-footer text-muted">';
                 echo 'Aberto em : '.$date-> format( 'd-m-Y' );
                 echo '</div>';
                 echo '</div>';
                 echo '<br>';
                };

                echo '<br>';
                echo '<br>';
                echo '<br>';
        }
     

     ?>
    







    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
<?PHP 

include("menu.php");
?>

  </body>
</html>