<?php
	session_start();
	$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
	
	// Langage par défaut est le français
	if (empty($_SESSION['langage'])){
		$_SESSION['langage'] = "fr";
	}
?>
<!doctype html>
<html>
	<head>
		<title id="titre"></title>
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/index6.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #0f6bff;">
			<script>
				<?php if (isset($_SESSION['login'])) { ?>
					document.write('<span class="navbar-brand ml-auto">Bonjour <?php echo htmlspecialchars($_SESSION['login']->prenom) ?>!</span>');
				<?php }else{ ?>
					document.write('<a class="navbar-brand ml-auto" href="telechargement/login.php">Sign In</a>');
				<?php } ?>
			</script>
		</nav>
		
		<main role="main" class="main mt-5">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 mt-5 mb-3 p-2 rounded border border-primary" style="background-color: #dfdfdf;">
					<div class="row">
						<div class="col-sm-12 ml-2">
							<button id="boutonLocalisation" value="<?php echo htmlspecialchars($_SESSION['langage']) ?>"></button>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 px-5 text-center">
							<h1 id="head" class=""></h1>
							<h2 id="description"></h2>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8 text-center" style="min-height: 50px;">
							<a id="selection" href="telechargement/selection.php"></a>
							<hr>
							<h3 id="releases"></h3>
							<div class="row">
								<div class="slideshow m-auto">
									
									<!-- source: https://www.w3schools.com/howto/howto_js_slideshow.asp -->
									<!-- Full-width images with number and caption text -->
									<div class="mySlides">
										<div class="numbertext">1 / 3</div>
										<img class="movie-cover" src="img/The Godfather.jpg">
									</div>

									<div class="mySlides">
										<div class="numbertext">2 / 3</div>
										<img class="movie-cover" src="img/The Dark Knight.jpg">
									</div>

									<div class="mySlides">
										<div class="numbertext">3 / 3</div>
										<img class="movie-cover" src="img/The Shawshank Redemption.jpg">
									</div>
									<br>
								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-right">
							<h4 id="droits"></h4>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</main>
		
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<script type="text/javascript" src="js/JSON/Localisation1.json"></script>
		<script src="js/index8.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		
		<script>changerLangage($('#boutonLocalisation').val())</script>
		
	</body>
</html>