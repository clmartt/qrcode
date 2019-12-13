<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 


// recebe o qrcode da sala
$qrsalas = $_GET['qrcodesala'];

// faz a conexao
$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM QRCODETABLE WHERE QRSALA = '$qrsalas' GROUP BY SALA"; // query que sera executada
$result = $mysqli->query($sql); // executa a query e quarda da variavel
$qtd = mysqli_num_rows($result); // conta quantos registros vieram

if($qtd<1){ // se a quantidade de registros foi menor que 1 é porque nao foi encontrado o valor
  header("Location: error.html");// direciona para a pagina de erro
};
// inseri a barra de voltar
echo '<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/principal.php">
   
    Retornar
  </a></nav>';


echo "<p></p>";
echo "</br>";
echo '<input type="hidden" id="usuario" value="'.$_SESSION['email'].'">';




    foreach($result as $res){// mostra o cabeçalho predio andar e sala
     
        echo '<ion-icon src="./icon/ios-checkmark-circle.svg"  size="large" class="btn btn-primary" id="totalcheck"></ion-icon>'.' | '.'<ion-icon src="./icon/ios-contacts.svg"  size="large" class="btn btn-warning" id="totalocupado"></ion-icon>'. ' '.'<b> | '.$res['PREDIO'].' - '.$res['ANDAR'].' - '.utf8_encode($res['SALA']).'</b>';
        echo '<hr>';
        echo '<br>';

        $pegasala = $res['QRSALA']; // guarda o qrcode da sala para a query abaixo
    };

    $sql2 = "SELECT * FROM QRCODETABLE WHERE QRSALA = '$pegasala'"; // seleciona os equipamento que esta ligado a qrsala da sala
    $result2 = $mysqli->query($sql2);
    $qtd2 = mysqli_num_rows($result2);
    echo ' Total de Equipamentos'.' - '.$qtd2;
    echo '<div id="contar"> </div>';


    foreach ($result2 as $res2) {
        // realiza a consulta dos chamados na base , pelo qrcode do equipamento
        $qrEqui = $res2['QRCODE'];
        $sqlCH = "SELECT qrcode from CHAMADOS WHERE qrcode = '$qrEqui' AND status = 'ANDAMENTO' ";
        $resultCH = $mysqli->query($sqlCH);
        $qtdCH = mysqli_num_rows($resultCH);


       if($qtdCH>0){

           echo'<div class="card">';
            echo '<div class="card-header" id="'.$res2['ID_REGISTRO'].'">';
             echo '<ion-icon src="./icon/md-checkmark-circle.svg"  size="large" class="checado" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>';
             echo '<ion-icon src="./icon/ios-contacts.svg"  size="large" class="ocupado" id="'.$res2['ID_REGISTRO'].'">'.$res2['QRCODE'].'</ion-icon>';
             echo '</div>';
             echo '<div class="card-body" id="form'.$res2['ID_REGISTRO'].'">';
             echo '<h5 class="card-title">'.'<ion-icon src="./icon/md-thumbs-down.svg"   size="large" class="btn btn-danger" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>'.' | '.$res2['QRCODE'].' | '.utf8_encode($res2['TIPO_DE_EQUIPAMENTO']).'</h5>';
            echo '<p class="card-text">'.utf8_encode($res2['MARCA']).' | '.$res2['MODELO'].'</p>';
            echo '<a href="/qrteste2/updateativo/formUp.php?qrcode='.$res2['QRCODE'].'"><ion-icon src="./icon/md-create.svg"   size="small" ></ion-icon></a>';
            
          
            
          echo '</div>';
        echo '</div> <br>';


       }else{

         echo'<div class="card">';
        echo '<div class="card-header" id="'.$res2['ID_REGISTRO'].'">';
         echo '<ion-icon src="./icon/md-checkmark-circle.svg"  size="large" class="checado" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>';
           echo '<ion-icon src="./icon/ios-contacts.svg"  size="large" class="ocupado" id="'.$res2['ID_REGISTRO'].'">'.$res2['QRCODE'].'</ion-icon>';
         echo '</div>';
         echo '<div class="card-body" id="form'.$res2['ID_REGISTRO'].'">';
          echo '<h5 class="card-title">'.'<ion-icon src="./icon/md-thumbs-down.svg"   size="large" class="chamado" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>'.' | '.$res2['QRCODE'].' | '.utf8_encode($res2['TIPO_DE_EQUIPAMENTO']).'</h5>';
          echo '<p class="card-text">'.utf8_encode($res2['MARCA']).' | '.$res2['MODELO'].'</p>';
          echo '<a href="/qrteste2/updateativo/formUp.php?qrcode='.$res2['QRCODE'].'"><ion-icon src="./icon/md-create.svg"   size="small" ></ion-icon></a>';
          
        
          
        echo '</div>';
      echo '</div> <br>';
        

        
       };

     

      
    }


    

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
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>
<script type="text/javascript">
  
$(document).ready(function(){
            // ESCONDENDO OS BOTOES DE CHECADO E OCUPAD0
          $('.ocupado').hide();
          $('.checado').hide();

          // DISPARA CLICK EM TODOS OS BOTOES DE CHECADO
          $('#totalcheck').click(function(){
            $('.checado').trigger('click');
            //$('.card').fadeOut('slow');
            $(this).off('click');
            $(this).addClass('bg-success text-white');
            
            
          });

          // DISPARA CLICK EM TODOS SO BOTOES DO OCUPADO
          $('#totalocupado').click(function(){
            $('.ocupado').trigger('click');
            //$('.card').fadeOut('slow');
            $(this).off('click');
            $(this).addClass('bg-success text-white');
            //alert('Todos os itens foram checado!');
          });


          // EVENTOS DO BOTAO CHECADO
           contador = 0; // iniciada em 0 , server para contar os equipamentos
           codigos = []; // um array que guardara os qrcodes abaixo

          $('.checado').click(function(){
           
           var tamanho = $('.checado').length; 
           var sala = $(this).text();// PEGA O QRCODE REFERENTE O REGISTRO GERADO
            $(this).addClass("btn btn-info");// ADICIONA CLASSE
            $(this).off('click');// RETIRA O EVENTO DO BOTAO
            codigos.push(sala);

            if(codigos.length==tamanho){

              // REQUISIÇAO AJAX PARA GUARDAR O CHECK
            // $.post('insertchecksala.php',{qrcode:codigos},function(data) {
                   
              //  });
              // ENVIADO VIA GET - CORREÇÃO TEMPORARIA PARA ENVIO DOS VALORES - LOGO SERÁ VIA AJAX ACIMA ^
              window.location.replace("insertchecksala.php?qrcode="+codigos)

            };

                     
             var ident = $(this).attr('id');// PEGA A IDENTIDADE DO ELEMENTO
              var nomeId = "#"+ident; // FORMATA PARA QUE POSSA SER USADA NA VARIAVEL ABAIXO
              $('.card').addClass('p-3 mb-2 bg-info text-white');
              $(nomeId).fadeOut('slow');
              //$(this).show();

              
              contador = contador + 1; 
              $('#contar').append('<img src="./images/ball.gif">');
             

                

          
              
          });



            $('.chamado').click(function(){
           var sala = $(this).text();
           var sala_split = sala.split(" ");
           $(this).addClass("btn btn-danger");
           $(this).off('click');
           var fresh = confirm("Enviar o Chamado para o Fresh Service?");

           // SE É NECESSÁRIO O ENVIO PARA O FRESH
           if(fresh){

              var identform = $(this).attr('id');
              var nomeIdform = "#form"+identform; // NOME DA DIV QUE RECEBE O FORM
              
            $(nomeIdform).append('<form class="border border-danger" id="'+identform+'"> <div class="form-group"> <label for="exampleInputEmail1"><b>ABERTURA DE CHAMADO</b></label><input type="text" class="form-control" id="qrcodeequipamento" value= '+sala+'><small id="emailHelp" class="form-text text-muted"> Será aberto um chamado para o QRCODE Acima.</small></div><div class="form-group"><label for="exampleFormControlSelect1">Problema</label><select class="form-control" id="problema"><option>PROJETOR</option><option>TV</option><option>ÁUDIO</option><option>AUTOMAÇÃO</option><option>VGA</option><option>HDMI</option><option>CONTROLE</option><option>LAMPADA</option><option>ELETRICA</option><option>SENSOR</option><option>ADAPTADOR</option><option>CONVERSOR</option><option>TELA</option><option>OUTROS</option></select></div><div class="form-group"> <label for="exampleInputPassword1">Descrever o Problema</label> <input type="text" class="form-control" id="Desproblema" placeholder="Descrição do Problema"></div><a href="#" id="enviarfresh" class="btn btn-primary" >'+identform+'</a></form>');

            


              //$.post('insertchecksala.php',{qrcode:sala},function(data) {
                   
              //  });

           }else{

              var identform = $(this).attr('id');
              var nomeIdform = "#form"+identform; // NOME DA DIV QUE RECEBE O FORM
              
            $(nomeIdform).append('<form class="border border-danger" id="'+identform+'"> <div class="form-group"> <label for="exampleInputEmail1"><b>ABERTURA DE CHAMADO</b></label><input type="text" class="form-control" id="qrcodeequipamentoS" value= '+sala+'><small id="emailHelp" class="form-text text-muted"> Será aberto um chamado para o QRCODE Acima.</small></div><div class="form-group"><label for="exampleFormControlSelect1">Problema</label><select class="form-control" id="problemaS"><option>PROJETOR</option></option><option>TV</option><option>ÁUDIO</option><option>AUTOMAÇÃO</option><option>VGA</option><option>HDMI</option><option>CONTROLE</option><option>LAMPADA</option><option>ELETRICA</option><option>SENSOR</option><option>ADAPTADOR</option><option>CONVERSOR</option><option>TELA</option><option>OUTROS</option></select></div><div class="form-group"> <label for="exampleInputPassword1">Descrever o Problema</label> <input type="text" class="form-control" id="DesproblemaS" placeholder="Descrição do Problema"></div><button href="#" id="enviar" class="btn btn-primary" >'+identform+'</button></form>');



           };
             
              var ident = $(this).attr('id');
              var nomeId = "#"+ident;
              $(nomeId).fadeOut('slow');
              
                        
              
          });



         // EVENTOS DO BOTAO OCUPADO
           contadorOcupado = 0; // iniciada em 0 , server para contar os equipamentos
           codigosOcupado = []; // um array que guardara os qrcodes abaixo

          $('.ocupado').click(function(){
           
           var tamanho = $('.checado').length; 
           var sala = $(this).text();// PEGA O QRCODE REFERENTE O REGISTRO GERADO
            $(this).addClass("btn btn-warning");// ADICIONA CLASSE
            $(this).off('click');// RETIRA O EVENTO DO BOTAO
            codigosOcupado.push(sala);

            if(codigosOcupado.length==tamanho){

              // REQUISIÇAO AJAX PARA GUARDAR O CHECK
            // $.post('insertchecksala.php',{qrcode:codigos},function(data) {
                   
              //  });
              // ENVIADO VIA GET - CORREÇÃO TEMPORARIA PARA ENVIO DOS VALORES - LOGO SERÁ VIA AJAX ACIMA ^
              window.location.replace("insertchecksala.php?qrcode="+codigosOcupado+"&ocupada=SIM")

            };

                     
             var ident = $(this).attr('id');// PEGA A IDENTIDADE DO ELEMENTO
              var nomeId = "#"+ident; // FORMATA PARA QUE POSSA SER USADA NA VARIAVEL ABAIXO
              $('.card').addClass('p-3 mb-2 bg-info text-white');
              $(nomeId).fadeOut('slow');
              //$(this).show();

              
              contador = contador + 1; 
              $('#contar').append('<img src="./images/ball.gif">');
             

                

          
              
          });


             // pega o formulario de chamado e envia para o fres e guarda o chamado
             $(document).on('click', '#enviarfresh', function(){
                 
                 var qrcodes = $('#qrcodeequipamento').val();
                  var problemas = $('#problema').val();
                  var Descproblemas = $('#Desproblema').val();
                  var user = $("#usuario").val();
                  
                  
                // guarda o chamado 
                  $.post('insertchamadosala.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   
                  });
                

                    // chama a pagina que envia email OK
                  $.post('emailchamado.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   alert("Chamado enviado!!!");
                  });

                var identform = $(this).text();
                var nomeIdform = "#form"+identform;
                $(nomeIdform).empty();
                 //$('form').fadeOut('slow');




            });

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            $(document).on('click', '#enviar', function(){
                 
                 var qrcodes = $('#qrcodeequipamentoS').val();
                  var problemas = $('#problemaS').val();
                  var Descproblemas = $('#DesproblemaS').val();
                  var user = $("#usuario").val();
                  
                  alert('Ok Chamado Aberto!');
                // guarda o chamado 
                  $.post('insertchamadosala.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   
                  });
                

                    // chama a pagina que envia email OK
                 // $.post('emailchamado.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   
                  //});

                var identform = $(this).text();
                var nomeIdform = "#form"+identform;
                $(nomeIdform).empty();
                 //$('form').fadeOut('slow');




            });






  //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>           


  });





</script>
<BODY>


  
<DIV></DIV>

</BODY>