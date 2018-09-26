  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon15', time(), $db);

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
  $Tjen = rand(3000, 4000); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Du kom unna med $TjenFormat.","Du gikk inn på tellesentralen og skjøt noen vakter og kom ut igjen med $TjenFormat.","Du gjorde det som en proff og tjente $TjenFormat.","Du toppet hele dritten og tjente $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble tatt.","En anonym så deg og sa ifra til politiet, du ble tatt.","Naboen din viste at du var med på ranet, han sa ifra til politiet.","Purken busta deg.","Du ble arrestert.","Du ble tatt under ransforsøket.","Du ble tatt av en politibetjent.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Tyveri','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $Meld = array("Du feilet i forsøket på å rane tellesentralen, i rent sinne skadet du en politibetjent. Du gikk opp i respekt.","Du fant ikke fram til tellesentralen i $land, av rent sinne slo du ned fem damer. Du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') {
  $Meld = array("Du robbet nokas tellesentral, men glemte baggen på sentralen.","Du snubla og besvimte. Du våkna ikke før neste dag så du dreit i å utføre ranet.","Det var flere vakter en du trudde, du fikk ikke med deg noe.","Du fant ikke fram til tellesentralen.","Du glemte våpene hjemme så du dreit i å utføre ranet.","Du backa ut.","Du ombestemte deg, du dro heller hjem og så på tv.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>