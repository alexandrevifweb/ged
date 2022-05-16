<?php
ob_start();
session_start();
include("includes/config.php");
$email = $_POST["email"];
$senha = md5(123456);

$resUser = mysql_query("SELECT * FROM six_imoveis_usuario WHERE UsuEmail = '$email' ") or die(mysql_error());

if (mysql_num_rows($resUser) == 1) {
    $user = mysql_fetch_object($resUser);
    mysql_query("Update six_imoveis_usuario set UsuSenha = '" . $senha . "' WHERE UsuEmail = '" . $email . "' ") or die(mysql_error());
    
	$destinatario = $email;
    $assunto      = "Alteração de e-mail";
    $corpo        = "<h1>Alteração de e-mail.</h1>
						Olá " . $user->UsuNome . ", sua nova senha 123456. Acesse o painel administrativo e efetue a troca da senha.
					";
    $headers      = "Content-Type:text/html; charset=UTF-8\n";
    $headers .= "From:  Grupo Troca de Senha <contato@flxweb.com.br>\n"; //Vai ser //mostrado que  o email partiu deste email e seguido do nome
    $headers .= "X-Sender:  <contato@flxweb.com.br>\n"; //email do servidor //que enviou
    $headers .= "X-Mailer: PHP  v" . phpversion() . "\n";
    $headers .= "X-IP:  " . $_SERVER['REMOTE_ADDR'] . "\n";
    $headers .= "Recomn-Path:  <contato@flxweb.com.br>\n"; //caso a msg //seja respondida vai para  este email.
    $headers .= "MIME-Version: 1.0\n";
    
    mail($destinatario, $assunto, $corpo, $headers, "-f$destinatario");
    
    $dados = 1;
    echo json_encode($dados);
} else {
    $dados = 0;
    echo json_encode($dados);
}

?>