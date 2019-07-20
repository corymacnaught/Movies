<?php
	include '../php/DataLayer/Film/FilmDAO.php';
	
	session_start();
	$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
?>

<!doctype html>
<html>
	<head>
		<title>Catalog</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/selection3.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #0f6bff;">
				<script>
					<?php if (isset($_SESSION['login'])) { ?>
						document.write('<span class="navbar-brand ml-auto">Bonjour <?php echo htmlspecialchars($_SESSION['login']->prenom) ?>!</span>');
					<?php }else{ ?>
						document.write('<a class="navbar-brand ml-auto" href="login.php">Sign In</a>');
					<?php } ?>
				</script>
			</nav>
			
			<nav class="searchnav navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #d9d9db;">
				<ul class="navbar-nav">
					<h2 class="">Films</h2>
				</ul>
				<form class="form-inline ml-auto my-lg-0">
					<input class="form-control mr-sm-2" id="movieSearch" type="text" placeholder="Search" aria-label="Search">
				</form>
			</nav>
			
			<main role="main" id="main" class="main px-5">
			</main>
		</div>
		
		<!-- jQuery -->
		<script src="../js/jquery.js"></script>
		<script src="../js/selection7.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
		
		<?php
			$filmdao = new FilmDAO();
			$filmArray = $filmdao->getAllFilm();
		?>
		<script>
			var filmArray = <?php echo json_encode($filmArray); ?>;
			fillMain(filmArray);
		</script>
	</body>
</html>