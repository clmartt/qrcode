<?php           
$qrcode = $_GET['qrcode'];

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 



$mysqli = new mysqli($host, $user, $pass, $db);
       


if($mysqli){

$sql = "SELECT * FROM QRCODETABLE where QRCODE = '$qrcode'";
$result = $mysqli->query($sql);
               


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "QRCODE : ".$row['QRCODE']."<BR>";
        echo "NOME_ATIVO : ".$row['NOME_ATIVO']."<BR>"; 
        echo "MODELO : ".$row['MODELO']."<BR>";
        echo "MARCA : ".$row['MARCA']."<BR>";
        echo "PREDIO : ".$row['PREDIO']."<BR>";
        echo "ANDAR : ".$row['ANDAR']."<BR>";
        echo "SALA : ".$row['SALA']."<BR>";
      
    }
} else {
    echo "0 results";
}     
	}
else {
	echo "nao";
      };
echo "<H2><a href='https://kvm1000.websiteseguro.com/qrteste/IOS/misc/examples/demo.html'>SCAN NOVAMENTE</a></H2>";
?>