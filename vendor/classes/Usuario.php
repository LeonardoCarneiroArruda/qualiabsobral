<?php

namespace Classes;

use \Classes\DB\Banco;

class Usuario {

	private $idusuario;
	private $nome;
	private $email;
	private $senha;	
	private $admin;

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

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

	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public static function login($email, $senha) {

		$conn = Banco::connect();
		
		$stmt = $conn->prepare("SELECT * FROM usuario WHERE email = :email and senha = :senha");

		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":senha", $senha);

		$results = $stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if (count($results) == 0) {
			throw new \Exception("USUARIO OU SENHA INCORRETOS!", 1);
			return false;
		}

		return true;

	}

	public static function returnNomePorEmail($email) {
		$conn = Banco::connect();

		$stmt = $conn->prepare("select nome from usuario WHERE email = :email");

		$stmt->bindParam(":email", $email);

		$result = $stmt->execute();

		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $result[0]['nome'];
	}

	public static function checkLogin() {

		if (!(isset($_SESSION['nome']) && isset($_SESSION['email']) && isset($_SESSION['senha'])) 
			|| ($_SESSION['nome'] == "")
			|| ($_SESSION['email'] == "")
			|| ($_SESSION['senha'] == "")) {

			header("Location: /qualiabsobral/");
			exit;
		} 

	}

}




?>