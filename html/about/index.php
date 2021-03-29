<?php

		//$_SERVER["DOCUMENT_ROOT"] = "/var/chroot/home/content/41/8949141/html";
		    //include $_SERVER["DOCUMENT_ROOT"] . "/classes/connect.php";
				$path = $_SERVER["DOCUMENT_ROOT"];
					 $path .= "/classes/connect.php";
					 require($path);

					 $stmt = $conn->prepare("SELECT state FROM freeze WHERE page = 'about'"); //add this code to allow pages to be banned
 				 $stmt->execute();
 				 $state = $stmt->fetchColumn();

 				 if ($state == 2) {
 					 echo "This page has been banned.";
 					 exit();
 				 }


 $stmt = $conn->prepare("SELECT COUNT( post ) FROM posts WHERE page = 'about' AND post != ''");
	 $stmt->execute();
	 $load = $stmt->fetchColumn();
	 if ($load <= 75) {
		 $offset = $load - 1;
	 } else {
		 $offset = 75;
	 }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>about</title></head>

<body>


  <?php

?>


  <?php
//get allowed global tags
$stmt = $conn->prepare("SELECT tag FROM btag WHERE PAGE = 'global constraints'");
$stmt->execute();
$gtag = $stmt->fetchColumn();

//get global strings
$stmt = $conn->prepare("SELECT str FROM bstr WHERE PAGE = 'global constraints'");
$stmt->execute();
$gstrSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bstr WHERE PAGE = 'global constraints'");
$stmt->execute();
$gstrRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get global regexes
$stmt = $conn->prepare("SELECT regex FROM bregex WHERE PAGE = 'global constraints'");
$stmt->execute();
$gregexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bregex WHERE PAGE = 'global constraints'");
$stmt->execute();
$gregexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get allowed tags
$stmt = $conn->prepare("SELECT tag FROM btag WHERE PAGE = 'about'");
$stmt->execute();
$tag = $stmt->fetchColumn();

//get strings
$stmt = $conn->prepare("SELECT str FROM bstr WHERE PAGE = 'about'");
$stmt->execute();
$strSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bstr WHERE PAGE = 'about'");
$stmt->execute();
$strRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get regexes
$stmt = $conn->prepare("SELECT regex FROM bregex WHERE PAGE = 'about'");
$stmt->execute();
$regexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bregex WHERE PAGE = 'about'");
$stmt->execute();
$regexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// display data
try {
$stmt = $conn->prepare("SELECT * FROM posts WHERE PAGE = 'about' AND post != '' AND timestamp >= (select `posts`.`timestamp` from posts WHERE PAGE = 'about' AND post != '' ORDER by timestamp DESC LIMIT 1 OFFSET :offset) ORDER BY `posts`.`uid` ASC");
$stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($post as $var) {
	if ($var["authorization"] == 7) {
	 print(stripslashes($var["post"]) . "
");//each post on its own line
			 } else {
$global = stripslashes(@preg_replace($gregexSch, $gregexRpl, str_ireplace($gstrSch, $gstrRpl, strip_tags($var["post"], $gtag)))) . "
";
    print(stripslashes(@preg_replace($regexSch, $regexRpl, str_ireplace($strSch, $strRpl, strip_tags($global, $tag))))) . "
";//each post on its own line
			 }
}

} catch(PDOException $e) {
    echo "ERROR: 404"; //. $e->getMessage();
}

?>

</body>
</html>