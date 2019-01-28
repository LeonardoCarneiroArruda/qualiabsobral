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

	public function retornaDadosGraficoQuestao24() {
		$conn = Banco::connect();

		$stmt = $conn->prepare("(SELECT * from resposta where idalternativa in (select idalternativa from alternativa where codigo = 'Q24A1'))");
		$stmt2 = $conn->prepare("(SELECT * from resposta where idalternativa in (select idalternativa from alternativa where codigo = 'Q24A3'))");

		$stmt->execute();
		$stmt2->execute();

		$resultsSIM1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$resultsSIM2 = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

		$sim = 0;
		$nao = 0;
		for ($i = 0; $i < count($resultsSIM1); $i++) {
			if ($resultsSIM1[$i]["resposta"] == "Sim") {
				$sim++;
			}
			else {
				for ($j = 0; $j < count($resultsSIM2); $j++) {
					if ($resultsSIM1[$i]["idcandidato"] == $resultsSIM2[$j]["idcandidato"]) {
						$resultsSIM2[$j]["resposta"] == "Sim" ? $sim++ : $nao++;
					}
				}
			}
		}

		return ["sim" => $sim, "nao" => $nao];
	}

	public function retornaDadosGraficoQuestao25() {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from resposta where idalternativa in (select idalternativa from alternativa where codigo = 'Q25A1')");
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$sim = 0; 
		$nao = 0;
		for ($i = 0; $i < count($results); $i++) {
			if ($results[$i]["resposta"] == "Sim")
				$sim++;
			else 
				$nao++;
		}

		return ["sim" => $sim, "nao" => $nao];
		
	}

	public function retornaDadosGraficoQuestao39() {
		$conn = Banco::connect();

		$stmt = $conn->prepare("SELECT * from resposta where idalternativa in (SELECT idalternativa FROM alternativa WHERE idpergunta = 39)");
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$sim = 0; 
		$nao = 0;
		$naoPossuiDados = 0;
		$naoAplica = 0;
		for ($i = 0; $i < count($results); $i++) {
			if ($results[$i]["resposta"][0] == "1")
				$sim++;
			else if($results[$i]["resposta"][0] == "2")
				$nao++;
			else if ($results[$i]["resposta"][0] == "3")
				$naoPossuiDados++;
			else if ($results["resposta"][0] == "4")
				$naoAplica++;
		}

		return ["sim" => $sim, "nao" => $nao, "naoPossuiDados" => $naoPossuiDados, "naoAplica" => $naoAplica];
	}

	public function retornaDadosGraficoQuestao5() {
		
		$especialidades = array(
						"Oftalmologia" => 0,
						"Otorrinolaringologia" => 0,
						"Ortopedia" => 0,
						"Gastroenterologia" => 0,
						"Cardiologia" => 0,
						"Neurologia" => 0,
						"Psiquiatria" => 0,
						"Geriatria" => 0,
						"Fisioterapia" => 0,
						"Psicologia" => 0,
						"Ginecologia e Obstetricia" => 0
						);

		$naoAplica = 0;
		foreach ($especialidades as $key => $value) {
			$especialidades[$key] = $this->calculaMediasGrafico5($key);
		}
		
		return $especialidades;

	}

	public function calculaMediasGrafico5($especialidade) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select r.resposta, a.idalternativa, a.descricao from resposta as r, alternativa as a where r.idalternativa = a.idalternativa and a.idpergunta = 5 and a.descricao = :especialidade");

		$stmt->bindParam(":especialidade", $especialidade);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$media = 0;
		$naoAplica = 0;
		for ($i = 0; $i < count($results); $i++) {
			if (strstr($results[$i]["resposta"], "1") && strstr($results[$i]["resposta"], "ano")) {
				$media = $media + 12;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "1")) {
				$media++;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "2")) {
				$media = $media + 2;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "4")) {
				$media = $media + 4;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "6")) {
				$media = $media + 6;
				continue;
			}
			else {
				$naoAplica++;
			}

		}
		//var_dump($results);
		//var_dump($media);

		$media = $media / (count($results) - $naoAplica);
		return [$media, $naoAplica];
	}

	public function retornaDadosGraficoQuestao6() {
		
		$exames = array(
						"Ressonancia Magnetica" => 0,
						"Tomografia Computadorizada" => 0,
						"Ultrassonografia" => 0,
						"Raio X" => 0,
						"Mamografia" => 0
						);

		foreach ($exames as $key => $value) {
			$exames[$key] = $this->calculaMediasGrafico6($key);
		}

		return $exames;

	}


	public function calculaMediasGrafico6($exames) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select r.resposta, a.idalternativa, a.descricao from resposta as r, alternativa as a where r.idalternativa = a.idalternativa and a.idpergunta = 6 and a.descricao = :exames");
		$stmt->bindParam(":exames", $exames);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		$media = 0;
		$naoAplica = 0;
		for ($i = 0; $i < count($results); $i++) {
			if (strstr($results[$i]["resposta"], "1") && strstr($results[$i]["resposta"], "ano")) {
				$media = $media + 12;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "1")) {
				$media++;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "2")) {
				$media = $media + 2;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "4")) {
				$media = $media + 4;
				continue;
			}
			else if (strstr($results[$i]["resposta"], "6")) {
				$media = $media + 6;
				continue;
			}
			else {
				$naoAplica++;
			}

		}
		//var_dump($results);
		//var_dump($media);
		$media = $media / (count($results) - $naoAplica);
		return $media;
	}

	public function retornaListaDeQuestoesRespondidasPorCand($idcandidato) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select alternativa.idpergunta as pergunta from resposta, alternativa where resposta.idcandidato = :idcandidato and resposta.idalternativa = alternativa.idalternativa GROUP by alternativa.idpergunta");

		$stmt->bindParam(":idcandidato", $idcandidato);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $results;
	}

}




?>