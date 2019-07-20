<?php
	class FilmDAO{
		
		protected $pdo;
		
		public function FilmDAO(){
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
		
		// Retourne l'information d'un film choisi
		public function getFilm($idFilm){
			$query = "SELECT idFilm, nom, prix, description FROM film WHERE idFilm=:idFilm;";
			$prep = $this->pdo->prepare($query);
			$prep->bindParam(':idFilm', $idFilm);
			$prep->execute();
			$val = $prep->fetch(PDO::FETCH_OBJ);
			return $val;
		}
		
		// Retourne l'information de tout les film contenants le mot clé choisi
		public function getFilms($nom){
			$query = "SELECT idFilm, nom FROM film WHERE nom LIKE '%' :nom '%';";
			$prep = $this->pdo->prepare($query);
			$prep->bindParam(':nom', $nom);
			$prep->execute();
			$val = $prep->fetchAll(PDO::FETCH_OBJ);
			return $val;
		}
		
		// Retourne tout les films avec le genre choisi
		//public function getFilmsGenre($genre){
		//	$query = "SELECT nom FROM film f INNER JOIN film_genre fg ON f.idFilm = fg.idFilm INNER JOIN genre g ON g.idGenre = fg.idGenre WHERE genre = 'romance'";
		//	$prep = $this->pdo->prepare($query);
		//	$prep->execute();
		//	$val = $prep->fetchAll(PDO::FETCH_OBJ);
		//	return $val;
		//}
		
		// Retourne tout les films
		public function getAllFilm(){
			$query = "SELECT idFilm, nom FROM film;";
			$prep = $this->pdo->prepare($query);
			$prep->execute();
			$val = $prep->fetchAll(PDO::FETCH_OBJ);
			return $val;
		}
	}
?>