<?php
include('includes/config.php');
include("../includes/funcao/class.funcao.php");
$funcao = new Funcao();
ob_start();
session_start();
$sqlcliente = $mysqli->query("SELECT * FROM cliente WHERE id = " . $_SESSION['id_cliente'] . "");
$cliente    = $sqlcliente->fetch_object();
$sql = $mysqli->query("SELECT * FROM documento WHERE id_cliente = " . $_SESSION['id_cliente'] . "");
while ($documento = $sql->fetch_object()) {
    echo '<div style="margin-bottom: 10px;  float: left; padding: 10px; margin-right: 10px;" id="doc-' . $documento->id . '" class="btn-cancelar"><a  href="'.HTTP_ARQUIVO_PDF . $funcao->minusculaTexto($cliente->nome_completo) . '/' . $documento->arquivo .'" style="padding: 10px; color: gray;" target="_blank">' . $documento->nome . '</a>
		<a href="javascript: void(0);" onclick="delDoc(' . $documento->id . ')"><i class="fa fa-close" style="color: gray; border: 2px solid rgba(0, 0, 0, 0.20);border-radius: 100%;padding: 5px; height: 25px; width: 25px;"></i></a></div>';
}
?>