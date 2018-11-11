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

$filename = "respostaindividual.csv";

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
			$codigo_alternativa = "Q" . $retorno[1] . "R1";
			$idalternativa = $alternativa->returnIdByCodigo($codigo_alternativa);

		}
		else {

			if ($retorno[2] == "other") {
				$codigo_alternativa = "Q" . $string[1] . "other";
			}

			$idalternativa = $alternativa->returnIdByCodigo($codigo_alternativa);
			

		}

		//$resposta->insereResposta($value, 20, $idalternativa);
	
	}

/**/	
	//FUNÇÃO DE TESTE DE LEITURA DO ARQUIVO, RESPOSTAS E CALCULO DA MEDIA

	$alternativa = new Alternativa();

	foreach ($data as $key => $value) {
			
		echo "<strong>Registro: $key</strong><br>";

		echo "UBS: " . $value["token"] . "<br>";
		$dividendo = 0;
		$media = 0;
		foreach ($value as $chave => $valor) {
			
			if ($chave[0] === 'B' && $chave[1] === '1') {

				if ($chave[6] === '0') {
					$num = $chave[7];
				}
				else {
					$num = $chave[6] . $chave[7];
				}

				$codigo = "Q8A" . $num; 
				
				$peso = $alternativa->returnPeso($codigo);

				$dividendo += (int)$peso;

				echo $chave . ": " . $valor . " | Peso: " . $peso . "<br>";

				if ($valor === 'Sim') 
					$media += $peso;
			}

		}
		$resultfinal = $media/$dividendo;
		$percentual =  $resultfinal * 100;                                              //($resultfinal * 100) / 2; 
		echo "Dividendo: $dividendo   Media: $media <br>";
		echo "Media final: " . $resultfinal . "| Percentual: " . $percentual."%";
		echo "<br>";
		echo "Pontuação:  $dividendo <br>";
		$setentaecinco = $dividendo * 0.75;
		$vinteecinco = $dividendo * 0.25;
		echo "> 75% ($setentaecinco) = 2 <br>";
		echo "<= 75% ($setentaecinco) e >= 25% ($vinteecinco) = 1 <br>";
		echo "< 25% ($vinteecinco) = 0<br><br>";

	}

}


/* FUNÇÃO PARA CADASTRAR PERGUNTAS E ALTERNATIVAS VINDAS DO BANCO DO LIME
$perg = new Pergunta();

$results = $perg->recuperaQuestions();
*/
//var_dump($results);



?>