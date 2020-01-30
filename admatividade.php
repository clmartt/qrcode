<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$cliente = $_SESSION['cliente'];


$mysqli = new mysqli($host, $user, $pass, $db);

if($cliente == 'KVM'){
    $sql = "SELECT * FROM AGENDAMENTO  ORDER BY DATAC";
    $result = $mysqli->query($sql);

}else{

    $sql = "SELECT * FROM AGENDAMENTO WHERE CLIENTE ='$cliente' ORDER BY DATAC";
    $result = $mysqli->query($sql);
};






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
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<script type="text/javascript">
  
$(document).ready(function(){

        $("#txtBusca").keyup(function(){
            var texto = $(this).val();
            var textm = texto.toString();
              
                        $(".card").css("display", "block");
                        $(".card").each(function(){
                              if($(this).text().indexOf(textm.toUpperCase()) < 0){
                                                                   
                                  $(this).hide();
                                  
                                  
                                };
                          });
          });


          $("#bexcluir").click(function(){
              $("#imagemlixo").empty();
              var idAtividades = $("#idAtividade").val();

              $.post('excluiratividades.php',{idAtividade:idAtividades},function(data) {
                                                    
                            $retorno = data;
                            if($retorno == "OK"){
                              $("#imagemlixo").append('<img src="./images/joia.gif" width="300" height="250">');
                              $("#bexcluir").hide();
                            }else{
                              alert('Ocorreu um Erro ao Deletar as informações informe ao Desenvolvedor!');

                            };
                            
                           

                });

              //
              
          });


          $("#fechar").click(function(){
            window.location.reload();

          });






});



$(document).on('click','#editar',function(){
    alert($(this).val());

});

$(document).on('click','#excluir',function(){
  
 
  var ident = $(this).val();
  $("#imagemlixo").empty();
  $("#idAtividade").val(ident);
  $("#imagemlixo").append("<p>Você ainda pode desistir clicando e FECHAR!</p>");


    

});





</script>
<BODY>
<?php include("menu.php"); ?>
<br>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><ion-icon src="./icon/md-search.svg"  size="small" ></ion-icon></span>
  </div>
  <input type="text" class="form-control" placeholder="Pesquisa" aria-label="Usuário" aria-describedby="basic-addon1" id="txtBusca" >
</div>




  <?php 
  echo 'cleinte e´ --'.$cliente;

    echo '<div class="container">';
   

  foreach($result as $res){
        
    if($res['SITUACAO']=='ABERTO'){
        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.utf8_encode($res['RESUMO']).'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-danger">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.utf8_encode($res['SOLICITANTE']).'</p>';
        echo  '<p class="text-secondary">'.utf8_encode($res['OBSERVACAO']).'</p>';
        echo '<div class="text-right"><button type="button" class="btn btn-danger btn-sm" id="excluir" value="'.$res['ID_AGENDAMENTO'].'" data-toggle="modal" data-target="#modalexcluir">Excluir</button></div>';
        echo  '</div>';
        echo  '</div>';
        echo '<p></p>';

    }

    if($res['SITUACAO']=='ANDAMENTO'){

        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.utf8_encode($res['RESUMO']).'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-warning">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.utf8_encode($res['SOLICITANTE']).'</p>';
        echo  '<p class="text-secondary">'.utf8_encode($res['OBSERVACAO']).'</p>';
        echo '<div class="text-right"><button type="button" class="btn btn-danger btn-sm" id="excluir" value="'.$res['ID_AGENDAMENTO'].'" data-toggle="modal" data-target="#modalexcluir">Excluir</button></div>';
        echo  '</div>';
        echo  '</div>';
        echo '<p></p>';

    };

    if($res['SITUACAO']== 'FINALIZADO'){
        
        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.utf8_encode($res['RESUMO']).'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-info">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.utf8_encode($res['SOLICITANTE']).'</p>';
        echo  '<p class="text-secondary">'.utf8_encode($res['OBSERVACAO']).'</p>';
        echo '<div class="text-right"><button type="button" class="btn btn-danger btn-sm" id="excluir" value="'.$res['ID_AGENDAMENTO'].'" data-toggle="modal" data-target="#modalexcluir">Excluir</button></div>';
        echo  '</div>';
        echo  '</div>';
        echo '<p></p>';

  
    
   };



};



    echo '</div>';
    

  ?>
  <?php 
  echo '<br>';
  echo '<br>';
  echo '<br>';

  
  ?>
  





  <!-- Modal para excluir -->
<div class="modal fade bd-example-modal-sm" id="modalexcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja Excluir a Atividade?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="idAtividade">
          <div class="text-center" id="imagemlixo"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar">Fechar</button>
        <button type="button" class="btn btn-danger" id="bexcluir">Excluir</button>
      </div>
    </div>
  </div>
</div>


 
</BODY>