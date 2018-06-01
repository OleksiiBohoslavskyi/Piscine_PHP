#!/usr/bin/php
<?PHP
	function ft_split($s)
	{
		$ln = trim(preg_replace("( +)", " ", $s));
		if ($ln)
			$arr = explode(' ', $ln);
        sort($arr);
		return ($arr);
	}
	$arr = array();
	for ($i = 1; $i < $argc; $i++)
	{
		$str = ft_split($argv[$i]);
		foreach ($str as $word)
			array_push($arr, $word);
	}
	sort($arr);
	foreach ($arr as $s)
		echo "$s\n";
?>
