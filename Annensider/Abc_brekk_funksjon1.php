  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon1', time(), $db);

  // Beregn sansynlighet
  $PS = Bare_Siffer((BSjangs($Valgt)));
  
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
  $Tjen = rand(200, 1200); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Du stjal sykkelen, verdi $TjenFormat.","Du stjal sykkelen og lurte en somaler trill rundt, du tjente $TjenFormat.","Du stjal muhammed sin sykkel og solgte den for $TjenFormat.","Du stjal sykkelen og auksjonerte den bort for $TjenFormat.","Du stjelte sykkelen og solgte den for $TjenFormat.","Du dirka opp låsen til Muhammed sin sykkel og solgte den for $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble tatt av en politimann.","Muhammed sa ifra til purken, du ble tatt.","Purken slo deg ned og kastet deg i cella.","Du ble tatt av purken.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Tyveri','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $tekst_navn = array("Roger","Tone","Steffen","Randi","Jonas","Hans","Eivind","Sebastian","Brage","Steinar","Camilla","Kevin","Morgan","Stefan","Einar");
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  $Meld = array("Du klarte ikke brekket men på vei hjem slo du ned ei gammel dame, du gikk opp i respekt.","Du gadd ikke å stjele sykkelen men du slo ned $tekst_navn for morroskyld, du gikk opp i respekt.","Du dreit i sykkelen, du banka heller dritten ut av $tekst_navn, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Sykkeleieren Muhammed dro trehjulingen på to hjul å daska deg rett ned.","Du feilet.","Du prøvde å stjele sykkelen til Muhammed men feilet.","Du klarte ikke å bryte opp låsen.","Du klarte å dirke opp låsen, men Muhammed satt ved Mc donalds og så på deg. Du feilet.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  
  echo 'PS: '.$PS;
  ?>