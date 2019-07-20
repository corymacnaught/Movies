<?php
	class CommandeVO{
		private $idCompte;
		private $idFilm;
		private $numCarte;
		private $cvv;
		
		public function CommandeVO(){
		}
		
		public function getIdCompte(){
			return $this->idCompte;
		}
		
		public function getIdFilm(){
			return $this->idFilm;
		}
		
		public function getNumCarte(){
			return $this->numCarte;
		}
		
		public function getCVV(){
			return $this->cvv;
		}
		
		public function setIdCompte($val){
			$this->idCompte = $val;
		}
		
		public function setIdFilm($val){
			$this->idFilm = $val;
		}
		
		public function setNumCarte($val){
			$this->numCarte = $val;
		}
		
		public function setCVV($val){
			$this->cvv = $val;
		}
	}
?>