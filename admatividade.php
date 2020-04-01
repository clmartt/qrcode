<?php
ob_start();
session_start();
header("Refresh: 300"); 
include('conectar.php');

$cliente = $_SESSION['cliente'];
$permissao = $_SESSION['permissao'];
$perfil = $_SESSION['perfil'];
$predio = $_GET['predio'];
$datahoje = date('Y-m-d');





if($permissao=='KVM'){ // quando a permissao for kvm listara tudo 

  
        // preenche o select dos predios
        $pegapredio = "SELECT PREDIO FROM AGENDAMENTO GROUP BY PREDIO";
        $predioResultado = $pdo->query($pegapredio);

        //mostra todas as atividades pois A PERMISSAO É KVM
                  if(isset($_GET['predio'])){
                    // SE O PREDIO FOR ENVIADO FILTRA POR PREDIO
                    $selecaoAtividades = "SELECT * FROM AGENDAMENTO WHERE PREDIO = '$predio' AND DATAC = '$datahoje' ";
                    $resultado = $pdo->query($selecaoAtividades);
                  }else{
                    // SE NAO FOR ENVIADO O PREDIO MOSTRA TUDO
                    $selecaoAtividades = "SELECT * FROM AGENDAMENTO WHERE DATAC = '$datahoje'";
                    $resultado = $pdo->query($selecaoAtividades);

                  }
        


}else{
            // quando for filtrar por predio verifica se foi enviado pelo submit
                if(isset($_GET['predio'])){
                  $selecaoAtividades = "SELECT * FROM AGENDAMENTO WHERE CLIENTE = '$permissao' AND PREDIO = '$predio' AND DATAC = '$datahoje' ORDER BY DATAC, HINICIO";
                  $resultado = $pdo->query($selecaoAtividades);

                }else{

                  $selecaoAtividades = "SELECT * FROM AGENDAMENTO WHERE CLIENTE = '$permissao' AND DATAC = '$datahoje' ORDER BY DATAC, HINICIO";
                  $resultado = $pdo->query($selecaoAtividades);
                }
  
// preenche o select dos predios SE NAO FOR ENVIADO NADA PELO SELECT DE PREDIOS ENTAO PEGA PELA PERMISSAO USUARIO
$pegapredio = "SELECT PREDIO FROM AGENDAMENTO WHERE CLIENTE = '$permissao' GROUP BY PREDIO";
$predioResultado = $pdo->query($pegapredio);

}









?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KVM INFORMATICA - QR CODE</title>
  
  
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="jquery-3.2.1.min.js"></script>


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


          $()






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
<?php include("menu.php"); 

?>
<br>

<nav class="navbar navbar-light bg-light justify-content-between">
  
<form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <div class="input-group" >
                    <select class="custom-select" id="inputGroupSelect04" name="predio">
                      <option selected>Escolha o Prédio</option>

                      <?php
                           foreach ($predioResultado as $resPredio) {
                            echo'<option value="'.$resPredio['PREDIO'].'">'.$resPredio['PREDIO'].'</option>';
                           }               
                      
                                
                    ?>

                    </select>
                    <div class="input-group-append">
                    <input class="btn btn-info" type="submit" value="Submit">
                    </div>
                    
          </div>

  </form>
</nav>



<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><ion-icon src="./icon/md-search.svg"  size="small" ></ion-icon></span>
  </div>
  <input type="text" class="form-control" placeholder="Pesquisa" aria-label="Usuário" aria-describedby="basic-addon1" id="txtBusca" >
</div>




  <?php 
 

    echo '<div class="container">';
   

  foreach($resultado as $res){
        
    if($res['SITUACAO']=='ABERTO'){
        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.$res['RESUMO'].'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-danger">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.$res['SOLICITANTE'].'</p>';
        echo  '<p class="text-secondary">'.$res['ATIVIDADE'].'</p>';
        echo  '<p class="text-secondary">'.$res['TIPO'].'</p>';
        echo  '<p class="text-secondary">'.$res['OBSERVACAO'].'</p>';
        echo '<div class="text-right"><button type="button" class="btn btn-danger btn-sm" id="excluir" value="'.$res['ID_AGENDAMENTO'].'" data-toggle="modal" data-target="#modalexcluir">Excluir</button></div>';
        echo  '</div>';
        echo  '</div>';
        echo '<p></p>';

    }

    if($res['SITUACAO']=='ANDAMENTO'){

        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.$res['RESUMO'].'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-warning">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.$res['SOLICITANTE'].'</p>';
        echo  '<p class="text-secondary">'.$res['ATIVIDADE'].'</p>';
        echo  '<p class="text-secondary">'.$res['TIPO'].'</p>';
        echo  '<p class="text-secondary">'.$res['OBSERVACAO'].'</p>';
        echo '<div class="text-right"><button type="button" class="btn btn-danger btn-sm" id="excluir" value="'.$res['ID_AGENDAMENTO'].'" data-toggle="modal" data-target="#modalexcluir">Excluir</button></div>';
        echo  '</div>';
        echo  '</div>';
        echo '<p></p>';

    };

    if($res['SITUACAO']== 'FINALIZADO'){
        
        echo  '<div class="card">';
        echo  '<div class="card-body">';
        echo  '<h5>'.$res['RESUMO'].'</h5><br>';
        echo  '<span class="font-weight-light">'.$res['RECURSO'].'</span><br>';
        echo  '<span class="font-weight-light">'.date('d-m-Y',strtotime($res['DATAC'])) .'</span><br>';
        echo  '<br>';
        echo  '<p class="text-info">'.$res['SITUACAO'].'</p>';
        echo  '<p class="text-secondary">'.$res['CONSIDERACAO'].'</p>';
        echo  '<p class="text-secondary">'.'Solicitado por: '.$res['SOLICITANTE'].'</p>';
        echo  '<p class="text-secondary">'.$res['ATIVIDADE'].'</p>';
        echo  '<p class="text-secondary">'.$res['TIPO'].'</p>';
        echo  '<p class="text-secondary">'.$res['OBSERVACAO'].'</p>';
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
        <input type="hidden" id="idAtividade">
          <div class="text-center" id="imagemlixo"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="fechar">Fechar</button>
        <button type="button" class="btn btn-danger" id="bexcluir">Excluir</button>
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 
</BODY>