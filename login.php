<?php
$error = false;
if(isset($_POST['login'])){
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	$password = md5($_POST['password']);
	if(file_exists('users/' . $username . '.xml')){
		$xml = new SimpleXMLElement('users/' . $username . '.xml', 0, true);
		if($password == $xml->password){
			session_start();
			$_SESSION['username'] = $username;
			header('Location: index.php');
			die;
			
		}
	}
	$error = true;
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form action="" method="post">
		<p>Username : <input type="text" placeholder="Username" name="username"></p>
		<p>Password : <input type="password" placeholder="Password" name="password"></p>
		<?php if($error){ echo '<p> Invalid Usernaem or Password'; } ?>
		<p><input type="submit" value="login" name="login"></p>
	</form> 
	<a href="register.php">Register</a>
</body>
</html>