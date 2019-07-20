<?php
	class CommandeDAO{
		
		protected $pdo;
		
		public function CommandeDAO(){
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
		
		// Création de la commande
		public function createCommande($commandeVO){
			$query = "INSERT INTO commande (idCompte, idFilm, numCarte, cvv) VALUES (:compte, :film, :carte, :cvv);";
			$prep = $this->pdo->prepare($query);
			$compte = $commandeVO->getIdCompte();
			$film = $commandeVO->getIdFilm();
			$carte = $commandeVO->getNumCarte();
			$cvv = $commandeVO->getCVV();
			$prep->bindParam(':compte', $compte);
			$prep->bindParam(':film', $film);
			$prep->bindParam(':carte', $carte);
			$prep->bindParam(':cvv', $cvv);
			$prep->execute();
		}
	}
?>