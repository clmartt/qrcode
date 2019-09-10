<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
// Definindo parametros de conexao 
$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  

//recebendo do formulario os campos de login
$qrcode = $_POST['qrcode'];
$ativo = utf8_decode(strtoupper($_POST['ativo']));
$caract = strtoupper($_POST['caract']);
$modelo =  utf8_decode(strtoupper($_POST['modelo']));
$marca = utf8_decode(strtoupper($_POST['marca']));
$predio = utf8_decode(strtoupper($_POST['predio']));
$sala = utf8_decode(strtoupper($_POST['sala']));
$andar = utf8_decode(strtoupper($_POST['andar']));
$setor = utf8_decode(strtoupper($_POST['setor']));
$serie = utf8_decode(strtoupper($_POST['serie']));
$horas = intval($_POST['horas']);

// Conectando 
try { 
$pdo = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) { 
echo $e->getMessage(); 
exit(1); 
} 

$select = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRCODE = '$qrcode'");
$result = $select->fetchAll(PDO::FETCH_ASSOC);
echo $result['QRCODE'];

$update = $pdo->query("UPDATE QRCODETABLE SET QRCODE = '$qrcode',TIPO_DE_EQUIPAMENTO = '$ativo',CARACTERISTICA = '$caract',MARCA = '$marca',MODELO = '$modelo', N_SERIE = '$serie',PREDIO = '$predio', ANDAR = '$andar', SETOR = '$setor',SALA = '$sala', HORAS_LAMP = $horas WHERE QRCODE = '$qrcode'");

$update-> execute();

echo "<script>alert('atualizado')</script>";
header("Location: http://kvminformatica.com.br/qrteste/principal.php");

/*

// Preparando statement 
	
// Se a linha existe: indicar que esta logado e encaminhar para outro lugar 
if ($stmt) { 

ECHO "foi selecionado ".$qrcode;
//header('Location: http://www.uol.com.br');  direciona para outra pagina
//header("Location: http://kvminformatica.com.br/qrteste/principal.php");

} else { 
echo "Erro ao gravar"; 


} 

*/