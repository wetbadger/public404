  <?php

    include 'classes/connect.php';
//count every 100 views
 $stmt = $conn->prepare('SELECT COUNT( post ) FROM posts WHERE page = "" AND post != ""');
	 $stmt->execute();
	 $load = $stmt->fetchColumn();
	 if ($load <= 75) {
		 $offset = $load - 1;
	 } else {
		 $offset = 75;
	 }
    // execute query, etc



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Public 404</title></head>

<body>

  <?php

?>

<!-- PAGE CONTENT -->

  <?php
//get allowed tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = ""');
$stmt->execute();
$tag = $stmt->fetchColumn();

//get strings
$stmt = $conn->prepare('SELECT str FROM bstr WHERE PAGE = "#"');
$stmt->execute();
$strSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare('SELECT rpl FROM bstr WHERE PAGE = "#"');
$stmt->execute();
$strRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get regexes
$stmt = $conn->prepare('SELECT regex FROM bregex WHERE PAGE = "#"');
$stmt->execute();
$regexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare('SELECT rpl FROM bregex WHERE PAGE = "#"');
$stmt->execute();
$regexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// display data
try {
$stmt = $conn->prepare('SELECT * FROM posts WHERE PAGE = "" AND post != "" AND timestamp >= (select timestamp from posts WHERE PAGE = "" AND post != "" ORDER by timestamp DESC LIMIT 1 OFFSET :offset) ORDER BY `posts`.`uid` ASC');
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($post as $var) {
	if ($var['authorization'] == 7) {
	 print(stripslashes($var['post']) . '
');//each post on it's own line
			 } else {
    print(stripslashes(@preg_replace($regexSch, $regexRpl, str_ireplace($strSch, $strRpl, strip_tags($var['post'], $tag))))) . '
';//each post on it's own line
			 }
}

} catch(PDOException $e) {
    echo 'ERROR: 404'; //. $e->getMessage();
}

?>

</body>
</html>
