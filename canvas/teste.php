<?php
 

 ob_start();
 session_start(); //pega a sessao do usuario
 $cliente = $_SESSION['cliente'];
 
 
 // cabeçalho para utf8 
 header('Content-Type: text/html; charset=utf-8');
 ini_set('default_charset','UTF-8');
 
 $logado = $_GET['usuario']; // guardando usuario logado na variavel
 
 //conexao com banco de dadso
 
 $dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
 $usuario = 'qrcodekvm'; 
 $senha = 'qrcodekvm';  
 
 // Conectando 
 // se nao conectar informa o erro
 try { 
 
   
 $pdo = new PDO($dsn, $usuario, $senha); 
 } catch (PDOException $e) { 
 echo $e->getMessage(); 
 exit(1); 
 } 

 

$select = "SELECT COUNT(problema) as qtd, problema FROM  CHAMADOS GROUP BY problema"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$dataPoints = array();

foreach ($result as $resultado) {
		
	array_push($dataPoints,array("y" => $resultado['qtd'], "label" => $resultado['problema']));
};


?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Chamados por Categoria"
	},
	axisY: {
		title: "Quantidade"
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 80%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  