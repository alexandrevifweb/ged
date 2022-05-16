<?php
require_once("config.php");
if(!empty($_POST["keyword"])) {
	$sql = $mysqli->query("SELECT * FROM cadastro_faculdade WHERE nome like '" . $_POST["keyword"] . "%' ORDER BY nome desc LIMIT 0,6");
	$result = $sql->num_rows;
	if(!empty($result)) {
?>
		<ul id="six_imoveis_cliente-list">
			<?php
			while($cadastro_faculdade = $sql->fetch_object()) {
			?>
				<li onClick="selectTitleFaculdadePesquisa('<?php echo $cadastro_faculdade->nome; echo "',"; echo $cadastro_faculdade->id;?>);"><?php echo $cadastro_faculdade->nome; ?></li>
			<?php 
			} 
			?>
		</ul>
	<?php 
	} 
} 
?>