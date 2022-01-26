<?php

session_start();

if(isset($_SESSION['UUID']) && !empty($_SESSION['UUID'])){
	header("Location: /registered.php");
}

$message = '';

function storeFormInput() {
	$_SESSION['FirstName'] = $_POST['firstName'];
	$_SESSION['LastName'] =  $_POST['lastName'];
	$_SESSION['Email'] = $_POST['email'];
	$_SESSION['PhoneNumber'] = $_POST['phoneNumber'];
}

if(!isset($_POST['submit'])) {
	$first = true;
}

	if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['phoneNumber']) && !empty($_POST['dsvgo'])):
	
		try
		{
			require 'database.php';

		$uidQuery = "SELECT UUID()";
		$uuidC = $conn->query($uidQuery);
		$uuidArray = $uuidC->fetchAll()[0];
		$uuid = $uuidArray[0];
	
		$sql = "INSERT INTO Immunity (UUID, FIRST_NAME, LAST_NAME, EMAIL, PHONENUMBER) VALUES (:uuid, :firstName, :lastName, :email, :phoneNumber)";
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam(':uuid', $uuid);
		$stmt->bindParam(':firstName', $_POST['firstName']);
		$stmt->bindParam(':lastName', $_POST['lastName']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->bindParam(':phoneNumber', $_POST['phoneNumber']);
	
		if($stmt->execute()):
			$_SESSION['UUID'] = $uuid;
			storeFormInput();
			$stmt = null;
			$conn = null;
			header("Location: /registered.php");
		else:
			$message = 'Es is ein unbekannter Fehler aufgetreten!';
		endif;
	}
	catch(Exception $e) {
		$message = $e->getMessage();
	}
	elseif(!$first):
		$message = 'Es wurden nicht alle benötigten Informationen ausgefüllt!';
		storeFormInput();
	else:
		$first = false;
	endif;

?>


<!DOCTYPE HTML>
<html>

<head>
    <title>Immunity - Registrierung</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">

    <!-- Three -->
    <section id="three" class="main style1 special">
        <div class="container">
            <header class="major">
                <h2>Immunity COVID Registrierung</h2>
            </header>
            <p>Bitte die folgenden Felder ausfüllen:</p>

            <form action="register.php" method="POST">

                <input type="text" placeholder="Vorname" name="firstName" value="<?= $_SESSION['FirstName'] ?>"><br>
                <input type="text" placeholder="Nachname" name="lastName" value="<?= $_SESSION['LastName'] ?>"><br>
                <input type="text" placeholder="Telefon Nummer" name="phoneNumber"
                    value="<?= $_SESSION['PhoneNumber'] ?>"><br>
                <input type="text" placeholder="Email (optional)" name="email" value="<?= $_SESSION['Email'] ?>"><br>
                <div>
                    <input type="checkbox" id="dsvgo" name="dsvgo">
                    <label for="dsvgo"><a href="dsvgo.php">Hiermit bestetige ich, dass ich die
                            <b>Datenschutzbestimmungen</b> durchgelesen und verstanden habe. (Klicke hier um zu den
                            Datenschutzbestimmungen zu kommen)</a></label>
                </div>
                <input type="submit" name="submit" value="Daten absenden">

            </form><br>

            <?php if(!empty($message)): ?>
            <p style="color: red;"><b><?= $message ?></b></p>
            <?php endif; ?>

        </div>
    </section>

    <!-- Footer -->
    <section id="footer">
        <ul class="copyright">
            <li>Impressum:</li>
            <li>Name</li>
            <li>City</li>
            <li>Country</li>
            <li>
                <div class="lineSelfAdded" />
            </li>
        </ul>
        <ul class="copyright">
            <li>&copy; Bernd Hatzinger</li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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