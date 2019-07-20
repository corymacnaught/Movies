<?php
	class CompteDAO{
		
		protected $pdo;
		
		public function CompteDAO(){
			try {
				$strConnection = 'mysql:host=localhost;dbname=movies';
				$arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8");
				$this->pdo = new PDO($strConnection, 'root', '', $arrExtraParam);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
				catch(PDOException $e) {
					$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
						die($msg);
			}	
		}
		
		// Retourne l'information d'un compte avec le username choisi
		public function getCompte($username){
			$query = "SELECT idCompte, pass, prenom FROM compte WHERE username=:username;";
			$prep = $this->pdo->prepare($query);
			$prep->bindParam(':username', $username);
			$prep->execute();
			$val = $prep->fetch(PDO::FETCH_OBJ);
			return $val;
		}
	}
?>