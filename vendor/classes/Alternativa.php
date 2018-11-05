<?php

namespace Classes;

use \Classes\DB\Banco;

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

	public function returnPeso($codigo) {

		$conn = Banco::connect();

		$stmt = $conn->prepare("SELECT peso from alternativa where codigo = :codigo");

		$stmt->bindParam(":codigo", $codigo);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC); 

		return $results[0]['peso'];

	}

	public function get($idpergunta) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("SELECT * from alternativa where idpergunta = :idpergunta");

		$stmt->bindParam(":idpergunta", $idpergunta);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC); 

		return $results;

	}

	public function returnIdByCodigo($codigo) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("SELECT idalternativa from alternativa where codigo = :codigo");

		$stmt->bindParam(":codigo", $codigo);
		
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC); 

		return $results[0]['idalternativa'];
	}


}




?>