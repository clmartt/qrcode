<?php
ob_start();
session_start();
$perfil = $_SESSION['perfil'];

if($perfil=="ADM"){
  $usuarioADM = "ADM";
 echo $perfil;
};



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
  var teste = '<?php echo $perfil ?>';
  if(user!="ADM"){
    $("#agend").hide();
   
  }else{
    $("#agend").show();
  };

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
      <li class="nav-item active">
        <a class="nav-link" href="addlistapredio.php">+ Ativos</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="addlistapredioativosala.php">Ativos por Sala</a>
      </li>
      <li class="nav-item active">
      <a class="nav-link" href="addlistapredioocupada.php">Sala Ocupada</a>
      </li>

      <li class="nav-item dropdown" id="agend">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Agendamento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="agendamento.php">Novo Agendamento</a>
          <a class="dropdown-item" href="admatividade.php">Ver Agendamentos</a>
          
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
</body>
</html>