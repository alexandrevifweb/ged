<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
ob_start();
include("VerificaLogin.php");
include("includes/config.php");
include("template/Template.class.php");
include("../includes/funcao/class.funcao.php");


$funcao = new Funcao();

$tpl = new Template("html/emitir-procuracao.html");

$id = $_GET['id_cliente'];

$sqlProcuracao = $mysqli->query("SELECT * FROM cliente WHERE id = " . $id . "");

$procuracao       = $sqlProcuracao->fetch_object();
$tpl->CLIENTE_NOME            = $procuracao->nome_completo;
//$tpl->CLIENTE_NACIONALIDADE   = $procuracao->nacionalidade;
$tpl->CLIENTE_RG              = $procuracao->rg;
$tpl->CLIENTE_EMISSOR            = $procuracao->emissor;
$tpl->CLIENTE_CPF             = $procuracao->cpf;
$tpl->CLIENTE_ENDERECO         = $procuracao->endereco;		
$tpl->CLIENTE_NUMERO         = $procuracao->numero;		
$tpl->CLIENTE_BAIRRO         = $procuracao->bairro;
$tpl->CLIENTE_NATURAL         = $procuracao->naturalidade;
$tpl->CLIENTE_ESTADO          = $procuracao->estado;
$tpl->CLIENTE_CIDADE          = $procuracao->cidade;
$tpl->CLIENTE_ESTADO_CIVIL     = $procuracao->estado_civil;
$tpl->CLIENTE_DATA_NASCIMENTO = $procuracao->data_de_nascimento;
$tpl->CLIENTE_IDADE     = $procuracao->idade;
$tpl->CLIENTE_PROFISSAO = $procuracao->profissao;
//$tpl->CLIENTE_CEP = $procuracao->cep;
$tpl->CLIENTE_TELEFONE = $procuracao->telefone;
$tpl->CLIENTE_TELEFONE_RECADO = $procuracao->telefone_recado;
$sql = $mysqli->query("SELECT * FROM assinatura WHERE id_cliente = ".$_GET['id_cliente']." order by id desc");
$assinatura = $sql->fetch_object();
$sqlAluno = $mysqli->query("SELECT * FROM cliente WHERE id = '$_GET[id_cliente]'");
$aluno    = $sqlAluno->fetch_object();
$nome = trim($aluno->nome_completo);

//$tpl->IMAGEM = HTTP_IMAGENS_ASSINATURA.$funcao->minusculaTexto($nome).'/'.$assinatura->arquivo;

$tpl->show();
?>