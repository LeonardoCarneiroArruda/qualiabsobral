<?php

require_once("vendor/autoload.php");
// require_once("vendor/classes/Page.php");
// require_once("vendor/classes/Usuario.php");
// require_once("vendor/classes/DB/Banco.php");

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;
use \Classes\Pergunta;

echo "AQUI SÃO EXECUTADOS OS TESTES!<br>";

$perg = new Pergunta();

$results = $perg->select();

var_dump($results);



/*for ($i = 0; $results[$i]['title'] !== 'G1Q5'; $i++) {
	//echo "Title: ". $results[$i]['title']. "| ";
	//echo $results[$i]['title'][0] === 'G' ? "Question: ".utf8_encode($results[$i]['question'])." - " : "Alternativa: ".utf8_encode($results[$i]['question'])." - ";
	//echo "Relevance: ".$results[$i]['relevance']. "<br>";

	if ($results[$i]['title'][2] === 'Q' ) {
		$title = $results[$i]['title'];
		$descricao = utf8_encode($results[$i]['question']);
		$relevancia = $results[$i]['relevance'];
		$idgrupo_pergunta = $results[$i]['title'][1];

		echo "INSERT INTO (descricao, tipo, idgrupo_pergunta, codigo) VALUES (".$descricao.", ,".$idgrupo_pergunta.",".$title.")<br>";
	}
}	*/

?>