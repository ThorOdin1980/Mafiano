  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css">
  .Lenke:hover { cursor:pointer; font-weight:bold; }
  .ProfilTekst { float: left; width: 490px; background-color:#303030; margin-top:2px; margin-left:2px; border-bottom-style: solid; border-bottom-width: 1px; }
  .PI { float:left; width:480px; margin:5px; min-height:100px; color:#ffffff; }
  .PI ul, .PI ol { /*margin: 0; /*10px 0 10px 15px*/ padding: 0 0 0 1.8em; /*position: relative;*/ }
  .PI ol { /*margin: 0; /*10px 0 10px 10px*/ /*padding: 0; /*0 0 0 25px*/ /*position: relative;*/ }
  .PI ul li, .PI ol li { /*margin: 0; padding: 0; /*position: relative;*/ }  
  </style>
  <?
  if (empty($brukernavn)) { header("Location: index.php"); } 
  elseif(empty($_REQUEST['navn']) && empty($_REQUEST['id'])) { header("Location: index.php"); } else { 
  $bruker = Mysql_Klar($_REQUEST['navn']);
  $bruker2 = Mysql_Klar($_REQUEST['id']);
  

  if(!empty($bruker)) { $Bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$bruker'"); } else { $Bruker = mysql_query("SELECT * FROM brukere WHERE brukerid='$bruker2'"); }
  if(mysql_num_rows($Bruker) == '0') { Header("Location: game.php?side=hoved"); } else {
  $I = mysql_fetch_assoc($Bruker);
  $I_Brukernavn = $I['brukernavn'];
  $I_Profilbilde = Mysql_Klar($I['profilbilde']);
  $I_Navn = Mysql_Klar($I['navn']);
  $I_UrlNavn = urlencode($I_Brukernavn);
  $I_SistAktiv = RegnTid(Bare_Siffer((($I['aktiv_eller'] - '3600') - $Timestamp)));
  $I_Onlineet = RegnTid(Bare_Siffer(($I['timestamp_inne'] - $Timestamp)));

  if(empty($I['gjeng'])) { $I_Gjeng = 'Ingen'; } else { $I_Gjeng = '<a href="game.php?side=Gjeng&navn='.urlencode($I['gjeng']).'">'.$I['gjeng'].'</a>'; } 

  // Oppdater besøkslisten
  if($brukernavn == $I_Brukernavn) { } else {

  $H = mysql_query("SELECT * FROM besok_profil WHERE besok_navn='$I_Brukernavn' AND ditt_navn='$brukernavn'");
  if(mysql_num_rows($H) == 0) { 

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("INSERT INTO `besok_profil` (besok_navn,ditt_navn,timestampen,dato) VALUES ('$I_Brukernavn','$brukernavn','$Timestamp','$FullDato')"); 
  } else {

  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("UPDATE besok_profil SET timestampen='$Timestamp',dato='$FullDato' WHERE besok_navn='$I_Brukernavn' AND ditt_navn='$brukernavn'");
  }}

  // function ta vekk php og javascript
  function RenskHTML($var) { $var = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $var); return $var; }
  
  function MP($var) { $var = preg_replace('/\[mp3\](.*?)\[\/mp3\]/is', "<object type=\"application/x-shockwave-flash\" data=\"http://flash-mp3-player.net/medias/player_mp3_multi.swf\" width=\"200\" height=\"100\"><param name=\"movie\" value=\"http://flash-mp3-player.net/medias/player_mp3_multi.swf\" /><param name=\"bgcolor\" value=\"#303030\" /><param name=\"FlashVars\" value=\"mp3=$1\" /></object>", $var); return $var; }
  
  // Cash status
  if($I['penger'] < '10000') { $I_Pengestatus = 'Boms'; } 
  if($I['penger'] >= '10000') { $I_Pengestatus = 'Fattig'; }
  if($I['penger'] >= '60000') { $I_Pengestatus = 'Streber'; }
  if($I['penger'] >= '300000') { $I_Pengestatus = 'Arbeider'; }
  if($I['penger'] >= '700000') { $I_Pengestatus = 'Vellykket arbeider'; }
  if($I['penger'] >= '1000000') { $I_Pengestatus = 'Overklasse'; }
  if($I['penger'] >= '2000000') { $I_Pengestatus = 'Millionær'; }
  if($I['penger'] >= '10000000') { $I_Pengestatus = 'Mange millionær'; }
  if($I['penger'] >= '100000000') { $I_Pengestatus = 'Farlig rik'; }
  if($I['penger'] >= '1000000000') { $I_Pengestatus = 'Milliardær'; }
  if($I['penger'] >= '5000000000') { $I_Pengestatus= 'Vellykket milliardær'; }
  if($I['penger'] >= '1000000000000') { $I_Pengestatus = 'Billionær'; }

  // Andre statuser
  $I_Drapstatus = DrapStatus($I['drap']);
  $I_Stiling = Stilling($I['type']);
  if($I_Brukernavn == 'Dirty krystal' && $oppdrag_nr >= '4') { $Livi = '0'; } else { $Livi = $I['liv']; }
  if($Livi == 0) { $I_Livsstatus = '<font color="red">Død</font>'; } elseif($Livi > 0) { $I_Livsstatus = '<font color="green">Lever</font>'; }
  if($I['aktiv_eller'] < $tiden) { $I_Online = 'og <font color="red">Avlogget</font>'; } elseif($I['aktiv_eller'] > $tiden) { $I_Online = 'og <font color="green">Pålogget</font>'; }
  if($I['Kjon'] == 'Gutt') { $I_KjonsBilde = '<img style="float:right; margin-right: 3px;" border="0" src="../Design/gutt.jpg">'; } else { $I_KjonsBilde = '<img style="float:right; margin-right: 3px;" border="0" src="../Design/jente.jpg">'; }
  
  // Sjekk om brukeren har en straff

  $Straffer = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$I_Brukernavn' AND StampOver > '$tiden'");
  if(mysql_num_rows($Straffer) >= '1') { $Straff = "( <font color=\"red\">Soner en straff</font> )";  } else { $Straff = "( $I_Livsstatus $I_Online )"; }

  
  echo "<div class=\"Div_masta\">";
  
  // MafiaNo Crew panel
  $Ekstra = Mysql_Klar($_REQUEST['TikkTakkMistaSkittFakk']);
  if(!empty($Ekstra)) { 
  if($type == 'A' || $type == 'm') { 
  if($Ekstra == 'Bruker' || $Ekstra == 'IpLogg') { 
  switch($Ekstra) {
  case "Bruker": include "Annensider/Abc_BrukerInfo.php"; break;
  case "IpLogg": include "Annensider/Abc_BrukerIpLogg.php"; break;
  default: echo "";
  }}}}
  
  echo "<div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">BRUKERPROFIL</span></div>";
  
  // Profilbilde
  if(empty($I['profilbilde']) || $I['profilbilde'] == 'http://') { if($I['Kjon'] == 'Gutt') { echo "<div class=\"Div_MELDING\"><p align=\"center\"><img style=\"max-width:480px; max-height: 250px;\" border=\"0\" src=\"bilder.php?b=$I_Brukernavn&k=Gutt\"></p></div>"; } else { echo "<div class=\"Div_MELDING\"><p align=\"center\"><img style=\"max-width:480px; max-height: 250px;\" border=\"0\" src=\"bilder.php?b=$I_Brukernavn&k=Jente\"></p></div>"; }} else { echo "<div class=\"Div_MELDING\"><p align=\"center\"><A class=thickbox title=\"\" href=\"$I_Profilbilde\"><img style=\"max-width:480px; max-height: 250px;\" border=\"0\" src=\"$I_Profilbilde\"></A></p></div>"; }
  
  // Legg til kontakt
  $Venn = mysql_real_escape_string($_REQUEST['LeggTilSom']); if(!empty($Venn)) { if($Venn == 'Bekjent' || $Venn == 'Venninne' || $Venn == 'Venn' || $Venn == 'Blodfinde') { if($brukernavn != $I_Brukernavn) { if($I['Kjon'] == 'Gutt' && $Venn == 'Venninne') { $Venn = 'Venn'; } elseif($I['Kjon'] == 'Jente' && $Venn == 'Venn') { $Venn = 'Venninne'; }  $LEGG_TIL = mysql_query("SELECT * FROM kontakter WHERE dittbrukernavn='$brukernavn' AND kontaktnavn='$I_Brukernavn'"); if(mysql_num_rows($LEGG_TIL) == 0) { mysql_query("INSERT INTO `kontakter` (kontaktnavn,dittbrukernavn,status,timestampen) VALUES ('$I_Brukernavn','$brukernavn','$Venn','$Timestamp')"); echo PrintTeksten('Du har lagt til personen i kontaktlisten din.','1','Vellykket'); } else { mysql_query("UPDATE kontakter SET status='$Venn' WHERE kontaktnavn='$I_Brukernavn' AND dittbrukernavn='$brukernavn'"); echo PrintTeksten('Du har endret vennskapet til personen.','1','Vellykket'); }}}}
  
  echo "
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><span class=\"Lenke\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Innboks&Meld=True&Til=$I_UrlNavn');\">$I_Brukernavn</span> $I_Stiling $Straff</span>$I_KjonsBilde&nbsp;</div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Rank</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$I['rank']." ( $I_Pengestatus ) ( $I_Drapstatus )</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjeng</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$I_Gjeng</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Registrert</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$I['regtid']."</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Sist pålogget</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$I['sistinne'].", det er ( $I_Onlineet ) siden</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Sist aktiv</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">Siste aktivet ble gjort for ( $I_SistAktiv ) siden</span></div>
  <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Navn</span></div>
  <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$I_Navn</span></div>
  ";
  
  // Legg til en kontakt
  if($brukernavn != $I_Brukernavn) { echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kontakt?</span></div><div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Kontakter')\"><div id=\"Velg alternativ\" class=\"Span_str_9\">Legg til $I_Brukernavn i netverket ditt</div><div id=\"Kontakter\" class=\"D_Boks\">"; if($I['Kjon'] == 'Gutt') { echo "<div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Bekjent\"'>---> Bekjent</div><div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Venn\"'>---> Venn</div><div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Blodfinde\"'>---> Blodfinde</div>"; } else { echo "<div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Bekjent\"'>---> Bekjent</div><div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Venninne\"'>---> Venninne</div><div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&LeggTilSom=Blodfinde\"'>---> Blodfinde</div>"; } echo "</div></div>"; }
  
  // Se informasjon om brukeren
  if($type == 'A' || $type == 'm') { 
  echo "<div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Crew panel</span></div><div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('CrewPanel')\"><div id=\"Velg alternativ\" class=\"Span_str_9\">Se informasjon om $I_Brukernavn</div><div id=\"CrewPanel\" class=\"D_Boks\">
  <div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&TikkTakkMistaSkittFakk=Bruker\"'>---> Bruker informasjon</div>
  <div class=\"D_Over\" onclick='document.location.href=\"game.php?side=Bruker&navn=$I_Brukernavn&TikkTakkMistaSkittFakk=IpLogg\"'>---> Ip logg</div>
  </div></div>";
  }
  
  // Brukerinfo
  echo "<div class=\"ProfilTekst\"><div class=\"PI\">".RenskHTML(MP(htmlspecialchars_decode($I['info'])))."</div></div>";
  
  // Besøk på profilen
  echo "<div class=\"Div_MELDING\">";
 $Besok = mysql_query("SELECT * FROM besok_profil WHERE besok_navn='$I_Brukernavn' ORDER BY `timestampen` DESC LIMIT 0, 5"); if(mysql_num_rows($Besok) == 0) { echo '<img style="Margin-left:5px;" border="0" src="ingen.png">'; } else { while($IA = mysql_fetch_assoc($Besok)) { $Besok_Navn = $IA['ditt_navn'];  $HentInfo = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Besok_Navn'"); $AI = mysql_fetch_assoc($HentInfo); if($AI['Kjon'] == 'Gutt') { echo '<a href="game.php?side=Bruker&navn='.urlencode($Besok_Navn).'"><img style="Margin-left:5px;" width="92" height="82" border="0" src="bilder2.php?b='.$Besok_Navn.'"></a>'; } else { echo '<a href="game.php?side=Bruker&navn='.urlencode($Besok_Navn).'"><img style="Margin-left:5px;" width="92" height="82" border="0" src="bilder3.php?b='.$Besok_Navn.'"></a>'; }}}
  echo "</div>";
  
  echo "</div>";
  }}
  ?>