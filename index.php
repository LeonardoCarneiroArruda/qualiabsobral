<?php

require_once("vendor/autoload.php");
require_once("functions.php");

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;
use \Classes\Candidato;
use \Classes\Pergunta;
use \Classes\Alternativa;
use \Classes\Resposta;


$app = new Slim();

$app->config('debug', true);

$app->get("/", function() {

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

});

$app->post("/login", function() {

	Usuario::login($_POST['email'], $_POST['senha']);

	header("Location: /qualiabsobral/index");
	exit;

});

$app->get("/index", function() {

	$page = new Page();

	$page->setTpl("index");

});

$app->get("/candidatos", function() {

	$candidatos = new Candidato();

	$candidatos = $candidatos->selectAll();
	
	$page = new Page();

	$page->setTpl("candidatos", [
		'candidatos'=>$candidatos
	]);

});

$app->get("/detalhes/:id_candidato", function($idcandidato) {

	$candidato = new Candidato();

	$result = $candidato->get($idcandidato);

	$perguntas = new Pergunta();

	$perguntas = $perguntas->select();

	$page = new Page();

	$page->setTpl("detail-candidato", [
		'candidato'=>$result,
		'perguntas'=>$perguntas
	]);

});

$app->get("/candidatos/:idcandidato/resposta/:idpergunta", function($idcandidato, $idpergunta){

	$candidato = new Candidato();

	$result = $candidato->get($idcandidato);

	$perguntas = new Pergunta();

	$perguntas = $perguntas->get($idpergunta);

	$alternativas = new Alternativa();

	$alternativas = $alternativas->get($idpergunta);

	$respostas = new Resposta();

	$respostas = $respostas->get($idcandidato, $idpergunta);

	$resposta_unica = [0, 13, 19, 20, 23, 30, 31, 34, 35, 36, 39, 43, 44, 61, 78, 80, 83, 84];
	
	if (array_search($idpergunta, $resposta_unica) != false) {
		
		$page = new Page();

		$page->setTpl("detail-candidato-pergunta-resposta_unica", [
			'candidato'=>$result,
			'perguntas'=>$perguntas,
			'alternativas'=>$alternativas,
			'respostas'=>$respostas[0]		
		]);
	}
	else {
		$pontuacao_total = 0;
		$pontuacao = 0;

		for ($i = 0; $i < count($alternativas); $i++) {
			array_push($alternativas[$i], $respostas[$i]['resposta']);
			
			$pontuacao_total += $alternativas[$i]['peso']; 
			
			if ($alternativas[$i][0] == "Sim") {
				$pontuacao += $alternativas[$i]['peso']; 
			} 
		}

		$page = new Page();

		$page->setTpl("detail-candidato-pergunta", [
			'candidato'=>$result,
			'perguntas'=>$perguntas,
			'alternativas'=>$alternativas,
			'pontuacao_total'=>$pontuacao_total,
			'pontuacao'=>$pontuacao		
		]);
	
	}

	
	

});



$app->run();



?>