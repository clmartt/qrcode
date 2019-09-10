
<?php

header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');



$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

// primeira forma	
$select = "SELECT * FROM login_usuario WHERE acesso = 'PENDENTE' ";
$result = $pdo->query($select);
$qtd = $result-> rowCount();




?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>

  	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>AUTORIZAR USUÁRIO</title>

	<script src="jquery-3.2.1.min.js"></script>
    <script>
    	
    	
    	$(document).ready(function(){

    		$('button').click(function(){
          	var iduser = $(this).text();
            var decidir = confirm("Ops, ainda dá tempo de voltar!, posso seguir com a autorização?");
                if(decidir){
                    alert("Pode ficar tranquilo! Já realizamos a autorização");
                    window.location.replace("updateuser.php?id_user="+iduser);

                  }else{


                    alert("Ok, o usuário não será autorizado!");
                    $(this).attr('class','btn btn-danger');
                  }
          	
                       
        	});


    	});

    </script>



  </head>
  <body>
   <div class="card">
  <div class="card-header">
    <button type="button" class="btn btn-primary" disabled>
  Aguardando aprovação  <span class="badge badge-light"><?PHP echo $qtd ?></span>
</button>
  </div>
 
    <?PHP 

    foreach ($result as $linha) {
    
    	echo '<div class="card">';
      echo ' <div class="card-body">';
    	echo '<h5 class="card-title"> <button class="btn btn-primary" >'.$linha['id_user'].'</button> - : '.$linha['nome'].'</B></h5>'.'Solicita acesso ao sistema com o e-mail : '.'<b>'.$linha['email'].'</b>';
    	
    	
    	echo '</div>';
    	echo '</div>';

     ?>
    


<?php
};
?>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>