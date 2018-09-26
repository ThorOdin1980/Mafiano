  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon2', time(), $db);

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
  $Tjen = rand(400, 1400); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $tekst_navn = array("Roger","Steffen","Jonas","Hans","Eivind","Sebastian","Brage","Steinar","Kevin","Morgan","Stefan","Einar");
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  if($kjoonn == 'Gutt') { $random_eid_svar = "Du slo ned $tekst_navn så dro du opp snoppen å pissa på $tekst_navn, du kom unna med $TjenFormat."; } else { $random_eid_svar = "Du slo ned $tekst_navn så satt du deg på huk og pissa på $tekst_navn, du kom unna med $TjenFormat."; }
  $Meld = array("Du naska til deg $TjenFormat.","Du rana en fyllik og stjal $TjenFormat.","Du tømte pengeboken til den lille guttungen, du tjente $TjenFormat.","Du rana en paraonid dame, du stjal $TjenFormat.","$random_eid_svar");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble busta.","Du ble tatt av en politimann.","Du prøvde å naske fra boler Anders som er purk, du havnet i cella.","Purken slo deg ned og kastet deg på cella.","Du ble tatt av purken.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Tyveri','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $tekst_navn = array("Roger","Tone","Steffen","Randi","Jonas","Hans","Eivind","Sebastian","Brage","Steinar","Camilla","Kevin","Morgan","Stefan","Einar");
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  $Meld = array("Du klarte ikke å naske fra noen, du ble sint å fikk sinne ut ved å banke en random person, du gikk opp i respekt.","Du prøvde å naske pengeboken til en men personen hadde ikke penger så du slo inn skallen hans, du gikk opp i respekt.","Du møtte på Anders som er politimann, du slo han ned og stakk fra stedet, brekket ble ikke utført men du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Du feilet.","Du tryna i forsøket på å naske fra ei, du feilet.","Du prøvde og stjele men ble slått ned av en sint boler.","Du klarte ikke å naske fra noen.","Du tok veska til en gammel dame men hu slo deg ned og tok veska tilbake.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  
  
  }
  ?>