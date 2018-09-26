<?php
	// Connect to the database


	#$host = 'localhost'; // Default host is localhost
	#$user = 'mafianon_demo'; // Never use root-user
	#$pass = 'lzALD7X)3,?D';
	#$dabe = 'mafianon_demo'; // Select the correct database

	$host = 'localhost'; // Default host is localhost
	$user = 'root'; // Never use root-user
	$pass = 'root';
	$dabe = 'mafiano'; // Select the correct database
	
	#$host = 'mafiano.no'; // Default host is localhost
	#$user = 'mafiano_old'; // Never use root-user
	#$pass = 'bauervapor';
	#$dabe = 'mafiano_old'; // Select the correct database


	


	try {
		$db = new PDO("mysql:host=$host;dbname=$dabe", $user, $pass);
	} catch (Exception $e) {
		die("Could not connect to server.");
	}

	?>
