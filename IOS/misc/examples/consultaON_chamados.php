<?php 

//sessao
ob_start(); 
session_start();
header('Content-Type: text/html; charset=utf-8');

// variavel que recebe o codido qrcode
$qrcode = $_GET['vqrcode'];
$user = $_GET['user'];

$_SESSION['email'] = $user;



// caso o acesso nao seja feito pela sessao iniciada, redirecionar
/*if($_SESSION['email'] ==''){

    header("Location: http://kvminformatica.com.br/qrteste/principal.php");
};
*/


// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 



$mysqli = new mysqli($host, $user, $pass, $db);
       



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
       
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
<title>KVM INFORMATICA - QR CODE</title>
</head>
<body>
    
    <div class="limiter">
        <div >

            <div >
                
                

                <div class="table-responsive">

                   <?php if($mysqli){

                        $sql = "SELECT * FROM CHAMADOS where qrcode = '$qrcode'";
                        $result = $mysqli->query($sql);

                                       

                        if ($result->num_rows > 0) {

                            // saida dos dados ESTA PARTE É MOSTRADA NA TELA
                            echo "<b>Quantidade: </b>".$result->num_rows."<br><hr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<b>TÍTULO: </b>". utf8_decode($row['string_id'])."<br><b> Data</b>: ".date("d/m/Y",strtotime($row['data_2']))."<br>";
                                echo "<b>ATIVIDADE</b> : ".utf8_encode($row['observacao'])."<BR>";
                                echo "<b>REALIZADO POR: </b> : ".$row['nome_user']."<BR>";
                                echo "<b>STATUS: </b> : ".$row['status']."<BR>";
                                echo "<b>ABERTO EM: </b> : ".date("d/m/Y",strtotime($row['data_2']))."<BR>";
                                echo "<b>FECHADO EM: </b> : ".$row['data_fechado']."<BR>";
                                echo "<hr>";
                                
                                                                
                                
                                                              
                            }//while
                        } else {  echo "Não há Chamados" ;}     
                            } else { echo "FALHA NA  CONEXOAO"; };
                                                       
                     
                        ?>

                    </div>
                    
                        
                        
                        
                    </div>
                
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