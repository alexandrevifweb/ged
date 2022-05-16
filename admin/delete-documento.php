<?php
ob_start();
session_start();
include('includes/config.php');
include("../includes/funcao/class.funcao.php");
// file name
if($_POST['id'] != ""){
	
	$mysqli->query("Delete from documento where id_cliente = '".$_SESSION['id_cliente']."' and id = '".$_POST['id']."'")
	or die ("Erro ao deltar docuemnto:" . $mysqli->error);
	$response = 1;
	echo json_encode($response);
	
}else{	
	$response = 0;
	echo json_encode($response);
}


