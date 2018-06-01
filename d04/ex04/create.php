<?php
	if ($_POST["login"] && $_POST["passwd"] && $_POST["submit"] 
		&& $_POST["submit"] == "OK" && $_POST["passwd"] != "")
	{
		$flag = 0;
		$flag2 = 0;

		if (!file_exists("../private"))
		{
			mkdir("../private");	
		}
		
		if (!file_exists("../private/passwd"))
		{
			file_put_contents("../private/passwd", null);
			$file = unserialize(file_get_contents("../private/passwd"));
		}
		else{
			$file = unserialize(file_get_contents("../private/passwd"));
			foreach($file as $part => $value)
			{
				if ($value['login'] === $_POST['login'])
					$flag = 1;
			}
		}
		if ($flag == 1)
		{
			echo "ERRROR\n";
			exit;
		}
		$array = array("login"=>$_POST["login"], "passwd"=>hash("whirlpool", $_POST["passwd"]));
		$file[] = $array;
		$ser = serialize($file);
		file_put_contents("../private/passwd", $ser);
		header("Location: index.html");
		echo "OK\n";
	}
	else
	{
		echo "ERROR\n";
		exit;
	}
?>