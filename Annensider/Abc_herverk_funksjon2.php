  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Hærverk', 'herverk_funksjon2', time(), $db);
  
  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  if($herverk_gjort <= '5') { $Feng = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '6') { $Feng = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '10') { $Feng = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '15') { $Feng = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $Feng = $Feng[array_rand($Feng)];
    
  $NyVentetid = $Timestamp + '210';
  $NyHerverk = $herverk_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $FeilRankpros = $rankpros + '0.0001';
  $Straff = $Timestamp + '210';
  $Chips = rand(3, 6); 
  

  $VelgFly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_sted='$land' AND type='1' AND Frakt_eier NOT LIKE '$brukernavn' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($VelgFly) == '0') {  
  $Meld = array("Det er ingen båter i denne byen.","Du fant ikke en eneste båt i $land.","Det var ingen båter i havna.","Purken var i nerheten, du dreit i å vandalisere en båt.","Det var for mange folk tilstede, du stakk hjem istedenfor.","Du fant desverre ingen båter i $land.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  } else {
  $FlyInfo = mysql_fetch_assoc($VelgFly);
  $H_Eier = $FlyInfo['Frakt_eier'];
  $H_Merke = $FlyInfo['frakt_type'];
  $H_Skade = $FlyInfo['Frakt_skade'];
  $H_Id = $FlyInfo['id'];
  
  if($Avgjor == 'JA') { 
  $SkadePros = array("0.1","0.2","0.3","0.4","0.5","0.6","0.7","0.8","0.9");
  $SkadePros = $SkadePros[array_rand($SkadePros)];
  $NySkade = $H_Skade + $SkadePros;
  $NyChips = floor($bombechips + $Chips);

  if($NySkade >= '100') { $Meld = array("Du totalvraka en $H_Merke.","Du totalvraka en av båtene til $H_Eier."); mysql_query("DELETE FROM fly_osv WHERE id='$H_Id'"); } else { $Meld = array("Du knuste litt av skroget på en båt, båtens skade har økt med $SkadePros prosent.","Du drilla et høl i skroget til en $H_Merke, båtens skade har økt med $SkadePros prosent.","Du bulka opp båten til $H_Eier, båtens skade har økt med $SkadePros prosent.","Du ripa opp lakken på en $H_Merke, båtens skade har økt med $SkadePros prosent."); mysql_query("UPDATE fly_osv SET Frakt_skade='$NySkade' WHERE id='$H_Id'"); }

  if($NySkade >= '100') { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Båt totalvraket','En medspiller har totalvraket en av båtene dine i $land, båtmerket til båten var $H_Merke.','Ja')"); } else { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Båt skadet','En medspiller har utført herverk på en av båtene dine i $land, båtmerket til båten var $H_Merke.','Ja')"); }
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$NyRankpros',aktiv_eller='$Aktiv',bombechips='$NyChips' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">$Meld</span></td></tr>";  
  }
  elseif($Feng == 'JA') { 
  $Meld = array("Purken var der, du ble busta.","Purken så deg og kastet deg på cella.","Du ble busta av ei purkdame.","Du ble arrestert under vandalismen.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hærverk','3.5','3500000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>"; 
  } else { 
  $Meld = array("Du klarte ikke å vandalisere en båt.","Du turte ikke å vandalisere en båt.","Du fant en båt men du fikk vite at det var båten til $H_Eier så du feiga ut.","Du sovna på veien til båthavna.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}}
  ?>