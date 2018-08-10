<?php

require_once("DB". DIRECTORY_SEPARATOR ."config_banco.php");

class Alternativa {

	private $idalternativa;
	private $descricao;
	private $peso;
	private $idpergunta;	
	

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setPeso($peso) {
		$this->peso = $peso;
	}

	public function getPeso() {
		return $this->peso;
	}

	public function setIdpergunta($idpergunta) {
		$this->idpergunta = $idpergunta;
	}

	public function getIdpergunta() {
		return $this->idpergunta;
	}


}




?>