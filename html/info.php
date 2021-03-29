<?php include 'classes/connect.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>info.php</title>
</head>

<body>

<center>Info for <a href="http://www.public404.com">public404.com</a></center>

<br />
    <center>State: <?php  //determine if page is frozen
    $stmt = $conn->prepare('SELECT * FROM freeze WHERE page = "#"');
	$stmt->execute();
	$state = $stmt->fetchColumn(2);
	if ($state == 0) {
		echo "Liquid";
	} else {
		echo "Frozen";
	}
	?></center>
    <br />
<center>
<table border="2" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col">Allowed Tags:</th>
    <th scope="col">Mods:</th>
  </tr>
  <tr>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php //get allowed tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = ""');
$stmt->execute();
$allowedtags = $stmt->fetchColumn();
echo htmlspecialchars($allowedtags);
?></div></td>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php
	$stmt = $conn->prepare("SELECT * FROM mods WHERE page1 = '#' OR page2 = '#' OR page3 = '#'");
	$stmt->execute();
	$mod = $stmt->fetchAll();
	foreach ($mod as $var) {
		echo $var['username'];
	}
?></div></td>
  </tr>
  <tr>
    <th scope="col">Strings:</th>
    <th scope="col">Regular Expressions:</th>
  </tr>
  <tr>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php //get str and rpl
$stmt = $conn->prepare('SELECT * FROM bstr WHERE PAGE = "#"');
$stmt->execute();
$strrpl = $stmt->fetchAll();
echo "<table width='300'>";
foreach ($strrpl as $var) {
echo '<tr><td>' . htmlspecialchars(stripslashes($var['str'])) . '</td><td>' . htmlspecialchars(stripslashes($var['rpl'])) . '</td></tr>';
}
echo '</table>';
?></div></td>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php //get str and rpl
$stmt = $conn->prepare('SELECT * FROM bregex WHERE PAGE = "#"');
$stmt->execute();
$strrpl = $stmt->fetchAll();
echo "<table width='300'>";
foreach ($strrpl as $var) {
echo '<tr><td>' . htmlspecialchars(stripslashes($var['regex'])) . '</td><td>' . htmlspecialchars(stripslashes($var['rpl'])) . '</td></tr>';
}
echo '</table>';
?></div></td>
  </tr>
</table>
<p>History:</p>
</center>
<div name="hist" id="xtags4" style="width:585px; margin:auto"><?php
$stmt = $conn->prepare('SELECT * FROM history WHERE PAGE = "#" ORDER BY `history`.`id` DESC');
$stmt->execute();
$history = $stmt->fetchAll();

foreach ($history as $var) {
echo "<p><a href='http://www.public404.com/" . $var['id'] . ".html'>" . $var['timestamp'] . "</a></p>";
}
?> </div>
</body>
</html>
