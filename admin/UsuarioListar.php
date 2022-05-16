<?php
include("includes/Header.php");

if($_GET["acao"] == "deletar"){	
	
	$sqlUsuario = $mysqli->query("SELECT * FROM usuario WHERE IdUsuario = '".$_GET["id"]."'");
	$UsuImagem = mysql_fetch_object($sqlUsuario);

	if($UsuImagem->UsuImagem != "") {
		$caminho = PATH_IMAGENS_USUARIO;
		unlink($caminho . $UsuImagem->UsuImagem);
	}
	
	$mysqli->query("DELETE FROM usuario WHERE IdUsuario = ".$_GET["id"]."")
	or die ("Erro ao apagar Usuário" . $mysqli->error);	
	
	header("location:UsuarioListar.php?status=deletar-sucesso");		
}

if( empty($_GET["acao"]) ){

	$tpl 	= new Template("html/UsuarioListar.html");

	$sqlUsuario = $mysqli->query("SELECT * FROM usuario
			WHERE
			(UPPER(UsuNome) LIKE UPPER('%$campo%') OR UPPER(UsuEmail) LIKE UPPER('%$campo%')) 
			ORDER BY UsuNome ASC") or die($mysqli->error);
	
	while ($usuario=$sqlUsuario->fetch_object()) {
		$tpl->ID_USUARIO 	= $usuario->IdUsuario;
		$tpl->USU_NOME  	= $usuario->UsuNome;
		$tpl->block("BLOCK_USUARIO");
	}
	
	if($_GET["status"] == "editar-sucesso"){	
		$tpl->block("BLOCK_SUCESS_EDITAR");
	}
	
	if($_GET["status"] == "deletar-sucesso"){	
		$tpl->block("BLOCK_SUCESS");
	}
	
	if($_GET["status"] == "adicionar-sucesso"){	
		$tpl->block("BLOCK_SUCESS_ADICIONAR");
	}
	
	$tpl->show();
}
include("includes/Footer.php");
?>