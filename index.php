<?php
session_start();

if(isset($_SESSION['id']))	{ header("Location: game.php"); }
include("./common/startup.php");

define('view', true); // All files loaded through index.php is allowed to show - put this line in index.php as well

/* CODE FOR ACTIVATING USER 
    $Kode = Mysql_Klar($_REQUEST['Kode']);
	$BrukerID = Bare_Siffer(Mysql_Klar($_REQUEST['Koden']));
	if(!empty($Kode) && !empty($BrukerID)) { 
	$Eks = mysql_query("SELECT * FROM brukere WHERE brukerid='$BrukerID' AND passord='$Kode' AND aktivert='0'");
	if(mysql_num_rows($Eks) == '0') { echo PrintTeksten("Brukeren er allerede aktivert.","1","Feilet"); } else { 
	mysql_query("UPDATE brukere SET aktivert='1' WHERE brukerid='$BrukerID' AND passord='$Kode'");
	echo PrintTeksten("Brukeren er aktivert.","1","Vellykket");
	}}
*/


$output = '
<!DOCTYPE HTML>
<html lang="no">
 	<head>
	    
	    <meta charset="UTF-8">
		<title>MafiaNo - Mafia Norge</title>

		<link rel="stylesheet" type="text/css" href="/common/css/style.css">
		<link rel="stylesheet" type="text/css" href="/common/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/common/css/login.css">

		<!-- Meta -->
		<meta name="description" content="Mafiano er et norsk tekstbasert mafia spill hvor du lever mafia livet og figther om og bli den mektigste don. Spillet innholder vold så tenk deg om." />
		<meta name="keywords" content="mafia, mafiano, norsk spill, tekstbasert, Havers, mafia, game, gangster" />
		<meta name="robots" content="ALL INDEX" />
		<meta name="author" content="Havers; http://www.mafiano.no" /><!-- Css -->
		<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
	</head>
	<body>
		<div class="frame">
			<div class="frame_content">
				<div class="margin_10"></div>
				<div class="banner">
				</div>
				<div class="margin_10"></div>


				<div class="left_menu">
					<div class="menu_item">
						<div class="title">Meny</div>
						<ul>
							<a href="?function=login&file=login"><li>Logg inn</span></li></a>
							<a href="?function=login&file=register"><li>Bli medlem</span></li></a>
							<a href="?function=login&file=forgottenpw"><li>Glemt passord</span></li></a>
							<!-- <a href="?function=login&file=kontaktoss"><li>Kontakt oss</li></a> -->
							<a href="?function=system&file=vilkar_og_betingelser"><li>Vilkår og Betingelser</li></a>
						</ul>
					</div>
				</div>


				<div class="center_content">
					<div class="center_item">
						<div class="title">Innhold</div>
						';

						// Check if user is IP-banned

				        $check_ban = $db->prepare("SELECT * FROM `IpBan` WHERE `IpAdresse`=:ipadress AND `Tidslengde` > :timelimit");
				        $check_ban->bindValue(':ipadress', $_SERVER['REMOTE_ADDR']);
				        $check_ban->bindValue(':timelimit', time());
				        $check_ban->execute();

				        if($check_ban->rowCount() > 0)  {
				            $output .= '<div class="response">IP-adressen du bruker er utestengt.</div>';
						} else {
        			include("./common/router.php");
        				}

						$output .= '
						<div class="bottom"></div>
					</div>
				</div>


				<div class="right_menu">
					<div class="menu_item">
						<div class="title">Statistikk</div>
						<div class="image">
							<img src="/common/gfx/login_stats.png">
						</div>
						<div class="text">
							<p>';

							$count_users = $db->prepare("SELECT * FROM `brukere` WHERE `type` != 'b'");
							$count_users->execute();

							$count_online_users = $db->prepare("SELECT * FROM `brukere` WHERE `aktiv_eller` > :time");
							$count_online_users->bindValue(':time', time());
							$count_online_users->execute();


							$output .= '
								<dt>- - - - - -</dt><dd>&nbsp;</dd>
							 	<dt>Medlemmer:&nbsp;</dt><dd>'.number_format($count_users->rowCount()).' stk</dd>
							 	<dt>Pålogget nå:&nbsp;</dt><dd>'.number_format($count_online_users->rowCount()).' stk</dd>
							 	<dt>- - - - - -</dt><dd>&nbsp;</dd>
							</p>
						</div>
						
					</div>
				</div>
				<div class="margin_10"></div>
			</div>
		</div>
	</body>
</html>
';




echo $output;
?>