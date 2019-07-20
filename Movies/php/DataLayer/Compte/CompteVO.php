<?php
	class CompteVO{
		private $username;
		private $password;
		private $prenom;
		private $nom;
		private $courriel;
		private $telephone;
		
		public function CompteVO(){
		}
		
		public function getUsername(){
			return $this->username;
		}
		
		public function getPassword(){
			return $this->password;
		}
		
		public function getPrenom(){
			return $this->prenom;
		}
		
		public function getNom(){
			return $this->nom;
		}
		
		public function getCourriel(){
			return $this->courriel;
		}
		
		public function getTelephone(){
			return $this->telephone;
		}
		
		public function setUsername($val){
			$this->username = $val;
		}
		
		public function setPassword($val){
			$this->password = $val;
		}
		
		public function setPrenom($val){
			$this->prenom = $val;
		}
		
		public function setNom($val){
			$this->nom = $val;
		}
		
		public function setCourriel($val){
			$this->courriel = $val;
		}
		
		public function setTelephone($val){
			$this->telephone = $val;
		}
	}
?>