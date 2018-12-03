<?php

	date_default_timezone_set('Europe/Oslo');
	


	// Key to stop CSRF
	if(!isset($_SESSION['CSRF_KEY']))	{
		$_SESSION['CSRF_KEY'] = MD5(rand(0,100000));
	}

	// Connect to database
	include("./common/database.php");

	// Load function, the rest of the functions should be in /common/functions folder
	function function_include($value)	{
		if(!file_exists('./common/functions/'.$value.'.php'))	{
			echo '<div class="response">Funksjonen '.$value.' kunne ikke lastes.</div>';
		} else {
			include_once('./common/functions/'.$value.'.php');
		}
	}

	$functions = array("botcheck"); // Move to index.php when time is there

	// Autoload functions at startup
	foreach($functions as $id => $function)	{	function_include($function);	} // Include functions

	// Get userinfo 

	if(isset($_SESSION['id']))	{
		$userinfo_query = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:id");
		$userinfo_query->bindValue(':id', $_SESSION['id']);
		$userinfo_query->execute();

		if($userinfo_query->rowCount() > 0)	{
			$userinfo = $userinfo_query->fetch();

			// Can now get userinfo via $userinfo
		} else {
			echo 'Noe galt skjedde.';
		}
	}

	$noaccess = '<div class="response">Du har ikke tilgang til denne siden.</div>';






?>
