<?php
	Class NightsWatch 
	{
		public function recruit($some_class) {
			if ($some_class instanceof IFighter)
				$some_class->fight();
		}
		public function fight() {
			return ;
		}
	}
?>