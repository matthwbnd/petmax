<?php
	$usr = "YOUR_DB_USER";
	$pass = "YOUR_DB_PASS";
	try {
		$conn = new PDO('mysql:host=YOUR_DB_HOST; dbname=YOUR_DB_NAME', $usr, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
