<?php
ob_start();
session_start(); 

include("./common/startup.php");

define('view', true); // All files loaded through index.php is allowed to show - put this line in index.php as well
$output = '';


require "db.php"; // OLd db login is depricated
include("./common/functions/old_functions.php"); // Will be depricated

if(isset($_SESSION['id']))  {


// Update last active
$update_last_active = $db->prepare("UPDATE `brukere` SET `last_active`=:time WHERE `brukerid`=:userid");
$update_last_active->bindValue(':time', time());
$update_last_active->bindValue(':userid', $_SESSION['id']);
$update_last_active->execute();

// Check if auctions is over
$auctions_over = $db->prepare("SELECT * FROM `auctions` WHERE `sold`='0' AND `end_time` < :time");
$auctions_over->bindValue(':time', time());
$auctions_over->execute();

if($auctions_over->rowCount() > 0)  {
    while($auction = $auctions_over->fetch())   {

        // get winning bid info

        $winning_bid_info = $db->prepare("SELECT * FROM `auctions_bid` WHERE `auction_id`=:id ORDER BY `id` DESC LIMIT 1");
        $winning_bid_info->bindValue(':id', $auction['id']);
        $winning_bid_info->execute();

        if($winning_bid_info->rowCount() > 0)   { // IF no winning bids, no point selling

            $winning_bid = $winning_bid_info->fetch();

            // Get winner userinfo
            $winner_userinfo = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:userid");
            $winner_userinfo->bindValue(':userid', $winning_bid['bidder_id']);
            $winner_userinfo->execute();
            $winner_info = $winner_userinfo->fetch();

           
            // Get seller info
            $seller_info_ = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:brukerid");
            $seller_info_->bindValue(':brukerid', $auction['seller_id']);
            $seller_info_->execute();
            $seller_info = $seller_info_->fetch();


            // Get object info and change owner
            if($auction['object_type'] == 'Kulefabrikk') {
                $kf = $db->prepare("SELECT * FROM `Kulefabrikker` WHERE `KF_Eier`=:owner_username AND `KF_Sted`=:by");
                $kf->bindValue(':owner_username', $seller_info['brukernavn']);
                $kf->bindValue(':by', $auction['object_location']);
                $kf->execute();
                $kf_info = $kf->fetch();

                $object_id = $kf_info['id'];

                // change owner

                $change_object_owner = $db->prepare("UPDATE `Kulefabrikker` SET `KF_Eier`=:new_owner WHERE `id`=:object_id");
            } else {
                $bedrift = $db->prepare("SELECT * FROM `butikker` WHERE `Butikk_eier`=:owner_username AND `Butikk_land`=:by");
                $bedrift->bindValue(':owner_username', $seller_info['brukernavn']);
                $bedrift->bindValue(':by', $auction['object_location']);
                $bedrift->execute();

                $bedrift_info = $bedrift->fetch();

                $object_id = $bedrift_info['id'];

                // Change owner

                $change_object_owner = $db->prepare("UPDATE `butikker` SET `Butikk_eier`=:new_owner WHERE `id`=:object_id");

            }

            $change_object_owner->bindValue(':new_owner', $winner_info['brukernavn']);
            $change_object_owner->bindValue(':object_id', $object_id);
            $change_object_owner->execute();

            // give old owner money -10% percent
            $money_minus_ten = $winning_bid['bid'] * 0.9;
            $give_old_owner_money = $db->prepare("UPDATE `brukere` SET `penger`=`penger` + :money WHERE `brukerid`=:userid");
            $give_old_owner_money->bindValue(':money', $money_minus_ten);
            $give_old_owner_money->bindValue(':userid', $seller_info['brukerid']);
            $give_old_owner_money->execute();

            // Update auction to sold
            $update_auction = $db->prepare("UPDATE `auctions` SET `sold`='1' WHERE `id`=:auction_id");
            $update_auction->bindValue(':auction_id', $auction['id']);
            $update_auction->execute();


            // Send messages to new older and old owner
            $send_message_new_owner = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES 
        ('Game', :username, :timestamp, :fulldate, 'Poeng levert', :message, 'Ja')");
            $send_message_new_owner->bindValue(':username', $winner_info['brukernavn']);
            $send_message_new_owner->bindValue(':timestamp', time());
            $send_message_new_owner->bindValue(':fulldate', date('H:i:s // d.m.y'));
            $send_message_new_owner->bindValue(':message', 'Gratulerer! Du vant auksjonen, og har n&aring; f&aring;tt en ny bedrift.');
            $send_message_new_owner->execute();

            $send_message_old_owner = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES 
        ('Game', :username, :timestamp, :fulldate, 'Poeng levert', :message, 'Ja')");
            $send_message_old_owner->bindValue(':username', $seller_info['brukernavn']);
            $send_message_old_owner->bindValue(':timestamp', time());
            $send_message_old_owner->bindValue(':fulldate', date('H:i:s // d.m.y'));
            $send_message_old_owner->bindValue(':message', 'Bedriften din har blitt solgt. Du har f&aring;tt '.number_format($winning_bid['bid']).' kr, minus 10%.');
            $send_message_old_owner->execute();


        } else {
           
            // Get seller info
            $seller_info_ = $db->prepare("SELECT * FROM `brukere` WHERE `brukerid`=:brukerid");
            $seller_info_->bindValue(':brukerid', $auction['seller_id']);
            $seller_info_->execute();
            $seller_info = $seller_info_->fetch();


            // Put sold, send message object is not sold
            $send_message_old_owner = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES 
        ('Game', :username, :timestamp, :fulldate, 'Poeng levert', :message, 'Ja')");
            $send_message_old_owner->bindValue(':username', $seller_info['brukernavn']);
            $send_message_old_owner->bindValue(':timestamp', time());
            $send_message_old_owner->bindValue(':fulldate', date('H:i:s // d.m.y'));
            $send_message_old_owner->bindValue(':message', 'Auksjonen din ble fullf&oslash;rt uten noe bud.');
            $send_message_old_owner->execute();

            // Update auction to sold
            $update_auction = $db->prepare("UPDATE `auctions` SET `sold`='1' WHERE `id`=:auction_id");
            $update_auction->bindValue(':auction_id', $auction['id']);
            $update_auction->execute();
        }
    }
}


?>
<!DOCTYPE HTML>
<html lang="no">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/common/css/style.css">
        
        <!-- End new header, continue on old one from here -->

        <!-- Tittel -->
        <title>MafiaNo - Mafia Norge</title>
  
        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Mafiano er et norsk tekstbasert mafia spill hvor du lever mafia livet og figther om og bli den mektigste don. Spillet innholder vold sÃ¥ tenk deg om." />
        <meta name="keywords" content="mafia, mafiano, norsk spill, tekstbasert, mafia, game, gangster" />
        <meta name="robots" content="ALL INDEX" />
        <meta name="author" content="http://www.mafiano.no" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>

        <!-- Css -->
        <link href="game.css" rel="stylesheet" type="text/css" />
        <link href="rammeverk.css" rel="stylesheet" type="text/css" />
        <link href="thickbox.css" rel="stylesheet" type="text/css" />

        <!-- Javascript -->
        <script language='javascript' src='SCRIPT/Java123.js'></script>
        <script language='javascript' src='SCRIPT/jquery-ui-1.7.2.custom.min.js'></script>
        <script language="javascript" src='SCRIPT/Javascript.js'></script>
        <script language='javascript' src='SCRIPT/thickbox.js'></script>
        <!--<script language='javascript' src='SCRIPT/checkbox.js'></script>-->
    </head>
    <body>
        <!-- Hovedflate -->
        <div id="SB_Hovedflate">
            <form method="post" id="Loggut"><input type="hidden" value="1" name="loggut"></form>

        <?php
        // Old shit required for login in

        if(!isset($_GET['s'])) { $_GET['s'] = ''; }
        if(!isset($_REQUEST['s']))  { $_REQUEST['s'] = ''; }
        if( !isset($_SESSION['bruker_SES']) || 
            !isset($_SESSION['pass_SES']) || 
            !isset($_SESSION['id_SES']) || 
            !isset($_SESSION['nett_SES']) || 
            !isset($_SESSION['ip_SES'])) {

        } 


    

        // Old shit required to get userinfo
        $brukernavn_H = $_SESSION['bruker_SES'];
        $passord_H = $_SESSION['pass_SES'];
        $id_toket_H = $_SESSION['id_SES'];
        $ip_toket_H = $_SESSION['ip_SES'];
        $nett_toket_H = $_SESSION['nett_SES'];
    

        // Sjekk ip og nett - login session
        if(Sjekk_agent($ip_toket_H,$nett_toket_H) == '2') { session_unset(); session_destroy(); header("Location: index.php"); exit; }

        // Du er nå logget inn og nå sjekkes brukeren opp mot db og henter informasjon
        $rad_B = $userinfo;
 

  // Variablene til brukeren
  $brukernavn = htmlspecialchars($rad_B['brukernavn']);
  $horer_pult = $rad_B['horer_pult'];
  $biler_gjort = $rad_B['biler_gjort'];
  $bil_tid = $rad_B['bil_tid'];
  $drap = $rad_B['drap'];
  $bank = $rad_B['bank'];
  $turns = $rad_B['turns'];
  $penger = $rad_B['penger'];
  $land = $rad_B['land'];
  $liv = $rad_B['liv'];
  $brekk_gjort = $rad_B['brekk_gjort'];
  $brekk_tid = $rad_B['brekk_tid'];
  $type = $rad_B['type'];
  $gjeng = $rad_B['gjeng'];
  $rankpros = $rad_B['rankpros'];
  $rank_niva = $rad_B['rank_nivaa'];
  $email = $rad_B['email'];
  $profilbilde = $rad_B['profilbilde'];
  $navn = $rad_B['navn'];
  $info = $rad_B['info'];
  $kuler = $rad_B['kuler'];
  $regtid = $rad_B['regtid'];
  $respekt = $rad_B['respekt'];
  $reise_tid = $rad_B['reise_tid'];
  $oppdrag_nr = $rad_B['oppdrag_nr'];
  $upressings_tid = $rad_B['utpressing_tid'];
  $bryt_ut_antall = $rad_B['bryt_ut_antall'];
  $bryt_ut_tiden = $rad_B['vente_tid_bryt_ut'];
  $aktiv_player_eller = $rad_B['aktiv_eller'];
  $meldinger_sendt = $rad_B['meldinger_sendt'];
  $forumemner = $rad_B['Forumemner'];
  $forumsvar = $rad_B['Forumsvar'];
  $herverk_gjort = $rad_B['herverk_gjort'];
  $herverk_tiden = $rad_B['herverk_tiden'];
  $kjoonn = $rad_B['Kjon'];
  $kidnapping_stamp = $rad_B['kid_timestampen'];
  $kidnapping_antall = $rad_B['kid_antall'];
  $utpresse_antall = $rad_B['presse_antall'];
  $id_logget_inn = $rad_B['logg_in_id'];
  $regtid_stamp_din = $rad_B['regtid_stamp'];
  $timestamp_inne_din = $rad_B['timestamp_inne'];
  $plan_ran = $rad_B['plan_ran'];
  $plan_tid = $rad_B['plan_tid'];
  $antall_film_prod = $rad_B['antall_film_prod'];
  $film_tid = $rad_B['film_tid'];
  $bombechips = $rad_B['bombechips'];
  $InvitertAv = $rad_B['InvitertAv'];
  $OppdragNiva = $rad_B['OppdragUtfort'];
  $DinIpAdresse = $rad_B['ip'];
  $DinSign = $rad_B['signatur'];
  $rankpros2 = RankprosTo($rank_niva,$rankpros);


  $_SESSION['username'] = $brukernavn;

  // Statuser
  $draps_status = DrapStatus($drap);

  // Oppdrag
  if($oppdrag_nr == '2' && empty($OppdragNiva)) { mysql_query("UPDATE brukere SET OppdragUtfort='Tony Casanabo 00 Abdulhai Shankman 00 Lee Jang 00' WHERE brukernavn='$brukernavn'");  }


  // Give bonus to invited user
  if($userinfo['rank_nivaa'] >= '3' && $userinfo['InvitertAv'] != 'Ingen&ingeN') {
    $update_inviter_user = $db->prepare("UPDATE `brukere` SET `turns`=`turns`+100, `rankpros`=`rankpros`+5 WHERE `brukernavn`=:invited_by");
    $update_inviter_user->bindValue('invited_by', $userinfo['InvitertAv']);
    $update_inviter_user->execute();

    $update_invited_user = $db->prepare("UPDATE `brukere` SET `InvitertAv`='Ingen&ingeN', `aktiv_eller`=:aktive WHERE `brukernavn`=:username");
    $update_invited_user->bindValue(':aktive', time() + 3600);
    $update_invited_user->bindValue(':username', $userinfo['brukernavn']);
    $update_invited_user->execute();

    $send_invited_pm = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES 
        ('Game', :username, :timestamp, :fulldate, 'Poeng levert', :message, 'Ja')");
    $send_invited_pm->bindValue(':username', $userinfo['InvitertAv']);
    $send_invited_pm->bindValue(':timestamp', time());
    $send_invited_pm->bindValue(':fulldate', date('H:i:s // d.m.y'));
    $send_invited_pm->bindValue(':message', 'Du har mottatt 100 poeng og 5 rankprosent fordi du inviterte '.$userinfo['brukernavn'].' som har spilt lenge nok.');
    $send_invited_pm->execute();
  }


    
    // Logger ut av MafiaNo 
    if(isset($_POST['loggut'])) {
        $logout_user = $db->prepare("UPDATE `brukere` SET `aktiv_eller`=:timestamp WHERE `brukernavn`=:username");
        $logout_user->bindValue(':timestamp', time());
        $logout_user->bindValue(':username', $userinfo['brukernavn']);
        $logout_user->execute();

        session_destroy();
        header("Location: index.php");
        exit;
    }

  // Submit knapper
  $submit_knapp_1 = md5($_SERVER['REMOTE_ADDR']); $submit_knapp_2 = md5($_SERVER['HTTP_USER_AGENT']); $submit_knapp_3 = md5($submit_knapp_1);
          
  // Forskjellige systemer
  GiRank();
  Fengsel();
  Sykehus();
  PlantasjeUlykke();
  
  Kidnapping();
  PlateProd();
  BottFengsel();
  Horehus();
  Skytebanen();
  Dektektiver();
  




  // Sikkerhet new function 
  if($userinfo['penger'] < '0' || $userinfo['bank'] < '0') {
        mysql_query("UPDATE brukere SET penger='0',bank='0',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        // Remove all money from selected user
        $remove_money_from_user = $db->prepare("UPDATE `brukere` SET `penger`='0', `bank`='0', `aktiv_eller`=:timestamp WHERE `brukernavn`=:username");
        $remove_money_from_user->bindValue(':timestamp', time() + 3600);
        $remove_money_from_user->bindValue(':username', $userinfo['username']);
        $remove_money_from_user->execute();


        $message_to_havers = $userinfo['brukernavn'].' fikk en sum lavere en null, pengene p&aring; h&aring;nda som var '.number_format($userinfo['penger']).' kr samt pengene i banken som var '.number_format($userinfo['bank']).' kr har blitt endret til null kroner.';
        $message_to_user = 'Mafiano har tatt pengene du hadde kontant og de du hadde i banken, dette ble gjort av ren sikkerhet. Summen i banken/kontant var lavere en null, kontakt et medlem av MafiaNo Crew.'; 

        $add_to_log = $db->prepare("INSERT INTO `pm_system` (`fra_bruker`, `til_bruker`, `timestampen`, `dato_sendt`, `tittel`, `melding`, `fra_game_ell`) VALUES
                                                            ('Game', 'Havers', :timestamp, :fulldate, :title_to_havers, :message_to_havers, 'Ja'),
                                                            ('Game', :username, :timestamp, :fulldate, :title_to_user, :message_to_user, 'Ja')");
        $add_to_log->bindValue(':timestamp', time());
        $add_to_log->bindValue(':fulldate', date('H:i:s // d.m.y'));
        $add_to_log->bindValue(':username', $userinfo['brukernavn']);
        $add_to_log->bindValue(':title_to_havers', 'VIKTIG!');
        $add_to_log->bindValue(':message_to_havers', $message_to_havers);
        $add_to_log->bindValue(':title_to_user', 'Penger!');
        $add_to_log->bindValue(':message_to_user', $message_to_user);
        $add_to_log->execute();
  }


  

  $Feng = mysql_query("SELECT * FROM fengsel WHERE id LIKE '%' AND land='$land' AND timestamp_over > '$tiden'");
  if(mysql_num_rows($Feng) >= '1') { $HFeng = " pers"; } else { $HFeng = ""; }
  

  $Hor = mysql_query("SELECT * FROM Horehus WHERE Bang_by='$land' AND Bang_stamp_over > '$Timestamp'");
  if(mysql_num_rows($Hor) >= '1') { $HPers = " pers"; } else { $HPers = ""; }
  $Trener = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND trener_ell LIKE '1' AND skytetrening_over > $Timestamp");
  if(mysql_num_rows($Trener) >= '1') { $SkyterEll = "<font class=\"Tider\">(Trener)</font>"; } else { $SkyterEll = ''; }
  

  $Butt = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier LIKE '$brukernavn'");
 
  $Kff = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn'");
  $DineFirms = mysql_num_rows($Butt) + mysql_num_rows($Kff);
  if($DineFirms >= '1') { $DineFirms = "<font class=\"Tider\">($DineFirms stk)</font>"; } else { $DineFirms = ""; }
  

  $B = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$land'");

  $K = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Sted='$land'");
  $BLedig = mysql_num_rows($B) + mysql_num_rows($K);
  if($BLedig < '5') { $BLedig = "<font class=\"Viktig\">(Ledig plass)</font>"; } else { $BLedig = ''; }
    
  if (empty($_SESSION['Bla_banner']) ) { $_SESSION['Bla_banner'] = 'Banner';  }
  if (isset($_POST['SB_F1'])) { $_SESSION['Bla_banner'] = 'Banner'; }
  if (isset($_POST['SB_F2'])) { $_SESSION['Bla_banner'] = 'Forum'; }
                


  echo "<div id=\"TopTekst\">";

  $Hendelse = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Ja' ORDER BY `timestampen` DESC LIMIT 0, 1");
  if(mysql_num_rows($Hendelse) == '0') { $Tekst25 = "Ingen hendelser enda."; } else { $row = mysql_fetch_array($Hendelse); 
  if(strlen($row['melding']) >= '59') { $Tekst25 = substr($row['melding'], 0, 59) . '...'; } else { $Tekst25 = $row['melding']; }}
  echo "<span style=\"float:left\" class=\"TopT\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=GameLogg');\">$Tekst25</span>";
  
  echo '<span id=\"Time\"> '.Date('H').':<label id="minutes">'.Date('i').'</label>:<label id="seconds">'.Date('s').'</label>
// '.$Dato.'</span></div>';


?>
<script type="text/javascript">
        var sec = <?php echo (Date('i') * 60) + Date('s'); ?>;
function pad ( val ) { return val > 9 ? val : "0" + val; }
setInterval( function(){
    $("#seconds").html(pad(++sec%60));
    $("#minutes").html(pad(parseInt(sec/60,10)));
}, 1000);
    </script>
<?php

  if($_SESSION['Bla_banner'] == 'Forum') { include "Annensider/Abc_forumtop.php"; } else { echo '<div id="SB_Banner"></div>'; } ?>
  <div id="SB_Sms2">
  <ul>
  
  </ul></div>
  <div id="SB_Knapp"><button class="knapp_ban" onclick="LastSide('Annensider/Abc_chat.php')"><b>CHAT</b></button></div>
  <div id="SB_Knapp"><form method="post">
  <? 
  if($_SESSION['Bla_banner'] == 'Banner') { echo '<button class="knapp_ban" type="submit" name="SB_F2"><b>FORUM</b></button>'; }
  if($_SESSION['Bla_banner'] == 'Forum') { echo '<button class="knapp_ban" type="submit" name="SB_F1"><b>BANNER</b></button>'; }
  ?>
  </form></div>
  <div id="SB_Venstre">
  <div class="column" id="column1">
  <div class="dragbox" id="item1">
  <h1><img class="drakos" src="../Design/Vis.png">Tjen penger</h1>
  <div class="dragbox-content">
  <ul>
  <li onclick='document.location.href="game.php?side=Plantasjen"'>Plantasjen</li>
  <li onclick='document.location.href="game.php?side=Platestudio"'>Platestudio</li>
  <li onclick='document.location.href="game.php?side=FilmProdusering"'>Film produksjon <font id="F_Tid" class="TidKlar">(<? echo TidKlar($film_tid); ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Børsen"'>Børsen</li>
  <li id="Bordell" onclick='document.location.href="game.php?side=Horehus"'>Bordellet <font class="Tider">(<? echo mysql_num_rows($Hor)." $HPers"; ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Hitlist"'>Hitlist<!-- - <font color="red">(Redigeres)</font>--></li>
  <li onclick="$('#SB_Midten2').load('post.php?du_valgte=Kasino');">Kasino<!-- - <font color="red">(Redigeres)</font>--></li>
  <? /* if($brukernavn == 'Havers') { 
  echo "<li onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Bordel');\">Bordellet</li>"; 
  } */ ?>
  </ul></div></div>

  <div class="dragbox" id="item2">
  <h1><img class="drakos" src="../Design/Vis.png">Aktiviteter</h1>
  <div class="dragbox-content">
  <ul>
  <li onclick="$('#SB_Midten2').load('post.php?du_valgte=Kickboksing')">Kickboksing</li>
  <li id="Vopentrening" onclick='document.location.href="game.php?side=VopenTrening"'>Våpentrening <? echo $SkyterEll; ?></li>
  <!--<li onclick="$('#SB_Midten2').load('post.php?du_valgte=Bilrace')">Bilrace</li>-->
  </ul></div></div>
  
  <div class="dragbox" id="item3">
  <h1><img class="drakos" src="../Design/Vis.png">Kriminaliteter</h1>
  <div class="dragbox-content">
  <ul>
  <li onclick='document.location.href="game.php?side=Brekk"'>Brekk <font id="B_Tid" class="TidKlar">(<? echo TidKlar($brekk_tid); ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Biltyveri"'>Biltyveri <font id="G_Tid" class="TidKlar">(<? echo TidKlar($bil_tid); ?>)</font></li>
  <? /* if($brukernavn == 'Havers') { 
  echo "<li onclick='document.location.href=\"game.php?side=Utpress\"'>Utpress - <font color=\"red\">(Utvikles)</font></li>"; 
  } */ ?>
  <li onclick='document.location.href="game.php?side=Herverk"'>Hærverk <font id="H_Tid" class="TidKlar">(<? echo TidKlar($herverk_tiden); ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Utpressing"'>Utpressing <font id="U_Tid" class="TidKlar">(<? echo TidKlar($upressings_tid); ?>)</font></li>
  <li onclick='document.location.href="game.php?side=PlanlagtRan"'>Planlagt ran <font id="R_Tid" class="TidKlar">(<? echo TidKlar($plan_tid); ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Drep"'>Drep spiller</li>
  <li onclick='document.location.href="game.php?side=Kidnapping"'>Kidnapp spiller</li>
  <li onclick='document.location.href="game.php?side=Oppdrag"'>Oppdrag</li>
  </ul></div></div>
  <div class="dragbox" id="item4">
  <h1><img class="drakos" src="../Design/Vis.png">Diverse</h1>
  <div class="dragbox-content">
  <ul>
  <li id="Fengo" onclick='document.location.href="game.php?side=Fengsel"'>Fengsel <font class="Tider">(<? echo mysql_num_rows($Feng)." $HFeng"; ?>)</font></li>
  <li onclick='document.location.href="game.php?side=Sykehus"'>Sykehus</li>
  <li onclick='document.location.href="game.php?side=Detektiv"'>Detektiv utleie</li>
  <li onclick='document.location.href="game.php?side=Bunker"'>Midlertidig bunker</li>
  <li onclick='document.location.href="game.php?side=Eiendeler"'>Dine eiendeler</li>
  <li onclick='document.location.href="game.php?side=Banken"'>Banken</li>
  <li onclick='document.location.href="game.php?side=Poeng"'>Poeng</li>
  <li onclick="LastSide('Hovedsider/Reis_abc.php')">Reis</li>
  </ul></div></div>
  <div class="dragbox" id="item5">
  <h1><img class="drakos" src="../Design/Vis.png">Handel</h1>
  <div class="dragbox-content">
  <ul>
    <a href="?function=handel&file=auksjon"><li>Auksjon</li></a>
  <li onclick="$('#SB_Midten2').load('post.php?du_valgte=Auksjoner')">Handel</li>
  <li onclick='document.location.href="game.php?side=Marked"'>Marked</li>
  <li onclick='document.location.href="game.php?side=Undergrunnen"'>Undergrunnen</li>
  </ul></div></div>
  <div class="dragbox" id="item6">
  <h1><img class="drakos" src="../Design/Vis.png">Bedrifter</h1>
  <div class="dragbox-content">
  <ul>
  <? if(empty($gjeng)) { echo "<li onclick='document.location.href=\"game.php?side=StartGjeng\"'>Start gjeng</li>"; } else { echo "<li onclick=\"$('#SB_Midten2').load('post.php?GjengHus=Hovedkvarter');\">Gjeng</li>"; } ?>
  <li id="Startfirma" onclick='document.location.href="game.php?side=ButikkFirma"'>Start firma <? echo $BLedig; ?></li>
  <li id="Dinefirma" onclick='document.location.href="game.php?side=DineFirma"'>Dine firma <? echo $DineFirms; ?></li>
  </ul></div></div>
<!--
  <div class="dragbox" id="item7">
  <h1><img class="drakos" src="../Design/Vis.png">MMS bilde</h1><div class="dragbox-content"><ul>
  <?
  #
  #$Hent_MSS = mysql_query("SELECT * FROM HttpInbox WHERE MessageType LIKE 'mms' ORDER BY Timestamp DESC LIMIT 0, 1");
  #if(mysql_num_rows($Hent_MSS) == '0') { $bilde = 'http://www.mafiano.no/Sonny.jpg'; } else { $bilde_id_blir_tata = mysql_fetch_assoc($Hent_MSS); $bilde_url_blir = rawurlencode($bilde_id_blir_tata['Id']); $bilde = "http://www.mafiano.no/httpinboxview_example.php?imageId=$bilde_url_blir"; }

  ?>
  <A href="game.php?side=MMSBilder"><img style="margin-bottom:1px; width:160px;" border="0" src="<? echo $bilde ?>"></A></ul></div></div>
  -->
  </div><h6></h6></div>
  <div id="SB_Midten"><h1>Innhold</h1><div id="SB_Midten2">   
  <?php   


    if($userinfo['user_verified'] == '1') {
      include("./common/router.php");
    } else {
      include("./common/files/system/verify.php");
    }
    
    
    echo $output;
  ?>
  </div> 
  <div id="SB_Midten3"><h6></h6></div></div>
  <div id="SB_Hoyre"><div class="column" id="column2">
  <div class="dragbox" id="item8">
  <h1><img class="drakos" src="../Design/Vis.png">Bruker</h1>
  <div class="dragbox-content">
  <div id="VisBilde">
   <?

  if($kjoonn == 'Gutt') { 
  $hent_innboks_sjekk_2 = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Nei' AND slettet_ell='Nei' AND lest_ell='Nei'");
  if (mysql_num_rows($hent_innboks_sjekk_2) == 0) { echo '<img class="BunnIMG" src="../Design/melding2.jpg">'; } else { echo '<img style="cursor:pointer;" onclick="$(\'#SB_Midten2\').load(\'post.php?du_valgte=Innboks\');" class="BunnIMG" src="../Design/melding3.jpg">'; }
  } else { 
  $hent_innboks_sjekk_2 = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Nei' AND slettet_ell='Nei' AND lest_ell='Nei'");
  if (mysql_num_rows($hent_innboks_sjekk_2) == 0) { echo '<img class="BunnIMG" src="../Design/Jente_Bilde.gif">'; } else { echo '<img style="cursor:pointer;" onclick="$(\'#SB_Midten2\').load(\'post.php?du_valgte=Innboks\');" class="BunnIMG" src="../Design/Jenter_Bilde_mld.gif">'; }
  }

  ?></div>
  <dl id="Gen_Info" class="Gen_Info">
  <dt>- - - - - -</dt><dd>&nbsp;</dd>
  <dt>Bruker:&nbsp;</dt><dd><? echo '<a href="game.php?side=Bruker&navn='.urlencode($userinfo['brukernavn']).'">'.$userinfo['brukernavn'].'</a>'; ?></dd>
  <dt>Rank:&nbsp;</dt><dd><? echo $userinfo['rank']; ?></dd>
  <dt>Respekt:&nbsp;</dt><dd><? echo $userinfo['respekt']; ?></dd>
  <dt>Bombechips:&nbsp;</dt><dd><? echo number_format($userinfo['bombechips']); ?> stk</dd>
  <dt>Penger:&nbsp;</dt><dd><? echo number_format($userinfo['penger']); ?> kr</dd>
  <dt>Poeng:&nbsp;</dt><dd><? echo number_format($userinfo['turns']); ?> stk</dd>
  <dt>Sted:&nbsp;</dt><dd><? echo $userinfo['land']; ?></dd>
  <dt>Gjeng:&nbsp;</dt><dd><? if(empty($userinfo['gjeng'])) { echo 'Ingen'; } else { echo '<a href="game.php?side=Gjeng&navn='.urlencode($userinfo['gjeng']).'">'.$userinfo['gjeng'].'</a>'; }  ?></dd>
  <dt>Kuler:&nbsp;</dt><dd><? echo  number_format($userinfo['kuler']); ?> stk</dd>
  <dt>Liv:&nbsp;</dt><dd><? echo $userinfo['liv']; ?>%</dd>
  <dt>&nbsp;</dt><dd>&nbsp;</dd>
  <?php
    // Lag liste av vopen og beskyttelse som du eier
  $vopen_1_er = 'Ingen'; $vopen_2_er = 'Ingen'; $vopen_3_er = 'Ingen'; 
  $besk_1_er = 'Ingen'; $besk_2_er = 'Ingen'; $besk_3_er = 'Ingen';
  DineVopen(); 
  $ListVopen = ListVopen($vopen_1_er,$vopen_2_er,$vopen_3_er); 
  $ListBeskyttelse = ListVopen($besk_1_er,$besk_2_er,$besk_3_er);
  ?>
  <dt>Våpen:&nbsp;</dt><dd><? echo $ListVopen; ?></dd>
  <dt>&nbsp;</dt><dd>&nbsp;</dd>
  <dt>Vern:&nbsp;</dt><dd><? echo $ListBeskyttelse; ?></dd>
  <dt>- - - - - -</dt><dd>&nbsp;</dd>
  </dl>
  </div></div>
  <div class="dragbox" id="item9">
  <h1><img class="drakos" src="../Design/Vis.png">System</h1>
  <div class="dragbox-content">
  <ul>
  <li><a href="/game.php">Hovedsiden</a></li>
  <li onclick='document.location.href="game.php?side=MinSide"'>Min side</li>
  <?php   $Inno = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Nei' AND slettet_ell='Nei' AND lest_ell='Nei'"); ?>
  <li id="Inno" onclick="$('#SB_Midten2').load('post.php?du_valgte=Innboks');">Innboks <font class="Tider">(<? echo mysql_num_rows($Inno); ?> brev)</font></li>
  <a href="?function=system&file=finn_spiller"><li>Finn spiller</li></a>
  <?php   $Pa = mysql_query("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $Timestamp"); ?>
  <li id="Online" onclick="$('#SB_Midten2').load('post.php?MebOnline=True');">Online <font class="Tider">(<? echo mysql_num_rows($Pa); ?> stk)</font></li>
  <li onclick='document.location.href="game.php?side=Statistikk"'>Statistikk</li>
  <li onclick="document.getElementById('Loggut').submit()">Logg ut</li>
  </ul></div></div>
  <div class="dragbox" id="item10">
  <h1><img class="drakos" src="../Design/Vis.png">Hjelp</h1>
  <div class="dragbox-content">
  <ul>
  <!--<li onclick='document.location.href="game.php?side=Facebook"'>Facebook</li>-->
  <li onclick='document.location.href="game.php?side=SpillRegler"'>Regelverk</li>
  <li onclick='document.location.href="game.php?side=SupportSpillere"'>Supportspillere</li>
  <li onclick='document.location.href="game.php?side=FAQ"'>Generelt om spillet</li>
  <li onclick='document.location.href="game.php?side=KontaktOss"'>Kontakt</li>
  </ul></div></div>  
  <?
  if($type == 'A' || $type == 'm') { 
  echo "

  <div class=\"dragbox\" id=\"item11\">
  <h1><img class=\"drakos\" src=\"../Design/Vis.png\">Crew panel</h1>

  <div class=\"dragbox-content\">
  <ul>";
  echo '<a href="?function=logger&file=main"><li>Logger</li></a>';

  echo "
  <li onclick=\"$('#SB_Midten2').load('post.php?Logger=Bruker');\">Bruker kontroll</li>
  <li onclick=\"$('#SB_Midten2').load('post.php?Logger=Funksjoner');\">Funksjoner</li>
  <li onclick='document.location.href=\"game.php?side=SystemRedigering\"'>System redigering</li></ul></div></div>"; } 
  elseif($type == 'fm' || $type == 'mi' || $type == 'sf') { echo "<div class=\"dragbox\" id=\"item11\"><h1><img class=\"drakos\" src=\"../Design/Vis.png\">Panel</h1><div class=\"dragbox-content\"><ul><li onclick='document.location.href=\"game.php?side=Unknown\"'>Kommer</li></ul></div></div>"; }
  elseif($type == 's' || $type == 'bz') { echo "<div class=\"dragbox\" id=\"item11\"><h1><img class=\"drakos\" src=\"../Design/Vis.png\">Panel</h1><div class=\"dragbox-content\"><ul><li onclick='document.location.href=\"game.php?side=Unknown\"'>Kommer</li></ul></div></div>"; }
  ?> 
  

  </div><h6></h6></div><div id="SB_Bunn"></div></div>
  <!-- Lukker Hovedflate -->

  </body>
  </html>

  <?php

}
?>