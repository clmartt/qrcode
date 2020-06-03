<?php
ob_start();
session_start();
$email = $_SESSION['email'];
$permissao = $_SESSION['permissao'];

if(!isset($_SESSION['email'])){
    header("Location: ../../login.html");

};
include("../../conectar.php");

$qrcode = $_GET['qrcode'];
$Ppredio = $_GET['predio'];
$Pandar = $_GET['andar'];
$Psala = $_GET['sala'];
$Psetor = $_GET['setor'];
$Pqrsala = $_GET['qrsala'];

$dadosAtivo = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcode'");

?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Confirmação do Pedido de MOVE</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
            var permissao = '<?php echo $permissao ?>';
         
            $("#home").hide();
            $('#atualizar').click(function(){
            var qrcodes = '<?php echo $qrcode ?>';
            var predios = '<?php echo $Ppredio ?>';
            var andars = '<?php echo $Pandar ?>';
            var salas = '<?php echo $Psala ?>';
            var setors = '<?php echo $Psetor ?>';
            var qrsalas = '<?php echo $Pqrsala?>';
            var user = '<?php echo $email?>';
            var motivos = prompt("Qual o motivo da movimentação?");
            var client

            $.post('atualiza.php',{predio:predios,andar:andars,sala:salas,setor:setors,qrsala:qrsalas,qrcode:qrcodes,motivo:motivos,usuario:user,permissao:permissao},function(data){
                
                $("#atualizar").text("Feito!");
                $("#atualizar").addClass("btn btn-success");
                $("#atualizar").off();
                $("#feito").hide();
                $("#divde").fadeOut();
                $("#divpara").empty();
                $("#divpara").append("ATUAL");
                $("#home").fadeIn();
                


            });
            
            });
           

        });




    </script>
  </head>
  <body>
  
  <br>
    <div class='container'><h5>Confirme sua solicitação</h5></div>
    <br>
<div class='container' >
                <div class="row" >
            <div class="col-sm-6" id="divde">
                <div class="card">
                <div class="card-header text-white bg-secondary">
                DE
            </div>
                <div class="card-body">
                    <?php
                            foreach ($dadosAtivo as $de) {
                                echo '<h5>'.$de['QRCODE'].'</h5>';
                                echo '<p class="card-text">Predio : '.$de['PREDIO'].'</p>';
                                echo '<p class="card-text">Andar : '.$de['ANDAR'].'</p>';
                                echo '<p class="card-text">Sala : '.$de['SALA'].'</p>';
                                echo '<p class="card-text">Setor : '.$de['SETOR'].'</p>';
                                echo '<p class="card-text">Qrsala : '.$de['QRSALA'].'</p>';
                            }
                    ?>
                    
                    
                </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card">
                <div class="text-white bg-info card-header" id="divpara">
                PARA
            </div>
                <div class="card-body">
                    <h5><?php echo $qrcode ?></h5>
                    <p class="card-text"><?php echo "Predio : ".$Ppredio?></p>
                    <p class="card-text"><?php echo "Andar : ".$Pandar?></p>
                    <p class="card-text"><?php echo "Sala : ".$Psala?></p>
                    <p class="card-text"><?php echo "Setor : ".$Psetor?></p>
                    <p class="card-text"><?php echo "Qrsala : ".$Pqrsala?></p>
                    
                </div>
                </div>
            </div>
            </div>
            <br>
            <div class="text-center" id="feito"><button type="button" class="btn btn-primary" id="atualizar">Atualizar</button></div>
            <div class="text-center" id="home"><a href="../../principal.php" class="btn btn-primary">Home</a></div>
</div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>