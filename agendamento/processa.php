	<?php

ob_start();
session_start();
$clienteS = $_SESSION['cliente'];
if($_SESSION['cliente']==''){
    header("Location: ../login.html"); 

};
$email = $_SESSION['email'];
$dia = date("Y-m-d");
$mes = date("F");
$ano = date("Y");


	include_once("../conectar.php");
	
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	
	$path = $_FILES['arquivo']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	

	if(!empty($_FILES['arquivo']['tmp_name'])){
        $nomeAarquivo = $_FILES['arquivo']['tmp_name'];
		$objeto = fopen($nomeAarquivo,'r');
		

		$contador = 0;
		$contaregistro = 0;
        while (($linha = fgetcsv($objeto,10000,';'))!==false) {

            
            if($contador!==0){

				
				//guarda os valores em cada variavel
				$pegadata = explode('/',$linha[0]);
				$dataTratada = $pegadata[2]."-".$pegadata[1]."-".$pegadata[0];
				$datac = $dataTratada;
				$sala_titulo= strtoupper($linha[1]);
				$hinicio =  $linha[2];
				$hfim = $linha[3];
				$titulo_desc = utf8_encode(strtoupper($linha[4]));
				$responsavel = strtoupper($linha[5]);
				$recurso = strtoupper($linha[6]);
                $aberto =  "ABERTO";
                $chave = $linha[7];
				          
              

                if($chave>0){ // se a data for vazia nao deve ser inserida a linha
					

					$stm = $pdo->prepare("INSERT INTO AGENDAMENTO (DATA_AGEN,MES,ANO,TITULO,HORA_INICIO,HORA_FIM,DESCRICAO,RESPONSAVEL,SITUACAO,RECURSO,ABERTO_POR,CLIENTE) VALUES ('$datac','$mes','$ano','$sala_titulo','$hinicio','$hfim','$titulo_desc','$responsavel','$aberto','$recurso','$email','$clienteS')");

					if($stm->execute()){// se o insert acontecer 

						$contaregistro++; // o contador receber +1
						

					};					

				}else{

					break;
					$error = $stm->error_reporting;
					header("Location: ../agendamento.php?retorno=error : ".$error);
				};
                    
            }

        	$contador++;
            
		}
		$total = $contador-1;
		header("Location: ../agendamento.php?retorno=Foram inseridos : ".$total." registros");
		
		

	} else{
		header("Location: ../agendamento.php?retorno='Necessário o envio do Arquivo'.$formato");
	};

	 
		
?>

