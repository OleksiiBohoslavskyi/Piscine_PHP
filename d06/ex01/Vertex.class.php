<?PHP

require_once 'Color.class.php';

Class Vertex
{
	private			$_x;
	private			$_y;
	private			$_z;
	private			$_w;
	private			$_color;
	public static	$verbose = false;

	function __construct($arr)
	{
		if (array_key_exists('x', $arr) && array_key_exists('y', $arr)
			&& array_key_exists('z', $arr))
		{
			$this->_x = (float)$arr[x];
			$this->_y = (float)$arr[y];
			$this->_z = (float)$arr[z];
		}

		if (array_key_exists('color', $arr))
			$this->_color = $arr[color];
		else
			$this->_color = new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255));

		if (array_key_exists('w', $arr))
			$this->_w = (float)$arr[w];
		else
			$this->_w = 1.0;

		if (self::$verbose)
		{
			$x = number_format($this->_x, 2, ".", "");
			$y = number_format($this->_y, 2, ".", "");
			$z = number_format($this->_z, 2, ".", "");
			$w = number_format($this->_w, 2, ".", "");
			print('Vertex( x: ' . $x . ', y: ' . $y . ', z:' . $z . ', w:' .
				$w . ', ' . $this->_color .' ) constructed' . PHP_EOL);
		}
		return ;
	}

	function __destruct()
	{
		if (self::$verbose)
		{
			$x = number_format($this->_x, 2, ".", "");
			$y = number_format($this->_y, 2, ".", "");
			$z = number_format($this->_z, 2, ".", "");
			$w = number_format($this->_w, 2, ".", "");
			print('Vertex( x: ' . $x .
				', y: ' . $y .
				', z:' . $z .
				', w:' . $w .
				', ' . $this->_color . ' ) destructed' . PHP_EOL);
		}
		return ;
	}

	function __toString()
	{
		$x = number_format($this->_x, 2, ".", "");
		$y = number_format($this->_y, 2, ".", "");
		$z = number_format($this->_z, 2, ".", "");
		$w = number_format($this->_w, 2, ".", "");
		if (self::$verbose)
			return ('Vertex( x: ' . $x . ', y: ' . $y . ', z:' . $z . ', w:' . $w . ', ' . $this->_color . ' )');
		else
			return ('Vertex( x: ' . $x . ', y: ' . $y . ', z:' . $z . ', w:' . $w . ' )');
	}

	static function doc()
	{
		echo file_get_contents("Vertex.doc.txt");
		return ;
	}

	function get($var)
	{
		switch ($var)
		{
		case "x":
			return ($this->_x);
		case "y":
			return ($this->_y);
		case "z":
			return ($this->_z);
		case "w":
			return ($this->_w);
		case "color":
			return ($this->_color);
		}
	}
}

?>
