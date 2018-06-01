<?php 
session_start();
if ($_SESSION['loggued_on_user'] && $_SESSION['loggued_on_user'] != "" ) {
	if($_POST['msg']) {
		if (!file_exists("../private/chat")) {
			file_put_contents("../private/chat", null);
		}
		$file = unserialize(file_get_contents("../private/chat"));
		$open = fopen("../private/chat", "w");
		flock($open, LOCK_EX);
		$array = array(
			"login"=>$_SESSION['loggued_on_user'],
			"time"=>date("H:i"),
			"msg" => $_POST["msg"]
		);
		$file[] = $array;
		$ser = serialize($file);
		file_put_contents("../private/chat", $ser);
		fclose($open);
	}
}
else {
	echo "ERROR\n";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script langage="javascript">top.frames["chat"].location = "chat.php";</script>
</head>
<body>
	<form action="speak.php" method="POST">
			<input type="textarea" name="msg" value="">
			<input type="submit" value="submit" name="submit">
	</form>
</body>
</html>
