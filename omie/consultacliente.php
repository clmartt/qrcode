
<?php
//error_reporting(0);
$idcliente = $_GET['idcli'];
$aut = $_GET['empresa'];

require('ClientesCadastroSoapClient.php');
require($aut);
$lcp = new ClientesCadastroSoapClient(); // classe 

$pagchave = new clientes_cadastro_chave(); // classe para requisição

$pagchave-> codigo_cliente_omie = $idcliente; // valor enviado para requisição
  
$ret = $lcp-> ConsultarCliente($pagchave); // classe para consultar

echo "Razão Social: ".$ret->razao_social."<BR>";
echo "Nome Fantasia: ".$ret->nome_fantasia."<BR>";
echo "Endereço: ".$ret->endereco."<BR>";
echo "E-mail: ".$ret->email."<BR>";



?>
