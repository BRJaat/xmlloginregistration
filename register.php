<?php
$errors = array();
if(isset($_POST['login']))
{
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$pwd =$_POST['password'];
	$cpwd = $_POST['cpassword'];
	$email = $_POST['email'];

	if(file_exists('users/' . $username . '.xml')){
		$errors[] = 'Username already exists';
	}
	if($email == '')
	{
		$errors[] = 'Email is Blank';
	}
	if($pwd == '')
	{
		$errors[] = 'Password is Blank';
	}
	if($password != $cpassword)
	{
		$errors[] ="Confirm Password Do not Match";
	}
	if($username == '')
	{
		$errors[] = 'Username is blank';
	}

	echo count($errors);

	if(count($errors) == 0)
	{
		$xml = new SimpleXMLElement('<user></user>');
		$xml->addChild('password', $password);
		$xml->addChild('email', $email);
		$xml->asXML('users/' .$username . '.xml');
		header('Location: login.php');
		die;
	}
	
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<?php 
		if(count($errors > 0))
		{
			echo "<ul>";
			foreach($errors as $e)
			{
				echo "<li>";
				echo $e;
				echo "</li>";
			}
			echo "</ul>";
		}
	?>
	<form action="" method="post">
		<p>Username : <input type="text" name="username" placeholder="Username" size="20" id=""></p>
		<p>Email : <input type="text" name="email" placeholder="Email" size="20" id=""></p>
		<p>Password : <input type="text" name="password" placeholder="Password" size="20" id=""></p>
		<p>Confirm Password : <input type="text" name="cpassword" placeholder="Confirm Password" size="20" id=""></p>
		<p><input type="submit" value="Login" name="login"></p>
	</form>
</body>
</html>