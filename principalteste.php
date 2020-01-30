<?php

ob_start();
session_start();


$usuario = $_GET['user'];








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

		$('#pop').popover();

		$('#pagina').load('atividades.php');

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



//=====================================================================================>>>>>>>>>





	//=================================================================================================================>>>>>>>

				





	});



	</script>



</head>

<body>



	<?php 

	include("menuteste.php");
echo "<br>";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


	?>

	
<p></p>
<p></p>
<p></p>
<p></p>

	<div id="pagina">
	<p></p>
<p></p>
<p></p>
<?php echo $_SESSION['email']?>
<p></p>
	<a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover" id="pop">Toggle popover</a>
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









									<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

</body>

</html>