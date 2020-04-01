
<?php

ob_start();
session_start();
$email = $_SESSION['email'];
$permissao = $_SESSION['permissao'];
$cliente = $_SESSION['cliente'];

if($email=='' ||$permissao == '' ){
    header("Location: ../login.html");
}
include("../conectar.php");
$pegauser = $pdo->query("SELECT DISTINCT email FROM login_usuario WHERE permissao = '$permissao'");
$pegaPredio = $pdo->query("SELECT PREDIO FROM QRCODETABLE WHERE CLIENTE = '$permissao' GROUP BY PREDIO ORDER BY PREDIO");

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Formulário de Agendamento</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
            $(document).ready(function(){
                $("#divtitulo").hide(); // esconde a div com o titulo

                $("#gerar").click(function(){
                    var dia = $("#data_atividade").val();
                    var diaSplit = dia.split("-");
                    var categoria = $("#categoria").val();
                    var tipo = $("#tipo").val();
                    var predio = $("#predio").val();
                    var andar = $("#andar").val();
                    var sala = $("#sala").val();
                    var hinicio = $("#hora_inicio").val();
                    var hfim = $("#hora_fim").val();
                    var recurso = $("#recurso").val();
                    var responsavel = $("#responsavel").val();
                    var descricao = $("#desc").val();
                    var cliente = '<?php echo $cliente ?>';
                    var email = '<?php echo $email ?>';

                    var titulos = categoria.substr(0,3)+"-"+tipo+"-"+predio+"-"+andar+"-"+sala+" | "+diaSplit[2]+"-"+diaSplit[1]+"-"+diaSplit[0]+" - "+hinicio+" - "+hfim;

                    $("#tit").val(titulos);

                   $("form").fadeOut("slow");
                   $("#divtitulo").fadeIn("slow");

                  
                });

                $("#cancelar").click(function(){
                    $("#divtitulo").fadeOut("slow");
                    $("form").fadeIn("slow");
                });

                $("#gravar").click(function(){
                    var dia = $("#data_atividade").val();
                    var diaSplit = dia.split("-");
                    var categoria = $("#categoria").val();
                    var tipo = $("#tipo").val();
                    var predio = $("#predio").val();
                    var andar = $("#andar").val();
                    var sala = $("#sala").val();
                    var hinicio = $("#hora_inicio").val();
                    var hfim = $("#hora_fim").val();
                    var recurso = $("#recurso").val();
                    var responsavel = $("#responsavel").val();
                    var descricao = $("#desc").val();
                    var cliente = '<?php echo $cliente ?>';
                    var email = '<?php echo $email ?>';

                    var titulos = categoria.substr(0,3)+"-"+tipo+"-"+predio+"-"+andar+"-"+sala+" | "+diaSplit[2]+"-"+diaSplit[1]+"-"+diaSplit[0]+" - "+hinicio+" - "+hfim;


                    $.post('inseriAgend.php',{dias:dia,titulo:titulos,horaI:hinicio,horaF:hfim,desc:descricao,resp:responsavel,recursos:recurso,clientes:cliente,emails:email,tipos:tipo},function(data){
                       $("#divtitulo").hide();  
                       var divok = '<div class="alert alert-primary" role="alert"> Agendamento Confirmado!!! </div><div class="text-center"><a class="btn btn-primary" href="../principal.php">Voltar</a></div>';
                       $("#ok").append(divok);

                    });
                });



                $("#predio").change(function(){
                    var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
                    $("#carregando").append(load);
                    $("#andar").empty();
                    $("#andar").append('<option>Selecione Andar</option>');// inseri a option "andar" select do andar
                    $("#sala").empty();// limpa select do sala
                    $("#sala").append('<option>Escolha Sala</option>');// inseri a option "sala" select do sala
                    var predio = $(this).val();// pegar o valor do select do predio
                        $.getJSON('pegaAndar.php',{predios:predio},function(data){
                            
                                for(i=0;i<data.length;i++){
                                    var opcao = "<option>"+data[i].ANDAR+"</option>";
                                    $("#andar").append(opcao);
                                }

                                $("#carregando").empty();                          

                        });
                
                          
                });


                $("#andar").change(function(){
                    var load = '<div class="text-center"><img src="../images/ajax.gif"></div>';
                    $("#carregandoandar").append(load);
                        $("#sala").empty();
                        var andar = $(this).val();
                        var predio = $("#predio option:selected").val();
                        $.getJSON('pegasala.php',{andares:andar,predios:predio},function(data){
                            for(i=0;i<data.length;i++){
                                var opcao = "<option>"+data[i].SALA+"</option>";
                                $("#sala").append(opcao);
                            }
                            $("#carregandoandar").empty();
                        });
                    });

            });
        
    </script>

  </head>
  <body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="../principal.php">
      Retornar 
    </a>
  </nav>
  <br>
  <br>

  <div class="container">
          <h5>Formulário de Agendamento</h5>
          <BR>
                    <form>
                            <div class="form-group">
                                <label for="data_atividade">Data</label>
                                <input type="date" class="form-control" id="data_atividade" aria-describedby="Data Atividade" name="data" require>
                                <small id="data_atividade" class="form-text text-muted">Informe a data da atividade</small>
                            </div>
                            <div class="form-group">
                                <label for="hora_inicio">Hora Inicio</label>
                                <input type="time" class="form-control" id="hora_inicio" aria-describedby="Hora Inicio" name="horaInicio" require>
                             
                            </div>
                            <div class="form-group">
                                <label for="hora_fim">Hora Fim</label>
                                <input type="time" class="form-control" id="hora_fim" aria-describedby="Hora Fim" name="horaFim" require>
                                
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select class="custom-select" id="categoria" name="categoria">
                                        
                                        <option value="AGENDAMENTO">AGENDAMENTO</option>
                                        <option value="MANUTENCAO">MANUTENÇÃO</option>
                                        <option value="ACOMPANHAMENTO">ACOMPANHAMENTO</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="custom-select" id="tipo" name="tipo">
                                        
                                        <option value="VC">VÍDEO CONFERÊNCIA</option>
                                        <option value="TP">TELEPRESENÇA</option>
                                        <option value="OUTROS">OUTROS</option>
                                </select>
                                
                            </div>
                            

                            <div class="form-group">
                                <label for="predio">Predio</label>
                                <select class="custom-select" id="predio" name="predio">
                                    <option> Selecione o Prédio</option>
                                     <?php 
                                        foreach ($pegaPredio as $p) {
                                            echo '<option value="'.$p['PREDIO'].'">'.$p['PREDIO'].'</option>';
                                        }
                                     ?>
                                        
                                      
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <div class="text-center" id="carregando"></div>
                            </div>
                           
                            <div class="form-group">
                                <label for="andar">Andar</label>
                                <select class="custom-select" id="andar" name="andar">
                                                                                                      
                                      
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <div class="text-center" id="carregandoandar"></div>
                            </div>
                            <div class="form-group">
                                <label for="sala">Sala</label>
                                <select class="custom-select" id="sala" name="sala">
                                                                                                      
                                      
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="recurso">Recurso</label>
                                <select class="custom-select" id="recurso" name="recurso">
                                     <?php 
                                        foreach ($pegauser as $usuario) {
                                            echo '<option value="'.$usuario['email'].'">'.$usuario['email'].'</option>';
                                        }
                                     ?>
                                        
                                      
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="responsavel">Resposável / Solicitante</label>
                                <input type="text" class="form-control" id="responsavel" aria-describedby="responsavel" placeholder="Resposável / Solicitante" name="responsavel" require>
                                
                            </div>

                            <div class="form-group">
                                <label for="desc">Descrição</label>
                                <textarea class="form-control" id="desc" rows="5" name="desc"></textarea>
                            </div>
                                                       
                            <div class="text-center"><button type="button" class="btn btn-primary" id="gerar">Gerar</button></div>
                            <br>
                </form>

                <div id="divtitulo">
                    <div class="form-group">
                                    <label for="tit">Título da Atividade</label>
                                    <input type="text" class="form-control" id="tit" aria-describedby="tit"  name="tit" readonly>
                                    
                    </div>
                    <div class="text-center"><button type="button" class="btn btn-primary" style="margin: 0 15px " id="gravar">Confirmar</button><button type="button" class="btn btn-danger" id="cancelar">Cancelar</button></div>
                </div>
                <div id="ok"></div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>