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


	//CONJUNTO DE FUNCOES QUE RECUPERAM AS QUESTOES E ALTERNATIVAS DO LIMESURVEY E INSEREM NESTA PLATAFORMA
	public function recuperaQuestions() {

		//Estabelecendo conexao com BD do Lime
		$conn2 = new \PDO("mysql:dbname=qualiab;host=localhost", "root", "");

		$stmt = $conn2->prepare("SELECT title, question, relevance from lime_questions where sid = '313781' ");
		
		$results = $stmt->execute();
		
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		for ($i = 0; $i <= count($results); $i++) {
			
			if ($results[$i]['title'][2] === 'Q' ) {

				$codigo = $results[$i]['title'];
				$descricao = utf8_encode($results[$i]['question']);
				$idgrupo_pergunta = $results[$i]['title'][1];

				$this->addQuestions($codigo, $descricao, $idgrupo_pergunta);
			
			}
			else if ($results[$i]['title'][0] === 'Q') {
				$descricao = $results[$i]['question'];
				$idpergunta = $this->returnNumero($results[$i]['title']);
				$peso = $results[$i]['relevance'];
				$codigo = $results[$i]['title'];

				$this->addAlternativa($descricao, $idpergunta, $peso, $codigo);
			}
		}

		
	}

	public function addQuestions($codigo, $descricao, $idgrupo_pergunta) {

		$conn = Banco::connect();

		$stmt = $conn->prepare("INSERT INTO pergunta (descricao, idgrupo_pergunta, codigo) VALUES (:descricao, :idgrupo_pergunta, :codigo)");

		$stmt->bindParam(":descricao", $descricao);
		$stmt->bindParam(":idgrupo_pergunta", $idgrupo_pergunta);
		$stmt->bindParam(":codigo", $codigo);

		$stmt->execute();

	}

	public function addAlternativa($descricao, $idpergunta, $peso, $codigo) {

		$conn = Banco::connect();

		$stmt = $conn->prepare("INSERT INTO alternativa (descricao, peso, idpergunta, codigo) VALUES (:descricao, :peso, :idpergunta, :codigo)");

		$stmt->bindParam(":descricao", $descricao);
		$stmt->bindParam(":peso", $peso);
		$stmt->bindParam(":idpergunta", $idpergunta);
		$stmt->bindParam(":codigo", $codigo);
		
		$stmt->execute();
	}

	public function returnNumero($codigo) {

		if (($codigo[0] === 'Q') && ($codigo[3] === 'A')) {
			$num = $codigo[1] . $codigo[2]; //concatenação entre as posições 1 e 2 da string codigo
			
			return $num;
		}
		else {
			$num = $codigo[1];
		
			return $num;
		}
	}

	//FIM DO CONJUNTO DE FUNCOES

	public function select() {

		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from pergunta");
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $results;

	}


}




?>