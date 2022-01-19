<?php

session_start();

if(!isset($_SESSION['UUID']) || empty($_SESSION['UUID'])){
	header("Location: /register.php");
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Immunity - Registrierung</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

			<section id="three" class="main style1 special">
				<div class="container">
					<header class="major">
						<h2 style="color: green;">Du hast dich erfolgreich registriert!</h2>
					</header>

	<h4><b>WICHTIG: Zeige diese Seite beim Eingang her!</b></h4>
	<h4>Ausgefuellte Daten:</h4><br>
	<p>Name: <b><?= $_SESSION['FirstName'] ?></b></p>
	<p>Nachname: <b><?= $_SESSION['LastName'] ?></b></p>
	<p>Telefonnummer: <b><?= $_SESSION['PhoneNumber'] ?></b></p><br>
	<p>Email: <b><?= $_SESSION['Email'] ?></b></p>

	<p style="color: red;">Du hast einen Fehler entdeckt?</p>
	<form action="registeragain.php">
		<input type="submit" name="sendOther" value=" Registrierung ändern ">
	</form>
				</div>
			</section>

		<!-- Footer -->
			<section id="footer">
				<ul class="copyright">
					<li>Impressum:</li>
					<li>Name</li>
					<li>City</li>
					<li>Country</li>
					<li><div class="lineSelfAdded" /></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Bernd Hatzinger</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>