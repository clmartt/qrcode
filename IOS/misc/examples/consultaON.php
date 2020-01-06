<?php 

//sessao
ob_start(); 
session_start();

ini_set('default_charset','UTF-8');

// variavel que recebe o codido qrcode
$qrcode = $_GET['qrcode'];

$user = $_GET['user'];


if($_SESSION['email']==''){

    header("Location: ../../../login.html"); 
};


//$_SESSION['email'] = $user;




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
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

<script>

    $(document).ready(function(){
        $('#resultado_chamado').hide();
//====================================================================================>>>>>>>>>
        $('#ap_chamado').hide();
        $('#divproblema').hide();
//====================================================================================>>>>>>>>>
        $('#editar').click(function(){
          $('#form_envia').attr('action','https://kvm1000.websiteseguro.com/qrteste2/updateativo/formUp.php');
          $('#botao').trigger('click');
        });
//====================================================================================>>>>>>>>>      
            
        $('#atualizar').click(function(){
            var nova_hora = prompt('Digite as horas de lampada:');
            if(nova_hora != null){

                var idqrcode = $('#R_qrcode').val();
                alert("As horas serão atualizadas, Só um minutinho!!!!");
            
                $.post('updatehoras.php', 
                { vhora_nova: nova_hora, vn_qrcode:idqrcode},
                function(data) {

                    
                    window.location.reload();
                    
                });

            };
           
                

            
        });

        $('#busca_chamado').click(function(){
                var cqrcode = $('#R_qrcode').val();

          $('#resultado_chamado').toggle('slow',function(){
            $.get('consultaON_chamados.php', 
                { vqrcode: cqrcode},
                function(data) {

                    $('#resultado_chamado').html(data);
                   // $('#resultado_chamado').slideDown('slow').html(data);
                     
                });

          });      
            
        });





//========================================================================================>>>>>>>>>>>>>>>>>>>>>>>>>>            
            $('#exampleFormControlSelect1').change(function(){
                
                if($(this).val()==='PROBLEMA'){
                     $('#ap_chamado').fadeIn('slow');
                     $('#divproblema').fadeIn('slow');
                     
                }else{
                     $('#ap_chamado').fadeOut('slow');
                     $('#divproblema').fadeOut('slow');
                };

             });
//====================================================================================>>>>>>>>>
            $('#chamado').click(function(){

                var R_usuario = $('#R_usuario').val();
                var R_qrcode = $('#R_qrcode').val();
                var R_ativo =  $('#R_ativo').val();
                var R_caract = $('#R_caract').val();
                var R_modelo = $('#R_modelo').val();
                var R_marca =  $('#R_marca').val();
                var R_predio = $('#R_predio').val();
                var R_andar = $('#R_andar').val();
                var R_setor = $('#R_setor').val();
                var R_sala = $('#R_sala').val();
                var R_serie = $('#R_serie').val();
                var R_horaLamp = $('#R_horaLamp').val();
                var situacao = $('#exampleFormControlSelect1').val();
                var problema = $('#comboproblema').val();
                var status = $('#exampleFormControlSelect2').val();
                var info = $('#exampleFormControlTextarea5').val();
                var os_banco = prompt('Digite a OS_BANCO ou nome do solicitante se existir!!!');

                // para enviar para fresh 
                //var fresh = confirm('Deseja enviar o chamado para o Fresh Service?');

                $.post('insertchamado.php', 
                { R_usuario: R_usuario, R_qrcode: R_qrcode, R_ativo: R_ativo,R_caract: R_caract, R_modelo: R_modelo,R_marca:R_marca,R_predio:R_predio,R_andar:R_andar,R_setor: R_setor,R_sala:R_sala,R_serie:R_serie,R_horaLamp:R_horaLamp,situacao:situacao,problema:problema,status:status,info:info,os_banco:os_banco},
                function(data) {
                    alert('Chamado Aberto!!!');
                });

                   $('#ap_chamado').fadeOut('slow');
                   $('#divproblema').fadeOut('slow');
                   

                    

            });


            $('#botao').click(function(){

                $(this).attr('value','Aguarde...');
                $(this).fadeOut('slow');
                




            });

            

        
    });

//====================================================================================>>>>>>>>></script>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

 

                <div class="table-responsive" padding= 25px>

                   <?php 
                     ini_set('default_charset','UTF-8');
                        if($mysqli){

                        $sql = "SELECT * FROM QRCODETABLE where QRCODE = '$qrcode'";
                        $result = $mysqli->query($sql);

                                       

                        if ($result->num_rows > 0) {

                            // saida dos dados ESTA PARTE É MOSTRADA NA TELA

                            while($row = $result->fetch_assoc()) {

                                $R_id = $row['ID_REGISTRO'];
                                $R_qrcode = $row['QRCODE'];
                                $R_ativo = strval($row['TIPO_DE_EQUIPAMENTO']);
                                $R_caract = strval($row['CARACTERISTICA']);
                                $R_marca = $row['MARCA'];
                                $R_modelo = $row['MODELO'];
                                $R_serie = $row['N_SERIE'];
                                $R_predio = $row['PREDIO'];
                                $R_andar = $row['ANDAR'];
                                $R_setor = $row['SETOR'];
                                $R_sala = $row['SALA'];
                                $R_qrsala = $row['QRSALA'];
                                $R_horasLamp = $row['HORAS_LAMP'];



                                // MOSTRANDO NA TELA

                                echo '<div class="card">';
                                echo '<nav class="navbar navbar-dark bg-dark">
                                <a class="navbar-brand" href="demo.php">
                                 
                                  Retornar
                                </a>
                               
                              </nav>
                               <p></p>';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title"><button type="button" id="editar" class="btn btn-secondary">Editar</button>'.' | '.$row['QRCODE'].'</h5>';
                                echo '<div id="resultado_chamado"><img src="./images/loading.gif"></div>';
                                echo '<p class="card-text">'.utf8_encode($row['TIPO_DE_EQUIPAMENTO']).' - '.utf8_encode($row['CARACTERISTICA']).'</p>';
                                echo '<p class="card-text">'.utf8_encode($row['MARCA']).' - '.utf8_encode($row['MODELO']).' - '.utf8_encode($row['N_SERIE']).'</p>';
                                
                                echo '<p class="card-text">'.utf8_encode($row['PREDIO']).' - '.utf8_encode($row['ANDAR']).' - '.utf8_encode($row['SALA']).'</p>';
                               
                                echo '<p class="card-text">'.'Setor: '.utf8_encode($row['SETOR']).'</p>';
                                echo '<p class="card-text">'.'Qrsala: '.utf8_encode($row['QRSALA']).'</p>';
                                echo '<p class="card-text">'.'Horas Lâmpada: '.utf8_encode($row['HORAS_LAMP']).' | '.'<ion-icon src="./icon/md-flashlight.svg"  size="large" class="text-warning" id="atualizar"></ion-icon>'.'</p>';


                                    
                                echo '</div>';
                                echo '</div>';
                                                       
                            }
                        } else {
                            echo "<div class='alert alert-warning' role='alert'>
                                Não encontramos esse QRCODE em nossos Registros </div>";
                            echo "<a href='demo.php'><button type='button' class='btn btn-primary btn-lg btn-block'>Tentar Novamente</button></a>";
                            echo "<br>";
                            echo "<script>$(document).ready(function(){
                                    $('#selecao').hide();
                                    $('#solucao').hide();
                                    $('#botao').hide();
                                    });</script> ";
                        }     
                            }
                        else {
                            echo "FALHA NA  CONEXAO";
                              };
                                                       
                     
                        ?>

                        <form action="insertcheck.php" method="POST" id="form_envia">
                           
                          
                            <input type="hidden" id="R_usuario" name="R_usuario" value="<?php echo $_SESSION['email']; ?> ">
                            <input type="hidden" id="R_id" name="R_id" value="<?php echo $R_id ?> ">
                            <input type="hidden" id="R_qrcode" name="R_qrcode" value="<?php echo $R_qrcode ?> ">
                            <input type="hidden" id="R_ativo" name="R_ativo" value="<?php echo $R_ativo?>">
                            <input type="hidden" id="R_caract" name="R_caract" value="<?php echo utf8_encode($R_caract)?>">
                            <input type="hidden"  id="R_marca" name="R_marca" value="<?php echo $R_marca?>">
                            <input type="hidden"  id="R_modelo" name="R_modelo" value="<?php echo $R_modelo?>">
                            <input type="hidden"  id="R_serie" name="R_serie" value="<?php echo $R_serie?>">
                            <input type="hidden"  id="R_predio" name="R_predio" value="<?php echo $R_predio?>">
                            <input type="hidden" id="R_andar" name="R_andar" value="<?php echo $R_andar?>">
                            <input type="hidden" id="R_setor" name="R_setor" value="<?php echo utf8_encode($R_setor)?>">
                            <input type="hidden" id="R_sala" name="R_sala" value="<?php echo utf8_encode($R_sala)?>">
                            <input type="hidden" id="R_sala" name="R_qrsala" value="<?php echo utf8_encode($R_qrsala)?>">
                            <input type="hidden" id="R_horaLamp" name="R_horaLamp" value="<?php echo $R_horasLamp?>">
                            <div id="retorno"></div>

                            <div class="form-group" id="selecao">
                              
                                <label for="exampleFormControlSelect1"><B>&nbsp&nbspSituação</B></label>
                                <select class="form-control" id="exampleFormControlSelect1" name="situacao">
                                  <option value="OK">OK</option>
                                  <option value="PROBLEMA">PROBLEMA</option>
                                </select>
                                 <BR>
                                <div id="divproblema">
                                <label for="exampleFormControlSelect1"><B>&nbsp&nbspProblema</B></label>
                                <select class="form-control" id="comboproblema" name="problema">
                                  <option value="VGA">VGA</option>
                                  <option value="HDMI">HDMI</option>
                                  <option value="CONTROLE">CONTROLE</option>
                                  <option value="LAMPADA">LAMPADA</option>
                                  <option value="ELETRICA">ELETRICA</option>
                                  <option value="SENSOR">SENSOR</option>
                                  <option value="ADAPTADOR">ADAPTADOR</option>
                                  <option value="CONVERSOR">CONVERSOR</option>
                                  <option value="TELA">TELA</option>
                                  <option value="OUTROS">OUTROS</option>
                                </select>
                                
                                <BR>
                                <label for="exampleFormControlSelect1"><B>&nbsp&nbspStatus</B></label>
                                <select class="form-control" id="exampleFormControlSelect2" name="status">
                                  <option value="RESOLVIDO">RESOLVIDO</option>
                                  <option value="ANDAMENTO">ANDAMENTO</option>
                                </select>

                          
                            <BR>
                            <div class="form-group green-border-focus" id="solucao">
                              <label for="exampleFormControlTextarea5"><B>&nbsp&nbspProblema ou Solução Aplicada</B></label>
                              <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="info"></textarea>
                            </div>
                            </div>
                            <div id="ap_chamado">
                            <input type="button" name="chamado" class='btn btn-danger btn-lg btn-block' value="CHAMADO" id="chamado">
                            <hr>
                            </div> 
                            <div align="center"align="center" >  
                            <input type="submit" name="enviar" class='btn btn-info' value="CHECK" id="botao" >
                            <span id='carregando'></span>
                            </div>
                            


                            </form>
                   



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