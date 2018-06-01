<?php

	function error()
	{
		echo "ERROR\n";
		exit ;
	}

	if ($_POST[submit] === "OK" && $_POST[login] && $_POST[passwd])
	{
		if (!(file_exists("../private")))
			mkdir("../private", 0777);
		$login = $_POST[login];
		$passwd = hash("whirlpool", $_POST[passwd]);
		$arr = unserialize(file_get_contents("../private/passwd"));
		for ($key = 0; $arr[$key]; $key++)
			if ($arr[$key][login] === $login)
				error();
		$new_arr = array('login' => $login, 'passwd' => $passwd);
		$arr[] = $new_arr;
		file_put_contents('../private/passwd', serialize($arr));
		echo "OK\n";
	}
	else
		error();

?>
