  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
  botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Hærverk', 'herverk_funksjon3', time(), $db); 
  
  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  if($herverk_gjort <= '11') { $Feng = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '12') { $Feng = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '15') { $Feng = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '25') { $Feng = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $Feng = $Feng[array_rand($Feng)];
    
  $NyVentetid = $Timestamp + '210';
  $NyHerverk = $herverk_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $FeilRankpros = $rankpros + '0.0001';
  $Straff = $Timestamp + '210';
  $Chips = rand(6, 9); 
  

  $VelgBat = mysql_query("SELECT * FROM fly_osv WHERE Frakt_sted='$land' AND type='2' AND Frakt_eier NOT LIKE '$brukernavn' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($VelgFly) == '0') {  
  $Meld = array("Du Fant ingen fly i $land.","Purken var i nerheten, du dreit i å vandalisere et fly.","Det var for mange folk tilstede, du stakk hjem istedenfor.","Du fant desverre ingen fly i $land.","Du feiga ut.","Du falt på veien til flyplassen, du dro hjem med skade i beinet.","Du viste ikke åssen du skulle ødelegge flyet og stakk derfor av.","Du viste ikke hvor flyplassen var.","Det var ingen fly på flyplassen.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  } else {
  $BatInfo = mysql_fetch_assoc($VelgBat);
  $H_Eier = $BatInfo['Frakt_eier'];
  $H_Merke = $BatInfo['frakt_type'];
  $H_Skade = $BatInfo['Frakt_skade'];
  $H_Id = $BatInfo['id'];
  
  if($Avgjor == 'JA') { 
  $SkadePros = array("0.1","0.2","0.3","0.4","0.5","0.6","0.7","0.8","0.9");
  $SkadePros = $SkadePros[array_rand($SkadePros)];
  $NySkade = $H_Skade + $SkadePros;
  $NyChips = floor($bombechips + $Chips);

  if($NySkade >= '100') { $Meld = array("Du totalvraka en $H_Merke.","Du totalvraka et av flyene til $H_Eier.","Flyet til $H_Eier er nå totalvraka."); mysql_query("DELETE FROM fly_osv WHERE id='$H_Id'"); } else { $Meld = array("Du punkterte dekkene på et fly, flyets skade har økt med $SkadePros prosent.","Du drilla et høl i karroseriet til en $H_Merke, flyets skade har økt med $SkadePros prosent.","Du bulka opp flyet til $H_Eier, flyets skade har økt med $SkadePros prosent.","Du ripa opp lakken på en $H_Merke, flyets skade har økt med $SkadePros.","Du kasta steiner på et fly i $land.","Du sprengte døra på flyet til $H_Eier.","Du drilla et høl i ett av vinduene på flyet.","Du skar et kutt i hver av vingene på flyet."); mysql_query("UPDATE fly_osv SET Frakt_skade='$NySkade' WHERE id='$H_Id'"); }

  if($NySkade >= '100') { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Fly totalvraket','En medspiller har totalvraka en av flyene dine i $land, flymerket til flyet var $H_Merke.','Ja')"); } else { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Fly skadet','En medspiller har utført herverk på en av flyene dine i $land, flymerket til flyet var $H_Merke.','Ja')"); }
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$NyRankpros',aktiv_eller='$Aktiv',bombechips='$NyChips' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">$Meld</span></td></tr>";  
  }
  elseif($Feng == 'JA') { 
  $Meld = array("Purken var der, du ble busta.","Purken så deg å kasta deg på cella.","Du ble busta av ei purkdame.","Du ble arrestert under vandalismen.","Purken så deg drive på, poltimannen slo deg ned med knokejern å kasta deg på cella.","En politidame angrep deg mens du drev på, du ble bøsta.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hærverk','3.5','3500000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>"; 
  } else { 
  $Meld = array("Du klarte ikke å vandalisere et fly.","Du turte ikke å vandalisere et fly.","Du fant et fly men du fikk vite at det var flyet til $H_Eier så du feiga ut.","Du sovna på veien til flyplassen.","Du kom ikke igjenom gjerdet på flyplassen.","Du orka ikke å gå til flyplassen så du bestemte deg for å ta sykkelen men sykkeln din var vist stjelt.","Du feilet.","Du så en bekjent på veien til flyplassen, du stoppa og slo av en samtale med kisen, du feilet.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}}
  ?>