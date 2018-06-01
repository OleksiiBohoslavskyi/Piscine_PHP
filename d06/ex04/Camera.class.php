<?php

class Camera
{
	public			$vert;
	public			$matr;
	public			$width;
	public			$height;
	public			$fov;
	public			$near;
	public			$far;
	public			$tT;
	public			$tR;
	public			$vie;
	public			$proj;
	public static 	$verbose = False;

	public static function doc()
	{
		echo file_get_contents("Camera.doc.txt");
	}
	private function get_tT()
	{
		$obr = new Vector( array( 'dest' => $this->vert) );
		$obr = $obr->opposite();
		$this->tT = new Matrix(array('preset'=> Matrix::TRANSLATION, 'vtc' => $obr));
	}
	private function get_tR()
	{
		$old = $this->matr->ret_arr();
		foreach ($old as $key => $value) {
			foreach ($old[$key] as $cl => $value) {
				$this->tR[$cl][$key] = $old[$key][$cl];
			}
		}
	}
	private function mt2($one, $vtx)
	{
		$rez = $vtx;
		$k = 0;
		while ($k < 4) {
			$y = 0;
			while ($y < 4) {
				$x = 0;
				$test = 0;
				while ($x < 4) {
					$test += $one[$x][$y] * $vtx[$k][$x];
					$x++;
				}
				$rez[$k][$y] = $test;
				$y++;
			}
			$k++;
		}
		return ($rez);
	}
	private function project2($arr)
	{
		$scale = tan($arr['fov'] * 0.5 * M_PI / 180) * $arr['near'];
		$r = ($arr['width'] / $arr['height']) * $scale;
		$l = -$r;
		$t = $scale;
		$b = -$t;
		$f = $arr['far'];
		$n = $arr['near'];

		$this->proj[0][0] = 2 * $n / ($r - $l);
		$this->proj[1][0] = 0;
		$this->proj[2][0] = 0;
		$this->proj[3][0] = 0;

		$this->proj[0][1] = 0;
		$this->proj[1][1] = 2 * $n / ($t - $b);
		$this->proj[2][1] = 0;
		$this->proj[3][1] = 0;

		$this->proj[0][2] = ($r + $l) / ($r - $l);
		$this->proj[1][2] = ($t + $b) / ($t - $b);
		$this->proj[2][2] = -($f + $n) / ($f - $n);
		$this->proj[3][2] = -1;

		$this->proj[0][3] = 0;
		$this->proj[1][3] = 0;
		$this->proj[2][3] = -2 * $f * $n / ($f - $n);
		$this->proj[3][3] = 0;
	}
	public function transformVertex($matr, $vtx)
	{
		$rez = array();
		$y = 0;
		foreach ($matr as $key => $value) {
			foreach ($matr[$key] as $cl => $value) {
				if ($cl == 'vtcX')
					$dob = $vtx->get_x();
				else if ($cl == 'vtcY')
					$dob = $vtx->get_y();
				else if ($cl == 'vtcZ')
					$dob = $vtx->get_z();
				else
					$dob = $vtx->get_w();
				$rez[$y] += $matr[$key][$cl] * $dob;
			}
			$y++;
		}
		$new = new Vertex(array('x' => $rez[0], 'y' => $rez[1], 'z' => $rez[2], 'w' => $rez[3]));
		return ($new);
	}
	public function watchVertex($worldVertex)
	{
		$vtx = $this->transformVertex($this->tR, $worldVertex);
		$vtx = $this->transformVertex($this->proj, $vtx);
		$vtx = new Vertex ( array( 'x' => $vtx->get_x() * ($this->width / $this->height), 'y' => $vtx->get_y, 'z' => $vtx->get_z(), $worldVertex->get_color()));
		return ($vtx);
	}
	public function __construct($arr)
	{
		$this->vert = $arr[origin];
		$this->matr = $arr[orientation];
		$this->width = $arr[width];
		$this->height = $arr[height];
		$this->fov = $arr[fov];
		$this->near = $arr[near];
		$this->far = $arr[far];
		$this->get_tT();
		$this->get_tR();
		$this->vie = $this->mt2($this->tT->ret_arr(), $this->tR);
		$this->project2($arr);
		echo "Camera instance constructed\n";
	}
	public function __destruct()
	{
		echo "Camera instance destructed\n";
	}
	public function __toString()
	{
		$str = "Camera( \n";
		$str = $str . "+ Origine: ".$this->vert."\n";
		$str = $str . "+ tT:\n" . $this->tT."\n";
		$str .= "+ tR:\nM | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n";
		foreach ($this->tR as $key => $value) {
			if ($key == 0)
				$str .= "x";
			else if ($key == 1)
				$str .= "y";
			else if ($key == 2)
				$str .= "z";
			else if ($key == 3)
				$str .= "w";
			foreach ($this->tR[$key] as $cl => $value) {
				$str .= " | ".number_format($this->tR[$key][$cl], 2, '.', '');
			}
			$str .= "\n";
		}
		$str .= "+ tR->mult( tT ):\nM | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n";
		foreach ($this->vie as $key => $value) {
			if ($key == 0)
				$str .= "x";
			else if ($key == 1)
				$str .= "y";
			else if ($key == 2)
				$str .= "z";
			else if ($key == 3)
				$str .= "w";
			foreach ($this->vie[$key] as $cl => $value) {
				$str .= " | ".number_format($this->vie[$key][$cl], 2, '.', '');
			}
			$str .= "\n";
		}
		$str .= "+ Proj:\nM | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n";
		foreach ($this->proj as $key => $value) {
			if ($key == 0)
				$str .= "x";
			else if ($key == 1)
				$str .= "y";
			else if ($key == 2)
				$str .= "z";
			else if ($key == 3)
				$str .= "w";
			foreach ($this->proj[$key] as $cl => $value) {
				$str .= " | ".number_format($this->proj[$key][$cl], 2, '.', '');
			}
			$str .= "\n";
		}
		$str .= ")";
		return ($str);
	}
}

?>

