<?php
 
 include_once('conectar.php');
$pegaValores = $_POST['detalheSala'];
$explodeValores = explode('-',$pegaValores);
$sala = trim($explodeValores[2]);

echo '<div class="text-center">'.'teste: '.$explodeValores[2].'</div>';

$selecao = "SELECT * FROM CHAMADOS WHERE predio = 'CTO' AND andar = '9' and sala like '%".$sala."%' ";
$resultado = $pdo->query($selecao);

echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Qtd</th>';
echo '<th scope="col">Sala</th>';
echo '<th scope="col">Problema</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($resultado as $res) {
    echo '<tr>';
    
    echo '<td>'.$res['id_chamado'].'</td>';
    echo '<td>'.utf8_encode($res['sala']).'</td>';
    echo '<td>'.$res['problema'].'</td>';
    echo '</tr>';
    
                

};

echo '</tr>';
echo '</tbody>';
echo '</table>';






?>