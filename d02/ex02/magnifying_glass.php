#!/usr/bin/php
<?PHP
	function change_title($match_arr)
	{
		$pos = stripos($match_arr[0], "\"");
		$ret = substr($match_arr[0], 0, $pos + 1);
		$str = strtoupper(substr($match_arr[0], $pos + 1));
		return $ret.$str;
	}
	function getup_a($match_arr)
	{
		$str = strtoupper($match_arr[0]);
		return ($str);
	}
	function change_a($match_arr)
	{
		$str = preg_replace_callback("/>(.*?)</s", "getup_a", $match_arr[0]);
		return ($str);
	}
	$mask_a = "/<a (.*?)<\/a>/s";
	$mask_title = "/title[ ]?=[ ]?\"(.*?)\"/s";
	if (($argc != 2) || (!file_exists($argv[1])))
	    exit(0);
	$str = file_get_contents($argv[1]);
	$str = preg_replace_callback($mask_title, "change_title", $str);
	$str = preg_replace_callback($mask_a, "change_a", $str);
	echo "$str";
?>