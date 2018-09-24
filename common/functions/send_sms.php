<?php
if(!defined('view')) { $output .= $noaccess; } else {


	function send_sms($number, $message) {
		// Query args
		$query = http_build_query(array(
		    'token' => 'Ho-I-D2IQGiCnM7-OX_z77gFVdiiIIkdYxtoO_v905tiogvnz3T5m0WLQTp7HtGq',
		    'sender' => 'Mafia Norge',
		    'message' => $message,
		    'recipients.0.msisdn' => '47'.$number,
		));
		// Send it
		$result = file_get_contents('https://gatewayapi.com/rest/mtsms?' . $query);
		// Get SMS ids (optional)
		// print_r(json_decode($result)->ids);
	}
}