<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$qrsalas = $_GET['qrcodesala'];

$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM QRCODETABLE WHERE QRSALA = '$qrsalas' GROUP BY SALA";
$result = $mysqli->query($sql);

echo '<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/principal.php">
   
    Retornar
  </a></nav>';


echo "<p></p>";
echo "</br>";
echo '<input type="hidden" id="usuario" value="'.$_SESSION['email'].'">';




    foreach($result as $res){
     
        echo '<ion-icon src="./icon/ios-checkmark-circle.svg"  size="large" class="btn btn-primary" id="totalcheck"></ion-icon>'.' | '.'<ion-icon src="./icon/ios-contacts.svg"  size="large" class="btn btn-warning" id="totalocupado"></ion-icon>'. ' '.'<b> | '.$res['PREDIO'].' - '.$res['ANDAR'].' - '.$res['SALA'].'</b>';
        echo '<hr>';
        echo '<br>';

        $pegasala = $res['QRSALA'];
    };

    $sql2 = "SELECT * FROM QRCODETABLE WHERE QRSALA = '$pegasala'";
    $result2 = $mysqli->query($sql2);


    foreach (  $result2 as $res2) {

      echo'<div class="card">';
        echo '<div class="card-header" id="'.$res2['ID_REGISTRO'].'">';
         echo '<ion-icon src="./icon/md-checkmark-circle.svg"  size="large" class="checado" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>';
           echo '<ion-icon src="./icon/ios-contacts.svg"  size="large" class="ocupado" id="'.$res2['ID_REGISTRO'].'">'.$res2['QRCODE'].'</ion-icon>';
         echo '</div>';
         echo '<div class="card-body" id="form'.$res2['ID_REGISTRO'].'">';
          echo '<h5 class="card-title">'.'<ion-icon src="./icon/md-thumbs-down.svg"   size="large" class="chamado" id="'.$res2['ID_REGISTRO'].'" >'.$res2['QRCODE'].'</ion-icon>'.' | '.$res2['QRCODE'].' | '.utf8_encode($res2['TIPO_DE_EQUIPAMENTO']).'</h5>';
          echo '<p class="card-text">'.$res2['MARCA'].' | '.$res2['MODELO'].'</p>';
          
        echo '</div>';
      echo '</div> <br>';

      
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
            $('.card').fadeOut('slow');
            $(this).off('click');
            $(this).addClass('bg-success text-white');
            alert('Todos os itens foram checado!');
          });

          // DISPARA CLICK EM TODOS SO BOTOES DO OCUPADO
          $('#totalocupado').click(function(){
            $('.ocupado').trigger('click');
            $('.card').fadeOut('slow');
            $(this).off('click');
            $(this).addClass('bg-success text-white');
            alert('Todos os itens foram checado!');
          });


          // EVENTOS DO BOTAO CHECADO
          $('.checado').click(function(){
           var sala = $(this).text();// PEGA O QRCODE REFERENTE O REGISTRO GERADO
           var sala_split = sala.split(" ");// FAZ O SPLIT POREM NÃO USADO NO MOMENTO
            $(this).addClass("btn btn-info");// ADICIONA CLASSE
           
            $(this).off('click');// RETIRA O EVENTO DO BOTAO

           // REQUISIÇAO AJAX PARA GUARDAR O CHECK
             $.post('insertchecksala.php',{qrcode:sala},function(data) {
                   
                });
             
             var ident = $(this).attr('id');
              var nomeId = "#"+ident;
              $(nomeId).addClass('p-3 mb-2 bg-info text-white');
              $(nomeId).fadeOut('slow');
          
              
          });



            $('.chamado').click(function(){
           var sala = $(this).text();
           var sala_split = sala.split(" ");
           alert('foi clicado pela class');
           $(this).addClass("btn btn-danger");
           $(this).off('click');
           var fresh = confirm("Enviar o Chamado para o Fresh Service?");

           // SE É NECESSÁRIO O ENVIO PARA O FRESH
           if(fresh){

              var identform = $(this).attr('id');
              var nomeIdform = "#form"+identform; // NOME DA DIV QUE RECEBE O FORM
              
            $(nomeIdform).append('<form class="border border-danger" id="'+identform+'"> <div class="form-group"> <label for="exampleInputEmail1"><b>ABERTURA DE CHAMADO</b></label><input type="text" class="form-control" id="qrcodeequipamento" value= '+sala+'><small id="emailHelp" class="form-text text-muted"> Será aberto um chamado para o QRCODE Acima.</small></div><div class="form-group"> <label for="exampleInputPassword1">Problema ex: VGA - HDMI - TELA</label> <input type="text" class="form-control" id="problema" placeholder="Problema"></div><div class="form-group"> <label for="exampleInputPassword1">Descrever o Problema</label> <input type="text" class="form-control" id="Desproblema" placeholder="Descrição do Problema"></div><a href="#" id="enviar" class="btn btn-primary" >'+identform+'</a></form>');

            


              //$.post('insertchecksala.php',{qrcode:sala},function(data) {
                   
              //  });

           }else{

            alert('Gravado!');
            $.post('insertchecksala.php',{qrcode:sala},function(data) {
                   
                });

           };
             
              var ident = $(this).attr('id');
              var nomeId = "#"+ident;
              $(nomeId).fadeOut('slow');
              
                        
              
          });



             $('.ocupado').click(function(){
           var sala = $(this).text();
           var sala_split = sala.split(" ");
           alert('foi clicado pela class');
           $(this).addClass("btn btn-warning");
           $(this).off('click');
           
             $.post('insertchecksala.php',{qrcode:sala,ocupada:"SIM"},function(data) {
                   
                });
             
              var ident = $(this).attr('id');
              var nomeId = "#"+ident;
              $(nomeId).fadeOut('slow');
              
           
              
          });



             $(document).on('click', 'a', function(){
                 
                 var qrcodes = $('#qrcodeequipamento').val();
                  var problemas = $('#problema').val();
                  var Descproblemas = $('#Desproblema').val();
                  var user = $("#usuario").val();
                  
                  
                //alert(qrcodes+problemas+Descproblemas+user);
                  $.post('insertchamadosala.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   
                  });
                

                    // chama a pagina que envia email OK
                  $.post('emailchamado.php',{qrcode:qrcodes,problema:problemas,dproblema:Descproblemas,usuario:user},function(data) {
                   
                  });

                var identform = $(this).text();
                var nomeIdform = "#form"+identform;
                $(nomeIdform).empty();
                 //$('form').fadeOut('slow');




              });


  });





</script>
<BODY>


 
  
<DIV></DIV>

</BODY>