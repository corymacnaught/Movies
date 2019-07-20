<?php
	include '../DataLayer/Film/FilmDAO.php';
	
	$filmdao = new FilmDAO();
	
	// query la base donnée pour une liste de films contenant le mot clé choisi
	if (isset($_GET['search']) )
	{
		$search = $_GET['search'];
		$films = $filmdao->getFilms($search);
		
		echo json_encode($films);
	}
?>