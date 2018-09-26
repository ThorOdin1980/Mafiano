  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Hærverk', 'herverk_funksjon1', time(), $db);
  
  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  if($herverk_gjort >= '0') { $Feng = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '2') { $Feng = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '4') { $Feng = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '6') { $Feng = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $Feng = $Feng[array_rand($Feng)];
    
  $NyVentetid = $Timestamp + '210';
  $NyHerverk = $herverk_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $FeilRankpros = $rankpros + '0.0001';
  $Straff = $Timestamp + '210';
  $Chips = rand(1, 3); 
  

  $VelgBil = mysql_query("SELECT * FROM garage WHERE land='$land' AND eier NOT LIKE '$brukernavn' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($VelgBil) == '0') { 
  $Meld = array("Purken var i nerheten, du dreit i å vandalisere en bil.","Det var for mange folk tilstede, du stakk hjem istedenfor.","Du så bare biler med alarm, du droppa derfor ideen om å ødelegge en medspillers bil.","Du fant desverre ingen biler i $land.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  } else { 
  $BilInfo = mysql_fetch_assoc($VelgBil);
  $H_Eier = $BilInfo['eier'];
  $H_Merke = $BilInfo['bilmerke'];
  $H_Skade = $BilInfo['skade'];
  $H_Id = $BilInfo['id'];
  
  if($Avgjor == 'JA') { 
  $SkadPros = rand (2, 8);
  $NySkade = floor($H_Skade + $SkadPros);
  $NyChips = floor($bombechips + $Chips);

  if($NySkade >= '100') { $Meld = array("Du totalvraka en $H_Merke.","Du totalvraka en av bilene til $H_Eier."); mysql_query("DELETE FROM garage WHERE id='$H_Id'"); } else { $Meld = array("Du punkterte dekkene på en random bil, bilens skade har økt med $SkadPros prosent.","Du drilla et høl i panseret til en $H_Merke, bilens skade har økt med $SkadPros prosent.","Du bulka opp bilen til $H_Eier, bilens skade har økt med $SkadePros prosent.","Du ripa opp lakken på en $H_Merke, bilens skade har økt med $SkadePros prosent."); mysql_query("UPDATE garage SET skade='$NySkade' WHERE id='$H_Id'"); }

  if($NySkade >= '100') { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Bil totalvraket','En medspiller totalvraket en av bilene dine i $land, bilmerket til bilen var $H_Merke.','Ja')"); } else { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Bil skadet','En medspiller har utført herverk på en av bilene dine i $land, bilmerket til bilen var $H_Merke.','Ja')"); }
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
  $Meld = array("Du klarte ikke å vandalisere en bil.","Du turte ikke å vandalisere en bil.","Du fant en bil men du fikk vite at det var bilen til $BIL_eier så du feiga ut.","Du sovna på veien til byen.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}}
  ?>