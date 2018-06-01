#!/usr/bin/php
<?PHP
	function ft_split($str)
	{
	    $arr = array();
		$s = trim(preg_replace("( +)", " ", $str));
		if ($s)
			$arr = explode(' ', $s);
		return ($arr);
	}
	function asci_frst_chr($c)
    {
        $asci = ord($c);
        if ($asci >= 97 && $asci <= 122)
            return ($asci);
        else if ($asci >= 65 && $asci <= 90)
            $asci += 32;
        else if (is_numeric($c))
            $asci += 100;
        else
            $asci += 500;
        return ($asci);
    }
    function check($s1, $s2)
    {
        if ($s1 == $s2)
            return (0);
        $len1 = strlen($s1);
        $len2 = strlen($s2);
        $i = 0;
        while ($i < $len1 && $i < $len2)
        {
            $asci_s1 = asci_frst_chr($s1[$i]);
            $asci_s2 = asci_frst_chr($s2[$i]);
            if ($asci_s1 != $asci_s2)
                return (($asci_s1 < $asci_s2) ? -1 : 1);
            $i++;
        }
        if ($i == $len1 && $i == $len2)
            return (0);
        return (($i == $len1) ? -1 : 1);
    }
    $res_arr = array();
	for ($i = 1; $i < $argc; $i++)
	{
		$tmp_arr = ft_split($argv[$i]);
		foreach ($tmp_arr as $word)
		    array_push($res_arr, $word);
	}
	usort($res_arr, "check");
	foreach ($res_arr as $value)
	    echo "$value\n";
?>
