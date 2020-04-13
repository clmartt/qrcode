<?php
include('../conectar.php');
ob_start();
session_start();


$andar = '';
$ano = date("Y");
$permissao = $_SESSION['permissao'];


//pegar predio
$pegapredio = $pdo->query("SELECT predio from CHAMADOS WHERE cliente = '$permissao' and status = 'ANDAMENTO' AND ano = '$ano' GROUP BY predio");







if(isset($_GET['predio'])){
    $predio = $_GET['predio'];
}else{
    $predio = "";
}


if($predio!== "TODOS" && $predio !== "" ){

    $problemas = $pdo->query("SELECT problema, count(problema) as qtdP from CHAMADOS WHERE ano = '$ano' AND predio = '$predio' AND status ='ANDAMENTO' and cliente = '$permissao' GROUP BY problema ORDER BY qtdP  ")->fetchAll();

    $prob = array();
    $qtdP = array();
    $i = 0;
    foreach ($problemas as $p) {
        $problemas = $p['problema'];
        $quantidades = $p['qtdP'];
        $prob[$i] = $problemas;
        $qtdP[$i] = $quantidades;
        $i++;
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------
    $sqlPredio = $pdo->query("SELECT predio, count(problema) as qtd FROM CHAMADOS WHERE predio = '$predio' and cliente = '$permissao' AND status ='ANDAMENTO' GROUP BY predio ORDER BY qtd");
    
    $getPredio = array();
    $getqtd = array();
    $c = 0;
    
    foreach ($sqlPredio as $q) {
       $Tpredio = $q['predio'];
       $Tqtd = $q['qtd'];
       $getPredio[$c] =  $Tpredio;
       $getqtd[$c] = $Tqtd;
      
    
        $c++;
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------
    
    $sqltabela1 = $pdo->query("SELECT id_chamado,predio,andar,sala,problema,data_2 FROM CHAMADOS WHERE ano ='$ano' and status ='ANDAMENTO' AND predio = '$predio' and cliente = '$permissao' ORDER BY id_chamado,andar")->fetchAll(PDO::FETCH_OBJ);
      $tabela_Idchamado = array();
      $tabela_Predio = array();
      $tabela_andar = array();
      $tabela_sala = array();
      $tabela_problema = array();
      $tabela_dif_data = array();
      $it = 0;
    
      foreach ($sqltabela1 as $row) {
        $A_Idchamado = $row->id_chamado;// pega os IDs dos chamados;
        $A_Predio = $row->predio; // pega o problema
        $A_andar = $row->andar; // pega o problema
        $A_sala = $row->sala; // pega o andar
        $A_problema = $row->problema; // pega a sala
        $A_data_chamado = $row->data_2; // pega a data do chamado
        $A_data_chamado_tratada = date_create($A_data_chamado);
        $datahoje_tratada = date_create(date('Y-m-d'));
        $diferenca_data = date_diff($A_data_chamado_tratada,$datahoje_tratada);
        
        $tabela_Idchamado[$it] = $A_Idchamado;
        $tabela_Predio[$it] = $A_Predio;
        $tabela_andar[$it] = $A_andar;
        $tabela_sala[$it] = $A_sala;
        $tabela_problema[$it] = $A_problema;
        $tabela_dif_data[$it] = $A_data_chamado;
        $tabela_dif_data[$it] = $diferenca_data->days;
      
    
        $it = $it +1;
    
      }
    

}else{

  

    $problemas = $pdo->query("SELECT problema, count(problema) as qtdP from CHAMADOS WHERE ano = '$ano' AND status ='ANDAMENTO' and cliente = '$permissao' GROUP BY problema ORDER BY qtdP DESC ")->fetchAll();

    $prob = array();
    $qtdP = array();
    $i = 0;
    foreach ($problemas as $p) {
        $problemas = $p['problema'];
        $quantidades = $p['qtdP'];
        $prob[$i] = $problemas;
        $qtdP[$i] = $quantidades;
        $i++;
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------
    $sqlPredio = $pdo->query("SELECT predio, count(problema) as qtd FROM CHAMADOS WHERE cliente = '$permissao' AND status ='ANDAMENTO' GROUP BY predio ORDER BY qtd desc");
    
    $getPredio = array();
    $getqtd = array();
    $c = 0;
    
    foreach ($sqlPredio as $q) {
       $Tpredio = $q['predio'];
       $Tqtd = $q['qtd'];
       $getPredio[$c] =  $Tpredio;
       $getqtd[$c] = $Tqtd;
      
    
        $c++;
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------------------
    
    $sqltabela1 = $pdo->query("SELECT id_chamado,predio,andar,sala,problema,data_2 FROM CHAMADOS WHERE ano ='$ano' and status ='ANDAMENTO'  and cliente = '$permissao' ORDER BY id_chamado,andar")->fetchAll(PDO::FETCH_OBJ);
    $tabela_Idchamado = array();
    $tabela_Predio = array();
    $tabela_andar = array();
    $tabela_sala = array();
    $tabela_problema = array();
    $tabela_dif_data = array();
      $it = 0;
    
      foreach ($sqltabela1 as $row) {
        $A_Idchamado = $row->id_chamado;// pega os IDs dos chamados;
        $A_Predio = $row->predio; // pega o problema
        $A_andar = $row->andar; // pega o problema
        $A_sala = $row->sala; // pega o andar
        $A_problema = $row->problema; // pega a sala
        $A_data_chamado = $row->data_2; // pega a data do chamado
        $A_data_chamado_tratada = date_create($A_data_chamado);
        $datahoje_tratada = date_create(date('Y-m-d'));
        $diferenca_data = date_diff($A_data_chamado_tratada,$datahoje_tratada);
        
        $tabela_Idchamado[$it] = $A_Idchamado;
        $tabela_Predio[$it] = $A_Predio;
        $tabela_andar[$it] = $A_andar;
        $tabela_sala[$it] = $A_sala;
        $tabela_problema[$it] = $A_problema;
        $tabela_dif_data[$it] = $A_data_chamado;
        $tabela_dif_data[$it] = $diferenca_data->days;
      
      
    
        $it = $it +1;
    
      }




}




?>

<!doctype html>
<html lang="en">
  <head>

      <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript"></script>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>



    <script type="text/javascript">
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
                               ['<?php echo $prob[$i] ?>',<?php echo $qtdP[$i] ?>,'<?php echo "#b87333" ?>'],
                              
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
                    ["Predio", "Qtd", { role: "style" } ],
                    <?php
                            $kb = $c;
                            for ($i=0; $i < $kb; $i++) { 
                            ?>
                             ['<?php echo $getPredio[$i] ?>',<?php echo $getqtd[$i] ?>,'<?php echo "red" ?>'],
                            
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
                    title: "Chamados em Andamento",
                    width: '100%',
                    height: '100%',
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.BarChart(document.getElementById("chart_div2"));
                  chart.draw(view, options);
              }  


    </script>


   

<script> 

// script para a tabela de salas com problemas

                google.charts.load('current', {'packages':['table']});
                google.charts.setOnLoadCallback(drawTable);

                function drawTable() {
                  var data = new google.visualization.DataTable();
              
                  data.addColumn('string', 'Predio');
                  data.addColumn('string', 'Andar');
                  data.addColumn('string', 'Sala');
                  data.addColumn('string', 'Problema');
                  data.addColumn('string', 'Tempo');
                  data.addRows([

                    <?php
                            $kt1 = $it;
                            for ($i=0; $i < $kt1; $i++) { 
                            ?>
                             ['<?php echo $tabela_Predio[$i] ?>','<?php echo $tabela_andar[$i] ?>','<?php echo $tabela_sala[$i]?>','<?php echo  $tabela_problema[$i] ?>','<?php echo  $tabela_dif_data[$i] ?>'],
                            
                    <?php } ?>

                    
                    
                  ]);

                  var table = new google.visualization.Table(document.getElementById('table_div'));
                  

                  table.draw(data, {allowHtml:true, showRowNumber: true, width: '100%', height: '100%'});
                 
                }
    
        
    </script>


  </head>
  <body>
  

  
<div >
        <div class="form-check form-check-inline">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Prédios</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="predio">
                    <option value="TODOS" selected>Todos</option>
                    <?php 
                        foreach ($pegapredio as $predio) {
                            echo '<option>'.$predio['predio'].'</option>';
                        }
                    ?>
                   
                </select>
                <div > <button type="submit" class="btn btn-info">Buscar</button></div>
                </div>
                
        </form>
        <br>


        </div>


        <div class="row ">
                <div class="col-sm-6 shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="card">
                    <div class="card-body " id="chart_div" >
                        
                    </div>
                    </div>
                </div>

        
              <div class="col-sm-6 shadow-sm p-3 mb-5 bg-white rounded">
                  <div class="card">
                  <div class="card-body"  id="chart_div2">
                      
                    
                  </div>
                  </div>
              </div>

             
        </div>
       
                  <div class="card">
                        <div class="card-body table-responsive"  id="table_div">
                                              
                        </div>
                 
                 </div>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>
                        
     





</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>