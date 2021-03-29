  <?php
    @session_start();
		//$_SERVER["DOCUMENT_ROOT"] = "/var/chroot/home/content/41/8949141/html";
		    //include $_SERVER["DOCUMENT_ROOT"] . "/classes/connect.php";
				$path = $_SERVER["DOCUMENT_ROOT"];
					 $path .= "/classes/connect.php";
					 require($path);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>cats/library.php</title><!-- HTML HEADER --></head>

<body>

<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="79" align="center" scope="col"><a href="http://www.public404.com/about">About</a></td>
    <td width="79" align="center" scope="col"><?php if (!isset($_SESSION['status']) or $_SESSION['status'] != 'authorized') { echo'<a href="http://www.public404.com/login.php">Log in</a>'; } else { echo '<a href="http://www.public404.com/mod.php">Mod</a>'; }?></td>
  </tr>
</table>

       <hr noshade size=3>

<?php

try {
    $stmt = $conn->prepare('SELECT DISTINCT page FROM posts WHERE page LIKE "cats/%" ORDER BY page ASC');
    $stmt->execute();
	$num = $stmt->rowCount();
	print_r('There are ' . $num . ' pages in cats<br />');

	} //end try
catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}//endcatch

if (!isset($_GET['sub'])) {
$sub = 'hide';
if (isset($_GET['id'])) {
	echo '<a href="?id=' . $_GET['id'] . '&sort=' . $_GET['sort'] . '&sub=show">Show subpages</a><br>';
} else {
echo '<a href="?sub=show">Show subpages</a><br><br>'; }
} elseif($_GET['sub'] == 'show') {
$sub = 'show';
if (isset($_GET['id'])) {
	echo '<a href="?id=' . $_GET['id'] . '&sort=' . $_GET['sort'] . '&sub=hide">Hide subpages</a><br>';
} else {
echo '<a href="?sub=hide">Hide subpages</a><br><br>'; }
} else {
$sub = 'hide';
if (isset($_GET['id'])) {
	echo '<a href="?id=' . $_GET['id'] . '&sort=' . $_GET['sort'] . '&sub=show">Show subpages</a><br>';
} else {
echo '<a href="?sub=show">Show subpages</a><br><br>'; }
}

if (!isset($_GET['id'])) {
	$name = '!'; //!s make $name start at the begining of ASCII
} else {
$name = $_GET['id']; //corresponds to link
} //endif

if (!isset($_GET['sort'])) {
	$sort = 'alphabet'; //!s make $name start at the begining of ASCII
} else {
$sort = $_GET['sort']; //corresponds to link
} //endif

if (isset($_GET['sub'])) {
	$substr = '&sub=' . $_GET['sub'];
} else {
	$substr = NULL;
}

?>



Order by:
<a href="?id=<?php echo $name;
if (isset($_GET['sort']) && $_GET['sort'] == 'tebahpla') {
echo '&sort=alphabet' . $substr . '">alphabet</a> ';
} elseif (!isset($_GET['sort']) or $_GET['sort'] == 'alphabet') {
echo '&sort=tebahpla' . $substr . '">alphabet</a> ';
} else { echo '&sort=alphabet' . $substr . '">alphabet</a> '; }
?>
<a href="?id=<?php echo $name;
if (!isset($_GET['sort']) or $_GET['sort'] == 'old') {
echo '&sort=new' . $substr . '">new</a> ';
} elseif ($_GET['sort'] == 'new') {
echo '&sort=old' . $substr . '">old</a> ';
} else { echo '&sort=new' . $substr . '">new</a> '; }
?> <a href="?id=<?php echo $name;
if (!isset($_GET['sort']) or $_GET['sort'] == 'unpopular') {
echo '&sort=popular' . $substr . '">popular</a>';
} elseif ($_GET['sort'] == 'popular') {
echo '&sort=unpopular' . $substr . '">unpopular</a>';
} else { echo '&sort=popular' . $substr . '">popular</a>'; }
?>

<br /><br />

<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="20"><center><a href="?id=0&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">0</a></center></td>
    <td width="20"><center><a href="?id=1&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">1</a></center></td>
    <td width="20"><center><a href="?id=2&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">2</a></center></td>
    <td width="20"><center><a href="?id=3&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">3</a></center></td>
    <td width="20"><center><a href="?id=4&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">4</a></center></td>
    <td width="20"><center><a href="?id=5&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">5</a></center></td>
    <td width="20"><center><a href="?id=6&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">6</a></center></td>
    <td width="20"><center><a href="?id=7&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">7</a></center></td>
    <td width="20"><center><a href="?id=8&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">8</a></center></td>
  </tr>
  <tr>
    <td width="20"><center><a href="?id=9&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">9</a></center></td>
    <td width="20"><center><a href="?id=a&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">a</a></center></td>
    <td width="20"><center><a href="?id=b&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">b</a></center></td>
    <td width="20"><center><a href="?id=c&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">c</a></center></td>
    <td width="20"><center><a href="?id=d&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">d</a></center></td>
    <td width="20"><center><a href="?id=e&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">e</a></center></td>
    <td width="20"><center><a href="?id=f&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">f</a></center></td>
    <td width="20"><center><a href="?id=g&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">g</a></center></td>
    <td width="20"><center><a href="?id=h&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">h</a></center></td>
  </tr>
  <tr>
    <td width="20"><center><a href="?id=i&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">i</a></center></td>
    <td width="20"><center><a href="?id=j&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">j</a></center></td>
    <td width="20"><center><a href="?id=k&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">k</a></center></td>
    <td width="20"><center><a href="?id=l&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">l</a></center></td>
    <td width="20"><center><a href="?id=m&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">m</a></center></td>
    <td width="20"><center><a href="?id=n&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">n</a></center></td>
    <td width="20"><center><a href="?id=o&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">o</a></center></td>
    <td width="20"><center><a href="?id=p&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">p</a></center></td>
    <td width="20"><center><a href="?id=q&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">q</a></center></td>
  </tr>
  <tr>
    <td width="20"><center><a href="?id=r&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">r</a></center></td>
    <td width="20"><center><a href="?id=s&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">s</a></center></td>
    <td width="20"><center><a href="?id=t&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">t</a></center></td>
    <td width="20"><center><a href="?id=u&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">u</a></center></td>
    <td width="20"><center><a href="?id=v&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">v</a></center></td>
    <td width="20"><center><a href="?id=w&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">w</a></center></td>
    <td width="20"><center><a href="?id=x&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">x</a></center></td>
    <td width="20"><center><a href="?id=y&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">y</a></center></td>
    <td width="20"><center><a href="?id=z&sort=alphabet<?php if (isset($_GET['sub'])) { echo '&sub=' . $_GET['sub']; }?>">z</a></center></td>
  </tr>
</table>
<br /><br />

<?php

$i = 1;

try {
	if ($sort == 'alphabet') {
    $stmt = $conn->prepare('SELECT DISTINCT page FROM posts WHERE page LIKE "cats/%" AND page > :name ORDER BY page ASC');
	$stmt->bindParam(':name', $name);
	$stmt->execute();
	$page = $stmt->fetchAll();
	foreach ($page as $var) {
		if (strpos(preg_replace("#cats/#", "", $var['page'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['page'], 1) . '/">' . preg_replace("#cats/#", "", $var['page'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['page'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}
	}//end loop
	} elseif ($sort == 'tebahpla') {
    $stmt = $conn->prepare('SELECT DISTINCT page FROM posts WHERE page LIKE "cats/%" AND page > :name ORDER BY page DESC');
	$stmt->bindParam(':name', $name);
	$stmt->execute();
	$page = $stmt->fetchAll();
	foreach ($page as $var) {
				if (strpos(preg_replace("#cats/#", "", $var['page'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['page'], 1) . '/">' . preg_replace("#cats/#", "", $var['page'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['page'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}

	}//end loop
	} else if ($sort == 'new') {

	$stmt = $conn->prepare('SELECT PAGE FROM `posts` WHERE page LIKE "cats/%" ORDER BY `posts`.`timestamp` DESC');
	$stmt->execute();
	$new = $stmt->fetchAll();

	foreach ($new as $var) {
		if (strpos(preg_replace("#cats/#", "", $var['PAGE'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/">' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}
	}

	} else if ($sort == 'old') {

	$stmt = $conn->prepare('SELECT PAGE FROM `posts` WHERE page LIKE "cats/%" ORDER BY `posts`.`timestamp` ASC');
	$stmt->execute();
	$old = $stmt->fetchAll();

	foreach ($old as $var) {
				if (strpos(preg_replace("#cats/#", "", $var['PAGE'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/">' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}
	}
} else if ($sort == 'popular') {

	$stmt = $conn->prepare('SELECT DISTINCT PAGE FROM `posts` WHERE page LIKE "cats/%" ORDER BY `posts`.`views` DESC');
	$stmt->execute();
	$new = $stmt->fetchAll();

	foreach ($new as $var) {
			if (strpos(preg_replace("#cats/#", "", $var['PAGE'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/">' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}
	}
} else if ($sort == 'unpopular') {

	$stmt = $conn->prepare('SELECT DISTINCT PAGE FROM `posts` WHERE page LIKE "cats/%" ORDER BY `posts`.`views` ASC');
	$stmt->execute();
	$new = $stmt->fetchAll();

	foreach ($new as $var) {
				if (strpos(preg_replace("#cats/#", "", $var['PAGE'], 1),"/") === false || $_GET['sub'] == 'show') {
	echo('<a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/">' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '</a> <a href="' . preg_replace("#cats/#", "", $var['PAGE'], 1) . '/info.php">*</a><br />');//page break to show pages in list forma
		}
	}
}

} //end try
catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}//endcatch

?>


</body>
</html>
