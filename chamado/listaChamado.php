<?php
include("../conectar.php");
ob_start();
session_start();
$email = $_SESSION['email'];
$cliente = $_SESSION['cliente'];
$permissao = $_SESSION['permissao'];
$predio = $_GET['predio'];

if($email==""){
    header("Location: ../login.html");
}

$sql = $pdo->query("SELECT * FROM CHAMADOS WHERE CLIENTE = '$permissao' AND predio = '$predio' AND status = 'ANDAMENTO' ORDER BY id_chamado,andar,sala,problema");
$qtd = $sql->rowCount();

$pegaAndar = $pdo->query("SELECT andar FROM CHAMADOS WHERE predio = '$predio' AND status = 'ANDAMENTO' GROUP BY andar ORDER BY andar");


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Lista de Chamados</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
           
            $("#andar").change(function(){
                var andar = $(this).val();
                var predio = '<?php echo $predio ?>';
                var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
                $("#carregando").append(load);
                $("#problema").empty();
                $("#problema").fadeOut();
                $("#problema").append('<option> Escolha o Problema</option>');
                $.getJSON('pegaProblema.php',{predios:predio,andares:andar},function(data){
                    for(i=0;i<data.length;i++){
                        var opcao = '<option>'+data[i].problema+'</option>';
                        $("#problema").append(opcao);
                    }
                    $("#carregando").empty();
                    $("#problema").fadeIn();

                });
            });

            $("#buscar").click(function(){
                $("#conteudo").empty();
                var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
                $("#conteudo").append(load);
                var predio = '<?php echo $predio ?>';
                var andar = $("#andar option:selected").val();
                var problema = $("#problema option:selected").val();
                $.get('getChamados.php',{predios:predio,andares:andar,problemas:problema},function(data){
                    $("#conteudo").empty();
                    $("#conteudo").html(data);
                });
            });
            

        });
       
          
           
    </script>


  </head>
  <body>
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="../listapredioChamado.php">
        
            Retornar
            
        </a>
        
    </nav>
       

    
    <div class="container">
        <br>
        <br>
        <br>
        <br>

        <h5> <?php echo $qtd.' - Chamados Abertos no '.$predio ?></h5>
        <form >
            
            <div class="form-group">
             <select class="custom-select" id="andar">
                <option selected>Escolha o Andar</option>
                <?php
                    foreach ($pegaAndar  as $a) {
                       echo '<option>'.$a['andar'].'</option>';
                    }
                ?>
               
            </select>
            </div>
            <div class="form-group">
                <div class="text-center" id="carregando"></div>
            </div>

            <div class="form-group ">
            <select class="custom-select" id="problema">
                              
            </select>
            </div>

            <div class="text-center"><button type="button" class="btn btn-primary mb-2" id="buscar">Buscar</button></div>
        </form>
        <div id="conteudo">
        <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Andar</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Problema</th>
                        <th scope="col">Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($sql as $r) {
                                $datahoje = date('Y-m-d'); // converte a data de hoje para o padrao ano - mes - dia
                                $dataChamado = $r['data_2']; // pega a data do chamado retornada do banco de dados
                                $data1 = date_create($datahoje); // converte em data
                                $data2 = date_create($dataChamado);// converte em data
                                $dif = date_diff($data2,$data1); // calcula a diferença entre as datas
                                $dias = $dif->format('%a'); // formata em numero o resultado da diferença
                                if($dias>=10){
                                    echo' <tr id="linha">';
                                    echo'<th scope="row"><a href="detalheChamado.php?idChamado='.$r['id_chamado'].'" class="btn btn-danger">'.$r['id_chamado'].'</a></th>';
                                    echo'<td>'.$r['andar'].'</td>';
                                    echo'<td>'.$r['sala'].'</td>';
                                    echo'<td>'.$r['problema'].'</td>';
                                    echo'<td>'.$dias.'</td>';
                                    echo'</tr>';
                                }else{
                                    echo' <tr>';
                                    echo'<th scope="row"><a href="detalheChamado.php?idChamado='.$r['id_chamado'].'" class="btn btn-info">'.$r['id_chamado'].'</a></th>';
                                    echo'<td>'.$r['andar'].'</td>';
                                    echo'<td>'.$r['sala'].'</td>';
                                    echo'<td>'.$r['problema'].'</td>';
                                    echo'<td>'.$dias.'</td>';
                                    echo'</tr>';
                                }
                                
                            }
                            
                        
                        ?>
                                            
                    </tbody>
                </table>
        
        </div>
        <hr>
        <br>
        

    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>