<?php
//include 'classes/connect.php';
ini_set('display_errors', 1);

require_once 'classes/membership.php';
$membership = new membership();
$membership->confirm_member();
$conn = $membership->__construct();

//there are 3 levels of mods
/*level I: red
  level II: blue
  level III: green
*/
include 'classes/standardtags.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php
if (isset($_SESSION['username'])) {
$un = $_SESSION['username'];
					}

?>
<title>mod.php</title>



</head>

<body>
<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="63" align="center" scope="col"><a href="about">About</a></td>
    <td width="71" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="94" align="center" scope="col"><a href="secret.php">Secret.php</a></td>
    <td width="54" align="center" scope="col"><?php
	$stmt = $conn->prepare('SELECT unread FROM mail WHERE sendto = :username ORDER BY `mail`.`id` DESC');
	$stmt->bindParam(':username', $_SESSION['username']);
	$stmt->execute();
	$unread = $stmt->fetchColumn();
	if ($unread == 7) {
	echo "<strong><a href='mail.php'>Mail</a></strong>";
	} else {
	echo "<a href='mail.php'>Mail</a>";
	}
	?></td>
  </tr>
</table>   <div style="float:right"><a href="login.php?status=loggedout">Log Out</a></div>
       <hr noshade size=3>

<div>
<p>

  <?php
if(isset($_SESSION['username']))
{
  print "Welcome ".$_SESSION['username']. "!<br>";
}
else
{
  print "Session does not exist";
  exit;
}

//GET PAGE NAMES
$stmt = $conn->prepare("SELECT * FROM mods WHERE username = :username");
$stmt->bindParam(":username", $_SESSION['username']);
$stmt->execute();
$page1 = $stmt->fetchColumn(3);
$stmt->execute();
$page2 = $stmt->fetchColumn(4);
$stmt->execute();
$page3 = $stmt->fetchColumn(5);

if (!isset($_GET['page'])) {
	if ($page1 == '' and $page2 == '') {
		$mod = 5;
	}
	if ($page1 == '' and $page2 != '') {
		$mod = 4;
	} else {
	$mod = 3;
	}
} else {
$mod = $_GET['page'] + 2; //id = 1 2 or 3. disguises column number. possibly i am paranoid. looks better anyways
}//endifelse

$stmt->execute();
$page = $stmt->fetchColumn($mod); //can be column 3 4 or 5
$pagea = $page;

if ($page == '#') {  //pagea becomes the representation for null. page is used to link to the front page. pagea is used to query the front page
	$pagea = '';
}

if ($page == '') { //if somehow the variable in mysql becomes null, the user stil cannot see #
	$pagea = 'not set'; //this relies on the hope that pages cannot have spaces in their names
	$page = 'not set';
}

  if (isset($_GET['nuke'])) {
  if ($_GET['nuke'] == "yes") {
	  $stmt = $conn->prepare("INSERT INTO `public404`.`history` (`page`) VALUES (:page)");
	  $stmt->bindParam(":page", $page);
	  $stmt->execute();
	  //get filename
	  $stmt = $conn->prepare("SELECT * FROM `history` ORDER BY id DESC");
	  $stmt->execute();
	  $history = $stmt->fetchColumn();
	  //echo "filename:" . $history;
	  //get content of histotry file

	//get allowed tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = :page');
$stmt->bindParam(":page", $page);
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

$stmt = $conn->prepare('SELECT * FROM posts WHERE PAGE = :page AND post != "" ORDER BY `posts`.`uid` ASC');
$stmt->bindParam(":page", $pagea);
$stmt->execute();
$post = $stmt->fetchAll(PDO::FETCH_ASSOC);
$content = "";
	foreach ($post as $var) {
		if ($var['authorization'] == 7) {
	 		$content = $content . stripslashes($var['post'] . '
');//each post on it's own line
			 	} else {
    		$content = $content . stripslashes(strip_tags(@preg_replace($regexSch, $regexRpl, str_replace($strSch, $strRpl, strip_tags($var['post'], $tag))))) . '
';//each post on it's own line
			 }
}

	  //write history file
	  if ($page == '#') {
		$fname = $history . ".html";
	  } else {
	    $fname = $pagea . "/" . $history . ".html";
	  }
		$fhandle = fopen($fname, 'x');
		fwrite($fhandle, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>about</title><!-- HTML HEADER --></head>

<body>' . $content . '</body>
</html>');//write the history file
		fclose($fhandle);

	  //delete page
  $stmt3 = $conn->prepare("DELETE FROM `public404`.`posts` WHERE `posts`.`page` = :page");
  $stmt3->bindParam(':page', $pagea);
  $stmt3->execute();
  echo $page . " has been nuked. A snapshot has been written here: <a href='" . $pagea . "/" . $history . ".html'>link</a><br>";
  } elseif ($_GET['nuke'] == "no")
  {
  echo "Nuke was cancelled.<br>";
  }
  }

  $stmt2 = $conn->prepare("SELECT SUM(vote) FROM posts WHERE page = :page AND vote = '2'");
$stmt2->bindParam(':page', $pagea);
$stmt2->execute();
$yes = $stmt2->fetchColumn(0);
$yes = $yes/2; //yes votes are 2. no votes are 1 8 yes votes = a sum of 16. confusing i know but it saves time and space.
//GET NO VOTE
if (!isset($yes)) {
	$yes = 0;
}

$stmt2 = $conn->prepare("SELECT SUM(vote) FROM posts WHERE page = :page AND vote = '1'");
$stmt2->bindParam(':page', $pagea);
$stmt2->execute();
$no = $stmt2->fetchColumn(0);

if (!isset($no)) {
	$no = 0;
}

  ?>
 <script type="text/javascript" />
 <!--
  function nuke()
{
var yes=<?php echo $yes ?>;
var no=<?php echo $no ?>;
if (yes>=no && yes!=0) {
var r=confirm("Are you sure you want to nuke '<?php echo $page; ?>'?\n\n      (All data will be erased)");
if (r==true)
  {
  window.location = "?nuke=yes&page=<?php echo ($mod - 2); ?>"
  }
else
  {
  window.location = "?nuke=no&page=<?php echo ($mod - 2); ?>"
  }
} else {
	alert('There are not enough yes votes');
}
}

function del1()
{
var r=confirm("Are you sure you want to delete '<?php echo $page1; ?>' from your mod list?\n\n      (If you do not send yourself an invitation this page cannot be recovered in the future!)");
if (r==true)
  {
  window.location = "?page1=delete&page=<?php echo ($mod - 2); ?>"
  }
else
  {
  window.location = "?page1=cancel&page=<?php echo ($mod - 2); ?>"
  }
}

function del2()
{
var r=confirm("Are you sure you want to delete '<?php echo $page2; ?>' from your mod list?\n\n      (If you do not send yourself an invitation this page cannot be recovered in the future!)");
if (r==true)
  {
  window.location = "?page2=delete&page=<?php echo ($mod - 2); ?>"
  }
else
  {
  window.location = "?page2=cancel&page=<?php echo ($mod - 2); ?>"
  }
}

function del3()
{
var r=confirm("Are you sure you want to delete '<?php echo $page3; ?>' from your mod list?\n\n      (If you do not send yourself an invitation this page cannot be recovered in the future!)");
if (r==true)
  {
  window.location = "?page3=delete&page=<?php echo ($mod - 2); ?>"
  }
else
  {
  window.location = "?page3=cancel&page=<?php echo ($mod - 2); ?>"
  }
}
-->
</script>

</p>
</div>
<?php
if ($page1 != "" || $page2 != "" || $page3 != "") {
echo '<center>Info for <a href="' . $page . '">' . $page . '</a></center>';
} else {
echo '<center>You do not currently mod any pages</center>';
}

?>
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col"><p> Submissions</p>
    <!--sort by date v-->
    <p><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:300px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php


$stmt = $conn->prepare('SELECT * FROM posts WHERE PAGE = :page AND post != "" ORDER BY `posts`.`uid` ASC');
$stmt->bindParam(':page', $pagea);
$stmt->execute();
$post = $stmt->fetchAll(PDO::FETCH_ASSOC);
// display data
foreach ($post as $var) {
	echo '<a href="remove.php?id=' . $var['id'] . '">[remove]</a>';
    print(htmlspecialchars(stripslashes($var['post']))) . ' <br />';//each post on it's own line
}

?></div></p></th>
    <th rowspan="2" scope="col"><p> Tags</p>
    <p>
      <div name="xtags4" id="xtags4" style="overflow-y:scroll; width:300px; height:300px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><form action="mod.php<?php echo "?page=" . ($mod - 2); ?>" method="POST" name="tags"><div style="position:absolute; left: 512px; top: 180px;"><input name="tags" type="submit" value="Submit" id='submit'/></div><?php

//get allowed tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = :page');
$stmt->bindparam(":page", $pagea);
$stmt->execute();
$allowedtags = $stmt->fetchColumn();

//get all tags
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = "!@#$%"');
$stmt->execute();
$stringtag = $stmt->fetchColumn();
//$arraytag = explode("
//", $stringtag); //string is now an array
$arraytag = explode("
", $standardtags); //string is now an array

//select or deselect?
if (isset($_GET['select'])) {
	if ($_GET['select'] == 'none' or $allowedtags == "") {
		echo '<a href="?page=' . ($mod - 2) . '&select=all">Select all</a>
';
	} else {
		echo '<a href="?page=' . ($mod - 2) . '&select=none">Deselect all</a>
';
}
} else {
	echo '<a href="?page=' . ($mod - 2) . '&select=all">Select all</a>
';
}

foreach ($arraytag as $var) {

if(strpos($allowedtags, $var, 0) !== false) {
 // var NOT found in allowedtags
$checked = 'checked="checked"';
}
else {
$checked = NULL;
 // var found in allowedtags
}
	if (@$_GET['select'] == 'all') {
			echo "<input name='" . $var . "' type='checkbox' value='" . $var . "' checked='checked'/>" . htmlspecialchars($var) . "<br>";
		} else if (@$_GET['select'] == 'none') {
			echo "<input name='" . $var . "' type='checkbox' value='" . $var . "'/>" . htmlspecialchars($var) . "<br>";
			} else {
    		echo "<input name='" . $var . "' type='checkbox' value='" . $var . "' " . $checked . "/>" . htmlspecialchars($var) . "<br>";
		}
}
if (isset($_POST['tags'])) {
	//create a new string indexing the checked boxes
	$newtags = implode("",$_POST); //$_post returns array
		if (strpos($newtags, "Submit") !== false) { //don't modify the database if page is refreshed. newtags won't contain submit
			$newtags = str_replace("Submit", "", $newtags);//newtags is a string of selected tags
			//echo htmlspecialchars($newtags);
			$stmt = $conn->prepare("UPDATE `public404`.`btag` SET `tag` = :newtags WHERE `btag`.`page` = :page");
			$stmt->bindParam(":newtags", $newtags);
			$stmt->bindParam(":page", $pagea);
			$stmt->execute();
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
    		exit;
	}
}
?></form></div>
    </p></th>
    <th rowspan="2" scope="col"><p> Strings</p>
    <p>
      <div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:300px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><form action="mod.php<?php echo "?page=" . ($mod - 2); ?>" method="POST" name="string"><table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <?php
	if ($page != 'not set') {
		echo '<th scope="col"><div style="position:relative; left: 5px; top: 25px; width:62px"><input name="string" type="submit" value="Submit" id="submit"/></div></th>
    <th scope="col">String</th>
    <th scope="col">Replace</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="str" type="text" /></td>
    <td><input name="rpl" type="text" /></td>';
	}
	?>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?php
//get str and rpl
$stmt = $conn->prepare('SELECT * FROM bstr WHERE PAGE = :page');
$stmt->bindparam(":page", $page); //page cant be blank
$stmt->execute();
$strrpl = $stmt->fetchAll();
foreach ($strrpl as $var) {
echo '<tr><td><a href="remove.php?sid=' . $var['id'] . '&p=' . ($mod - 2) . '">[remove]</a></td><td>' . htmlspecialchars(stripslashes($var['str'])) . '</td><td>' . stripslashes(htmlspecialchars($var['rpl'])) . '</td></tr>';
}
echo '</table>';

if (isset($_POST['string'])) {
	$string = $_POST['str'];
	$replace = $_POST['rpl'];
		//check for duplicates
		$stmt = $conn->prepare('SELECT COUNT( str ) FROM bstr WHERE PAGE = :page AND str = :string');
		$stmt->bindparam(":page", $page); //page cant be blank
		$stmt->bindParam(":string", $string);
		$stmt->execute();
		$dupstr = $stmt->fetchColumn();
			if ($dupstr == 0) {
			$stmt = $conn->prepare("INSERT INTO `public404`.`bstr` (page, str, rpl) VALUES (:page, :string, :replace)");
			$stmt->bindParam(":string", $string);
			$stmt->bindParam(":replace", $replace);
			$stmt->bindParam(":page", $page);
			$stmt->execute();
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
    		exit;
			}
	}
?></form></div>
    </p></th>
    <th rowspan="2" scope="col"><p> Regular Expressions</p>
    <p>
      <div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:300px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><form action="mod.php<?php echo "?page=" . ($mod - 2); ?>" method="POST" name="string"><table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <?php if ($page != 'not set') {
		echo '<th scope="col"><div style="position:relative; left: 5px; top: 25px; width:62px"><input name="regularexpression" type="submit" value="Submit" id="submit"/></div></th>
    <th scope="col">Pattern</th>
    <th scope="col">Replace</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="regex" type="text" /></td>
    <td><input name="regrpl" type="text" /></td>';
	}
	?>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?php
//get str and rpl
$stmt = $conn->prepare('SELECT * FROM bregex WHERE PAGE = :page');
$stmt->bindparam(":page", $page); //page cant be blank
$stmt->execute();
$strrpl = $stmt->fetchAll();
foreach ($strrpl as $var) {
echo '<tr><td><a href="remove.php?rid=' . $var['id'] . '&p=' . ($mod - 2) . '">[remove]</a></td><td>' . htmlspecialchars($var['regex']) . '</td><td>' . htmlspecialchars($var['rpl']) . '</td></tr>';
}
echo '</table>';

if (isset($_POST['regularexpression'])) {
	$pattern = $_POST['regex'];
	$replace = $_POST['regrpl'];
		//check for duplicates
		$stmt = $conn->prepare('SELECT COUNT( regex ) FROM bregex WHERE PAGE = :page AND regex = :pattern');
		$stmt->bindparam(":page", $page); //page cant be blank
		$stmt->bindParam(":pattern", $pattern);
		$stmt->execute();
		$dupstr = $stmt->fetchColumn();
			if ($dupstr == 0) {
			$stmt = $conn->prepare("INSERT INTO `public404`.`bregex` (page, regex, rpl) VALUES (:page, :pattern, :replace)");
			$stmt->bindParam(":pattern", $pattern);
			$stmt->bindParam(":replace", $replace);
			$stmt->bindParam(":page", $page);
			$stmt->execute();
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
    		exit;
			}
	}
?></form></div><?php
?></form></div>
    </p></th>
  </tr>

</table>

<!--Freeze/Unfreeze-->
<!--Block/Allow Outside links-->

<table width="152" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="148"><a href="#"><?php

	if (isset($_GET['state'])) { //if user has clicked freeze or unfreeze

		$stmt = $conn->prepare("SELECT COUNT(*) FROM freeze WHERE `freeze`.`page` = :pagea");
		$stmt->bindParam(':pagea', $page);
		$stmt->execute();
		$result = $stmt->fetchColumn();

		$state = $_GET['state'];

		if ($result == '0') {
		$stmt = $conn->prepare('INSERT INTO `public404`.`freeze` (`id` , `page` , `state`) VALUES (NULL , :pagea, :state)');
		$stmt->bindParam(":pagea", $page);
		$stmt->bindParam(":state", $state);
		$stmt->execute();
		} else { $stmt = $conn->prepare('UPDATE `public404`.`freeze` SET `state` = :state WHERE `freeze`.`page` = :pagea');
		$stmt->bindParam(":pagea", $page);
		$stmt->bindParam(":state", $state);
		$stmt->execute();
		}
	}

	try { //determine if page is frozen
    $stmt = $conn->prepare('SELECT * FROM freeze WHERE page = :page');
	$stmt->bindParam(":page", $page);
	$stmt->execute();
	$state = $stmt->fetchColumn(2);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

if ($state == '1') {
	echo '<a href="?page=' . ($mod - 2) . '&state=0">Unfreeze Page</a>'; } else {
		echo '<a href="?page=' . ($mod - 2) . '&state=1">Freeze Page</a>'; }

?></a></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th width="684"><!-- OTIONAL PAGE NAME -->
<?php
if ($page1 != "" || $page2 != "" || $page3 != "") {
echo '<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="650" align="left" scope="col">You have permission to modify the following pages:</td>
  </tr>
    <tr>
    <td width="650" align="left" scope="col">  <p>
      </p>';
	  	if ($page1 != "") {
      			echo '<p><a href="?page=1">' . $page1 . '</a>    <a href="?page1=confirm&page=' . ($mod - 2) . '">[delete]</a>      </p>';
		}
		if ($page2 != "") {
      			echo '<p><a href="?page=2">' . $page2 . '</a>    <a href="?page2=confirm&page=' . ($mod - 2) . '">[delete]</a>        </p>';
		}
		if ($page3 != "") {
      			echo '<p><a href="?page=3">' . $page3 . '</a>    <a href="?page3=confirm&page=' . ($mod - 2) . '">[delete]</a>       </p>';
		}
      echo '<p> </p></td>
  </tr>
</table></th>';
} else {
	echo 'You do not currently mod any pages.</table></th>';
}

//remove pages from mod list
if (@$_GET['page1'] == 'confirm') {
	echo '<script type="text/javascript">del1();</script>';
}
if (@$_GET['page1'] == 'delete') {
	$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page1` = '' WHERE `mods`.`username` = :username");
	$stmt->bindParam(":username", $_SESSION['username']);
	$stmt->execute();
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
}
if (@$_GET['page2'] == 'confirm') {
	echo '<script type="text/javascript">del2();</script>';
}
if (@$_GET['page2'] == 'delete') {
	$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page2` = '' WHERE `mods`.`username` = :username");
	$stmt->bindParam(":username", $_SESSION['username']);
	$stmt->execute();
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
}
if (@$_GET['page3'] == 'confirm') {
	echo '<script type="text/javascript">del3();</script>';
}
if (@$_GET['page3'] == 'delete') {
	$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page3` = '' WHERE `mods`.`username` = :username");
	$stmt->bindParam(":username", $_SESSION['username']);
	$stmt->execute();
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . ($mod - 2) . '">';
}

//display nuke info
if ($page != 'not set') {
echo '<th width="105" scope="col"><!-- VOTE TO NUKE -->
<table width="77" border="1">
  <tr valign="top">
    <td width="69" align="left">Nuke:</td>
  </tr>
  <tr>
    <td align="left" valign="top"><label>
    Yes ' . $yes . '</label>
  </tr>
  <tr>
    <td align="left" valign="top"><label>No ' . $no . '</label>
  </tr>
    <tr valign="top">
    <td align="center">
    <input name="nuke" type="button" value="Nuke" onClick="javascript:nuke();" />
  </tr>
</table>
</table>';
}
?>

       <hr noshade size=3>




<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="63" align="center" scope="col"><a href="about">About</a></td>
    <td width="71" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="94" align="center" scope="col"><a href="secret.php">Secret.php</a></td>
    <td width="54" align="center" scope="col"><?php
	$stmt = $conn->prepare('SELECT unread FROM mail WHERE sendto = :username ORDER BY `mail`.`id` DESC');
	$stmt->bindParam(':username', $_SESSION['username']);
	$stmt->execute();
	$unread = $stmt->fetchColumn();
	if ($unread == 7) {
	echo "<strong><a href='mail.php'>Mail</a></strong>";
	} else {
	echo "<a href='mail.php'>Mail</a>";
	}
	?></td>
  </tr>
</table>

</body>
</html>
