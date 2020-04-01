
<?php

ob_start();
session_start();
$email = $_SESSION['email'];
$permissao = $_SESSION['permissao'];
$cliente = $_SESSION['cliente'];
$idAgend = $_POST['idAtividades'];

if($email=='' ||$permissao == '' ){
    header("Location: ../login.html");
}
include("../conectar.php");
$agendamentos = $pdo->query("SELECT * FROM AGENDAMENTO WHERE ID_AGEN = '$idAgend'");

foreach ($agendamentos as $agen) {
    
    $data = $agen['DATA_AGEN'];
    $hinicio = $agen['HORA_INICIO'];
    $hfim = $agen['HORA_FIM'];
    $predio = $agen['PREDIO'];
    $andar = $agen['ANDAR'];
    $sala = $agen['SALA'];
    $recurso = $agen['RECURSO'];
    $resp = $agen['DATA_AGEN'];
    $desc = $agen['DESCRICAO'];

}
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
                                <label for="predio">Prédio</label>
                                <input type="text" class="form-control" id="predio" aria-describedby="predio" placeholder="EX: CTO - FAROL - SEDE" name="predio" require>
                                
                            </div>
                            <div class="form-group">
                                <label for="andar">Andar</label>
                                <input type="text" class="form-control" id="andar" aria-describedby="andar" placeholder="EX: P02 - 2 - TERREO" name="andar">
                                
                            </div>
                            <div class="form-group">
                                <label for="sala">Sala</label>
                                <input type="text" class="form-control" id="sala" aria-describedby="sala" placeholder="EX: 901 - MEZANINO - DESCANSO" name="sala">
                                
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