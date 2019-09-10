<?php
if (!class_exists("CBSoapClient")) {
	class CBSoapClient extends SoapClient {
	    public function __doRequest($request, $location, $action, $version, $one_way = 0) {
	        $xmlRequest = new DOMDocument("1.0");
	        $xmlRequest->loadXML($request);
	        $header = $xmlRequest->createElement("SOAP-ENV:Header");
	        if (defined("OMIE_APP_KEY")) { $header->appendChild( $xmlRequest->createElement("app_key", OMIE_APP_KEY) ); }
	        if (defined("OMIE_APP_SECRET")) { $header->appendChild( $xmlRequest->createElement("app_secret", OMIE_APP_SECRET) ); }
	        if (defined("OMIE_USER_LOGIN")) { $header->appendChild( $xmlRequest->createElement("user_login", OMIE_USER_LOGIN) ); }
	        if (defined("OMIE_USER_PASSWORD")) { $header->appendChild( $xmlRequest->createElement("user_password", OMIE_USER_PASSWORD) ); }
	        $envelope = $xmlRequest->firstChild;
	        $envelope->insertBefore($header, $envelope->firstChild);
	        $request = $xmlRequest->saveXML();
	        return parent::__doRequest($request, $location, $action, $version, $one_way);
	    }
	}
}
/**
 * @service LancamentoContaPagarSoapClient
 * @author omie
 */
class LancamentoContaPagarSoapClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/financas/contapagar/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		if(is_null(self::$_Server))
			self::$_Server=new CBSoapClient(self::$_WsdlUri);
		return self::$_Server->__soapCall($method,$param);
	}

	/**
	 * Inclui uma conta a Pagar.
	 *
	 * @param conta_pagar_cadastro $conta_pagar_cadastro Cadastro de contas a pagar.
	 * @return conta_pagar_cadastro_response Resposta do Cadastro de Contas a Pagar
	 */
	public function IncluirContaPagar($conta_pagar_cadastro){
		return self::_Call('IncluirContaPagar',Array(
			$conta_pagar_cadastro
		));
	}

	/**
	 * Altera uma conta a pagar
	 *
	 * @param conta_pagar_cadastro $conta_pagar_cadastro Cadastro de contas a pagar.
	 * @return conta_pagar_cadastro_response Resposta do Cadastro de Contas a Pagar
	 */
	public function AlterarContaPagar($conta_pagar_cadastro){
		return self::_Call('AlterarContaPagar',Array(
			$conta_pagar_cadastro
		));
	}

	/**
	 * Exclui uma conta a pagar
	 *
	 * @param conta_pagar_cadastro_chave $conta_pagar_cadastro_chave Chave da conta a pagar
	 * @return conta_pagar_cadastro_response Resposta do Cadastro de Contas a Pagar
	 */
	public function ExcluirContaPagar($conta_pagar_cadastro_chave){
		return self::_Call('ExcluirContaPagar',Array(
			$conta_pagar_cadastro_chave
		));
	}

	/**
	 * Consulta uma conta a pagar
	 *
	 * @param conta_pagar_cadastro_chave $conta_pagar_cadastro_chave Chave da conta a pagar
	 * @return conta_pagar_cadastro Cadastro de contas a pagar.
	 */
	public function ConsultarContaPagar($conta_pagar_cadastro_chave){
		return self::_Call('ConsultarContaPagar',Array(
			$conta_pagar_cadastro_chave
		));
	}

	/**
	 * Efetua a baixa de um pagamento do contas a pagar.
	 *
	 * @param conta_pagar_lancar_pagamento $conta_pagar_lancar_pagamento Informações para realizar a Baixa do Contas a Pagar.
	 * @return conta_pagar_lancar_pagamento_resposta Resultado da baixa realizada para um lançamento do conta a pagar.
	 */
	public function LancarPagamento($conta_pagar_lancar_pagamento){
		return self::_Call('LancarPagamento',Array(
			$conta_pagar_lancar_pagamento
		));
	}

	/**
	 * Cancela um pagamento realizado no Contas a Pagar
	 *
	 * @param conta_pagar_cancelar_pagamento $conta_pagar_cancelar_pagamento Cancela um pagamento realizado para um título do Contas a Pagar.
	 * @return conta_pagar_cancelar_pagamento_resposta Resposta do Cancelamento de um pagamento realizado para um título do Contas a Pagar.
	 */
	public function CancelarPagamento($conta_pagar_cancelar_pagamento){
		return self::_Call('CancelarPagamento',Array(
			$conta_pagar_cancelar_pagamento
		));
	}

	/**
	 * Inclusão do contas a pagar por lote
	 *
	 * @param conta_pagar_lote $conta_pagar_lote Inclusão em Lote de contas a pagar&nbsp;
	 * @return conta_pagar_lote_response Resposta do Lançamento de contas a pagar por lote&nbsp;
	 */
	public function IncluirContaPagarPorLote($conta_pagar_lote){
		return self::_Call('IncluirContaPagarPorLote',Array(
			$conta_pagar_lote
		));
	}

	/**
	 * Upsert do Contas a Pagar
	 *
	 * @param conta_pagar_cadastro $conta_pagar_cadastro Cadastro de contas a pagar.
	 * @return conta_pagar_cadastro_response Resposta do Cadastro de Contas a Pagar
	 */
	public function UpsertContaPagar($conta_pagar_cadastro){
		return self::_Call('UpsertContaPagar',Array(
			$conta_pagar_cadastro
		));
	}

	/**
	 * Efetua o UPSERT do Contas a Pagar por Lote
	 *
	 * @param conta_pagar_lote $conta_pagar_lote Inclusão em Lote de contas a pagar&nbsp;
	 * @return conta_pagar_lote_response Resposta do Lançamento de contas a pagar por lote&nbsp;
	 */
	public function UpsertContaPagarPorLote($conta_pagar_lote){
		return self::_Call('UpsertContaPagarPorLote',Array(
			$conta_pagar_lote
		));
	}

	/**
	 * Listar as Contas a Pagar
	 *
	 * @param lcpListarRequest $lcpListarRequest Solicitação de Listagem de Contas a Pagar
	 * @return lcpListarResponse Resposta da listagem de Contas a Pagar
	 */
	public function ListarContasPagar($lcpListarRequest){
		return self::_Call('ListarContasPagar',Array(
			$lcpListarRequest
		));
	}
}

/**
 * Cadastro de contas a pagar.
 *
 * @pw_element integer $codigo_lancamento_omie Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
 * @pw_element string $codigo_lancamento_integracao Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
 * @pw_element integer $codigo_cliente_fornecedor Código do Favorecido / Fornecedor.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.
 * @pw_element string $codigo_cliente_fornecedor_integracao Código de Integração do Favorecido / Fornecedor.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente_omie'.<BR>
 * @pw_element string $data_vencimento Data de Vencimento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Esse campo indica a data da vencimento do título e deve ser informado com uma data igual ou superior a data corrente.<BR>
 * @pw_element decimal $valor_documento Valor da Conta.<BR>Preenchimento Obrigatório.
 * @pw_element string $codigo_categoria Código da Categoria.<BR>Preenchimento Opcional.<BR><BR>Caso não preenchido, assumirá a categoria padrão para o fornecedor informado. Caso não hajá um específico, retornará erro até que um código de categoria válido seja informado.<BR><BR>Utilize a tag 'codigo' do método 'ListarCategorias' da API<BR>http://app.omie.com.br/api/v1/geral/categorias/<BR>para obter essa informação.
 * @pw_element string $data_previsao Data da Previsão de Pagamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Caso não informado, assumirá a data de vencimento informada.<BR><BR>Esse campo indica a data da previsão do título e deve ser informado com uma data igual ou superior a data corrente.<BR>
 * @pw_element integer $id_conta_corrente Código da Conta Corrente.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá o padrão para o fornecedor. Caso não haja um padrão definido, retornará erro até que uma Conta Corrente válida seja informada.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.
 * @pw_element string $numero_documento_fiscal Número da Nota Fiscal associada ao lançamento de Contas a Pagar.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
 * @pw_element string $data_emissao Data de Emissão.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá a data corrente.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
 * @pw_element string $data_entrada Data de Registro.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá a data corrente.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
 * @pw_element integer $codigo_projeto Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
 * @pw_element string $observacao Observações.<BR>Preenchimento Opcional.<BR><BR>Utilize o carater ( | ) pipe como separador de linhas.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR>
 * @pw_element decimal $valor_pis Valor PIS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element string $retem_pis Reter PIS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element decimal $valor_cofins Valor COFINS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element string $retem_cofins Reter COFINS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element decimal $valor_csll Valor CSLL.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.<BR>
 * @pw_element string $retem_csll Reter CSLL.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element decimal $valor_ir Valor IR.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element string $retem_ir Reter IR.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element decimal $valor_iss Valor ISS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element string $retem_iss Reter ISS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element decimal $valor_inss Valor INSS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element string $retem_inss Reter INSS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
 * @pw_element distribuicaoArray $distribuicao Distribuição por Departamentos.<BR>Preenchimento Opcional.<BR><BR>
 * @pw_element string $numero_pedido Número do Pedido.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
 * @pw_element string $codigo_tipo_documento Código do Tipo de Documento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
 * @pw_element string $numero_documento Número do Documento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
 * @pw_element string $numero_parcela Número da parcela.<BR>Preenchimento Opcional.<BR><BR>Utilizar o formato '999/999'.<BR><BR>Para 1 parcela utilize '001/001'<BR><BR>Se não informado assumirá o valor '001/001'.<BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>
 * @pw_element string $chave_nfe Chave da NF.e.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
 * @pw_element string $codigo_barras_ficha_compensacao Código de Barras<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
 * @pw_element integer $codigo_vendedor Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
 * @pw_element string $id_origem Código da Origem.<BR>Preenchimento automático - Não informar.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Os valores disponíveis são:<BR><BR>'APIP' - Integração de Conta a Pagar<BR>'BARP' - Conta a Pagar Importada por Código de Barras<BR>'COMP' - Parcela a Pagar de Compras<BR>'CTEP' - Parcela a Pagar de um CT-e<BR>'DEVP' - Conta a Pagar da Devolução de Venda<BR>'IMPP' - Parcela a Pagar de uma Nota de Importação<BR>'MANP' - Lançamento Manual de Conta a Pagar<BR>'NFEP' - Conta a Pagar Importada de uma NF-e<BR>'RPTP' - Repetição de Contas a Pagar<BR>'XMLP' - Conta a Pagar Importada de um arquivo XML
 * @pw_element info $info Informações sobre a criação/alteração do lançamento de Contas a Pagar.<BR>Preenchimento automático - Não informar.
 * @pw_element string $operacao Código da Operação.&nbsp;.<BR>Preenchimento Automático - Não preencher.<BR><BR>Esse campo indica qual tipo de operação está associada ao lançamento de Contas a Pagar.<BR><BR>Os valores disponíveis são:<BR><BR>'01' - Venda de Serviço<BR>'11' - Venda de Produto<BR>'12' - Venda de Produto pelo PDV<BR>'13' - Devolução de Venda<BR>'14' - Remessa de Produto<BR>'16' - Nota Complementar de Saída
 * @pw_element string $status_titulo Status do Título.<BR>Preenchimento automático - Não informar.<BR><BR>Essa informação é retornada na consulta/pesquisa dos lançamentos de Contas a Pagar.
 * @pw_element string $nsu NSU - Número Sequencial Único.<BR>Preenchimento Opcional.<BR><BR>Para lançamentos relacionados a Cartão de Crédito.
 * @pw_element string $acao DEPRECATED
 * @pw_element string $id_conta_corrente_integracao DEPRECATED
 * @pw_element string $bloqueado DEPRECATED
 * @pw_element string $baixa_bloqueada DEPRECATED
 * @pw_element string $codigo_cmc7_cheque DEPRECATED
 * @pw_element string $importado_api Importado pela API (S/N).
 * @pw_complex conta_pagar_cadastro
 */
class conta_pagar_cadastro{
	/**
	 * Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código do Favorecido / Fornecedor.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codigo_cliente_fornecedor;
	/**
	 * Código de Integração do Favorecido / Fornecedor.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente_omie'.<BR>
	 *
	 * @var string
	 */
	public $codigo_cliente_fornecedor_integracao;
	/**
	 * Data de Vencimento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Esse campo indica a data da vencimento do título e deve ser informado com uma data igual ou superior a data corrente.<BR>
	 *
	 * @var string
	 */
	public $data_vencimento;
	/**
	 * Valor da Conta.<BR>Preenchimento Obrigatório.
	 *
	 * @var decimal
	 */
	public $valor_documento;
	/**
	 * Código da Categoria.<BR>Preenchimento Opcional.<BR><BR>Caso não preenchido, assumirá a categoria padrão para o fornecedor informado. Caso não hajá um específico, retornará erro até que um código de categoria válido seja informado.<BR><BR>Utilize a tag 'codigo' do método 'ListarCategorias' da API<BR>http://app.omie.com.br/api/v1/geral/categorias/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $codigo_categoria;
	/**
	 * Data da Previsão de Pagamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Caso não informado, assumirá a data de vencimento informada.<BR><BR>Esse campo indica a data da previsão do título e deve ser informado com uma data igual ou superior a data corrente.<BR>
	 *
	 * @var string
	 */
	public $data_previsao;
	/**
	 * Código da Conta Corrente.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá o padrão para o fornecedor. Caso não haja um padrão definido, retornará erro até que uma Conta Corrente válida seja informada.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $id_conta_corrente;
	/**
	 * Número da Nota Fiscal associada ao lançamento de Contas a Pagar.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $numero_documento_fiscal;
	/**
	 * Data de Emissão.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá a data corrente.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $data_emissao;
	/**
	 * Data de Registro.<BR>Preenchimento Opcional.<BR><BR>Caso não informado, assumirá a data corrente.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $data_entrada;
	/**
	 * Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codigo_projeto;
	/**
	 * Observações.<BR>Preenchimento Opcional.<BR><BR>Utilize o carater ( | ) pipe como separador de linhas.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR>
	 *
	 * @var string
	 */
	public $observacao;
	/**
	 * Valor PIS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var decimal
	 */
	public $valor_pis;
	/**
	 * Reter PIS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_pis;
	/**
	 * Valor COFINS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var decimal
	 */
	public $valor_cofins;
	/**
	 * Reter COFINS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_cofins;
	/**
	 * Valor CSLL.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.<BR>
	 *
	 * @var decimal
	 */
	public $valor_csll;
	/**
	 * Reter CSLL.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_csll;
	/**
	 * Valor IR.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var decimal
	 */
	public $valor_ir;
	/**
	 * Reter IR.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_ir;
	/**
	 * Valor ISS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var decimal
	 */
	public $valor_iss;
	/**
	 * Reter ISS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_iss;
	/**
	 * Valor INSS.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var decimal
	 */
	public $valor_inss;
	/**
	 * Reter INSS.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Se não informado, será assumido 'N' por padrão.<BR><BR>Informação localizada na Aba "Impostos Retidos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $retem_inss;
	/**
	 * Distribuição por Departamentos.<BR>Preenchimento Opcional.<BR><BR>
	 *
	 * @var distribuicaoArray
	 */
	public $distribuicao;
	/**
	 * Número do Pedido.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Código do Tipo de Documento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $codigo_tipo_documento;
	/**
	 * Número do Documento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $numero_documento;
	/**
	 * Número da parcela.<BR>Preenchimento Opcional.<BR><BR>Utilizar o formato '999/999'.<BR><BR>Para 1 parcela utilize '001/001'<BR><BR>Se não informado assumirá o valor '001/001'.<BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>
	 *
	 * @var string
	 */
	public $numero_parcela;
	/**
	 * Chave da NF.e.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $chave_nfe;
	/**
	 * Código de Barras<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.
	 *
	 * @var string
	 */
	public $codigo_barras_ficha_compensacao;
	/**
	 * Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codigo_vendedor;
	/**
	 * Código da Origem.<BR>Preenchimento automático - Não informar.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Os valores disponíveis são:<BR><BR>'APIP' - Integração de Conta a Pagar<BR>'BARP' - Conta a Pagar Importada por Código de Barras<BR>'COMP' - Parcela a Pagar de Compras<BR>'CTEP' - Parcela a Pagar de um CT-e<BR>'DEVP' - Conta a Pagar da Devolução de Venda<BR>'IMPP' - Parcela a Pagar de uma Nota de Importação<BR>'MANP' - Lançamento Manual de Conta a Pagar<BR>'NFEP' - Conta a Pagar Importada de uma NF-e<BR>'RPTP' - Repetição de Contas a Pagar<BR>'XMLP' - Conta a Pagar Importada de um arquivo XML
	 *
	 * @var string
	 */
	public $id_origem;
	/**
	 * Informações sobre a criação/alteração do lançamento de Contas a Pagar.<BR>Preenchimento automático - Não informar.
	 *
	 * @var info
	 */
	public $info;
	/**
	 * Código da Operação.&nbsp;.<BR>Preenchimento Automático - Não preencher.<BR><BR>Esse campo indica qual tipo de operação está associada ao lançamento de Contas a Pagar.<BR><BR>Os valores disponíveis são:<BR><BR>'01' - Venda de Serviço<BR>'11' - Venda de Produto<BR>'12' - Venda de Produto pelo PDV<BR>'13' - Devolução de Venda<BR>'14' - Remessa de Produto<BR>'16' - Nota Complementar de Saída
	 *
	 * @var string
	 */
	public $operacao;
	/**
	 * Status do Título.<BR>Preenchimento automático - Não informar.<BR><BR>Essa informação é retornada na consulta/pesquisa dos lançamentos de Contas a Pagar.
	 *
	 * @var string
	 */
	public $status_titulo;
	/**
	 * NSU - Número Sequencial Único.<BR>Preenchimento Opcional.<BR><BR>Para lançamentos relacionados a Cartão de Crédito.
	 *
	 * @var string
	 */
	public $nsu;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $acao;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $id_conta_corrente_integracao;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $baixa_bloqueada;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $codigo_cmc7_cheque;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $importado_api;
}


/**
 * Distribuição por Departamentos.
 *
 * @pw_element string $cCodDep Código do Departamento
 * @pw_element string $cDesDep Descrição do Departamento
 * @pw_element decimal $nValDep Valor do rateio
 * @pw_element decimal $nPerDep Percentual do rateio
 * @pw_complex distribuicao
 */
class distribuicao{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDep;
	/**
	 * Descrição do Departamento
	 *
	 * @var string
	 */
	public $cDesDep;
	/**
	 * Valor do rateio
	 *
	 * @var decimal
	 */
	public $nValDep;
	/**
	 * Percentual do rateio
	 *
	 * @var decimal
	 */
	public $nPerDep;
}


/**
 * Informações sobre a criação/alteração do lançamento de Contas a Pagar.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hInc Hora da Inclusão.<BR>No formato hh:mm:ss.
 * @pw_element string $uInc Usuário da Inclusão.
 * @pw_element string $dAlt Data da Alteração.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hAlt Hora da Alteração.<BR>No formato hh:mm:ss.
 * @pw_element string $uAlt Usuário da Alteração.
 * @pw_element string $cImpAPI Importado pela API (S/N).
 * @pw_complex info
 */
class info{
	/**
	 * Data da Inclusão.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Chave da conta a pagar
 *
 * @pw_element integer $codigo_lancamento_omie Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
 * @pw_element string $codigo_lancamento_integracao Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
 * @pw_complex conta_pagar_cadastro_chave
 */
class conta_pagar_cadastro_chave{
	/**
	 * Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
}

/**
 * Resposta do Cadastro de Contas a Pagar
 *
 * @pw_element integer $codigo_lancamento_omie Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
 * @pw_element string $codigo_lancamento_integracao Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
 * @pw_element string $codigo_status Código do Status do processamento
 * @pw_element string $descricao_status Descrição do Status do Lote&nbsp;
 * @pw_complex conta_pagar_cadastro_response
 */
class conta_pagar_cadastro_response{
	/**
	 * Código do Lançamento de Contas a Pagar.<BR>Preenchimento automático na inclusão.<BR>Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Contas a Pagar mas é a chave de integração via API. <BR>É uma informação interna, utilizada apenas nas APIs.<BR>
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código do Status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do Status do Lote&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Cancela um pagamento realizado para um título do Contas a Pagar.
 *
 * @pw_element integer $codigo_baixa Código para identificar a baixa do título no Contas a Pagar.
 * @pw_element string $codigo_baixa_integracao Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
 * @pw_complex conta_pagar_cancelar_pagamento
 */
class conta_pagar_cancelar_pagamento{
	/**
	 * Código para identificar a baixa do título no Contas a Pagar.
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
}

/**
 * Resposta do Cancelamento de um pagamento realizado para um título do Contas a Pagar.
 *
 * @pw_element integer $codigo_baixa Código para identificar a baixa do título no Contas a Pagar.
 * @pw_element string $codigo_baixa_integracao Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
 * @pw_element string $codigo_status Código do Status do processamento
 * @pw_element string $descricao_status Descrição do Status do Lote&nbsp;
 * @pw_complex conta_pagar_cancelar_pagamento_resposta
 */
class conta_pagar_cancelar_pagamento_resposta{
	/**
	 * Código para identificar a baixa do título no Contas a Pagar.
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Código do Status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do Status do Lote&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Informações para realizar a Baixa do Contas a Pagar.
 *
 * @pw_element integer $codigo_lancamento Código do lançamento no contas a pagar.
 * @pw_element string $codigo_lancamento_integracao Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
 * @pw_element integer $codigo_baixa Código para identificar a baixa do título no Contas a Pagar.
 * @pw_element string $codigo_baixa_integracao Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
 * @pw_element integer $codigo_conta_corrente Código da Conta Corrente.
 * @pw_element string $codigo_conta_corrente_integracao DEPRECATED
 * @pw_element decimal $valor Valor baixado
 * @pw_element decimal $desconto Valor do desconto.
 * @pw_element decimal $juros Valor do Juros.
 * @pw_element decimal $multa Valor da multa.
 * @pw_element string $data Data da Baixa
 * @pw_element string $observacao Observação da Baixa do Contas a Receber.
 * @pw_complex conta_pagar_lancar_pagamento
 */
class conta_pagar_lancar_pagamento{
	/**
	 * Código do lançamento no contas a pagar.
	 *
	 * @var integer
	 */
	public $codigo_lancamento;
	/**
	 * Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código para identificar a baixa do título no Contas a Pagar.
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Código da Conta Corrente.
	 *
	 * @var integer
	 */
	public $codigo_conta_corrente;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $codigo_conta_corrente_integracao;
	/**
	 * Valor baixado
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Valor do desconto.
	 *
	 * @var decimal
	 */
	public $desconto;
	/**
	 * Valor do Juros.
	 *
	 * @var decimal
	 */
	public $juros;
	/**
	 * Valor da multa.
	 *
	 * @var decimal
	 */
	public $multa;
	/**
	 * Data da Baixa
	 *
	 * @var string
	 */
	public $data;
	/**
	 * Observação da Baixa do Contas a Receber.
	 *
	 * @var string
	 */
	public $observacao;
}

/**
 * Resultado da baixa realizada para um lançamento do conta a pagar.
 *
 * @pw_element integer $codigo_lancamento Código do lançamento no contas a pagar.
 * @pw_element string $codigo_lancamento_integracao Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
 * @pw_element integer $codigo_baixa Código para identificar a baixa do título no Contas a Pagar.
 * @pw_element string $codigo_baixa_integracao Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
 * @pw_element string $liquidado Indica que o recebimento liquidado.
 * @pw_element decimal $valor_baixado Valor baixado
 * @pw_element string $codigo_status Código do Status do processamento
 * @pw_element string $descricao_status Descrição do Status do Lote&nbsp;
 * @pw_complex conta_pagar_lancar_pagamento_resposta
 */
class conta_pagar_lancar_pagamento_resposta{
	/**
	 * Código do lançamento no contas a pagar.
	 *
	 * @var integer
	 */
	public $codigo_lancamento;
	/**
	 * Código de Integração do Lançamento de Contas a Pagar.<BR>Preenchimento Obrigatório na inclusão.<BR>Preenchimento Opcional na Alteração/Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do lançamento do Contas a Pagar no aplicativo que você está integração com o Omie. <BR>A função dele é servir como uma mapa de relacionamento entre as aplicações. <BR>Ao realizar uma consulta/listagem de Contas a Pagar você conseguirá ver a relação entre o id do Contas a Pagar gerado no Omie e o código do Contas a Pagar existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código para identificar a baixa do título no Contas a Pagar.
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código da baixa do integrador para identificar a baixa de um título do contas a pagar.
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Indica que o recebimento liquidado.
	 *
	 * @var string
	 */
	public $liquidado;
	/**
	 * Valor baixado
	 *
	 * @var decimal
	 */
	public $valor_baixado;
	/**
	 * Código do Status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do Status do Lote&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Inclusão em Lote de contas a pagar
 *
 * @pw_element integer $lote Número do lote processado
 * @pw_element conta_pagar_cadastroArray $conta_pagar_cadastro Cadastro de contas a pagar.
 * @pw_complex conta_pagar_lote
 */
class conta_pagar_lote{
	/**
	 * Número do lote processado
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Cadastro de contas a pagar.
	 *
	 * @var conta_pagar_cadastroArray
	 */
	public $conta_pagar_cadastro;
}

/**
 * Resposta do Lançamento de contas a pagar por lote
 *
 * @pw_element integer $lote Número do lote processado
 * @pw_element string $codigo_status Código do Status do processamento
 * @pw_element string $descricao_status Descrição do Status do Lote&nbsp;
 * @pw_complex conta_pagar_lote_response
 */
class conta_pagar_lote_response{
	/**
	 * Número do lote processado
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Código do Status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do Status do Lote&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Solicitação de Listagem de Contas a Pagar
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros por página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. <BR>Preenchimento Opcional.<BR><BR>O valor padrão para esse campo é 'CODIGO'.<BR><BR>Os valores disponíveis são:<BR>'CODIGO'<BR>'CODIGO_INTEGRACAO'
 * @pw_element string $ordem_descrescente Exibir em Ordem Crescente ou Decrescente<BR>Preenchimento Opcional.<BR><BR>Informar 'S' para exibir os dados em Ordem Descrescente ou 'N' para exibir os dados em Ordem Crescente.<BR><BR>O valor padrão para esse campo é 'N'.
 * @pw_element string $filtrar_por_data_de Data de fim do filtro.<BR>Preenchimento Opcional.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Serão consideradas as datas de inclusão e alteração do lançamento de Contas a Pagar conforme definido nos campos 'filtrar_apenas_inclusao' e 'filtrar_apenas_alteracao'.<BR>
 * @pw_element string $filtrar_por_data_ate Data de fim do filtro.<BR>Preenchimento Opcional.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Serão consideradas as datas de inclusão e alteração do lançamento de Contas a Pagar conforme definido nos campos 'filtrar_apenas_inclusao' e 'filtrar_apenas_alteracao'.<BR>
 * @pw_element string $filtrar_apenas_inclusao Filtra os registros exibindos apenas os incluídos.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
 * @pw_element string $filtrar_apenas_alteracao Filtra os registros exibindos apenas os alterados.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
 * @pw_element integer $filtrar_conta_corrente Filtrar os lançamentos de Contas a Pagar por código da conta corrente.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.<BR>
 * @pw_element integer $filtrar_cliente Filtrar os lançamentos de Contas a Pagar por código do cliente.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.
 * @pw_element string $filtrar_por_cpf_cnpj Filtrar os títulos por CPF/CNPJ.<BR>Preenchimento Opcional.<BR><BR>Informar apenas números.
 * @pw_element string $filtrar_por_status Filtrar por status.<BR>Preenchimento Opcional.<BR><BR>Valores disponíveis:<BR>CANCELADO, <BR>PAGO,<BR>LIQUIDADO <BR>EMABERTO<BR>PAGTO_PARCIAL<BR>VENCEHOJE <BR>AVENCER<BR>ATRASADO
 * @pw_element integer $filtrar_por_projeto Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
 * @pw_element integer $filtrar_por_vendedor Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
 * @pw_element string $filtrar_apenas_titulos_em_aberto DEPRECATED.
 * @pw_complex lcpListarRequest
 */
class lcpListarRequest{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. <BR>Preenchimento Opcional.<BR><BR>O valor padrão para esse campo é 'CODIGO'.<BR><BR>Os valores disponíveis são:<BR>'CODIGO'<BR>'CODIGO_INTEGRACAO'
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Exibir em Ordem Crescente ou Decrescente<BR>Preenchimento Opcional.<BR><BR>Informar 'S' para exibir os dados em Ordem Descrescente ou 'N' para exibir os dados em Ordem Crescente.<BR><BR>O valor padrão para esse campo é 'N'.
	 *
	 * @var string
	 */
	public $ordem_descrescente;
	/**
	 * Data de fim do filtro.<BR>Preenchimento Opcional.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Serão consideradas as datas de inclusão e alteração do lançamento de Contas a Pagar conforme definido nos campos 'filtrar_apenas_inclusao' e 'filtrar_apenas_alteracao'.<BR>
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Data de fim do filtro.<BR>Preenchimento Opcional.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Serão consideradas as datas de inclusão e alteração do lançamento de Contas a Pagar conforme definido nos campos 'filtrar_apenas_inclusao' e 'filtrar_apenas_alteracao'.<BR>
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtra os registros exibindos apenas os incluídos.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtra os registros exibindos apenas os alterados.<BR>Preenchimento Opcional.<BR><BR>Informar 'S' ou 'N'.<BR><BR>O valor padrão para esse campo é 'N'.
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Filtrar os lançamentos de Contas a Pagar por código da conta corrente.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.<BR>
	 *
	 * @var integer
	 */
	public $filtrar_conta_corrente;
	/**
	 * Filtrar os lançamentos de Contas a Pagar por código do cliente.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $filtrar_cliente;
	/**
	 * Filtrar os títulos por CPF/CNPJ.<BR>Preenchimento Opcional.<BR><BR>Informar apenas números.
	 *
	 * @var string
	 */
	public $filtrar_por_cpf_cnpj;
	/**
	 * Filtrar por status.<BR>Preenchimento Opcional.<BR><BR>Valores disponíveis:<BR>CANCELADO, <BR>PAGO,<BR>LIQUIDADO <BR>EMABERTO<BR>PAGTO_PARCIAL<BR>VENCEHOJE <BR>AVENCER<BR>ATRASADO
	 *
	 * @var string
	 */
	public $filtrar_por_status;
	/**
	 * Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $filtrar_por_projeto;
	/**
	 * Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $filtrar_por_vendedor;
	/**
	 * DEPRECATED.
	 *
	 * @var string
	 */
	public $filtrar_apenas_titulos_em_aberto;
}

/**
 * Resposta da listagem de Contas a Pagar
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros por página.
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element conta_pagar_cadastroArray $conta_pagar_cadastro Cadastro de contas a pagar.
 * @pw_complex lcpListarResponse
 */
class lcpListarResponse{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Total de páginas encontradas.
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * Total de registros encontrados.
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Cadastro de contas a pagar.
	 *
	 * @var conta_pagar_cadastroArray
	 */
	public $conta_pagar_cadastro;
}

/**
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
if (!class_exists('omie_fail')) {
class omie_fail{
	/**
	 * Codigo do erro
	 *
	 * @var integer
	 */
	public $code;
	/**
	 * Descricao do erro
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Origem do erro
	 *
	 * @var string
	 */
	public $referer;
	/**
	 * Indica se eh um erro fatal
	 *
	 * @var boolean
	 */
	public $fatal;
}
}