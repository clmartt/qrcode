
<?php

error_reporting(0);


include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";


$dataI = date('Y-m-d',strtotime($_GET['data']));
$dataF = date('Y-m-d',strtotime($_GET['dataFim']));
$STATUS = $_GET['statglobal'];
require('LancamentoContaPagarSoapClient.php');
require('OmieAppAuthser.php');
$lcp = new LancamentoContaPagarSoapClient();
  $pag = new lcpListarRequest();
  $pag-> filtrar_por_status = $STATUS;
  //$pag-> filtrar_por_data_de = $dataI;
  //$pag-> filtrar_por_data_ate = $dataF;
  $pag-> ordenar_por = "CODIGO";
  $ret = $lcp-> ListarContasPagar($pag);


  $valor  = array();

  $endereco = "./pagar/servpagar.xlsx"; 
$objPHPExcel = new PHPExcel();



$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'STATUS');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VENCIMENTO');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PARCELA');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CLIENTE');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'OBSERVAÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'VALOR');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'EMPRESA');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'TIPO_CONTA');

$contador = 1;

foreach ($ret->conta_pagar_cadastro as $dados) {
             
             $explodir = explode("/",$dados->data_vencimento);
             $dataamericana = $explodir[2]."-".$explodir[1]."-".$explodir[0];


            if( strtotime($dataamericana) >= strtotime($dataI) and strtotime($dataamericana) <= strtotime($dataF)){
               
                $contador++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$contador, $dados->status_titulo);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$contador, $dados->data_vencimento);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$contador, $dados->numero_parcela);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$contador, $dados->codigo_cliente_fornecedor);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $dados->observacao);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, number_format($dados->valor_documento,2, ',', '.'));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, "SERVIÇOS");
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador,"PAGAR");
              
                array_push($valor, number_format($dados->valor_documento,2, '.', ''));

                  echo "STATUS: ".$dados->status_titulo."<BR>";
                  echo "DATA VENCIMENTO: ".$dados->data_vencimento."<BR>";
                  echo "PARCELA: ".$dados->numero_parcela."<BR>";
                  echo "CLIENTE/FORNECEDOR: "."<button type='button' id='codigocliente' class='Recebertabelaservcodcliente' data-toggle='modal' data-target='#exampleModal'>".$dados->codigo_cliente_fornecedor."</button><BR>";
                  echo "OBSERVACAO: ".$dados->observacao."<BR>";
                  echo "Valor : ".number_format($dados->valor_documento,2, ',', '.')."<HR>";
              
              };

};

$objPHPExcel->getActiveSheet()->SetTitle("PagarServicos");
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($endereco);

echo number_format(array_sum($valor),2, ',', '.');


?>
