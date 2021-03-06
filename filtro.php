<?php

// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

include('conectar.php');

    $filtro = $_POST['filtrado'];
    $predio = $_POST['predio'];
    $dataInicial = $_POST['datasInicio'];
    $dataFinal = $_POST['datasFinal'];

    echo '<div class="text-center"><b>De</b>: '.date('d-m-Y', strtotime( $dataInicial))." <b>Até</b> : ".date('d-m-Y', strtotime($dataFinal)).'</div>';

    if($filtro == 1){// MOSTRA AS INFORMAÇÕES POR ANDAR 
       
        $selecao = "SELECT predio, andar, count(id_chamado) AS qtd FROM CHAMADOS WHERE data_2 BETWEEN '$dataInicial' and '$dataFinal' and  predio = '$predio' AND problema != '' AND cliente != 'EVENTOS' GROUP BY predio, andar ORDER BY qtd DESC";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Qtd</th>';
        echo '<th scope="col">Predio</th>';
        echo '<th scope="col">Andar</th>';
        echo '<th scope="col">Detalhes</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<td>'.utf8_encode($res['qtd']).'</td>';
            echo '<td>'.utf8_encode($res['predio']).'</td>';
            echo '<td>'.utf8_encode($res['andar']).'</td>';
            echo '<td> <button type="button" id="andardetalhes" class="btn btn-info" value="'.utf8_encode($res['predio']).'-'.utf8_encode($res['andar']).'" >Detalhes</button> </td>';
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

    }else if($filtro ==2){ // MOSTRA AS INFORMAÇÕES POR SALA
       
        $selecao = "SELECT count(problema) AS qtd, predio,sala,andar,problema,qrcode,ativo,observacao,status,OS_BANCO,solucao FROM CHAMADOS WHERE data_2 BETWEEN '$dataInicial' and '$dataFinal' and predio = '$predio' AND problema != '' AND cliente != 'EVENTOS' GROUP by predio,sala,andar,problema,qrcode,ativo,observacao,status,OS_BANCO,solucao ORDER BY qtd DESC,sala ASC";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Qtd</th>';
        echo '<th scope="col">Andar</th>';
        echo '<th scope="col">Sala</th>';
        echo '<th scope="col">Problema</th>';
        echo '<th scope="col">Qrcode</th>';
        echo '<th scope="col">Ativo</th>';
        echo '<th scope="col">Status</th>';
        echo '<th scope="col">Desc</th>';
        echo '<th scope="col">Solicitante</th>';
        echo '<th scope="col">Solução</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<td>'.$res['qtd'].'</td>';
            echo '<td>'.$res['andar'].'</td>';
            echo '<td>'.$res['sala'].'</button></td>';
            echo '<td>'.$res['problema'].'</td>';
            echo '<td>'.$res['qrcode'].'</td>';
            echo '<td>'.$res['ativo'].'</td>';
            echo '<td>'.$res['status'].'</td>';
            echo '<td>'.$res['observacao'].'</td>';
            echo '<td>'.$res['OS_BANCO'].'</td>';
            echo '<td>'.$res['solucao'].'</td>';
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

    }else if($filtro == 3){ // MOSTRA AS INFORMAÇÕES POR EQUIPAMENTO
        $selecao = "SELECT ativo,qrcode,problema, count(problema) as qtd FROM `CHAMADOS` where data_2 BETWEEN '$dataInicial' and '$dataFinal' and problema != '' and predio = '$predio' group by qrcode order by qtd desc";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Qtd</th>';
        echo '<th scope="col">Ativo</th>';
        echo '<th scope="col">Qrcode</th>';
        
        
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<th>'.$res['qtd'].'</th>';
            echo '<td>'.utf8_encode($res['ativo']).'</td>';
            echo '<td><button type="button" class="btn btn-info"  id="ativodetalhes">'.utf8_encode($res['qrcode']).'</button></td>';
            
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';


      

    }else{

        echo "...Escolha uma Opção...";
    };


?>