  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Hærverk', 'herverk_funksjon4', time(), $db);
  
  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  if($herverk_gjort <= '17') { $Feng = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '18') { $Feng = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '25') { $Feng = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); } elseif($herverk_gjort >= '30') { $Feng = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $Feng = $Feng[array_rand($Feng)];
    
  $NyVentetid = $Timestamp + '210';
  $NyHerverk = $herverk_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $FeilRankpros = $rankpros + '0.0001';
  $Straff = $Timestamp + '210';
  $Chips = rand(9, 12); 
  

  $VelgPlan = mysql_query("SELECT * FROM plantasje WHERE id LIKE '%' AND Tomt >= '7' AND brukernavn NOT LIKE '$brukernavn' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($VelgPlan) == '0') { 
  $Meld = array("Du fikk angst å stakk hjem, du feilet.","Du hadde ikke fyrstikker så du kunne ikke tenne på plantasjen.","Du fant ingen plantasjer du kunne tenne på.","Du fant desverre ikke fram til en plantasje.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("DELETE FROM plantasje WHERE id='$H_Id'");
  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  } else { 
  $PlanInfo = mysql_fetch_assoc($VelgPlan);
  $H_Eier = $PlanInfo['brukernavn'];
  $H_Tomt = $PlanInfo['Tomt'];
  $H_Id = $PlanInfo['id'];
  $DodEll = mysql_query("SELECT * FROM brukere WHERE brukernavn='$H_Eier' AND liv > '1'");
  if(mysql_num_rows($DodEll) == '0') { 
  $Meld = array("Du fant en plantasje men plantasjen var totalvraka, du stakk.","Du fant en forlatt plantasje, du gidder faen meg ikke å bruke opp fyrstikker på å tenne på noe som ingen bryr seg om.","Du fant en plantasje men eieren $H_Eier er dau, du dro hjem med surt ansikt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  } 
  elseif($Avgjor == 'JA') { 
  $SkadePros = rand(1, 5);
  $FaVite = rand(1, 6);
  $NyChips = floor($bombechips + $Chips);
  $NyTomt = floor($H_Tomt - $SkadePros);
  $Meld = array("Du tente på og brant ned $SkadePros kvadratmeter på plantasjen til $H_Eier.","Du tente på plantasjen til $H_Eier.","Du brant ned $SkadePros kvadratmeter på plantasjen til $H_Eier.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("UPDATE plantasje SET tomt='$NyTomt' WHERE id='$H_Id'"); 
  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$NyRankpros',aktiv_eller='$Aktiv',bombechips='$NyChips' WHERE brukernavn='$brukernavn'"); 

  if($FaVite == '3') { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Plantasje skadet','$brukernavn tente på plantasjen din, $SkadePros kvadratmeter brant ned.','Ja')"); } else { mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$H_Eier','$Timestamp','$AnnenDato','Plantasje skadet','En medspiller tente på plantasjen din, $SkadePros kvadratmeter brant ned.','Ja')"); }
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">$Meld</span></td></tr>";  
  }
  elseif($Feng == 'JA') { 
  $Meld = array("Politi ferska deg.","Politiet fikk et tips om din plan, du ble arrestert.","Du ble busta av onkel politi.");

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hærverk','3.5','3500000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld.</span></td></tr>"; 
  } else { 
  $Meld = array("Du feilet.","Du mistet en utent fyrstikk i narko buskene, du fant ikke fyrstikken å det var den siste du hadde.","Det regnet så fyrstikkene dine slukket med en gang, du fikk ikke til å tenne på plantasjen til $H_Eier.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET herverk_tiden='$NyVentetid',herverk_gjort='$NyHerverk',rankpros='$FeilRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}}
  ?>