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





			

		<HR>

			

		

		<div align="center">



					<div class="card" style="width: 18rem;">

<!-- clock widget start -->
<script type="text/javascript"> var css_file=document.createElement("link"); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href","//s.bookcdn.com//css/cl/bw-cl-180x170r5.css"); document.getElementsByTagName("head")[0].appendChild(css_file); </script> <div id="tw_15_2028337583"><div style="width:180px; height:190px; margin: 0 auto;"><a href="https://ibooked.com.br/time/sao-paulo-18266">São Paulo</a><br/></div></div> <script type="text/javascript"> function setWidgetData_2028337583(data){ if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = ''; var params = data.results[i]; objMainBlock = document.getElementById('tw_'+params.widget_type+'_'+params.widget_id); if(objMainBlock !== null) objMainBlock.innerHTML = params.html_code; } } } var clock_timer_2028337583 = -1; </script> <script type="text/javascript" charset="UTF-8" src="https://widgets.booked.net/time/info?ver=2&domid=585&type=15&id=2028337583&scode=124&city_id=18266&wlangid=8&mode=2&details=0&background=ffffff&color=265780&add_background=ffffff&add_color=333333&head_color=ffffff&border=0&transparent=0"></script>
<!-- clock widget end -->


						  <div class="card-body">




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