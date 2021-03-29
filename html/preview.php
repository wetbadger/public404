<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>preview.php</title>
</head>

<body>
<?php
 include 'classes/connect.php';

if (!isset($_SESSION['state'])) {
	@session_start();
}

//get allowed tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = :page');
$stmt->bindParam(":page", $_SESSION['page']);
$stmt->execute();
$tag = $stmt->fetchColumn();

if ($tag == NULL) {
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = "global constraints"');
$stmt->execute();
$tag = $stmt->fetchColumn();
}

//get strings
$stmt = $conn->prepare('SELECT str FROM bstr WHERE PAGE = :page');
$stmt->bindParam(":page", $_SESSION['page']);
$stmt->execute();
$strSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare('SELECT rpl FROM bstr WHERE PAGE = :page');
$stmt->bindParam(":page", $_SESSION['page']);
$stmt->execute();
$strRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get regexes
$stmt = $conn->prepare('SELECT regex FROM bregex WHERE PAGE = :page');
$stmt->bindParam(":page", $_SESSION['page']);
$stmt->execute();
$regexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare('SELECT rpl FROM bregex WHERE PAGE = :page');
$stmt->bindParam(":page", $_SESSION['page']);
$stmt->execute();
$regexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

if (isset($_SESSION['preview'])) {
echo stripslashes(@preg_replace($regexSch, $regexRpl, str_ireplace($strSch, $strRpl, strip_tags($_SESSION['preview'], $tag))));
//echo  '<p><input align="bottom" name="submit" type="submit" value="Submit"/></p>';
} else {
	echo "<error/>";
}

?>


</body>
</html>
