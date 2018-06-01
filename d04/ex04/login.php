<?php 
	session_start();
	include "auth.php";
	
	if ($_POST["login"] && $_POST["passwd"] && auth($_POST["login"], $_POST["passwd"]))
	{
		$_SESSION['loggued_on_user'] = $_POST["login"];
		echo "<!DOCTYPE html>
		<html lang='en'>
		<head>
			<meta charset='UTF-8'>
			<title>CHAT</title>
		</head>
		<body>
			<iframe src='chat.php' name='chat' frameborder='10' width='100%' height='550px'></iframe>
			<iframe src='speak.php' name='speak' frameborder='10' width='100%' height='50px'></iframe>

		</body>
		</html>";
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		header("Location: index.html");
		echo "ERROR\n";
	}
 ?>