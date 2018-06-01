#!/usr/bin/php
<?PHP
	function ft_error($n1, $c, $n2)
	{
		if (is_null($n1) || is_null($n2))
			return (1);
		if (preg_match_all('|[+%/*-]|', $c))
			return (0);
		return (1);
	}
	if ($argc != 2)
	{
		echo 'Incorrect Parameters', PHP_EOL;
		exit (1);
	}
	list($n1, $c, $n2) = sscanf($argv[1], "%d %c %d");
	if (ft_error($n1, $c, $n2))
	{
		echo 'Syntax Error', PHP_EOL;
		exit (1);
	}
	switch ($c)
	{
        case '+':
            echo $n1 + $n2, PHP_EOL;
            break;
        case '-':
            echo $n1 - $n2, PHP_EOL;
            break;
        case '*':
            echo $n1 * $n2, PHP_EOL;
            break;
        case '/':
        {
            if ($n2 == 0)
                echo "error: Division by zero.\n";
            else
                echo $n1 / $n2, PHP_EOL;
            break;
        }
        case '%':
        {
            if ($n2 == 0)
                echo "error: Division by zero.\n";
            else
                echo $n1 % $n2, PHP_EOL;
            break;
        }
	}
?>
