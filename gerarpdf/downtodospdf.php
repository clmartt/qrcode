
<?php
//error_reporting(0);
ob_start();
session_start();
$cliente = $_SESSION['cliente'];
include("../conectar.php");


// INCLUDE DA DOS ARQUIVOS E CLASSES PARA GERAR EXCEL
include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";

require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();



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

     if($cliente =='KVM'){

                        //PEGA O OS DADOS DO CHECK
                 
                  
                         $sql = $pdo->query("SELECT * FROM TABLE_CHECK WHERE DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' ORDER BY DATA_2 , PREDIO");
                       
        }else{

                //PEGA O OS DADOS DO CHECK
                
                $sql = $pdo->query("SELECT * FROM TABLE_CHECK WHERE DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  AND CLIENTE = '$cliente' ORDER BY DATA_2 , PREDIO");
                

        };

        $html  = '<html>';
        $html .= '<body>';
        $html .= '<b>Check List realizado - Predio : '.$predio.' - '.$cliente.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
        $html .= '<hr>'; 
        $html .= '<div class="table-responsive">';

        $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">Data</th>';
        $html .='<th scope="col">Qrcode</th>';
        $html .='<th scope="col">Predio</th>';
        $html .='<th scope="col">Sala</th>';
        $html .='<th scope="col">Andar</th>';
        $html .='<th scope="col">Ativo</th>';
        $html .='<th scope="col">Situação</th>';
        $html .='<th scope="col">Recurso</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';



        foreach ($sql as $res) {
        $html .= "<tr>";
        $html .= "<td>".date('d-m-Y',strtotime($res['DATA_2']))." </td>";
        $html .= "<td>".$res['QRCODE']." </td>";
        $html .= "<td>".$res['PREDIO']." </td>";
        $html .= "<td>".$res['ANDAR']." </td>";
        $html .= "<td>".$res['SALA']." </td>";
        $html .= "<td>".$res['TIPO_DE_EQUIPAMENTO']." </td>";
        $html .= "<td>".$res['SITUACAO']." </td>";
        $html .= "<td>".$res['NOME_USER']." </td>";
        $html .= "</tr>";     
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        $html .= "</div>"; 

        $mpdf->WriteHTML($html);
        $mpdf->Output();







};

if($arquivo == 'chamados'){

        if($cliente=='KVM'){
                //PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
              
                $sqlchamado = $pdo->query("SELECT * FROM CHAMADOS where data_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  ORDER BY data_2,predio");
               

        }else{

                //PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
              
                $sqlchamado = $pdo->query("SELECT * FROM CHAMADOS where data_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  AND CLIENTE = '$cliente' ORDER BY data_2,predio");
               


        }

        $html  = '<html>';
        $html .= '<body>';
        $html .= '<b>Chamados - Predio : '.$predio.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
        $html .= '<hr>'; 
        $html .= '<div class="table-responsive">';

        $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">Data</th>';
        $html .='<th scope="col">Nº Chamado</th>';
        $html .='<th scope="col">Qrcode</th>';
        $html .='<th scope="col">Ativo</th>';
        $html .='<th scope="col">Marca</th>';
        $html .='<th scope="col">Predio</th>';
        $html .='<th scope="col">Andar</th>';
        $html .='<th scope="col">Sala</th>';
        $html .='<th scope="col">Problema</th>';
        $html .='<th scope="col">OS</th>';
        $html .='<th scope="col">Status</th>';
        $html .='<th scope="col">Fechado em</th>';
        $html .='<th scope="col">Fechado Por</th>';
        $html .='<th scope="col">Solução</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';



        foreach ($sqlchamado as $res) {
        $html .= "<tr>";
        $html .= "<td>".date('d-m-Y',strtotime($res['data_2']))." </td>";
        $html .= "<td>".$res['id_chamado']." </td>";
        $html .= "<td>".$res['qrcode']." </td>";
        $html .= "<td>".$res['ativo']." </td>";
        $html .= "<td>".$res['marca']." </td>";
        $html .= "<td>".$res['predio']." </td>";
        $html .= "<td>".$res['andar']." </td>";
        $html .= "<td>".$res['sala']." </td>";
        $html .= "<td>".$res['problema']." </td>";
        $html .= "<td>".$res['OS_BANCO']." </td>";
        $html .= "<td>".$res['status']." </td>";
        $html .= "<td>".date('d-m-Y',strtotime($res['data_fechado']))." </td>";
        $html .= "<td>".$res['fechado_por']." </td>";
        $html .= "<td>".$res['solucao']." </td>";
        $html .= "</tr>";     
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        $html .= "</div>"; 

        $mpdf->WriteHTML($html);
        $mpdf->Output();







};

if($arquivo== 'ativos'){

        if($cliente=='KVM'){
                //PEGA O OS DADOS DOS ATIVOS
                
           $sql = $pdo->query("SELECT * FROM QRCODETABLE ORDER BY PREDIO,ANDAR");
                

        }else{

                        //PEGA O OS DADOS DOS ATIVOS
                       
                        $sql = $pdo->query("SELECT * FROM QRCODETABLE WHERE  CLIENTE = '$cliente' ORDER BY PREDIO,ANDAR");
                       
        };

        $html  = '<html>';
        $html .= '<body>';
        $html .= '<b>Lista de Ativos - '.$predio.' - '.$cliente.'</b>';
        $html .= '<hr>'; 
        $html .= '<div class="table-responsive">';
        
        $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">Qrcode</th>';
        $html .='<th scope="col">Ativo</th>';
        $html .='<th scope="col">Marca</th>';
        $html .='<th scope="col">N_serie</th>';
        $html .='<th scope="col">Andar</th>';
        $html .='<th scope="col">Sala</th>';
        $html .='<th scope="col">Qrsala</th>';
        $html .='<th scope="col">Horas_lamp</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';
        
        foreach ($sql as $res) {
                $html .= "<tr>";
                $html .= "<td>".$res['QRCODE']." </td>";
                $html .= "<td>".$res['TIPO_DE_EQUIPAMENTO']." </td>";
                $html .= "<td>".$res['MARCA']." </td>";
                $html .= "<td>".$res['N_SERIE']." </td>";
                $html .= "<td>".$res['ANDAR']." </td>";
                $html .= "<td>".$res['SALA']." </td>";
                $html .= "<td>".$res['QRSALA']." </td>";
                $html .= "<td>".$res['HORAS_LAMP']." </td>";
                $html .= "</tr>";     
               }
               
               $html .= "</tbody>";
               $html .= "</table>";
               $html .= "</body>";
               $html .= "</html>";
               $html .= "</div>"; 
               
               $mpdf->WriteHTML($html);
               $mpdf->Output();







};


if($arquivo == 'preventiva'){

        if($cliente=='KVM'){

                        //PEGA O OS DADOS DO CHECK
                    
                        $sql = $pdo->query("SELECT * FROM PREVENTIVAS where DATA_PREV BETWEEN '$dataInglesInicial' and '$dataInglesFinal'   ORDER BY DATA_PREV,PREDIO");
                        
        }else{

                //PEGA O OS DADOS DO CHECK
                
                $sql = $pdo->query("SELECT * FROM PREVENTIVAS where DATA_PREV BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  AND CLIENTE = '$cliente' ORDER BY DATA_PREV,PREDIO");
                

        };

        $html  = '<html>';
        $html .= '<body>';
        $html .= '<b>Preventivas - Predio : '.$predio.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
        $html .= '<hr>'; 
        $html .= '<div class="table-responsive">';
        
        $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th scope="col">DATA</th>';
        $html .='<th scope="col">QRCODE</th>';
        $html .='<th scope="col">ATIVO</th>';
        $html .='<th scope="col">PREDIO</th>';
        $html .='<th scope="col">ANDAR</th>';
        $html .='<th scope="col">SETOR</th>';
        $html .='<th scope="col">SALA</th>';
        $html .='<th scope="col">ATIVIDADE</th>';
        $html .='<th scope="col">USUARIO</th>';
        $html .='<th scope="col">OBS</th>';
        $html .='<th scope="col">CLIENTE</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';
        



        foreach ($sql as $res) {
                $html .= "<tr>";
                $html .= "<td>".date('d-m-Y',strtotime($res['DATA_PREV']))." </td>";
                $html .= "<td>".$res['QRCODE']." </td>";
                $html .= "<td>".$res['ATIVO']." </td>";
                $html .= "<td>".$res['PREDIO']." </td>";
                $html .= "<td>".$res['ANDAR']." </td>";
                $html .= "<td>".$res['SETOR']." </td>";
                $html .= "<td>".$res['SALA']." </td>";
                $html .= "<td>".$res['ATIVIDADE']." </td>";
                $html .= "<td>".$res['USUARIO']." </td>";
                $html .= "<td>".$res['OBS']." </td>";
                $html .= "<td>".$res['CLIENTE']." </td>";
                $html .= "</tr>";       
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        $html .= "</div>"; 

        $mpdf->WriteHTML($html);
        $mpdf->Output();


};



if($arquivo == 'manutencao'){

        if($cliente=='KVM'){

                        //PEGA O OS DADOS DO CHECK
                    
                        $sql = $pdo->query("SELECT * FROM MANUTENCAO where DATA_RETIRADA BETWEEN '$dataInglesInicial' and '$dataInglesFinal'   ORDER BY DATA_RETIRADA,PREDIO");
                        
        }else{

                //PEGA O OS DADOS DO CHECK
                
                $sql = $pdo->query("SELECT * FROM MANUTENCAO where DATA_RETIRADA BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  AND CLIENTE = '$cliente' ORDER BY DATA_RETIRADA,PREDIO");
                

        };

        $html  = '<html>';
                $html .= '<body>';
                $html .= '<b>Equipamentos em Manutenção - Predio : '.$predio.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
                $html .= '<hr>'; 
                $html .= '<div class="table-responsive">';
                
                $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
                $html .='<thead>';
                $html .='<tr>';
                $html .='<th scope="col">DATA RETIRADA</th>';
                $html .='<th scope="col">QRCODE</th>';
                $html .='<th scope="col">ATIVO</th>';
                $html .='<th scope="col">PREDIO</th>';
                $html .='<th scope="col">ANDAR</th>';
                $html .='<th scope="col">SETOR</th>';
                $html .='<th scope="col">SALA</th>';
                $html .='<th scope="col">QRSALA</th>';
                $html .='<th scope="col">ABERTO_POR</th>';
                $html .='<th scope="col">RETIRADO_POR</th>';
                $html .='<th scope="col">DESTINO</th>';
                $html .='<th scope="col">OS</th>';
                $html .='<th scope="col">SITUAÇÃO</th>';
                $html .='<th scope="col">CLIENTE</th>';
                $html .='</tr>';
                $html .='</thead>';
                $html .='<tbody>';
        



        foreach ($sql as $res) {
                $html .= "<tr>";
                 $html .= "<td>".date('d-m-Y',strtotime($res['DATA_RETIRADA']))." </td>";
                 $html .= "<td>".$res['QRCODE']." </td>";
                 $html .= "<td>".$res['ATIVO']." </td>";
                 $html .= "<td>".$res['PREDIO']." </td>";
                 $html .= "<td>".$res['ANDAR']." </td>";
                 $html .= "<td>".$res['SETOR']." </td>";
                 $html .= "<td>".$res['SALA']." </td>";
                 $html .= "<td>".$res['QRSALA']." </td>";
                 $html .= "<td>".$res['ABERTO_POR']." </td>";
                 $html .= "<td>".$res['RETIRADO_POR']." </td>";
                 $html .= "<td>".$res['DESTINO']." </td>";
                 $html .= "<td>".$res['OS']." </td>";
                 $html .= "<td>".$res['SITUACAO']." </td>";
                 $html .= "<td>".$res['CLIENTE']." </td>";
                 $html .= "</tr>";     
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        $html .= "</div>"; 

        $mpdf->WriteHTML($html);
        $mpdf->Output();







};

if($arquivo == 'movimentação'){

        if($cliente=='KVM'){

                        //PEGA O OS DADOS DO CHECK
                    
                        $sql = $pdo->query("SELECT * FROM MANUTENCAO where DATA_RETIRADA BETWEEN '$dataInglesInicial' and '$dataInglesFinal'   ORDER BY DATA_RETIRADA,PREDIO");
                        
        }else{

                //PEGA O OS DADOS da tabela mover
                
                $sql = $pdo->query("SELECT * FROM MOVER where DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal'  AND CLIENTE = '$cliente' ORDER BY DATA_2,DE_PREDIO");
                

        };

        $html  = '<html>';
                $html .= '<body>';
                $html .= '<b>Movimentação de Ativos - Predio : '.$predio.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
                $html .= '<hr>'; 
                $html .= '<div class="table-responsive">';
                
                $html .='<table class="table table-sm" border="1" cellspacing=0 cellpadding=2 bordercolor="666633">';
                        $html .='<thead>';
                        $html .='<tr>';
                        $html .='<th scope="col">DATA</th>';
                        $html .='<th scope="col">HORA</th>';
                        $html .='<th scope="col">QRCODE</th>';
                        $html .='<th scope="col">DE_PREDIO</th>';
                        $html .='<th scope="col">DE_ANDAR</th>';
                        $html .='<th scope="col">DE_SETOR</th>';
                        $html .='<th scope="col">DE_SALA</th>';
                        $html .='<th scope="col">DE_QRSALA</th>';
                        $html .='<th scope="col">PARA_PREDIO</th>';
                        $html .='<th scope="col">PARA_ANDAR</th>';
                        $html .='<th scope="col">PARA_SETOR</th>';
                        $html .='<th scope="col">PARA_SALA</th>';
                        $html .='<th scope="col">PARA_QRSALA</th>';
                        $html .='<th scope="col">FEITO POR</th>';
                        $html .='<th scope="col">MOTIVO</th>';
                        $html .='</tr>';
                        $html .='</thead>';
                        $html .='<tbody>';
        



        foreach ($sql as $res) {
                $html .= "<tr>";
                         $html .= "<td>".date('d-m-Y',strtotime($res['DATA_2']))." </td>";
                         $html .= "<td>".$res['HORA']." </td>";
                         $html .= "<td>".$res['QRCODE']." </td>";
                         $html .= "<td>".$res['DE_PREDIO']." </td>";
                         $html .= "<td>".$res['DE_ANDAR']." </td>";
                         $html .= "<td>".$res['DE_SETOR']." </td>";
                         $html .= "<td>".$res['DE_SALA']." </td>";
                         $html .= "<td>".$res['DE_QRSALA']." </td>";
                         $html .= "<td>".$res['PARA_PREDIO']." </td>";
                         $html .= "<td>".$res['PARA_ANDAR']." </td>";
                         $html .= "<td>".$res['PARA_SETOR']." </td>";
                         $html .= "<td>".$res['PARA_SALA']." </td>";
                         $html .= "<td>".$res['PARA_QRSALA']." </td>";
                         $html .= "<td>".$res['NOME_USER']." </td>";
                         $html .= "<td>".$res['MOTIVO']." </td>";
                         $html .= "</tr>";     
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        $html .= "</div>"; 

        $mpdf->WriteHTML($html);
        $mpdf->Output();







};




?>
