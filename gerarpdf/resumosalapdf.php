
<?php
//error_reporting(0);
include('../conectar.php');


// INCLUDE DA DOS ARQUIVOS E CLASSES PARA GERAR EXCEL
include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";

require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$predio = $_GET['predio'];
$andar = $_GET['andar'];
$sala = $_GET['sala'];
$setor = $_GET['setor'];

$total = 0;
        
$sqlResumo = $pdo->query("SELECT TIPO_DE_EQUIPAMENTO, COUNT(TIPO_DE_EQUIPAMENTO) AS qtdAtivos, CARACTERISTICA FROM QRCODETABLE WHERE PREDIO = '$predio' AND ANDAR = '$andar' AND SALA = '$sala' AND SETOR = '$setor' GROUP BY TIPO_DE_EQUIPAMENTO,CARACTERISTICA ");


$html  = '<html>';
$html .= '<body>';
$html .= '<b>'.'Resumo : </br>'.$predio.' - '.$andar.'º '.' - SALA : '.$sala.' - SETOR : '.$setor;
$html .= '<hr>'; 
$html .= '<div class="table-responsive">';

$html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633" width=100%>';
$html .='<thead>';
$html .='<tr>';
$html .='<th scope="col">ATIVOS</th>';
$html .='<th scope="col">TIPO</th>';
$html .='<th scope="col">QTD</th>';
$html .='</tr>';
$html .='</thead>';
$html .='<tbody>';



foreach ($sqlResumo as $res) {
 $html .= "<tr>";
 $html .= "<td>".$res['TIPO_DE_EQUIPAMENTO']." </td>";
 $html .= "<td>".$res['CARACTERISTICA']." </td>";
 $html .= "<td>".$res['qtdAtivos']." </td>";
 $html .= "</tr>";     
 $total = $total + $res['qtdAtivos'];
}
 $html .= "<tr>";
 $html .= "<td> <b>".'Total '."</b> </td>";
 $html .= "<td> </td>";
 $html .= "<td>".$total." </td>";
 $html .= "</tr>";   

$html .= "</tbody>";
$html .= "</table>";
$html .= "</body>";
$html .= "</html>";
$html .= "</div>"; 

$mpdf->WriteHTML($html);
$mpdf->Output();



?>
