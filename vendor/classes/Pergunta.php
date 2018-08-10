<?php

require_once("DB". DIRECTORY_SEPARATOR ."config_banco.php");

class Pergunta {

	private $idpergunta;	
	private $descricao;
	private $tipo;
	private $idgrupo_pergunta;

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function getTipo() {
		return $this->tipo;
	}

	public function setIdgrupo_pergunta($idgrupo_pergunta) {
		$this->idgrupo_pergunta = $idgrupo_pergunta;
	}

	public function getIdgrupo_pergunta() {
		return $this->idgrupo_pergunta;
	}


}




?>