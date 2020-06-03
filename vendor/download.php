
<?php
ob_start();
session_start();
$cliente = $_SESSION['cliente'];

if($cliente==""){
  header("Location: ./login.html");

};


$logado = $_GET['usuario'];


$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$mysqli = new mysqli($host, $user, $pass, $db);
$sql = "SELECT * FROM QRCODETABLE GROUP BY PREDIO ";
$result = $mysqli->query($sql);
$mysqli -> set_charset("utf8");

if($_SESSION['cliente']=='KVM' ){
  $sql = "SELECT * FROM QRCODETABLE GROUP BY PREDIO ";
  $result = $mysqli->query($sql);

}else{
  $sql = "SELECT * FROM QRCODETABLE WHERE CLIENTE = '$cliente' GROUP BY PREDIO ";
  $result = $mysqli->query($sql);

};


include('menu.php')

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
          alert(predio);
          $("#aguarde").append("Aguarde.... :)");
          
          if(predio == 'todos'){
            window.location.href = "downtodos.php?dataI="+Rdatai+"&dataF="+Rdataf+"&arquivo="+arquivo+"&predio="+predio;
            $("#aguarde").hide();
          }else{
            window.location.href = "downcheckperiodo.php?dataI="+Rdatai+"&dataF="+Rdataf+"&arquivo="+arquivo+"&predio="+predio;
            $("#aguarde").hide();
          };

                
           

         
          


        });




        $('#consultarpdf').click(function(){
          var datai = $("#datainicio").val();
          var dataSplit1 = datai.split('-');
          var Rdatai = dataSplit1[2]+"/"+dataSplit1[1]+"/"+dataSplit1[0];
           

          var dataf = $("#datafim").val();
          var dataSplit2 = dataf.split('-');
          var Rdataf = dataSplit2[2]+"/"+dataSplit2[1]+"/"+dataSplit2[0];
          

          var arquivo = $('#arquivos').val();
          
          var predio = $("#predio").val();
          $("#aguarde").append("Aguarde.... :)");
          
          if(predio == 'todos'){
            window.location.href = "./gerarpdf/downtodospdf.php?dataI="+Rdatai+"&dataF="+Rdataf+"&arquivo="+arquivo+"&predio="+predio;
           
          }else{
            window.location.href = "./gerarpdf/downcheckperiodopdf.php?dataI="+Rdatai+"&dataF="+Rdataf+"&arquivo="+arquivo+"&predio="+predio;
          };
    


        });


     });


   </script>



  </head>
  <body>
 
<br>





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
                  <option value="preventiva">PREVENTIVA</option>
                  <option value="manutencao">MANUTENÇÃO</option>
                </select>

                 &nbspPredio  :&nbsp &nbsp<select class="form-control" name="PREDIO" id="predio">
                    <?PHP 
                        foreach ($result as $res) {
                          
                         echo "<option value='".$res['PREDIO']."'>".$res['PREDIO']."</option>";
                         };
      
                     ?> 
                     <option value="todos">TODOS</option>   
                  </select>
                <P></P>
                          
               
    </form>
    <p></p>
    
    
  </div>
   <div class="card-footer text-center">
    <div class="text-center"><button type="button" class="btn btn-outline-success" id="consultar" style="margin: 0 20px">XLS</button> <button type="button" class="btn btn-outline-warning" id="consultarpdf">PDF</button></div>
    </div>
    <div id="aguarde" class="text-center"></div>
  
</div>

 

   
   

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>





   
<?php include('Jmodal.php');?>
  </body>


</html>