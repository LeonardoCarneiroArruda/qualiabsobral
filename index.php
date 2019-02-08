 <?php

require_once("vendor" . DIRECTORY_SEPARATOR . "autoload.php");
require_once("functions.php");

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;
use \Classes\Candidato;
use \Classes\Pergunta;
use \Classes\Alternativa;
use \Classes\Resposta;
use \Classes\Pontuacao;


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

	if ((Usuario::login($_POST['email'], $_POST['senha']))) {

		session_start();
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['nome'] = Usuario::returnNomePorEmail($_POST['email']);		

		header("Location: " . DIRECTORY_SEPARATOR . "qualiabsobral".DIRECTORY_SEPARATOR."index");
		exit;
    }
    else {
    	header("Location: " . DIRECTORY_SEPARATOR ."qualiabsobral" . DIRECTORY_SEPARATOR . "views".DIRECTORY_SEPARATOR."loginError.html");
    	exit;
    }

});


$app->get("/loginError", function() {

	$page = new Page();

	$page->setTpl("loginError");

});

$app->get("/logoff", function() {
	session_start();
	session_destroy();
	header("Location: ".DIRECTORY_SEPARATOR."qualiabsobral".DIRECTORY_SEPARATOR);
	exit;
});

$app->get("/index", function() {

	$page = new Page();

	$page->setTpl("index");

});

$app->get("/candidatos", function() {

	$candidatos = new Candidato();
	$medias = $candidatos->mediaFinal();
	
	$candidatos = $candidatos->selectAll();

	for($i = 0; $i < count($candidatos); $i++) {

		$cand = $candidatos[$i]['idcandidato'];

		foreach ($medias as $value) {
			if ((isset($value[$cand])) && ($value[$cand])) {
				$media = $value[$cand];
				break;
			}
			else {
				$media = "";
			}
		}

		array_push($candidatos[$i], $media);

	}

	$media_sobral = 0;
	for ($i = 0; $i < count($candidatos); $i++) {
		$media_sobral += $candidatos[$i][0];
	}
	$media_sobral = $media_sobral / count($candidatos);

	$page = new Page();

	$page->setTpl("candidatos", [
		'candidatos'=>$candidatos,
		'media_sobral'=>$media_sobral
	]);

});

$app->get("/detalhes/:id_candidato", function($idcandidato) {

	$candidato = new Candidato();

	$result = $candidato->get($idcandidato);

	$perguntas = new Pergunta();

	$perguntas = $perguntas->select();

	$listaQuestoesRespondidas = new Resposta();
	$listaQuestoesRespondidas = $listaQuestoesRespondidas->retornaListaDeQuestoesRespondidasPorCand($idcandidato);
	array_unshift($listaQuestoesRespondidas, "0");

	$page = new Page();

	$page->setTpl("detail-candidato", [
		'candidato'=>$result,
		'perguntas'=>$perguntas,
		'listaQuestoesRespondidas'=>$listaQuestoesRespondidas
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

	$resposta_unica = [0, 2, 13, 19, 20, 23, 30, 31, 34, 35, 36, 39, 43, 44, 61, 78, 80, 83, 84, 91];
	
	if (array_search($idpergunta, $resposta_unica) != false) {
		
		$pont = new Pontuacao();
		$pontos = $pont->returnPontuacao_respostaUnica($respostas[0], $alternativas);
		$pont->inserePontuacao($pontos, $idcandidato, $idpergunta);
		
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

			if (isset($respostas[$i]['resposta'])) { 
				array_push($alternativas[$i], $respostas[$i]['resposta']);
			}
			else {
				array_push($alternativas[$i], " ");
			}

			$pontuacao_total += $alternativas[$i]['peso']; 
			
			if ($alternativas[$i][0] == "Sim") {
				$pontuacao += $alternativas[$i]['peso']; 
			} 
		}

		$porcentagem = ($pontuacao * 100) / $pontuacao_total;
		$porcentagem = number_format($porcentagem, 2, ".", "");

		$pont = new Pontuacao();
		$pontos = $pont->returnPontuacao($pontuacao_total, $pontuacao);
		$pont->inserePontuacao($pontos, $idcandidato, $idpergunta);

		$exibePainel = array_search($idpergunta, [0, 1, 3, 5, 6, 7, 90]) ? false : true; 

		$page = new Page();

		$page->setTpl("detail-candidato-pergunta", [
			'candidato'=>$result,
			'perguntas'=>$perguntas,
			'alternativas'=>$alternativas,
			'pontuacao_total'=>$pontuacao_total,
			'pontuacao'=>$pontuacao,
			'porcentagem'=>$porcentagem,
			'exibePainel'=>$exibePainel		
		]);
	
	}

	
	

});


$app->get("/perguntas", function() {

	$perguntas = new Pergunta();

	$perguntas = $perguntas->select();

	$page = new Page();

		$page->setTpl("detail-pergunta", [
			'perguntas'=>$perguntas	
		]);

});

$app->get("/perguntas/:idpergunta", function($idpergunta) {

	$pergunta = new Pergunta();

	$pergunta = $pergunta->get($idpergunta); 

	$candidatos = new Candidato();

	$candidatos = $candidatos->selectAll();

	$resposta_unica = [0, 13, 19, 20, 23, 30, 31, 34, 35, 36, 39, 43, 44, 61, 78, 80, 83, 84];

	if (array_search($idpergunta, $resposta_unica) != false) {
		
		$respostas = new Pontuacao();
		$respostas = $respostas->getByPergunta_respostaUnica($idpergunta);

		for ($i = 0; $i < count($candidatos); $i++) {

			$pontos = "";
			$resp = "";
			for ($j = 0; $j < count($respostas); $j++) {	

				if ($candidatos[$i]['idcandidato'] == $respostas[$j]['idcandidato']) {
					$pontos = $respostas[$j]['peso'];
					$resp = $respostas[$j]['resposta'];
				}

			}

			array_push($candidatos[$i], $pontos);
			array_push($candidatos[$i], $resp);
			
		}

		$media = "";
		$moda = [0,0,0];
		$max = 0;

		for ($i = 0; $i < count($candidatos); $i++) {
			$media += $candidatos[$i]['0'];
			
			if ($candidatos[$i]['0'] == '2')
				$moda[2]++;
			else if ($candidatos[$i]['0'] == '1')
				$moda[1]++;
			else if ($candidatos[$i]['0'] == '0')
				$moda[0]++;	
		}

		$max = max($moda);
		$cont = count($moda);
		for($i = 0; $i < $cont; $i++) {
			if (isset($moda[$i]) && $moda[$i] != $max) {
				unset($moda[$i]);
				$i--;
			}
		}

		$media = "";
		for ($i = 0; $i < count($candidatos); $i++) {
			$media += $candidatos[$i]['0'];	
		}
		$media = $media / count($candidatos); 
		$media = number_format($media, 2, ".", "");
		
		$page = new Page();

		$page->setTpl("detail-pergunta-candidato-resposta_unica", [
			'candidatos'=>$candidatos, 
			'pergunta'=>$pergunta, 
			'media'=>$media, 
			'moda'=>$moda			
		]);
	}
	else {

		$pontuacao = new Pontuacao();

		$pontuacao = $pontuacao->getByPergunta($idpergunta);

		for ($i = 0; $i < count($candidatos); $i++) {

			$pontos = "";

			for ($j = 0; $j < count($pontuacao); $j++) {	

				if ($candidatos[$i]['idcandidato'] == $pontuacao[$j]['idcandidato']) {
					$pontos = $pontuacao[$j]['pontuacao'];
				}

			}

			array_push($candidatos[$i], $pontos);
			
		}

		$media = "";
		$moda = [0,0,0];
		$max = 0;

		for ($i = 0; $i < count($candidatos); $i++) {
			$media += $candidatos[$i]['0'];
			
			if ($candidatos[$i]['0'] == '2')
				$moda[2]++;
			else if ($candidatos[$i]['0'] == '1')
				$moda[1]++;
			else if ($candidatos[$i]['0'] == '0')
				$moda[0]++;	
		}

		$max = max($moda);
		$cont = count($moda);
		for($i = 0; $i < $cont; $i++) {
			if (isset($moda[$i]) && $moda[$i] != $max) {
				unset($moda[$i]);
				$i--;
			}
		}

		$media = $media / count($candidatos); 
		$media = number_format($media, 2, ".", "");

		$exibePainel = array_search($idpergunta, [0, 1, 2, 3, 5, 6, 7, 14, 24, 25, 90, 91]) ? false : true; 
		
		$page = new Page();

		$page->setTpl("detail-pergunta-candidato", [
			'candidatos'=>$candidatos, 
			'pergunta'=>$pergunta,
			'media'=>$media, 
			'moda'=>$moda,
			'exibePainel'=>$exibePainel	
		]);	
	}

});

$app->get("/grafico", function() {

	$perguntas = new Pergunta();
	$perguntas = $perguntas->selectPerguntasComGrafico();

	$page = new Page();

	$page->setTpl("graficos", [
		'perguntas'=>$perguntas
	]);
}); 

$app->get("/grafico/:idpergunta_grafico", function($idpergunta_grafico) {

	$perguntaComObs = [0, 5, 6];

	$pergunta = new Pergunta();
	$pergunta = $pergunta->get($idpergunta_grafico);

	if (array_search($idpergunta_grafico, $perguntaComObs) != true) {
		$page = new Page();

		$page->setTpl("pergunta_grafico", [
			"pergunta"=>$pergunta
		]);

	}
	else {

		$resposta = new Resposta();
		
		$NaoSabeNaoEncaminha = $resposta->retornaNaoSabeNaoEncaminhaPorQuestao($idpergunta_grafico);

		$resposta = $idpergunta_grafico == 5 ? $resposta->retornaDadosGraficoQuestao5() : $resposta->retornaDadosGraficoQuestao6();
//var_dump($NaoSabeNaoEncaminha);exit;
		$page = new Page();

		$page->setTpl("pergunta_grafico_comObs", [
			"pergunta"=>$pergunta,
			"observacoes"=>$resposta,
			"NaoSabeNaoEncaminha"=>$NaoSabeNaoEncaminha
		]);
	}
	

	
});


$app->run();



?>