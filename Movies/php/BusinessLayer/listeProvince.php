<?php
	include '../DataLayer/Province/ProvinceDAO.php';
	
	// query la base de données pour les provinces
	if (isset($_GET['pays'])){
		$provincedao = new ProvinceDAO();
		$provinces = $provincedao->getProvinces($_GET['pays']);
		echo json_encode($provinces);
	}
	else{
		echo "";
	}
?>