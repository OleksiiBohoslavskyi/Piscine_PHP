<?php

class Matrix
{
	const	IDENTITY = 'IDENTITY';
	const	SCALE = 'SCALE';
	const	RX = 'RX';
	const	RY = 'RY';
	const	RZ = 'RZ';
	const	TRANSLATION = 'TRANSLATION';
	const	PROJECTION = 'PROJECTION';
	private	$_mat;
	public static 	$verbose = False;

	public static function doc()
	{
		echo file_get_contents("Matrix.doc.txt");
	}
	public function mult($rhs)
	{
		$new = new Matrix( array( 'preset' => 'MULT' ) );
		$arr = array();
		$y = 0;
		foreach ($this->_mat as $key => $value) {
			$x = 0;
			foreach ($this->_mat[$key] as $cl => $value) {
				$arr[$y][$x] = $this->_mat[$key][$cl];
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
			foreach ($rhs->_mat[x] as $cl => $value) {
				$x = 0;
				foreach ($rhs->_mat as $key => $value) {
					$rez[$k][$y] += $rhs->_mat[$key][$cl] * $arr[$k][$x];
					$x++;
				}
				$y++;
			}
			$k++;
		}
		$y = 0;
		$cl = 0;
		$key = 0;
		foreach ($new->_mat as $key => $value) {
			$x = 0;
			foreach ($new->_mat[$key] as $cl => $value) {
				$new->_mat[$key][$cl] = $rez[$y][$x];
				$x++;
			}
			$y++;
		}
		return ($new);
	}
	public function mt($vtx)
	{
		$rez = array();
		$k = 0;
		while ($k < 4) {
			$y = 0;
			foreach ($this->_mat[x] as $cl => $value) {
				$x = 0;
				foreach ($this->_mat as $key => $value) {
					$rez[$k][$y] += $this->_mat[$key][$cl] * $vtx[$k][$x];
					$x++;
				}
				$y++;
			}
			$k++;
		}
		$y = 0;
		foreach ($this->_mat as $key => $value) {
			$x = 0;
			foreach ($this->_mat[$key] as $cl => $value) {
				$this->_mat[$key][$cl] = $rez[$y][$x];
				$x++;
			}
			$y++;
		}
	}
	public function transformVertex($vtx)
	{
		$rez = array();
		$y = 0;
		foreach ($this->_mat as $key => $value) {
			foreach ($this->_mat[$key] as $cl => $value) {
				if ($cl == 'vtcX')
					$dob = $vtx->get('x');
				else if ($cl == 'vtcY')
					$dob = $vtx->get('y');
				else if ($cl == 'vtcZ')
					$dob = $vtx->get('z');
				else
					$dob = $vtx->get('w');
				$rez[$y] += $this->_mat[$key][$cl] * $dob;
			}
			$y++;
		}
		$new = new Vertex(array('x' => $rez[0], 'y' => $rez[1], 'z' => $rez[2], 'w' => $rez[3]));
		return ($new);
	}
	public function mult_Vector($vect)
	{
		$this->_mat[x][vtxO] = $vect->get('x');
		$this->_mat[y][vtxO] = $vect->get('y');
		$this->_mat[z][vtxO] = $vect->get('z');
	}
	private function get_rot($arr)
	{
		$cos = cos($arr[angle]);
		$sin = sin($arr[angle]);
		if ($arr[preset] == 'RX') {
			$turn = array('0' => array('0' => 1.0, '1' => 0.0, '2' => 0.0, '3' => 0.0),
				'1' => array('0' => 0.0, '1' => $cos, '2' => -$sin, '3' => 0.0),
				'2' => array('0' => 0.0, '1' => $sin, '2' => $cos, '3' => 0.0),
				'3' => array('0' => 0.0, '1' => 0.0, '2' => 0.0, '3' => 1.0));
		}
		else if ($arr[preset] == 'RY') {
			$turn = array('0' => array('0' => $cos, '1' => 0.0, '2' => $sin, '3' => 0.0),
				'1' => array('0' => 0.0, '1' => 1.0, '2' => 0.0, '3' => 0.0),
				'2' => array('0' => -$sin, '1' => 0.0, '2' => $cos, '3' => 0.0),
				'3' => array('0' => 0.0, '1' => 0.0, '2' => 0.0, '3' => 1.0));
		}
		else if ($arr[preset] == 'RZ') {
			$turn = array('0' => array('0' => $cos, '1' => -$sin, '2' => 0.0, '3' => 0.0),
				'1' => array('0' => $sin, '1' => $cos, '2' => 0.0, '3' => 0.0),
				'2' => array('0' => 0.0, '1' => 0.0, '2' => 1.0, '3' => 0.0),
				'3' => array('0' => 0.0, '1' => 0.0, '2' => 0.0, '3' => 1.0));
		}
		$this->mt($turn);
	}
	public function project($arr)
	{
		$scale = tan($arr['fov'] * 0.5 * M_PI / 180) * $arr['near'];
		$r = $arr['ratio'] * $scale;
		$l = -$r;
		$t = $scale;
		$b = -$t;
		$f = $arr['far'];
		$n = $arr['near'];

		$this->_mat[x][vtcX] = 2 * $n / ($r - $l);
		$this->_mat[y][vtcX] = 0;
		$this->_mat[z][vtcX] = 0;
		$this->_mat[w][vtcX] = 0;

		$this->_mat[x][vtcY] = 0;
		$this->_mat[y][vtcY] = 2 * $n / ($t - $b);
		$this->_mat[z][vtcY] = 0;
		$this->_mat[w][vtcY] = 0;

		$this->_mat[x][vtcZ] = ($r + $l) / ($r - $l);
		$this->_mat[y][vtcZ] = ($t + $b) / ($t - $b);
		$this->_mat[z][vtcZ] = -($f + $n) / ($f - $n);
		$this->_mat[w][vtcZ] = -1;

		$this->_mat[x][vtxO] = 0;
		$this->_mat[y][vtxO] = 0;
		$this->_mat[z][vtxO] = -2 * $f * $n / ($f - $n);
		$this->_mat[w][vtxO] = 0;
	}
	private function get__matrix($arr)
	{
		$this->_mat = array('x' => array('vtcX' => 1.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO' => 0.0),
			'y' => array('vtcX' => 0.0, 'vtcY' => 1.0, 'vtcZ' => 0.0, 'vtxO' => 0.0),
			'z' => array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 1.0, 'vtxO' => 0.0),
			'w' => array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO' => 1.0));
		if ($arr[preset] == 'SCALE') {
			foreach ($this->_mat as $key => $value) {
				if ($key != 'w') {
					foreach ($this->_mat[$key] as $vt => $value) {
						$this->_mat[$key][$vt] = $this->_mat[$key][$vt] * $arr[scale];
					}
				}
			}
		}
		else if ($arr[preset] == 'RX' || $arr[preset] == 'RY' || $arr[preset] == 'RZ')
			$this->get_rot($arr);
		else if ($arr[preset] == 'TRANSLATION')
			$this->mult_Vector($arr[vtc]);
		else if ($arr[preset] == 'PROJECTION')
			$this->project($arr);
	}
	public function __construct($arr)
	{
		$this->get__matrix($arr);
		if (self::$verbose === true && $arr[preset] != "MULT")
		{
			if ($arr[preset] == 'IDENTITY')
				echo "Matrix $arr[preset] instance constructed\n";
			if ($arr[preset] == 'RX')
				echo "Matrix Ox ROTATION preset instance constructed\n";
			else if ($arr[preset] == 'RY')
				echo "Matrix Oy ROTATION preset instance constructed\n";
			else if ($arr[preset] == 'RZ')
				echo "Matrix Oz ROTATION preset instance constructed\n";
			else
				echo "Matrix $arr[preset] preset instance constructed\n";
		}
	}
	public function __destruct()
	{
		if (self::$verbose === true)
			echo "Matrix instance destructed\n";
	}
	public function __toString()
	{
		$str = "M";
		foreach ($this->_mat[x] as $key => $value) {
			$str = $str. " | $key";
		}
		$str = $str. "\n-----------------------------\n";
		foreach ($this->_mat as $key => $value) {
			$str = $str."$key";
			foreach ($this->_mat[$key] as $vt => $value) {
				$str = $str." | ".number_format((float)$this->_mat[$key][$vt], 2, '.', '');
			}
			if ($key != 'w')
				$str = $str."\n";
		}
		return ($str);
	}
	public function ret_arr()
	{
		$ret = array();
		$y = 0;
		foreach ($this->_mat as $key => $value) {
			$x = 0;
			foreach ($this->_mat[$key] as $cl => $value) {
				$ret[$y][$x] = $this->_mat[$key][$cl];
				$x++;
			}
			$y++;
		}
		return ($ret);
	}
}

?>

