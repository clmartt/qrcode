<?php
// cabeçalho para utf8 

ob_start();
session_start(); //pega a sessao do usuario

$cliente = $_SESSION['cliente'];
$permissao = $_SESSION['permissao'];

if($_SESSION['cliente']==''){
    header("Location: ./login.html"); 
  }

// RECEBE AS VARIAVEIS CARREGADAS DAS PAGINAS ANTERIORES
  $predio =$_GET['predio'];
  $andar =$_GET['andar'];
  $sala =$_GET['sala'];
  $setor =$_GET['setor'];

  $retorno = $_GET['retorno'];

include('../conectar.php');

if($_SESSION['permissao']=='KVM'){
   
    $selectUser = "SELECT * FROM  login_usuario"; // query de consulta ao banco
    $resultUser = $pdo->query($selectUser); // guardando o resultado da query acima na variavel
    $qtdUser = $resultUser-> rowCount(); // contanto o numero de linhas retornadas pela query
    
    }else{
    
     $selectUser = "SELECT * FROM  login_usuario WHERE cliente = '$permissao'"; // query de consulta ao banco
    $resultUser = $pdo->query($selectUser); // guardando o resultado da query acima na variavel
    $qtdUser = $resultUser-> rowCount(); // contanto o numero de linhas retornadas pela query
    
    };





?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>AGENDAMENTO</title>

    <script src="jquery-3.2.1.min.js"></script>
    
    
    <script>
    $(document).ready(function(){
        $('#resposta').hide();
        var retorno = "<?php echo $retorno ?>";
        if(retorno == 1){
            $('#formulario').hide();
            $('#resposta').show();
        };
       

    });
    
    </script>


  </head>
  <body>
     
      <div class="container" id="formulario">
          <p></p>
            <div class="card">
            <h5 class="card-header">Nova Atividade</h5>
            <div class="card-body">
            <form method="POST" action="agendInsert.php">
            <div class="form-group">
                <label for="predio">Predio</label>
                <input type="text" class="form-control" id="predio" aria-describedby="predio" placeholder="predio" value="<?php echo $predio ?>" name="predio" readonly>
            </div>
            <div class="form-group">
                <label for="andar">Andar</label>
                <input type="text" class="form-control" id="andar" aria-describedby="andar" placeholder="andar" value="<?php echo $andar ?>" name="andar" readonly>
            </div>
            <div class="form-group">
                <label for="setor">Setor</label>
                <input type="text" class="form-control" id="setor" aria-describedby="setor" placeholder="setor" value="<?php echo $setor ?>" name="setor" readonly>
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="text" class="form-control" id="sala" aria-describedby="sala" placeholder="sala" value="<?php echo $sala ?>" name="sala" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="atividade">Atividade</label>
                </div>
                <select class="custom-select" id="atividade" name="atividade">
                    <option selected>Escolher...</option>
                    <option value="AGENDAMENTO">AGENDAMENTO</option>
                    <option value="ACOMPANHAMENTO">ACOMPANHAMENTO</option>
                    <option value="MANUTENÇÃO">MANUTENÇÃO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Data</label>
                <input type="date" class="form-control" id="paraData" aria-describedby="Data" placeholder="Data" name="paraData">
            </div>
            <div class="form-group">
                <label for="hinicio">Hora Inicio</label>
                <input type="time" class="form-control" id="hinicio" aria-describedby="hinicio" placeholder="hinicio" name="hinicio">
            </div>
            <div class="form-group">
                <label for="hfim">Hora Fim</label>
                <input type="time" class="form-control" id="hfim" aria-describedby="hfim" placeholder="hfim" name="hfim">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="recurso">Recurso</label>
                </div>
                <select class="custom-select" id="recurso" name="recurso">
                   <?php
                        foreach ($resultUser as $res) {
                            echo "<option>".$res['email']."</option>";
                        };
                   
                   ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Solicitante</label>
                <input type="text" class="form-control" id="solicitante" aria-describedby="solicitante" placeholder="solicitante" name="solicitante">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Observações</span>
                </div>
                <textarea class="form-control" aria-label="Observações" name='observacao'></textarea>
                </div>
            <div class="form-group">
                
                <input type="hidden" class="form-control" id="cliente" aria-describedby="cliente" placeholder="cliente" value="<?php echo $_SESSION['cliente'] ?>">
            </div>
            
         
            <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
            </form>
            
            </div>
            </div>
      </div>

                        <div class="card text-center" id="resposta">
                            <div class="card-header">
                                Ok! tudo certo!
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Informações Inseridas</h5>
                                
                                <a href="../agendamento.php" class="btn btn-primary">Retornar</a>
                            </div>
                            <div class="card-footer text-muted">
                                
                            </div>
                        </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>