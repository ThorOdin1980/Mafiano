  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 
  botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Biltyveri', 'bil_gta_funksjon2', time(), $db);

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
  $Skade = rand(25, 70);
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $Straff = $Timestamp + '240';
  $NyRespekt = floor($respekt + '60');

  if($Avgjor == 'JA') { 
  $VelgBil = array("Opel Calibra", "Audi TT", "Suzuki XL-7", "Toyota Supra", "Peugot 307 SW", "Saab 9-5", "Mazda RX-8", "Volvo 240", "Bmw 3-serie", "Volvo 240", "Saab 9-5", "Audi TT", "Opel Calibra", "Toyota Supra", "Nissan Skyline GT-R", "Nissan 100 NX", "Honda Civic 1,6", "Lada Niva", "Chrysler Neon", "Ford Escort 1,4");
  $VelgBil = $VelgBil[array_rand($VelgBil)];
  $Meld = array("Du stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du gikk inn på parkeringsplassen og stjal en $VelgBil, bilen er $Skade prosent skadet.", "Du stakk av med en $VelgBil, bilen er $Skade prosent skadet.", "Du knuste sideruta og tjuvkoblet en $VelgBil, bilen er $Skade prosent skadet.", "Du gikk inn på parkeringsplassen i $land og stjal en $VelgBil, bilen er $Skade prosent skadet.");
  $Meld = $Meld[array_rand($Meld)];
  $HK = Hestekrefter($VelgBil);

  mysql_query("INSERT INTO garage (eier,bilmerke,skade,land,timestampen,stjelt_fra,hestekrefter) VALUES ('$brukernavn','$VelgBil','$Skade','$land','$Timestamp','$land','$HK')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  $Meld = array("Du klarte ikke engang å stjele bilnøklene til en gammel dame.", "Du klarte ikke å dirke opp låsen på en bil.", "Du feilet.", "Du klarte nesten og stjele en bil fra parkeringsplassen.", "Du klarte ikke å tjuvkoble bilen.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  if($kjoonn == 'Gutt') { $tekst_navn = array("Sonja","Ane","Judy","Turid","Britt elin","Berit","Lisa","Lena","Pernille","Erika","Lill tone","Linda","Vivian","Dina","Gina","Hanna","Tone","Suzette","Randi","Anja","Sara","Kamilla","Elena","Gry","Weronica","Camilla","Ingrid","Maren","Lailla","Julianne"); } else { $tekst_navn = array("Julian","Bjørn tore","Bjørn","Tore","Thorfin","Marcus","Adnan","August","Svein","Birger","Kåre","Hans","Jarle","Henrik","Stian","Victor","Mads","Kris","Samuel","Gunnar","Tony","Erik","Stein erik","Truls","Hallvor","Magnus","Aron","Vegard","Aleksander","Jostein"); } $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  if($kjoonn == 'Gutt') { $tekst_svar2 = array("Du fikk ikke stjelt noen bil, på vei hjem møtte du på $tekst_navn som var gårsdagens hore, du slo hu rett ned for å slippe å betale. Du gikk opp i respekt.","Du møtte på sexy $tekst_navn på vei til parkeringsplassen, hu var ute etter penga sine. Du knvistakk hu å stakk av, du gikk opp i respekt"); } else { $tekst_svar2 = array("$tekst_navn var på vei til bilen sin, han så deg å sa hei du skylder meg penger. Du hadde ingen planer om å betale han noe som helst så du slo han flat. Du gikk opp i respekt.","På vei til parkeringsplassen møtte du på gigoloen din $tekst_navn han var ute etter penga sine, du sparka han rett i skrittet å stakk av. Du gikk opp i respekt."); } $tekst_svar2 = $tekst_svar2[array_rand($tekst_svar2)];
  $Meld = array("$tekst_svar2","Du klarte ikke å dirke opp døren til bilen på parkeringsplassen, i sinne helte du bensin over bilen å tente på. Du gikk opp i respekt.","Du fant ingen store parkeringsplasser, du ble så irritert at du slo ned en gammel hore, du gikk opp i respekt.");
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