<?php

// error_reporting(E_ALL);

// ini_set('display_errors', TRUE);

// ini_set('display_startup_errors', TRUE);

ob_start();

include("VerificaLogin.php");

include("includes/config.php");

include("template/Template.class.php");

$tpl = new Template("html/formulario.html");

$tpl->ANO = date('Y');

 //Dados Cliente
$sqlcliente = $mysqli->query("SELECT * FROM cliente WHERE id = '$_GET[id_cliente]'");
$cliente    = $sqlcliente->fetch_object();
$tpl->FORM_NOME            = $cliente->nome_completo;
// $tpl->FORM_NACIONALIDADE   = $cliente->nacionalidade;
$tpl->FORM_RG              = $cliente->rg;
$tpl->FORM_EMISSOR             = $cliente->emissor;
$tpl->FORM_CPF             = $cliente->cpf;
$tpl->FORM_ENDERECO         = $cliente->endereco;		
$tpl->FORM_NUMERO         = $cliente->numero;		
$tpl->FORM_BAIRRO         = $cliente->bairro;
$tpl->FORM_NATURAL         = $cliente->naturalidade;
$tpl->FORM_ESTADO          = $cliente->estado;
$tpl->FORM_CIDADE          = $cliente->cidade;
$tpl->FORM_ESTADO_CIVIL     = $cliente->estado_civil;
$tpl->FORM_DATA_NASCIMENTO = $cliente->data_de_nascimento;
$tpl->FORM_IDADE     = $cliente->idade;
$tpl->FORM_PROFISSAO = $cliente->profissao;
$tpl->FORM_TELEFONE = $cliente->telefone;
$tpl->FORM_TELEFONE_RECADO = $cliente->telefone_recado;

$sqlForm = $mysqli->query("SELECT * FROM formulario WHERE id_cliente = '$_GET[id_cliente]'");
$form    = $sqlForm->fetch_object();
if($form->servico != ''){
	$tpl->FORM_SERVICO = $form->servico;
	$tpl->CHECKED_SERVICO = "checked-";
}

if($form->comprovante_prop_rural != ''){	
	$tpl->FORM_PROP_RURAL = $form->comprovante_prop_rural;
	$tpl->CHECKED_RURAl = "checked-";
}

if($form->testemunha != ''){
	$tpl->FORM_TEST = $form->testemunha;
	$tpl->CHECKED_TEST = "checked-";
}

if($form->testemunha_outro != ''){
	$tpl->FORM_OUTROS_TEST = $form->testemunha_outro;
	$tpl->CHECKED_TEST_OUTRO = "checked-";
}

if($form->comprovante_prisao_outro != ''){
	$tpl->FORM_OUTROS_PRISAO = $form->comprovante_prisao_outro;
	$tpl->CHECKED_PRISAO_OUTRO = "checked-";
}

$tpl->FORM_DOC_FALTANTE = $form->doc_faltante;
$tpl->FORM_OBS = $form->observacao;

$sqlDoc = $mysqli->query("SELECT * FROM form_documento WHERE id_cliente = '$_GET[id_cliente]'");
while($doc    = $sqlDoc->fetch_object()){
	switch($doc->valor){
		case 1:
			$tpl->CHECKED_1 = "checked-";
			break;
		case 2:
			$tpl->CHECKED_2 = "checked-";
			break;
		case 3:
			$tpl->CHECKED_3 = "checked-";
			break;
		case 4:
			$tpl->CHECKED_4 = "checked-";
			break;
		case 5:
			$tpl->CHECKED_5 = "checked-";
			break;
		case 6:
			$tpl->CHECKED_6 = "checked-";
			break;
		case 7:
			$tpl->CHECKED_7 = "checked-";
			break;
		case 8:
			$tpl->CHECKED_8 = "checked-";
			break;
		case 9:
			$tpl->CHECKED_9 = "checked-";
			break;
		case 10:
			$tpl->CHECKED_10 = "checked-";
			break;
		case 11:
			$tpl->CHECKED_12 = "checked-";
			break;
		case 13:
			$tpl->CHECKED_13 = "checked-";
			break;
		case 14:
			$tpl->CHECKED_14 = "checked-";
			break;
		case 15:
			$tpl->CHECKED_15 = "checked-";
			break;
		case 16:
			$tpl->CHECKED_16 = "checked-";
			break;
		case 17:
			$tpl->CHECKED_17 = "checked-";
			break;
		case 18:
			$tpl->CHECKED_18 = "checked-";
			break;
		case 19:
			$tpl->CHECKED_19 = "checked-";
			break;
		case 20:
			$tpl->CHECKED_20 = "checked-";
			break;
		case 21:
			$tpl->CHECKED_21 = "checked-";
			break;
		case 22:
			$tpl->CHECKED_22 = "checked-";
			break;
		case 23:
			$tpl->CHECKED_23 = "checked-";
			break;
		case 24:
			$tpl->CHECKED_24 = "checked-";
			break;
		case 25:
			$tpl->CHECKED_25 = "checked-";
			break;
		case 26:
			$tpl->CHECKED_26 = "checked-";
			break;
		case 27:
			$tpl->CHECKED_27 = "checked-";
			break;
		case 28:
			$tpl->CHECKED_28 = "checked-";
			break;
	}
}


$tpl->show();

?>