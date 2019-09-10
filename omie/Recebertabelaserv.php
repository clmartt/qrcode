
<?php

error_reporting(0);



$dataI = date('Y-m-d',strtotime($_GET['data']));
$dataF = date('Y-m-d',strtotime($_GET['dataFim']));
$STATUS = $_GET['statglobal'];
require('LancamentoContaReceberSoapClient.php');
require('OmieAppAuthser.php');
$lcp = new LancamentoContaReceberSoapClient();
  $pag = new lcrListarRequest();
  $pag-> filtrar_por_status = $STATUS;
  //$pag-> filtrar_por_data_de = $dataI;
  //$pag-> filtrar_por_data_ate = $dataF;
  $pag-> ordenar_por = "CODIGO";
  $ret = $lcp-> ListarContasReceber($pag);


  $valor  = array();


 

foreach ($ret->conta_receber_cadastro as $dados) {
             
             $explodir = explode("/",$dados->data_vencimento);
             $dataamericana = $explodir[2]."-".$explodir[1]."-".$explodir[0];


            if( strtotime($dataamericana) >= strtotime($dataI) and strtotime($dataamericana) <= strtotime($dataF)){
               
                             
                array_push($valor, number_format($dados->valor_documento,2, '.', ''));

                  echo "STATUS: ".$dados->status_titulo."<BR>";
                  echo "DATA VENCIMENTO: ".$dados->data_vencimento."<BR>";
                  echo "PARCELA: ".$dados->numero_parcela."<BR>";
                  echo "CLIENTE/FORNECEDOR: "."<button type='button' id='codigocliente' class='Recebertabelaservcodcliente' data-toggle='modal' data-target='#exampleModal'>".$dados->codigo_cliente_fornecedor."</button><BR>";
                  echo "OBSERVACAO: ".$dados->observacao."<BR>";
                  echo "Valor : ".number_format($dados->valor_documento,2, ',', '.')."<HR>";
              
              };

};




echo number_format(array_sum($valor),2, ',', '.');


?>
