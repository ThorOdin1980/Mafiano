  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon10', time(), $db);

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
  $Tjen = rand(2000, 3000); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Det var såvidt du klarte det, du tjente $TjenFormat.","Dette gikk som en smurt og du tjente $TjenFormat.","Vellykket du kom unna med $TjenFormat.","Du gikk inn i banken og tømte bankboksen, du kom unna med $TjenFormat.","Du stjelte smykker fra en bankboks, du fikk solgt smykkene for $TjenFormat.","Du stjelte $TjenFormat fra en bankboks.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble busta.","Du ble arrestert.","Du ble tatt av en politimann.","Bankens kamera fanget deg opp, du ble busta.","En vakt i banken busta deg.","Purken slo deg ned og kastet deg i cella.","Du ble tatt av purken på vei ut av banken.","Et vitne sa ifra til purken, du ble tatt.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Ran','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $Meld = array("Du fikk ikke opnet bankboksen, i sinne slo du ned en ansatt. Du gikk opp i respekt.","Du skadet en mann i banken, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') {
  $Meld = array("Du feilet.","Du klarte ikke å bestemme deg for hvilken bank du skulle stjele fra.","Du ble slått ned på vei til banken.","Du kom for å tømme bankboksen på en søndag, det var stengt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>