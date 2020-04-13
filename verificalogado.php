<?php 
ob_start();
session_start(); //pega a sessao do usuario

$cliente = isset($_SESSION['cliente'] ) ? $_SESSION['cliente'] : '' ;
$email = isset($_SESSION['email'] ) ? $_SESSION['email'] : '' ;



if($cliente == '' || $email == ''){
    header("Location: http://kvminformatica.com.br/qr.html");
    }


?>