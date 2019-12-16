
<?php
ob_start();
session_start(); //pega a sessao do usuario


header('Content-Type: text/html; charset=utf-8');

ini_set('default_charset','UTF-8');

$predio = $_GET['predio'];
// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
header("Refresh: 60");

$logado = $_GET['usuario']; // guardando usuario logado na variavel

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

$datahoje = date("Y-m-d");

// primeira forma	
$select = "SELECT ANDAR FROM TABLE_CHECK WHERE PREDIO = '$predio' AND DATA_2 = '$datahoje' and CLIENTE != 'EVENTOS' GROUP BY ANDAR"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
//$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query




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

      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

  </head>
  <body>

  <?PHP 

    include("menu.php");
    ?>

     
 
 
    <?PHP 

    echo "</br>";
   
    
    echo '<h5>'.'<ion-icon src="./icon/md-business.svg"  size="large" class="btn btn-dark"  ></ion-icon>'.' '.$predio.' - '.date('d-m-Y').'</h5>'.'<br>';
    echo '<hr>';

    foreach ($result as $andar) {
      $pegaandar = $andar['ANDAR'];


      $select2 = "SELECT SALA,COUNT(QRCODE) AS QTD,HORAS,OCUPADA,IDTABLE_CHECK,NOME_USER FROM TABLE_CHECK WHERE PREDIO = '$predio' AND DATA_2 = '$datahoje' AND ANDAR = '$pegaandar' GROUP BY SALA ORDER BY IDTABLE_CHECK DESC"; // query de consulta ao banco
      $result2 = $pdo->query($select2); 

      echo '<div class="shadow p-3 mb-5 bg-white rounded border border-info"><H5>'.$pegaandar.'º Andar'.'</H5></div>';
      foreach ($result2 as $linha) {
        # code...
     

      if($linha['OCUPADA']=='SIM'){
            echo '<div class="shadow-sm p-3 mb-5 bg-white rounded">';
            echo '<ion-icon src="./icon/md-time.svg"  size="small" class="text-primary"></ion-icon> : '.$linha['HORAS'].'<BR>';
            echo '<h5> <ion-icon src="./icon/ios-alert.svg"  size="small" class="text-warning"></ion-icon> '.utf8_encode($linha['SALA'].'</H5>');
            echo '<br>';
            echo '<h5> <ion-icon src="./icon/md-contacts.svg"  size="small" class="btn btn-warning"></ion-icon> '.'Ocupada</H5>';
            echo '<br>';
      
            echo $linha['NOME_USER'];
             echo '</div>';

      }else{
            echo '<div class="shadow-sm p-3 mb-5 bg-white rounded">';
            echo '<ion-icon src="./icon/md-time.svg"  size="small" class="text-primary"></ion-icon> : '.$linha['HORAS'].'<BR>';
            echo '<h5> <ion-icon src="./icon/md-checkmark-circle.svg"  size="small" class="text-success"></ion-icon> '.utf8_encode($linha['SALA'].'</H5>');
            echo '<br>';
           
      
            echo $linha['NOME_USER'];
             echo '</div>';

            }
      };
   
      


     ?>
    


<?php
};
?>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

  </body>
</html>