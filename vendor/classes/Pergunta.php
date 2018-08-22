<?php

namespace Classes;

use \Classes\DB\Banco;

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

	public function recuperaQuestions() {

		//Estabelecendo conexao com BD do Lime
		$conn2 = new \PDO("mysql:dbname=qualiab;host=localhost", "root", "");

		$stmt = $conn2->prepare("SELECT title, question, relevance from lime_questions where sid = '313781' ");
		
		$results = $stmt->execute();
		
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		for ($i = 0; $results[$i]['title'] !== 'G1Q5'; $i++) {
			
			if ($results[$i]['title'][2] === 'Q' ) {

				$codigo = $results[$i]['title'];
				$descricao = utf8_encode($results[$i]['question']);
				$idgrupo_pergunta = $results[$i]['title'][1];

				$this->addQuestions($codigo, $descricao, $idgrupo_pergunta);
			
			}
		}

		
	}

	public function addQuestions($codigo, $descricao, $idgrupo_pergunta) {

		echo $descricao; 

		$conn = Banco::connect();

		$stmt = $conn->prepare("INSERT INTO pergunta (descricao, idgrupo_pergunta, codigo) VALUES (:descricao, :idgrupo_pergunta, :codigo)");

		$stmt->bindParam(":descricao", $descricao);
		$stmt->bindParam(":idgrupo_pergunta", $idgrupo_pergunta);
		$stmt->bindParam(":codigo", $codigo);

		$stmt->execute();

		echo "inseriu";

	}

	public function select() {

		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from pergunta");
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $results;

	}


}




?>