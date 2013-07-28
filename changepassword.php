<?php
$errors = array();
session_start();
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
	header('Location: login.php');
	die;
}
$errors = false;
if(isset($_POST['change'])){
	$old = $_POST['oldpwd'];
	$new = $_POST['newpwd'];
	$c_new = $_POST['cnewpwd'];

	$xml = new SimpleXMLElement('users/' . $_SESSION['username'] . '.xml', 0, true );
	if($old == $xml->password){
		if($new == $c_new){
			$xml->password = $new;
			$xml->asXML('users/' . $_SESSION['username'] . '.xml');
			header('Location: logout.php');
			die;
		}
	}
	$errors = true;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Page</title>
</head>
<body>
	<h1>Change Password</h1>
	<?php
	if($errors)
	{
		echo '<p> Password Do not Match</p>';
	}
	?>
	<form action="" method="post">
		<p>Old Password : <input type="password" name="oldpwd" placeholder="Old Password" id=""></p>
		<p>New Password : <input type="password" name="newpwd" placeholder="New Password" id=""></p>
		<p>New Password Confirm : <input type="password" name="cnewpwd" placeholder="New Password Confirm" id=""></p>
		<p><input type="submit" value="changepwd" name="change"></p>
	</form>
	

	<hr>
	<a href="index.php">User Home</a>
</body>
</html>