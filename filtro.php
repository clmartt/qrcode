<?php

// cabeçalho para utf8 
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');

$dsn = 'mysql:host=qrcodekvm.mysql.dbaas.com.br;dbname=qrcodekvm'; 
$usuario = 'qrcodekvm'; 
$senha = 'qrcodekvm';  


try { 

  
    $pdo = new PDO($dsn, $usuario, $senha); 
    } catch (PDOException $e) { 
    echo $e->getMessage(); 
    exit(1); 
    };

    $filtro = $_POST['filtrado'];
    $predio = $_POST['predio'];

    if($filtro == 1){// MOSTRA AS INFORMAÇÕES POR ANDAR 
       
        $selecao = "SELECT predio, andar, count(id_chamado) AS qtd FROM CHAMADOS WHERE predio = '$predio' AND problema != '' GROUP BY andar ORDER BY qtd DESC LIMIT 10";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Prédio</th>';
        echo '<th scope="col">Andar</th>';
        echo '<th scope="col">Qtd</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<td>'.utf8_encode($res['predio']).'</td>';
            echo '<td>'.utf8_encode($res['andar']).'</td>';
            echo '<td>'.utf8_encode($res['qtd']).'</td>';
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

    }else if($filtro ==2){ // MOSTRA AS INFORMAÇÕES POR SALA
       
        $selecao = "SELECT count(problema) AS qtd, predio,sala,andar FROM CHAMADOS WHERE predio = '$predio' AND problema != '' GROUP by sala,andar ORDER BY qtd DESC LIMIT 10";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Qtd</th>';
        echo '<th scope="col">Prédio</th>';
        echo '<th scope="col">Andar</th>';
        echo '<th scope="col">Sala</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<td>'.utf8_encode($res['qtd']).'</td>';
            echo '<td>'.utf8_encode($res['predio']).'</td>';
            echo '<td>'.utf8_encode($res['andar']).'</td>';
            echo '<td>'.utf8_encode($res['sala']).'</td>';
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

    }else if($filtro == 3){ // MOSTRA AS INFORMAÇÕES POR EQUIPAMENTO
        $selecao = "SELECT ativo,qrcode,problema, count(problema) as qtd FROM `CHAMADOS` where problema != '' and predio = '$predio' group by qrcode order by qtd desc LIMIT 10";
        $result = $pdo->query($selecao);

        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Qtd</th>';
        echo '<th scope="col">Ativo</th>';
        echo '<th scope="col">Qrcode</th>';
        echo '<th scope="col">Problema</th>';
        
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $res) {
            # code...
        
            echo '<tr>';
            echo '<th>'.$res['qtd'].'</th>';
            echo '<td>'.utf8_encode($res['ativo']).'</td>';
            echo '<td>'.utf8_encode($res['qrcode']).'</td>';
            echo '<td>'.utf8_encode($res['problema']).'</td>';
            
            echo '</tr>';
        };
            echo '</tbody>';
            echo '</table>';
            echo '</div>';


      

    }else{

        echo "...Escolha uma Opção...";
    };


?>