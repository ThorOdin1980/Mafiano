<?php
	// Connect to the database


	$host = 'localhost'; // Default host is localhost
	$user = 'mafiano'; // Never use root-user
	$pass = 'mafiano';
	$dabe = 'mafiano'; // Select the correct database
	


	try {
		$db = new PDO("mysql:host=$host;dbname=$dabe", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (Exception $e) {
		die("Could not connect to server.");
	}

	?>
