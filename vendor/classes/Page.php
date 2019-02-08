<?php

namespace Classes;

use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = DIRECTORY_SEPARATOR."qualiabsobral".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR) {

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
					"cache_dir"     => $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."qualiabsobral".DIRECTORY_SEPARATOR."views-cache".DIRECTORY_SEPARATOR,
					"debug"         => true
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) {
			session_start();
			Usuario::checkLogin();
			$this->setData(['usuarioLogado'=>$_SESSION['nome']]);
			$this->tpl->draw("header");
		}
	}

	private function setData($data = array()) {

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);

		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false) {
		
		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct() {
		
		if ($this->options["footer"] === true)
			$this->tpl->draw("footer");

	}





}


?>