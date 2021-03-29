<?php
class Connection{

	public function dbConnect() {
		return new PDO('mysql:host=localhost;dbname=public404', 'groot', 'Beta2^31-1');
	}

}

?>
