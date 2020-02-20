
<?php
ob_start();
session_start(); //pega a sessao do usuario


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
    	
    	
    	$(document).ready(function(){


    		$('button').click(function(){
          	var idchamado = $(this).text();
            var usuariologado = "<?php echo $logado; ?>";
            var vpredio = "<?php echo $predio; ?>";
            var fechar = confirm("Deseja fechar o Chamado?");
            if(fechar){
             var solucao = prompt("Informe a Solução aplicada para o Fechamento"); // guarda a solução 
            }
           
            if(solucao != null){ // confirmado executa os comando abaixo
              
             
              alert("Chamado RESOLVIDO por :"+"<?php echo $logado; ?>");// mostra a confirmação do fechamento
              window.location.replace("updatechamado.php?id_do_chamado="+idchamado+"&logado="+usuariologado+"&solucao="+solucao+"&predio="+vpredio);// envia as variaveis para a pagina de update
            }
            
                       
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
    	echo '<h5 class="card-title"> <button class="btn btn-danger" >'.$linha['id_chamado'].'</button> -  '.$linha['qrcode'].'    </h5>'.'Aberto: '.'<b>'.
      date("d/m/Y",strtotime($linha['data_2'])).' - '.$dias.' dias em aberto'.'</b>'."<br> Ativo : ".$linha['ativo']."<br> Predio: ".$linha['predio']." - Andar: ".$linha['andar']." - Sala: ".$linha['sala'];
    	
      echo '<p class="font-italic">'.'Chamado aberto pelo <b>'.$linha['nome_user'].'</b> com o Problema: <i>('.$linha['observacao'].')</i> seu status é  : '.$linha['status'].'</p>';
      echo '<div class="text-center">';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#comentario"><ion-icon src="../icon/chatbubble-ellipses.svg" size="large" class="text-secondary"></ion-icon></a>';
      echo '<a href="#" class="card-link"><ion-icon src="../icon/ios-eye.svg" size="large" class="text-secondary"></ion-icon></a>'; 
      echo '</div>';
    	echo '</div>';
      echo '</div>';
      

    }else{

      echo '<div class="card">';
      echo ' <div class="card-body">';
      echo '<h5 class="card-title"> <button class="btn btn-info" >'.$linha['id_chamado'].'</button> -  '.$linha['qrcode'].'    </h5>'.'Aberto :'.'<b>'.
      date("d/m/Y",strtotime($linha['data_2'])).' - '.$dias.' dias em aberto'.'</b>'."<br> Ativo : ".$linha['ativo']."<br> Predio: ".$linha['predio']." - Andar: ".$linha['andar']." - Sala: ".$linha['sala'];
      
      echo '<p class="font-italic">'.'Chamado aberto pelo <b>'.$linha['nome_user'].'</b> com o Problema: <i>('.$linha['observacao'].')</i> seu status é  : '.$linha['status'].'</p>';
      echo '<div class="text-center">';
      echo '<a href="#" class="card-link" data-toggle="modal" data-target="#comentario"><ion-icon src="../icon/chatbubble-ellipses.svg" size="large" class="text-secondary"></ion-icon></a>';
      echo '<a href="#" class="card-link"><ion-icon src="../icon/ios-eye.svg" size="large" class="text-secondary"></ion-icon></a>'; 
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- Modal -->
<div class="modal fade" id="comentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>