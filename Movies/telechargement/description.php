<?php
	include '../php/DataLayer/Film/FilmDAO.php';
	
	session_start();
	$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'] . '?film=' . $_GET['film'];
	
	$filmdao = new FilmDAO();
	
	if (isset($_GET['film']) )
	{
		// query le base donnée pour l'information sur le film choisi
		$id = $_GET['film'];
		$film = $filmdao->getFilm($id);
		
		$_SESSION['film'] = $film;
	}else{
		// Si aucune film a été choisi, redirige l'utilisateur vers la page d'acceuil
		header('Location: selection.php');
		exit();
	}
?>
<html>
	<head>
		<title>Description</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/description3.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #0f6bff;">
				<a class="navbar-brand" href="selection.php">Acceuil</a>
				<script>
					<?php if (isset($_SESSION['login'])) { ?>
						document.write('<span class="navbar-brand ml-auto">Bonjour <?php echo htmlspecialchars($_SESSION['login']->prenom) ?>!</span>');
					<?php }else{ ?>
						document.write('<a class="navbar-brand ml-auto" href="login.php">Sign In</a>');
					<?php } ?>
				</script>
			</nav>
			
			<main role="main" class="main m-5">
				<div id="content" class="row">
					<div class="col-lg-5 mt-5">
						<div id="movie" class="mx-auto">
							<img id="movie-cover" class="border border-dark" src="../img/<?php echo htmlspecialchars($film->nom) ?>.jpg" alt="<?php echo htmlspecialchars($film->nom) ?>"></img>
							<div class="mt-3">
								<form class="float-right" method="GET" action="commande.php">
									<input type="submit" id="acheter" class="px-2" value="Acheter" style="background-color: #0f6bff"></input>
								</form>
								<h1 class=""><?php echo htmlspecialchars($film->nom); ?></h1>
								<h1 class=""><?php echo htmlspecialchars($film->prix); ?>$</h1>
							</div>
						</div>
					</div>
					<div id="description" class="col-lg-7 mt-5">
						<p class="mx-auto"><?php echo htmlspecialchars($film->description) ?></p>
					</div>
				</div>
			</main>
		</div>
		
		<!-- jQuery -->
		<script src="../js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>