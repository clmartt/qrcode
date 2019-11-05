
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

// PARA RECEBER OS CAMPOS DO FORMULARIO ABAIXO
$predio = $_POST['PREDIO'];
$andar = $_POST['ANDAR'];



// FAZ O SELECT APOS O ENVIO PARA CONSULTAR A SALA
$select2 = "SELECT * FROM QRCODETABLE WHERE PREDIO LIKE '$predio%' AND ANDAR = '$andar' GROUP BY SALA";

$result2 = $pdo->query($select2);





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

    <title>EQUIPAMENTOS POR SALA</title>

	 <script src="jquery-3.2.1.min.js"></script>

   <script type="text/javascript">
  
              $(document).ready(function(){

                        $('ol').click(function(){
                         var sala = $(this).text();
                         
                         
                         
                           $.post('consultarAtivo.php',{nsala:sala},function(data) {
                                 
                              });
                                                 
                            alert(salas);
                        });




              });




</script>


  </head>
  <body>
<nav class="navbar   navbar-dark bg-dark">
  <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/principal.php">
   
    Retornar
  </a>
 
</nav>
 <p></p>



   
  <div class="card">
  <div class="container">

  
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="form-group">
    <label class="form-check-label" for="exampleCheck1">Escolha o Prédio</label>
    <select class="form-control" name="PREDIO">
      <?PHP 
      foreach ($result as $res) {
        echo "<option value=".$res['PREDIO'].">".$res['PREDIO']."</option>";
      };
      
     ?>    
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Informe Andar</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Andar" name="ANDAR">
  </div>
  <div align="center">
  <button type="submit" class="btn btn-info">Submit</button>
  <p></p>
  </div>
</form>


  </div>
 </div>



<?PHP
  foreach($result2 as $res2){

 echo "<br>";     
 echo '<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><b>'.$res2['PREDIO'].' '.$res2['ANDAR'].' '.$res2['SETOR'].' '.utf8_encode($res2['SALA']).'</b></li>
  </ol>
</nav>';
$tempsala = $res2['SALA']; // PEGANDO O NOME DA SALA
$tempandar = $res2['ANDAR']; // PEGANDO O ANDAR
$tempredio = $res2['PREDIO'];// PEGANDO O NOME DO PREDIO
//PEGA OS ATIVOS QUE ESTÃO NA SALA AND ANDAR AND PREDIO 
$select3 = "SELECT * FROM QRCODETABLE WHERE SALA = '$tempsala' AND ANDAR = '$tempandar' AND PREDIO = '$tempredio'";

$result3 = $pdo->query($select3);

              foreach($result3 as $res3){
                echo '<br>';

                echo '<div class="shadow p-3 mb-5 bg-white rounded">'.trim("<a href=ativodetalhe.php?qrcode=".$res3['QRCODE'].">").$res3['QRCODE']."</a>".' - '.utf8_encode($res3['TIPO_DE_EQUIPAMENTO']).' - '.utf8_encode($res3['CARACTERISTICA']).'</div>';
               
                //echo "    - ".trim("<a href=ativodetalhe.php?qrcode=".$res3['QRCODE'].">").$res3['QRCODE']."</a>".' - '.$res3['TIPO_DE_EQUIPAMENTO'].' - '.utf8_encode($res3['CARACTERISTICA']).'<br> ';

              };
              echo '<hr>';
  };

  ?>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>







  </body>


</html>