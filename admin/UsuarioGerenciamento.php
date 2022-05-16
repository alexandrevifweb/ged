<?php

include("includes/Header.php");

$tpl = new Template("html/UsuarioGerenciamento.html");

if( $_FILES['UsuImagem']['name'] == '') $UsuImagem = $_POST['ImagemAntiga'];
else {
	$_FILES['UsuImagem']['name'] = RemoveAcentos($_FILES['UsuImagem']['name']);
	require_once("includes/ImageResizer.php");
	$imgUp = new SimpleImage();
	$imgUp->load($_FILES['UsuImagem']['tmp_name']);
	if($imgUp->getWidth() > $imgUp->getHeight())
		$imgUp->resizeToWidth(200);
	else
		$imgUp->resizeToHeight(200);

	$imgUp->resize(200,200);
	$UsuImagem = $_FILES['UsuImagem']['name'];
	$uploaddir = PATH_IMAGENS_USUARIO;
	$arquivo = $uploaddir.$UsuImagem;
	$imgUp->save($arquivo, $image_type=IMAGETYPE_PNG, $compression=90, $permissions=null);
	if($_POST['ImagemAntiga'] != "" && $_POST['ImagemAntiga'] != $_FILES['UsuImagem']['name']){
		unlink($uploaddir . $_POST['ImagemAntiga']);
	}
	//print "A UsuImagem foi gravada com sucesso.";
}

$IdUsuario  = $_POST['IdUsuario'];
$UsuNome 	= addslashes($_POST['UsuNome']);
$UsuEmail   = addslashes($_POST['UsuEmail']);

if($_POST['SenhaNova'] != "")
	$UsuSenha = md5($_POST['SenhaNova']);
else
	$UsuSenha = $_POST['SenhaAntiga'];

//testa se esta recebendo um formulario
if(isset($_POST['IdUsuario'])) {

	if($_POST['IdUsuario'] != "") {
			
		$mysqli->query("UPDATE usuario 
		SET
		UsuNome = '$UsuNome',
		UsuEmail = '$UsuEmail',
		UsuSenha = '$UsuSenha',
		UsuImagem = '$UsuImagem'
		WHERE IdUsuario = $IdUsuario")
		or die ("Erro ao editar Usu&aacute;rio:" . $mysqli->error);
		header("location:UsuarioListar.php?status=editar-sucesso");					
	} else {
			
		$mysqli->query("INSERT INTO usuario
		(UsuNome, UsuEmail, UsuSenha, UsuImagem)
		VALUES ('$UsuNome', '$UsuEmail', '$UsuSenha', '$UsuImagem')")
		or die ("Erro ao inserir Usu&aacute;rio:" . $mysqli->error);
		header("location:UsuarioListar.php?status=adicionar-sucesso");		
	}

	echo '<meta HTTP-EQUIV = "Refresh" CONTENT = "1; URL = UsuarioListar.php">';
} else {
	if($_GET[id]){
		$sqlUsuario = $mysqli->query("SELECT * FROM usuario WHERE IdUsuario = '$_GET[id]'");
		$usuario = $sqlUsuario->fetch_object();
			
		$tpl->ID_USUARIO = $usuario->IdUsuario;
		$tpl->USU_NOME 	 = htmlspecialchars($usuario->UsuNome);
		$tpl->USU_EMAIL  = htmlspecialchars($usuario->UsuEmail);
		$tpl->USU_SENHA  = htmlspecialchars($usuario->UsuSenha);
		$tpl->USU_IMAGEM = $usuario->UsuImagem;
		
		if($usuario->UsuImagem != "") {
			$tpl->USU_IMAGEM_CAMINHO = HTTP_IMAGENS_USUARIO.$usuario->UsuImagem;
			$tpl->block("BLOCK_IMAGEM");
		}		
		$tpl->BOTAO = "Editar";
	} else {
		$tpl->BOTAO = "Adicionar";
	}
	$tpl->show();
}
include("includes/Footer.php");
?>