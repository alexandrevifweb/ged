<?php
ob_start();
session_start();
include('includes/config.php');
include("../includes/funcao/class.funcao.php");
// file name
$filename = $_FILES['file-input']['name'];
if($_POST['nome_arquivo'] != ""){
	$funcao = new Funcao();

	function somenteNomeArquivo($arquivo){
		$ext = explode('.', $arquivo);
		return $ext[0];
	}

	//Dados Documento

	$sqlAluno = $mysqli->query("SELECT * FROM cliente WHERE id = ".$_SESSION['id_cliente']."");
	$aluno    = $sqlAluno->fetch_object();
	$nome = trim($aluno->nome_completo);
	$nome_pasta = $funcao->minusculaTexto($nome);

	if (!file_exists(PATH_ARQUIVO_PDF . $nome_pasta)) {
	mkdir(PATH_ARQUIVO_PDF . $nome_pasta, 0775, true);
	}

	// Pega a extensão
	$extensao = pathinfo($filename, PATHINFO_EXTENSION);

	// Converte a extensão para minúsculo
	$extensao    = strtolower($extensao);
	$arquivo_nome = somenteNomeArquivo($filename);
	$arquivo      = $arquivo_nome . '.' . $extensao;

	$uploaddir = PATH_ARQUIVO_PDF . $nome_pasta . "/"; //Diretório para uploads

	$destino = $uploaddir . $arquivo;
	$response = 0;
		
	if(move_uploaded_file($_FILES['file-input']['tmp_name'], $destino)){	
		$mysqli->query("INSERT INTO documento 

		(arquivo,  id_cliente, nome)

		VALUES('".$arquivo."', '".$_SESSION['id_cliente']."', '".$_POST['nome_arquivo']."')")

		or die ("Erro ao adicionar Turismo Rural:" . $mysqli->error);
		$response = 1;
		echo $response;
	}else{	
		echo $response;
	}
}else{	
	$response = 0;
	echo $response;
}


