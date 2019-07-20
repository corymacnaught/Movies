<?php
	include '../DataLayer/Compte/CompteDAO.php';
	
	session_start();
	
	// redirection par défaut est la page d'index
	if (!(isset($_SESSION['redirect_url']))){
		$_SESSION['redirect_url'] = '/Movies/index.php';
	}
	
	$comptedao = new CompteDAO();
	
	// Met a jour l'information du login de l'utilisateur sur le site web
	if (isset($_POST['user']) )
	{
		$username = $_POST['user'];
		$compte = $comptedao->getCompte($username);
		
		if (isset($compte)){
			$_SESSION['login'] = $compte;
		}
	}
	
	// redirige l'utilisateur
	header('Location: ' . $_SESSION['redirect_url']);
	unset($_SESSION['redirect_url']);
	exit();
?>