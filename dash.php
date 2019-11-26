
<?php

ob_start();
session_start();
header("Refresh: 60");

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predio']);
$ano = date('Y');



$mysqli = new mysqli($host, $user, $pass, $db);



if($_POST){




?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar sticky-top navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="./images/logo.gif" width="30" height="30" class="d-inline-block align-top" alt="">
    ReQuest
  </a>

  <form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="input-group">
  <select class="custom-select" id="inputGroupSelect04" name="predio">
    <option selected>Escolha o Prédio</option>
    <?php
    foreach ($result as $res) {
            
    echo'<option value="'.$res['PREDIO'].'">'.$res['PREDIO'].'</option>';
  
    
    };
    ?>
  </select>
  <div class="input-group-append">
  <input class="btn btn-info" type="submit" value="Submit">
  </div>
</div>

    </form>
</nav>
<p></p>
<p></p>



<table class="table table-sm text-center" >
  <thead>
    <tr>
      <th scope="col">Resolvidos</th>
      <th scope="col">Andamento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      
    </tr>
    <tr>
     
    
  </tbody>
</table>


<p></p>
<p></p>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
    
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="400" height="200" ></iframe>
      
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="400" height="200" ></iframe>
      </div>
    </div>
  </div>
</div>
<p></P>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
    
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="400" height="200" ></iframe>
      
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="400" height="200" ></iframe>
      </div>
    </div>
  </div>
</div>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>












<?php 
}else{


?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar sticky-top navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="./images/logo.gif" width="30" height="30" class="d-inline-block align-top" alt="">
    ReQuest
  </a>

  <form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="input-group">
  <select class="custom-select" id="inputGroupSelect04" name="predio">
    <option selected>Escolha o Prédio</option>
    <?php
    foreach ($result as $res) {
            
    echo'<option value="'.$res['PREDIO'].'">'.$res['PREDIO'].'</option>';
  
    
    };
    ?>
  </select>
  <div class="input-group-append">
  <input class="btn btn-info" type="submit" value="Submit">
  </div>
</div>

    </form>
</nav>
<p></p>
<p></p>
<?php
};
?>