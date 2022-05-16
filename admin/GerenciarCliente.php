<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
ob_start();
include("includes/Header.php");
date_default_timezone_set('America/Sao_Paulo');

$tpl = new Template("html/GerenciarCliente.html");        
//Dados Cliente
$sqlcliente = $mysqli->query("SELECT * FROM cliente order by id desc");
while($cliente    = $sqlcliente->fetch_object()){
	$tpl->ALUNO_ID              = $cliente->id;
	$tpl->ALUNO_NOME            = $cliente->nome_completo;
	$tpl->block("BLOCK_CLIENTE");
}
$tpl->show();

include("includes/Footer.php");
?>