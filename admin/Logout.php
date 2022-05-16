<?php
//INICIALIZA A SESSÃO
session_start();

//DESTRÓI AS VARIÁVEIS
unset($_SESSION);
session_destroy();
session_start();

//REDIRECIONA PARA A TELA DE LOGIN
Header("Location: index.php"); 
?>