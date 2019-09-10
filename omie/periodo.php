  
<?php

include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";
$dataI = date('d-m-Y',strtotime($_GET['data']));
$dataF = date('d-m-Y',strtotime($_GET['dataFim']));
$STATUS = $_GET['stat'];




$endereco = "./periodo/tempoStatus.xlsx"; 
$objPHPExcel = new PHPExcel();



$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'STATUS');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'DE');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'ATE');

             
                $objPHPExcel->getActiveSheet()->SetCellValue('A2', $STATUS);
                $objPHPExcel->getActiveSheet()->SetCellValue('B2', $dataI);
                $objPHPExcel->getActiveSheet()->SetCellValue('C2', $dataF);
                
              
       

 


 $objPHPExcel->getActiveSheet()->SetTitle("Periodo");
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($endereco);




?>
