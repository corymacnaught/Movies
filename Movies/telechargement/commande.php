<?php
	include '../php/DataLayer/Pays/PaysDAO.php';
	$paysdao = new PaysDAO();
	$pays = $paysdao->getAllPays();
	
	session_start();
	
	// Redirige l'utilisateur vers l'acceuil si aucunes films a été choisi
	if (isset($_SESSION['film'])) {
		$film = $_SESSION['film'];
	}else {
		header('Location: selection.php');
		exit();
	}
	
	// Redirige l'utilisateur vers la page de login s'il n'est pas authentifier
	if (empty($_SESSION['login'])){
		$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
		header('Location: login.php');
		exit();
	}
?>
<html>
	<head>
		<title>Commande</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/commande2.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #0f6bff;">
				<a class="navbar-brand" href="selection.php">Acceuil</a>
				<script>
					<?php if (isset($_SESSION['login'])) { ?>
						document.write('<span class="navbar-brand ml-auto">Bonjour <?php echo htmlspecialchars($_SESSION['login']->prenom) ?>!</span>');
					<?php } ?>
				</script>
			</nav>
			
			<main role="main" class="main m-5">
				<div id="content" class="row">
					<div class="col-lg-5 mt-5 py-3">
						<div id="movie" class="mx-auto">
							<img id="movie-cover" class="border border-dark" src="../img/<?php echo htmlspecialchars($film->nom) ?>.jpg" alt="<?php echo htmlspecialchars($film->nom) ?>"></img>
							<div class="row">
								<h1 class="col-sm-9"><?php echo htmlspecialchars($film->nom); ?></h1>
								<h1 class="col-sm-3"><?php echo htmlspecialchars($film->prix); ?>$</h1>
							</div>
						</div>
					</div>
					<div id="description" class="col-lg-7 mt-5">
						<form class="col-lg-12 mx-auto" id="commande" method="POST" action="../php/BusinessLayer/creeCommande.php">
							<div class="row">
								<div class="col-sm-6 float-left">
									<div class="col-sm-3 float-left">
										<p class="float-right">Pays</p>
									</div>
									<select class="col-sm-9" id="pays" name="pays">
										<option value="Aucune">Aucune</option>
										<script>
											var paysArray = <?php echo json_encode($pays); ?>;
											paysArray.forEach(function(val){
												document.write('<option value="' + val.pays + '">' + val.pays + '</option>');
											});
										</script>
									</select>
								</div>
								<div class="col-sm-6 ml-auto">
									<div class="col-sm-3 float-left">
										<p class="float-right" name="provinceText" id="provinceText" >Province</p>
									</div>
									<select class="col-sm-9" id="province" name="province" disabled>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 float-left">
									<div class="col-sm-3 float-left">
										<p class="float-right">Adresse</p>
									</div>
									<input class="col-sm-9" id="adresse" name="adresse" type="text"/>
								</div>
								<div class="col-sm-6 ml-auto">
									<div class="col-sm-3 float-left">
										<p class="float-right" name="codePostalText" id="codePostalText" >Code Postal</p>
									</div>
									<input class="col-sm-9" id="codePostal" name="codePostal" type="text"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 float-left">
									<div class="col-sm-3 float-left">
										<p class="float-right"># Crédit</p>
									</div>
									<input class="col-sm-9" id="credit" name="credit" type="text"/>
								</div>
								<div class="col-sm-6 ml-auto">
									<div class="col-sm-3 float-left">
										<p class="float-right">CVV</p>
									</div>
									<input class="col-sm-9" id="cvv" name="cvv" type="text"/>
								</div>
							</div>
							<input class="float-right" type="submit" id="acheter" class="px-2" value="Acheter" style="background-color: #0f6bff"></input>
						</form>
					</div>
				</div>
			</main>
		</div>
		
		<!-- javascript -->
		<script src="../js/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
		<script src="../js/commande7.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>