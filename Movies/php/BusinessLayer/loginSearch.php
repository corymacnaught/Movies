<?php
	include '../DataLayer/Compte/CompteDAO.php';
	
	$returnVal = "";
	$comptedao = new CompteDAO();
	
	// Cherche pour le compte du client dans la base de donnée
	if (isset($_POST['user']) )
	{
		$username = $_POST['user'];
		$compte = $comptedao->getCompte($username);
		
		if (isset($compte)){
			$returnVal = $compte->pass;
		}
	}
	
	echo $returnVal;
?>