<?php
	class FilmVO{
		private $nom;
		private $prix;
		private $description;
		
		public function FilmVO(){
		}
		
		public function getNom(){
			return $this->nom;
		}
		
		public function getPrix(){
			return $this->prix;
		}
		
		public function getDescription(){
			return $this->description;
		}
		
		public function setNom($val){
			$this->nom = $val;
		}
		
		public function setPrix($val){
			$this->prix = $val;
		}
		
		public function setDescription($val){
			$this->description = $val;
		}
	}
?>