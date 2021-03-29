<?php
error_reporting(0);
//ini_set("display_errors", 1);

$ipaddress = $_SERVER['REMOTE_ADDR'];

if (isset($_POST['remember'])) {
		if(isset($_COOKIE['remember']) && $_COOKIE['remember'] == 'checked') { //set cookie for remember checkbox
		$_COOKIE['remember'] = 'yes'; //dont set cookie again
		$_COOKIE['pagename'] = $_POST['page'];
		} else if (isset($_COOKIE['remember']) && $_COOKIE['remember'] == 'unchecked') {
			$_COOKIE['remember'] = NULL;
			$_COOKIE['pagename'] = $_POST['page'];
		} else {
		$_COOKIE['remember'] = 'checked';
		}
} else { //when page is refreshed
	$_COOKIE['remember'] = 'unchecked';
	if (isset($_POST['page'])) {
	$_COOKIE['pagename'] = NULL;
	}
}
	if (isset($_COOKIE['pagename'])) {
	$cookie = $_COOKIE['pagename'];
	} else {
		$cookie = NULL;
	}
$remember = $_COOKIE['remember'];
setcookie('pagename', $cookie);
setcookie('remember', $remember);

@session_start();

if (!isset($_SESSION['status'])) {

$_SESSION['status'] = 'unknown';

}

if (isset($_SESSION['i']) && $_SESSION['i'] == 'pass') {
	$_SESSION['i'] = NULL;
} else {
$_SESSION['page'] = NULL;
$_SESSION['preview'] = NULL;
$_SESSION['loc'] = NULL;
$_SESSION['i'] = NULL;
}

$cc = NULL;

//$_SERVER["DOCUMENT_ROOT"] = "/var/chroot/home/content/41/8949141/html";
    //include $_SERVER["DOCUMENT_ROOT"] . "/classes/connect.php";
		$path = $_SERVER["DOCUMENT_ROOT"];
			 $path .= "/classes/connect.php";
			 require($path);
	require($_SERVER["DOCUMENT_ROOT"] . "/functions.php");

 ?>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=1024" /><title>about/secret.php</title></head>

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
      lay.style.display = 'block';
    }
  }
}

function preview()
{
   // This will take the text entered in the text box and assign it to the preview placeholder area
   document.getElementById('preview_text').innerHTML = document.send.post.value;
}
 -->
</script>

<body>
<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="79" align="center" scope="col"><a href="http://www.public404.com/about">About</a></td>
    <td width="79" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="79" align="center" scope="col"><?php if (!isset($_SESSION['status']) or $_SESSION['status'] != 'authorized') { echo'<a href="http://www.public404.com/login.php">Log in</a>'; } else { echo '<a href="http://www.public404.com/mod.php">Mod</a>'; }?></td>
  </tr>
</table>
       <hr noshade size=3>
  <!-- WELCOME MESSAGE -->

<h2>about/secret.php</h2>
<p>Congratulations, you have found the secret page. From here you may add content to <a href="http://www.public404.com/about">about: </a><!--SERVER SENSITIVE-->
  <!-- HTML FORM -->
</p>
<form action="secret.php" method="POST" name="send">
  <!-- TEXT BOX W/ 3000bit limit -->
  <table border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td><textarea name="post" cols="100" rows="22"><?php if (isset($_SESSION['preview'])) { echo stripslashes($_SESSION['preview']); } ?></textarea></td>
    <td><!-- warnings --><div id="ad"></div><!-- warnings --></td>
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
      <input type="radio" name="loc" value="-1" <?php if (isset($_SESSION['loc']) && $_SESSION['loc'] == '-1') { echo 'checked="checked"'; }?>/>
      top</label></td>
  </tr>
    <tr>
    <td><label>
      <input type="radio" name="loc" value="0" <?php if (isset($_SESSION['loc']) && $_SESSION['loc'] == '0') { echo 'checked="checked"'; }?>/>
      middle</label></td>
  </tr>
  <tr>
    <td><label>
      <input name="loc" type="radio" value="1" <?php if (!isset($_SESSION['loc']) || $_SESSION['loc'] == '1') { echo 'checked="checked"'; }?>/>
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
		if (isset($_COOKIE['pagename'])) {
		echo $_COOKIE['pagename'];
		} elseif (isset($_SESSION['page'])) {
		echo $_SESSION['page'];
		} ?>" maxlength="255">
      </p>
</td>
<tr>
<td height="24" valign="top">
      <p>
          <input name="remember" type="checkbox" id="remember" value="remember" <?php if (isset($_COOKIE['remember']) && $_COOKIE['remember'] == 'checked') {
			  echo 'checked="checked"';
			  } else {
				if (isset($_COOKIE['pagename'])) {
				echo 'checked="checked"';
		} else {
			  if ($_COOKIE['remember'] == 'unchecked') {
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
if (isset($_POST['preview'])) {
	if (!isset($_SESSION['state'])) {
			@session_start();
			$_SESSION['state'] = 'preview';
			$_SESSION['preview'] = $_POST['post'];
			$_SESSION['page'] = $_POST['page'];
			$_SESSION['loc'] = $_POST['loc'];
						 } else {
			$_SESSION['preview'] = $_POST['post'];
			$_SESSION['page'] = $_POST['page'];
			$_SESSION['loc'] = $_POST['loc'];
						 }

			//always
			$_SESSION['i'] = 'pass';


			echo "<script>

		newWin = window.open ('preview.php', 'newwindow', config='height=400, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no')

		if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
		{
			var separator = (window.location.href.indexOf(\"?\")===-1)?\"?\":\"&\";
		window.location.href = window.location.href + separator + \"popup_blocked=true\";
		    //document.getElementById('preview_text').innerHTML = 'Your browser blocked the pop-up window! <br> Please enable pop-ups for this page. <br> (Clicking repeatedly sometimes works too.)';
		}

		</script>
		<META HTTP-EQUIV='Refresh' Content='0'>";
		}

		?>

		 <input name="submit" type="submit" value="Submit" id='submit'/>
		</form><!-- END FORM -->
		<div id="preview_text"></div>

   <?php

   try { //define $id
    $stmt = $conn->prepare('SELECT id FROM posts ORDER BY id DESC');
	$stmt->execute();
	$id = $stmt->fetchColumn(0);
//print_r($id);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$authorization = 0;

try {
if (isset($_SESSION['username'])) {
	//GET PAGE NAMES AND AUTHENTICATE
	$stmt = $conn->prepare("SELECT * FROM mods WHERE username = :username");
	$stmt->bindParam(":username", $_SESSION['username']);
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
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

if (!empty($_POST['page']) && isset($_POST['submit']) && $_POST['page'] != "") { //unique pages, whether new or old, can get rewritten each time someone submits one. this should be in place if new index rules have been imposed
try {
$page = preg_replace("/[^\w]+/", "", $_POST["page"]); //this var gets reused lower down
$q = "'";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$pagepage = "about/" . $page;
$qpage = "'" . $pagepage . "'";

try {
if (isset($_SESSION['username'])) {
	//GET PAGE NAMES AND AUTHENTICATE
	$stmt = $conn->prepare("SELECT * FROM mods WHERE username = :username");
	$stmt->bindParam(":username", $_SESSION['username']);
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
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

try { //determine if page is frozen

    $stmt = $conn->prepare('SELECT * FROM freeze WHERE page = :page');
	$stmt->bindParam(":page", $pagepage);
	$stmt->execute();
	$state = $stmt->fetchColumn(2);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

try {
//determine if page is new
		$stmt = $conn->prepare("SELECT COUNT(*) FROM posts WHERE `posts`.`page` = :page");
		$stmt->bindParam(':page', $pagepage);
		$stmt->execute();
		$result = $stmt->fetchColumn();
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
		if ($result == 0) {
if (empty($_POST['post'])) {
				 echo "You cannot start a page with nothing on it. <!-- ";
				 $cc = "-->";
				 } else {

if (!empty($_POST['page'])) {
if ($state < 1 or $authorization == 7) { //if page is not frozen or session is authorized

$creation = new creation();

try {

$creation->create_new_page($page, $qpage, $q, $pagepage);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

} //end if post is blank
} //end if page is new

		//the following block of code adds a page to a mods list if they are logged in and have created a unique page
		if (isset($_SESSION['status']) and $_SESSION['status'] == 'authorized') {

		$stmt = $conn->prepare("SELECT * FROM `mods` WHERE username = :name");
		$stmt->bindParam(':name', $_SESSION['username']);
		$stmt->execute();
		$page1 = $stmt->fetchColumn(3);
        $stmt->execute();
        $page2 = $stmt->fetchColumn(4);
		$stmt->execute();
		$page3 = $stmt->fetchColumn(5);

		  if ($result == 0) {	//a result of 0 means the page does not exist.


//check each page owned by the mod

				if ($page1 == '') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page1` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $pagepage);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					echo $pagepage . " was added your mod list. You can mod 2 more pages. <br />";
				} else if ($page2 == '') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page2` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $pagepage);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					echo $pagepage . " was added your mod list. You can mod 1 more page. <br />";
				} else if ($page3 == '') {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page3` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $pagepage);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					echo $pagepage . " was added your mod list. You cannot mod any more pages. <br />";
				} //end if $page3

		  }//end if result is 0

		} else if (isset($page1) and in_array($page, array( '1' => $page1, '2' => $page2, '3' => $page3 ))) { //mod is already modding page
										 } else {
										 	if ($_SESSION['status'] == 'authorized' and $pagepage != '') {
			echo "You cannot mod " . $pagepage . "<br />"; //if for some other reason the page cant be modded. (owned by someone else or too many pages)
														  } //if not logged in dont echo anything else
		} //end if else you cannot mod
}//end if page is not frozen
}//end if page is authorized
}

if(!isset($state)) { //make sure state is set
	try { //determine if page is frozen
		$namevar = "about";
	  $stmt = $conn->prepare('SELECT * FROM freeze WHERE page = :page');
		$stmt->bindParam(":page", $namevar);
		$stmt->execute();
		$state = $stmt->fetchColumn(2);

	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
			$state = 1; //in case state cannot be determined, assume frozen
	}
}

/*   if(!isset($_POST['page'])) { //if page is not set assume front page
					$_POST['page'] = "";
					}
*/
   if(!isset($_POST['vote'])) {
					$_POST['vote'] = 0; //0 indicates no vote
					}




if (isset($_POST['submit']) && isset($_POST['post']) && $cc != "-->") { //prevents sumbmissions on page refresh (or causes firefox resend menu to drop) //the first if isset was for page this is for post. also stops page from being listed in database without being created.
if (!isset($page)) { //redundant
	$page = '';
	$pagepage = "about";
}
$stmt = $conn->prepare('SELECT timestamp FROM posts WHERE PAGE = :page AND ipv4 = :ipaddress ORDER by timestamp DESC');
$stmt->bindParam(':page' , $pagepage);
$stmt->bindParam(':ipaddress' , $ipaddress);
$stmt->execute();
$ts = $stmt->fetchColumn();
$ts = strtotime($ts);
if (!empty($ts) and $ts > (time() - 60)) { //if latest post by ip on page was less than 10 minutes ago
echo "You must wait " . ($ts - (time() - 60)) . " seconds before posting on this page again.";
	} else {
if ($state < '1' || $authorization == 7) {
try {
//fill table with row of data when user presses submit
	$sql = "INSERT INTO posts (post, loc, page, uid, vote, authorization, ipv4) values ( :post, :loc, :page, :uid, :vote, :authorization, :ip)";
	$stmt = $conn->prepare($sql);
	$uid = $_POST['loc'] * $id; //except in the case of simultaeous uploads, uid will typically be (id-1) * +-1.
 //because I hate arrays...
	$stmt->bindParam(':post', $_POST['post']);
	$stmt->bindParam(':loc', $_POST['loc']);
	$stmt->bindParam(':page', $pagepage);
	$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
	$stmt->bindParam(':vote', $_POST['vote']);
 	$stmt->bindParam(':authorization', $authorization);
	$stmt->bindParam(':ip', $ipaddress);
	$stmt->execute();
       if ($page == '') {
		   echo "Your post was submitted to <a href='http://www.public404.com/about'>about</a>"; // !!!!! SERVER SENSITIVE !!!!!
	   } else {
     echo "Your post was submitted to <a href='" . $page . "'>about/" . $page . "</a> ";
	 }
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}//end catch
} else {
	 	if ($state == 1)
			echo "That page is currently frozen.";
		else
			echo "That page has been banned.";
	}
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM btag WHERE `btag`.`page` = :page");
$stmt->bindParam(':page', $page);
$stmt->execute();
$result2 = $stmt->fetchColumn();

//set up allowed tags
if ($result2 == 0) { //if page is new
$stmt = $conn->prepare('SELECT tag FROM btag WHERE PAGE = "about"');
$stmt->execute();
$standardtags = $stmt->fetchColumn();

$sql = "INSERT INTO btag (page, tag) values ( :page, :tag )";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":page", $pagepage);
$stmt->bindParam(":tag", $standardtags);
$stmt->execute();
}

}
echo $cc;

	?>

       <hr noshade size=3>




<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="79" align="center" scope="col"><a href="http://www.public404.com/about">About</a></td>
    <td width="79" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="79" align="center" scope="col"><?php if (!isset($_SESSION['status']) or $_SESSION['status'] != 'authorized') { echo'<a href="http://www.public404.com/login.php">Log in</a>'; } else { echo '<a href="http://www.public404.com/mod.php">Mod</a>'; }?></td>
  </tr>
</table>
<!-- ABOUT PAGE -->

<!-- MOD APPLICATION -->

<!-- DONATION CODE -->

<!-- SUCCESS / FAILURE STATEMENT -->
<!-- Script -->
<script>
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const popupblocked = urlParams.get("popup_blocked");
if (popupblocked) {
	//"Your browser blocked the pop-up window! <br> Please enable pop-ups for this page. <br> (Clicking repeatedly sometimes works too.)""
	document.getElementById("preview_text").innerHTML =  '<iframe name="preview" width="800px" height="500px"></iframe>';
	//const up = "../";
	//const count = (mainStr.split("/").length - 1);
	//alert(count);
	window.open("/preview.php", "preview");
}
</script>
</body>
