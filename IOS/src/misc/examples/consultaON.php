<?php 

//sessao
ob_start(); 
session_start();
header('Content-Type: text/html; charset=utf-8');

// variavel que recebe o codido qrcode
$qrcode = $_GET['qrcode'];
$user = $_GET['user'];
if ($_SESSION['email']== '' || $user == ''){
    header("Location: ../../qr.html");
}; 

//$_SESSION['email'] = $user;

echo "Usuario:--".$user; 

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

<script>

    $(document).ready(function(){
//====================================================================================>>>>>>>>>
        $('#ap_chamado').hide();
//====================================================================================>>>>>>>>>
        $('#editar').click(function(){
          $('#form_envia').attr('action','https://kvm1000.websiteseguro.com/qrteste/updateativo/formUp.php');
          $('#botao').trigger('click');
        });
//====================================================================================>>>>>>>>>      
            
        $('#atualizar').click(function(){
            var nova_hora = prompt('Digite as horas de lampada:');
            var idqrcode = $('#R_qrcode').val();
            alert("As horas serão atualizadas, Só um minutinho!!!!");
            
            $.post('updatehoras.php', 
                { vhora_nova: nova_hora, vn_qrcode:idqrcode},
                function(data) {
                    window.location.reload();
                });
                

            
        });





//========================================================================================>>>>>>>>>>>>>>>>>>>>>>>>>>            
            $('#exampleFormControlSelect1').change(function(){
                
                if($(this).val()==='PROBLEMA'){
                     $('#ap_chamado').fadeIn('slow');
                     alert(QRCODE);
                }else{
                     $('#ap_chamado').fadeOut('slow');
                };

             });
//====================================================================================>>>>>>>>>
            $('#chamado').click(function(){

                var R_usuario = $('#R_usuario').val();
                var R_qrcode = $('#R_qrcode').val();
                var R_ativo = $('#R_ativo').val();
                var R_modelo = $('#R_modelo').val();
                var R_marca = $('#R_marca').val();
                var R_predio = $('#R_predio').val();
                var R_andar = $('#R_andar').val();
                var R_sala = $('#R_sala').val();
                var R_serie = $('#R_serie').val();
                var R_horaLamp = $('#R_horaLamp').val();
                var situacao = $('#exampleFormControlSelect1').val();
                var status = $('#exampleFormControlSelect2').val();
                var info = $('#exampleFormControlTextarea5').val();
                var os_banco = prompt('Digite a OS_BANCO se existir!!!');

                

                $.post('insertchamado.php', 
                { R_usuario: R_usuario, R_qrcode: R_qrcode, R_ativo: R_ativo, R_modelo: R_modelo,R_marca:R_marca,R_predio:R_predio,R_andar:R_andar,R_sala:R_sala,R_serie:R_serie,R_horaLamp:R_horaLamp,situacao:situacao,status:status,info:info,os_banco:os_banco},
                function(data) {
                    
                });
                   $('#ap_chamado').fadeOut('slow');
                    alert('Chamado aberto!!!');

                    

            });

            

        
    });

//====================================================================================>>>>>>>>></script>

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">

            <div class="wrap-login100">
                
                

                <div class="table-responsive">

                   <?php if($mysqli){

                        $sql = "SELECT * FROM QRCODETABLE where QRCODE = '$qrcode'";
                        $result = $mysqli->query($sql);

                                       

                        if ($result->num_rows > 0) {

                            // saida dos dados ESTA PARTE É MOSTRADA NA TELA
                            while($row = $result->fetch_assoc()) {
                                echo "<button type='button' id='editar'class='btn btn-secondary btn-lg btn-block'>Editar</button><hr>";
                                echo "<b>QRCODE</b> : ".$row['QRCODE']."<BR>";
                                echo '<hr>';
                                echo "<b>NOME_ATIVO</b> : ".$row['NOME_ATIVO']."<BR>"; 
                                echo '<hr>';
                                echo "<b>N_SERIE </b>: ".$row['SERIE']."<BR>";
                                echo '<hr>';
                                echo "<b>HORAS_LAMP </b>: ".$row['HORAS_LAMP']." - - > <img src='./images/atualizar.png' id='atualizar' width='30' heigth='30'><BR>";
                                echo '<hr>';
                                echo "<b>MODELO </b>: ".$row['MODELO']."<BR>";
                                echo '<hr>';
                                echo "<b>MARCA </b>: ".$row['MARCA']."<BR>";
                                echo '<hr>';
                                echo "<b>PREDIO </b>: ".$row['PREDIO']."<BR>";
                                echo '<hr>';
                                echo "<b>ANDAR </b>: ".$row['ANDAR']."<BR>";
                                echo '<hr>';
                                echo "<b>SALA </b>: ".$row['SALA']."<BR>";
                                echo '<hr>';
                                
                                
                                $R_qrcode = $row['QRCODE'];
                                $R_ativo = strval($row['NOME_ATIVO']);
                                $R_modelo = $row['MODELO'];
                                $R_marca = $row['MARCA'];
                                $R_predio = $row['PREDIO'];
                                $R_sala = $row['SALA'];
                                $R_andar = $row['ANDAR'];
                                $R_serie = $row['SERIE'];
                                $R_horasLamp = $row['HORAS_LAMP'];



                              
                            }
                        } else {
                            echo "<div class='alert alert-warning' role='alert'>
                                Não encontramos esse QRCODE em nossos Registros </div>";
                            echo "<a href='http://kvminformatica.com.br/qrteste/insertativo/formInsert.php'><button type='button' class='btn btn-primary btn-lg btn-block'>Inserir um novo Ativo</button></a>";
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

                        <form action="insertcheck.php" method="POST" id="form_envia">
                           
                          
                            <input type="hidden" id="R_usuario" name="R_usuario" value="<?php echo $_SESSION['email']; ?> ">
                            <input type="hidden" id="R_qrcode" name="R_qrcode" value="<?php echo $R_qrcode ?> ">
                            <input type="hidden" id="R_ativo" name="R_ativo" value="<?php echo $R_ativo?>">
                            <input type="hidden"  id="R_modelo" name="R_modelo" value="<?php echo $R_modelo?>">
                            <input type="hidden"  id="R_marca" name="R_marca" value="<?php echo $R_marca?>">
                            <input type="hidden"  id="R_predio" name="R_predio" value="<?php echo $R_predio?>">
                            <input type="hidden" id="R_andar" name="R_andar" value="<?php echo $R_andar?>">
                            <input type="hidden" id="R_sala" name="R_sala" value="<?php echo $R_sala?>">
                            <input type="hidden" id="R_serie" name="R_serie" value="<?php echo $R_serie?>">
                            <input type="hidden" id="R_horaLamp" name="R_horaLamp" value="<?php echo $R_horasLamp?>">

                            <div class="form-group" id="selecao">
                              
                                <label for="exampleFormControlSelect1"><B>Situação</B></label>
                                <select class="form-control" id="exampleFormControlSelect1" name="situacao">
                                  <option value="OK">OK</option>
                                  <option value="PROBLEMA">PROBLEMA</option>
                                  <option value="OUTROS">OUTROS</option>
                                </select>
                                <label for="exampleFormControlSelect1"><B>Status</B></label>
                                <select class="form-control" id="exampleFormControlSelect2" name="status">
                                  <option value="RESOLVIDO">RESOLVIDO</option>
                                  <option value="ANDAMENTO">ANDAMENTO</option>
                                </select>

                            </div>
                            <div class="form-group green-border-focus" id="solucao">
                              <label for="exampleFormControlTextarea5">Solução</label>
                              <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="info"></textarea>
                            </div>
                            <div id="ap_chamado">
                            <input type="button" name="chamado" class='btn btn-danger btn-lg btn-block' value="CHAMADO" id="chamado">
                            <hr>
                            </div>   
                            <input type="submit" name="enviar" class='login100-form-btn' value="CHECK" id="botao">


                            </form>
                   



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