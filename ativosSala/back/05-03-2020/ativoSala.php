
<?php
ob_start();
session_start();
$cliente = $_SESSION['cliente'];





header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = $_GET['usuario'];

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

if($cliente == 'KVM'){
// PARA PREENCHER O SELECT DO HTML COM O PREDIO
$select = "SELECT * FROM QRCODETABLE GROUP BY PREDIO";
$result = $pdo->query($select);
$qtd = $result-> rowCount();

}else{
// PARA PREENCHER O SELECT DO HTML COM O PREDIO
$select = "SELECT * FROM QRCODETABLE WHERE CLIENTE = '$cliente' GROUP BY PREDIO";
$result = $pdo->query($select);
$qtd = $result-> rowCount();
}

/*
// PARA PREENCHER O SELECT DO HTML COM O PREDIO
$select = "SELECT * FROM QRCODETABLE GROUP BY PREDIO";
$result = $pdo->query($select);
$qtd = $result-> rowCount();
*/

// PARA RECEBER OS CAMPOS DO FORMULARIO ABAI


  $predio = $_GET['predio'];
  $andar = $_GET['andar'];
  





// FAZ O SELECT APOS O ENVIO PARA CONSULTAR A SALA
$select2 = "SELECT * FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar' ORDER BY SALA";

$result2 = $pdo->query($select2);





?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

      <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>EQUIPAMENTOS POR SALA</title>

	 <script src="jquery-3.2.1.min.js"></script>

   <script type="text/javascript">

   $(document).ready(function(){
    $("#txtBusca").keyup(function(){
              var texto = $(this).val();
              var textm = texto.toString();
              
              
              
              $("#txtBusca").keyup(function(){
              var texto = $(this).val();
              var textm = texto.toString();
              
              
              
              $("tr").css("display", "block");
              $("tr").each(function(){
                if($(this).text().indexOf(textm.toUpperCase()) < 0){
                    
                     
                     $(this).hide();
                     
                  };
              });
          });

   });
  
    </script>


  </head>
  <body>


<nav class="navbar   navbar-dark bg-dark">
  <a class="navbar-brand" href="../principal.php">
   
    Retornar
  </a>
 
</nav>
 <p></p>



   
  <div class="card">
  <div class="container">

  
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
  <div class="form-group">
    <label class="form-check-label" for="exampleCheck1">Escolha o Prédio</label>
    <select class="form-control" name="predio">
      <?PHP 
      foreach ($result as $res) {
        echo "<option value=".$res['PREDIO'].">".$res['PREDIO']."</option>";
      };
      
     ?>    
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Informe Andar</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Andar" name="andar">
  </div>
  <div align="center">
  <button type="submit" class="btn btn-info">Submit</button>
  <p></p>
  </div>
</form>


  </div>
 </div>
<br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><ion-icon src="./icon/md-search.svg"  size="small" ></ion-icon></span>
  </div>
  <input type="text" class="form-control" placeholder="Digite a sala" aria-label="Usuário" aria-describedby="basic-addon1" id="txtBusca" >
</div>
 
<?PHP
echo '<br>';
  echo '<b>Predio</b> : '.$predio. ' - <b>Andar</b> : '.$andar.'<br>';
  echo '<br>';
  echo '<div class="table-responsive">';
  echo '<table class="table table-sm">';
  echo '<thead>';
  echo '<tr>';
  echo '<th scope="col">Qrcode</th>';
  echo '<th scope="col">Ativo</th>';
  echo '<th scope="col">Sala</th>';
  echo '<th scope="col">Setor</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  foreach($result2 as $res){
    echo '<tbody>'; 
    echo '<tr>';
    echo '<th scope="row" >'.$res['QRCODE'].'</th>';
    echo '<td>'.utf8_encode($res['TIPO_DE_EQUIPAMENTO']).'</td>';
    echo '<td>'.utf8_encode($res['SALA']).'</td>';
    echo '<td>'.utf8_encode($res['SETOR']).'</td>';
    echo '</tr>';
    echo '</tbody>';
      
   
   
    
}


   echo '</table>';
   echo '</div>';
   echo "<br>";
   echo "<br>";
   echo "<br>";

  ?>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>







  </body>


</html>