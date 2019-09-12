<?php


// definições de host, database, usuário e senha
$host = "qrcodekvm.mysql.dbaas.com.br";
$db   = "qrcodekvm";
$user = "qrcodekvm";
$pass = "qrcodekvm"; 



$mysqli = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM CHAMADOS";
$result = $mysqli->query($sql);



    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "          <tr>";
    $dadosXls .= "          <th>string_id</th>";
    $dadosXls .= "          <th>horas</th>";
    $dadosXls .= "          <th>data_2</th>";
    $dadosXls .= "          <th>mes</th>";
    $dadosXls .= "          <th>ano</th>";
    $dadosXls .= "          <th>qrcode</th>";
    $dadosXls .= "          <th>ativo</th>";
    $dadosXls .= "          <th>modelo</th>";
    $dadosXls .= "          <th>marca</th>";
    $dadosXls .= "          <th>predio</th>";
    $dadosXls .= "          <th>andar</th>";
    $dadosXls .= "          <th>sala</th>";
    $dadosXls .= "          <th>situacao</th>";
    $dadosXls .= "          <th>observacao</th>";
    $dadosXls .= "          <th>nome_user</th>";
    $dadosXls .= "          <th>status</th>";
    $dadosXls .= "          <th>serie</th>";
    $dadosXls .= "          <th>horas_lamp</th>";

    $dadosXls .= "      </tr>";
   


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
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>".$res['string_id']."</td>";
        $dadosXls .= "          <td>".$res['horas']."</td>";
        $dadosXls .= "          <td>".$res['data_2']."</td>";
        $dadosXls .= "          <td>".$res['mes']."</td>";
        $dadosXls .= "          <td>".$res['ano']."</td>";
        $dadosXls .= "          <td>".$res['qrcode']."</td>";
        $dadosXls .= "          <td>".$res['ativo']."</td>";
        $dadosXls .= "          <td>".$res['modelo']."</td>";
        $dadosXls .= "          <td>".$res['marca']."</td>";
        $dadosXls .= "          <td>".$res['predio']."</td>";
        $dadosXls .= "          <td>".$res['andar']."</td>";
        $dadosXls .= "          <td>".$res['sala']."</td>";
        $dadosXls .= "          <td>".$res['situacao']."</td>";
        $dadosXls .= "          <td>".$res['observacao']."</td>";
        $dadosXls .= "          <td>".$res['nome_user']."</td>";
        $dadosXls .= "          <td>".$res['status']."</td>";
        $dadosXls .= "          <td>".$res['serie']."</td>";
        $dadosXls .= "          <td>".$res['horas_lamp']."</td>";
        $dadosXls .= "      </tr>";
    }
    $dadosXls .= "  </table>";


// faz o upload para o servidor
  $arquivo = 'uploads/Chamados.xls';  
        $uploaddir = '/home/storage/6/d9/df/kvm1000/public_html/qrteste/arquivo/check';
        $uploadfile = $uploaddir . $_FILES[$arquivo]['check'];

        echo '<pre>';
        move_uploaded_file($_FILES[$dadosXls]['check'], $uploadfile);
        

       file_put_contents( $arquivo , $dadosXls);
       echo "<script> alert('Enviado'); </script>";
       
//==========================================================================================>>>>>>>>>>>>>>>>>
       $arquivohtml = strval("uploads/Chamados.html");  
        $uploaddirhtml = '/home/storage/6/d9/df/kvm1000/public_html/qrteste/arquivo/check';
        $uploadfilehtml = $uploaddirhtml . $_FILES[$arquivohtml]['check'];

       file_put_contents( $arquivohtml , $dadosXls);

       
//---------------------------------------------------------------------------------------------------------
$data_2 = date('d/m/y');
$horas = date('H:i:s');


// Criando configuraçaõ do Slack
  define('SLACK_WEBHOOK', 'https://hooks.slack.com/services/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');
  $endereco = 'http://kvminformatica.com.br/qrteste/'.$arquivo;
$message = array('payload' => json_encode(array('text' => 'Link para o arquivo de Chamados : '.$data_2.' - '.$horas.'--->'.$endereco )));
  // Usando o curl para enviar
  $c = curl_init(SLACK_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
  curl_exec($c);
  curl_close($c);


  // Criando configuraçaõ do teams

define('TEAMS_WEBHOOK', 'https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/f42ce1b88842413d80da47676081c7f9/f69d8532-4ecd-4add-9072-a2c3e06820ef');

 
  $messageTeams = json_encode(array('text' => 'Link para o arquivo Chamados :'.$data_2.'<br>'.$endereco ));

  // Usando o curl para enviar
  $c = curl_init(TEAMS_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $messageTeams);
  curl_exec($c);
  curl_close($c);



/*https://outlook.office.com/webhook/e6a8f984-235d-4f40-8145-81560ba9afcf@407e34f8-c571-4354-9ab3-de195ab979a6/IncomingWebhook/f42ce1b88842413d80da47676081c7f9/f69d8532-4ecd-4add-9072-a2c3e06820ef

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