  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon13', time(), $db);

  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); }
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  $SubAvgjor = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $SubAvgjor = $SubAvgjor[array_rand($SubAvgjor)];

  $NyVentetid = $Timestamp + '100';
  $BrekkTall = $brekk_gjort + '1';

  if($Avgjor == 'JA') { 
  $Tjen = rand(2600, 3600); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Du kruste igjennom brannmuren og overføre så $TjenFormat til din konto.","Du knuste paypal sitt systemt og stakk av med $TjenFormat.","Vellykket, du kom unna med $TjenFormat.","Du hacket paypal, du fikk overført $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Paypal sørget for å få deg arrestert.","Paypal sitt sikkerhets system fanget opp ipen din, du er arrestert.","Purken busta deg.","Du ble arrestert.","Paypals eier ebay fant ut at det var deg, de fikk deg arrestert.","Du ble tatt av en politibetjent.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Hacking','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $Meld = array("Pcen din crasha, du løftet så pcen opp og kastet den ut av vinduet. Pcen din traff en mann i hue, du økte derfor i respekt.","Nettverket ble borte, i rent sinne gikk du ut på gata å slo ned en sivil, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') {
  $Meld = array("Paypal sin hacker knuste deg på første forsøk.","Du klarte ikke å hacke paypal.","Nettverket ditt fungerte ikke.","Total fiasko.","Du kom igjenom systemet men pcen din crasha.","Du feilet.","Du klarte ikke å hacke paypal.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>