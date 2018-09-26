  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon12', time(), $db);

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
  $Tjen = rand(2400, 3400); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Vellykket du tjente $TjenFormat kroner","Du kom unna med $TjenFormat.","Du banka dritten ut av alle som var tilstede i forretningen, du tjente $TjenFormat.","Du knuste veggen til bilforretningen og stjal alt av penger, du tjente $TjenFormat.","Du rana alt som var og rane, du tjente $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Et vitne sa ifra til purken, du ble tatt.","En politibetjent var i forretningen, han så deg og og tokk flykick på deg.","Bilforretningen fanget deg opp på kameraet, du ble busta.","Purken busta deg.","Du ble arrestert.","Politiet fant ut at det var deg.","Du ble tatt av en politibetjent.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Tyveri','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $Meld = array("Du prøvde å rane forretningen på en søndag, det var stengt. I sinne slo du ned en gammel dame, du gikk dermed opp i respekt.","Du fikk ikke med deg noen penger så du tente på alle bilene i forretningen, du gikk opp i respekt.","Du kuttet av fingeren til forretningens eier, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') {
  $Meld = array("Bilforretning tok ikke imot cash, de brukte bare kort, ingen penger å stjele.","Bilforretningen var stengt idag og eiern hadde tatt med seg alle penga hjem.","Bilforretningen du skulle rane gikk dårlig og det var ingen penger å hente.","Du klarte ikke å robbe bilforretningen.","Total fiasko.","Du kollapset sammen på vei til bilforretningen, du feilet.","Du gikk inn i feil forretning, her selger dem bare kringler.","Bedre lykke neste gang.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>