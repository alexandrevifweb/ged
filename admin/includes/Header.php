<?php

require_once("VerificaLogin.php");
include("includes/config.php");
include("includes/funcoesGerais.php");
include("../includes/funcao/class.funcao.php");
include("template/Template.class.php");

$tplHeader = new Template("html/header.html");

date_default_timezone_set("America/Sao_Paulo");
$url = basename($_SERVER['REQUEST_URI']);
switch(trim($url)){
	case 'ClienteGerenciamento.php':
		$tplHeader->ACTIVE_CLIENTE = 'active';
		break;
	case 'GerenciarCliente.php':
		$tplHeader->ACTIVE_CLIENTE_GERENCIAR = 'active';
		break;
	case 'ClientePesquisa.php':
		$tplHeader->ACTIVE_CLIENTE_PESQUISA = 'active';
		break;		
	case 'UsuarioListar.php':
		$tplHeader->ACTIVE_CLIENTE_CONF = 'active';
		break;
}
$tplHeader->SYS_NOME = SYS_NOME;
$tplHeader->NOME_USUARIO = $_SESSION['UsuNome'];
$tplHeader->ID_USUARIO = $_SESSION['IdUsuario'];

$sql = $mysqli->query("Select * from usuario where IdUsuario = ".$_SESSION['IdUsuario']."");

if($sql->num_rows > 0){
	$query = $sql->fetch_object();
	if($query->UsuImagem != ""){
		$tplHeader->USU_CAMINHO_IMAGEM = HTTP_IMAGENS_USUARIO.$query->UsuImagem;
	}else{
		$tplHeader->USU_CAMINHO_IMAGEM = "dist/img/avatar5.png";
	}
}

$tplHeader->show();				
?>