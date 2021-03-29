<?php


class mysql {
	private $conn;

	public function dbConnect() {
		return new PDO('mysql:host=localhost;dbname=public404', 'root', '') or 
				die('There was a problem connecting to the database.');
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	function verify_Username_and_Pass($un, $pwd) {

		$query = "SELECT *
				FROM mods
				WHERE username = :username AND password = :password
				LIMIT 1";

		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param(':username', $un);
			$stmt->bind_param(':password', $pwd);
			$stmt->execute();

			if($stmt->fetch()) {
				$stmt->close();
				return true;
			}


		}
	}
}
