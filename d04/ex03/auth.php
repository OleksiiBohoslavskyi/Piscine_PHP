<?php

function auth($login, $passwd)
{
	$arr = unserialize(file_get_contents("../private/passwd"));
	for ($key = 0; $arr[$key]; $key++)
	{
		if ($arr[$key][login] === $login && $arr[$key][passwd] === $passwd)
			return (true);
	}
	return (false);
}

?>
