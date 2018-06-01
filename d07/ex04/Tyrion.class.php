<?php
	class Tyrion
	{
		public function sleepWith($some_class) {
			
			if (get_class($some_class) === 'Jaime')
				print "Not even if I'm drunk !\n";
			else if (get_class($some_class) === 'Sansa')
				print "Let's do this.\n";
			else if (get_class($some_class) === 'Cersei')
				print "Not even if I'm drunk !\n";
			else
				return ;
		}
	}
?>