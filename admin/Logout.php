<?php
//INICIALIZA A SESS�O
session_start();

//DESTR�I AS VARI�VEIS
unset($_SESSION);
session_destroy();
session_start();

//REDIRECIONA PARA A TELA DE LOGIN
Header("Location: index.php"); 
?>