<?php

require_once("DB". DIRECTORY_SEPARATOR ."config_banco.php");

class Grupo_pergunta {

	private $idgrupo_pergunta;	
	private $nome;

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

}




?>