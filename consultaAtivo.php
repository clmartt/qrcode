<?php 

//sessao
ob_start(); 
session_start();
header('Content-Type: text/html; charset=utf-8');

// variavel que recebe o codido qrcode
$andar = $_GET['andar'];
$predio = $_GET['predio'];





// caso o acesso nao seja feito pela sessao iniciada, redirecionar
/*if($_SESSION['email'] ==''){

    header("Location: http://kvminformatica.com.br/qrteste/principal.php");
};
*/


// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 



$mysqli = new mysqli($host, $user, $pass, $db);
       



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>KVM INFORMATICA - QR CODE</title>
   <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   

    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jq/jquery.autocomplete.js"></script>
<script type="text/javascript" src="jq/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="jq/jquery.autocomplete.pack.js"></script>



<script src="jquery-1.11.1.min.js"></script>
  <script src="jquery-ui.min.js"></script>
  <script src="jquery.select-to-autocomplete.js"></script>

 


<script>
    $(document).ready(function(){
        $('li').click(function(){
            $('.modal-body').html("<img src='./images/loading.gif'>"); 
           $.get('consultaAtivoSala.php',{nome_sala:$(this).text(),nome_predio:'CTO'}, function(data){
                                 
                     $('.modal-body').html(data);
                    
                });
        });

       var texto = ["pedro","maria","lucia"];
        $('#predio').autocomplete({
          source: texto

        });
        

    });

</script>


                   
     
    

</script>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    
    <div class="limiter">


        <div class="container-login100">

            <div class="wrap-login100">
              <div class='alert alert-info' role='alert'> Digite o Predio e o Andar </div>
                <form class="form-inline" action="consultaAtivo.php" method="get" autocomplete="off">
                  <label class="sr-only" for="inlineFormInputName2">Name</label>
                  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="DIGITE O PREDIO" name="predio" id="predio">

                    <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="DIGITE O ANDAR" name="andar" id="andar">
                  </div>

                  <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                </form>
                <hr><hr>

                <div class="table-responsive">

                   <?php if($mysqli){
                    

                        $sql = "SELECT QRCODE,PREDIO,SALA, NOME_ATIVO FROM QRCODETABLE where ANDAR like '%$andar%' AND PREDIO ='$predio' GROUP BY SALA";
                        $result = $mysqli->query($sql);

                                       

                        if ($result->num_rows > 0) {

                            // saida dos dados ESTA PARTE É MOSTRADA NA TELA


                            echo "<ul class='list-group'>";
                            while($row = $result->fetch_assoc()) {
                                                     
                                echo "<li class='btn btn-outline-secondary' data-toggle='modal' data-target='#exampleModal'>".$row['SALA']."</li>";
                                                                                        
                            };  echo "</ul>";
                                echo "

                                    <!-- Modal -->
                                    <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                      <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                          <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>Equipamentos</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                              <span aria-hidden='true'>&times;</span>
                                            </button>
                                          </div>
                                          <div class='modal-body'>
                                            
                                          </div>
                                          <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>";




                        } else {
                            
                           
                            echo "<br>";
                            echo "<script>$(document).ready(function(){
                                    $('#selecao').hide();
                                    $('#solucao').hide();
                                    $('#botao').hide();
                                    });</script> ";
                        }     
                            }
                        else {
                            echo "FALHA NA  CONEXOAO";
                              };
                                                       
                     
                        ?>

                        </div>
                    
                        
                        
                        
                    </div>
                
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>