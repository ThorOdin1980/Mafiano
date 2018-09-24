<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

  <!-- Tittel -->
  <title>MafiaNo - Mafia Norge</title>

  <!-- Meta -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="description" content="Mafiano er et norsk tekstbasert mafia spill hvor du lever mafia livet og figther om og bli den mektigste don. Spillet innholder vold sÃ¥ tenk deg om." />
  <meta name="keywords" content="sondre brudvik, mafia, mafiano, norsk spill, tekstbassert, Havers, mafia, game, brudvik, sondre, gangster" />
  <meta name="robots" content="ALL INDEX" />
  <meta name="author" content="Sondre Brudvik; http://www.mafiano.no" />
  
  <!-- Css -->
  <link href="game.css" rel="stylesheet" type="text/css" />
  <link href="rammeverk.css" rel="stylesheet" type="text/css" />

</head>
<body>

    <!-- Hovedflate -->
    <div id="SB_Hovedflate">
    
    <? 
    include ("db.php");

    // Din ip som blir brukt til sikkerhet
    $DIN_IP = preg_replace("/[a-zA-Z-\+\*\.\,]/","",$_SERVER['REMOTE_ADDR']);
    $DIN_SUBMIT_KNAPP = md5($DIN_IP + '12345');   
    
    // Velger om det skal være banner eller forum i toppen
    session_start();   
    if (empty($_SESSION['Bla_banner']) ) { $_SESSION['Bla_banner'] = 'Banner';  }
    if (isset($_POST['SB_F1'])) { $_SESSION['Bla_banner'] = 'Banner'; }
    if (isset($_POST['SB_F2'])) { $_SESSION['Bla_banner'] = 'Forum'; }
    $endelig_banner_svar = $_SESSION['Bla_banner'];
    if($endelig_banner_svar == 'Forum') { include "Annensider/Abc_forumtop2.php"; }
    if($endelig_banner_svar == 'Banner') { echo '<div id="SB_Banner"></div>'; } 
    ?>
    <div id="SB_Sms2"><ul>
        <?
    $animasjon_blir = date("n");
    $animasjon_blir_2 = date("d");

    if($animasjon_blir == '1') { 
    if($animasjon_blir_2 >= '01') { $veret_blir = 'snowflakes'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'snowflakes'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'reiner'; }} 
    elseif($animasjon_blir == '2') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'snowflakes'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'snowflakes'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'snowflakes'; }}
    elseif($animasjon_blir == '3') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'snowflakes'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'sommer'; }}
    elseif($animasjon_blir == '4') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'sommer'; }}
    elseif($animasjon_blir == '5') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'reiner'; }}
    elseif($animasjon_blir == '6') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'sommer'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'sommer'; }}
    elseif($animasjon_blir == '7') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'sommer'; }}
    elseif($animasjon_blir == '8') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'sommer'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'hosten'; }}
    elseif($animasjon_blir == '9') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'hosten'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'hosten'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'hosten'; }}
    elseif($animasjon_blir == '10') {
    if($animasjon_blir_2 >= '01') { $veret_blir = 'hosten'; } 
    elseif($animasjon_blir_2 >= '10') { $veret_blir = 'reiner'; } 
    elseif($animasjon_blir_2 >= '15') { $veret_blir = 'reiner'; }
    elseif($animasjon_blir_2 >= '20') { $veret_blir = 'snowflakes'; }}
    elseif($animasjon_blir == '11') { $veret_blir = 'snowflakes'; }
    elseif($animasjon_blir == '12') { $veret_blir = 'snowflakes'; }
    ?>
    <object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj2" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="626" height="20">
    <param name="movie" value="<?=$veret_blir;?>.swf">
    <param name="quality" value="High">
    <embed src="<?=$veret_blir;?>.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj2" width="626" height="20"></object>
	</ul></div>
    <div id="SB_Knapp"><button class="knapp_ban" onclick="history.go(-1)"><b>TILBAKE</b></button></div>
    <div id="SB_Knapp"><form method="post">
    <? 
    if($endelig_banner_svar == 'Banner') { echo '<button class="knapp_ban" type="submit" name="SB_F2"><b>FORUM</b></button>'; }
    if($endelig_banner_svar == 'Forum') { echo '<button class="knapp_ban" type="submit" name="SB_F1"><b>BANNER</b></button>'; }
    ?>
    </form></div>
    <div id="SB_Storflate">
    <h1>Informasjon:</h1>
    <div id="SB_Midten4"><div style="float:left; margin-left:5px; margin:right:5px; color:#ffffff;">
    <font style="font-size:12px; font-weight:bold; color:#848519;">VIKTIG!</font><br>
    Spillet gjennomgår en optimalisering, det er ingen form for tilbakestilling. Det er kun et forsøk på å øke server hastigheten.<br>
    </div></div>
    <div id="SB_Midten6"><h6></h6></div>
    </div>
    
    <div id="SB_Bunn"></div>
    </div>
    <!-- Lukker Hovedflate -->

</body>
</html>