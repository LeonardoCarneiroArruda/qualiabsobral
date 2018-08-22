<?php

require_once("vendor/autoload.php");
// require_once("vendor/classes/Page.php");
// require_once("vendor/classes/Usuario.php");
// require_once("vendor/classes/DB/Banco.php");

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;
use \Classes\Candidato;


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


$app->run();



?>