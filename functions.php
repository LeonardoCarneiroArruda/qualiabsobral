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

?>