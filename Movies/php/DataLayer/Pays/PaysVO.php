<?php
	class PaysVO{
		private $pays;
		
		public function PaysVO(){
		}
		
		public function getPays(){
			return $this->pays;
		}
		
		public function setPays($val){
			$this->pays = $val;
		}
	}
?>