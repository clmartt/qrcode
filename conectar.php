<?php 


$hostname = 'qrcodekvm.mysql.dbaas.com.br';
$username = 'qrcodekvm';
$password = 'qrcodekvm';
$database = 'qrcodekvm';
 
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   
}
catch(PDOException $e){
    echo $e->getMessage();
}





?>