<?php
error_reporting(0);
session_start();
include_once 'classes/membership.php';
$membership = new membership();

if (!isset($_COOKIE['username'])) {
$name = strtolower($_POST['username']);
$pass = hash('sha1', $_POST['pwd']);
} else {
	$name = $_COOKIE['username'];
	$pass = $_COOKIE['password'];
}

// If the user clicks the "log out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_User_Out();							  
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
			$response = $membership->Login($name, $pass);	
			}
if(isset($_COOKIE['autologin']) && $_COOKIE['autologin'] == 'yes') {
			$response = $membership->Login($name, $pass);	
			}
			
if (isset($_POST['register'])) {
	$cname = strtolower($_POST['cname']);
	$cpwd = $_POST['cpwd'];
	$response2 = $membership->register($cname, $cpwd);
} //end if register is hit
?>
			



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>login.php</title>
</head>

<body>

<div id="alert">
  <form action="" method="post">
	  <h1>Login</h1>
      
      <table width="25%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="29%" scope="col"><label for="name">Username:</label></td>
    <th width="71%" scope="col"><input name="username" type="text" value="" maxlength="16"/>
       </th>
  </tr>
  <tr>
    <td scope="col"><label for="pwd">Password:</label></td>
    <th scope="col"><input type="password" name="pwd" maxlength="16"/></th>
  </tr>
    </table>
     <p>
     	<input name="submit" type="submit" class="Button" id="submit" value="Login" />
       <?php if(isset($response)) echo "<h4>" . $response . "</h4>"; ?></p><p><input name="autologin" type="checkbox" value="" <?php if ($_COOKIE['autologin'] == 'yes') { echo "checked='checked'"; }?>/>
     Remember me</p>
  </form>
</div>
<div id="register">
  <form action="" method="post">
	  <h1>Register</h1>
      
      <table width="25%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="29%" scope="col"><label for="cname">Username:</label></td>
    <th width="71%" scope="col"><input name="cname" type="text" value="" maxlength="16"/>
       </th>
  </tr>
  <tr>
    <td scope="col"><label for="cpwd">Password:</label></td>
    <th scope="col"><input type="password" name="cpwd" maxlength="16"/></th>
  </tr>
    <tr>
    <td scope="col"><label for="rpwd">Repeat Password:</label></td>
    <th scope="col"><input type="password" name="rpwd" maxlength="16"/></th>
  </tr>
    </table>
     <p>
     	<input name="register" type="submit" class="Button" id="submit" value="Register" />
       <?php if(isset($response2)) echo "<h4>" . $response2 . "</h4>"; ?></p>
  </form>
  
  <?php if (isset($_POST['autologin'])) {
	$membership->rememberme($name, $pass);
} else {
	$membership->forgetme();
} ?>
</div>
</body>
   </div><!--end login-->
</html>
</body>
</html>