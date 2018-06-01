#!/usr/bin/php
<?PHP
	function ft_split($str)
	{
		$s = trim(preg_replace("( +)", " ", $str));
		if ($s)
			$arr = explode(' ', $s);
		return ($arr);
	}
	$i = 0;
	if (!($arr = ft_split($argv[1])) || $argc < 2)
		return ;
	while (++$i < count($arr))
		echo "$arr[$i] ";
	if ($argc > 1)
		echo "$arr[0]\n";	
?>
