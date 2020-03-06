<?php
ob_start();
session_start();

$usuario = $_SESSION['email'];
$cliente = $_SESSION['cliente'];


//----------------------------------------------------------------------------------------------------------------------
if($usuario==""){
    header("Location: ../../../login.html");
}else{
    // inseri a barra de voltar
echo '<nav class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="../../../principal.php">
 
  Retornar
</a></nav>';
};
//----------------------------------------------------------------------------------------------------------------------



include("../../../conectar.php");




//----------------------------------------------------------------------------------------------------------------------
//RECEBE O QRCODE DA SALA 
$qrsala = $_GET['qrcodesala'];


// pega os equipamento da sala
$selEquipamentos = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRSALA = '$qrsala'"); 
//SOMENTE GUARDA A QUANTIDADE DE EQUIPAMENTOS
$qtd = $selEquipamentos->rowCount();

// abaixo para pegar informações do nome da sala
$nomesala = $pdo->query("SELECT * FROM QRCODETABLE WHERE QRSALA = '$qrsala' group by SALA");

foreach ($nomesala as $sala) {
    echo "<br>";
    echo "<div class='container'>";
    echo "<b>". $sala['PREDIO']. " - ".$sala['SALA']." - ".$sala['ANDAR']."º</b>";
    echo "<hr>";
    echo "</div>";
};


//----------------------------------------------------------------------------------------------------------------------
// PEGA OS PROBLEMAS DA TABELA PROBLEMA E COLOCA NO SELECT DO FORM DO MODAL
$pegaproblema = $pdo->query("SELECT * FROM PROBLEMAS");



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Check List por Sala</title>
    <script src="jquery-3.2.1.min.js"></script>

    <script>
        //inserir o value do botao que tem o qrcode no txt qrcode da janela modal
        $(document).on('click','#problemaqrcode',function(){
            
            $("#os").val("");
            $("#dproblema").val("");
            var qrcode = $(this).val();
            $("#txtqrcode").val(qrcode);
           

        });


        

        $(document).ready(function(){

            $("#checktudo").click(function(){
                var pegaqr = [];
                $(".btn-secondary,.btn-danger").each(function(){
                    pegaqr.push($(this).val());
                    
                                       
                 });
                 $.post('insertchecksala.php',{qrcode:pegaqr},function(data) {
                                       //alert(pegaqr);
                                       alert(data);
                                       $('td').fadeOut();
                                       $('#checktudo').text('CHECADO!').off();

                                                         
                   });      
                 
                
                 
                
               

            });


            $("#gravar").click(function(){
                var qrcode = $("#txtqrcode").val();
                var problema = $("#problema").val();
                var os = $("#os").val();
                var dproblema = $("#dproblema").val();
                var sit  = $("#situacao").val();
                var imagem = '<img src="./images/ajax.gif">'
                $("#retorno").append(imagem);
                var cliente = '<?php echo $cliente ?>';
          
                if(cliente!='IBBA'){
                    
                    $.post('insertchamadosala.php',{qrcode:qrcode,problema:problema,os:os,dproblema:dproblema,situacao:sit},function(data){
                    
                        $("#gravar").hide();
                        $("#retorno").empty();
                        $("#retorno").append(data);
                        window.location.reload();
                    });

                }else{
                    
                    $.post('insertchamadosalafresh.php',{qrcode:qrcode,problema:problema,os:os,dproblema:dproblema,situacao:sit},function(data){

                    
                    var imagemF = '<img src="./images/fresh.jpg" width="30" height="30">'
                    
                    $("#gravar").hide();
                    $("#retorno").empty();
                    $("#retorno").append(imagemF);
                    window.location.reload();
                });

                }
                               
                
                

            });

        });
        
        
    </script>



  </head>
  <body>

        <?php 
        
        $pegaqrs = $pdo->query("SELECT qrcode FROM CHAMADOS WHERE status='ANDAMENTO'");
        $codes = array();
        foreach ($pegaqrs as $qrs) {
        array_push($codes,$qrs['qrcode']);
        };
        
        
        ?>
    <div class="container">
        <h4><span id="retorno">Lista de Ativos</span></h4><br>

        <table class="table table-hover">
            <thead>
                <tr>
                
                <th scope="col">Ativo</th>
                <th scope="col">Marca</th>
                <th scope="col">Problemas</th>
                </tr>
            </thead>
            <tbody>
                <?php

                        foreach ($selEquipamentos as $equip) {
                                
                                if(in_array($equip['QRCODE'],$codes)){
                                    echo '<tr>';
                                    echo '<td>'.$equip[ 'TIPO_DE_EQUIPAMENTO'].'</td>';
                                    echo '<td>'.$equip[ 'MARCA'].'</td>';
                                    echo '<td><button type="button" class="btn btn-danger" value="'.$equip[ 'QRCODE'].'" data-toggle="modal" data-target="#exampleModal" id="problemaqrcode" disabled>'.$equip[ 'QRCODE'].'</button></td>';
                                    echo '</tr>';
                                }else{
                                        echo '<tr>';
                                        echo '<td>'.$equip[ 'TIPO_DE_EQUIPAMENTO'].'</td>';
                                        echo '<td>'.$equip[ 'MARCA'].'</td>';
                                        echo '<td><button type="button" class="btn btn-secondary" value="'.$equip[ 'QRCODE'].'" data-toggle="modal" data-target="#exampleModal" id="problemaqrcode">'.$equip[ 'QRCODE'].'</button></td>';
                                        echo '</tr>';
                                };

                            
                        };
                ?>
            </tbody>
        </table>
        <div class="text-center"><i class="btn btn-primary" id='checktudo'>Pronto</i></div><br>
  
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Abertura de Chamado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                        <form >
                            <div class="form-group">
                                <label for="txtqrcode">Qrcode</label>
                                <input type="text" class="form-control" id="txtqrcode" name='qrcode'>
                            </div>
                            <div class="form-group">
                                <label for="problema">Problema</label>
                                <select class="form-control" id="problema" name="problema">
                                <?php
                                foreach ($pegaproblema as $pro) {
                                    echo '<option value="'.$pro['PROBLEMA'].'">'.$pro['PROBLEMA'].'</option>';
                                }
                               
                                
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="problema">Status</label>
                                <select class="form-control" id="situacao" name="situacao">
                                                       
                                   <option value="ANDAMENTO">ANDAMENTO</option>
                                   <option value="RESOLVIDO">RESOLVIDO</option>
                                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtqrcode">Solicitante / OS</label>
                                <input type="text" class="form-control" id="os" name='os' placeholder="Informe o Solicitante ou OS">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição do Problema</label>
                                <textarea class="form-control" id="dproblema" rows="3" name="dproblema"></textarea>
                            </div>
                            <div class="modal-footer">
                                <p id="retorno"></p>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" id="gravar">Gravar</button>
                            </div>
                            </form>
            </div>
            
            </div>
        </div>
        </div>




</body>
</html>