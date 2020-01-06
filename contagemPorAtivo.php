<?php
 
include_once('conectar.php');
$pegaValores = $_POST['detalheAtivo'];
$dataInicial = $_POST['datasInicio'];
$dataFinal = $_POST['datasFinal'];


$selecao = "SELECT * FROM CHAMADOS WHERE data_2 BETWEEN '$dataInicial' and '$dataFinal' and qrcode = '$pegaValores' AND problema != '' AND cliente != 'EVENTOS' ";
$resultado = $pdo->query($selecao);

echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Andar</th>';
echo '<th scope="col">Sala</th>';
echo '<th scope="col">Problema</th>';
echo '<th scope="col">Status</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($resultado as $res) {
    echo '<tr>';
    
    echo '<td>'.$res['andar'].'</td>';
    echo '<td>'.utf8_encode($res['sala']).'</td>';
    echo '<td>'.utf8_encode($res['problema']) .'</td>';
    echo '<td>'.$res['status'].'</td>';
    echo '</tr>';
    
                

};

echo '</tr>';
echo '</tbody>';
echo '</table>';






?>