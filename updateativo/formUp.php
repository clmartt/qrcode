
<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
$editarAtivo = trim($_GET['qrcode']);

if($editarAtivo == ''){
 
//recebendo do formulario os campos de login
$id = $_POST['R_id'];
$qrcode = trim(strtoupper($_POST['R_qrcode']));
$ativo = strtoupper($_POST['R_ativo']);
$caract = strtoupper($_POST['R_caract']);
$modelo =  strtoupper(utf8_encode($_POST['R_modelo']));
$marca = strtoupper(utf8_encode($_POST['R_marca']));
$predio = strtoupper(utf8_encode($_POST['R_predio']));
$sala =  strtoupper(utf8_encode($_POST['R_sala']));
$qrsala =  strtoupper($_POST['R_qrsala']);
$andar = strtoupper(utf8_encode($_POST['R_andar']));
$serie = strtoupper(utf8_encode($_POST['R_serie']));
$setor = strtoupper($_POST['R_setor']);
$horas = $_POST['R_horaLamp'];
$situacaoequi = strtoupper(utf8_encode($_POST['R_situacaoequi']));

}else{

// Definindo parametros de conexao 
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
	
	$select = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$editarAtivo'");
	$result = $select->fetchAll(PDO::FETCH_ASSOC);
	echo $result['QRCODE'];

			foreach($result as $res){

						//inserindo as informações da consulta em variaveis para que serão enviadas para o form
					$id = $res['ID_REGISTRO'];
					$qrcode = trim(strtoupper($res['QRCODE']));
					$ativo = strtoupper($res['TIPO_DE_EQUIPAMENTO']);
					$caract = strtoupper($res['CARACTERISTICA']);
					$modelo =  strtoupper(utf8_encode($res['MODELO']));
					$marca = strtoupper(utf8_encode($res['MARCA']));
					$predio = strtoupper(utf8_encode($res['PREDIO']));
					$sala =  strtoupper(utf8_encode($res['SALA']));
					$qrsala =  strtoupper($res['QRSALA']);
					$andar = strtoupper(utf8_encode($res['ANDAR']));
					$serie = strtoupper(utf8_encode($res['N_SERIE']));
					$setor = strtoupper(utf8_encode($res['SETOR']));
					$horas = $res['HORAS_LAMP'];
					$situacaoequi = strtoupper(utf8_encode($res['SITUACAO']));


			};


};



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>QRCODE KVM</title>
	
	<meta charset="utf-8"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="updateativo.php" method="post">
				<span class="contact100-form-title">
					Editar Ativo
				</span>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">ID</span>
					<input class="input100" type="text" name="id" placeholder="NÃO MEXER" value="<?php echo $id ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Qrcode</span>
					<input class="input100" type="text" name="qrcode" placeholder="Digite o Qrcode" value="<?php echo $qrcode ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Digite o nome do Ativo">
					<span class="label-input100">Nome do Ativo</span>
					<input class="input100" type="text" name="ativo" placeholder="Ex: Projetor 3600 lumens" value="<?php echo $ativo ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Digite a Característica">
					<span class="label-input100">Característica</span>
					<input class="input100" type="text" name="caract" placeholder="Ex: 42P - 2000 - LUMENS " value="<?php echo $caract ?>">
					<span class="focus-input100"></span>
				</div>



				<div class="wrap-input100 validate-input" data-validate="Qual a Modelo?">
					<span class="label-input100">Modelo</span>
					<input class="input100" type="text" name="modelo" placeholder="Ex: VPL-EX7" value="<?php echo $modelo ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Qual a Marca?">
					<span class="label-input100">Marca</span>
					<input class="input100" type="text" name="marca" placeholder="Ex: Sony" value="<?php echo $marca ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Informe o Prédio?">
					<span class="label-input100">Prédio</span>
					<input class="input100" type="text" name="predio" placeholder="Ex: CTO" value="<?php echo $predio ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Qual a Sala?">
					<span class="label-input100">Sala</span>
					<input class="input100" type="text" name="sala" placeholder="Ex: 210" value="<?php echo $sala ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="QRCODE DA SALA?">
					<span class="label-input100">Qrcode Sala</span>
					<input class="input100" type="text" name="qrsala" placeholder="Ex: IBBA98979 CTO98087" value="<?php echo $qrsala ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Informe o Andar?">
					<span class="label-input100">Andar</span>
					<input class="input100" type="text" name="andar" placeholder="Ex: Informe somente o numero, Ex: 4" value="<?php echo $andar ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Informe o Setor?">
					<span class="label-input100">Setor</span>
					<input class="input100" type="text" name="setor" placeholder="Ex: Informe somente o setor, Ex: Azul - Laranja - A - B" value="<?php echo $setor ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Informe o numero de série?">
					<span class="label-input100">Número de Série</span>
					<input class="input100" type="text" name="serie" placeholder="Ex: 105AZALPM640" value="<?php echo $serie ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Se não for um projeto digite 0">
					<span class="label-input100">Horas de Lâmpada</span>
					<input class="input100" type="text" name="horas" placeholder="Ex: Se não for um projeto digite 0" value="<?php echo $horas ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Se não for um projeto digite 0">
					<span class="label-input100">Status do Equipamento</span>
					<input class="input100" type="text" name="situacaoequi" placeholder="Ex: Defeito - Ok" value="<?php echo $situacaoequi ?>">
					<span class="focus-input100"></span>
				</div>


				<div class="container-contact100-form-btn">
					
						<button type="submit" class="btn btn-info">Pronto</button>
						
					
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
