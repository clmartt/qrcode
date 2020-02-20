<?php
ob_start();
session_start();
$email = $_SESSION['email'];

if($email==''){
    header("Location: ./login.html");

}

include('../conectar.php');
include('../timezone.php');

$qrcode = $_GET['qrcode'];




?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Abrir Preventiva</title>
    <script src="jquery-3.2.1.min.js"></script>
  </head>
  <body>
                <nav class="navbar navbar-dark bg-dark">
                    <a class="navbar-brand" onclick="history.go(-1)" href="#">
                    <span class="text-white">Retornar</span>
                    </a>
                </nav>

        <p></p>

                    <div class="card">
                        <div class="card-header">
                            Retirada para Manutenção - <?php echo $qrcode ?>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="guardamanu.php">
                            <input type="hidden" value="<?php echo $email ?>" name="usuario">
                            <input type="hidden" value="<?php echo $qrcode ?>" name="qrcode">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Retirado por</label>
                                <input type="text" class="form-control" id="retirado_por" aria-describedby="retirado" placeholder="Quem retirou o equipamento" name="retirado">
                                <small id="retirado_por" class="form-text text-muted">Identifique quem retirou o equipamento</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">OS Assistência</label>
                                <input type="text" class="form-control" id="os" aria-describedby="os" placeholder="Se houver uma OS informe" name="os">
                                <small id="retirado_por" class="form-text text-muted">Você poderá inserir mais tarde não se preocupe :)</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Destino</label>
                                <input type="text" class="form-control" id="destino" placeholder="Destino" name="destino">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição do Problema</label>
                                <textarea class="form-control" id="problema" rows="3" name="problema"></textarea>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-primary">Enviar</button></div>
                        </form>
                        </div>
                    </div>















    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>