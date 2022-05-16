<?php
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
ob_start();
include("includes/Header.php");
date_default_timezone_set('America/Sao_Paulo');

$tpl = new Template("html/ClienteGerenciamento.html");

$funcao = new Funcao();


function somenteNomeArquivo($arquivo){
	$ext = explode('.', $arquivo);
	return $ext[0];
}

if( $_FILES['arquivo']['name'] == '') $arquivo = $_POST['arquivoAntiga'];
else {
	$nome_pasta = $funcao->minusculaTexto($_POST['nome_completo']);
    
    if (!file_exists(PATH_ARQUIVO_PDF . $nome_pasta)) {
        mkdir(PATH_ARQUIVO_PDF . $nome_pasta, 0775, true);
    }
    
	for ($k = 0; $k < count($_FILES['arquivo']['name']); $k++) {
		$imagens = $_FILES['arquivo']['name'][$k];
        
        // Pega a extensão
        $extensao = pathinfo($imagens, PATHINFO_EXTENSION);
        
        // Converte a extensão para minúsculo
        $extensao    = strtolower($extensao);
        $arquivo = somenteNomeArquivo($imagens);
        $arquivo      = $arquivo . '.' . $extensao;
        
        $uploaddir = PATH_ARQUIVO_PDF . $nome_pasta . "/"; //Diretório para uploads
        
        $destino = $uploaddir . $arquivo;

		move_uploaded_file($_FILES['arquivo']['tmp_name'][$k], $destino);		
			
	}
}

$data = date("d-m-Y");

$id = $_POST['id'];;

$nome_completo=$_POST['nome_completo'];
$estado_civil=$_POST['estado_civil'];
$naturalidade=$_POST['naturalidade'];
$nacionalidade=$_POST['nacionalidade'];
$endereco=$_POST['endereco'];
$numero=$_POST['numero'];
$bairro=$_POST['bairro'];
$estado=$_POST['estado'];
$cidade=$_POST['cidade'];
$rg=$_POST['rg'];
$cep=$_POST['cep'];
$emissor=$_POST['emissor'];
$cpf=$_POST['cpf'];
$data_de_nascimento=$_POST['data_nascimento'];
$idade=$_POST['idade'];
$profissao=$_POST['profissao'];
$telefone=$_POST['telefone'];
$telefone_recado=$_POST['telefone_recado'];

//Formulário
$servico=$_POST['servico'];
$comprovante_prop_rural=$_POST['comprovante_prop_rural'];
$doc_faltante=$_POST['doc_faltante'];
$observacao=$_POST['observacao'];
$testemunha=$_POST['testemunhas'];
$testemunha_outro=$_POST['testemunha_outro'];
$comprovante_prisao_outro=$_POST['comprovante_prisao_outro'];
$checkboxvar = $_POST['checkboxvar'];

if (isset($_POST['id'])) {
    
    if ($_POST['id'] != "") {
        
        $mysqli->query("UPDATE cliente SET 
		nome_completo='$nome_completo',
		estado_civil='$estado_civil',
		naturalidade='$naturalidade',
		nacionalidade='$nacionalidade',
		endereco='$endereco',
		numero='$numero',
		bairro='$bairro',
		estado='$estado',
		cidade='$cidade',
		cep = '$cep',
		rg='$rg',
		emissor = '$emissor',
		cpf='$cpf',
		data_de_nascimento='$data_de_nascimento',
		idade='$idade',
		profissao='$profissao',
		telefone = '$telefone',
		telefone_recado = '$telefone_recado'
        WHERE id = $id");
		
		$mysqli->query("UPDATE formulario SET 
		servico='$servico',
		documento='$documento',
		doc_faltante='$doc_faltante',
		observacao='$observacao'
        WHERE id_cliente = $id");
		$mysqli->query("DELETE FROM `form_documento` WHERE id_cliente = ".$id."") or die("Erro ao deletar doc:" . $mysqli->error);
        foreach ($checkboxvar as $checkboxvars=>$value) {
           $mysqli->query("INSERT INTO form_documento(id_cliente, valor) 
			VALUES ('".$id."', '".$value."')") or die("Erro ao adicionar Cliente:" . $mysqli->error);
        }
        header("location:ClientePesquisa.php?status=editar-sucesso");
        
    } else {
        // Cadastro de aluno
		
        $mysqli->query("INSERT INTO cliente(nome_completo, estado_civil, naturalidade, nacionalidade, cep, endereco, numero, bairro, estado, cidade, rg, emissor, cpf, data_de_nascimento, idade, profissao, telefone, telefone_recado) 
		VALUES ('$nome_completo', '$estado_civil', '$naturalidade', '$nacionalidade', '$cep', '$endereco', '$numero', '$bairro', '$estado', 
		'$cidade', '$rg', '$emissor', '$cpf', '$data_de_nascimento', '$idade', '$profissao','$telefone', '$telefone_recado')") 
		or die("Erro ao adicionar Cliente:" . $mysqli->error);
        $sqlcliente = $mysqli->query("SELECT * FROM cliente WHERE cpf = '$cpf'");
        $cliente    = $sqlcliente->fetch_object();
		foreach ($checkboxvar as $checkboxvars=>$value) {
           $mysqli->query("INSERT INTO form_documento(id_cliente, valor) 
			VALUES ('".$cliente->id."', '".$value."')") or die("Erro ao adicionar doc:" . $mysqli->error);
        }
		$mysqli->query("INSERT INTO formulario(id_cliente, servico, comprovante_prop_rural, doc_faltante, observacao, testemunha, testemunha_outro, comprovante_prisao_outro) 
		VALUES ('".$cliente->id."', '$servico', '$comprovante_prop_rural', '$doc_faltante', '$observacao',  '$testemunha', '$testemunha_outro', '$comprovante_prisao_outro')") or die("Erro ao adicionar Cliente:" . $mysqli->error);
		
		for ($k = 0; $k < count($_POST['arquivo_nome']); $k++) {
			$arquivo = $_FILES['arquivo']['name'][$k];
			$mysqli->query("INSERT INTO documento 

			(arquivo,  id_cliente, nome)

			VALUES('".$arquivo."', '".$cliente->id."', '".$_POST['arquivo_nome'][$k]."')") or die ("Erro ao adicionar Cliente:" . $mysqli->error);
		}

		
        header("location:ClientePesquisa.php?status=adicionar-sucesso");
    }
    
} else {
    if ($_GET['id']) {
        
        //Dados Cliente
        $sqlcliente = $mysqli->query("SELECT * FROM cliente WHERE id = '$_GET[id]'");
        $cliente    = $sqlcliente->fetch_object();
        
        $tpl->FORM_ID              = $cliente->id;
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
		$tpl->FORM_CEP = $cliente->cep;
		$tpl->FORM_TELEFONE_RECADO = $cliente->telefone_recado;
		
		$sqlForm = $mysqli->query("SELECT * FROM formulario WHERE id_cliente = '$_GET[id]'");
        $form    = $sqlForm->fetch_object();
		$tpl->FORM_SERVICO = $form->servico;
		$tpl->FORM_PROP_RURAL = $form->comprovante_prop_rural;
		$tpl->FORM_DOC_FALTANTE = $form->doc_faltante;
		$tpl->FORM_OBS = $form->observacao;
		$tpl->FORM_TEST = $form->testemunha;
		$tpl->FORM_OUTROS_TEST = $form->testemunha_outro;
		$tpl->FORM_OUTROS_PRISAO = $form->comprovante_prisao_outro;
		
		$sqlDoc = $mysqli->query("SELECT * FROM form_documento WHERE id_cliente = '$_GET[id]'");
        while($doc    = $sqlDoc->fetch_object()){
			switch($doc->valor){
				case 1:
					$tpl->CHECKED_1 = "checked";
					break;
				case 2:
					$tpl->CHECKED_2 = "checked";
					break;
				case 3:
					$tpl->CHECKED_3 = "checked";
					break;
				case 4:
					$tpl->CHECKED_4 = "checked";
					break;
				case 5:
					$tpl->CHECKED_5 = "checked";
					break;
				case 6:
					$tpl->CHECKED_6 = "checked";
					break;
				case 7:
					$tpl->CHECKED_7 = "checked";
					break;
				case 8:
					$tpl->CHECKED_8 = "checked";
					break;
				case 9:
					$tpl->CHECKED_9 = "checked";
					break;
				case 10:
					$tpl->CHECKED_10 = "checked";
					break;
				case 11:
					$tpl->CHECKED_12 = "checked";
					break;
				case 13:
					$tpl->CHECKED_13 = "checked";
					break;
				case 14:
					$tpl->CHECKED_14 = "checked";
					break;
				case 15:
					$tpl->CHECKED_15 = "checked";
					break;
				case 16:
					$tpl->CHECKED_16 = "checked";
					break;
				case 17:
					$tpl->CHECKED_17 = "checked";
					break;
				case 18:
					$tpl->CHECKED_18 = "checked";
					break;
				case 19:
					$tpl->CHECKED_19 = "checked";
					break;
				case 20:
					$tpl->CHECKED_20 = "checked";
					break;
				case 21:
					$tpl->CHECKED_21 = "checked";
					break;
				case 22:
					$tpl->CHECKED_22 = "checked";
					break;
				case 23:
					$tpl->CHECKED_23 = "checked";
					break;
				case 24:
					$tpl->CHECKED_24 = "checked";
					break;
				case 25:
					$tpl->CHECKED_25 = "checked";
					break;
				case 26:
					$tpl->CHECKED_26 = "checked";
					break;
				case 27:
					$tpl->CHECKED_27 = "checked";
					break;
				case 28:
					$tpl->CHECKED_28 = "checked";
					break;
			}
		}
      
        $_SESSION['id_cliente'] = $_GET['id'];
		$sql = $mysqli->query("SELECT * FROM documento WHERE id_cliente = ".$_GET['id']."");
		while($documento = $sql->fetch_object()){
			$tpl->DOC_NOME = $documento->nome;
			$tpl->DOC_ID = $documento->id;
			$tpl->DOC_ARQUIVO = HTTP_ARQUIVO_PDF.$funcao->minusculaTexto($cliente->nome_completo).'/'.$documento->arquivo;
			$tpl->block('BLOCK_DOCUMENTO');
			
		}
		if($_GET['editar']){
			$tpl->DISABLED = '';
		}else{
			$tpl->DISABLED = 'disabled';
		}
		$tpl->block('BLOCK_DOCUMENTO_GERAL');
		$tpl->block('BLOCK_FORM_EXCLUIR');
    } 
	 
    $tpl->show();
}
include("includes/Footer.php");
?>