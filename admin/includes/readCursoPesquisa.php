<?php
require_once("config.php");
if(!empty($_POST["keyword"])) {
	$sql = $mysqli->query("SELECT * FROM cadastro_curso WHERE nome like '" . $_POST["keyword"] . "%' ORDER BY nome desc LIMIT 0,6");
	$result = $sql->num_rows;
	if(!empty($result)) {
?>
		<ul id="six_imoveis_cliente-list">
			<?php
			while($cadastro_curso = $sql->fetch_object()) {
			?>
				<li onClick="selectTitleCursoPesquisa('<?php echo $cadastro_curso->nome; echo "',"; echo $cadastro_curso->id;?>);"><?php echo $cadastro_curso->nome; ?></li>
			<?php 
			} 
			?>
		</ul>
	<?php 
	} 
} 
?>