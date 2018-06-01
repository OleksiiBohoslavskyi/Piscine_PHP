#!/usr/bin/php
<?PHP
	while (1)
	{
		echo "Enter a number: ";
		$s = fgets(STDIN);
		$str = trim($s);
		if (feof(STDIN))
		{
			echo "\n";
			break;
		}
		if (!ctype_digit($str))
			echo "'$str' is not a number\n";
		else
		{
			if ($str % 2 == 0)
				echo "The number $str is even\n";
			else
				echo "The number $str is odd\n";
		}
	}
?>
