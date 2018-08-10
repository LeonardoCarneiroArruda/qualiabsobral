<?php

require_once("DB". DIRECTORY_SEPARATOR ."config_banco.php");

class Resposta {

	private $idresposta;
	private $resposta;
	private $resposta_desc;
	private $idcandidato;	
	private $idalternativa;

	public function setResposta($resposta) {
		$this->resposta = $resposta;
	}

	public function getResposta() {
		return $this->resposta;
	}

	public function setResposta_desc($resposta_desc) {
		$this->resposta_desc = $resposta_desc;
	}

	public function getResposta_desc() {
		return $this->resposta_desc;
	}

	public function setIdcandidato($idcandidato) {
		$this->idcandidato = $idcandidato;
	}

	public function getIdcandidato() {
		return $this->idcandidato;
	}

	public function setIdalternativa($idalternativa) {
		$this->idalternativa = $idalternativa;
	}

	public function getIdalternativa() {
		return $this->idalternativa;
	}

}




?>