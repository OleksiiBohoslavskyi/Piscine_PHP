#!/usr/bin/php
<?PHP
	function ft_is_sort($arr)
	{
		$tmp_arr = $arr;
		sort($tmp_arr);
		if ($tmp_arr === $arr)
			return (true);
		else
			return (false);
	}
?>
