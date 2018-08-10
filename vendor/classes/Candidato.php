<?php

require_once("DB". DIRECTORY_SEPARATOR ."config_banco.php");

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

}




?>