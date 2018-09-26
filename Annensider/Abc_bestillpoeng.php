<style type="text/css">

.clear { clear:both; }

.points_buy_box {
background-color:#000;
width:489px;
margin: 0 auto;
padding:0;
margin-top:5px;

clear:both;
}

.line_points_by {
margin-top:5px;
width:489px;
}

.line_points_by:hover {
	background-color:#4a4a4c;
}

.left_text_box {
float:left;
background-color:#3a3a3c;
padding:5px;
border-bottom:1px solid #000;
height:15px;
line-height:15px;

width:150px;
color:#FFF;
}

.right_text_box {
float:right;
background-color:#3a3a3c;
padding:5px;
border-bottom:1px solid #000;
height:15px;
line-height:15px;

width:318px;

color:#FFF;

}



.form button {
	width:489px;
	height:30px;
	line-height:30px;
	margin:0 auto;


	background: #717171; /* Old browsers */
background: -moz-linear-gradient(top,  #717171 0%, #404040 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#717171), color-stop(100%,#404040)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #717171 0%,#404040 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #717171 0%,#404040 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #717171 0%,#404040 100%); /* IE10+ */
background: linear-gradient(to bottom,  #717171 0%,#404040 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#717171', endColorstr='#404040',GradientType=0 ); /* IE6-9 */


border:none;
border-bottom:1px solid #202020;
margin-top:2px;

color:#FFF;
text-transform: uppercase;
font-size:12px;
}

.form button:hover {
	font-weight:700;
}


.Div_hoyre_side_1 select	{
	background: transparent;
	width: 374px;
	font-size:13px;
	border: 0;
	padding:5px;
	-webkit-appearance: none;
	color:#FFF;
}

</style>

<div class="Div_masta">
	<div class="Div_innledning" id="Div_innleding">
		<span class="Span_str_2">Kj&oslash;p poeng</span>
	</div>
	<div class="Div_bilde">
		<img border="0" src="../Bilder/mangler_bilde.jpg">
	</div>

	<div class="clear"></div>
		
		<?php
		if(isset($_POST['buy_item']))	{


			switch($_POST['point_choice'])	{
				case 'best_gun':
					// Buys best gun
					$cost = '50'; // To be 50

					// Check if user has best weapon

					$check_if_user_has_best_weapon = mysql_query("SELECT * FROM `vapen_beskyttelse` WHERE `brukernavn`='".$brukernavn_H."' AND `utstyr`='SOPMOD M4'");

					if(mysql_num_rows($check_if_user_has_best_weapon) > 0)	{
						$response_points =  'Du har allerede SOPMOD M4.';
						$cost = '0';
					} else {
						$points_query = "INSERT INTO vapen_beskyttelse (brukernavn,utstyr,type,timestampen,dato_kjopt) VALUES ('".$brukernavn_H."','SOPMOD M4','1','".time()."','".$tid." ".$nbsp." ".$dato."')";
						$response_points = 'Du har fått SOPMOD M4. Gå til Dine Eiendeler for å aktivere!';
					}


				break;

				case 'best_defense':
					// Buys best defense
					$cost = '50'; // To be 50

					// Check if user has best protection

					$check_if_user_has_best_weapon = mysql_query("SELECT * FROM `vapen_beskyttelse` WHERE `brukernavn`='".$brukernavn_H."' AND `utstyr`='Secret Service'");

					if(mysql_num_rows($check_if_user_has_best_weapon) > 0)	{
						$response_points = 'Du har allerede Secret Service.';
						$cost = '0';

					} else {
						$points_query = "INSERT INTO vapen_beskyttelse (brukernavn,utstyr,type,timestampen,dato_kjopt) VALUES ('".$brukernavn_H."','Secret Service','2','".time()."','".$tid." ".$nbsp." ".$dato."')";
						$response_points = 'Du har fått Secret Service. Gå til Dine Eiendeler for å aktivere!';
					}


				break;
				case '20000bullets':
					// Buys 20.000 bullets
					$cost = '100';
					$kuler = $kuler + '20000';
					$points_query = "UPDATE `brukere` SET `kuler`='".$kuler."' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått '.number_format('20000').' kuler.';

				break;
				case '50000bullets':
					// Buys 50.000 bullets
					$cost = '200';
					$kuler = $kuler + '50000';
					$points_query = "UPDATE `brukere` SET `kuler`='".$kuler."' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått '.number_format('50000').' kuler.';

				break;

				case '10krespect':
					// Buys 10.000 respect
					$cost = '100';
					$respekt = $respekt + '10000';
					$points_query = "UPDATE `brukere` SET `respekt`='".$respekt."' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått '.number_format('10000').' respekt.';
				break;

				case '2millkr':
					// Buys 2.000.000 kr
					$cost = '25';
					$penger = $penger + '2000000';
					$points_query = "UPDATE `brukere` SET `penger`='".$penger."' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått '.number_format('2000000').' kr.';

				break;
				case '5millkr':
					// Buys 5.000.000 kr
					$cost = '50';
					$penger = $penger + '5000000';
					$points_query = "UPDATE `brukere` SET `penger`='".$penger."' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått '.number_format('5000000').' kr.';

				break;
				case 'planlagtrantimer':
					// Resets PR timer
					$cost = '30';
					$points_query = "UPDATE `brukere` SET `plan_tid`='0' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har nullstilt planlagt ran timer.';

				break;
				case 'reisetimer':
					// Resets flight timer
					$cost = '30';
					$points_query = "UPDATE `brukere` SET `reise_tid`='100' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har nullstilt reisetimer';

				break;
				case 'fulltliv':
					// Sets life to 100
					$cost = '30';
					$points_query = "UPDATE `brukere` SET `liv`='100' WHERE `brukernavn`='".$brukernavn_H."'";
					$response_points = 'Du har fått fullt liv.';

				break;
				case 'okerank5':
					// Raises rank 5%
					$cost = '50';

				if($rad_B['bought_rankbar'] <= time())	{ 
					
					$rankpros = $rankpros + '5';
					$time = time()+60*60*24;
					$points_query = "UPDATE `brukere` SET `rankpros`='".$rankpros."', `bought_rankbar`='".$time."' WHERE `brukernavn`='".$brukernavn_H."'";

					$response_points = 'Du har økt ranken din med 5%.';
				} else {
					$response_points = 'Du må vente til det har gått 24 timer før du kan øke ranken med 5% igjen.';
					$timelimit_rankbar = TRUE;
				}

				break;
				default:
					$cost = FALSE;
					echo '<div class="text_box">Du må velge noe å kjøpe.</div>';
				break;
			}

				if($cost != FALSE && $cost <= $turns OR $cost == '0')	{
					if(isset($timelimit_rankbar))	{
						echo '<div class="text_box">Du må vente 24 timer (Til '.date('j, M Y, H:i', $rad_B['bought_rankbar']).') før du kan øke rankbaren igjen.</div>';
					} else {
						// Remove points
						if($cost > '0')	{
							$turns = $turns - $cost;
							$remove_points = mysql_query("UPDATE `brukere` SET `turns`='".$turns."' WHERE `brukernavn`='".$brukernavn_H."'");

							// Give product
							mysql_query($points_query);
						}

						// Show message
						echo '<div class="text_box">'.$response_points.'</div>';
					}
				} else {
					echo '<div class="text_box">Du har ikke råd til å kjøpe dette.</div>';
				}
		}

		?>

	<div class="form">
		<form method="POST" action="">
			<div class="points_buy_box">

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="best_gun"> 50 Poeng
					</div>
					<div class="right_text_box">
						Kjøp beste våpen - SOPMOD M4
					</div>
				</div>



				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="best_defense"> 50 Poeng
					</div>
					<div class="right_text_box">
						Kjøp beste beskyttelse - Secret Service
					</div>
				</div>

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="2millkr"> 25 Poeng
					</div>
					<div class="right_text_box">
						Kjøp <?php echo number_format('2000000'); ?> kr
					</div>
				</div>

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="5millkr"> 50 Poeng
					</div>
					<div class="right_text_box">
						Kjøp <?php echo number_format('5000000'); ?> kr
					</div>
				</div>

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="10krespect"> 100 Poeng
					</div>
					<div class="right_text_box">
						Kjøp 10,000 Respekt
					</div>
				</div>


				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="20000bullets"> 100 Poeng
					</div>
					<div class="right_text_box">
						Kjøp 20,000 kuler
					</div>
				</div>


				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="50000bullets"> 200 Poeng
					</div>
					<div class="right_text_box">
						Kjøp 50,000 kuler
					</div>
				</div>

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="planlagtrantimer"> 30 Poeng
					</div>
					<div class="right_text_box">
						Nullstill planlagt ran timer
					</div>
				</div>

				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="reisetimer"> 30 Poeng
					</div>
					<div class="right_text_box">
						Nullstill flyplass timer
					</div>
				</div>


				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="fulltliv"> 30 Poeng
					</div>
					<div class="right_text_box">
						Fullt liv
					</div>
				</div>


				<div class="line_points_by">
					<div class="left_text_box">
						<input type="radio" name="point_choice" value="okerank5"> 50 Poeng
					</div>
					<div class="right_text_box">
						Økte rankbaren 5% (Maks en gang per 24 timer)
					</div>
				</div>


			</div>
			<button name="buy_item">Kjøp gjenstand</button>
		</form>
	</div>		
</div>
<div class="clear"></div>
<br>



<div class="Div_masta">
	<div class="Div_innledning" id="Div_innleding">
		<span class="Span_str_2">Kj&oslash;p poeng via PayPal</span>
	</div>
	<div class="clear"></div>
	<div class="text_box">
		Kjøp av poeng går til videreutvikling av spillet, og kostnadene til serveren. Se på det som i utgangspunktet en donasjon.
		Poeng som er kjøpt knytes til e-postadresse, og vil overleve èn restart av spillet.<br>
	</div>
	<div class="form">
		<?php
		if(isset($_GET['avbrutt']))	{
			echo '<div class="text_box">Du har avbrutt poenghandelen.</div>';
		}

		if(isset($_GET['suksess']))	{
					if(
					isset($_REQUEST['mc_gross']) || 
					isset($_REQUEST['mc_currency']) || 
					isset($_REQUEST['txn_id']) || 
					isset($_REQUEST['payer_id']) || 
					isset($_REQUEST['payer_status']) || 
					isset($_REQUEST['payer_email']) || 
					isset($_REQUEST['payment_date']) || 
					isset($_REQUEST['payment_status']) || 
					isset($_REQUEST['payment_type']) || 
					isset($_REQUEST['item_name']) || 
					isset($_REQUEST['first_name']) || 
					isset($_REQUEST['last_name']))	{

					// Load options on what you can buy to verify

					$load_paypal_products = mysql_query("SELECT * FROM `paypal_products` WHERE `price`='".substr($_REQUEST['mc_gross'], 0, -3)."'");
					$load_paypal_products = mysql_fetch_array($load_paypal_products);

					if(mysql_num_rows($load_paypal_products) >= 0)	{
						$paypal_product = $load_paypal_products;

						// Check if user just presses F5
						$scam_check = mysql_query("SELECT * FROM `paypal_transactions` WHERE `txn_id`='".$_REQUEST['txn_id']."'");

						if(mysql_fetch_array($scam_check) >= '1')	{
							echo '<div class="text_box">Du får bare poengene en gang.</div>';
						} else {

							echo '<div class="text_box">Du har kjøpt '.$paypal_product['points'].' poeng for '.$paypal_product['price'].' kr! Poengene skal nå være lagt til din bruker. Takk for kjøpet!</div>';

							// Add points to user
								$new_turns = $turns + $paypal_product['points'];
							$update_user_points = mysql_query("UPDATE `brukere` SET `turns`='".$new_turns."' WHERE `brukernavn`='".$brukernavn_H."'");

							$turns = $new_turns;

							// Add to paypal log
							$add_to_paypal_log = mysql_query("
								INSERT INTO `paypal_transactions` 
								(`mc_gross`, `mc_currency`, `txn_id`, `payer_id`, `payer_status`, `payer_email`, `payment_date`, `payment_status`, `payment_type`, `item_name`, `first_name`, `last_name`, `user_id`, `time`) VALUES
								(
									'".$_REQUEST['mc_gross']."',
									'".$_REQUEST['mc_currency']."',
									'".$_REQUEST['txn_id']."',
									'".$_REQUEST['payer_id']."',
									'".$_REQUEST['payer_status']."',
									'".$_REQUEST['payer_email']."',
									'".$_REQUEST['payment_date']."',
									'".$_REQUEST['payment_status']."',
									'".$_REQUEST['payment_type']."',
									'".$_REQUEST['item_name']."',
									'".$_REQUEST['first_name']."',
									'".$_REQUEST['last_name']."',
									'".$brukernavn_H."', '".time()."')
							");

						}



					} else {
						echo '<div class="text_box">Det skjedde noe feil. Ta kontakt med support.</div>';
					}					
				} else {
					echo '<div class="text_box">Det skjedde noe feil. Ta kontakt med support.</div>';
				}













		}
		

		$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
		$merchant_email = 'paypal@mafiano.no';
		$cancel_return = "http://".$_SERVER['HTTP_HOST'].'/game.php?side=Poeng&avbrutt';
		$success_return = "http://".$_SERVER['HTTP_HOST'].'/game.php?side=Poeng&suksess';
		$notify_url = "http://".$_SERVER['HTTP_HOST'].'/ipn.php';

		$select_points_options = mysql_query("SELECT * FROM `paypal_products` ORDER BY `price` ASC");
		while($products =  mysql_fetch_array($select_points_options))	{		
		?>


		<form method="POST" action="<?php echo $paypal_url; ?>">
			<input type="hidden" name="business" value="<?php echo $merchant_email; ?>" />
			<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
			<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
			<input type="hidden" name="return" value="<?php echo $success_return; ?>" />
			<input type="hidden" name="rm" value="2" />
			<input type="hidden" name="lc" value="" />
			<input type="hidden" name="no_shipping" value="1" />
			<input type="hidden" name="no_note" value="1" />
			<input type="hidden" name="currency_code" value="NOK" />
			<input type="hidden" name="page_style" value="paypal" />
			<input type="hidden" name="charset" value="utf-8" />
			<input type="hidden" name="item_name" value="<?php echo $products['points']; ?> poeng for <?php echo number_format($products['price']); ?> kroner" />
			<input type="hidden" name="cbt" value="Tilbake til MafiaNo" />
			<input type="hidden" value="_xclick" name="cmd"/>
			<input type="hidden" name="amount" value="<?php echo $products['price']; ?>" />

		    <button name="t">Kjøp <?php echo $products['points'].' poeng for '.$products['price'].' kr'; ?></button>
		</form>
		<?php
		}
		?>


	</div>
</div>
