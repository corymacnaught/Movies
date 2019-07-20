<html>
	<head>
		<title>Login</title>
		
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/login1.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md navbar-light fixed-top border border-dark" style="background-color: #0f6bff;">
				<a class="navbar-brand" href="selection.php">Acceuil</a>
			</nav>
			
			<div class="col-lg-3"></div>
			<main role="main" class="main col-lg-6 text-center">
				<form id="credentialsForm" class="col-lg-12 p-5" method="POST" action="../php/BusinessLayer/loginFin.php">
					<div id="mauvaisLoginText"></div>
					<input name="user" id="user" type="text" placeholder="Nom d'Utilisateur"/> <br>
					<input name="pass" id="pass" type="password" placeholder="Mot de Passe"/> <br>
					<input type="button" id="buttonlogin" value="Login"/>
				</form>
			</main>
			<div class="col-lg-3"></div>
		</div>
		
		<!-- javascript -->
		<script src="../js/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
		<script src="../js/login4.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="../js/bootstrap.min.js"></script>
	</body>
</html>