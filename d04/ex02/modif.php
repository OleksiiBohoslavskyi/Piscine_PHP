<?php

function error()
{
	echo "ERROR\n";
	exit ;
}

if ($_POST[submit] === "OK" && $_POST[login] && $_POST[oldpw] && $_POST[newpw])
{
	if (!(file_exists("../private")))
		mkdir("../private", 0777);
	$login = $_POST[login];
	$oldpw = hash("whirlpool", $_POST[oldpw]);
	$newpw = hash("whirlpool", $_POST[newpw]);
	$arr = unserialize(file_get_contents("../private/passwd"));
	for ($key = 0; $arr[$key]; $key++)
	{
		if ($arr[$key][login] === $login && $arr[$key][passwd] === $oldpw)
		{
			$arr[$key][passwd] = $newpw;
			$arr[] = $new_arr;
			file_put_contents('../private/passwd', serialize($arr));
			echo "OK\n";
			exit ;
		}
		else
			error();
	}
}
else
	error();

?>
