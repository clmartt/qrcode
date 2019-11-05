<?php
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

    $stmt = $pdo->query("select * from login_usuario group by cliente")->fetchAll();



?>


<!DOCTYPE html>

<html lang="en">

<head>

	<title>KVM INFORMATICA - QR CODE</title>

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

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="css/util.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">

<!--===============================================================================================-->

</head>

<body>

	

	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100">

				<div class="login100-pic js-tilt" data-tilt>

					<IMG alt=IMG src="images/img-01.png">

				</div>



				<form class="login100-form validate-form" action = "insertcadastro.php" method ="post" >

					<span class="login100-form-title">

						Agora é rapidinho!

					</span>



					<div class="wrap-input100 validate-input" data-validate = "Ops!, estranho esse email tente o padrao: email@abc.com">

						<input class="input100" name="email" placeholder="Email" >

						<span class="focus-input100"></span>

						<span class="symbol-input100">

							<i aria-hidden=true class ="fa fa-envelope"></i>

						</span>

					</div>



					<div class="wrap-input100 validate-input" data-validate = "Esta faltando alguma coisa hem!">

						<input class="input100" type="password" name="senha" placeholder="Senha">

						<span class="focus-input100"></span>

						<span class="symbol-input100">

							<i aria-hidden=true class ="fa fa-lock"></i>

						</span>

					</div> 

					

					<div class="wrap-input100 validate-input" data-validate = "Pode não ser o mais Bonito mas é o único que você tem!">

						<input class="input100" type="text" name="nome" placeholder="Nome Completo">

						<span class="focus-input100"></span>

						<span class="symbol-input100">

							<i aria-hidden=true class ="fa fa-user"></i>

						</span>

                    </div> 

                    <div class="wrap-input100 validate-input" data-validate = "Qual Cliente?">

						<div align="center" ><label for="exampleFormControlSelect1"><b>Cliente</b></label></div>
                            <select class="input100" id="exampleFormControlSelect1" name="cliente">
                                <?php
                                foreach($stmt as $retorno){
                                    echo "<option value=".$retorno['cliente'].">".$retorno['cliente']."</option>";

                                }
                                       
                                ?>
							</select>
							

					</div> 

					

		

					<br>

					<div class="container-login100-form-btn">

						<button class="login100-form-btn">

							Salvar

						</button>

					</div>



					<div class="text-center p-t-12">

						

						

					</div> 

						<div class="text-center p-t-12">

							

					</div>



					<div class="text-center p-t-136">

						<A class=txt2 href="#">

						

						

						</A>

					</div>

				</form>

			</div>

		</div>

	</div>

	

	



	

<!--===============================================================================================-->	

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/bootstrap/js/popper.js"></script>

	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/tilt/tilt.jquery.min.js"></script>

	<script >

		$('.js-tilt').tilt({

			scale: 1.1

		})

	</script>

<!--===============================================================================================-->

	<script src="js/main.js"></script>



</body>

</html>