<?php
	if(!defined('view') || !isset($_SESSION['id'])) { $output .= $noaccess; } else {
		if($userinfo['user_verified'] == '1') {
      		include("./common/router.php");
    	} else {
    		// User not verified, veryify;
    		  /* //   `user_verified` int(1) DEFAULT '0',
				  `user_verified` int(1) DEFAULT '0',
				  `phone_number` int(8) DEFAULT NULL,
				  `verification_code` varchar(8) DEFAULT NULL,
				  `verification_code_generated_time` int(8) DEFAULT NULL,
				  `verification_code_used` int(8) DEFAULT NULL, */


			$output .= '<div class="content">
				<div class="heading">Brukerverifikasjon</div>
				<div class="text">For å sikre en bruker per person, er det innført verifikasjon med telefonnummer.
				Her kan du legge inn telefonnummeret ditt, og få tilsendt en verifikasjonskode for å fortsette å spille. Å motta denne meldingen koster ingenting. Skulle du få problemer under verifisering, send PM til Havers. Du har fortsatt tilgang på PM-funksjonen.</div>';

				if($userinfo['phone_number'] == NULL)	{
					// No phone number registered, user must add

					if(isset($_POST['add_number']))	{
						if(strlen(intval($_POST['phonenumber'])) == 8)	{
							// Generate verificaton code
							$verification_code = rand(11111, 99999);

							// check if phonenumber is in use

							$check_phone_number = $db->prepare("SELECT * FROM `brukere` WHERE `phone_number`=:phone_number AND `liv`>0");
							$check_phone_number->bindValue(':phone_number', intval($_POST['phonenumber']));
							$check_phone_number->execute();

							if($check_phone_number->rowCount() > 0)	{
								$output .= '<div class="text">Dette telefonnummeret brukes allerede av en annen bruker.</div>';
							} else {

								// update phonenumber for user, send code and update token
								$update_phonenumber = $db->prepare("UPDATE `brukere` SET `phone_number`=:phone_number, `verification_code`=:verification_code, `verification_code_generated_time`=:time WHERE `brukerid`=:userid");
								$update_phonenumber->bindValue(':phone_number', intval($_POST['phonenumber']));
								$update_phonenumber->bindValue(':verification_code', $verification_code);
								$update_phonenumber->bindValue(':time', time());
								$update_phonenumber->bindValue(':userid', $_SESSION['id']);
								$update_phonenumber->execute();

								// Send sms
								function_include("send_sms");
								$sms_message = 'Velkommen til Mafia Norge. Din verifikasjonskode er '.$verification_code.'. Skriv den inn i vinduet på nettsiden for å spille! Mvh MafiaNo';
								send_sms(intval($_POST['phonenumber']), $sms_message);
								$userinfo['verification_code'] = $verification_code;
							}

						} else {
							$output .= '<div class="text">Du skrev inn et ugyldig nummber.</div>';
						}

					}
					if($userinfo['verification_code'] == NULL)	{ // IF user has added number right now
						$output .= '
						<div class="text">Skriv inn ditt norske telefonnummer, åtte siffer.</div>
						<form method="POST" action="">
						<div class="form">
							<div class="left">Telefonnummer</div>
							<div class="right"><input type="text" name="phonenumber" maxlength="8"></div>
							<div class="clear"></div>

							<button name="add_number">Få tilsendt verifikasjonskode</button>

						</div>
						</form>';
					}
				} 

				if($userinfo['verification_code'] != NULL)	{

					if(isset($_POST['verify_user']))	{
						if($userinfo['verification_code'] == $_POST['verify_code'])	{
							// Verify user
							$verify_user = $db->prepare("UPDATE `brukere` SET `user_verified`='1', `verification_code_used`=:time WHERE `brukerid`=:userid");
							$verify_user->bindValue(':time', time());
							$verify_user->bindValue(':userid', $_SESSION['id']);
							$verify_user->execute();

							$output .= '<div class="text">Du har verifisert brukeren din!</div>';
							header("Location: game.php");

						} else {
							$output .= '<div class="text">Du har skrevet inn feil verifikasjonskode. Hvis du har skrevet inn feil telefonnummer, ta kontakt med Havers på pm.</div>';
						}
					}

					$output .= '
					<div class="text">Skriv inn verifikasjonskoden du fikk på SMS.</div>
					<form method="POST" action="">
					<div class="form">
						<div class="left">Verifikasjonskode</div>
						<div class="right"><input type="text" name="verify_code" maxlength="6"></div>
						<div class="clear"></div>

						<button name="verify_user">Verifiser brukeren din</button>

					</div>
					</form>';
				}

			$output .= '</div>';
    	}
	}
?>