<?php

ob_start();
session_start();
include('timezone.php');

// pega a sessao do usuario  verifica se o cliente esta vazio
if($_SESSION['cliente']==''){
    header("Location: ./login.html"); 

};



include('conectar.php'); // pagina de conexao com o bd
$usuario = strtoupper($_SESSION['email']); // guarda a sessao de emaio
$dataHoje = date('Y-m-d'); // pega a data de hoje com o formato ano - mes - dia
$selecao = "SELECT * FROM AGENDAMENTO WHERE RECURSO = '$usuario' and DATAC = '$dataHoje' ORDER BY HINICIO"; // seleciona os agendamentos pelo usuario e data de hoje ordenando por hora de inicio
$resultado = $pdo->query($selecao); // pega o resultado da query e guarda na variavel



?>

<!DOCTYPE html>
<html>
<head>
<title>Atividades Agendadas</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="jquery-3.2.1.min.js"></script>
<script>


$(document).on('click','#idButton',function(){
  var id_atividade = $(this).val(); // pega o id da atividade 
  var situacao = $(this).text();// pega a situação atua da atividade
  
  $("#numero_id").val(id_atividade); // pega as variaveis acima e insere em inputs txt hidden
  $("#txtsituacao").val(situacao);

 
  
    
});


$(document).ready(function(){
  // esconde das divs do modal
  $('#sit').hide();
  $('#textobserv').hide();

  // quando o select muda para finalizado mostra as divs acima que foram escondidas

  $("#situacao").change(function(){
    var texto = $(this).val();
    if(texto == 'FINALIZADO'){
          $('#sit').fadeIn();
          $('#textobserv').fadeIn();

    }else{

        $('#sit').hide();
        $('#textobserv').hide();
    }
    
    

  });

  // faz o envio da variaveis com o id da atividade e nova situação para update
  $("#gravar").click(function(){
      var pegaId = $("#numero_id").val();
      var pegaSituacao = $("#situacao option:selected").val();
      var pegaFeed = $("#feedback option:selected").val();
      var obs = $("#obs").val();
      var user = '<?php echo $_SESSION['email'] ?>';
      
                $.post('updateAtividades.php',{idAtividade:pegaId,txtSituacao:pegaSituacao,feedback:pegaFeed,obs:obs,user:user},function(data) {
                            $("#gravar").html("<img src='./images/enviado.gif' width='30' heigth='30'>");
                            
                            window.location.reload();// da refresh na pagina depois do retorno da pagina de update
                           

                });
                
               
  });

});





</script>

</head>
<body>
<?php include('menu.php');?>

<br>



<div class="container mt-3">
  <h5>Atividades Agendadas  - <?php echo date('d/m/Y') ?> </h5>
  <hr>
  <p></p>

   

 <div class="container">
<?php 

  foreach ($resultado as $res) {
    $situacao = $res['SITUACAO'];
    

    if($situacao=='ABERTO'){
      echo '<div class="card text-center">';
      echo '<div class="card-header">';
      echo utf8_encode($res['RESUMO']);
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">'.utf8_encode($res['SOLICITANTE']).'</h5>';
      echo '<p class="card-text">'.$res['OBSERVACAO'].'</p>';
      echo '<button type="button" id = "idButton" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" value="'.$res['ID_AGENDAMENTO'].'">'.$res['SITUACAO'].'</button>';
      echo '</div>';
      echo '<div class="card-footer text-muted">';
      echo $res['RECURSO'];
      echo '</div>';
      echo '</div>';
      echo '<p></p>';

    };

    if($situacao=='ANDAMENTO'){
      echo '<div class="card text-center">';
      echo '<div class="card-header">';
      echo utf8_encode($res['RESUMO']);
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">'.utf8_encode($res['SOLICITANTE']).'</h5>';
      echo '<p class="card-text">'.$res['OBSERVACAO'].'</p>';
      echo '<button type="button" id = "idButton" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" value="'.$res['ID_AGENDAMENTO'].'">'.$res['SITUACAO'].'</button>';
      echo '</div>';
      echo '<div class="card-footer text-muted">';
      echo $res['RECURSO'];
      echo '</div>';
      echo '</div>';
      echo '<p></p>';


    };


    if($situacao=='FINALIZADO'){
      echo '<div class="card text-center">';
      echo '<div class="card-header">';
      echo utf8_encode($res['RESUMO']);
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">'.utf8_encode($res['SOLICITANTE']).'</h5>';
      echo '<p class="card-text">'.$res['OBSERVACAO'].'</p>';
      echo '<button type="button" id = "idButton" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" value="'.$res['ID_AGENDAMENTO'].'">'.$res['SITUACAO'].'</button>';
      echo '</div>';
      echo '<div class="card-footer text-muted">';
      echo $res['RECURSO'];
      echo '</div>';
      echo '</div>';
      echo '<p></p>';

    
    
    };


    
  }
  echo '<p></p>';
  echo '<p></p>';
  echo '<p></p>';
         
 ?>
 </div>
  
    
       
 
  <br>

  
</div>







<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">STATUS DA ATIVIDADE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                            <form>
                              <input type="hidden" id="numero_id">
                              <input type="hidden" id="txtsituacao">
                                <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                            </div>
                                            <select class="custom-select" name="situacao" id="situacao">
                                                
                                                <option selected value="ABERTO">ABERTO</option>
                                                <option value="ANDAMENTO">ANDAMENTO</option>
                                                <option value="FINALIZADO">FINALIZADO</option>
                                            </select>
                                </div>
                                <div class="input-group mb-3" id="sit">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                            </div>
                                            <select class="custom-select" name="feedback" id="feedback">
                                                
                                                <option selected value="SHOW">SHOW</option>
                                                <option value="NO_SHOW">NO_SHOW</option>
                                                <option value="IMPROCEDENTE">IMPROCEDENTE</option>
                                                <option value="OK">OK</option>
                                            </select>
                                </div>
                                <div class="input-group" id="textobserv">
                                        <div class="input-group-prepend" >
                                          <span class="input-group-text">Obs:</span>
                                        </div>
                                        <textarea class="form-control" aria-label="With textarea" id="obs" name="obs"></textarea>
                                </div>
                                

                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="gravar">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
