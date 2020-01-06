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
	
	<div  >


			<ul class="nav nav-pills nav-fill">
			  <li class="nav-item">
			    <a class="nav-link " href="./insertativo/formInsert.php"><button> + ATIVO</button></a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link " href="./ativosSala/ativoSala.php"><button>ATIVO POR SALA</button></a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#" data-toggle='modal' data-target='#exampleModal'><button>SALA OCUPADA</button></a>
			  </li>
			 
			</ul>
		<HR>
			
		
		<div align="center">

					<div class="card" style="width: 18rem;">
						  <img class="card-img-top" src="./images/scan3.gif" alt="Card image cap">
						  <div class="card-body">
						    <h5 class="card-title">QR Code </h5>
						    <p class="card-text">Use o Qrcode para realizar Check list nas salas e Preventivas em equipamentos</p>
						    <p></p>
						    <a href="./cameras.php?user=<?php echo $_SESSION['email'] ?>" class="btn btn-primary">Vamos lá!</a>
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