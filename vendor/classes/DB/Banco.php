<?php

namespace Classes\DB;

class Banco {

	const HOSTNAME = "localhost";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "qualiabsobral";

	public static function connect() {

		$conn = new \PDO("mysql:dbname=".Banco::DBNAME.";host=".Banco::HOSTNAME, Banco::USERNAME, Banco::PASSWORD);
		//$conn->exec("set names utf8");
		return $conn;
	}


}



?>