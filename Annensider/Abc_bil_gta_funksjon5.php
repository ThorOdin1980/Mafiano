  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Biltyveri', 'bil_gta_funksjon5', time(), $db);

  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '20') { $Avgjor = array("JA","NEI","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '35') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); } 
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  $SubAvgjor = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $SubAvgjor = $SubAvgjor[array_rand($SubAvgjor)];
  
  $NyVentetid = $Timestamp + '200';
  $NyGta = $biler_gjort + '1';
  $Skade = rand(10, 40);
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $Straff = $Timestamp + '240';
  $NyRespekt = floor($respekt + '60');

  if($Avgjor == 'JA') { 
  $VelgBil = array("Opel Calibra", "Audi TT", "Suzuki XL-7", "Toyota Supra", "Mazda RX-8", "Bmw 3-serie", "Volvo 240", "Saab 9-5", "Nissan Skyline GT-R", "Opel Calibra", "Toyota Supra", "Nissan 100 NX", "Honda Civic 1,6", "Chrysler Neon", "Ford Escort 1,4");
  $VelgBil = $VelgBil[array_rand($VelgBil)];
  $Meld = array("Du knuste butikkruta og stakk av med en $VelgBil, bilen er $Skade prosent skadet.","Dette gikk smude, du gikk inn i butikken å knuste noen skalle å stakk av med en $VelgBil, bilen er $Skade prosent skadet.","Du kjørte igjennom butikkruta med sykkelen din å kom ut av ruta med en $VelgBil, bilen er $Skade prosent skadet.","Du stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du klarte å stjele en $VelgBil, bilen er $Skade prosent skadet.", "Du stakk av med en $VelgBil, bilen er $Skade prosent skadet.", "Du tokk bilnøklene ut av hånda til butikkeieren å stakk av med en $VelgBil, bilen er $Skade prosent skadet.", "Du brøt deg inn i butikken og stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du stakk av med en $VelgBil, bilen er $Skade prosent skadet.");
  $Meld = $Meld[array_rand($Meld)];
  $HK = Hestekrefter($VelgBil);

  mysql_query("INSERT INTO garage (eier,bilmerke,skade,land,timestampen,stjelt_fra,hestekrefter) VALUES ('$brukernavn','$VelgBil','$Skade','$land','$Timestamp','$land','$HK')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Du fant ikke fram til bilbutikken","Du rakk ikke bussen som kjører til bilbutikken.", "Det var ingen bilbutikker i det område du befant deg i.", "Du feilet.", "Du klarte ikke å stjele en bil fra butikken.", "Du så en fin bil men klarte ikke å stjele den.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $Meld = array("Det var tomt for biler i butikken, du stakk derfor til statoil og knuste noen skaller, du gikk opp i respekt.","Bilbutikken hadde ikke mottatt bilene fra tyskland enda, du tok opp en hammer å knuste den inn i veggen til butikken, du gikk opp i respekt.","Butikkeieren hadde solgt alle bilene du ble så forbanna at du kuttet av fingeren hans, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble tatt av purken.", "Purken slo deg ned og kastet deg i cella.", "Du ble tatt av en politimann.", "Du ble tatt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Biltyveri','4','4000000','$Straff','$Timestamp','$land')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>