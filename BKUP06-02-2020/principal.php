<?php

ob_start();

session_start();

$usuario = $_GET['user'];

$cliente = $_SESSION['cliente'];







if($_SESSION['email'] ==''){



	header("Location: ./login.html");

};





// definições de host, database, usuário e senha

$host = "qrcodekvm.mysql.dbaas.com.br";

$db   = "qrcodekvm";

$user = "qrcodekvm";

$pass = "qrcodekvm"; 



$ANDAR = $_POST['andar'];





$mysqli = new mysqli($host, $user, $pass, $db);



if($cliente == 'KVM'){

	$sql = "SELECT PREDIO FROM QRCODETABLE GROUP BY PREDIO";

	$result = $mysqli->query($sql);

}else{

	$sql = "SELECT PREDIO FROM QRCODETABLE WHERE CLIENTE = '$cliente' GROUP BY PREDIO";

	$result = $mysqli->query($sql);

};



/*

$sql = "SELECT PREDIO FROM QRCODETABLE GROUP BY PREDIO";

$result = $mysqli->query($sql);

*/











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

	

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script type="text/javascript">

	$(document).ready(function(){

		

			$('#check').click(function(){

				$.get('downcheck.php', function(data){



				});

				alert("Check Enviado!");





			});



//=====================================================================================>>>>>>>>>

			$('#ativo').click(function(){

				$.get('downativo.php', function(data){



				});

				alert("Ativo Enviado!");





			});



//=====================================================================================>>>>>>>>>

			$('#chamado').click(function(){

				$.get('downchamados.php', function(data){



				});

				alert("Chamados Enviado!");





			});

//=====================================================================================>>>>>>>>>





	//=================================================================================================================>>>>>>>

				





	});



	</script>



</head>

<body>



	<?php 

	include("menu.php");

	?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>ReQuest</title>
  </head>
  <body>


 		<div class="container">
			 
		 <div class="text-center"><img src="./images/logo2.jpg"</div>
		 <div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>


 <!-- Modal -->

                                    <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>

                                      <div class='modal-dialog' role='document'>

                                        <div class='modal-content'>

                                          <div class='modal-header'>

                                            <h5 class='modal-title' id='exampleModalLabel'>Escolha o Prédio</h5>

                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>

                                              <span aria-hidden='true'>&times;</span>

                                            </button>

                                          </div>

                                          <div class='modal-body'>

                                             <form class="form-inline my-2 my-lg-0" action="salaconsulta.php" method="GET">

								      		   

                                             	<div class="input-group mb-3">

												

												  <select class="custom-select" id="inputGroupSelect01" name="predios">

												    <?php foreach($result as $res){

													 echo "<option value=". urlencode($res['PREDIO']).">".$res['PREDIO']."</option> ";

																									       

													 } ?>

												  </select>

												  <input type="text" name="andar" class="form-control">



												  <button class="btn btn-outline-secondary" type="submit">Buscar</button>

												</div>

										    

										

								    		</form>

                                          </div>

                                          <div class='modal-footer'>

                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

                                           </div>

                                        </div>

                                      </div>

                                    </div>











</body>

</html>