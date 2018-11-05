<?php

namespace Classes;

use \Classes\DB\Banco;

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

	public function insereResposta($resposta, $idcandidato, $idalternativa) {
		$conn = Banco::connect();
		
		$stmt = $conn->prepare("insert into resposta (resposta, idcandidato, idalternativa) values (:resposta, :idcandidato, :idalternativa)");
		$stmt->bindParam(":resposta", $resposta);
		$stmt->bindParam(":idalternativa", $idalternativa);
		$stmt->bindParam(":idcandidato", $idcandidato);

		$stmt->execute();

	}

	public function get($idcandidato, $idpergunta) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from resposta where idcandidato = :idcandidato and idalternativa in (SELECT idalternativa FROM `alternativa` WHERE idpergunta = :idpergunta)");
		$stmt->bindParam(":idcandidato", $idcandidato);
		$stmt->bindParam(":idpergunta", $idpergunta);

		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $results;

	}


}




?>