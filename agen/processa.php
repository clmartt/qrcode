	<?php

ob_start();
session_start();
$clienteS = $_SESSION['cliente'];
if($_SESSION['cliente']==''){
    header("Location: ../login.html"); 

};


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
                $predio =strtoupper($linha[0]);
                $andar = strtoupper($linha[1]);
				$sala =  strtoupper($linha[2]);
				$atividade =  strtoupper(utf8_encode($linha[3]));
				$tipo =  strtoupper(utf8_encode($linha[4]));
				$pegadata = explode('/',$linha[5]);
				$dataTratada = $pegadata[2]."-".$pegadata[1]."-".$pegadata[0];
				$datac = $dataTratada;
				$hinicio =  strtoupper($linha[6]);
				$hfim = strtoupper($linha[7]);
				$recurso =  strtoupper($linha[8]);
				$situacao = strtoupper($linha[9]);
				$resumo =  strtoupper(substr("$atividade", 0, 3)."-".$predio."-".$andar."-".$sala." | ".$hinicio." - ".$hfim); //-------------------------------------
				$aberto =  strtoupper($linha[10]);
				$solicitante =  strtoupper($linha[11]);
				$fechado =  strtoupper($linha[12]);
				$hfechado =  strtoupper($linha[13]);
				$obs =  strtoupper(utf8_encode($linha[14]));
				$cliente = strtoupper($linha[15]);
            
              

                if($cliente!==""){ // se o cliente for vazio significa que a linha esta vazia e nao deve ser inserida
					

					$stm = $pdo->prepare("INSERT INTO AGENDAMENTO (PREDIO,ANDAR,SALA,ATIVIDADE,TIPO,DATAC,HINICIO,HFIM,RECURSO,SITUACAO,RESUMO,ABERTO_POR,SOLICITANTE,FECHADO_POR,HFECHADO,OBSERVACAO,CLIENTE) VALUES ('$predio', '$andar', '$sala','$atividade','$tipo','$datac','$hinicio','$hfim','$recurso','$situacao','$resumo','$aberto','$solicitante','$fechado','$hfechado','$obs','$cliente')");

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

