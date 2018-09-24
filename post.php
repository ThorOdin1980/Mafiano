<?php
ob_start();
session_start();
    
  // Sjekker om du har sendt session til gamesiden
  if (empty($_SESSION['bruker_SES']) || empty($_SESSION['pass_SES']) || empty($_SESSION['id_SES']) || empty($_SESSION['nett_SES']) || empty($_SESSION['ip_SES'])) { echo 'Du logges ut - session token'; session_unset(); session_destroy(); exit; } 
    
  // Login variablene
  $brukernavn_H = $_SESSION['bruker_SES']; $passord_H = $_SESSION['pass_SES']; $id_toket_H = $_SESSION['id_SES']; $ip_toket_H = $_SESSION['ip_SES']; $nett_toket_H = $_SESSION['nett_SES'];
   
  // Sjekk login varriabler mot f�lgende
  $ipaddress_22_bla_e = md5($_SERVER['REMOTE_ADDR']);
  $nettleser_22_bla_e = md5($_SERVER['HTTP_USER_AGENT']);
  if ($ip_toket_H != $ipaddress_22_bla_e) { echo 'Du logges ut - IP token';  session_unset(); session_destroy(); exit; } 
  if ($nett_toket_H != $nettleser_22_bla_e) { echo 'Du logges ut - Nettleser token';  session_unset(); session_destroy();  exit; } 
  
  // Diverse
  $Timestamp = time();
  $tiden = time();
  $Klokke = date("H:i:s");
  $Dato = date("d.m.y");
  $DatoIdag = date("d. M");
  $Nbsp = '//';
  $Aktiv = $Timestamp + '3600';
  $tiden_aktiv = $Aktiv;
  $FullDato = $Klokke." ".$Nbsp." ".$Dato;
  $AnnenDato = $Klokke." ".$Nbsp." ".$DatoIdag." ".$Nbsp." ".date("Y");

  // Du er n� logget inn og n� sjekkes brukeren opp mot db og henter informasjon
  require "db.php";
  $velg_fra = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavn_H' AND aktivert='1' AND liv >= '1' AND aktiv_eller > $Timestamp"); // Removed  AND logg_in_id = '$id_toket_H' to avoid error
  if (mysql_num_rows($velg_fra) > '0') { 
  $rad_B = mysql_fetch_assoc($velg_fra);
  
  // Variablene til brukeren
  $bruker_iden = $_SESSION['id'];
  $brukernavn = htmlspecialchars($rad_B['brukernavn']);
  $Kjon = $rad_B['Kjon'];
  $Land = $rad_B['land'];

  function Mysql_Klar($Tekst) { $Tekst = htmlentities(strip_tags($Tekst)); return $Tekst; } // mysql_real_escape_string
  function BrukerURL($Navn) { $Navn = "<a href=\"game.php?side=Bruker&navn=".urlencode($Navn)."\">".$Navn."</a>"; return $Navn; }
  function VerdiSum($Tekst,$Type) { $Tekst = number_format($Tekst, 0, ",", ".")." $Type"; return $Tekst; }
  function smil($text) { $trans = array(":((" => '<img src="smilies/10.gif" title="Gråter :((">',":))" => '<img src="smilies/9.gif" title="Le :))">',"=))" => '<img src="smilies/12.gif" title="Ler stort =))">',"=((" => '<img src="smilies/18.gif" title="Virkelig trist =((">', ":)" => '<img src="smilies/2.gif" title="Smil :)">',":(" => '<img src="smilies/1.gif" title="Trist :(">',":P" => '<img src="smilies/11.gif" title="Tunge :P">',":p" => '<img src="smilies/3.gif" title="Tunge :p">',"<3" => '<img src="smilies/4.gif" title="Forelsket <3">',"X(" => '<img src="smilies/5.gif" title="Sint X(">',":D" => '<img src="smilies/6.gif" title="Stort smil :D">',":S" => '<img src="smilies/7.gif" title="Usikker :S">',":O" => '<img src="smilies/8.gif" title="Sjokkert :O">',";P" => '<img src="smilies/13.gif" title="Sleike ;P">',":-*" => '<img src="smilies/14.gif" title="Kyss :-*">',":-O" => '<img src="smilies/15.gif" title="Sikler :-O">',":|" => '<img src="smilies/16.gif" title="Rett smil :|">',">:D<" => '<img src="smilies/17.gif" title="Klem >:D<">',":>" => '<img src="smilies/19.gif" title="Kul :>">',";)" => '<img src="smilies/20.gif" title="Blunk ;)">'); $translated = strtr($text, $trans); return nl2br($translated); } 
  function url($url) {$pattern = array("/http:\/\/www\.youtube\.com\/watch\?(.*)v=([a-zA-Z0-9_\-]+)/i","/(^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6})$/i",'/(http:\/\/[^\s]+(.jpg|.png|.gif))/i'); $replace = array('<object width="280" height="185"><param name="movie" value="http://www.youtube.com/v/$2&amp;hl=en_US&amp;fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$2&amp;hl=en_US&amp;fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="280" height="185"></embed></object>','<a class="URL" href="mailto:$1">$1</a>','<a class=thickbox title="" href="$1"><img style="max-height:250px; max-width:200px; border-width:1;" src="$1"></a>'); return preg_replace($pattern, $replace, $url); }
  function Bare_Bokstaver($Tekst) { $Tekst = ereg_replace("[^A-Za-z]", "",$Tekst); return $Tekst; }
  function Bare_Siffer($Tekst) { $Tekst = ereg_replace("[^0-9]", "",$Tekst); return $Tekst; }
  function PrintTeksten($Tekst,$Type,$Svar,$Colspan) { if($Type == '1') { if($Svar == 'Vellykket') { $Class = "Span_str_6"; } else { $Class = "Span_str_5"; } $Svar = "<div class=\"Div_MELDING\"><span class=\"$Class\">$Tekst</span></div>"; } elseif($Type == '2') { if($Svar == 'Vellykket') { $Class = "T_1"; } else { $Class = "T_2"; } $Svar = "<tr><td class=\"R_8\" colspan=\"$Colspan\"><span class=\"$Class\">$Tekst</span></td></tr>"; } return $Svar; }
  function Krypt_Tall($Var) { $Var = ($Var * 2416); $Tall = array('/0/','/1/','/2/','/3/','/4/','/5/','/6/','/7/','/8/','/9/'); $Bokstaver = array('A','a','B','b','C','c','D','d','E','e'); $Var = preg_replace ($Tall, $Bokstaver, $Var); return $Var; }
  function Dekrypt_Tall($Var) { $Tall = array('0','1','2','3','4','5','6','7','8','9'); $Bokstaver = array('/A/','/a/','/B/','/b/','/C/','/c/','/D/','/d/','/E/','/e/'); $Var = preg_replace ($Bokstaver, $Tall, $Var); $Var = ($Var / 2416); return $Var; }
  function PengStatus($Var) { $Var = floor($Var); if($Var < '10000') { $I = 'Boms'; } if($Var >= '10000') { $I = 'Fattig'; } if($Var >= '60000') { $I = 'Streber'; } if($Var >= '300000') { $I = 'Arbeider'; } if($Var >= '700000') { $I = 'Vellykket arbeider'; } if($Var >= '1000000') { $I = 'Overklasse'; } if($Var >= '2000000') { $I = 'Millionær'; } if($Var >= '10000000') { $I = 'Mange millionær'; } if($Var >= '100000000') { $I = 'Farlig rik'; } if($Var >= '1000000000') { $I = 'Milliardær'; } if($Var >= '5000000000') { $I = 'Vellykket milliardær'; } if($Var >= '1000000000000') { $I = 'Billionær'; } return $I; }
  function Stilling($Stilling) { if($Stilling == 'u') { $Var = '<font color="#ffffff">Spiller</font>'; } elseif($Stilling == 'b') { $Var = '<font color="#923961">Mafiano bot</font>'; } elseif($Stilling == 's') { $Var = '<font color="#999ea6">Support spiller</font>'; } elseif($Stilling == 'sf') { $Var = '<font color="#516995">Support ansvarlig</font>'; } elseif($Stilling == 'bz') { $Var = '<font color="#7d4d7e">Bugzorz</font>'; } elseif($Stilling == 'mi') { $Var = '<font color="#518b95">mIRC ansvarlig</font>'; } elseif($Stilling == 'fm') { $Var = '<font color="#5e8112">Forum moderator</font>'; } elseif($Stilling == 'm') { $Var = '<font color="#906b12">Moderator</font>'; } elseif($Stilling == 'A') { $Var = '<font color="#c03818">Administrator</font>'; } return $Var; }
  function DrapStatus($A) { if($A >= '15') { $T = 'Psykopat'; } elseif($A >= '12') { $T = 'Massemorder'; } elseif ($A >= '9') { $T = 'Veldig farlig'; } elseif ($A >= '6') { $T = 'Morder'; } elseif ($A >= '3') { $T = 'Har drept'; } else { $T = 'Ufarlig'; } return $T; }
  function SiderVis($Tall,$Side) { $Antall = $Tall / '20'; if($Antall > '1') { $i = '0'; $Sider = ""; while ($i <= $Antall) { $i++; $Asider = '20' * $i; $Asider = $Asider - '20'; if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; } $Sider = $Sider."<a onclick=\"$('#SB_Midten2').load('$Side'+'&Antall=$Asider'); $('html, body').animate({scrollTop:100}, 'slow');\">[$ekstra$i]</a>&nbsp;&nbsp;"; if($i == '8' || $i == '16' || $i == '24' || $i == '32' || $i == '40' || $i == '48' || $i == '56' ||  $i == '64' ||  $i == '72' ||  $i == '80' ||  $i == '88' ||  $i == '96') { $Sider = $Sider.'<br>'; } if($i == '99') { break; }} $Sider = '<tr><td class="R_9"><span class="T_3">'.$Sider.'</span></td></tr>'; } return $Sider; }
  function igaar($Dato) { $Dag = Bare_Siffer($Dato); $Monde = Bare_Bokstaver($Dato); $Dag = $Dag - '1'; if($Dag >= '1') { if($Dag < '10') { $Dag = '0'.$Dag; } $Data = "$Dag. $Monde"; } else { if($Monde == 'Jan') { $TidMonde = "Dec"; $TidDag = "31"; }elseif($Monde == 'Feb') { $TidMonde = "Jan"; $TidDag = "31"; }elseif($Monde == 'Mar') { $TidMonde = "Feb"; $TidDag = "28"; }elseif($Monde == 'Apr') { $TidMonde = "Mar"; $TidDag = "31"; }elseif($Monde == 'Mai') { $TidMonde = "Apr"; $TidDag = "30"; }elseif($Monde == 'Jun') { $TidMonde = "Mai"; $TidDag = "31"; }elseif($Monde == 'Jul') { $TidMonde = "Jun"; $TidDag = "30"; }elseif($Monde == 'Aug') { $TidMonde = "Jul"; $TidDag = "31"; }elseif($Monde == 'Sep') { $TidMonde = "Aug"; $TidDag = "31"; }elseif($Monde == 'Oct') { $TidMonde = "Sep"; $TidDag = "30"; }elseif($Monde == 'Nov') { $TidMonde = "Oct"; $TidDag = "31"; }elseif($Monde == 'Dec') { $TidMonde = "Nov"; $TidDag = "30"; } if($Dag < '10') { $TidDag = '0'.$TidDag; } $Data = "$TidDag. $TidMonde"; } return $Data; }
  function Bare_BS($Tekst) { $Tekst = ereg_replace("[^A-Za-z0-9 ]", "",$Tekst); return $Tekst; }
  function Fiks_Space($Tekst) { $Tekst = preg_replace('/\s+/', ' ',$Tekst); return trim($Tekst); }

// Easy errorfix
$_GET['du_valgte'] = isset($_GET['du_valgte']) ? $_GET['du_valgte'] : '';
$_GET['Logger'] = isset($_GET['Logger']) ? $_GET['Logger'] : '';
$_GET['FinnSpiller'] = isset($_GET['FinnSpiller']) ? $_GET['FinnSpiller'] : '';
$_GET['AddFriend'] = isset($_GET['AddFriend']) ? $_GET['AddFriend'] : '';
$_GET['MebOnline'] = isset($_GET['MebOnline']) ? $_GET['MebOnline'] : '';
$_GET['MeldLest'] = isset($_GET['MeldLest']) ? $_GET['MeldLest'] : '';



  // Kasino
  if($_GET['du_valgte'] == 'Kasino') { include "Kasino.inc.php"; }
  elseif($_GET['du_valgte'] == 'Blackjack') { include "Blackjack.inc.php"; }
  elseif($_GET['du_valgte'] == 'SSP') { include "SteinSaksPapir.inc.php"; }
  elseif($_GET['du_valgte'] == 'Rulett') { include "Rulett.inc.php"; }
  elseif($_GET['du_valgte'] == 'Trav') { include "Trav.inc.php"; }
  elseif($_GET['du_valgte'] == 'Slot') { include "Slot.inc.php"; }
  elseif($_GET['du_valgte'] == 'Terning') { include "Terning.inc.php"; }
  elseif($_GET['du_valgte'] == 'Poker') { include "Poker.inc.php"; }

  // Auksjoner
  elseif($_GET['du_valgte'] == 'Bordel') { include "Bordel.inc.php"; }
  // Auksjoner
  elseif($_GET['du_valgte'] == 'Auksjoner') { include "Auksjon.inc.php"; }
  // Bilrace
  elseif($_GET['du_valgte'] == 'Bilrace') { include "Bilrace.inc.php"; }

  // Kickboksing
  elseif($_GET['du_valgte'] == 'Kickboksing') { include "kickboksing.inc.php"; }
    
  // Meny redigering
  elseif($_GET['du_valgte'] == 'Meny') { 
  $Oppsett = Mysql_Klar($_GET['Oppsett']);
  if(!empty($Oppsett)) { 
  
  mysql_query("UPDATE brukere SET Meny='$Oppsett' WHERE brukernavn LIKE '$brukernavn'");
  }}


  // Logger for crew medlemmer
  elseif($_GET['Logger'] == 'Bruker') { include "Brukerkontroll.inc.php"; }
  elseif($_GET['Logger'] == 'Modkill') { include "Modkill.inc.php"; }
  elseif($_GET['Logger'] == 'Tidsstraff') { include "Tidsstraff.inc.php"; }
  elseif($_GET['Logger'] == 'IpBan') { include "IpBan.inc.php"; }
  elseif($_GET['Logger'] == 'GiStilling') { include "SettStilling.inc.php"; }
  elseif($_GET['Logger'] == 'Funksjoner') { include "Funksjonliste.inc.php"; }
  elseif($_GET['Logger'] == 'Alle') { include "loggoversikt.inc.php"; }
  elseif($_GET['Logger'] == 'Drap') { include "drapslogg.inc.php"; }
  elseif($_GET['Logger'] == 'Bunker') { include "bunkerlogg.inc.php"; }
  elseif($_GET['Logger'] == 'Bank') { include "banklogg.inc.php"; }
  elseif($_GET['Logger'] == 'Handel') { include "handellogg.inc.php"; }
  elseif($_GET['Logger'] == 'PoengBestilling') { include "poengbestillinger.inc.php"; }
  elseif($_GET['Logger'] == 'Ssp') { include "ssplogg.inc.php"; }
  elseif($_GET['Logger'] == 'Blackjack') { include "bjlogg.inc.php"; }
  elseif($_GET['Logger'] == 'Pm') { include "Pm.inc.php"; }
  elseif($_GET['Logger'] == 'IpLogg') { include "IpLogg.inc.php"; }

  // New logs

  elseif($_GET['Logger'] == 'Alle_') { include "./common/files/admin/logger/main.php"; }
  elseif($_GET['Logger'] == 'botcheck') { include "./common/files/admin/logger/botcheck.php"; }


  // Finn spiller
  elseif($_GET['FinnSpiller'] == 'True') { include "finnspiller.inc.php"; }
  
  // Spillere p�logget
  elseif($_GET['AddFriend']) { include "addvenn.inc.php"; }
  elseif($_GET['MebOnline'] == 'True') { include "online.inc.php"; }
  
  // Innboks
  elseif($_GET['MeldLest']) { $Iden = Dekrypt_Tall(Mysql_Klar($_GET['MeldLest']));  mysql_query("UPDATE pm_system SET lest_ell='Ja' WHERE til_bruker='$brukernavn' AND id='$Iden'"); }
  elseif($_GET['du_valgte'] == 'Innboks') { include "innboks.inc.php"; }

  // Game Logg
  elseif($_GET['du_valgte'] == 'GameLogg') { include "gamelogg.inc.php"; }
   
     // Post chat svar  
  elseif(isset($_POST['du_valgte']))  {
    if($_POST['du_valgte'] == 'Chat') { 
      $Melding = Mysql_Klar($_POST['ChatPost']);
      if(empty($Melding)) { echo "Meldingen mangler."; }
    } elseif(strlen($Melding) > '600') { echo "Meldingen er for lang."; } else {
    
      mysql_query("INSERT INTO `chat` (message,dato,stamp,bruker) VALUES ('$Melding','$FullDato','$Timestamp','$brukernavn')");
      echo "Meldingen er postet.";
   }
 } 
  
  // Else post chat tekst
  elseif(isset($_GET['SkrivChat'])) { 

  $HentChat = mysql_query("SELECT * FROM chat WHERE id LIKE '%' ORDER BY `id` DESC LIMIT 0, 50");
  if(mysql_num_rows($HentChat) == '0') {
    $Tekst = 'Det er ingen meldinger i chatten.';
  } else {  
    $Tekst = "";
    while($row = mysql_fetch_assoc($HentChat)) {
      $Melding = smil(html_entity_decode($row['message']));
      $Tekst .= "<font style=\"color:#348e34;\"><b>".$row['dato']."</b> <b>[</b> ".BrukerURL($row['bruker'])." <b>]</b> </font><br><font style=\"color:#8e6234; font-size:12px;\">$Melding</font><br>"; 
  }}


  $VarSend = array('1' => $Tekst);
  echo json_encode($VarSend);
  exit;
  }



    
  // Else vis info
  elseif(isset($_GET['VisInfo'])) { 

  $Innboks = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Nei' AND slettet_ell='Nei' AND lest_ell='Nei'");
  if($Kjon == 'Gutt') { if (mysql_num_rows($Innboks) == 0) { $Bilde = '<img class="BunnIMG" src="../Design/melding2.jpg">'; } else { $Bilde = '<img style="cursor:pointer;" onclick="$(\'#SB_Midten2\').load(\'post.php?du_valgte=Innboks\');" class="BunnIMG" src="../Design/melding3.jpg">'; }} else { if (mysql_num_rows($Innboks) == 0) { $Bilde = '<img class="BunnIMG" src="../Design/Jente_Bilde.gif">'; } else { $Bilde = '<img style="cursor:pointer;" onclick="$(\'#SB_Midten2\').load(\'post.php?du_valgte=Innboks\');" class="BunnIMG" src="../Design/Jenter_Bilde_mld.gif">'; }}
  $Inn_A = "Innboks <font class=\"Tider\">(".mysql_num_rows($Innboks)." brev)</font>";

  $Pa = mysql_query("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $Timestamp");
  $Pa_A = "Online <font class=\"Tider\">(".mysql_num_rows($Pa)." stk)</font>";
  $Hor = mysql_query("SELECT * FROM Horehus WHERE Bang_by='$Land' AND Bang_stamp_over > '$Timestamp'");
  if(mysql_num_rows($Hor) >= '1') { $HPers = "pers"; } else { $HPers = ""; }
  $Hor_A = "Bordellet <font class=\"Tider\">(".mysql_num_rows($Hor)." $HPers)</font>";
  $Trener = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND trener_ell LIKE '1' AND skytetrening_over > $Timestamp");
  if(mysql_num_rows($Trener) >= '1') { $Tren_A = "Våpentrening <font class=\"Tider\">(Trener)</font>"; } else { $Tren_A = 'Våpentrening'; }

  $Butt = mysql_query("SELECT * FROM Butikker WHERE Butikk_eier LIKE '$brukernavn'");
 
  $Kff = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn'");
  $DineFirms = mysql_num_rows($Butt) + mysql_num_rows($Kff);
  if($DineFirms >= '1') { $DineFirms = "Dine firma <font class=\"Tider\">($DineFirms stk)</font>"; } else { $DineFirms = "Dine firma"; }

  $B = mysql_query("SELECT * FROM Butikker WHERE Butikk_Land LIKE '$Land'");

  $K = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Sted='$Land'");
  $BLedig = mysql_num_rows($B) + mysql_num_rows($K);
  if($BLedig < '5') { $BLedig = "Start firma <font class=\"Viktig\">(Ledig plass)</font>"; } else { $BLedig = 'Start firma'; }

  $Feng = mysql_query("SELECT * FROM fengsel WHERE id LIKE '%' AND land='$Land' AND timestamp_over > '$tiden'");
  if(mysql_num_rows($Feng) >= '1') { $HFeng = " pers"; } else { $HFeng = ""; }
  $Feng_A = "Fengsel <font class=\"Tider\">(".mysql_num_rows($Feng)."$HFeng)</font>";
  $VarSend = array('1' => "$Hor_A",'2' => "$Inn_A",'3' => "$Pa_A",'4' => "$Tren_A",'5' => "$DineFirms",'6' => "$BLedig",'7' => "$Feng_A",'8' => "$Bilde");
  echo json_encode($VarSend);
  exit;
  }
  elseif($_GET['GjengHus']) { 

  $Hent = mysql_query("SELECT Gjenger.*,Gjeng_medlemmer.stilling,Gjeng_medlemmer.OppdragUtfort,Gjeng_medlemmer.Ventetid,Gjeng_medlemmer.id as dinid FROM Gjeng_medlemmer INNER JOIN Gjenger ON Gjenger.id=Gjeng_medlemmer.gjeng_id WHERE Gjeng_medlemmer.brukernavn='$brukernavn'");
  if(mysql_num_rows($Hent) >= '1') {
  $i = mysql_fetch_assoc($Hent);
  $G_Id = $i['id'];
  $G_NavnEr = $i['Gjeng_Navn'];
  $G_Bilde = $i['bilde'];
  $G_Infoe = $i['tekst'];
  $G_Bombs = $i['Gjeng_Bombechips'];

  if($i['antall_gjenger'] == '1') { $GjengER = ""; }
  elseif($i['antall_gjenger'] == '2') { $GjengER = "- Dyade gjeng"; }
  elseif($i['antall_gjenger'] == '3') { $GjengER = "- Triade gjeng"; }

  $Valg = Mysql_Klar($_GET['GjengHus']);
  
  if($Valg == 'Medlemmer') { include "gjengmedlemmer.inc.php"; }
  elseif($Valg == 'Hovedkvarter') { include "gjengkvarter.inc.php"; }
  elseif($Valg == 'Krim') { include "gjengkrim.inc.php"; }
  elseif($Valg == 'Okonomi') { if($i['stilling'] == 'Boss') { include "gjengbank.inc.php"; } else { include "gjengdonering.inc.php"; }}
  exit;
  }}
    
  // Funksjoner til spillet over ----------------------------------------------------------------
  /*
  mysql_query("FLUSH PRIVILEGES");

  
  mysql_close();
  mysql_free_result();
  */
  } else { echo 'Du logges ut - xx token'; session_unset(); session_destroy(); exit; }
  ?>