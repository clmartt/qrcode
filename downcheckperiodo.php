
<?php
//error_reporting(0);


// INCLUDE DA DOS ARQUIVOS E CLASSES PARA GERAR EXCEL
include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";


$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

//tratamento das datas 
$dataPortInicial = $_GET['dataI'];
$dataPortInicialExplode = explode("/", $dataPortInicial);
$dataInglesInicial = $dataPortInicialExplode[2]."-".$dataPortInicialExplode[1]."-".$dataPortInicialExplode[0];


$dataPortFinal = $_GET['dataF'];
$dataPortFinalExplode = explode("/", $dataPortFinal);
$dataInglesFinal = $dataPortFinalExplode[2]."-".$dataPortFinalExplode[1]."-".$dataPortFinalExplode[0];

$predio = $_GET['predio'];

$arquivo = $_GET['arquivo'];


if($arquivo == 'check'){
        

//PEGA O OS DADOS DO CHECK
$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli -> set_charset("utf8");
$sql = "SELECT * FROM TABLE_CHECK where DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY DATA_2";
$result = $mysqli->query($sql);








$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DATA');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'QRCODE');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'TIPO DE EQUIPAMENTO');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CARACTERISTICA');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'HORAS_LAMP');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MARCA');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'MODELO');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'PREDIO');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'ANDAR');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'SETOR');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'SALA');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'SITUAÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'OBSERVAÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'NOME_USER');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'SALA OCUPADA?');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'PREVENTIVA');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'QRSALA');




$contador = 2;

foreach ($result as $res) {

               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$contador, date('d/m/Y',strtotime($res['DATA_2'])));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$contador, $res['QRCODE']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$contador, $res['TIPO_DE_EQUIPAMENTO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$contador, $res['CARACTERISTICA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$contador, $res['HORAS_LAMP']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $res['MARCA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, $res['MODELO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, $res['PREDIO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador, $res['ANDAR']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$contador, $res['SETOR']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$contador, $res['SALA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$contador, $res['SITUACAO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$contador, $res['OBSERVACAO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$contador, $res['NOME_USER']);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$contador, $res['OCUPADA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$contador, $res['PREVENTIVA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$contador, $res['HORAS']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$contador, $res['QRSALA']);
                
               
                       $contador = $contador + 1;
 };


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="check_list-'.date('d/m/Y').'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
        header('Cache-Control: cache, must-revalidate'); 
        header('Pragma: public'); 


//$objPHPExcel->getActiveSheet()->SetTitle("checklist");
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('php://output');



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');





};

if($arquivo == 'chamados'){

//PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli -> set_charset("utf8");
$sqlchamado = "SELECT * FROM CHAMADOS where data_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and predio = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY data_2";
$resultchamado = $mysqli->query($sqlchamado);


$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DATA');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'MES');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'ANO');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'QRCODE');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ATIVO');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'CARACTERISTICA');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'MODELO');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'MARCA');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'PREDIO');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ANDAR');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'SETOR');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'SALA');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'PROBLEMA');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'OBSERVAÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'NOME_USER');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'STATUS');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'HORAS_LAMP');
$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'OS_BANCO');
$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'DATA_FECHAMENTO');
$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'FECHADO_POR');
$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'SOLUÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'N_CHAMADO');



$contador = 2;

foreach ($resultchamado as $res) {

               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$contador, date('d/m/Y',strtotime($res['data_2'])));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$contador, $res['mes']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$contador, $res['ano']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$contador, $res['qrcode']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$contador, $res['ativo']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $res['caracteristica']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, $res['modelo']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, $res['marca']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador, $res['predio']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$contador, $res['andar']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$contador, $res['setor']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$contador, $res['sala']);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$contador, $res['problema']);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$contador, $res['observacao']);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$contador, $res['nome_user']);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$contador, $res['status']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$contador, $res['horas_lamp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$contador, $res['OS_BANCO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$contador, $res['data_fechado']);
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$contador, $res['fechado_por']);
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$contador, $res['solucao']);
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$contador, $res['id_chamado']);

               
                       $contador = $contador + 1;
 };


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="chamados-'.date('d/m/Y').'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
        header('Cache-Control: cache, must-revalidate'); 
        header('Pragma: public'); 



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');




};

if($_GET['arquivo'] == 'ativos'){

//PEGA O OS DADOS DOS ATIVOS
$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli -> set_charset("utf8");
$sql = "SELECT * FROM QRCODETABLE WHERE PREDIO = '$predio' AND CLIENTE != 'EVENTOS'";
$result = $mysqli->query($sql);








$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'QRCODE');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'TIPO_DE_EQUIPAMENTO');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CARACTERISTICA');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'MARCA');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MODELO');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'N_SERIE');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'PREDIO');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'ANDAR');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'SETOR');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'SALA');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'QRSALA');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'HORAS_LAMP');




$contador = 2;

foreach ($result as $res) {

               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$contador, $res['QRCODE']);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$contador, $res['TIPO_DE_EQUIPAMENTO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$contador, $res['CARACTERISTICA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$contador, $res['MARCA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$contador, $res['MODELO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $res['N_SERIE']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, $res['PREDIO']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, $res['ANDAR']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador, $res['SETOR']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$contador, $res['SALA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$contador, $res['QRSALA']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$contador, $res['HORAS_LAMP']);
                
              
               
                       $contador = $contador + 1;
 };


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="lista_de_ativos-'.date('d/m/Y').'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
        header('Cache-Control: cache, must-revalidate'); 
        header('Pragma: public'); 


//$objPHPExcel->getActiveSheet()->SetTitle("checklist");
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('php://output');



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');

};




?>
