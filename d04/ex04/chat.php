<?php
session_start();
if ($_SESSION['loggued_on_user']) {
	if (file_exists("../private/chat")) {
		$talk = unserialize(file_get_contents("../private/chat"));
		foreach ($talk as $key) {
			echo "[" . $key['time'] . "] " . "<b>" . $key['login'] . "</b>" . ": " . $key['msg'] . "<br />\n";
		}
	}
}
else {
	echo "ERROR_SESSION\n";
}
?>
