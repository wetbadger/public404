<?php

include 'classes/connection.php';

class membership{
	
	private $db;
	
	public function __construct() {
		$this->db = new Connection();
		$this->db = $this->db->dbConnect();
				return $this->db;
	}
	public function Login($name, $pass) {
	
		if(!empty($name) && !empty($pass)) {
			$stmt = $this->db->prepare("SELECT * FROM mods WHERE username = ? AND password = ?");
			$stmt->bindParam(1, $name);
			$stmt->bindParam(2, $pass);
			$stmt->execute();
			
			if($stmt->rowCount() == 1) {
				$_SESSION['status'] = 'authorized';
				header("location: mod.php");
				$_SESSION['username'] = $name;
				return $name;

			}else{
				sleep(3);
				return "Incorrect username or password.";
			}
									   
		}else{
			sleep(3);
			return "You need to put something here.";
		}
	
	}
	
	function confirm_member() {
		session_start();
		if(@$_SESSION['status'] !='authorized') header("location: login.php");
	}
	
	function log_User_Out() {
		setcookie('autologin', NULL);
		setcookie('username', NULL);
		setcookie('password', NULL);
					
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
		}
			
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 10000);
				session_destroy();		  
			}
	}
	
	
	public function register($cname, $cpwd) {
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM mods WHERE username = :username");
		$stmt->bindParam(":username", $cname);
		$stmt->execute();
		$result = $stmt->fetchColumn();


if (preg_match('/[A-Za-z]/', $cname) && preg_match('/[0-9]/', $cname && isset($_POST['cname']))) {
	if ($result != 0) {	
 		return "That username already exists.";
	} else {
		if ($cpwd == $_POST['rpwd']) {
		
		$stmt = $this->db->prepare("INSERT INTO `public404`.`mods` ( `id` , `username` , `password` , `page1` , `page2` , `page3` , `level` ) VALUES (NULL , :username, :password, '', '', '', '3')");
			$stmt->bindParam(":username", $cname);
			$stmt->bindParam(":password", hash('sha1', $cpwd));
			$stmt->execute();
			$_SESSION['status'] = 'authorized';
			$_SESSION['username'] = $_POST['cname'];
			$_SESSION['status'] = 'authorized';
			header("location: mod.php");
			$_SESSION['username'] = $cname;
			return $cname;
			
			} else {
			return "Passwords do not match.";
		} //end if cpwd == rpwd
	} //end if name exists
  } else {
	      return 'Invalid name. (You can only use letters and numbers.)';
  }//end if contains numbs and letts
	}//end register()
	
			public function rememberme($name, $pass) {
					setcookie('autologin', 'yes', 1582498800);
					setcookie('username', $name,  1582498800);
					setcookie('password', $pass,  1582498800);
				}//end remember()
				
			public function forgetme() {
					setcookie('autologin', NULL);
					setcookie('username', NULL);
					setcookie('password', NULL);
				}//end remember()
				
}