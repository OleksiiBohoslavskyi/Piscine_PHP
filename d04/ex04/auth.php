<?php
function auth($login, $passwd) {
	$truly = 0;
	if ($login && $passwd) {
		$file = unserialize(file_get_contents("../private/passwd"));
		foreach ($file as $key => $value) {
			if (($value["login"] == $login) && ($value["passwd"] == hash('whirlpool', $passwd))) {
				$truly = 1;
			}
		}
		if ($truly == 1)
			return (true);
	}
}
return (false);
?>
