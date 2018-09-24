<?php
if(!defined('view') or isset($_SESSION['id'])) { $output .= $noaccess; } else {

$output .= '
	<div class="content">
		<div class="heading">Glemt passord</div>
		<div class="image"><img src="/common/gfx/function_images/login.png"></div>
	';

	if(isset($_POST['newpw']))	{
		if(isset($_POST['email']))	{
			if(!empty($_POST['email']))	{
				// verify email exist and user alive
				$verify_email = $db->prepare("SELECT * FROM `brukere` WHERE `email`=:email AND `liv` > 0");
				$verify_email->bindValue(':email', $_POST['email']);
				$verify_email->execute();

				if($verify_email->rowCount() > 0)	{
					$forgotteninfo = $verify_email->fetch();

					$new_password = substr(md5(md5(md5($forgotteninfo['passord']))), 0, 8);

			        $email_M = "Support@mafiano.no";
			        $subject = "Glemt Passord";
			        $message = '
			        En fra følgende ip har bedt om nytt passord '.$_SERVER['REMOTE_ADDR'].'.
			        
			        Brukernavn: '.$forgotteninfo['brukernavn'].'
			        Nytt passord: '.$new_password;
			        mail($emailen, $subject, $message, "From: $email_M");

			        $update_user = $db->prepare("UPDATE `brukere` SET `passord`=:new_password WHERE `brukerid`=:userid");
			        $update_user->bindValue(':new_password', md5($new_password));

			        $output .= '<div class="response">Instruksjoner for å logge inn med nytt passord er sendt til din e-postadresse.</div>';

				} else {
					$output .= '<div class="response">Ugyldig e-post eller brukeren er død.</div>';
				}
			} else {
				$output .= '<div class="response">Du må fylle ut en e-post.</div>';
			}
		} else {
			$output .= '<div class="response">Du må fylle ut en e-post.</div>';
		}
	}

$output .= '
		<div class="form">
		<form method="POST" action="">
			<div class="left">E-post</div>
			<div class="right"><input type="text" name="email"></div>
			<div class="clear"></div>
			
			<button name="newpw">Få nytt passord!</button>
			<div class="clear"></div>
		</form>
		</div>';

$output .= '</div>';
}