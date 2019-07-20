<?php
	session_start();
	
	// Change la langage par défaut de l'utilisateur
	if (isset($_GET['langage'])) {
		$_SESSION['langage'] = $_GET['langage'];
	}
?>