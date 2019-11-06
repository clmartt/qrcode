
<?php
ob_start();
session_start();

header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = $_GET['usuario'];


$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$mysqli = new mysqli($host, $user, $pass, $db);
$sql = "SELECT * FROM QRCODETABLE GROUP BY PREDIO ";
$result = $mysqli->query($sql);





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

    <title>DOWNLOADS</title>

	 
   <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  
   <script type="text/javascript">


     $(document).ready(function(){

        $('#consultar').click(function(){
          var datai = $("#datainicio").val();
          var dataSplit1 = datai.split('-');
          var Rdatai = dataSplit1[2]+"/"+dataSplit1[1]+"/"+dataSplit1[0];
           

          var dataf = $("#datafim").val();
          var dataSplit2 = dataf.split('-');
          var Rdataf = dataSplit2[2]+"/"+dataSplit2[1]+"/"+dataSplit2[0];
          

          var arquivo = $('#arquivos').val();
          
          var predio = $("#predio").val();
          

         
            window.location.href = "https://kvm1000.websiteseguro.com/qrteste2/downcheckperiodo.php?dataI="+Rdatai+"&dataF="+Rdataf+"&arquivo="+arquivo+"&predio="+predio;

         
          


        });

     });


   </script>



  </head>
  <body>
<nav class="navbar fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="./principal.php">
   
    Retornar
  </a>
 
</nav>
 <p></p>


<div class="card">
  <div class="card-header">
    DOWNLOADS
  </div>
  <div class="card-body" align="center">
    <form class="form-inline">

                Data Inicio :&nbsp &nbsp<input type="date" class="form-control mb-2 mr-sm-2" id="datainicio">
                Data Fim :&nbsp &nbsp <input type="date" class="form-control mb-2 mr-sm-2" id="datafim">
                Arquivo  :&nbsp &nbsp<select class="form-control" id="arquivos">
                  <option value="check">CHECK LIST</option>
                  <option value="chamados">CHAMADOS</option>
                  <option value="ativos">ATIVOS</option>
                </select>

                 &nbspPredio  :&nbsp &nbsp<select class="form-control" name="PREDIO" id="predio">
                    <?PHP 
                        foreach ($result as $res) {
                         echo "<option value=".$res['PREDIO'].">".$res['PREDIO']."</option>";
                         };
      
                     ?>    
                  </select>
                <P></P>
                          
               
    </form>
    <p></p>
    
    
  </div>
   <div class="card-footer text-muted" align="center">
    <div align="center"><button type="button" class="btn btn-primary mb-2" id="consultar">BAIXAR</button></div>
  </div>
</div>

 

   
   

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>







  </body>


</html>