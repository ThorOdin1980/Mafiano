  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
  
  // Sjekk kidnapping

  $S_1 = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
  if(mysql_num_rows($S_1) > '0') { header("Location: game.php?side=kidnappet"); } else { 

  // Sjekk sykehus
  $S_2 = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
  if(mysql_num_rows($S_2) > '0') { header("Location: game.php?side=Sykehus"); } else { 

  // Sjekk bunker

  $S_3 = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$brukernavn' AND godtatt_elle LIKE '1'");
  if(mysql_num_rows($S_3) >= '1') { header("Location: game.php?side=Bunker"); } else {
  
  // Sjekk fengsel

  $S_4 = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$brukernavn'");
  if(mysql_num_rows($S_4) > '0') { include "Annensider/Abc_fengsel_sitterinne.php"; } else {
  
  // Oppdrag bryt ut
  if($oppdrag_nr == '2') {      
  $Tony = substr($OppdragNiva, 0, 17);
  $Abdulhai = substr($OppdragNiva, 17, 21);
  $Lee = substr($OppdragNiva, 38, 11);
  $XxTony = ereg_replace("[^0-9]", "", $Tony);
  $XxAbdulhai = ereg_replace("[^0-9]", "", $Abdulhai);
  $XxLee = ereg_replace("[^0-9]", "", $Lee);
  $Tony = substr($Tony, 0, 13); 
  $Abdulhai = substr($Abdulhai, 0, 17);
  $Abdulhai2 = substr($Abdulhai, 0, 10);
  $Lee = substr($Lee, 0, 8);
  }

  echo "<div class=\"Div_masta\">
  <table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Fengsel</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Fengsel.jpg\"></td></tr>";
  $Hent = mysql_query("SELECT * FROM fengsel WHERE id LIKE '%' AND land='$land' AND timestamp_over > '$tiden' ORDER BY `timestampen` DESC");
  if(mysql_num_rows($Hent) == '0') {
    echo "<tr><td colspan=\"3\" class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Ingen soner straff i $land for øyeblikket.</span></td></tr>";
  } else {
  $Tell = '0';
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Bruker</td><td class=\"R_4\">Straff</td><td class=\"R_4\">Bailout</td></tr>";
  
  while($i = mysql_fetch_assoc($Hent)) { 
  $Tell++; if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  $Straff = $i['timestamp_over'] - $tiden;
  $TelleID = $Tell.'5000';
  echo "<tr class=\"$Klasse Ekstra\"><td class=\"Linje Plassering\">".BrukerURL($i['brukernavn'])."</td><td class=\"Linje Plassering\">".$i['tatt_for']." ( <font id=\"$TelleID\" class=\"TellNed\">$Straff</font> sek )</td><td class=\"Linje Plassering\">".VerdiSum($i['kjop_ut_sum'],'kr')."</td></tr>";
  }}
  
  if(empty($Klasse)) { $Klasse = 'Vanlig_1'; } elseif($Klasse == 'Vanlig_1') { $Klasse = 'Vanlig_2'; } elseif($Klasse == 'Vanlig_2') { $Klasse = 'Vanlig_1'; }

  echo "<tr class=\"$Klasse\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\"><p style=\"float:left;\" onclick=\"\" class=\"PostEn\">Bryt ut</p><p style=\"float:right;\" onclick=\"\" class=\"PostEn\">Kjøp ut</p></td></tr>";
  echo "</table></div>";

  }}}}}
  ?>