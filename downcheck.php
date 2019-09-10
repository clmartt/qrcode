<?php


// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 


//=========================== informações de data
$mes =  date('F');
$ano = date('Y');
$horas = date('H:i:s');
$data_2 = date('d/m/y');

$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM TABLE_CHECK";
$result = $mysqli->query($sql);



    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "<tr>";
    $dadosXls .= "<th>DATA</th>";
    $dadosXls .= "<th>MES</th>";
    $dadosXls .= "<th>ANO</th>";
    $dadosXls .= "<th>QRCODE</th>";
    $dadosXls .= "<th>TIPO DE EQUIPAMENTO</th>";
     $dadosXls .= "<th>CARACTERISTICA</th>";
    $dadosXls .= "<th>MODELO</th>";
    $dadosXls .= "<th>MARCA</th>";
    $dadosXls .= "<th>PREDIO</th>";
    $dadosXls .= "<th>ANDAR</th>";
    $dadosXls .= "<th>SETOR</th>";
    $dadosXls .= "<th>SALA</th>";
    $dadosXls .= "<th>SITUACAO</th>";
    $dadosXls .= "<th>OBSERVACAO</th>";
    $dadosXls .= "<th>USUARIO</th>";
    $dadosXls .= "<th>STATUS</th>";
    $dadosXls .= "<th>SERIE</th>";
    $dadosXls .= "<th>HORAS_LAMP</th>";
    $dadosXls .= "<th>OCUPADA</th>";

    $dadosXls .= "</tr>";
   


 /*   
idTABLE_CHECK
data_2
mes
ano
qrcode
ativo
modelo
marca
predio
andar
sala
situacao
observacao
nome_user
*/
    foreach($result as $res){
        $dadosXls .= "<tr>";
        $dadosXls .= "<td>".$res['DATA_2']."</td>";
        $dadosXls .= "<td>".$res['MES']."</td>";
        $dadosXls .= "<td>".$res['ANO']."</td>";
        $dadosXls .= "<td>".$res['QRCODE']."</td>";
        $dadosXls .= "<td>".$res['TIPO_DE_EQUIPAMENTO']."</td>";
        $dadosXls .= "<td>".$res['CARACTERISTICA']."</td>";
        $dadosXls .= "<td>".$res['MARCA']."</td>";
        $dadosXls .= "<td>".$res['MODELO']."</td>";
        $dadosXls .= "<td>".$res['PREDIO']."</td>";
        $dadosXls .= "<td>".$res['ANDAR']."</td>";
        $dadosXls .= "<td>".$res['SETOR']."</td>";
        $dadosXls .= "<td>".$res['SALA']."</td>";
        $dadosXls .= "<td>".$res['SITUACAO']."</td>";
        $dadosXls .= "<td>".$res['OBSERVACAO']."</td>";
        $dadosXls .= "<td>".$res['NOME_USER']."</td>";
        $dadosXls .="<td>".$res['STATUS']."</td>";
        $dadosXls .="<td>".$res['SERIE']."</td>";
        $dadosXls .="<td>".$res['HORAS_LAMP']."</td>";
        $dadosXls .="<td>".$res['OCUPADA']."</td>";
        $dadosXls .="</tr>";
    }
    $dadosXls .="</table>"; 


// faz o upload para o servidor.
  $arquivo = strval("uploads/Check_List.xls");  
        $uploaddir = '/home/storage/6/d9/df/kvm1000/public_html/qrteste/arquivo/check';
        $uploadfile = $uploaddir . $_FILES[$arquivo]['check'];

       file_put_contents( $arquivo , $dadosXls);
       echo "<script> alert('Enviado'); </script>";
//==========================================================================================>>>>>>>>>>>>>>>>>
       $arquivohtml = strval("uploads/Check_List.html");  
        $uploaddirhtml = '/home/storage/6/d9/df/kvm1000/public_html/qrteste/arquivo/check';
        $uploadfilehtml = $uploaddirhtml . $_FILES[$arquivohtml]['check'];

       file_put_contents( $arquivohtml , $dadosXls);
       
       

//---------------------------------------------------------------------------------------------------------


// Criando configuraçaõ do Slack
  define('SLACK_WEBHOOK', 'https://hooks.slack.com/services/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');
  $endereco = 'http://kvminformatica.com.br/qrteste/'.$arquivo;
$message = array('payload' => json_encode(array('text' => 'Link para o arquivo Check List : '.$endereco )));
  // Usando o curl para enviar
  $c = curl_init(SLACK_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
  curl_exec($c);
  curl_close($c);


//==========================================================================================================>>>>


  define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/690b692ebd3d43c6b042eefb6db6c8b6/f69d8532-4ecd-4add-9072-a2c3e06820ef');

  $messageTeams = json_encode(array('text' => 'Link para o arquivo Check List :'.$data_2.'<br>'.$endereco ));

  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);
  curl_exec($c);
  curl_close($c);

/*

    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header("Content-type: application/csv");
    header("Pragma: no-cache"); 
    header("Content-type: application/force-download");
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
   readfile($endereco);  
    */
    exit;
?>