<?php


// Function for checking usage of bot

// CREATE TABLE `botlog` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `user_id` int(11) DEFAULT NULL,
//   `username` varchar(255) DEFAULT NULL,
//   `event` varchar(255) DEFAULT NULL,
//   `comment` text,
//   `time` int(8) DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


function botcheck_add_event($userid, $username, $event, $comment, $time, $db)	{

	// Use this botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], '', '', time(), $db);

	$add_event = $db->prepare("INSERT INTO `botlog` (`user_id`, `username`, `event`, `comment`, `time`) VALUES 
													(:user_id, :username, :event, :comment, :time)");

	$add_event->bindValue(':user_id', $userid);
	$add_event->bindValue(':username', $username);
	$add_event->bindValue(':event', $event);
	$add_event->bindValue(':comment', $comment);
	$add_event->bindValue(':time', $time);

	$add_event->execute();
}

// Later there will be added a check function

function botcheck_timecheck($userid, $db)	{ // Checks wheter there is time for a botcheck
	return false;
}

function botcheck_validation($userid, $db)	{

}

function botcheck_get_form($userid, $db)	{

}

?>