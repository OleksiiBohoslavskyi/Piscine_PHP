#!/usr/bin/php
<?PHP
	if ($argc == 4)
	{
	    $argv[1] = trim($argv[1]);
	    $argv[2] = trim($argv[2]);
	    $argv[3] = trim($argv[3]);
		switch ($argv[2])
		{
            case '+':
                echo $argv[1] + $argv[3], PHP_EOL;
                break;
            case '-':
                echo $argv[1] - $argv[3], PHP_EOL;
                break;
            case '*':
                echo $argv[1] * $argv[3], PHP_EOL;
                break;
            case '/':
            {
                if ($argv[3] == 0)
                    echo "error: Division by zero.\n";
                else
                    echo $argv[1] / $argv[3], PHP_EOL;
                break;
            }
            case '%':
            {
                if ($argv[3] == 0)
                    echo "error: Division by zero.\n";
                else
                    echo $argv[1] % $argv[3], PHP_EOL;
                break;
            }
        }
    }
    else
        echo 'Incorrect Parameters', PHP_EOL;
?>
