
<?php


ob_start();
session_start(); //pega a sessao do usuario
$cliente = $_SESSION['cliente'];

include("conectar.php");
// cabeçalho para utf8 


$logado = $_GET['usuario']; // guardando usuario logado na variavel

 


if($_SESSION['cliente']=='KVM'){
// primeira forma	
$select = "SELECT * FROM  QRCODETABLE GROUP BY PREDIO"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query

}else{

  
$select = "SELECT * FROM  QRCODETABLE WHERE CLIENTE= '$cliente' GROUP BY PREDIO"; // query de consulta ao banco
$result = $pdo->query($select); // guardando o resultado da query acima na variavel
$qtd = $result-> rowCount(); // contanto o numero de linhas retornadas pela query

};






?>




<!DOCTYPE html>
<html lang="pt-br">
  <head>

  	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ADICIONAR ATIVO </title>

	<script src="jquery-3.2.1.min.js"></script>
    <script>
    	
    	
    	$(document).ready(function(){
            $("#setor").hide();
            $("#predio").change(function(){
                var predio  = $(this).val();
                var load = '<div class="text-center"><img src="./images/ajax.gif"></div>';
                $("#carregaAndar").append(load);
                $("#andar").empty();
                $("#andar").append('<option>Selecione Andar</option>');
                $("#sala").empty();
                $("#setor").empty();
               

                $.getJSON('./json/qrcodetable/pegaandar.php',{predios:predio},function(data){
                    for(i=0;i<data.length;i++){
                        var opcao = '<option>'+ data[i].ANDAR+'</option>';
                        $("#andar").append(opcao);
                    }
                            
                    $("#carregaAndar").empty();
                });
            });

            $("#andar").change(function(){
                var predio = $("#predio option:selected").val();
                var andar  = $(this).val();
                var load = '<div class="text-center"><img src="./images/ajax.gif"></div>';
                $("#carregaSala").append(load);
                $("#sala").empty();
                $("#sala").append('<option>Selecione Sala</option>');
                           

                $.getJSON('./json/qrcodetable/pegasala.php',{predios:predio,andares:andar},function(data){
                    for(i=0;i<data.length;i++){
                        var opcao = '<option>'+ data[i].SALA+'</option>';
                        $("#sala").append(opcao);
                    }
                            
                    $("#carregaSala").empty();
                });
            });



            $("#sala").change(function(){
                var predio = $("#predio option:selected").val();
                var andar = $("#andar option:selected").val();
                var sala  = $(this).val();
                var load = '<div class="text-center"><img src="./images/ajax.gif"></div>';
                $("#setor").empty();
                $("#carregaSetor").append(load);
                $("#setor").append('<option>Selecione Setor</option>');
                           

                $.getJSON('./json/qrcodetable/pegasetor.php',{predios:predio,andares:andar,salas:sala},function(data){
                    
                    for(i=0;i<data.length;i++){
                        
                        if(data[i].SETOR == ""){
                            $("#setor").empty();
                           
                        }else{

                            var opcao = '<option>'+data[i].SETOR+'</option>';
                             $("#setor").append(opcao);
                             
                             $("#setor").fadeIn();
                        }
                        
                    }// end for
                            
                         $("#carregaSetor").empty();

                    
                    
                });
            });


            $("#buscaAtivos").click(function(){
                $("#listaAtivos").empty();
                var load = '<div class="text-center"><img src="./images/ajax.gif"></div>';
                $("#listaAtivos").append(load);
                var predio = $("#predio option:selected").val();
                var andar = $("#andar option:selected").val();
                var sala = $("#sala option:selected").val();
                var setor = $("#setor option:selected").val();
                $.post('getAtivosSala.php',{predio:predio,andar:andar,sala:sala,setor:setor},function(data){
                     
                    $("#listaAtivos").empty();
                   
                    $("#listaAtivos").append(data);
                });


            });


    		
    	});

    </script>

      <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

  </head>
  <body>

  


  </div>
      <?php include("menu.php");?>

<br>

<div class="container">
    <h5>Ativos por Sala</h5>
      <div class="card-body shadow p-3 mb-5 bg-white rounded">
      <form method="GET" action="./insertativo/formInsert.php">
            <div class="form-group">
                <select class="form-control form-control-sm" id="predio" name="predio">
                    <option>Escolha Prédio</option>
                    <?php
                        foreach ($result as $linha) {
                            echo '<option>'.$linha['PREDIO'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="text-center" id="carregaAndar"></div>

            <div class="form-group">
                <select class="form-control form-control-sm" id="andar" name="andar">
                    <option>Escolha Andar</option>
                </select>
            </div>

            <div class="text-center" id="carregaSala" ></div>
            <div class="form-group">
                <select class="form-control form-control-sm" id="sala" name="sala">
                    <option>Escolha Sala</option>
                </select>
            </div>
            <div class="text-center" id="carregaSetor" ></div>
            <div class="form-group">
                <select class="form-control form-control-sm" id="setor" name="setor">
                <option>Escolha Setor</option>
                </select>
            </div>
            
            
            <div class="text-center"><button type="button" class="btn btn-primary" id="buscaAtivos">Buscar</button></div>
        </form>
        <br>

        <div id="listaAtivos"></div>
                        
 </div>
     


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    <?php include('Jmodal.php');?>

  </body>
</html>