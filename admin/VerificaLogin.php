<?php
ob_start();
session_start();

if( (!isset($_SESSION['IdUsuario'])) AND (!isset($_SESSION['UsuNome'])) AND (!isset($_SESSION['UsuEmail'])) )
	header("Location: index.php");
?>