<?php

class creation {

	public function create_new_page($page, $qpage, $q) {
		//echo '<script>alert("Welcome to Geeks for Geeks")</script>';

		@mkdir($page, 0777); //0777 i forgot what that means...
        $fname = $page . "/index.php";
		$fhandle = fopen($fname, 'w') or die("There was an error."); //fopen also creates and overwrites files
		fwrite($fhandle, '<?php

//$_SERVER["DOCUMENT_ROOT"] = "/var/chroot/home/content/41/8949141/html";
    //include $_SERVER["DOCUMENT_ROOT"] . "/classes/connect.php";
		$path = $_SERVER["DOCUMENT_ROOT"];
			 $path .= "/public404(D)/classes/connect.php";
			 require($path);


 $stmt = $conn->prepare("SELECT COUNT( post ) FROM posts WHERE page = ' . $qpage . ' AND post != ' . $q . $q . '");
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
<title>' . $page . '</title></head>

<body>


  <?php

?>

  <?php
//get allowed global tags
$stmt = $conn->prepare("SELECT tag FROM btag WHERE PAGE = ' . $q . 'global constraints' . $q . '");
$stmt->execute();
$gtag = $stmt->fetchColumn();

//get global strings
$stmt = $conn->prepare("SELECT str FROM bstr WHERE PAGE = ' . $q . 'global constraints' . $q . '");
$stmt->execute();
$gstrSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bstr WHERE PAGE = ' . $q . 'global constraints' . $q . '");
$stmt->execute();
$gstrRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get global regexes
$stmt = $conn->prepare("SELECT regex FROM bregex WHERE PAGE = ' . $q . 'global constraints' . $q . '");
$stmt->execute();
$gregexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bregex WHERE PAGE = ' . $q . 'global constraints' . $q . '");
$stmt->execute();
$gregexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get allowed tags
$stmt = $conn->prepare("SELECT tag FROM btag WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$tag = $stmt->fetchColumn();

//get strings
$stmt = $conn->prepare("SELECT str FROM bstr WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$strSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bstr WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$strRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

//get regexes
$stmt = $conn->prepare("SELECT regex FROM bregex WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$regexSch = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
$stmt = $conn->prepare("SELECT rpl FROM bregex WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$regexRpl = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// display data
try {
$stmt = $conn->prepare("SELECT * FROM posts WHERE PAGE = ' . $qpage . ' AND post != ' . $q . $q .' AND timestamp >= (select `posts`.`timestamp` from posts WHERE PAGE = ' . $qpage . ' AND post != ' . $q . $q .' ORDER by timestamp DESC LIMIT 1 OFFSET :offset) ORDER BY `posts`.`uid` ASC");
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
</html>');//write the index file
		fclose($fhandle);
		$fname = $page . "/info.php";
		$fhandle = fopen($fname, 'w') or die("can't open file"); //fopen also creates and overwrites files
		fwrite($fhandle, '<?php $path = $_SERVER["DOCUMENT_ROOT"];
		   $path .= "/public404(D)/classes/connect.php";
		   require($path);
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>' . $page . '/info.php</title>
</head>

<body>

<center>Info for <a href="http://www.thepublic404.com/' . $page . '">' . $page .  '</a></center>

<br />
    <center>State: <?php  //determine if page is frozen
    $stmt = $conn->prepare("SELECT * FROM freeze WHERE page = ' . $qpage . '");
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
$stmt = $conn->prepare("SELECT tag FROM btag WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$allowedtags = $stmt->fetchColumn();
echo htmlspecialchars($allowedtags);
?></div></td>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php
	$stmt = $conn->prepare("SELECT * FROM mods WHERE page1 = ' . $qpage . ' OR page2 = ' . $qpage . ' OR page3 = ' . $qpage . '");
	$stmt->execute();
	$mod = $stmt->fetchAll();
	foreach ($mod as $var) {
		echo $var["username"] . "
";
	}
?></div></td>
  </tr>
  <tr>
    <th scope="col">Strings:</th>
    <th scope="col">Regular Expressions:</th>
  </tr>
  <tr>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php //get str and rpl
$stmt = $conn->prepare("SELECT * FROM bstr WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$strrpl = $stmt->fetchAll();
echo "<table width='. $q .'300'. $q .'>";
foreach ($strrpl as $var) {
echo "<tr><td>" . htmlspecialchars(stripslashes($var['. $q .'str'. $q .'])) . "</td><td>" . htmlspecialchars(stripslashes($var['. $q .'rpl'. $q .'])) . "</td></tr>";
}
echo "</table>";
?></div></td>
    <td><div name="xtags4" id="xtags4" style="overflow:auto; width:300px; height:185px; border-style:solid; border-width:thin; border-color:#999; white-space:pre; font-family:monospace; font-weight:normal;" align="left"><?php //get str and rpl
$stmt = $conn->prepare("SELECT * FROM bregex WHERE PAGE = ' . $qpage . '");
$stmt->execute();
$strrpl = $stmt->fetchAll();
echo "<table width='. $q .'300'. $q .'>";
foreach ($strrpl as $var) {
echo "<tr><td>" . htmlspecialchars(stripslashes($var['. $q .'regex'. $q .'])) . '. $q .'</td><td>'. $q .' . htmlspecialchars(stripslashes($var['. $q .'rpl'. $q .'])) . "</td></tr>";
}
echo "</table>";
?></div></td>
  </tr>
</table>
<p>History:</p>
</center>
<div name="hist" id="xtags4" style="width:585px; margin:auto"><?php
$stmt = $conn->prepare("SELECT * FROM history WHERE PAGE = ' . $qpage . ' ORDER BY `history`.`id` DESC");
$stmt->execute();
$history = $stmt->fetchAll();

foreach ($history as $var) {
echo "<p><a href='. $q .'http://www.thepublic404.com/' . $page . '/" . $var['. $q .'id'. $q .'] . ".html'. $q .'>" . $var['. $q .'timestamp'. $q .'] . "</a></p>";
}
?> </div>
</body>
</html>');//write the info file
		fclose($fhandle);

	/*

		@mkdir($page, 0777); //0777 i forgot what that means...
        $fname = $page . "/secret.php";
		$fhandle = fopen($fname, 'w') or die("There was an error."); //fopen also creates and overwrites files
		fwrite($fhandle, '<?php
error_reporting(0);

$ipaddress = $_SERVER['. $q .'REMOTE_ADDR'. $q .'];

if (isset($_POST['. $q .'remember'. $q .'])) {
		if(isset($_COOKIE['. $q .'remember'. $q .']) && $_COOKIE['. $q .'remember'. $q .'] == '. $q .'checked'. $q .') { //set cookie for remember checkbox
		$_COOKIE['. $q .'remember'. $q .'] = '. $q .'yes'. $q .'; //dont set cookie again
		$_COOKIE['. $q .'pagename'. $q .'] = $_POST['. $q .'page'. $q .'];
		} else if (isset($_COOKIE['. $q .'remember'. $q .']) && $_COOKIE['. $q .'remember'. $q .'] == '. $q .'unchecked'. $q .') {
			$_COOKIE[' . $q . 'remember' . $q . '] = NULL;
			$_COOKIE[' . $q . 'pagename' . $q . '] = $_POST[' . $q . 'page' . $q . '];
		} else {
		$_COOKIE[' . $q . 'remember' . $q . '] = ' . $q . 'checked' . $q . ';
		}
} else { //when page is refreshed
	$_COOKIE[' . $q . 'remember' . $q . '] = ' . $q . 'unchecked' . $q . ';
	if (isset($_POST[' . $q . 'page' . $q . '])) {
	$_COOKIE[' . $q . 'pagename' . $q . '] = NULL;
	}
}
	if (isset($_COOKIE['. $q .'pagename'. $q .'])) {
	$cookie = $_COOKIE['. $q .'pagename'. $q .'];
	} else {
		$cookie = NULL;
	}
$remember = $_COOKIE['  . $q .  'remember'  . $q .  '];
setcookie('  . $q .  'pagename'  . $q .  ', $cookie);
setcookie('  . $q .  'remember'  . $q .  ', $remember);

@session_start();

if (!isset($_SESSION['  . $q .  'status'  . $q .  '])) {

$_SESSION['  . $q .  'status'  . $q .  '] = '  . $q .  'unknown'  . $q .  ';

}

if (isset($_SESSION['  . $q .  'i'  . $q .  ']) && $_SESSION['  . $q .  'i'  . $q .  '] == '  . $q .  'pass'  . $q .  ') {
	$_SESSION['  . $q .  'i'  . $q .  '] = NULL;
} else {
$_SESSION['  . $q .  'page'  . $q .  '] = NULL;
$_SESSION['  . $q .  'preview'  . $q .  '] = NULL;
$_SESSION['  . $q .  'loc'  . $q .  '] = NULL;
$_SESSION['  . $q .  'i'  . $q .  '] = NULL;
}

$_SERVER["DOCUMENT_ROOT"] = "/var/chroot/home/content/41/8949141/html";
    include $_SERVER["DOCUMENT_ROOT"] . "/classes/connect.php";
	include $_SERVER["DOCUMENT_ROOT"] . "functions.php";

 ?>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=1024" /><title>secret.php</title></head>

<script language="javascript">
<!--
// This function checks if the place holder exists and set to hidden, if so changes it to display information in text box

function show_lay()
{
  if(document.getElementById)
  {
    var lay = document.getElementById("preview_text");
    if( lay.style.display = "none")
    {
      lay.style.display = '  . $q .  'block'  . $q .  ';
    }
  }
}

function preview()
{
   // This will take the text entered in the text box and assign it to the preview placeholder area
   document.getElementById('  . $q .  'preview_text'  . $q .  ').innerHTML = document.send.post.value;
}
 -->
</script>

<body>
<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="79" align="center" scope="col"><a href="about">About</a></td>
    <td width="79" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="79" align="center" scope="col"><?php if (!isset($_SESSION['  . $q .  'status'  . $q .  ']) or $_SESSION['  . $q .  'status'  . $q .  '] != '  . $q .  'authorized'  . $q .  ') { echo'  . $q .  '<a href="login.php">Log in</a>'  . $q .  '; } else { echo '  . $q .  '<a href="mod.php">Mod</a>'  . $q .  '; }?></td>
  </tr>
</table>
       <hr noshade size=3>
  <!-- WELCOME MESSAGE -->

<h2>secret.php</h2>
<p>Congratulations, you have found the secret page. From here you may add content to <a href="http://www.thepublic404.com">the website. </a><!--SERVER SENSITIVE-->
  <!-- HTML FORM -->
</p>
<form action="secret.php" method="POST" name="send">
  <!-- TEXT BOX W/ 3000bit limit -->
  <table border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td><textarea name="post" cols="100" rows="22"><?php if (isset($_SESSION['  . $q .  'preview'  . $q .  '])) { echo stripslashes($_SESSION['  . $q .  'preview'  . $q .  ']); } ?></textarea></td>
    <td><!-- warnings --><div id="preview_text"></div><!-- warnings --></td>
  </tr>
</table>


<table width="541" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <th width="134" valign="top" scope="col"><!-- TOP / BOTTOM -->
<table width="136" height="91">
  <tr>
    <td width="128">Location</td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="loc" value="-1" <?php if (isset($_SESSION['  . $q .  'loc'  . $q .  ']) && $_SESSION['  . $q .  'loc'  . $q .  '] == '  . $q .  '-1'  . $q .  ') { echo '  . $q .  'checked="checked"'  . $q .  '; }?>/>
      top</label></td>
  </tr>
    <tr>
    <td><label>
      <input type="radio" name="loc" value="0" <?php if (isset($_SESSION['  . $q .  'loc'  . $q .  ']) && $_SESSION['  . $q .  'loc'  . $q .  '] == '  . $q .  '0'  . $q .  ') { echo '  . $q .  'checked="checked"'  . $q .  '; }?>/>
      middle</label></td>
  </tr>
  <tr>
    <td><label>
      <input name="loc" type="radio" value="1" <?php if (!isset($_SESSION['  . $q .  'loc'  . $q .  ']) || $_SESSION['  . $q .  'loc'  . $q .  '] == '  . $q .  '1'  . $q .  ') { echo '  . $q .  'checked="checked"'  . $q .  '; }?>/>
      bottom</label></td>
  </tr>
</table></th>
    <th width="232" valign="top" scope="col"><!-- OPTIONAL PAGE NAME -->

<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="178" scope="col">Optional pagename</td>
  </tr>
    <tr>
    <td width="178" valign="top" scope="col">(ex. cats)</td>
  </tr>
  <tr>
    <td valign="top">
      <p>
        <input name="page" type="text" value="<?php
		if (isset($_COOKIE['  . $q .  'pagename'  . $q .  '])) {
		echo $_COOKIE['  . $q .  'pagename'  . $q .  '];
		} elseif (isset($_SESSION['  . $q .  'page'  . $q .  '])) {
		echo $_SESSION['  . $q .  'page'  . $q .  '];
		} ?>" maxlength="255">
      </p>
</td>
<tr>
<td height="24" valign="top">
      <p>
          <input name="remember" type="checkbox" id="remember" value="remember" <?php if (isset($_COOKIE['  . $q .  'remember'  . $q .  ']) && $_COOKIE['  . $q .  'remember'  . $q .  '] == '  . $q .  'checked'  . $q .  ') {
			  echo '  . $q .  'checked="checked"'  . $q .  ';
			  } else {
				if (isset($_COOKIE['  . $q .  'pagename'  . $q .  '])) {
				echo '  . $q .  'checked="checked"'  . $q .  ';
		} else {
			  if ($_COOKIE['  . $q .  'remember'  . $q .  '] == '  . $q .  'unchecked'  . $q .  ') {
			  //do nothing
			} else {
				$err = "There was an unexpected error with the cookie.";
			}
		}
	}

?>>

      Remember this page.</p>
      </td>
  </tr>
</table></th>
    <th width="165" valign="top" scope="col"><!-- VOTE TO NUKE -->
<table width="105">
  <tr>
    <td width="97">Vote to nuke?</td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="vote" value="2"/>
      yes</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="vote" value="1"/>
      no</label></td>
  </tr>
</table></th>
  </tr>
</table>



<input name="preview" type="submit" value="Preview" /> <!-- onClick="preview();show_lay(); -->

<?php
if (isset($_POST['  . $q .  'preview'  . $q .  '])) {
	if (!isset($_SESSION['  . $q .  'state'  . $q .  '])) {
			@session_start();
			$_SESSION['  . $q .  'state'  . $q .  '] = '  . $q .  'preview'  . $q .  ';
			$_SESSION['  . $q .  'preview'  . $q .  '] = $_POST['  . $q .  'post'  . $q .  '];
			$_SESSION['  . $q .  'page'  . $q .  '] = $_POST['  . $q .  'page'  . $q .  '];
			$_SESSION['  . $q .  'loc'  . $q .  '] = $_POST['  . $q .  'loc'  . $q .  '];
						 } else {
			$_SESSION['  . $q .  'preview'  . $q .  '] = $_POST['  . $q .  'post'  . $q .  '];
			$_SESSION['  . $q .  'page'  . $q .  '] = $_POST['  . $q .  'page'  . $q .  '];
			$_SESSION['  . $q .  'loc'  . $q .  '] = $_POST['  . $q .  'loc'  . $q .  '];
						 }

			//always
			$_SESSION['  . $q .  'i'  . $q .  '] = '  . $q .  'pass'  . $q .  ';


	echo "<SCRIPT LANGUAGE='  . $q .  'javascript'  . $q .  '>
<!--
window.open ('  . $q .  'preview.php'  . $q .  ', '  . $q .  'newwindow'  . $q .  ', config='  . $q .  'height=400, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no'  . $q .  ')
-->
</SCRIPT>
<META HTTP-EQUIV='  . $q .  'Refresh'  . $q .  ' Content='  . $q .  '0'  . $q .  '>";
}

?>

 <input name="submit" type="submit" value="Submit" id='  . $q .  'submit'  . $q .  '/>
</form><!-- END FORM -->

   <?php

   try { //define $id
    $stmt = $conn->prepare('  . $q .  'SELECT id FROM posts ORDER BY id DESC'  . $q .  ');
	$stmt->execute();
	$id = $stmt->fetchColumn(0);
//print_r($id);

} catch(PDOException $e) {
    echo '  . $q .  'ERROR: '  . $q .  ' . $e->getMessage();
}
$page = '  . $q . $q .  ';

if (isset($_POST['  . $q .  'page'  . $q .  ']) && isset($_POST['  . $q .  'submit'  . $q .  '])) { //unique pages, whether new or old, can get rewritten each time someone submits one. this should be in place if new index rules have been imposed

$page = preg_replace("/[^\w]+/", '  . $q . $q .  ', $_POST['  . $q .  'page'  . $q .  ']); //this var gets reused lower down
$qpage = "'  . $q .  '" . $page . "'  . $q .  '";
$q = "'  . $q .  '";
$authorization = 0;



if (isset($_SESSION['  . $q .  'username'  . $q .  '])) {
	//GET PAGE NAMES AND AUTHENTICATE
	$stmt = $conn->prepare("SELECT * FROM mods WHERE username = :username");
	$stmt->bindParam(":username", $_SESSION['  . $q .  'username'  . $q .  ']);
	$stmt->execute();
	$page1 = $stmt->fetchColumn(3);
	$stmt->execute();
	$page2 = $stmt->fetchColumn(4);
	$stmt->execute();
	$page3 = $stmt->fetchColumn(5);

	if ($page1 == $page or $page2 == $page or $page3 == $page) {
		$authorization = 7;
		} else {
		$authorization = 0;
	}
} //end get user info

try { //determine if page is frozen

    $stmt = $conn->prepare('  . $q .  'SELECT * FROM freeze WHERE page = :page'  . $q .  ');
	$stmt->bindParam(":page", $page);
	$stmt->execute();
	$state = $stmt->fetchColumn(2);

} catch(PDOException $e) {
    echo '  . $q .  'ERROR: '  . $q .  ' . $e->getMessage();
}
//determine if page is new
		$stmt = $conn->prepare("SELECT COUNT(*) FROM posts WHERE `posts`.`page` = :page");
		$stmt->bindParam('  . $q .  ':page'  . $q .  ', $page);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if ($result == 0) {
if (empty($_POST['  . $q .  'post'  . $q .  '])) {
				 echo "You cannot start a page with nothing on it. <!-- ";
				 $cc = "-->";
				 } else {

if (!empty($_POST['  . $q .  'page'  . $q .  '])) {
if ($state != 1 or $authorization == 7) { //if page is not frozen or session is authorized

$creation = new creation();

try {

$creation->create_new_page($page, $qpage, $q);

} catch(PDOException $e) {
    echo '  . $q .  'ERROR: '  . $q .  ' . $e->getMessage();
}

} //end if post is blank
} //end if page is new

		//the following block of code adds a page to a mods list if they are logged in and have created a unique page
		if (isset($_SESSION['  . $q .  'status'  . $q .  ']) and $_SESSION['  . $q .  'status'  . $q .  '] == '  . $q .  'authorized'  . $q .  ') {

		$stmt = $conn->prepare("SELECT * FROM `mods` WHERE username = :name");
		$stmt->bindParam('  . $q .  ':name'  . $q .  ', $_SESSION['  . $q .  'username'  . $q .  ']);
		$stmt->execute();
		$page1 = $stmt->fetchColumn(3);
        $stmt->execute();
        $page2 = $stmt->fetchColumn(4);
		$stmt->execute();
		$page3 = $stmt->fetchColumn(5);

		  if ($result == 0) {	//a result of 0 means the page does not exist.


//check each page owned by the mod

				if ($page1 == '  . $q . $q .  ') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page1` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam('  . $q .  ':page'  . $q .  ', $page);
					$stmt->bindParam('  . $q .  ':name'  . $q .  ', $_SESSION['  . $q .  'username'  . $q .  ']);
					$stmt->execute();
					echo $page . " was added your mod list. You can mod 2 more pages. <br />";
				} else if ($page2 == '  . $q . $q .  ') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page2` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam('  . $q .  ':page'  . $q .  ', $page);
					$stmt->bindParam('  . $q .  ':name'  . $q .  ', $_SESSION['  . $q .  'username'  . $q .  ']);
					$stmt->execute();
					echo $page . " was added your mod list. You can mod 1 more page. <br />";
				} else if ($page3 == '  . $q . $q .  ') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page3` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam('  . $q .  ':page'  . $q .  ', $page);
					$stmt->bindParam('  . $q .  ':name'  . $q .  ', $_SESSION['  . $q .  'username'  . $q .  ']);
					$stmt->execute();
					echo $page . " was added your mod list. You cannot mod any more pages. <br />";
				} //end if $page3

		  }//end if result is 0

		} else if (isset($page1) and in_array($page, array( '  . $q .  '1'  . $q .  ' => $page1, '  . $q .  '2'  . $q .  ' => $page2, '  . $q .  '3'  . $q .  ' => $page3 ))) { //mod is already modding page
										 } else {
										 	if ($_SESSION['  . $q .  'status'  . $q .  '] == '  . $q .  'authorized'  . $q .  ' and $page != '  . $q . $q .  ') {
			echo "You cannot mod " . $page . "<br />"; //if for some other reason the page cant be modded. (owned by someone else or too many pages)
														  } //if not logged in dont echo anything else
		} //end if else you cannot mod
}//end if page is not frozen
}//end if page is authorized
}

   if(!isset($_POST['  . $q .  'page'  . $q .  '])) { //if page is not set assume front page
					$_POST['  . $q .  'page'  . $q .  '] = "";
					}
   if(!isset($_POST['  . $q .  'vote'  . $q .  '])) {
					$_POST['  . $q .  'vote'  . $q .  '] = 0; //0 indicates no vote
					}




if (isset($_POST['  . $q .  'submit'  . $q .  ']) && isset($_POST['  . $q .  'post'  . $q .  ']) && $cc != "-->") { //prevents sumbmissions on page refresh (or causes firefox resend menu to drop) //the first if isset was for page this is for post. also stops page from being listed in database without being created.
if (!isset($page)) {
	$page = '  . $q . $q .  ';
}
$stmt = $conn->prepare('  . $q .  'SELECT timestamp FROM posts WHERE PAGE = :page AND ipv4 = :ipaddress ORDER by timestamp DESC'  . $q .  ');
$stmt->bindParam('  . $q .  ':page'  . $q .  ' , $page);
$stmt->bindParam('  . $q .  ':ipaddress'  . $q .  ' , preg_replace('  . $q .  '/[.]/'  . $q .  ', '  . $q . $q .  ', $ipaddress));
$stmt->execute();
$ts = $stmt->fetchColumn();
$ts = strtotime($ts);
if (!empty($ts) and $ts > (time() - 60)) { //if latest post by ip on page was less than 10 minutes ago
echo "You must wait " . ($ts - (time() - 60)) . " seconds before posting on this page again.";
	} else {
if ($state != '  . $q .  '1'  . $q .  ' || $authorization == 7) {
try {
//fill table with row of data when user presses submit
	$sql = "INSERT INTO posts (post, loc, page, uid, vote, authorization, ipv4) values ( :post, :loc, :page, :uid, :vote, :authorization, :ip)";
	$stmt = $conn->prepare($sql);
	$uid = $_POST['  . $q .  'loc'  . $q .  '] * $id; //except in the case of simultaeous uploads, uid will typically be (id-1) * +-1.
 //because I hate arrays...
	$stmt->bindParam('  . $q .  ':post'  . $q .  ', $_POST['  . $q .  'post'  . $q .  ']);
	$stmt->bindParam('  . $q .  ':loc'  . $q .  ', $_POST['  . $q .  'loc'  . $q .  ']);
	$stmt->bindParam('  . $q .  ':page'  . $q .  ', $page);
	$stmt->bindParam('  . $q .  ':uid'  . $q .  ', $uid, PDO::PARAM_INT);
	$stmt->bindParam('  . $q .  ':vote'  . $q .  ', $_POST['  . $q .  'vote'  . $q .  ']);
 	$stmt->bindParam('  . $q .  ':authorization'  . $q .  ', $authorization);
	$stmt->bindParam('  . $q .  ':ip'  . $q .  ', preg_replace('  . $q .  '/[.]/'  . $q .  ', '  . $q .  $q .  ', $ipaddress));
	$stmt->execute();
       if ($page == "") {
		   echo "Your post was submitted to <a href='  . $q .  'http://www.thepublic404.com'  . $q .  '>the main page.</a>"; // !!!!! SERVER SENSITIVE !!!!!
	   } else {
     echo "Your post was submitted to <a href='  . $q .  '" . $page . "'  . $q .  '>" . $page . "</a> ";
	 }
} catch(PDOException $e) {
  echo '  . $q .  'Error: '  . $q .  ' . $e->getMessage();
}//end catch
} else { echo "That page is currently frozen."; } }

//set up allowed tags
if ($result == 0) { //if page is new
$stmt = $conn->prepare('  . $q .  'SELECT tag FROM btag WHERE PAGE = "!@#$%"'  . $q .  ');
$stmt->execute();
$standardtags = $stmt->fetchColumn();

$sql = "INSERT INTO btag (page, tag) values ( :page, :tag )";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":page", $page);
$stmt->bindParam(":tag", $standardtags);
$stmt->execute();
}

}
echo $cc;

	?>

       <hr noshade size=3>




<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="79" align="center" scope="col"><a href="about">About</a></td>
    <td width="79" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="79" align="center" scope="col"><?php if (!isset($_SESSION['  . $q .  'status'  . $q .  ']) or $_SESSION['  . $q .  'status'  . $q .  '] != '  . $q .  'authorized'  . $q .  ') { echo'  . $q .  '<a href="login.php">Log in</a>'  . $q .  '; } else { echo '  . $q .  '<a href="mod.php">Mod</a>'  . $q .  '; }?></td>
  </tr>
</table>
<!-- ABOUT PAGE -->

<!-- MOD APPLICATION -->

<!-- DONATION CODE -->

<!-- SUCCESS / FAILURE STATEMENT -->
</body>');
		fclose($fhandle); */

	} //end write


}
        ?>
