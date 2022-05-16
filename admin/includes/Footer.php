<?php
session_start();
$tpl = new Template("html/footer.html");
//$tpl->SYS_DOMINIO = SYS_DOMINIO."admin/";



$tpl->show();
?>