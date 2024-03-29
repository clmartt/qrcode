
<?php
//error_reporting(0);
include('../conectar.php');


// INCLUDE DA DOS ARQUIVOS E CLASSES PARA GERAR EXCEL
include "PHPExcel.php";
include "./PHPExcel/Writer/Excel2007.php";

require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();




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

$predio = strval($_GET['predio']);

$arquivo = $_GET['arquivo'];


if($arquivo == 'check'){
        
$sql = $pdo->query("SELECT * FROM TABLE_CHECK where DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY DATA_2");

$html  = '<html>';
$html .= '<body>';
$html .= '<b>Check List realizado - Predio : '.$predio.' de </b>: '.date('d-m-Y',strtotime($dataInglesInicial)).' - '. date('d-m-Y',strtotime($dataInglesFinal));
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

//PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$sqlchamado = $pdo->query("SELECT * FROM CHAMADOS where data_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and predio = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY data_2") ;

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
 $html .= "<td>".$res['andar']." </td>";
 $html .= "<td>".$res['sala']." </td>";
 $html .= "<td>".$res['problema']." </td>";
 $html .= "<td>".$res['OS_BANCO']." </td>";
 $html .= "<td>".$res['status']." </td>";
 $html .= "<td>".$res['data_fechado']." </td>";
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

if($_GET['arquivo'] == 'ativos'){

//PEGA O OS DADOS DOS ATIVOS

$sql = $pdo->query("SELECT * FROM QRCODETABLE WHERE PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY ANDAR,SALA") ;


$html  = '<html>';
$html .= '<body>';
$html .= '<b>Lista de Ativos - '.$predio;
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

        //PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        
        $sqlchamado = $pdo->query("SELECT * FROM PREVENTIVAS where DATA_PREV BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY DATA_PREV") ;
        
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
        
        
        
        foreach ($sqlchamado as $res) {
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

                //PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                
                $sqlchamado = $pdo->query("SELECT * FROM MANUTENCAO where DATA_RETIRADA BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY DATA_RETIRADA") ;
                
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
                
                
                
                foreach ($sqlchamado as $res) {
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

                        //PEGA O OS DADOS DOs CHAMADOS --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                        
                        $sqlchamado = $pdo->query("SELECT * FROM MOVER where DATA_2 BETWEEN '$dataInglesInicial' and '$dataInglesFinal' and DE_PREDIO = '$predio' AND CLIENTE != 'EVENTOS' ORDER BY DATA_2") ;
                        
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
                        
                        
                        
                        foreach ($sqlchamado as $res) {
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
