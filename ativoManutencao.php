<?php
ob_start();
session_start();

include('conectar.php');
include('timezone.php');

$permissao = $_SESSION['permissao'];
echo $permissao;
if($permissao==''){
    header("Location: ./login.html");
};


if($permissao=='KVM'){
    $selecao = $pdo->query("SELECT * FROM MANUTENCAO WHERE SITUACAO = 'ABERTO' ORDER BY DATA_RETIRADA");
}else{
    $selecao = $pdo->query("SELECT * FROM MANUTENCAO WHERE SITUACAO = 'ABERTO' AND CLIENTE = '$permissao' ORDER BY DATA_RETIRADA");

}




?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="jquery-3.2.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Equipamentos em Manutenção</title>

    <script>

        $(document).ready(function(){

            $("#txtBusca").keyup(function(){
                var texto = $(this).val();
                var textm = texto.toString();
              
                        $(".card").css("display", "block");
                            $(".card").each(function(){
                              if($(this).text().indexOf(textm.toUpperCase()) < 0){
                                                                   
                                  $(this).hide();
                                  
                                  
                                };
                            });
             });


        });

        $(document).on('click','#devolver',function(){
                alert($(this).val());
                var idmanus = $(this).val();

                $.post('ativoManuRetorno.php',{idManu:idmanus},function(data){

                    alert(data);
                    window.location.reload();


                });
        });



        $(document).on('click','#OrdemServico',function(){
            var vos = prompt('Digite o numero da OS');
            if(vos){
                alert($(this).val());

            }else{
                alert('vazio');
            }

        });




    </script>


  </head>
  <body>
    
    <br>
    <div class="container">
    <h5>Equipamentos em Manutenção</h5>
    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><ion-icon src="./icon/md-search.svg"  size="small" ></ion-icon></span>
        </div>
        <input type="text" class="form-control" placeholder="Pequisa" aria-label="pesquisa" aria-describedby="basic-addon1" id="txtBusca" >
    </div>
    <br>
    
    <?php
    foreach ($selecao as $res) {
        echo '<div class="card text-center">';
        echo '<div class="card-header">';
        echo 'Enviado para Manutenção em : '.date("d-m-Y",strtotime($res['DATA_RETIRADA']));
        echo '</div>';
        echo '<div class="card-body text-left">';
        echo '  <h5 class="card-title">'.$res['QRCODE'].'</h5>';
        echo '  <p class="card-text">'.$res['ATIVO'].'</p>';
        echo '  <p class="card-text">Retirado por : '.$res['RETIRADO_POR'].'</p>';
        echo '  <p class="card-text">Problema : '.$res['PROBLEMA'].'</p>';
        echo '  <li><b>DE</b></li>';
        echo '  <p class="card-text">'.$res['PREDIO'].' '.$res['ANDAR'].' - '.$res['SALA'].'</p>';
        echo '  <li><b>PARA</b></li>';
        echo '  <p class="card-text">'.$res['DESTINO'].'</p>';
        echo '  <button id="OrdemServico" class="btn btn-outline-info" value="'.$res['ID_MANU'].'"><b>OS :</b></button> - '.$res['OS'].'<br>';
        echo '</div>';
        echo '<div class="card-footer text-center">';
        echo '<button class="btn btn-primary" value="'.$res['ID_MANU'].'" id="devolver">Retorno</button>';
        echo '</div>';
        echo '</div>';
    
        echo '<div>';
        echo '<p></p>';
    }
    
?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>