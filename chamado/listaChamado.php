
<?php
ob_start();
session_start(); //pega a sessao do usuario
$email = $_SESSION['email'];
if($_SESSION['email']==""){
  header("Location: ../login.html");

}

// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$logado = strtoupper($_SESSION['email']); // guardando usuario logado na variavel
$predio  = $_GET['predio'];


//conexao com banco de dadso

include("../conectar.php");


// primeira forma	
$select = "SELECT * FROM CHAMADOS WHERE status = 'ANDAMENTO' AND PREDIO = '$predio' AND CLIENTE != 'EVENTOS' order by id_chamado asc"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query




?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>

  	
   
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CHAMADOS EM ANDAMENTO</title>
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

	<script src="jquery-3.2.1.min.js"></script>
    <script>
    	
    	
      

      // QUANDO CLICAR NO BOTAO QUE TEM O NUMERO DO CHAMADO 
      $(document).on('click','#nChamado',function(){
            var idchamado = $(this).text(); // PEGA O TEXTO DO BOTAO
            var qr = $(this).val(); // PEGA O QRCODE DO BOTA
            var usuariologado = "<?php echo $logado; ?>";// PEGA O USUARIO LOGADO (EMAIL)
            var vpredio = "<?php echo $predio; ?>";// PEGA O PREDIO
            var fechar = confirm("Deseja fechar o Chamado?"); // ABRE UMA JANELA DE CONFIRMAÇÃO
            if(fechar){ 
             var solucao = prompt("Informe a Solução aplicada para o Fechamento"); // guarda a solução 
            }
           
            if(solucao != null){ // confirmado executa os comando abaixo
              
             
              alert("Chamado RESOLVIDO por :"+"<?php echo $logado; ?>");// mostra a confirmação do fechamento
              window.location.replace("updatechamado.php?id_do_chamado="+idchamado+"&logado="+usuariologado+"&solucao="+solucao+"&predio="+vpredio+"&qrcode="+qr);// envia as variaveis para a pagina de update
            }

      });

      // QUANDO CLICAR NO BOTAO DE COMENTAR 
      $(document).on('click','#comentar',function(){
        var id_chamado = $(this).text(); // PEGAR O ID DO CHAMADO 
        $("#postar").show();
        $("#text_idChamado").empty();// LIMPA O IMPUT
        $("#titulo").val("");// LIMPA O IMPUT
        $("#postComentarios").val("");// LIMPA O IMPUT
        $("#text_idChamado").val(id_chamado);// INSERI O ID DENTRO DO IMPUT
        

      });


      // QUANDO CLICAR NO BOTAO DE VER POST
      $(document).on('click','#verPost',function(){
        var idchamados = $(this).text();
        $.post('listaPostChamado.php',{idchamado:idchamados},function(data){

         
          $("#body-post").html(data);

        });
       

      });


      // QUANDO CLICAR NO BOTAO POSTAR 
      $(document).on('click','#postar',function(){
        
        var id_Chamado = $("#text_idChamado").val();
        var titulo = $("#titulo").val();
        var comentario = $("#postComentarios").val();
        var email = '<?php echo $email ?>';
        
        $.post('postchamado.php',{idchamados:id_Chamado,titulos:titulo,comentarios:comentario,emails:email},function(data){
                  alert(data);
                  $("#postar").fadeOut();

        });
        

      });





    </script>



  </head>
  <body>


    <nav class="navbar fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/listapredioChamado.php">
       
        Retornar &nbsp&nbsp&nbsp&nbsp
         <button type="button" class="btn btn-primary" disabled>
            Chamados em Andamento  <span class="badge badge-light"><?PHP echo $qtd ?></span>
          </button>
      </a>
     
    </nav>
  


  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
 
    <?PHP 

    echo "</br>";
    echo "</br>";
    
    echo '<div class= "container">';

    foreach ($result as $linha) {
    $datahoje = date('Y-m-d'); // converte a data de hoje para o padrao ano - mes - dia
    $dataChamado = $linha['data_2']; // pega a data do chamado retornada do banco de dados
    $data1 = date_create($datahoje); // converte em data
    $data2 = date_create($dataChamado);// converte em data
    $dif = date_diff($data2,$data1); // calcula a diferença entre as datas
    $dias = $dif->format('%a'); // formata em numero o resultado da diferença
    echo  "</br>";
    

    

    // formata os chamados em vermelho caso maior que 10 dias em aberto e em azul menor

    if($dias >= 10){
    	echo '<div class="card">';
      echo ' <div class="card-body">';
    	echo '<h5 class="card-title"> <button class="btn btn-danger" id="nChamado" value="'.$linha['qrcode'].'">'.$linha['id_chamado'].'</button> -  '.$linha['qrcode'].'    </h5>'.'Aberto: '.'<b>'.
      date("d/m/Y",strtotime($linha['data_2'])).' - '.$dias.' dias em aberto'.'</b>'."<br> Ativo : ".$linha['ativo']."<br> Predio: ".$linha['predio']." - Andar: ".$linha['andar']." - Sala: ".$linha['sala'];
    	
      echo '<p class="font-italic">'.'Chamado aberto pelo <b>'.$linha['nome_user'].'</b> com o Problema: <i>('.$linha['observacao'].')</i> seu status é  : '.$linha['status'].'</p>';
      echo '<div class="text-center">';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#comentario"><ion-icon src="../icon/chatbubble-ellipses.svg" size="large" class="text-secondary" id="comentar">'.$linha['id_chamado'].'</ion-icon></a>';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#posts"><ion-icon src="../icon/ios-eye.svg" size="large" class="text-secondary" id="verPost">'.$linha['id_chamado'].'</ion-icon></a>'; 
      echo '</div>';
    	echo '</div>';
      echo '</div>';
      

    }else{

      echo '<div class="card">';
      echo ' <div class="card-body">';
      echo '<h5 class="card-title"> <button class="btn btn-info" id="nChamado" value="'.$linha['qrcode'].'">'.$linha['id_chamado'].'</button> -  '.$linha['qrcode'].'    </h5>'.'Aberto :'.'<b>'.
      date("d/m/Y",strtotime($linha['data_2'])).' - '.$dias.' dias em aberto'.'</b>'."<br> Ativo : ".$linha['ativo']."<br> Predio: ".$linha['predio']." - Andar: ".$linha['andar']." - Sala: ".$linha['sala'];
      
      echo '<p class="font-italic">'.'Chamado aberto pelo <b>'.$linha['nome_user'].'</b> com o Problema: <i>('.$linha['observacao'].')</i> seu status é  : '.$linha['status'].'</p>';
      echo '<div class="text-center">';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#comentario"><ion-icon src="../icon/chatbubble-ellipses.svg" size="large" class="text-secondary" id="comentar">'.$linha['id_chamado'].'</ion-icon></a>';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#posts"><ion-icon src="../icon/ios-eye.svg" size="large" class="text-secondary" id="verPost">'.$linha['id_chamado'].'</ion-icon></a>'; 
      echo '</div>';
      echo '</div>';
      echo '</div>';
      



    };
     
     


     ?>
    


<?php
};
echo '</div>';
?>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- Modal -->
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
        <button type="button" class="btn btn-primary" id="postar">POSTAR</button>
      </div>
    </div>
  </div>
</div>




 <!-- Modal -->
 <div class="modal fade" id="posts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Chamados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="body-post">
                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>







  </body>
</html>