  
<?php
error_reporting(0);

include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";



$dataI = date('Y-m-d',strtotime($_GET['data']));
$dataF = date('Y-m-d',strtotime($_GET['dataFim']));
$STATUS = $_GET['stat'];


require('LancamentoContaPagarSoapClient.php');
require('OmieAppAuthcom.php');

//REQUIRE PARA PEGAR O NUMERO DO PROJETO 
require('ProjetosCadastroSoapClient.php');




$lcp = new LancamentoContaPagarSoapClient();
  $pag = new lcpListarRequest();
  $pag-> filtrar_por_status = $STATUS;
  //$pag-> filtrar_por_data_de = $dataI;
  //$pag-> filtrar_por_data_ate = $dataF;
  $pag-> ordenar_por = "CODIGO";
  $ret = $lcp-> ListarContasPagar($pag);


//-------------VARIAVEIS PARA REQUISIÇÃO DO PROJETO -------------------------------------------------

  $lcpprj = new ProjetosCadastroSoapClient(); // classe 
$pagchaveprj = new projConsultarRequest(); // classe para requisição




$valor  = array();

$contador1 = 0;

$endereco = "./pagar/compagar.xlsx"; 
$objPHPExcel = new PHPExcel();



$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'STATUS');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VENCIMENTO');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PARCELA');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'COD_PROJETO');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'NOTA_FISCAL');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'N_PEDIDO');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CLIENTE');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'OBSERVAÇÃO');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'VALOR');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'EMPRESA');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'TIPO_CONTA');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'NOME_PROJETO');

$contador = 1;

foreach ($ret->conta_pagar_cadastro as $dados) {

            $explodir = explode("/",$dados->data_vencimento);
             $dataamericana = $explodir[2]."-".$explodir[1]."-".$explodir[0];

             if(strtotime($dataamericana) >= strtotime($dataI) and strtotime($dataamericana) <= strtotime($dataF)){

               $contador++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$contador, $dados->status_titulo);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$contador, $dados->data_vencimento);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$contador, $dados->numero_parcela);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$contador, $dados->codigo_projeto);

                          if($dados->codigo_projeto == ""){

                                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$contador, $dados->numero_documento_fiscal);
                                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $dados->numero_pedido);
                                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, $dados->codigo_cliente_fornecedor);
                                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, $dados->observacao);
                                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador, number_format($dados->valor_documento,2, ',', '.'));
                                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$contador, "COMERCIAL");
                                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$contador,"PAGAR");
                                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$contador,"0");

                              array_push($valor, number_format($dados->valor_documento,2, '.', ''));
                               $contador1 = $contador1+1;
                          }else{
                            $pagchaveprj-> codigo = $dados->codigo_projeto; // valor enviado para requisição
                            $retprj = $lcpprj-> ConsultarProjeto($pagchaveprj); // classe para consultar

                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$contador, $dados->numero_documento_fiscal);
                            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$contador, $dados->numero_pedido);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$contador, $dados->codigo_cliente_fornecedor);
                            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$contador, $dados->observacao);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$contador, number_format($dados->valor_documento,2, ',', '.'));
                            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$contador, "COMERCIAL");
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$contador,"PAGAR");
                            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$contador, $retprj->nome);

                          array_push($valor, number_format($dados->valor_documento,2, '.', ''));
                           $contador1 = $contador1+1;

                          };


                
            };
 

 };
 $objPHPExcel->getActiveSheet()->SetTitle("PagarComercial");
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($endereco);




/* somente para lembrar como gerar o valor da variavel dados
  echo "STATUS: ".$dados->status_titulo."<BR>";
  echo "DATA VENCIMENTO: ".$dados->data_vencimento."<BR>";
  echo "PARCELA: ".$dados->numero_parcela."<BR>";
  echo "CLIENTE/FORNECEDOR: ".$dados->codigo_cliente_fornecedor."<BR>";
  echo "OBSERVACAO: ".$dados->observacao."<BR>";
  echo "Valor : ".number_format($dados->valor_documento,2, '.', '')."<HR>";
  
*/

    
 


echo number_format(array_sum($valor),2, ',', '.')." -  <b>Total Contas: </b>".$contador1;
//echo print_r($dataV);
//echo gettype($dataF);


?>
