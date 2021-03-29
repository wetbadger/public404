<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords"="internet" /><meta name="title" content="The Public 404: The Worst Site on the Internet" /><meta name="description" content="A website of the people, by the people, and against the people." /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=1024" />
<title>The Public 404: The Worst Site in the World</title>

  <?php  

define("con","thepublic404");

$con = mysql_connect("thepublic404.db.8949141.hostedresource.com", "thepublic404", "Aei!tp23Own");
if (!con)
	{
	die("could not connect: " . mysql_error());
	}

mysql_select_db("thepublic404", $con);
  


$query="SELECT * FROM alexandices ORDER BY alexandices.uid DESC";
$result=mysql_query($query);

$num=mysql_numrows($result);

$i=0;
while ($i < $num) {

$post=mysql_result($result,$i,"post");

$page = html_entity_decode($post);

$output = stripslashes($page);

$healthy = array("window.location", "while (true)", "document.documentNode.innerHTML", 'HTTP-EQUIV="Refresh"', "window.close()");
$yummy   = "not.allowed";

echo (str_replace($healthy, $yummy, $output) . " 
");

$i++;
}
  
mysql_close($con);
?>
</div>
</body>
</html>
