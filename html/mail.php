<?php
//include 'classes/connect.php';

require_once 'classes/membership.php';
$membership = new membership();
$membership->confirm_member();
$conn = $membership->__construct();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
if (isset($_SESSION['username'])) {
$un = $_SESSION['username'];
					}
$alert = "";


?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>mail.php</title>
</head>

<body><table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="68" align="center" scope="col"><a href="about">About</a></td>
    <td width="75" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="91" align="center" scope="col"><a href="secret.php">Secret.php</a></td>
    <td width="62" align="center" scope="col"><a href="mod.php">Mod</a></td>
    

  </tr>
</table>    <div style="float:right"><a href="login.php?status=loggedout">Log Out</a></div>
       <hr noshade size=3>
<div>
<form action="mail.php" method="post" name="send">
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>To:</td>
    <td><input name="to" type="text" /></td>
  </tr>
  <tr>
    <td>Subject:</td>
    <td><input name="subject" type="text" /></td>
  </tr>
  <tr>
    <td valign="top">Message: </td>
    <td><textarea name="message" cols="50" rows="10"></textarea></td>
  </tr>
</table>

<br />
<input name="send" type="submit" value="Send" />
<?php
if (isset($_POST['send'])) {
	
	$to = $_POST['to'];
	$from = $_SESSION['username'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	//validate username
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `mods`
WHERE username = :username");
$stmt->bindParam(":username", $_POST['to']);
$stmt->execute();
$result = $stmt->fetchColumn();

if ($result == 0) {
	$alert = '<br>That username is not valid';
} else {
	
try {	
	$sql = "INSERT INTO mail (sendto, sentfrom, subject, message, invite, unread) values ( :to, :from, :subject, :message, '0', '7')";
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(':to', $to);
	$stmt->bindParam(':from', $from);
	$stmt->bindParam(':subject', $subject);
	$stmt->bindParam(':message', $message); 
	$stmt->execute();
	$alert = "<br>Message sent to " . $to;
	} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
}
?>
<input name="invite" type="submit" value="Invite" />
<?php
if (isset($_POST['invite'])) {
	
	$to = $_POST['to'];
	$from = $_SESSION['username'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	//validate page
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `mods`
WHERE page1 = :page1 AND username = :username
OR page2 = :page2 AND username = :username
OR page3 = :page3 AND username = :username");
$stmt->bindParam(":username", $_SESSION['username']);
$stmt->bindParam(':page1', $subject);
$stmt->bindParam(':page2', $subject);
$stmt->bindParam(':page3', $subject);
$stmt->execute();
$result2 = $stmt->fetchColumn();

//validate username
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `mods`
WHERE username = :username");
$stmt->bindParam(":username", $_POST['to']);
$stmt->execute();
$result = $stmt->fetchColumn();

if ($result2 == 0 or $result == 0) {
	$alert = '<br>The subject or username is not valid for invitation.';
} else {
	//validate username
	
try {	
	$sql = "INSERT INTO mail (sendto, sentfrom, subject, message, invite, unread) values ( :to, :from, :subject, :message, '7', '7')";
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(':to', $to);
	$stmt->bindParam(':from', $from);
	$stmt->bindParam(':subject', $subject);
	$stmt->bindParam(':message', $message); 
	$stmt->execute();
	$alert = "<br>You invited " . $to . " to " . $subject;
	} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
}
?>
</form>


</div>
<?php echo $alert; ?>
<div>
<p>
<form action="mail.php" method="post">
  <?php 
if(isset($_SESSION['username']))
{
  echo "Mailbox for " . $_SESSION['username'] . ": ";
  if (isset($_GET['view']) && $_GET['view'] == 'inbox') {
  echo "<a href='?view=sent'>(view sent)</a><br><br>";
  } elseif (isset($_GET['view']) && $_GET['view'] == 'sent') {
	  echo "<a href='?view=inbox'>(view inbox)</a><br><br>";
  } else {
	   echo "<a href='?view=sent'>(view sent)</a><br><br>";
  }
}
else
{
  print "Session does not exist";
  exit;
}

$stmt = $conn->prepare('SELECT * FROM mail WHERE sendto = :username OR sentfrom = :username ORDER BY `mail`.`id` DESC');
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$mail = $stmt->fetchAll();

if (!isset($_GET['view']) or $_GET['view'] == 'inbox') {
	foreach ($mail as $var) {
		if ($var['sentfrom'] != $_SESSION['username']) {
			if ($var['unread'] == 7) {
				echo "<hr WIDTH='160px' ALIGN='LEFT'>";
		echo "<strong>" . $var['sentfrom'] . " <br>" . stripslashes(htmlspecialchars($var['subject'])) . ": <br>" . stripslashes(htmlspecialchars($var['message'])) . "</strong>";
		if ($var['invite'] == 7) {
			echo '<br>Invitation: <input name="accept' . $var['subject'] . '" type="submit" value="Accept" /><input name="reject' . $var['subject'] . '" type="submit" value="Reject" /><br>';
		}
		echo "<hr WIDTH='160px' ALIGN='LEFT'>";
		$sql = "UPDATE `public404`.`mail` SET `unread` = '0' WHERE `mail`.`id` = :id";
		$stmt = $conn->prepare($sql); 
		$stmt->bindParam(':id', $var['id']);
		$stmt->execute();
			} else {
				echo "<hr WIDTH='160px' ALIGN='LEFT'>";
				echo $var['sentfrom'] . " <br>" . stripslashes(htmlspecialchars($var['subject'])) . ": <br>" . stripslashes(htmlspecialchars($var['message']));
					if ($var['invite'] == 7) {
			echo '<br>Invitation: <input name="accept' . $var['subject'] . '" type="submit" value="Accept" /><input name="reject' . $var['subject'] . '" type="submit" value="Reject" />';
		}
					if ($var['invite'] == 1) {
						echo "<br>You accepted this invitation.";
					}
					if ($var['invite'] == 2) {
						echo "<br>You rejected this invitation.";
					}
			}
		}
	}
}  elseif ($_GET['view'] == 'sent') {
		foreach ($mail as $var) {
		if ($var['sentfrom'] == $_SESSION['username']) {
			echo "<hr WIDTH='160px' ALIGN='LEFT'>";
		echo $var['sendto'] . " <br>" . stripslashes(htmlspecialchars($var['subject'])) . ": <br>" . stripslashes(htmlspecialchars($var['message']));
		}
	}
}

	$stmt = $conn->prepare("SELECT * FROM `mods` WHERE username = :name");
		$stmt->bindParam(':name', $_SESSION['username']);
		$stmt->execute();
		$page1 = $stmt->fetchColumn(3);
        $stmt->execute();
        $page2 = $stmt->fetchColumn(4);
		$stmt->execute();
		$page3 = $stmt->fetchColumn(5);
				
foreach ($mail as $var) {
	$page = $var['subject'];
	$index = 'accept' . $page;
	$indexa = 'reject' . $page;
	
		if (isset($_POST[$index])) {
			
			if ($page1 == '' && $page1 != $page) {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page1` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $page);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					$sql = "UPDATE `public404`.`mail` SET `invite` = '1' WHERE `mail`.`subject` = :page";
					$stmt = $conn->prepare($sql); 
					$stmt->bindParam(":page", $page);
					$stmt->execute();
					echo  "<script>alert('" . $page . " was added your mod list. You can mod 2 more pages.');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mail.php">';
				} else if ($page2 == '' && $page2 != $page) {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page2` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $page);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					$sql = "UPDATE `public404`.`mail` SET `invite` = '1' WHERE `mail`.`subject` = :page";
					$stmt = $conn->prepare($sql); 
					$stmt->bindParam(":page", $page);
					$stmt->execute();
					echo "<script>alert('" . $page . " was added your mod list. You can mod 1 more page.');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mail.php">';
				} else if ($page3 == '' && $page3 != $page) {
					$stmt = $conn->prepare("UPDATE `public404`.`mods` SET `page3` = :page WHERE `mods`.`username` = :name");
					$stmt->bindParam(':page', $page);
					$stmt->bindParam(':name', $_SESSION['username']);
					$stmt->execute();
					$sql = "UPDATE `public404`.`mail` SET `invite` = '1' WHERE `mail`.`subject` = :page";
					$stmt = $conn->prepare($sql); 
					$stmt->bindParam(":page", $page);
					$stmt->execute();
					echo  "<script>alert('" . $page . " was added your mod list. You cannot mod any more pages.');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mail.php">';
				} else {
					echo "<script>alert('Either you already mod the max number of pages, or there was an error.');</script>";
				} //end if $page3
		}
		if (isset($_POST[$indexa])) {
					$sql = "UPDATE `public404`.`mail` SET `invite` = '2' WHERE `mail`.`subject` = :page";
					$stmt = $conn->prepare($sql); 
					$stmt->bindParam(":page", $page);
					$stmt->execute();
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mail.php">';
		}
}

	
	
?>
</form>
</p>
</div>

       <hr noshade size=3>
  
  
 
  
<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="68" align="center" scope="col"><a href="about">About</a></td>
    <td width="75" align="center" scope="col"><a href="library.php">Library</a></td>
    <td width="91" align="center" scope="col"><a href="secret.php">Secret.php</a></td>
    <td width="62" align="center" scope="col"><a href="mod.php">Mod</a></td>
  </tr>
</table>
</body>
</html>