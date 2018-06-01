#!/usr/bin/php
<?PHP
	$s = trim(preg_replace('/\s\s+/', ' ', $argv[1]));
	if ($s)
		echo "$s\n";
?>
