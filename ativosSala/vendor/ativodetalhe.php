

<?php

ob_start();
session_start();
$logado = $_GET['usuario'];
$usuario = $_SESSION['email'];
$cliente = $_SESSION['cliente'];
$qrcode = $_GET['qrcode'];


if(isset($_GET['obs'])){
    $retornoobs = $_GET['obs'];
}else{
  $retornoobs = "";
};


include('../conectar.php');


$result  = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE='$qrcode' ");

// faz o select dos chamados

$selectcheck = "SELECT DATA_2 FROM TABLE_CHECK where QRCODE = '$qrcode' ";
$resultcheck = $pdo->query($selectcheck);

$selectchamado = "SELECT * FROM CHAMADOS where QRCODE = '$qrcode' ";
$resultchamado = $pdo->query($selectchamado);


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>DETALHES ATIVO</title>
	 <script src="jquery-3.2.1.min.js"></script>
   <script type="text/javascript">

           $(document).on('click','#chamados',function(){
           
         
            $("#formchamado").show();
            $('#titulochamado').empty();
            

            var qr = $(this).val();
            $('#titulochamado').append($(this).val());
            $('#qrcode').val(qr);

           });
  

  $(document).ready(function(){
    // faz o update da hora de lampadas ------------------------------------------------------------
          $("#uphora").click(function(){
                    var qrcodes = $(this).val();
                    var hAtual = $(this).text();

                    var horaNova = prompt("Digite o valor da hora!");

                            if($.isNumeric(horaNova)){

                              $.post('../IOS/misc/examples/updatehoras.php', 
                                      { vhora_nova: horaNova, vn_qrcode:qrcodes},
                                      function(data) {

                                          
                                          window.location.reload();
                                          
                                      });
                                      
                            }else{
                              alert("Ops! Parece que os valores que você inserir não são numericos....:(")

                            }
            
          });

          // faz o check do equipamento

          $("#checar").click(function(){
            var qrcode = $(this).val();
            var usuarios = '<?php echo $usuario ?>';
            var desc = '<?php echo $retornoobs?>';

                            if(desc==""){
                                    var statuschamado = 'OK';
                                   // alert(desc);
                                   // alert(statuschamado);
                            }else{
                                    var statuschamado = "Problema";
                                    $("#descricao").append(statuschamado).addClass('text-danger');
                            };


                $("#load").append("<img src='../images/ajax.gif' width='30px' height='30px'>");
                $.post('checkativo.php',{qrcode:qrcode,usuario:usuarios,descs:desc,stats:statuschamado},function(data){
                  
                      if(data){
                        $("#load").empty();
                        $("#load").append("<img src='../images/enviado.gif' width='30px' height='30px'>");
                        $("#checar").addClass("btn btn-info");
                        $("#checar").text("Checado!");
                        $("#checar").off();

                      }
                  

                  });

             

          });


         

          
  });


           
</script>

</head>

  <body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="../principal.php">
      Retornar <?php echo $usuario ?>
    </a>
  </nav>

 <p></p>

 <?php

    $dataarray = array();
    foreach ($resultcheck as $rescheck) {
    array_push($dataarray,$rescheck['DATA_2']);
    };

 foreach ($result as $resultado) {
  echo '<div class="container">';  
  echo '<div class="card">';
  echo '<div class="card-header" style:"display: inline-block">';
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
  echo '<a class="navbar-brand" href="#"><h5>'.$resultado["QRCODE"].'</h5><span id="load"></span></a>';
  echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#textoNavbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Alterna navegação">';
  echo '  <span class="navbar-toggler-icon"></span>';
  echo '</button>';
  echo '<div class="collapse navbar-collapse" id="textoNavbar">';
  echo '  <ul class="navbar-nav mr-auto">';
  echo '    <li class="nav-item active">';
  echo '      <a class="btn btn-link" href="../updateativo/formUp.php?qrcode='.$resultado["QRCODE"].'">Editar </a>';
  echo '    </li>';
  echo '    <li class="nav-item active">';
  echo '      <button id="chamados" class="btn btn-link" data-toggle="modal" data-target="#chamado" value="'.$resultado["QRCODE"].'">Chamados</button>';
  echo '    </li>';
  echo '    <li class="nav-item active">';
  echo '      <a id="preventivas" class="btn btn-link" href="formPreventiva.php?qrcode='.$resultado["QRCODE"].'">Preventiva</a>';
  echo '    </li>';
  echo '    <li class="nav-item active">';
  echo '      <a class="btn btn-link" href="formManu.php?qrcode='.$resultado["QRCODE"].'">Manutenção</a>';
  echo '    </li>';
  echo '  </ul>';
  echo '</div>';
  echo '</nav>';
  echo '</div>';
  echo '<div class="card-body">';
  
  echo '<p class="card-text">PREDIO : '.$resultado["PREDIO"].' - '.'ANDAR : '.$resultado["ANDAR"].'  <br> SETOR : '.$resultado["SETOR"].' - SALA : '.$resultado["SALA"].'</p>';
   echo '<p class="card-text">'.$resultado["TIPO_DE_EQUIPAMENTO"].' - CARACTERISTICA : '.$resultado["CARACTERISTICA"].'<BR>HORAS LAMP : <button class="btn btn-outline-info" value="'.$resultado["QRCODE"].'" id="uphora">'.$resultado["HORAS_LAMP"].'</button><BR>MARCA : '.$resultado["MARCA"].' <br> MODELO : '.$resultado["MODELO"].'<BR>N_SERIE : '.$resultado["N_SERIE"].'</p>';
   echo '<p>'.$resultado["SITUACAO"].'</p>';
   echo '<div class="text-center"><button type="button" class="btn btn-success" value="'.$resultado["QRCODE"].'" id="checar">Pronto!</button></div>';
   echo '<div id="descricao"></div>';
   echo '<p id="statuschamado"></p>';
   echo '<div class="card-footer text-center">';
   echo 'Ultimo Check List : '.date("d/m/Y", strtotime(array_pop($dataarray)));
   echo '</div>';
  
  
  echo '</div>';
  echo '</div>';
  echo '</div>';
 };


  

?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>












 
<!-- Modal CHAMADO -->
<div class="modal fade" id="chamado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulochamado"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <div id='formchamado'>
                              <form method="POST" action="guardachamado.php">
                                <input type="hidden" id="usuario" value="<?php echo $usuario?>" name="usuario_post">
                                <input type="hidden" id="cliente" value="<?php echo $cliente?>">
                                <input type="hidden" id="qrcode" name="qrcode">
                              <div class="form-group">
                                
                                <label for="exampleFormControlSelect1">Problema</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="problema">
                                  <option value='ÁUDIO'>Áudio</option>
                                  <option value='VÍDEO'>Vídeo</option>
                                  <option value='AUTOMAÇÃO'>Automação</option>
                                  <option value='VGA'>VGA</option>
                                  <option value='TELA'>Tela</option>
                                  <option value='CONTROLE'>Controle</option>
                                  <option value='SENSOR'>Sensor</option>
                                  <option value='ADAPTADOR'>Adaptador</option>
                                  <option value='OUTROS'>Outros</option>
                                </select>
                                
                              </div>
                              <div class="form-group">
                              <label for="exampleFormControlTextarea1">Descrição do Problema</label>
                              <textarea class="form-control" rows="5" name="obs" id="obs"></textarea>
                              </div>
                              
                              <div class="form-group">
                                
                                <label for="exampleFormControlSelect2">Status</label>
                                <select class="form-control"  name="statusChamado" id="statusChamado">
                                  <option>Andamento</option>
                                  <option>Resolvido</option>
                                  
                                </select>
                                <br>
                                <div class="form-group">
                                <label for="solucao_aplicada">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" rows="5" name="solicitante">
                                </div>
                                <br>
                                <br>
                                <div class="form-group">
                                <label for="solucao_aplicada">Solução aplicada</label>
                                <textarea class="form-control" id="solucao_aplicada" rows="5" name="solucao"></textarea>
                                </div>
                                <br>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                  <button type="submit" class="btn btn-primary" id="enviando">Enviar</button>
                                </div>
                              </form>
                      </div>


      </div>

   </div>
  </div>
</div>





</body>


</html>