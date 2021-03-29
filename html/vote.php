<?php

include 'classes/connect.php';

$ipaddress = $_SERVER['REMOTE_ADDR'];
$shortip = preg_replace('/[.]/', '', $ipaddress);

//vote.php?page=page
$page = $_GET['page'];
$vote = $_GET['vote'];

//make sure an ipadress can only vote once
$stmt = $conn->prepare('SELECT page, vote, ipv4
FROM posts
WHERE ipv4 = :ip AND page = :page');
$stmt->bindParam(':ip', $shortip);
$stmt->bindParam(':page', $page);
$stmt->execute();
$voteChk = $stmt->fetchColumn(1);

//set all votes of this ip to zero and STOP (clicking on red or green arrow will cancel out that vote)
if ($voteChk == $vote) {
	$stmt = $conn->prepare("UPDATE `public404`.`posts` SET `vote` = '0' WHERE ipv4 = :ip AND page = :page");
	$stmt->bindParam(':ip', $shortip);
	$stmt->bindParam(':page', $page);
	$stmt->execute();
echo '<script type="text/javascript">
<!--
window.history.go(-1)
-->
</script>';
end;
//set all votes of this ip to zero and CONTINUE
} elseif (!empty($voteChk)) {
	$stmt = $conn->prepare("UPDATE `public404`.`posts` SET `vote` = '0' WHERE ipv4 = :ip AND page = :page");
	$stmt->bindParam(':ip', $shortip);
	$stmt->bindParam(':page', $page);
	$stmt->execute();
}

//insert blank post with a vote of yes or no
$sql = "INSERT INTO posts (vote, ipv4) values ( :vote, :ip)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':vote', $vote);
	$stmt->bindParam(':ip', $shortip);
	$stmt->execute();
	

?>



