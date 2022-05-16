<?php
	class Funcao{
		
		//Funções

		public function UrlAmigavel($id,$str, $replace=array(), $delimiter='-'){
			setlocale(LC_ALL, 'en_US.UTF8');
			if( !empty($replace) ) {
				$str = str_replace((array)$replace, ' ', $str);
			}
		 
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
     
			$texto = $id."/".$clean."/";
			return $texto;
		}
		
		public function qrcode($url, $size){
			if($url != "" && $size != ""){
				return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=".$size."x".$size."";
			}
		}		
		
		public function minusculaTexto($str, $replace=array(), $delimiter='-'){
			setlocale(LC_ALL, 'en_US.UTF8');
			if( !empty($replace) ) {
				$str = str_replace((array)$replace, ' ', $str);
			}
		 
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
     
			return $clean;
		}
		
		public function sanitizeString($str) {
			$str = preg_replace('/[áàãâä]/ui', 'a', $str);
			$str = preg_replace('/[éèêë]/ui', 'e', $str);
			$str = preg_replace('/[íìîï]/ui', 'i', $str);
			$str = preg_replace('/[óòõôö]/ui', 'o', $str);
			$str = preg_replace('/[úùûü]/ui', 'u', $str);
			$str = preg_replace('/[ç]/ui', 'c', $str);
			// $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
			//$str = preg_replace('/[^a-z0-9]/i', '', $str);
			return $str;
		}
				
		public function PegaDadosUrl($url, $posicao){
			$caminho = explode ('/',$url);
			$caminho = $caminho[$posicao];
			return $caminho;
		}
		
		
		public function moeda($get_valor) {
			$valor = str_replace(".", ",", $get_valor); //remove os pontos e substitui a virgula pelo ponto
			return $valor; //retorna o valor formatado para gravar no banco
		}
		
		public function limitarTexto($texto, $limite){
			$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
			return $texto;
		}
		
		public function pegarParteEmail($email){
			$parteEmail = substr($email, 0, strpos( $email, '@' ));
			return $parteEmail;
		}
		
		public function reArrayFiles(&$file_post) {

			$file_ary = array();
			$file_count = count($file_post['name']);
			$file_keys = array_keys($file_post);

			for ($i=0; $i<$file_count; $i++) {
				foreach ($file_keys as $key) {
					$file_ary[$i][$key] = $file_post[$key][$i];
				}
			}

			return $file_ary;
		}
		
		public function convertem($term, $tp) { 
			if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
			elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
			return $palavra; 
		} 

		public static function converteMinuscula($term) { 
			$conversao = array('á' => 'a','à' => 'a','ã' => 'a','â' => 'a', 'é' => 'e',
			 'ê' => 'e', 'í' => 'i', 'ï'=>'i', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', "ö"=>"o",
			 'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'ñ'=>'n', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A',
			 'Â' => 'A', 'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ï'=>'I', "Ö"=>"O", 'Ó' => 'O',
			 'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' =>'C', 'N'=>'Ñ');
			$palavra = strtr($term,$conversao);     
			return $palavra; 
		} 
	}
?>