#!/usr/bin/php
<?PHP
	$fd = fopen("/var/run/utmpx", 'r');
	date_default_timezone_set("Europe/Kiev");
	while ($str = fread($fd, 628))
	{
		$arr = unpack("a256name/a4id/a32line/ipid/itype/Itime", $str);
		if ($arr[type] == 7)
			echo "$arr[name] $arr[line]  " . date('M j H:i', $arr[time]) . "\n";
	}
?>
