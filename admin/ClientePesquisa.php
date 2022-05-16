<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
// session_start();
require_once("VerificaLogin.php");
include("includes/Header.php");

// $funcao = new Funcao();

$tpl = new Template("html/ClientePesquisa.html");
if($_GET['deletar'] == true){
	$mysqli->query("Delete from cliente where id = ".$_GET['id']."") or die ("Erro ao deletar Cliente:" . $mysqli->error);	
}

$tpl->show();

include("includes/Footer.php");
?>