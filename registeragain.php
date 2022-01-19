<?php

session_start();

if (isset($_SESSION['UUID']) && !empty($_SESSION['UUID'])) {

    require 'database.php';

    $sql = "UPDATE Immunity SET CHANGED = 1 WHERE UUID = :uuid";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':uuid', $_SESSION['UUID']);

        $stmt->execute();
        $stmt = null;
        $conn = null;
    $_SESSION['UUID'] = '';
}

header("Location: /register.php");

?>