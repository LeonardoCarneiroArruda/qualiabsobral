<?php

require_once("vendor/autoload.php");
// require_once("vendor/classes/Page.php");
// require_once("vendor/classes/Usuario.php");
// require_once("vendor/classes/DB/Banco.php");
ini_set( 'display_errors', 0 );

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;
use \Classes\Pergunta;
use \Classes\Alternativa;
use \Classes\Resposta;

echo "AQUI SÃO EXECUTADOS OS TESTES!<br>";

$filename = "csfsinhasaboia.csv";

if (file_exists($filename)) {

	$file = fopen($filename, "r");

	$headers = explode(";", fgets($file));

	$data = array();

	while ($row = fgets($file)) {
		
		$rowData = explode(";", $row);
		$linha = array();

		for ($i = 0; $i < count($headers); $i++) {

			$linha[$headers[$i]] = $rowData[$i];
		}

		array_push($data, $linha);
	}

	fclose($file);

	//var_dump($data);
	$i = 0;
	$alternativa = new Alternativa();
	$resposta = new Resposta();
	$pergunta = new Pergunta();
	echo "<br><br> TESTES A PARTIR DAQUI <br><br>" ;
	foreach ($data[0] as $key => $value) {
		echo "============================= <br>";
		echo "key = $key || ";
		echo "value = $value <br>";
		$retorno = $pergunta->consulta($key);
		echo "Tipo da questao = " . $retorno[0];
	
		$string = explode("[", $key);
		$codigo_alternativa = substr($string[1], 0, -1);
		echo " codigo = $codigo_alternativa <br>";

		if ($codigo_alternativa == "other") {
			$string = explode("Q", $string[0]);
		//	var_dump($string[1]);
			
		}


		if ($retorno[0] == "descritiva" or $retorno[0] == "resposta_unica") {
			
			$codigo_alternativa = $retorno[0] == "descritiva" ? "Q" . $retorno[1] . "R1" : "Q" . $retorno[1] . "R".$value[0];

			$idalternativa = $alternativa->returnIdByCodigo($codigo_alternativa);


		}
		else {

			if ($retorno[2] == "other") {
				$codigo_alternativa = "Q" . $string[1] . "other";
			}

			$idalternativa = $alternativa->returnIdByCodigo($codigo_alternativa);
			

		}

		//$resposta->insereResposta($value, 21, $idalternativa);
	
	}
	

}


/* FUNÇÃO PARA CADASTRAR PERGUNTAS E ALTERNATIVAS VINDAS DO BANCO DO LIME
$perg = new Pergunta();

$results = $perg->recuperaQuestions();
*/
//var_dump($results);



?>