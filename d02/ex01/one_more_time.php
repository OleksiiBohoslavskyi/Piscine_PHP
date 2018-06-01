#!/usr/bin/php
<?PHP
	function ft_error()
	{
		echo "Wrong Format\n";
		exit(0);
	}
	function php_split($str)
	{
		$arr = array();
		$s = trim(preg_replace("( +)", " ", $str));
		if ($s)
			$arr = explode(' ', $s);
		return ($arr);
	}
	$pattern = "/^[A-Z]?[a-z]+ [0-9]{1,2} [A-Z]?[a-zéû]+ [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/";
	$arr = array();
	$mth_fr_arr = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
        "Septembre", "Octobre", "Novembre", "Décembre");
	$mth_en_arr = array("January", "February", "March", "April", "May", "June", "July", "August",
        "September", "October", "November", "December");
	if ($argc != 2)
		exit(0);
    setlocale(LC_TIME, "fr_FR");
	if ((preg_match($pattern, $argv[1]) == 0)
        || (($arr_time = strptime($argv[1], '%A %e %B %Y %T')) === FALSE)
        || ($arr_time[unparsed] != 0))
	    ft_error();
	$split_arr = php_split($argv[1]);
	$split_arr[2] = $mth_en_arr[array_search(ucwords($split_arr[2]), $mth_fr_arr)];
	unset($split_arr[0]);
	$res_str = implode(" ", $split_arr);
	date_default_timezone_set('Europe/Paris');
	$res_numb = strtotime($res_str);
	echo "$res_numb\n";
?>
