  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Hærverk', 'herverk_funksjon5', time(), $db);
  
  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  if($herverk_gjort <= '24') { $Feng = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '26') { $Feng = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '30') { $Feng = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '40') { $Feng = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $Feng = $Feng[array_rand($Feng)];
    
  $NyVentetid = $Timestamp + '210';
  $NyHerverk = $herverk_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $FeilRankpros = $rankpros + '0.0001';
  $Straff = $Timestamp + '210';
  $Chips = rand(12, 15); 
  $Skade = array("0.34","0.36","0.38");
  $Skade = $Skade[array_rand($Skade)];
  

  $Butikk = mysql_query("SELECT * FROM Butikker WHERE id LIKE '%' AND Butikk_Land='$land' AND Butikk_Gjeng NOT LIKE '$gjeng' AND Butikk_eier NOT LIKE '$brukernavn' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($Butikk) == '0') { 
  $Svar = array("Du feilet.","Bussen til byen hadde akuratt gått så du kom deg ikke til byen.","Du fant ikke en butikk du kunne herpe litt.","Du fant ingen butikker i $land."); 
  $Svar = $Svar[array_rand($Svar)];
 
  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Svar</span></td></tr>";
  } else { 
  $ButInfo = mysql_fetch_assoc($Butikk);
  $NySkade = $ButInfo['Butikk_skade'] - $Skade;
  $ID_Er = $ButInfo['id'];
  $Butikk_Navn = $ButInfo['Butikk_Navn'];
  $Eier = $ButInfo['Butikk_eier'];
  
  if($Avgjor == 'NEI') { 
  $Svar = array("Du feilet.","Du fant ikke fram til følgende butikk $Butikk_Navn.","$Butikk_Navn var så sikkret at du ikke klarte å komme inn i butikken.","Du ble kastet ut av $Eier i forsøket.","Du feilet i forsøket.");
  $Svar = $Svar[array_rand($Svar)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Svar</span></td></tr>";
  }
  elseif($Feng == 'JA') { 
  $Svar = array("Purken busta deg.","Du ble arrestert.","Politiet ble tilkalt, du ble arrestert.");
  $Svar = $Svar[array_rand($Svar)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hærverk','3.5','3500000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Svar</span></td></tr>"; 
  }
  elseif($NySkade < '1') { 
  $ChipsTjen = floor($bombechips + rand(400, 750)); 
  $RespektTjen = floor($respekt + rand(700, 1000));
  $NyRankpros = $NyRankpros + '6';

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Eier','$Timestamp','$AnnenDato','Butikk Nedlagt','Butikken din raste isammen.','Ja')");

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',bombechips='$ChipsTjen',respekt='$RespektTjen',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  if(!empty($gjeng) && !empty($ButInfo['Butikk_Gjeng']) && $gjeng != $ButInfo['Butikk_Gjeng']) { mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'3' WHERE Gjeng_Navn='$gjeng'"); mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'3' WHERE brukernavn='$brukernavn'"); }

  mysql_query("DELETE FROM Butikker WHERE id='$ID_Er'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Butikken til $Eier falt sammen, det er nå en butikkplass ledig, du fikk ekstra rankboost.</span></td></tr>"; 
  } else { 
  $RespektTjen = floor($respekt + rand(50, 80));
  $ChipsTjen = floor($bombechips + $Chips); 

  mysql_query("UPDATE Butikker SET Butikk_skade='$NySkade',Butikk_herverk=`Butikk_herverk`+'1' WHERE id='$ID_Er'"); 

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',bombechips='$ChipsTjen',respekt='$RespektTjen',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  if(!empty($gjeng) && !empty($ButInfo['Butikk_Gjeng']) && $gjeng != $ButInfo['Butikk_Gjeng']) { mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.7' WHERE Gjeng_Navn='$gjeng'"); mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.7' WHERE brukernavn='$brukernavn'"); }
  $Svar = array("Du tegnet med tusj på alle veggene i følgende butikk $Butikk_Navn.","Du rev ned listene rundt vinduene i butikken til $Eier.","Du tente på veggen hos $Butikk_Navn.","Du gikk inn i butikken med skøyter på, du ripa opp gulvet i følgende butikk $Butikk_Navn.","Du ødla vasken i følgende butikk $Butikk_Navn.","Du gikk inn i butikken til $Eier og knuste dassen med ett balltre.","Du knuste rutene til følgende butikk $Butikk_Navn.","Du rev ned gardinene i butikken til $Eier.","Du kastet sten på de ansatte hos $Butikk_Navn.","Du tagget ned byggningen til $Eier.","Du raserte innventaret til følgende butikk $Butikk_Navn.");
  $Svar = $Svar[array_rand($Svar)];
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">$Svar</span></td></tr>"; 
  }}}
  ?>