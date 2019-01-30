<?php


function formatText($descricao) {

	$alternativa = utf8_encode($descricao);

	return $alternativa;
}

function return75($valor) {
	$valor = $valor * 0.75;

	return $valor;
}

function return25($valor) {
	$valor = $valor * 0.25;

	return $valor;
}

function formatFloat($valor) {
	$valor = (float)$valor;
	$valor = number_format($valor, 2, ".", "");

	return $valor;
}

function retornaRodapeGrafico($idpergunta) {

	switch ($idpergunta) {
		case 5:
			return "Média do tempo de espera entre o encaminhamento e a consulta em SERVIÇOS DE REFERÊNCIA para especialidades acima";
		break;

		case 6: 
			return "Média do tempo de espera entre a marcação de exames e a realização deles";
		break;
		
		case 14: 
			return "";
		break;

		case 24:
			return "Número de Unidade Básicas de Saúde que responderam sobre a realização de apoio matricial na unidade";
		break;

		case 25:
			return "Número de Unidade Básicas de Saúde que responderam sobre a realização de apoio matricial na unidade, se tem potencializado a capacidade resolutiva da equipe de saúde da família";
		break;

		case 39: 
			return "Número de Unidade Básicas de Saúde que responderam sobre os casos de SIFILIS CONGENITA em gestantes no ultimo ano";
		break;

		default:
			return "";
			break;
	}
}


function retornaSeQuestaoRespondida($lista, $idpergunta) {
	
	foreach ($lista as $key => $value) {

		if (isset($value["pergunta"]) && $value["pergunta"] == $idpergunta) {
			return "<i class='fa fa-check'></i>";
		}
	}
}


?>