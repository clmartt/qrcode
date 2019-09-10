
<?php

ob_start(); 
session_start();
$user  = $_GET['user'];
$_SESSION['email'] = $user;

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


<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid blue;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
	





</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<IMG alt=IMG src="images/img-01.png">
				</div>

				<form class="login100-form validate-form" action="consultaON.php" method="get">
          <?php echo 'Olá! '.$_SESSION['email']; ?>
					<div class="input-group mb-3">
                    <input type="hidden" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" name="user" value="<?php echo $_SESSION['email']; ?>">
		                <input type="text" class="form-control" placeholder="Digite QRCODE" aria-label="Digite QRCODE" aria-describedby="basic-addon2" name="qrcode" required="qrcode" >
		                <div class="input-group-append">
		                  <button class="btn btn-outline-secondary" type="submit">Check</button>
		                </div>
		              </div>

					<div align="center"><VIDEO id="webcameraPreview" controls loop playsinline autoplay style ="WIDTH: 60%" muted></VIDEO></SECTION></ARTICLE></div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../external/adapter.min.js"></script>
    <script type="text/javascript" src="../../external/instascan.js"></script>
    <script type="text/javascript" src="../../src/QrCodeScanner.js"></script>
    <script type="text/javascript">
        //HTML video component for web camera
        var videoComponent = $("#webcameraPreview");
        //HTML select component for cameras change
        var webcameraChanger = $("#webcameraChanger");
        var options = {};
        //init options for scanner
        options = initVideoObjectOptions("webcameraPreview");
        var cameraId = 1;

        initScanner(options);

        initAvaliableCameras(
            webcameraChanger,
            function () {
                cameraId = parseInt(getSelectedCamera(webcameraChanger));
            }
        );

        initCamera(cameraId);


        scanStart(function (data){
           
            alert("Encontrado..."+ data);
            window.open('consultaON.php?qrcode=' + data + '&user=<?php echo $_SESSION['email']; ?> ', "_self");
        });

    </script>


					
		
				

					
					</div>



					</div>

					
					</div> 
						

					
						
						
						
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