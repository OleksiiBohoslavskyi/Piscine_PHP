<?php
	if ($_POST["login"] && $_POST["oldpw"] && $_POST["newpw"] 
		&& $_POST["submit"] && $_POST["submit"] == "OK")
	{
		$changed = 0;
		$file = unserialize(file_get_contents("../private/passwd"));
		if (!$file)
			echo "ERROR\n";
		foreach($file as $part => $value)
		{
			if ($value['login'] === $_POST['login'] &&
			 $value['passwd'] == hash("whirlpool",$_POST['oldpw']))
			{
				$file[$part]['passwd'] = hash("whirlpool",$_POST['newpw']);
				$changed = 1;
			}	
		}
		if ($changed == 1)
		{
			$ser = serialize($file);
			file_put_contents("../private/passwd", $ser);
			echo "OK\n";
		}
		else{
			echo "ERROR\n";
		}
	}
	else
	{
		echo "ERROR\n";
		exit;
	}
?>