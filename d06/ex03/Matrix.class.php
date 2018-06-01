<?php

require_once 'Vertex.class.php';
require_once 'Vector.class.php';

Class Matrix
{
	const			IDENTITY = 'IDENTITY';
	const			SCALE = 'SCALE';
	const			RX = 'Ox ROTATION';
	const			RY = 'Oy ROTATION';
	const			RZ = 'Oz ROTATION';
	const			TRANSLATION = 'TRANSLATION';
	const			PROJECTION = 'PROJECTION';
	private			$_mtrx;
	public static	$verbose = false;

	function __construct($arr)
	{
		if (array_key_exists('preset', $arr))
		{
			$this->make_mtrx($arr);

			if (array_key_exists('vtc', $arr))
				$this->add_vtx($arr[vtc]);

			if (array_key_exists('scale', $arr))
				$this->scale_mtrx($arr[scale]);

			if ($arr[preset] == self::PROJECTION)
				$this->proj($arr);

			if (($arr[preset] == self::RX ||
				$arr[preset] == self::RY ||
				$arr[preset] == self::RZ) && array_key_exists('angle', $arr))
			{
				$rot_mtrx = $this->make_rx_mtrx($arr[angle], $arr[preset]);
				$this->mt($rot_mtrx);
			}

			if (self::$verbose && $arr[preset] === 'IDENTITY' && $arr[preset] !== 'MULT')
				echo "Matrix $arr[preset] instance constructed" . PHP_EOL;
			else if (self::$verbose && $arr[preset] !== 'MULT')
				echo "Matrix $arr[preset] preset instance constructed" . PHP_EOL;
		}
		return ;
	}

	function __destruct()
	{
		if (self::$verbose)
			echo 'Matrix instance destructed' . PHP_EOL;
	}

	function __toString()
	{
		$str = 'M | vtcX | vtcY | vtcZ | vtxO' . "\n" . "-----------------------------" . "\n";
		foreach ($this->_mtrx as $key => $value)
		{
			$str .= $key;
			foreach ($this->_mtrx[$key] as $k => $v)
				$str .= ' | ' . number_format($v, 2, ".", "");
			$str .= "\n";
		}
		$str = substr($str, 0, -1);
		if (self::$verbose)
			return $str;
	}

	static function doc()
	{
		echo file_get_contents("Matrix.doc.txt");
		return ;
	}

	function get($var)
	{
		$var = '_' . $var;
		if ($var === '_mtrx')
			return ($this->$var);
		else
			return (NULL);
	}

	function make_mtrx($arr)
	{
		$key0 = array('vtcX' => 1.00, 'vtcY' => 0.00, 'vtcZ' => 0.00, 'vtxO' => 0.00);
		$key1 = array('vtcX' => 0.00, 'vtcY' => 1.00, 'vtcZ' => 0.00, 'vtxO' => 0.00);
		$key2 = array('vtcX' => 0.00, 'vtcY' => 0.00, 'vtcZ' => 1.00, 'vtxO' => 0.00);
		$key3 = array('vtcX' => 0.00, 'vtcY' => 0.00, 'vtcZ' => 0.00, 'vtxO' => 1.00);
		$this->_mtrx = array('x' => $key0, 'y' => $key1, 'z' => $key2, 'w' => $key3);
	}

	function add_vtx($vtc)
	{
		$this->_mtrx[x][vtxO] = $vtc->get(x);
		$this->_mtrx[y][vtxO] = $vtc->get(y);
		$this->_mtrx[z][vtxO] = $vtc->get(z);
	}

	function scale_mtrx($scale)
	{
		foreach ($this->_mtrx as $key => &$value)
		{
			if ($key !== 'w')
				foreach ($this->_mtrx[$key] as $k => &$v)
					$v *= $scale;
		}
	}

	function make_rx_mtrx($angle, $rotation)
	{
		$cos_a = cos($angle);
		$sin_a = sin($angle);
		if ($rotation === self::RX)
			$rot_mtrx = array(array(1.00,	0.00,	0.00,	0.00),
				array(0.00,	$cos_a,	-$sin_a,0.00),
				array(0.00,	$sin_a,	$cos_a,	0.00),
				array(0.00,	0.00,	0.00,	1.00),
			);
		if ($rotation === self::RY)
			$rot_mtrx = array(array($cos_a,	0.00,	$sin_a,	0.00),
				array(0.00,	1.00,	0.00,	0.00),
				array(-$sin_a,0.00,	$cos_a,	0.00),
				array(0.00,	0.00,	0.00,	1.00),
			);
		if ($rotation === self::RZ)
			$rot_mtrx = array(array($cos_a,	-$sin_a,0.00,	0.00),
				array($sin_a,	$cos_a,	0.00,	0.00),
				array(0.00,	0.00,	1.00,	0.00),
				array(0.00,	0.00,	0.00,	1.00),
			);
		return ($rot_mtrx);
	}

	function mt($rot_mtrx)
	{
		$res = array();
		$k = 0;
		while ($k < 4)
		{
			$y = 0;
			foreach ($this->_mtrx[x] as $cl => $value)
			{
				$x = 0;
				foreach ($this->_mtrx as $key => $value)
				{
					$res[$k][$y] += $this->_mtrx[$key][$cl] * $rot_mtrx[$k][$x];
					$x++;
				}
				$y++;
			}
			$k++;
		}

		$y = 0;
		foreach ($this->_mtrx as $key => $value)
		{
			$x = 0;
			foreach ($this->_mtrx[$key] as $k => $v)
			{
				$this->_mtrx[$key][$k] = $res[$y][$x];
				$x++;
			}
			$y++;
		}
	}

	function mult($rhs)
	{
		$new = new Matrix( array( 'preset' => 'MULT' ) );
		$arr = array();
		$y = 0;
		foreach ($this->_mtrx as $key => $value) {
			$x = 0;
			foreach ($this->_mtrx[$key] as $cl => $value) {
				$arr[$y][$x] = $this->_mtrx[$key][$cl];
				$x++;
			}
			$y++;
		}
		$rez = array();
		$cl = 0;
		$key = 0;
		$k = 0;
		while ($k < 4) {
			$y = 0;
			foreach ($rhs->_mtrx[x] as $cl => $value) {
				$x = 0;
				foreach ($rhs->_mtrx as $key => $value) {
					$rez[$k][$y] += $rhs->_mtrx[$key][$cl] * $arr[$k][$x];
					$x++;
				}
				$y++;
			}
			$k++;
		}
		$y = 0;
		$cl = 0;
		$key = 0;
		foreach ($new->_mtrx as $key => $value) {
			$x = 0;
			foreach ($new->_mtrx[$key] as $cl => $value) {
				$new->_mtrx[$key][$cl] = $rez[$y][$x];
				$x++;
			}
			$y++;
		}
		return ($new);
	}

	function proj($kwargs)
	{
		$scale = tan($kwargs['fov'] * 0.5 * M_PI / 180) * $kwargs['near'];
		$r = $kwargs['ratio'] * $scale;
		$l = -$r;
		$t = $scale;
		$b = -$t;
		$f = $kwargs['far'];
		$n = $kwargs['near'];

		$this->_mtrx[x][vtcX] = 2 * $n / ($r - $l);
		$this->_mtrx[y][vtcX] = 0;
		$this->_mtrx[z][vtcX] = 0;
		$this->_mtrx[w][vtcX] = 0;

		$this->_mtrx[x][vtcY] = 0;
		$this->_mtrx[y][vtcY] = 2 * $n / ($t - $b);
		$this->_mtrx[z][vtcY] = 0;
		$this->_mtrx[w][vtcY] = 0;

		$this->_mtrx[x][vtcZ] = ($r + $l) / ($r - $l);
		$this->_mtrx[y][vtcZ] = ($t + $b) / ($t - $b);
		$this->_mtrx[z][vtcZ] = -($f + $n) / ($f - $n);
		$this->_mtrx[w][vtcZ] = -1;

		$this->_mtrx[x][vtxO] = 0;
		$this->_mtrx[y][vtxO] = 0;
		$this->_mtrx[z][vtxO] = -2 * $f * $n / ($f - $n);
		$this->_mtrx[w][vtxO] = 0;
	}

	public function transformVertex($vertex)
	{
		$c = array();
		$a = array( $vertex->get('x'), $vertex->get('y'), $vertex->get('z'), $vertex->get('w') );
		$i = 0;
		foreach ($this->_mtrx as $key => $value)
		{
			$result = 0;
			$j = 0;
			foreach ($this->_mtrx[$key] as $cl => $value)
			{
				$result = $result + ($this->_mtrx[$key][$cl] * $a[$j]);
				$j++;
			}
			$c[$i] = $result;
			$i++;
		}
		$c = new Vertex( array( 'x' => $c[0], 'y' => $c[1], 'z' => $c[2], 'w' => $c[3]) );
		return ($c);
	}
}

?>
