<?php
ob_start();
session_start();
$perfil = $_SESSION['perfil'];
$cliente = $_SESSION['cliente'];
$permissao = $_SESSION['permissao'];


if($perfil=="ADM"){
  $usuarioADM = "ADM";
 echo $perfil;
};

include('conectar.php');

if($permissao=='KVM'){
  $sql = $pdo->query("SELECT CLIENTE FROM QRCODETABLE WHERE CLIENTE!= 'EVENTOS' GROUP BY CLIENTE");
}else{
  $sql = $pdo->query("SELECT CLIENTE FROM QRCODETABLE WHERE CLIENTE!= 'EVENTOS' AND CLIENTE = '$permissao' GROUP BY CLIENTE");

}


?>

<html lang="en">
<head>
	<title>KVM INFORMATICA - QR CODE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


<script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
<script src="jquery-3.2.1.min.js"></script>



<script>
$(document).ready(function(){

  var user = '<?php echo $usuarioADM ?>';
  var perfil = '<?php echo $perfil ?>';
  
  if(perfil!="ADM"){
    $("#agendamento").hide();
    $("#convite").hide();
   
  }else{
    $("#agendamento").show();
    $("#convite").show();
  };


// abre  modal
  $('#convidar').click(function(){
    event.preventDefault();
    $("#resposta").empty();
    
    $('#modalExemplo').modal('show');
  });


  $("#enviar").click(function(){

          var emails = $("#email").val();
          var clientes = $("#cliente").val();
          var perfils = $("#perfil").val();
          $('#resposta').append("Enviado ......");

         

          $.post('./emailconvite/emailConvite.php',{email:emails,cliente:clientes,perfil:perfils},function(data){
            $("#resposta").empty();
            $("#resposta").append("<img src='./images/joia.gif' width='200' heigth='200'>");
           



          });




  });


});

</script>

</head>
<body>

<nav class="navbar  navbar-expand-lg navbar-light ">
<a class="navbar-brand" href="principal.php">
    <img src="./images/logo.gif" width="30" height="30" class="d-inline-block align-top" alt="">
    ReQuest
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

    <li class="nav-item dropdown" id="agend">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ativos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="nav-link" href="addlistapredio.php">Novo Ativos</span></a>
        <a class="nav-link" href="addlistapredioativosala.php">Ativos por Sala</a>
        <a class="nav-link" href="ativoManutencao.php">Em Manutenção</a>
          
      </li>

     
      <li class="nav-item active">
      <a class="nav-link" href="addlistapredioocupada.php">Sala Ocupada</a>
      </li>

      <li class="nav-item dropdown" id="agendamento">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Agendamento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="agendamento.php">Novo Agendamento</a>
          <a class="dropdown-item" href="admatividade.php">Ver Agendamentos</a>
          
      </li>

      <li class="nav-item active" id="convite">
      <a class="nav-link" href="" id="convidar" >Convidar</a>
      </li>

      <form class="form-inline my-2 my-lg-0" method="get" action="./ativosSala/ativodetalhe.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar QRCODE" aria-label="Pesquisar" name='qrcode'>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
      
    </ul>
  </div>
</nav>


	


	<div>
			<nav class="navbar fixed-bottom  navbar-dark bg-light">
			<a href="atividades.php" ><ion-icon src="./icon/md-today.svg"  size="large" class="text-secondary" ></ion-icon></a>
			<a href="listapredioChamado.php"><ion-icon src="./icon/md-information-circle-outline.svg"  size="large" class="text-secondary"></ion-icon></a>
			<a href="./cameras.php"><ion-icon src="./icon/ios-videocam.svg"  size="large" class="text-secondary"></ion-icon></a>
			<a href="listapredioProblema.php"><ion-icon src="./icon/md-podium.svg"  size="large" class="text-secondary"></ion-icon></a>
			<a href="download.php"><ion-icon src="./icon/md-cloud-download.svg"  size="large"  class="text-secondary"></ion-icon></a>
			</nav>
  </div>
  


    <!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Convite para novo Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                          <form method="POST" action="./emailconvite/emailConvite.php">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Endereço de email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email" name="email">
                        <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                      </div>

                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Cliente</label>
                          <select class="form-control" id="cliente" name="cliente">
                                    <?php  
                                    foreach ($sql as $res) {
                                      echo "<option value='".$res['CLIENTE']."'>".$res['CLIENTE']."</option>";
                                    }
                                    
                                    ?>
                          </select>
                       </div>

                       <div class="form-group">
                          <label for="exampleFormControlSelect1">Perfil</label>
                          <select class="form-control" id="perfil" name="perfil">
                            <option value="ADM">ADM</option>
                            <option value="TECNICO">TECNICO</option>
                            
                          </select>
                      </div>
                      <div class="text-center"> <span id="resposta"></span></div>


                                                          
                     
                    
      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="button" class="btn btn-primary" id="enviar">Enviar</button>
                      </div>
                      </form>
    </div>
  </div>
</div>





</body>
</html>