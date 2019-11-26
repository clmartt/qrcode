
<?php
ob_start();
session_start();

// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predio']);



$mysqli = new mysqli($host, $user, $pass, $db);




//==============================================================================================================================

// pega os valores para o grafico de pizza

$sql = "SELECT count(problema) as qtd, problema FROM CHAMADOS WHERE problema != ''  AND predio = '$PREDIO' GROUP BY problema ORDER BY qtd desc";
$result = $mysqli->query($sql);

$i = 0;
$v = 0;
$listprob = array();
$listqtd = array();

while ($row = mysqli_fetch_object($result)) {
  $prob = $row->problema;// recebe os problemas
  $probqtd = $row->qtd; // recebe a quantidade dos problemas (count(problema) as qtd)
  $listprob[$i] = $prob; // joga dentro deste array os problemas
  $listqtd[$i] = $probqtd; // joga dentro deste array as quantidades

  $i = $i +1;

  };


  //==============================================================================================================================

  // pega os valores para o grafico de barra

  $sqlbarra = "SELECT count(problema) as qtd, mes,data_2 FROM CHAMADOS WHERE problema != ''  AND predio = '$PREDIO' GROUP BY mes ORDER BY month(data_2)";
  $resultbarra = $mysqli->query($sqlbarra);
  
  $ib = 0;
  $v = 0;
  $barralistprob = array();
  $barralistqtd = array();
  
  while ($row = mysqli_fetch_object($resultbarra)) {
    $probbarra = $row->mes;
    $probqtdbarra = $row->qtd;
    $barralistprob[$ib] = $probbarra;
    $barralistqtd[$ib] = $probqtdbarra;
  
    $ib = $ib +1;

  
    };

//==============================================================================================================================
    // TABELA DE CIMA RESOLVIDO E ANDAMENTO

 // pega os valores dos chamados abertos e em andamento

$sqlandamento = "SELECT COUNT(problema) as qtd FROM `CHAMADOS` WHERE status = 'ANDAMENTO' AND predio = '$PREDIO'";
$resultandamento = $mysqli->query($sqlandamento);
$row = mysqli_fetch_assoc($resultandamento);
 

// pega os valores dos chamados abertos e RESOLVIDO

$sqlresolvido = "SELECT COUNT(problema) as qtd FROM `CHAMADOS` WHERE status = 'RESOLVIDO' AND predio = '$PREDIO'";
$resultresolvido = $mysqli->query($sqlresolvido);
$row2= mysqli_fetch_assoc($resultresolvido);


?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Gráficos</title>

	<script src="jquery-3.2.1.min.js"></script>
    <script>
    	
                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {'packages':['corechart']});
                            

                          // Set a callback to run when the Google Visualization API is loaded.
                          google.charts.setOnLoadCallback(drawChart);
                          
                          google.charts.setOnLoadCallback(drawTable);

                          // Callback that creates and populates a data table,
                          // instantiates the pie chart, passes in the data and
                          // draws it.
                          function drawChart() {

                          // Create the data table.
                          var data = google.visualization.arrayToDataTable([
                            ['Problemas', 'QTD', { role: 'style' }],

                            <?php
                            $k = $i;
                            for ($i=0; $i < $k; $i++) { 
                            ?>
                             ['<?php echo $listprob[$i] ?>',<?php echo $listqtd[$i] ?>,'<?php echo "#b87333" ?>'],
                            
                            <?php } ?>
                
                          ]);

                          // Set chart options
                          var options = {'title':'Problemas Recorrentes',
                                          is3D: true,
                                          legend: 'botton',
                                          'width':'100%',
                                          'height':'100%',
                                          slices: { 0: {offset: 0.2},
                                                    1: {offset: 0.3},
                                                    2: {offset: 0.4},
                                                    
                                          },
                                                                            
                                          
                                          };

                          // Instantiate and draw our chart, passing in some options.
                          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                          chart.draw(data, options);
                          }


    </script>

    <script>


              google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ["Mes", "Qtd", { role: "style" } ],
                    <?php
                            $kb = $ib;
                            for ($i=0; $i < $kb; $i++) { 
                            ?>
                             ['<?php echo $barralistprob[$i] ?>',<?php echo $barralistqtd[$i] ?>,'<?php echo "blue" ?>'],
                            
                        <?php } ?>





                  ]);

                  var view = new google.visualization.DataView(data);
                  view.setColumns([0, 1,
                                  { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                  2]);

                  var options = {
                    title: "Problemas reportados por Mês",
                    width: '100%',
                    height: '100%',
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("chart_div2"));
                  chart.draw(view, options);
              }  
                
    
    </script>



   




      <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

  </head>
  <body>
  <?php include ('menu.php') ?>
  <?php
  
  echo '<div class="shadow p-3 mb-5 bg-white rounded">';
     echo '<nav class="navbar navbar-light bg-light">';
      echo '<a class="navbar-brand" href="problemas.php?predio='.$PREDIO.'">';
       echo '<ion-icon src="./icon/md-business.svg"  size="large" class="btn btn-warning"  ></ion-icon>';
        echo '  '.$PREDIO.' - Problemas ';
         echo '</a>';
          echo '</nav>';
     echo '</div>';


 
  echo'<table class="table table-hover">';
  echo'<thead>';
  echo'<tr class="text-center">';
  echo'<th scope="col">Resolvido</th>';
  echo'<th scope="col">Andamento</th>';
  echo'</tr>';
  echo'</thead>';
  echo'<tbody>';
  echo'<tr class="text-center">';
              
  echo'<td>'.$row2['qtd'].'</td>';
  echo'<td>'.$row['qtd'].'</td>';


  echo'</tbody>';
  echo'</table>';

 
  echo '<hr>';
  
  
  ?>

            <div class="row">
                        <div class="col-sm-6">
                          <div >
                            <div  id="chart_div" class="shadow p-3 mb-5 bg-white rounded">
                          
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div >
                            <div id="chart_div2" class="shadow p-3 mb-5 bg-white rounded">
                            
                            </div>
                          </div>
                        </div>
                        </div>
  

<hr>
<br>
<div id="chart_div3"></div>

<hr>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

  </body>
</html>