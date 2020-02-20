<?php 

    include("../conectar.php");
    include("../timezone.php");

    $idchamado = $_POST['idchamados'];
    $usuario = $_POST['emails'];
    $titulo = $_POST['titulos'];
    $comentario = $_POST['comentarios'];
    $dataPost = date("Y-m-d");
    $hora = date("H:i:s");

    $insert =$pdo->prepare("INSERT INTO POST_CHAMADOS (ID_CHAMADO,USUARIO,TITULO,DESCRICAO,DATA_POST,HORA_POST) VALUES('$idchamado','$usuario','$titulo','$comentario','$dataPost','$hora')") ;
       

    if($insert->execute()){
        echo " - Postado!";

    }








?>