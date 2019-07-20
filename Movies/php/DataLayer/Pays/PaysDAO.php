<?php
	class PaysDAO{
		
		protected $pdo;
		
		public function PaysDAO(){
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
		
		// Retourne tout les pays
		public function getAllPays(){
			$query = "SELECT pays FROM pays;";
			$prep = $this->pdo->prepare($query);
			$prep->execute();
			$val = $prep->fetchAll(PDO::FETCH_OBJ);
			return $val;
		}
	}
?>