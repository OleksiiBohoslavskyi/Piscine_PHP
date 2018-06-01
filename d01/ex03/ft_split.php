#!/usr/bin/php
<?PHP
	function ft_split($s)
	{
		$arr = array();
		$ln = trim(preg_replace("( +)", " ", $s));
		if ($ln)
			$arr = explode(' ', $ln);
        sort($arr);
		return ($arr);
	}
?>