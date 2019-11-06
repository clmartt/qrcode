<?php
ob_start();
session_start(); //pega a sessao do usuario
$cliente = $_SESSION['cliente'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>QRCODE KVM</title>
	<meta charset="UTF-8">
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
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="https://kvm1000.websiteseguro.com/qrteste2/principal.php">
   
    Retornar
  </a>
</nav>

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="insertativo.php" method="POST">
				<span class="contact100-form-title">
					Novo Ativo
				</span>
				<input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente ?>">
				<div class="wrap-input100 validate-input">
					<span class="label-input100">Qrcode</span>
					<input class="input100" type="text" name="qrcode" placeholder="Digite o Qrcode" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Digite o tipo do equipamento">
					<span class="label-input100">Tipo de equipamento</span>
					<input class="input100" type="text" name="ativo" placeholder="Ex: PROJETOR  - TV" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Digite a caracteristica">
					<span class="label-input100">Característica</span>
					<input class="input100" type="text" name="caract" placeholder="Ex:42 - 2000 lumens" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Qual a Modelo?">
					<span class="label-input100">Modelo</span>
					<input class="input100" type="text" name="modelo" placeholder="Ex: VPL-EX7" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Qual a Marca?">
					<span class="label-input100">Marca</span>
					<input class="input100" type="text" name="marca" placeholder="Ex: Sony" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Informe o Prédio?">
					<span class="label-input100">Prédio</span>
					<input class="input100" type="text" name="predio" placeholder="Ex: CTO" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Informe o Andar?">
					<span class="label-input100">Andar</span>
					<input class="input100" type="text" name="andar" placeholder="Ex: Informe somente o numero, Ex: 4" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Informe o Setor?">
					<span class="label-input100">Setor</span>
					<input class="input100" type="text" name="setor" placeholder="Ex: Informe o setor Ex: LARANJA" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Qual a Sala?">
					<span class="label-input100">Sala</span>
					<input class="input100" type="text" name="sala" placeholder="Ex: 210" required="">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="QRCODE DA SALA?">
					<span class="label-input100">Qrcode Sala</span>
					<input class="input100" type="text" name="qrsala" placeholder="Ex: IBBA09878 - CTO66757" required="">
					<span class="focus-input100"></span>
				</div>
				

				<div class="wrap-input100 validate-input" data-validate="Informe o numero de série?">
					<span class="label-input100">Número de Série</span>
					<input class="input100" type="text" name="serie" placeholder="Ex: 105AZALPM640" required="">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Se não for um projeto digite 0">
					<span class="label-input100">Horas de Lâmpada</span>
					<input class="input100" type="text" name="horas" placeholder="Ex: Se não for um projeto digite 0" required="" value="0">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Informe a Situação?">
					<span class="label-input100">Situação do Equipamento</span>
					<input class="input100" type="text" name="situacao" placeholder="Ex: DEFEITO - OK " required="">
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
