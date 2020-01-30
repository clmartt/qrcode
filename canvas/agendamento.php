<?php
include('conectar.php');

ob_start();
session_start();
$cliente = $_SESSION['cliente'];

if($cliente==''){
    header("Location: ./login.html");

}
echo $cliente



?>