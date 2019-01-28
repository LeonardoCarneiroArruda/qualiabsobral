<?php

namespace Classes;

use \Classes\DB\Banco;

class Pontuacao {

	private $idpontuacao;
	private $pontuacao;
	private $idcandidato;	
	private $idpergunta;

	public function setPontuacao($pontuacao) {
		$this->pontuacao = $pontuacao;
	}

	public function getPontuacao() {
		return $this->pontuacao;
	}

	public function setIdcandidato($idcandidato) {
		$this->idcandidato = $idcandidato;
	}

	public function getIdcandidato() {
		return $this->idcandidato;
	}

	public function setIdpergunta($idpergunta) {
		$this->idpergunta = $idpergunta;
	}

	public function getIdpergunta() {
		return $this->idpergunta;
	}

	public function inserePontuacao($pontuacao, $idcandidato, $idpergunta) {
		$sem_pontuacao = [0, 1, 2, 3, 5, 6, 7, 24, 25, 83, 90, 91];

		if (array_search($idpergunta, $sem_pontuacao) != false) {

			return false;
		}
		else {

			$conn = Banco::connect();
		
			$stmt = $conn->prepare("select * from pontuacao where idcandidato = :idcandidato and idpergunta = :idpergunta");
			$stmt->bindParam(":idcandidato", $idcandidato);
			$stmt->bindParam(":idpergunta", $idpergunta);

			$stmt->execute();

			$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if (count($results) > 0) {
				return false;
			}
			else {

				$conn = Banco::connect();

				$stmt = $conn->prepare("insert into pontuacao (pontuacao, idpergunta, idcandidato) values (:pontuacao, :idpergunta, :idcandidato)");
				$stmt->bindParam(":pontuacao", $pontuacao);
				$stmt->bindParam(":idpergunta", $idpergunta);
				$stmt->bindParam(":idcandidato", $idcandidato);

				$stmt->execute();

				return true;

			}

		}

		

	}

	public function getByPergunta($idpergunta) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from pontuacao where idpergunta = :idpergunta");
		$stmt->bindParam(":idpergunta", $idpergunta);

		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $results;

	}

		public function getByPergunta_respostaUnica($idpergunta) {
			$conn = Banco::connect();

			$stmt = $conn->prepare("select alternativa.idpergunta, resposta.resposta, idcandidato, peso from resposta, alternativa where resposta.idalternativa = alternativa.idalternativa and resposta.idalternativa in (select idalternativa from alternativa where idpergunta = :idpergunta)");
			$stmt->bindParam(":idpergunta", $idpergunta);

			$stmt->execute();

			$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			return $results;
		}

	public function returnPontuacao($pontuacao_total, $pontuacao) {
		$setentaecinto = $pontuacao_total * 0.75;
		$vinteecinco = $pontuacao_total * 0.25;

		if ($pontuacao > $setentaecinto)
			return 2;
		else if (($pontuacao <= $setentaecinto) && ($pontuacao >= $vinteecinco)) {
			return 1;
		}
		else 
			return 0;
	}

	public function returnPontuacao_respostaUnica($resposta, $alternativas) {

		foreach ($alternativas as $key => $value) {	
			
			$value['descricao'] = trim(utf8_encode($value['descricao']));
			$resposta['resposta'] = trim($resposta['resposta']);

			if ($resposta['resposta'] == $value['descricao']) {
				return $value['peso'];
			}
		}
	}



}




?>