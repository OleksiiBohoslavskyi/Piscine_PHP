<?php

    session_start();
	function mySqlErr()
	{
        echo "Connection to database FAILED!<br />\n";
        echo mysqli_connect_error()."<br />\n";
        exit;
	}
    $mysql = mysqli_connect("localhost", "root", "123456", "Julizon");
    if (!$mysql)
        mySqlErr();
    $req = mysqli_query($mysql, "SELECT * FROM user");
    if ($req === false)
    	mySqlErr();
    do {
    	$data = mysqli_fetch_assoc($req);
            if ($_SESSION['user'] == $data['login'])
            	break;
    } while ($data);
    echo $data['lname'];
	if ($_GET['submit'] == "Edit");
	{
		$passwd = hash("whirlpool", $_GET['passwd']);

		if (hash("whirlpool", $_GET['old_pass']) == $result['password'])
		{
			if ($_GET['fname'])
				mysqli_query($mysql, "INSERT INTO user(fname) VALUES ('".$_GET['fname']."')");
			if ($_GET['lname'])
				mysqli_query($mysql, "INSERT INTO user(lname) VALUES ('".$_GET['lname']."')");
			if ($_GET['mail'])
				mysqli_query($mysql, "INSERT INTO user(mail) VALUES ('".$_GET['mail']."')");
			if ($_GET['phone'])
				mysqli_query($mysql, "INSERT INTO user(phone) VALUES ('".(int)$_GET['lname']."')");
			if ($_GET['new_pass'])
				mysqli_query($mysql, "INSERT INTO user(password) VALUES ('".hash("whirlpool", $_GET['new_pass'])."')");
			echo "Success!";
		}
		else 
			echo "Access denied! Wrong password!";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
</head>
<body>

	 <form action="register.php" class="login-form" method="get">
	 	<h1>Please enter your data</h1>
	 	<p>	First name:		<input type="text" name="fname" value=""><br />
	 		Last name:		<input type="text" name="lname" value="<?=$data['lname']?>"><br />
	 		e-mail:			<input type="text" name="mail" value="<?=$data['email']?>"><br />
	 		Phone:			<input type="number" name="phone" value="<?=$data['phone']?>"><br />
	 		Old_password:	<input type="password" name="old_pass" value="<?=$data['fname']?>"><br />
	 		New-password:	<input type="password" name="new_pass" value="<?=$data['fname']?>"><br />
        <input type="submit" name="submit" class="btn" value="Edit">
    	</p>
        </form>
</body>
</html>