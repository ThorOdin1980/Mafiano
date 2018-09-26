  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
  botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Biltyveri', 'bil_gta_funksjon1', time(), $db);

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
  $Skade = rand(30, 80);
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $Straff = $Timestamp + '240';
  $NyRespekt = floor($respekt + '60');

  if($Avgjor == 'JA') { 
  $VelgBil = array("Peugot 307 SW", "Saab 9-5", "Volvo 240", "Volkswagen golf 1,8 GT", "Nissan 100 NX", "Honda Civic 1,6", "Lada Niva", "Chrysler Neon", "Ford Escort 1,4");
  $VelgBil = $VelgBil[array_rand($VelgBil)];
  $Meld = array("Du stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du sprengte bruktbilforhandlerens butikkdør og stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du stakk av med en $VelgBil, bilen er $Skade prosent skadet.", "Du knuste bruktbilforhandlerens finger og stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du kom med sykkel og stakk av med en $VelgBil, bilen er $Skade prosent skadet.");
  $Meld = $Meld[array_rand($Meld)];
  $HK = Hestekrefter($VelgBil);

  mysql_query("INSERT INTO garage (eier,bilmerke,skade,land,timestampen,stjelt_fra,hestekrefter) VALUES ('$brukernavn','$VelgBil','$Skade','$land','$Timestamp','$land','$HK')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Du klarte ikke å stjele fra bruktbilforhandleren.", "Du klarte ikke engang og bryte deg igjenom butikk døren.", "Du feilet.", "Du klarte nesten og stjele bilen.", "Du klarte ikke å tjuvkoble bilen.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $tekst_navn = array("Roger","Tone","Steffen","Randi","Jonas","Hans","Eivind","Sebastian","Brage","Steinar","Camilla","Kevin","Morgan","Stefan","Einar");
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  $Meld = array("Du klarte ikke å stjele en bil fra bruktbilforhandleren men du slo ned $tekst_navn på vei hjem, du gikk opp i respekt.","Du fant ikke fram til den lokale bruktbilforhandleren, i sinne tente du på en bensinstasjon. Du gikk opp i respekt.","Du feilet i forsøket på å stjele en bil men du fikk slått ned bil forhandleren, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble tatt av purken.", "Purken slo deg ned og kastet deg i cella.", "Bil eieren var politimann.", "Du ble tatt av en politimann.", "Du ble tatt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Biltyveri','4','4000000','$Straff','$Timestamp','$land')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>