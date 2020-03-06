<?php
 
 include_once('conectar.php');
$pegaValores = $_POST['detalheAndar'];
$explodeValores = explode('-',$pegaValores);
$dataInicial = $_POST['datasInicio'];
$dataFinal = $_POST['datasFinal'];

echo '<div class="text-center">'.$explodeValores[0].' - '.$explodeValores[1].'</div>';

$selecao = "SELECT sala, problema, qrcode,ativo, count(id_chamado) AS qtd,status,observacao,OS_BANCO,solucao FROM CHAMADOS WHERE data_2 BETWEEN '$dataInicial' and '$dataFinal' and predio = '$explodeValores[0]' AND andar = '$explodeValores[1]' AND problema != '' AND cliente != 'EVENTOS'  GROUP BY sala, problema,qrcode,ativo,status,observacao,OS_BANCO,solucao  ORDER BY qtd desc";
$resultado = $pdo->query($selecao);
echo '<div class="table-responsive">';
echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Qtd</th>';
echo '<th scope="col">Sala</th>';
echo '<th scope="col">Problema</th>';
echo '<th scope="col">Qrcode</th>';
echo '<th scope="col">Ativo</th>';
echo '<th scope="col">Status</th>';
echo '<th scope="col">Desc</th>';
echo '<th scope="col">Solicitante</th>';
echo '<th scope="col">solucao</th>';

echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($resultado as $res) {
    echo '<tr>';
    
    echo '<td>'.$res['qtd'].'</td>';
    echo '<td>'.utf8_encode($res['sala']).'</td>';
    echo '<td>'.utf8_encode($res['problema']).'</td>';
    echo '<td>'.$res['qrcode'].'</td>';
    echo '<td>'.$res['ativo'].'</td>';
    echo '<td>'.$res['status'].'</td>';
    echo '<td>'.$res['observacao'].'</td>';
    echo '<td>'.$res['OS_BANCO'].'</td>';
    echo '<td>'.$res['solucao'].'</td>';
    echo '</tr>';
    
                

};

echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '</div>';






?>