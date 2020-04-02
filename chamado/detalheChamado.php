<?php
ob_start();
session_start(); //pega a sessao do usuario
$email = $_SESSION['email'];
if($email==""){
    header("Location: ../login.html");
  
  }
    
include("../conectar.php");
$idChamado = $_GET['idChamado'];

$sql = $pdo->query("SELECT * FROM CHAMADOS WHERE id_chamado = '$idChamado'")->fetch();// seleciona o chamado pelo id

$postado = $pdo->query("SELECT * FROM POST_CHAMADOS WHERE ID_CHAMADO = '$idChamado' ORDER BY DATA_POST,HORA_POST DESC"); // pega os posts do chamado pelo id

?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Detalhes do Chamado</title>
    <style>
        

    </style>
    <script src="jquery-3.2.1.min.js"></script>

    <script>


        $(document).on('click','#excluirPost',function(){
            var confirmar  = confirm("Deseja excluir o Post?");
            if(confirmar){
                var idPost = $(this).val();
                $.post('apagaPost.php',{idPost:idPost},function(data){
                    location.reload();
                });
            }


        });

        $(document).on('click','#responder',function(){
            var idPost = $(this).val();
            $("#recebeIdPost").empty();
            $("#txtResposta").val("");
            $("#recebeIdPost").val(idPost);
            
            $("#respostas").modal("show");
        });

///////////////////////////BOTAO MOSTRAR RESPOSTAS/////////////////////////////////////////////////////
        $(document).on('click','#mostraRespostas',function(){
              var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
              $(this).closest('div > #postado').children().children('#recebeRespostas').empty();
              $(this).closest('div > #postado').children().children('#recebeRespostas').append(load);
              var idPost = $(this).val();
              var ele = $(this);
                // $(this).closest('div > #postado').children().children('#recebeRespostas').append('carregou');
                $.post('getResposta.php',{idPost:idPost},function(data){
                    ele.closest('div > #postado').children().children('#recebeRespostas').empty();
                    ele.closest('div > #postado').children().children('#recebeRespostas').append(data);
                  });
              

        });




//////////////////////////////////////////////////////////////////////////////////////////////////////

        $(document).ready(function(){
            var pagina = '../listapredioChamado.php';
            $("#voltar").attr('href',pagina);
            $("#criarPost").click(function(){
                var idChamado = $(this).val();
                $("#titulo").val("");// LIMPA O IMPUT
                $("#postComentarios").val("");// LIMPA O IMPUT
                $("#text_idChamado").val(idChamado);
                $("#comentario").modal("show");

            });// criar post

            $("#postar").click(function(){
                var id_Chamado = $("#text_idChamado").val();
                var titulo = $("#titulo").val();
                var comentario = $("#postComentarios").val();
                var email = '<?php echo $email ?>';
        
                $.post('postchamado.php',{idchamados:id_Chamado,titulos:titulo,comentarios:comentario,emails:email},function(data){
                        location.reload();
                        $("#postar").fadeOut();

                });
                
            });


            $("#fechaChamado").click(function(){
                var idChamado = $(this).val();
                var email = '<?php echo $email ?>';
                var qrcodeAtivo = '<?php echo $sql['qrcode']?>';
                var fechar = confirm("Deseja fechar o Chamado?");
                if(fechar){
                    var solucao = prompt("Informe a Solução aplicada para o Fechamento"); // guarda a solução 
                    var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
                    $("#resposta").append(load);
                    $.post('updatechamado.php',{id_do_chamado:idChamado,logado:email,solucao:solucao,qrcode:qrcodeAtivo},function(){
                        
                        location.reload();
                    });
                }
                

            });

            $("#ResponderPost").click(function(){
                var usuario = '<?php echo $email ?>';
                var idPost = $("#recebeIdPost").val();
                var resposta = $("#txtResposta").val();
                alert(idPost);

                $.post('insertResposta.php',{usuario:usuario,idPost:idPost,resposta:resposta},function(data){
                  $("#ResponderPost").fadeOut();
                  location.reload();
                });

            });



        
        
        });//document
    </script>
   
  </head>
  <body>

  <nav class="navbar fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#" id="voltar">
        
            Retornar
            
        </a>
        
    </nav>
  
   

    <div class="container">
        <br>
        <br>
        <br>
        


    <h5>Detalhes do Chamado</h5>
    <br>
    
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-header">
          <?php echo '<button type="button" class="btn btn-link">'.$sql['id_chamado'].'</button>'. " | Aberto em : ".date("d-m-Y", strtotime($sql['data_2']))?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $sql['problema']?></h5>
            <p class="card-subtitle mb-2 text-muted"><?php echo "Predio : ".$sql['predio']." - "."Andar : ".$sql['andar']." - "."Sala : ".$sql['sala']?></p>
            <p class="card-subtitle mb-2 text-muted"><?php echo "Qrcode : ".$sql['qrcode']." - "."Ativo : ".$sql['ativo']." - "."Marca : ".$sql['marca']?></p>
            <p class="card-subtitle mb-2 text-muted"><?php echo "Técnico : ".$sql['nome_user'] ?></p>
            <p class="card-subtitle mb-2 text-muted"><?php echo "Status : ".$sql['status'] ?></p>
            
                        <div class="jumbotron jumbotron-fluid" id="desc">
                        <div class="container">
                        <p class="card-text"><?php echo $sql['observacao'] ?></p>
                        </div>
                        </div>
            
            <div class="text-center"><button  class="btn btn-primary" style="margin: 0 20px" id="criarPost"  value="<?php echo $idChamado ?>">Criar Post</button><button  class="btn btn-danger" id="fechaChamado" value="<?php echo $idChamado?>">Fechar</button></div>
        </div>
        <div class="text-center" id="resposta"></div>

        
    </div>
    <?php
    foreach ($postado as $p) {
        echo '<div class="card shadow-sm p-3 mb-5 bg-white rounded" id="postado">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$p['TITULO'].'</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">'.$p['USUARIO'].'</h6>';
        echo ' <p class="card-text">'.$p['DESCRICAO'].'</p>';
        echo ' <p class="card-text">'.date("d-m-Y",strtotime($p['DATA_POST'])).' - '.date("H:i:s",strtotime($p['HORA_POST'])).'</p>';

        echo ' <button class="btn btn-info" id="responder" value="'.$p['ID_POST'].'" style="margin: 0 25px">Responder</button><button class="btn btn-danger" id="excluirPost" value="'.$p['ID_POST'].'">Excluir</button>';
        echo '<br>';
        echo '<div class="text-right" ><button class="btn btn-link" id="mostraRespostas" value="'.$p['ID_POST'].'"> Respostas</button></div>';
        echo '<div id="recebeRespostas" ></div>';
        echo '<br>';
        echo '</div>';
        echo '</div>';
    }
    
    ?>
    <p></p>
    <p></p>



    
    </div>




    <!-- Modal --------------------------------------------------------------------------------------------------->
    <div class="modal fade" id="comentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Comentário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <form>
                  <div class="form-group">
                        <label for="text_idChamado">Id Chamado</label>
                        <input type="text" class="form-control" id="text_idChamado" aria-describedby="ID Chamado" placeholder="text_idChamado" name="text_idChamado" readonly>
                       
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Título</label>
                        <input type="text" class="form-control" id="titulo" aria-describedby="titulo" placeholder="Ex: Enviado para manutenção">
                        <small id="titulo_legend" class="form-text text-muted">Isso é importante viu!.</small>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Descrição</label>
                        <textarea class="form-control" id="postComentarios" rows="5"></textarea>
                      </div>
                                            
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="postar">Postar</button>
      </div>
    </div>
  </div>
</div>



 <!-- Modal respostas --------------------------------------------------------------------------------------------------->
 <div class="modal fade" id="respostas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Responder Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <form>
                    <input type="hidden" id="recebeIdPost">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Responder Post</label>
                        <textarea class="form-control" id="txtResposta" rows="5"></textarea>
                      </div>
                                            
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="ResponderPost">Postar</button>
      </div>
    </div>
  </div>
</div>












    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>