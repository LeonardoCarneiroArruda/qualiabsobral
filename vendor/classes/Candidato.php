<?php

namespace Classes;

use \Classes\DB\Banco;

class Candidato {

	private $idcandidato;
	private $email;
	private $senha;	
	private $instituicao;

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setInstituicao($instituicao) {
		$this->instituicao = $instituicao;
	}

	public function getinstituicao() {
		return $this->instituicao;
	}

	public function selectAll() {

		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from candidato");

		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $results;
	}

	public function get($idcandidato) {

		$conn = Banco::connect();

		$stmt = $conn->prepare("select * from candidato where idcandidato = :idcandidato");
		$stmt->bindParam(":idcandidato", $idcandidato);

		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $results[0];
	}

}




?>