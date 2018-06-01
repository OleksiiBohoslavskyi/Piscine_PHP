<?php
	class UnholyFactory
	{
		private	$_war = array();
		private	$_arm = array();
		public function absorb($soldier) {
			if (get_parent_class($soldier)) {
				if (get_class($soldier) == "Footsoldier")
					$name = "foot soldier";
				else if (get_class($soldier) == "Archer")
					$name = "archer";
				else if (get_class($soldier) == "Assassin")
					$name = "assassin";
				else
					$name = "crippled soldier";
				if (array_search($soldier, $this->_war) === false) {
					$this->_war[$name] = $soldier;
					array_push($this->_arm, $name);
					echo "(Factory absorbed a fighter of type $name)\n";
				}
				else {
				echo "(Factory already absorbed a fighter of type $name)\n";
				}
			}
			else {
				echo "(Factory can't absorb this, it's not a fighter)\n";
			}
		}
		public function fabricate($soldier) {
			if (array_search($soldier, $this->_arm) !== false) {
				echo "(Factory fabricates a fighter of type $soldier)\n";
				return ($this->_war[$soldier]);
			}
			else {
				echo "(Factory hasn't absorbed any fighter of type $soldier)\n";
				return (NULL);
			}
		}
		public function __construct() {
		}
	}

?>