<?php
	include '../DataLayer/Commande/CommandeDAO.php';
	include '../DataLayer/Commande/CommandeVO.php';
	
	session_start();
	$commandevo = new CommandeVO();
	$valide = 0;
	
	// validation de l'information rentré dans la commande
	if (isset($_SESSION['login'])){
		$commandevo->setIdCompte($_SESSION['login']->idCompte);
		
		if (isset($_SESSION['film'])){
			$commandevo->setIdFilm($_SESSION['film']->idFilm);
		
			if (isset($_POST['credit'])){
				$commandevo->setNumCarte($_POST['credit']);
			
				if (isset($_POST['cvv'])){
					$commandevo->setCVV($_POST['cvv']);
					
					// Création de la commande
					$commandedao = new CommandeDAO();
					$commandedao->createCommande($commandevo);
					
					// La commande est valide
					$valide = 1;
					
					// unset les valeur de session (évite le dédoublement des commandes)
					if (isset($_SESSION['film'])){
						$filmNom = $_SESSION['film']->nom;
						unset($_SESSION['film']);
					}
					
					if (isset($_POST['pays'])){
						$pays = $_POST['pays'];
						unset($_POST['pays']);
					}
					
					if (isset($_POST['province'])){
						$province = $_POST['province'];
						unset($_POST['province']);
					}
					
					if (isset($_POST['adresse'])){
						$adresse = $_POST['adresse'];
						unset($_POST['adresse']);
					}
					
					if (isset($_POST['codePostal'])){
						$codePostal = $_POST['codePostal'];
						unset($_POST['codePostal']);
					}
				}
			}
		}else{
			// redirige vers la page d'acceuil si les informations de la commande ne sont pas valide
			header('Location: ../../telechargement/selection.php');
			exit;
		}
	}else{
		header('Location: ../../telechargement/selection.php');
		exit();
	}
?>
<!doctype html>
<html>
	<head>
		<title id="titre">Commande</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../../css/confirmationCommande2.css" rel="stylesheet">
	</head>
	<body>
		<main role="main" class="main">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8 mt-5 py-3 px-2 rounded border border-primary" style="background-color: #fafafa;">
					<div class="row">
						<div class="col-lg-12 px-5">
							<p>Merci d'avoir choisi movie.com pour faire vos achats! Votre commande a bien été processé et est maintenant en cours de traitement. La commande devrait être livré à votre porte en deux jours.<p>
						</div>
					</div>
					<div class="row my-3">
						<div class="col-sm-4"></div>
						<div class="commande col-sm-4 text-center py-2 rounded border border-primary" style="background-color: #0f6bff;">
							<script>
								var valide = <?php echo htmlspecialchars($valide) ?>;
								if (valide) {
									document.write('<b>Voici les détails de votre commande</b><hr>');
									document.write('<p>Film: <?php echo htmlspecialchars($filmNom); ?></p>');
									document.write('<p>Pays: <?php echo htmlspecialchars($pays); ?></p>');
									document.write('<p>Province: <?php echo htmlspecialchars($province); ?></p>');
									document.write('<p>Adresse: <?php echo htmlspecialchars($adresse); ?></p>');
									document.write('<p>Code Postal: <?php echo htmlspecialchars($codePostal); ?></p>');
								}
							</script>
						</div>
						<div class="col-sm-4"></div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center px-5">
							<p>Pour retourner et commander un autre film, <a href="../../telechargement/selection.php">veuillez cliquer ici</a>
							<p>Si vous aillez des questions, appelez le numéro (123) 456-7890 pour le support de 8h à 20h EST </p>
						</div>
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
		</main>
		<div class="col-lg-2"></div>
		
		<!-- jQuery -->
		<script src="../../js/jquery.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="../../js/bootstrap.min.js"></script>
	</body>
</html>