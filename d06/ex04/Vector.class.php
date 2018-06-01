<?PHP

require_once 'Vertex.class.php';

Class Vector
{
	private			$_x;
	private			$_y;
	private			$_z;
	private			$_w;
	public static	$verbose = false;

	function __construct($arr)
	{
		if (array_key_exists('orig', $arr))
		{
			$this->_x = $arr[dest]->get('x') - $arr[orig]->get('x');
			$this->_y = $arr[dest]->get('y') - $arr[orig]->get('y');
			$this->_z = $arr[dest]->get('z') - $arr[orig]->get('z');
		}
		else
		{
			$orig = new Vertex( array(  'x' => 0.0, 'y' => 0.0, 'z' => 0.0  ) );
			$this->_x = $arr[dest]->get('x') - $orig->get('x');
			$this->_y = $arr[dest]->get('y') - $orig->get('y');
			$this->_z = $arr[dest]->get('z') - $orig->get('z');
		}

		$this->_w = 0.0;

		if (self::$verbose)
		{
			$x = number_format($this->_x, 2, ".", "");
			$y = number_format($this->_y, 2, ".", "");
			$z = number_format($this->_z, 2, ".", "");
			$w = number_format($this->_w, 2, ".", "");
			print('Vector( x:' . $x .
				', y:' . $y .
				', z:' . $z .
				', w:' . $w .
				' ) constructed' . PHP_EOL);
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
			print('Vector( x:' . $x .
				', y:' . $y .
				', z:' . $z .
				', w:' . $w .
				' ) destructed' . PHP_EOL);
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
			return ('Vector( x:' . $x .
			', y:' . $y .
			', z:' . $z .
			', w:' . $w .
			' )');
		else
			return ('Vector( x:' . $x .
			', y:' . $y .
			', z:' . $z .
			', w:' . $w .
			' )');
	}

	static function doc()
	{
		echo file_get_contents("Vector.doc.txt");
		return ;
	}

	public function magnitude()
	{
		return (sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
	}

	public function normalize()
	{
		$magn = $this->magnitude();
		$x = $this->_x / $magn;
		$y = $this->_y / $magn;
		$z = $this->_z / $magn;
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $x,
				'y' => $y,
				'z' => $z,
			))
		));
		return ($vector);
	}

	public function add($rhs)
	{
		$sum_x = $this->_x + $rhs->_x;
		$sum_y = $this->_y + $rhs->_y;
		$sum_z = $this->_z + $rhs->_z;
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $sum_x,
				'y' => $sum_y,
				'z' => $sum_z,
			))
		));
		return ($vector);
	}

	public function sub($rhs)
	{
		$diff_x = $this->_x - $rhs->_x;
		$diff_y = $this->_y - $rhs->_y;
		$diff_z = $this->_z - $rhs->_z;
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $diff_x,
				'y' => $diff_y,
				'z' => $diff_z
			))
		));
		return ($vector);
	}

	public function opposite()
	{
		$x = -$this->_x;
		$y = -$this->_y;
		$z = -$this->_z;
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $x,
				'y' => $y,
				'z' => $z
			))
		));
		return ($vector);
	}

	public function scalarProduct($k)
	{
		$mult_x = $this->_x * $k;
		$mult_y = $this->_y * $k;
		$mult_z = $this->_z * $k;
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $mult_x,
				'y' => $mult_y,
				'z' => $mult_z
			))
		));
		return ($vector);
	}

	public function dotProduct($rhs)
	{
		$mult_x = $this->_x * $rhs->_x;
		$mult_y = $this->_y * $rhs->_y;
		$mult_z = $this->_z * $rhs->_z;
		$scalar_mult = $mult_x + $mult_y + $mult_z;
		return ($scalar_mult);
	}

	public function cos($rhs)
	{
		$A = $this->magnitude();
		$B = $rhs->magnitude();
		$scalar_mult = $this->dotProduct($rhs);
		$cos = $scalar_mult / ($A * $B);
		return ($cos);
	}

	public function crossProduct($rhs)
	{
		$cross_x = ($this->_y * $rhs->_z) - ($this->_z * $rhs->_y);
		$cross_y = ($this->_z * $rhs->_x) - ($this->_x * $rhs->_z);
		$cross_z = ($this->_x * $rhs->_y) - ($this->_y * $rhs->_x);
		$vector = new Vector(array(
			'dest' => new Vertex(array(
				'x' => $cross_x,
				'y' => $cross_y,
				'z' => $cross_z
			))
		));
		return ($vector);
	}

	function get($var)
	{
		$var = '_' . $var;
		if ($var === '_x' || $var === '_y' || $var === '_z' || $var === '_w')
			return ($this->$var);
		else
			return (NULL);
	}
}

?>

