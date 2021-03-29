<?php

@session_start();

include 'classes/connect.php';

//GET PAGE NAMES
$stmt = $conn->prepare("SELECT * FROM mods WHERE username = :username");
$stmt->bindParam(":username", $_SESSION['username']);
$stmt->execute();
$page1 = $stmt->fetchColumn(3);
$stmt->execute();
$page2 = $stmt->fetchColumn(4);
$stmt->execute();
$page3 = $stmt->fetchColumn(5);

if (isset($_GET['id'])) {
//authenticate post edits
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `posts`
WHERE ID = :id
AND PAGE = :page1
OR ID = :id
AND PAGE = :page2
OR ID = :id
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$result = $stmt->fetchColumn();

if ($result == 0 and $page1 != '#') {
	echo 'Authentication failed
	<script type="text/javascript">

history.back()

</script>';
	exit;
} else {
try {
$stmt = $conn->prepare("DELETE FROM `posts`
WHERE ID = :id
AND PAGE = :page1
OR ID = :id
AND PAGE = :page2
OR ID = :id
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

if ($page1 == '#') {
$stmt = $conn->prepare("DELETE FROM `posts`
WHERE ID = :id
AND PAGE = ''");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
}

echo $result . " posts deleted<br /><br />If you have javascript disabled, press 'back'";

//header("Location: http://www.example.com/");

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
} //end if isset

if (isset($_GET['sid'])) {
//authenticate string edits
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `bstr`
WHERE ID = :sid
AND PAGE = :page1
OR ID = :sid
AND PAGE = :page2
OR ID = :sid
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':sid', $_GET['sid']);
$stmt->execute();
$result = $stmt->fetchColumn();

if ($result == 0 and $page1 != '#') {
	echo 'Authentication failed
	<script type="text/javascript">

history.back()

</script>';
	exit;
} else {
try {
$stmt = $conn->prepare("DELETE FROM `bstr`
WHERE ID = :sid
AND PAGE = :page1
OR ID = :sid
AND PAGE = :page2
OR ID = :sid
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':sid', $_GET['sid']);
$stmt->execute();

$p = $_GET['p'];
echo $result . " strings deleted<br /><br />If you have javascript disabled, press 'back'";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . $p . '">';
    		exit;

//header("Location: http://www.example.com/");

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
				} //end if isset
				
if (isset($_GET['rid'])) {
//authenticate regex edits
$stmt = $conn->prepare("SELECT COUNT(*)
FROM `bregex`
WHERE ID = :rid
AND PAGE = :page1
OR ID = :rid
AND PAGE = :page2
OR ID = :rid
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':rid', $_GET['rid']);
$stmt->execute();
$result = $stmt->fetchColumn();

if ($result == 0 and $page1 != '#') {
	echo 'Authentication failed
	<script type="text/javascript">

history.back()

</script>';
	exit;
} else {
try {
$stmt = $conn->prepare("DELETE FROM `bregex`
WHERE ID = :rid
AND PAGE = :page1
OR ID = :rid
AND PAGE = :page2
OR ID = :rid
AND PAGE = :page3");
$stmt->bindParam(':page1', $page1);
$stmt->bindParam(':page2', $page2);
$stmt->bindParam(':page3', $page3);
$stmt->bindParam(':rid', $_GET['rid']);
$stmt->execute();

echo $result . " regex deleted<br /><br />If you have javascript disabled, press 'back'";
$p = $_GET['p'];
echo $result . " strings deleted<br /><br />If you have javascript disabled, press 'back'";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mod.php?page=' . $p . '">';
    		exit;

//header("Location: http://www.example.com/");

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
				} //end if isset
?>
<script type="text/javascript">
<!--
window.history.go(-1)
-->
</script>