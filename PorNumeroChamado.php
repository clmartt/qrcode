<?php
 
include_once('conectar.php');
$numeroChamdo = $_POST['numero'];



$selecao = "SELECT * FROM CHAMADOS WHERE id_chamado ='$numeroChamdo'  AND cliente != 'EVENTOS' ";
$resultado = $pdo->query($selecao);

echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';

echo '<th scope="col">Andar</th>';
echo '<th scope="col">Sala</th>';
echo '<th scope="col">Problema</th>';
echo '<th scope="col">Aberto</th>';
echo '<th scope="col">Detalhe</th>';

echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($resultado as $res) {
    echo '<tr>';
    echo '<td>'.$res['andar'].'</td>';
    echo '<td>'.utf8_encode($res['sala']).'</td>';
    echo '<td>'.utf8_encode($res['problema']) .'</td>';
    echo '<td>'.date('d-m-Y', strtotime( $res['data_2'])).'</td>';
    echo '<td>'.utf8_encode($res['observacao']).'</td>';
  
    echo '</tr>';
    
                

};

echo '</tr>';
echo '</tbody>';
echo '</table>';






?>