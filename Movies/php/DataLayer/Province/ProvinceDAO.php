<?php
	class ProvinceDAO{
		
		protected $pdo;
		
		public function ProvinceDAO(){
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
		
		// Retourne tout les provinces dans le pays choisi
		public function getProvinces($pays){
			$query = "SELECT province FROM province pr INNER JOIN pays pa WHERE pr.idPays = pa.idPays AND pays=:pays;";
			$prep = $this->pdo->prepare($query);
			$prep->bindParam(':pays', $pays);
			$prep->execute();
			$val = $prep->fetchAll(PDO::FETCH_OBJ);
			return $val;
		}
	}
?>