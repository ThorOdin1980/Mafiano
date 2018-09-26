  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script> function Ansett() { 
  var Bruker = document.getElementById('S_Brukernavn').value;
  var Tidsfrist = document.getElementById('S_Tidsfrist').value;
  var Forfolg = document.getElementById('S_Forfolg').value;
  if(Bruker == 'Brukernavn' || Bruker == '') { alert('Brukernavn mangler.'); }
  else if(Bruker.length > '30') { alert('Brukernavnet er for langt.'); }
  else if(Tidsfrist == '20' || Tidsfrist == '30' || Tidsfrist == '40' || Tidsfrist == '50' || Tidsfrist == '60' || Tidsfrist == '70' || Tidsfrist == '80' || Tidsfrist == '90' || Tidsfrist == '100') { 
  if(Forfolg == 'IkkeForfolg' || Forfolg == 'Forfolg') { 
  document.getElementById('Tuborg').submit();
  } else { alert('Ugyldig forfølgelse.'); }
  } else { alert('Ugyldig tidsfrist.'); }}
  </script>

  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {

  function Oppdater($navn){
  global $Timestamp; 

  $ByPlass = mysql_fetch_object(mysql_query("SELECT land FROM brukere WHERE brukernavn LIKE '$navn'")); 
  $sted = $ByPlass->land; 

  $Kid = mysql_query("SELECT * FROM kidnapping WHERE offer='$navn' AND politi_finner > $Timestamp");
  if(mysql_num_rows($Kid) > '0') { $Tek = "Brukeren er Kidnappet<br>By: <b>".$sted."</b>"; } else { 
  $Syk = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$navn' AND timestampen_ute > $Timestamp");
  if(mysql_num_rows($Syk) > '0') { $Tek = "Brukeren ligger på sykehuset<br>By: <b>".$sted."</b>"; } else { 

  $Bunker = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$navn' AND timestamp_ute > $Timestamp");
  if(mysql_num_rows($Bunker) >= '1') { $Tek = "Brukeren er i bunker<br>By: <b>".$sted."</b>"; } else {

  $Fengsel = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$navn' AND timestamp_over > $Timestamp");
  if(mysql_num_rows($Fengsel) > '0') {  $Tek = "Brukeren er i fengsel<br>By: <b>".$sted."</b>"; } else {
  $Tek = "Fant brukeren i <b>".$sted."</b>";
  }}}}
  return $Tek;
  }
  
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Detektiv utleie</span><span class=\"Opprett\" onclick=\"$('html,body').animate({scrollTop: $('#LetEtter').offset().top},'slow');\">( Ansett detektiv )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/detective.jpg\"></td></tr>
  ";
  
  if(isset($_POST['S_Brukernavn'])) { 
  $Pot_Brukernavn = Mysql_Klar($_POST['S_Brukernavn']);
  $Pot_Tidsfrist = Mysql_Klar($_POST['S_Tidsfrist']);
  $Pot_Forfolg = Mysql_Klar($_POST['S_Forfolg']);
  
  if(empty($Pot_Brukernavn)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; }
  elseif(empty($Pot_Tidsfrist)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Tidsfrist mangler.</span></td></tr>"; }
  elseif(empty($Pot_Forfolg)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Forfølgelse mangler.</span></td></tr>"; }
  elseif($Pot_Tidsfrist == '20' || $Pot_Tidsfrist == '30' || $Pot_Tidsfrist == '40' || $Pot_Tidsfrist == '50' || $Pot_Tidsfrist == '60' || $Pot_Tidsfrist == '70' || $Pot_Tidsfrist == '80' || $Pot_Tidsfrist == '90' || $Pot_Tidsfrist == '100') { 
  if($Pot_Forfolg == 'IkkeForfolg' || $Pot_Forfolg == 'Forfolg') { 
  if(strlen($Pot_Brukernavn) > '27') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavnet er for langt.</span></td></tr>"; } else {

  $HentOffer = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Pot_Brukernavn'");
  if(mysql_num_rows($HentOffer) == 0) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Det eksisterer ingen med det navnet.</span></td></tr>"; } else { 
  $OfferInfo = mysql_fetch_assoc($HentOffer);
  $Pot_Brukernavn = $OfferInfo['brukernavn'];
  $Pot_Liv = $OfferInfo['liv'];
  $Pot_Type = $OfferInfo['type'];
  if($Pot_Brukernavn == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke søke etter egen bruker.</span></td></tr>"; }
  elseif($Pot_Liv < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Pot_Brukernavn er død.</span></td></tr>"; } else { 
  if($Pot_Forfolg == 'IkkeForfolg') { $ekstrapris = '0'; $ekstra_min = 'Nei'; } else { $ekstrapris = '20000'; $ekstra_min = 'Ja'; }
  $sokepris = $Pot_Tidsfrist * '100';
  $pris_blir = floor($ekstrapris + $sokepris);
  $timestamp_lengde = $Pot_Tidsfrist * '60';
  $tiden_sok_ferdig = $tiden + $timestamp_lengde;
  if($pris_blir > $penger) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du har ikke nok penger.</span></td></tr>"; } else { 
  $ny_sum_spenn = floor($penger - $pris_blir);

  mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("INSERT INTO drepe_soking (sokers_navn, soker_etter, timestampen, time_sok_over, antall_min, dato_startet, ekstra_min) VALUES ('$brukernavn','$Pot_Brukernavn','$Timestamp','$tiden_sok_ferdig','$Pot_Tidsfrist','$AnnenDato','$ekstra_min')"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Du har ansatt en detektiv for å finne $Pot_Brukernavn.</span></td></tr>";
  }}}}} else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig forfølgelse.</span></td></tr>"; }
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig tidsfrist.</span></td></tr>"; }
  }

  $IkkeVis = $Timestamp - '72000';

  $HentInn = mysql_query("SELECT * FROM drepe_soking WHERE sokers_navn='$brukernavn' AND time_sok_over > '$IkkeVis' ORDER BY `timestampen` DESC");
  if(mysql_num_rows($HentInn) >= '1') {
  $FemEkstra = $Timestamp - '300'; $Tell = '0';
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Søker</td><td class=\"R_4\">Status</td><td class=\"R_4\">Startet</td></tr>";
  while($i = mysql_fetch_assoc($HentInn)) {
  $Tell++; 
  $L_Soker = $i['soker_etter'];

  $TelleID = $Tell."Let";
  // Status
  if($i['befinner_seg'] == 'Søker') { $SekLet = $i['time_sok_over'] - $Timestamp; $Re = "Leter ( <font id=\"$TelleID\" class=\"TellNed\">$SekLet</font> sek )"; } 
  elseif($i['befinner_seg'] == 'Feilet') { $Re = "<b>Feilet</b>"; }
  elseif($i['befinner_seg'] == 'Vellykket' && $i['ekstra_min'] == 'Nei') { $Re = "Sist sett i <b>".$i['bosted']."</b>"; }
  elseif($i['befinner_seg'] == 'Vellykket' && $i['ekstra_min'] == 'Ja') { if($i['time_sok_over'] < $FemEkstra) { $Re = "Sist sett i <b>".$i['bosted']."</b>"; } else {  $SekLet = $i['time_sok_over'] - $FemEkstra; $Re = Oppdater($L_Soker)."<br>Forfølger spiller ( <font id=\"$TelleID\" class=\"TellNed\">$SekLet</font> sek )"; }}
  
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  echo "<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerUrl($L_Soker)."</td><td class=\"Linje Plassering\">$Re</td><td class=\"Linje Plassering\">".$i['dato_startet']."</td></tr>";

        
  
  }}
  
  if(empty($Klasse) || $Klasse == 'Vanlig_1') { $Klasse = 'Vanlig_2'; } else { $Klasse = 'Vanlig_1'; }
  
  echo "
  <tr class=\"$Klasse\" colspan=\"3\" id=\"LetEtter\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\"><form method=\"post\" id=\"Tuborg\"></div>
  <input type=\"text\" name=\"S_Brukernavn\" id=\"S_Brukernavn\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select name=\"S_Tidsfrist\" id=\"S_Tidsfrist\"><option value=\"20\">20 min - 2.000 kr - 20% sjangs</option><option value=\"30\">30 min - 3.000 kr - 30% sjangs</option><option value=\"40\">40 min - 4.000 kr - 40% sjangs</option><option value=\"50\">50 min - 5.000 kr - 50% sjangs</option><option value=\"60\">60 min - 6.000 kr - 60% sjangs</option><option value=\"70\">70 min - 7.000 kr - 70% sjangs</option><option value=\"80\">80 min - 8.000 kr - 80% sjangs</option><option value=\"90\">90 min - 9.000 kr - 90% sjangs</option><option value=\"100\">100 min - 10000 kr - 95% sjangs</option></select>
  <select name=\"S_Forfolg\" id=\"S_Forfolg\"><option value=\"IkkeForfolg\">Ikke forfølg spilleren etter vellykket søk - 0 kr</option><option value=\"Forfolg\">Forfølg spilleren i 5 min ekstra ved vellykket søk - 20.000 kr</option></select></form>
  <p class=\"Post\" onclick=\"Ansett();\">Ansett detektiv!</p>
  </td></tr>
  ";
  

  echo "</table></div>";
  
  }
  ?>