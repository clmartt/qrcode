<?php

ob_start();
session_start();

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="jquery-3.2.1.min.js"></script>
<script>


$(document).on('click','#idButton',function(){
  var id_atividade = $(this).val(); // pega o id da atividade 
  var situacao = $(this).text();// pega a situação atua da atividade
  
  $("#numero_id").val(id_atividade); // pega as variaveis acima e insere em inputs txt hidden
  $("#txtsituacao").val(situacao);

 
  
    
});


$(document).ready(function(){
  // faz o envio da variaveis com o id da atividade e nova situação para update
  $("#gravar").click(function(){
      var pegaId = $("#numero_id").val();
      var pegaSituacao = $("#situacao option:selected").val();
      
                $.post('updateAtividades.php',{idAtividade:pegaId,txtSituacao:pegaSituacao},function(data) {
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
  <h3>Atividades Agendadas</h3>
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
      echo '<p class="card-text">'.utf8_encode($res['OBSERVACAO']).'</p>';
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
      echo '<p class="card-text">'.utf8_encode($res['OBSERVACAO']).'</p>';
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
      echo '<p class="card-text">'.utf8_encode($res['OBSERVACAO']).'</p>';
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

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>





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
                                

                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="gravar">Save changes</button>
      </div>
    </div>
  </div>
</div>









</body>
</html>
