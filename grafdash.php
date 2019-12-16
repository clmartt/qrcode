
<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset','UTF-8');
ob_start();
session_start();
header("Refresh: 300"); // FAZ REFRESH EM 1 MINUTO
$cliente = $_SESSION['cliente']; // PEGA O PERFIL DO USUARIO E GUARDA NO CLIENTE
$datahoje = date("Y-m-d"); // PEGA A DATA DE HOJE;


// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 

$PREDIO = urldecode($_GET['predio']); // PEGA O PREDIO ENVIADO DO FORMULARIO DA MESMA PAGINA 
$ano = date('Y');



$mysqli = new mysqli($host, $user, $pass, $db);




//==============================================================================================================================

// pega os valores para o grafico de pizza

$sql = "SELECT count(problema) as qtd, problema FROM CHAMADOS WHERE problema != ''  AND predio = '$PREDIO' AND ano = '$ano' AND cliente != 'EVENTOS' GROUP BY problema ORDER BY qtd desc";
$result = $mysqli->query($sql);

$i = 0;
$v = 0;
$listprob = array(); // CRIA ARRAY PARA GUARDAR O NOME DOS PROBLEMAS
$listqtd = array();  //CRIA O ARRAY PARA GUARDAR A QUANTIDADE

while ($row = mysqli_fetch_object($result)) {
  $prob = utf8_encode($row->problema);// recebe os problemas
  $probqtd = $row->qtd; // recebe a quantidade dos problemas (count(problema) as qtd)
  $listprob[$i] = $prob; // joga dentro deste array os problemas
  $listqtd[$i] = $probqtd; // joga dentro deste array as quantidades

  $i = $i +1;

  };


  //==============================================================================================================================

  // PEGA OS VALORES PARA A TABELA DE SALAS COM PROBLEMAS


  $sqltabela1 = "SELECT andar,sala,problema,data_2 FROM CHAMADOS WHERE problema != '' and status ='ANDAMENTO' AND predio = '$PREDIO'  AND cliente != 'EVENTOS' ORDER BY id_chamado,andar";
  $resulttabela1 = $mysqli->query($sqltabela1);
  
  $it = 0;
  $v = 0;
  $tabela_andar = array();
  $tabela_sala = array();
  $tabela_problema = array();
  $tabela_dif_data = array();
  
  while ($row = mysqli_fetch_object($resulttabela1)) {
    $A_andar = $row->andar; // pega o problema
    $A_sala = $row->sala; // pega o andar
    $A_problema = utf8_encode($row->problema); // pega a sala
    $A_data_chamado = $row->data_2; // pega a data do chamado
    $A_data_chamado_tratada = date_create($A_data_chamado);
    $datahoje_tratada = date_create(date('Y-m-d'));
    $diferenca_data = date_diff($A_data_chamado_tratada,$datahoje_tratada);


    

    $tabela_andar[$it] = $A_andar;
    $tabela_sala[$it] = $A_sala;
    $tabela_problema[$it] = $A_problema;
    $tabela_dif_data[$it] = $A_data_chamado;
    $tabela_dif_data[$it] = $diferenca_data->days;
  
    $it = $it +1;

  
    };

    //==============================================================================================================================

  // PEGA OS VALORES PARA MONTAR A TABELA DE CHECK LIST DE HOJE


  $sqltabela2 = "SELECT * FROM TABLE_CHECK WHERE PREDIO = '$PREDIO' AND DATA_2 = '$datahoje' AND CLIENTE != 'EVENTOS' GROUP BY SALA ORDER BY IDTABLE_CHECK DESC";
  $resulttabela2 = $mysqli->query($sqltabela2);
  
  $it2 = 0;
  $v = 0;
  $tabela_andar_check = array();
  $tabela_sala_check = array();
  $tabela_usuario_check = array();
  $tabela_usuario_horas = array();
  
  while ($row = mysqli_fetch_object($resulttabela2)) {
    $A_andar_check = $row->ANDAR; // pega o problema
    $A_sala_check = $row->SALA; // pega o andar
    $A_usuario_check = $row->NOME_USER; // pega a sala
    $A_horas_check = $row->HORAS; // pega a sala

    $tabela_andar_check[$it2] = $A_andar_check;
    $tabela_sala_check[$it2] = $A_sala_check;
    $tabela_usuario_check[$it2] = $A_usuario_check;
    $tabela_usuario_horas[$it2] = $A_horas_check;
  
    $it2 = $it2 +1;

  
    };



//==============================================================================================================================

    // pega os valores para o grafico de barra

  $sqlbarra = "SELECT count(problema) as qtd, mes,data_2 FROM CHAMADOS WHERE problema != ''  AND predio = '$PREDIO' AND cliente != 'EVENTOS' GROUP BY mes ORDER BY month(data_2)";
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

$sqlandamento = "SELECT COUNT(problema) as qtd FROM `CHAMADOS` WHERE status = 'ANDAMENTO' AND predio = '$PREDIO' AND cliente != 'EVENTOS'";
$resultandamento = $mysqli->query($sqlandamento);
$row = mysqli_fetch_assoc($resultandamento);
 

// pega os valores dos chamados abertos e RESOLVIDO

$sqlresolvido = "SELECT COUNT(problema) as qtd FROM `CHAMADOS` WHERE status = 'RESOLVIDO' AND predio = '$PREDIO' AND cliente != 'EVENTOS'";
$resultresolvido = $mysqli->query($sqlresolvido);
$row2= mysqli_fetch_assoc($resultresolvido);


//==============================================================================================================================
// PEGA O PREDIO PARA PREENCHER COMBO BOX DO LADO DIRETO DA PAGINA

if($cliente=='KVM'){
  $sqlpredio = "SELECT PREDIO FROM `QRCODETABLE` GROUP BY PREDIO";
  $resultpredio = $mysqli->query($sqlpredio);
  $row3= mysqli_fetch_assoc($resultpredio);
  

}else {

  $sqlpredio = "SELECT * FROM `QRCODETABLE` WHERE CLIENTE = '$cliente' GROUP BY PREDIO";
  $resultpredio = $mysqli->query($sqlpredio);
  $row3= mysqli_fetch_assoc($resultpredio);

};

//==============================================================================================================================




?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>






<!-- ======================================================================================================================-->




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
// faz a requisição de informações via ajax para os filtros 
//=================================================================================================================================
          $(document).ready(function(){
            $(".card-body").hide();

            $("#filtro").change(function(){
              var texto = $(this).val();
              var predios = $('#localPredio').val();
             
              
              $(".card-body").fadeIn();
             $.post( "filtro.php",{filtrado: texto,predio: predios}, function( data ) {
              $(".card-body").html(data);
             });



            });

          });

       </script>
    <script>
    	
                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {'packages':['corechart']});
                            

                          // Set a callback to run when the Google Visualization API is loaded.
                          google.charts.setOnLoadCallback(drawChart);
                          
                          //google.charts.setOnLoadCallback(drawTable);

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
<!-- ======================================================================================================================-->
    
    
    
    
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

<!-- ======================================================================================================================-->
    <script> 

// script para a tabela de salas com problemas

                google.charts.load('current', {'packages':['table']});
                google.charts.setOnLoadCallback(drawTable);

                function drawTable() {
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Andar');
                  data.addColumn('string', 'Sala');
                  data.addColumn('string', 'Problema');
                  data.addColumn('string', 'Tempo');
                  data.addRows([

                    <?php
                            $kt1 = $it;
                            for ($i=0; $i < $kt1; $i++) { 
                            ?>
                             ['<?php echo $tabela_andar[$i] ?>','<?php echo utf8_encode($tabela_sala[$i]) ?>','<?php echo  $tabela_problema[$i] ?>','<?php echo  $tabela_dif_data[$i] ?>'],
                            
                    <?php } ?>

                    
                    
                  ]);

                  var table = new google.visualization.Table(document.getElementById('table_div'));

                  table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
                }
    
        
    </script>

    <!-- ======================================================================================================================-->
    
    
    
    
    
    
    <script> 

// SCRIPT PARA PEGAR AS INFORMAÇOES DE CHECK LIST REALIZADAS NA DATA DE HOJE-----------------------------------------------------

                            google.charts.load('current', {'packages':['table']});
                            google.charts.setOnLoadCallback(drawTable);

                            function drawTable() {
                              var data = new google.visualization.DataTable();
                                  data.addColumn('string', 'Andar');
                                  data.addColumn('string', 'Sala');
                                  data.addColumn('string', 'Horas');
                                  data.addColumn('string', 'Técnico');
                                  data.addRows([

                                    <?php
                                            $ktc = $it2;
                                            for ($i=0; $i < $ktc; $i++) { 
                                            ?>
                                            ['<?php echo $tabela_andar_check[$i] ?>','<?php echo utf8_encode($tabela_sala_check[$i]) ?>','<?php echo  $tabela_usuario_horas[$i] ?>','<?php echo  $tabela_usuario_check[$i] ?>'],
                                            
                                    <?php } ?>

                                    
                                    
                                  ]);

                              var table = new google.visualization.Table(document.getElementById('table_div_check'));

                              table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
                            }
    
        
    </script>
   




      <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

  </head>
  <body>
 
              <input type="hidden" value="<?php echo $PREDIO?>" name="localPredio" id="localPredio">

            <nav class="navbar sticky-top navbar-light bg-light">
            <a class="navbar-brand" href="principal.php">
              <img src="./images/logo.gif" width="30" height="30" class="d-inline-block align-top" alt="">
              ReQuest - Dash <?php echo ' '.$PREDIO?>
            </a>

            <form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <div class="input-group">
            <select class="custom-select" id="inputGroupSelect04" name="predio">
              <option selected>Escolha o Prédio</option>
              <?php
              foreach ($resultpredio as $res) {
                      
              echo'<option value="'.$res['PREDIO'].'">'.$res['PREDIO'].'</option>';
            
              
              };
              ?>
            </select>
            <div class="input-group-append">
            <input class="btn btn-info" type="submit" value="Submit">
            </div>
          </div>

              </form>
          </nav>
            <p></p>
            

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="filtro">Detalhes</label>
                    </div>
                    <select class="custom-select" id="filtro">
                      <option selected>Opções...</option>
                      <option value="1">Chamados por Andar(10+)</option>
                      <option value="2">Chamados por Sala(10+)</option>
                      <option value="3">Chamados por Equipamento(10+)</option>
                    </select>
            </div>
<p></p>
            <div class="card">
              <div class="card-body">
                CARREGANDO ...
              </div>
            </div>
<p></p>
<?php

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
                        <div class="col-sm-6">
                        <div class="card-header">
                          Sala com Ocorrências em Andamento
                        </div>
                          <div >
                            <div id="table_div" class="shadow p-3 mb-5 bg-white rounded">
                            
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="card-header">
                          Check List realizados hoje
                        </div>
                          <div >
                            <div id="table_div_check" class="shadow p-3 mb-5 bg-white rounded">
                            
                            </div>
                          </div>
                        </div>
              </div>
  


<br>
<div id="chart_div3"></div>




    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

  </body>
</html>