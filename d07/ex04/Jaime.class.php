<?php
	class Jaime
	{
		public function sleepWith($some_class) {
			
			if (get_class($some_class) === 'Tyrion')
				print "Not even if I'm drunk !\n";
			else if (get_class($some_class) === 'Sansa')
				print "Let's do this.\n";
			else if (get_class($some_class) === 'Cersei')
				print "With pleasure, but only in a tower in Winterfell, then.\n";
			else
				return ;
		}
	}
?>