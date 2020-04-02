<?php
include("./conectar.php");

ob_start();
session_start();
$mail = $_SESSION['email'];
$cliente = $_SESSION['cliente'];
if($mail == ''){
    header("Location : ./login.html");
    
}

?>






<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Atividades Agendadas</title>

    <script src="jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){

             // esconde das divs do modal
                $('#situ').hide();
                $('#textobserv').hide();
                // quando o select muda para finalizado mostra as divs acima que foram escondidas
                $("#statussituacao").change(function(){
                    var texto = $(this).val();
                    if(texto == 'FINALIZADO'){
                        $('#situ').fadeIn();
                        $('#textobserv').fadeIn();

                    }else{

                        $('#situ').hide();
                        $('#textobserv').hide();
                    }
                });

                // buscas as atividades e mostra na div retorno            
            $("#buscar").click(function(){
                $("#retorno").empty();
                
                var load = '<div class="text-center"><img src="./images/ajax.gif"></div>';
                var ativ = $("#atividade option:selected").val();
                var sit = $("#situacao option:selected").val();
                var usuario = '<?php echo $mail ?>';
                var cliente = '<?php echo $cliente ?>';

                $("#retorno").append(load);


                $.post('buscaAtividade.php',{atividade:ativ,situacao:sit,usuarios:usuario,clientes:cliente},function(data){
                    $("#retorno").empty();
                    $("#retorno").append(data);
                    
                });
            });

            // faz a pesquisa quando vc digita no campo Pesquisar
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

            // pega os botoes gerados dinamicamente (aberto- andamento- finalizado)
            $(document).on('click','#status',function(){
                $("#gravar").text("Salvar");
                var agendId = $(this).val();// guarda o value do botao(id_agen)
                $("#numero_id").val(agendId); // inseri dentro de um hidden no modal o valor do ID_AGEN
                $("#exampleModal").modal("show");
            });


            $("#gravar").click(function(){
                var pegaId = $("#numero_id").val();
                var pegaSituacao = $("#statussituacao option:selected").val();
                var pegaFeed = $("#feedback option:selected").val();
                var obs = $("#obs").val();
                var user = '<?php echo $_SESSION['email'] ?>';

                

      
               $.post('updateAtividades.php',{idAtividade:pegaId,txtSituacao:pegaSituacao,feedback:pegaFeed,obs:obs,user:user},function(data) {
                            $("#gravar").off();
                            $("#gravar").html("<img src='./images/enviado.gif' width='30' heigth='30'>");
                            $("#buscar").trigger('click');               
                           
                           //window.location.reload();// da refresh na pagina depois do retorno da pagina de update
                           

                });
                
               
  });









        });


    </script>
  
</head>
  <body>

  <nav class="navbar fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="./principal.php">
        Retornar
    </a>
  </nav>




      <br>
      <br>
      <br>
      <br>
     
     

            <div class="container ">
                          
                <h5>Atividades Agendadas - <?php echo date('d-m-Y') ?></h5>
                
               
               
                <div class="row ">
                    <div class="col">
                            <select class="custom-select custom-select-sm" id="atividade">
                                    <option selected>Atividades</option>
                                    <option value="Minhas">Minhas</option>
                                    <option value="Todos">Todos</option>
                                    
                            </select>
                    </div>
                    <p></p>

                    <div class="col">
                            <select class="custom-select custom-select-sm" id="situacao">
                                    <option selected>Status</option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="Andamento">Andamento</option>
                                    <option value="Finalizado">Finalizado</option>
                            </select>
                    
                   </div>

                   <div class="col">
                        <button type="button" class="btn btn-outline-info btn-sm" id="buscar">Buscar</button>
                   </div>
            
         
                   
            </div>
            <hr>
            
            <div class="container">     
                    
            <p></p>
            
                            <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Pesquisa</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="txtBusca">
                            </div>
                            
                    <p></p>
             </div>

            <div class="container" id="retorno">
                

            </div>


                
               
            
            
        
            




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
                                            <select class="custom-select" name="statussituacao" id="statussituacao">
                                                
                                                <option selected value="ABERTO">ABERTO</option>
                                                <option value="ANDAMENTO">ANDAMENTO</option>
                                                <option value="FINALIZADO">FINALIZADO</option>
                                            </select>
                                </div>
                                <div class="input-group mb-3" id="situ">
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


  </body>
</html>