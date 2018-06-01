<?php

class Color
{
	public			$red;
	public 			$green;
	public 			$blue;
	public static	$verbose = false;

	function __construct($arr)
	{
		if (array_key_exists('rgb', $arr))
		{
			$arr['rgb'] = (int)$arr['rgb'];
			$this->red = (($arr['rgb']) & 0xFF0000) >> 16;
			$this->green = ($arr['rgb'] & 0xFF00) >> 8;
			$this->blue = ($arr['rgb'] & 0xFF);
		}
		else if (array_key_exists('red', $arr) && array_key_exists('green', $arr)
			&& array_key_exists('blue', $arr))
		{
			$this->red = (int)$arr[red];
			$this->green = (int)$arr[green];
			$this->blue = (int)$arr[blue];
		}
		if (self::$verbose) {
			$format = 'Color( red: %3s, green: %3s, blue: %3s ) constructed.' . PHP_EOL;
			echo sprintf($format, $this->red, $this->green, $this->blue);
		}
		return ;
	}

	static function doc()
	{
		echo file_get_contents("Color.doc.txt");
		return ;
	}

	function add($obj)
	{
		$arr = array (
			'red'	=> $this->red + $obj->red,
			'green'	=> $this->green + $obj->green,
			'blue'	=> $this->blue + $obj->blue,
		);
		$newobj = new Color($arr);
		return $newobj;
	}

	function sub($obj)
	{
		$arr = array (
			'red'	=> $this->red - $obj->red,
			'green'	=> $this->green - $obj->green,
			'blue'	=> $this->blue - $obj->blue,
		);
		$newobj = new Color($arr);
		return $newobj;
	}

	function mult($f)
	{
		$arr = array (
			'red'	=> $this->red * $f,
			'green'	=> $this->green * $f,
			'blue'	=> $this->blue * $f,
		);
		$newobj = new Color($arr);
		return $newobj;
	}

	function __destruct()
	{
		if (self::$verbose) {
			$format = 'Color( red: %3s, green: %3s, blue: %3s ) destructed.' . PHP_EOL;
			echo sprintf($format, $this->red, $this->green, $this->blue);
		}
		return ;
	}

	function __toString()
	{
		$format = 'Color( red: %3s, green: %3s, blue: %3s )';
		$string = sprintf($format, $this->red, $this->green, $this->blue);
		return $string;
	}
}

?>

