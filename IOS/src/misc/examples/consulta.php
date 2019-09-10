<?php           
$qrcode = $_GET['qrcode'];

// definições de host, database, usuário e senha
$host = "127.0.0.1";
$db   = "qrcode";
$user = "root";
$pass = ""; 



$mysqli = new mysqli($host, $user, $pass, $db);
       


if($mysqli){

$sql = "SELECT NOME_ATIVO, PREDIO, SALA, ANDAR FROM ativo where QRCODE = '$qrcode'";
$result = $mysqli->query($sql);
               


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ATIVO : ".$row['NOME_ATIVO']."<BR>";
         echo "PREDIO : ".$row['PREDIO']."<BR>"; 
          echo "SALA : ".$row['SALA']."<BR>";
           echo "ANDAR : ".$row['ANDAR']."<BR>";
    }
} else {
    echo "0 results";
}     
	}
else {
	echo "nao";
      }
