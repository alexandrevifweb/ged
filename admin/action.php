<?php
	
	include('includes/config.php');

	// autocomplete textbox jquery ajax in PHP
	
	if (isset($_POST['pesquisar'])) {

  		$output = "";
  		$city = $_POST['pesquisar'];
  		$query = "SELECT * FROM cliente WHERE nome_completo LIKE '%$city%'";
  		$result = $mysqli->query($query);

  		$output = '<ul class="list-unstyled">';		

  		if ($result->num_rows > 0) {
  			while ($row = $result->fetch_array()) {
  				$output .= '<li id='.$row['id'].'><b>Nome:</b> '.ucwords($row['nome_completo']).' <span style="float:right;"><b>CPF:</b> '.ucwords($row['cpf']).' <b>ID:</b> '.ucwords($row['id']).'</span></li>';
  			}
  		}else{
  			  $output .= '<li> Não há registros com esse nome.</li>';
  		}
  		
	  	$output .= '</ul>';
	  	echo $output;
	}

?>