
<?php


require('ProjetosCadastroSoapClient.php');
require('OmieAppAuthinfo.php');


$lcpprj = new ProjetosCadastroSoapClient(); // classe 

$pagchaveprj = new projConsultarRequest(); // classe para requisição

$pagchaveprj-> codigo = "803934610"; // valor enviado para requisição
  
$retprj = $lcpprj-> ConsultarProjeto($pagchaveprj); // classe para consultar

echo "Razão Social: ".$retprj->nome."<BR>";





?>
