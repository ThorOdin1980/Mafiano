<?php
if(!defined('view')) { $output .= $noaccess; } else {

$output .= '
	<div class="content">
		<div class="heading">Vilkår og betingelser</div>
		<div class="image"><img src="/common/gfx/function_images/login.png"></div>
	';

	$get_rules = $db->prepare("SELECT * FROM `FAQ` WHERE `Id`='3'");
	$get_rules->execute();

	if($get_rules->rowCount() > 0)	{
		$rules = $get_rules->fetch();

		$output .= '<div class="text">'.$rules['Faq'].'</div>';
	} else {
		$output .= '<div class="response">Det skjedde noe feil.</div>';
	}


$output .= '</div>';
}