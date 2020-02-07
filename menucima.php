
<?php 

ob_start();
session_start();

$clientes = $_SESSION['cliente'];
include('conectar.php');


if($_SESSION['cliente']=='KVM'){
  // primeira forma	
  $select = "SELECT * FROM  QRCODETABLE GROUP BY PREDIO"; // query de consulta ao banco
  $resultp = $pdo->query($select); // guardando o resultado da query acima na variavel
  $qtd = $resultp-> rowCount(); // contanto o numero de linhas retornadas pela query
  
  }else{
  
    // primeira forma	
  $select = "SELECT * FROM  QRCODETABLE WHERE CLIENTE= '$cliente' GROUP BY PREDIO"; // query de consulta ao banco
  $resultP = $pdo->query($select); // guardando o resultado da query acima na variavel
  $qtd = $resultp-> rowCount(); // contanto o numero de linhas retornadas pela query
  
  };

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ReQuest - KVM Informática</title>
  </head>
  <body>
   

  <nav class="navbar sticky-top navbar-light bg-light">
            <a class="navbar-brand" href="principal.php">
              <img src="./images/logo.gif" width="30" height="30" class="d-inline-block align-top" alt="">
              ReQuest - Dash <?php echo ' '.$PREDIO?>
            </a>

            <form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <div class="input-group">
            <select class="custom-select" id="inputGroupSelect04" name="predio">
              <option selected>Escolha o Prédio</option>
              <?php
              foreach ($resultp as $resp) {
                      
              echo'<option value="'.$resp['PREDIO'].'">'.$resp['PREDIO'].'</option>';
            
              
              };
              ?>
            </select>
            <div class="input-group-append">
            <input class="btn btn-info" type="submit" value="Submit">
            </div>
          </div>

              </form>
          </nav>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
