<?php

require_once("vendor/autoload.php");
// require_once("vendor/classes/Page.php");
// require_once("vendor/classes/Usuario.php");
// require_once("vendor/classes/DB/Banco.php");

use Rain\Tpl;
use \Slim\Slim;
use \Classes\Page;
use \Classes\Usuario;


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

$app->get("/grupo1", function() {

	$page = new Page();

	$page->setTpl("grupo1");

});

$app->get("/grupo2", function() {

	$page = new Page();

	$page->setTpl("grupo2");

});

$app->get("/grupo3.1", function() {

	$page = new Page();

	$page->setTpl("grupo3.1");

});

$app->get("/grupo3.2", function() {

	$page = new Page();

	$page->setTpl("grupo3.2");

});

$app->get("/grupo3.3", function() {

	$page = new Page();

	$page->setTpl("grupo3.3");

});

$app->get("/grupo3.4", function() {

	$page = new Page();

	$page->setTpl("grupo3.4");

});

$app->get("/grupo3.5", function() {

	$page = new Page();

	$page->setTpl("grupo3.5");

});

$app->get("/grupo3.6", function() {

	$page = new Page();

	$page->setTpl("grupo3.6");

});

$app->get("/grupo3.7", function() {

	$page = new Page();

	$page->setTpl("grupo3.7");

});

$app->get("/grupo4.1", function() {

	$page = new Page();

	$page->setTpl("grupo4.1");

});

$app->get("/grupo4.2", function() {

	$page = new Page();

	$page->setTpl("grupo4.2");

});

$app->get("/fim", function() {

	$page = new Page();

	$page->setTpl("fim");

});

$app->run();



?>