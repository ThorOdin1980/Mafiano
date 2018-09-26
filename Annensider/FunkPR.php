  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  // Sonbru utvikling - scriptet ble utviklet 10.10.09 av Sondre Brudvik
  // Dette skriptet tillhører Sondre Brudvik, du har ingen rett til å bruke det med mindre du har kommet til en enighet med Sondre. 
  // Om Sondre Brudvik leverer deg en side og dette scriptet er inkludert har du på ingen måter rettigheter over denne filen. Ved kjøp har du lov til å bruke scriptet til den siden Sondre Brudvik har solgt deg.
  
  if(empty($brukernavn)) { header("Location: index.php"); } else {
  
  function sumblir($Sum,$Prosent) { 
  $Ekstra = $Sum / '100' * $Prosent;
  $NySum = $Sum + $Ekstra;
  $SumUt = $NySum / '5';
  return floor($SumUt);
  }
  
  function ekstrapenger($TotalRan,$GrunnSum) {
  if($TotalRan >= '200') {     $VAR_To = "5.4"; }
  elseif($TotalRan >= '190') { $VAR_To = "5.4"; }
  elseif($TotalRan >= '180') { $VAR_To = "5.4"; }
  elseif($TotalRan >= '170') { $VAR_To = "5.2"; }
  elseif($TotalRan >= '160') { $VAR_To = "5.0"; }
  elseif($TotalRan >= '150') { $VAR_To = "4.8"; }
  elseif($TotalRan >= '140') { $VAR_To = "4.6"; }
  elseif($TotalRan >= '130') { $VAR_To = "4.4"; }
  elseif($TotalRan >= '120') { $VAR_To = "4.2"; }
  elseif($TotalRan >= '110') { $VAR_To = "4.0"; }
  elseif($TotalRan >= '100') { $VAR_To = "3.8"; }
  elseif($TotalRan >= '90') {  $VAR_To = "3.6"; }
  elseif($TotalRan >= '80') {  $VAR_To = "3.4"; }
  elseif($TotalRan >= '70') {  $VAR_To = "3.2"; }
  elseif($TotalRan >= '60') {  $VAR_To = "2.8"; }
  elseif($TotalRan >= '50') {  $VAR_To = "2.6"; }
  elseif($TotalRan >= '40') {  $VAR_To = "2.4"; }
  elseif($TotalRan >= '30') {  $VAR_To = "2.2"; }
  elseif($TotalRan >= '20') {  $VAR_To = "2.0"; }
  elseif($TotalRan >= '10') {  $VAR_To = "1.5"; }
  else { $VAR_To = "1.3"; } 
  $GrunnSum = floor($GrunnSum * $VAR_To);
  return $GrunnSum;
  }
  
  function GrunnSum($TotalDrap,$TotalRespekt,$TotalLevel) { if($TotalDrap >= '90') { $Gevinst_1 = "1000000"; } elseif($TotalDrap >= '80') { $Gevinst_1 = "900000"; } elseif($TotalDrap >= '70') { $Gevinst_1 = "800000"; } elseif($TotalDrap >= '60') { $Gevinst_1 = "700000"; } elseif($TotalDrap >= '50') { $Gevinst_1 = "600000"; } elseif($TotalDrap >= '40') { $Gevinst_1 = "500000"; } elseif($TotalDrap >= '30') { $Gevinst_1 = "400000"; } elseif($TotalDrap >= '20') { $Gevinst_1 = "300000"; } elseif($TotalDrap >= '10') { $Gevinst_1 = "200000"; } else { $Gevinst_1 = "100000"; } if($TotalRespekt >= '1000000') { $Gevinst_2 = "1200000"; } elseif($TotalRespekt >= '900000') { $Gevinst_2 = "1100000"; } elseif($TotalRespekt >= '800000') { $Gevinst_2 = "1000000"; } elseif($TotalRespekt >= '700000') { $Gevinst_2 = "900000"; } elseif($TotalRespekt >= '600000') { $Gevinst_2 = "800000"; } elseif($TotalRespekt >= '500000') { $Gevinst_2 = "700000"; } elseif($TotalRespekt >= '400000') { $Gevinst_2 = "600000"; } elseif($TotalRespekt >= '300000') { $Gevinst_2 = "500000"; } elseif($TotalRespekt >= '200000') { $Gevinst_2 = "400000"; } elseif($TotalRespekt >= '100000') { $Gevinst_2 = "300000"; } else { $Gevinst_2 = "200000"; } $Gevinst_3 = rand(1000,100000); $Gevinst_4 = rand(100000,700000); if($TotalLevel >= '70') { $VAR_En = '35'; } elseif($TotalLevel >= '60') { $VAR_En = '30'; } elseif($TotalLevel >= '50') { $VAR_En = '25'; } elseif($TotalLevel >= '40') { $VAR_En = '20'; } elseif($TotalLevel >= '30') { $VAR_En = '15'; } elseif($TotalLevel >= '20') { $VAR_En = '10'; } else { $VAR_En = '5'; } $Gevinst = floor($Gevinst_1 + $Gevinst_2 + $Gevinst_3 + $Gevinst_4); $Prosent = $Gevinst / '100' * $VAR_En; $GrunnGevinst = floor($Gevinst + $Prosent); return $GrunnGevinst; }
  function KlareRan($TotalRan,$Tall) { if($TotalRan >= $Tall) { $Ending = "Kansje"; } else { $Ending = "Feiler"; } return $Ending; }
  function MisteLiv($liv,$ran) { if($liv >= '20') { if($ran >= '70') { $mis = rand(1,4); } elseif($ran >= '60') { $mis = rand(2,6); } elseif($ran >= '50') { $mis = rand(3,8); } elseif($ran >= '40') { $mis = rand(4,10); } elseif($ran >= '30') { $mis = rand(5,12); } elseif($ran >= '20') { $mis = rand(6,14); } elseif($ran >= '10') { $mis = rand(7,15); } else { $mis = rand(9,16); }} else { $mis = '0'; } $NyttLiv = floor($liv - $mis); return $NyttLiv; }
  function NyRankpros($Niva,$Rankpros) { if($Niva >= '15') { $Pros = '0.1'; } elseif($Niva >= '14') { $Pros = '0.2'; } elseif($Niva >= '13') { $Pros = '0.3'; } elseif($Niva >= '12') { $Pros = '0.5'; } elseif($Niva >= '11') { $Pros = '1.0'; } elseif($Niva >= '10') { $Pros = '1.5'; } elseif($Niva >= '9') { $Pros = '2.0'; } elseif($Niva >= '8') { $Pros = '2.5'; } elseif($Niva >= '7') { $Pros = '3.0'; } elseif($Niva >= '6') { $Pros = '3.5'; } elseif($Niva >= '5') { $Pros = '4.0'; } elseif($Niva >= '4') { $Pros = '4.5'; } elseif($Niva >= '3') { $Pros = '5.0'; } elseif($Niva >= '2') { $Pros = '5.5'; } else { $Pros = '6.0'; } $NyRankpros = $Rankpros + $Pros; return $NyRankpros; }
  
  function sjofor($Utstyr,$Brukeren) {
  
  global $Timestamp, $FullDato;
  $Ut = explode("<br>", $Utstyr);
  
  // Informasjon om brukeren

  $I = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Brukeren'");
  $Bruker = mysql_fetch_assoc($I);
  $Liv = $Bruker['liv'];
  $AntRan = $Bruker['plan_ran'];
  $Land = $Bruker['land'];
  
  // Viktige variabler
  $BilSkade = array("Skutt","Ingen","Skutt","Ingen","Bombe","Ingen","Bombe","Ingen","Skutt","Ingen","Skutt","Ingen","Bombe","Ingen","Ingen","Ingen","Ingen");
  $PolitiEtter = array("Politibiler","Politibiler","Politibiler","Politibiler","Helikopter","Helikopter","Ingen","Ingen","Ingen","Ingen","Ingen","Ingen","Ingen","Ingen","Ingen","Skutt på");
  $Ny_Liv = MisteLiv($Liv,$AntRan);
  $Ny_pros = NyRankpros($Bruker['rank_nivaa'],$Bruker['rankpros']);
  $Straff = $Timestamp + '360';
  $VenteTid = $Timestamp + '36000';
  
  // Variabler som skal sjekkes for å få et resultat
  $BilSkade = $BilSkade[array_rand($BilSkade)];  
  $PolitiEtter = $PolitiEtter[array_rand($PolitiEtter)];  
  
  // Sjkker om bilen skal skli
  if($Ut['0'] == 'Nissan Sunny') { $BilSkli = rand(1,8); } elseif($Ut['0'] == 'Ford Explorer') { $BilSkli = rand(1,7); } elseif($Ut['0'] == 'Audi A3') { $BilSkli = rand(1,6); } elseif($Ut['0'] == 'Hummer H3') { $BilSkli = rand(1,5); } elseif($Ut['0'] == 'BMW 520') { $BilSkli = rand(1,4); } elseif($Ut['0'] == 'Dodge RAM') { $BilSkli = rand(1,3); } else { $BilSkli = rand(1,2); }

  // Sql spørringer
  $MY_Rulleblad = "INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$Brukeren','Planlagt ran','6','$FullDato','$Timestamp','','Organisert kriminalitet','')";
  $MY_Fengsel = "INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$Brukeren','Planlagt ran','6','6000000','$Straff','$Timestamp','$Land')";

  // Selve funksjonen
  if($BilSkli >= '3') { 
  $Melding = array("Ranet feilet! Politiet forfulgte deg på E6, du prøvde å riste dem av men det endte med krasj og arrestasjon.","Ranet feilet! bilen lå ikke stabilt nok på veien med den hastigheten du kjørte ifra politiet med, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  } elseif($BilSkade == 'Skutt' || $BilSkade == 'Bombe') { 
  if($BilSkade == 'Skutt') { 
  if($Ut['1'] == 'Skuddsikker bil' || $Ut['1'] == 'Bombesikker bil') { 
  $Melding = array("Ranet feilet! men du klarte å kjøre fra politiet selv om de skjøt etter bilen di, du ble skadet under flukten.","Ranet feilet! Du skadet deg på ranstedet men heldigvis klarte du å komme deg unna.");
  } else { 
  $Melding = array("Ranet feilet! Politiet skjøt på bilen deres som resulterte i at bilen krasjet inn i en fjellvegg, du ble arrestert.","Ranet feilet! Frontruta på bilen ble skutt i stykker, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} elseif($BilSkade == 'Bombe') { 
  if($Ut['1'] == 'Bombesikker bil') { 
  $Melding = array("Ranet feilet! En kompanjong mistet en sprengladning utenfor bilen din, du stakk på sekundet. Uheldigvis ble du skadet i flukten.","Ranet feilet! Du stakk fra ranet men klarte å kjøre av veien, du ble skadet.");
  } else { 
  $Melding = array("Ranet feilet! Bilen din ble uheldigvis sprengt på rans-stedet, du ble arrestert.","Ranet feilet! En kompanjong mistet en grant utenfor bilen, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} elseif($PolitiEtter == 'Politibiler' || $PolitiEtter == 'Helikopter') { 
  if($PolitiEtter == 'Politibiler') { 
  if($Ut['2'] == 'Betalte lokale politibiler mot at dem holder munn' || $Ut['2'] == 'All politivirksomhet som gjelder trafikk er sikkret') { 
  $Melding = array("Ranet feilet! Du stakk fra rans-stedet men ble stoppe i en kontroll, heldigvis hadde du alt bestikket denne mannen fra før av.","Ranet feilet! Du ble stoppe av en sivilsnut, du bestakk han og kom deg videre.");
  } else { 
  $Melding = array("Ranet feilet! Du stakk skadet deg på rans-stedet så du stakk, på vei hjem ble du stoppet av en patruljebil, du ble desverre arrestert.","Ranet feilet! Du ble stoppet av en sivilsnut på vei hjem, snuten banka driten ut av deg og kasta deg på cella.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}elseif($PolitiEtter == 'Helikopter') { 
  if($Ut['2'] == 'All politivirksomhet som gjelder trafikk er sikkret') { 
  $Melding = array("Ranet feilet! Du skadet deg under ransforsøket men du klarte likevel å kjøre avgårde men uheldigvis ble du forfulgt av luftpatruljen, heldigvis hadde du betalt luft patruljen så de lot deg forsvinne.","Ranet feilet! Du skadet det under rans-forsøket, etter ransforsøket kjørte du avgårde men ble fanget opp av veikamera, heldigvis hadde du bestukket veivesnet.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  } else { 
  $Melding = array("Ranet feilet! Du ble såret under ransforsøket men klarte likevel å kjøre bilen din vekk men du ble desverre forfulgt av av luftpatruljen og senere arrestert.","Ranet feilet! Du rømte av gårde i bilen din men du ble desverre fanget opp av vei overvåkningen, på vei inn til gårdsplassen krasjet du inn i nabohuset, ti minutter senere kom politiet og arresterte deg.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} else { $Melding = array("Ranet feilet! Du kom deg hel hjem uten at noen vet at du var med på ranet.","Ranet feilet! Men du klarte å komme deg unna."); }
  
  $Melding = $Melding[array_rand($Melding)];  

  mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',liv='$Ny_Liv',rankpros='$Ny_pros',plan_tid='$VenteTid' WHERE brukernavn='$Brukeren'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Brukeren','$Timestamp','$FullDato','Planlagt ran','$Melding','Ja')");
  }
  

  function vopenmann($Utstyr,$Brukeren) { 
  global $Timestamp, $FullDato;

  $Ut = explode("<br>", $Utstyr);
  
  // Informasjon om brukeren

  $I = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Brukeren'");
  $Bruker = mysql_fetch_assoc($I);
  $Liv = $Bruker['liv'];
  $AntRan = $Bruker['plan_ran'];
  $Land = $Bruker['land'];
  
  // Viktige variabler
  $SkuttMot = array("Uzi","Ingen","Ingen","Ingen","Ak-47","Ak-47","Uzi","Uzi","Ingen","Uzi","Ingen","Uzi","Ingen","Uzi","Uzi","Ak-47","Ak-47","Ingen","Ingen","Ingen","Ak-47");
  $SkuddTreffer = array("Skuddsikker vest","Skuddsikker vest","Ingen","Skuddsikker vest","Ingen","Skuddsikker vest","Ingen","Skuddsikker drakt","Ingen","Skuddsikker drakt","Ingen","Ingen");
  $Politi = array("lokale","alle","Ingen","lokale","alle","lokale","Ingen","lokale","Ingen","Ingen","lokale","lokale","alle","lokale","alle","Ingen","Ingen","lokale","Ingen","Ingen");
  $Ny_Liv = MisteLiv($Liv,$AntRan);
  $Ny_pros = NyRankpros($Bruker['rank_nivaa'],$Bruker['rankpros']);
  $Straff = $Timestamp + '360';
  $VenteTid = $Timestamp + '36000';
  
  // Variabler som skal sjekkes for å få et resultat
  $SkuttMot = $SkuttMot[array_rand($SkuttMot)];  
  $SkuddTreffer = $SkuddTreffer[array_rand($SkuddTreffer)];  
  $Politi = $Politi[array_rand($Politi)];  

  // Sql spørringer
  $MY_Rulleblad = "INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$Brukeren','Planlagt ran','6','$FullDato','$Timestamp','','Organisert kriminalitet','')";
  $MY_Fengsel = "INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$Brukeren','Planlagt ran','6','6000000','$Straff','$Timestamp','$Land')";
  
  if($SkuttMot == 'Uzi' || $SkuttMot == 'Ak-47') {   
  if($SkuttMot == 'Uzi') { 
  if($Ut['0'] == 'Uzi' || $Ut['0'] == 'Ak-47' || $Ut['0'] == 'Pistol,Uzi,Ak-47') { 
  $Melding = array("Ranet feilet! En politimann skjøt på deg med $SkuttMot, du skjøt han ned og stakk.","Ranet feilet! De ansatte skjøt på deg med $SkuttMot, Heldigvis var ditt våpen kraftigere.");
  } else { 
  $Melding = array("Ranet feilet! Fiskern var i bygget, alle i laget grøsset. Fiskern knuste tryne ditt og kasta deg inn i veggen, politiet kom senere og spurte hvor ranerene ble av, de trudde du var offeret men fant senere ut at du ikke var det.","Ranet feilet! De ansatte skjøt deg ned, de hold deg der til politiet kom.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else { 
  if($Ut['0'] == 'Ak-47' || $Ut['0'] == 'Pistol,Uzi,Ak-47') { 
  $Melding = array("Ranet feilet! Du gikk amok på stedet og skøyt alle du så i sinne.","Ranet feilet! Du stakk fra skuddvekslinga.");
  } else { 
  $Melding = array("Ranet feilet! Alle som befant seg i bygget gikk imot dere, du ble holdt igjen mot din vilje til politiet kom.","Ranet feilet! Du ble skutt av Fiskern, du ble senere arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}}
  elseif($SkuddTreffer == 'Skuddsikker vest' || $SkuddTreffer == 'Skuddsikker drakt') { 
  if($SkuddTreffer == 'Skuddsikker vest') { 
  if($Ut['1'] == 'Skuddsikker vest' || $Ut['1'] == 'Skuddsikker drakt') { 
  $Melding = array("Ranet feilet! Det ble en stor skuddveksling mellom dere og politiet, heldigvis klarte du å skyte deg vekk.","Ranet feilet! Det ble en gisselsituasjon så swat ble tillkalt, heldigvis stakk du før dem kom.");
  } else { 
  $Melding = array("Ranet feilet! Du ble skutt, gutta forlot deg på stedet for å redde sitt eget skinn, du ble desverre arrestert.","Ranet feilet! En lokal tante knivstakk deg i forsøket på å rane hu og, du ble senere arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} 
  elseif($SkuddTreffer == 'Skuddsikker drakt') { 
  if($Ut['1'] == 'Skuddsikker drakt') {
  $Melding = array("Ranet feilet! Det ble skuddveksling mellom deg og politiet, du berga deg.","Ranet feilet! Mannen som arbeider på stedet angrep deg med rifle, heldigvis hadde du skuddsikkerdrakt på deg.");
  } else { 
  $Melding = array("Ranet feilet! Du ble en helt vill skuddveksling mellom deg og politiet, du ble skutt.","Ranet feilet! Driveren stakk av, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}}
  elseif($Politi == 'lokale' || $Politi == 'alle') { 
  if($Politi == 'lokale') { 
  if($Ut['2'] == 'Bestikk lokale politimenn' || $Ut['2'] == 'Bestikk all politivirksomhet langs gata') { 
  $Melding = array("Ranet feilet! Det var ingen penger å hente, idet du kom ut hadde drivern alt stukket av. Du fikk panikk og løp nedover $Land gatene og på veien støtte du på en politimann men heldigvis gikk det an og bestikke han.","Ranet feilet! Du kom deg vekk fra stedet på sekundet.");
  } else { 
  $Melding = array("Ranet feilet! Du ble skutt og arrestert.","Ranet feilet! Planen gikk i dass, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} 
  elseif($Politi == 'alle') { 
  if($Ut['2'] == 'Bestikk all politivirksomhet langs gata') { 
  $Melding = array("Ranet feilet! Du fikk deng av en lokal helt, heldigvis kunne du bestikke han med penger, mannen ga faen i å ringe politiet.","Ranet feilet! Du fikk juling av de ansatte på stedet, du klarte å overbevise dem om å la deg gå.");
  } else { 
  $Melding = array("Ranet feilet! Du prøvde å stikke av men ble arrestert av en gjennomreisende politibil, du skulle he gitt dem litt penger.","Ranet feilet! Du ble desverre tatt av en lokal helt, du skulle ha bestukket han å.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}}
  else { 
  $Melding = array("Ranet feilet! Bena dine begynte å bli rastløse, du har aldri vært så nervøs før, du klarte rett og slett ikke å være der lengere.","Ranet feilet! Nervene din økte som faen, du klarte ikke å fullføre ranet.");
  }
  
  $Melding = $Melding[array_rand($Melding)];  

  mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',liv='$Ny_Liv',rankpros='$Ny_pros',plan_tid='$VenteTid' WHERE brukernavn='$Brukeren'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Brukeren','$Timestamp','$FullDato','Planlagt ran','$Melding','Ja')");
  }
  
  
  function eksplosiv($Utstyr, $Brukeren) { 
  global $Timestamp, $FullDato;

  $Ut = explode("<br>", $Utstyr);
  
  // Informasjon om brukeren

  $I = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Brukeren'");
  $Bruker = mysql_fetch_assoc($I);
  $Liv = $Bruker['liv'];
  $AntRan = $Bruker['plan_ran'];
  $Land = $Bruker['land'];
  
  // Viktige variabler
  $TntTrengs = array("Ingen","Ingen","Ingen","Ingen","2kg tnt","8kg tnt","2kg tnt","Ingen","8kg tnt","2kg tnt","Ingen","8kg tnt","2kg tnt","Ingen","8kg tnt","2kg tnt","Ingen","2kg tnt","Ingen","2kg tnt","Ingen","Ingen","Ingen");
  $KevlarTrengs = array("Bombesikker drakt","Bombesikker vest","Ingen","Bombesikker vest","Ingen","Bombesikker drakt","Ingen","Bombesikker vest","Ingen","Bombesikker vest","Bombesikker vest","Ingen","Bombesikker drakt","Ingen","Bombesikker vest","Ingen","Bombesikker vest","Bombesikker drakt");
  $PistolTrengs = array("Ingen","Pistol","Ingen","Pistol","Ingen","Pistol","Ingen","Pistol","Ingen","Pistol","Ingen","Uzi","Uzi","Uzi");
  $Ny_Liv = MisteLiv($Liv,$AntRan);
  $Ny_pros = NyRankpros($Bruker['rank_nivaa'],$Bruker['rankpros']);
  $Straff = $Timestamp + '360';
  $VenteTid = $Timestamp + '36000';
  
  // Variabler som skal sjekkes for å få et resultat
  $TntTrengs = $TntTrengs[array_rand($TntTrengs)];  
  $KevlarTrengs = $KevlarTrengs[array_rand($KevlarTrengs)];  
  $PistolTrengs = $Politi[array_rand($PistolTrengs)];  

  // Sql spørringer
  $MY_Rulleblad = "INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$Brukeren','Planlagt ran','6','$FullDato','$Timestamp','','Organisert kriminalitet','')";
  $MY_Fengsel = "INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$Brukeren','Planlagt ran','6','6000000','$Straff','$Timestamp','$Land')";
  
  if($TntTrengs == '2kg tnt' || $TntTrengs == '8kg tnt') { 
  if($TntTrengs == '2kg tnt') { 
  if($Ut['0'] == '2kg tnt' || $Ut['0'] == '4kg tnt' || $Ut['0'] == '8kg tnt') { 
  $Melding = array("Ranet feilet! Du sprengte safen og alle pengene i den, idiot.","Ranet feilet! Du sprengte deg inn i safen men den var desverre tom, du stakk.");
  } else { 
  $Melding = array("Ranet feilet! Du sprengte en av fingrene dine av, så dum som du var så ringte du sykebilen og ifølge med den kom politiet.","Ranet feilet! Du prøvde å sprenge deg forbi politiet med tnt, det fungerte dårlig.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else { 
  if($Ut['0'] == '4kg tnt' || $Ut['0'] == '8kg tnt') { 
  $Melding = array("Ranet feilet! Du brukte opp all sprengstoffet på å sprenge deg inn i byggningen.","Ranet feilet! Du klarte ikke å sprenge opp safen.");
  } else { 
  $Melding = array("Ranet feilet! Sprengladningen var for stor, du sprengte alt av penger, du ble senere arrestert.","Ranet feilet! Du glemte sprengte halve bygget idiot, trur du ikke det vekker oppsikt? du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}}
  elseif($KevlarTrengs == 'Bombesikker vest' || $KevlarTrengs == 'Bombesikker drakt') { 
  if($KevlarTrengs == 'Bombesikker vest') { 
  if($Ut['1'] == 'Bombesikker vest' || $Ut['1'] == 'Bombesikker drakt') {
  $Draktelns = $Ut['1']; 
  $Melding = array("Ranet feilet! Ranet gikk i dass men du unslapp med mindre skader etter tnt sprengte ukontrolert, bra du hadde $Draktelns.","Ranet feilet! Du holdt på å sprenge deg selv i filler heldigvis hadde du en $Draktelns.");
  } else { 
  $Melding = array("Ranet feilet! Du plasserte for mye sprengladning på veggen, da det smalt ble du slengt fire meter inn i en annen vegg. Politiet lo av deg da de kom og kalte deg amatør.","Ranet feilet! Kevlar klærene dine reddet livet ditt men de hindret ikke politiet i å arrestere deg.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else { 
  if($Ut['1'] == 'Bombesikker drakt') { 
  $Melding = array("Ranet feilet! Din bombesikre drakt var ikke nødvendig, du fikk aldri muligheten til å plassere sprengstoffet.","Ranet feilet! Du kom deg værtfall unna denne gangen, er ikke sikkert du har like flaks neste gang.");
  } else { 
  $Melding = array("Ranet feilet! Arne fra nasjonalgarden banka driten ut av deg idet du forsøkte å sprenge safen hans, du ble arrestert.","Ranet feilet! Sprengstoffet lå igjen i bilen, du gikk ut for å hente det men ble møtt med pistolskudd, du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} 
  elseif($PistolTrengs == 'Pistol' || $PistolTrengs == 'Uzi') { 
  if($PistolTrengs == 'Pistol') { 
  if($Ut['2'] == 'Ingen') { 
  $Melding = array("Ranet feilet! Du ble skutt av politiet før de arresterte deg.","Ranet feilet! Det utartet seg til skuddveksling, du skulle kjøpt et våpen, du ble skutt og forlatt til politiet.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  } else { 
  $Melding = array("Ranet feilet! Fyllikken Karl var i bygget han bærer alltid kniv han prøvde å knivstikke deg men du skjøt han i leggen og stakk hjem.","Ranet feilet! Eieren av bygget opnet ild mot deg, du skjøt han ned og stakk fra åstedet.");
  }} else { 
  if($Ut['2'] == 'Uzi') { 
  $Melding = array("Ranet feilet! Gutta på åstedet skjøt mot deg med pistol, du plaffa di ned med din uzi.","Ranet feilet! Sprengningen av safen gikk helt som planlagt, heldigvis hadde du en uzi du kunne skyte deg ut av bygget med.");
  } else { 
  $Melding = array("Ranet feilet! Det var en stor skuddveksling mellom deg og politiet, hadde du hatt en uzi istedenfor pistolen så hadde det endt anderledes, du ble arrestert.","Ranet feilet! Du kom deg vekk fra ranet med noen litt større skader men ble arrestert for besettelse av våpen.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} else { $Melding = array("Ranet feilet! Du brakk ett ben, nedtur det men du kom deg værtfall unna uten en arrestasjon.","Ranet feilet! Du unnslapp med noen skader."); }
  
  $Melding = $Melding[array_rand($Melding)];  

  mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',liv='$Ny_Liv',rankpros='$Ny_pros',plan_tid='$VenteTid' WHERE brukernavn='$Brukeren'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Brukeren','$Timestamp','$FullDato','Planlagt ran','$Melding','Ja')");
  }

  function alarmekspert($Utstyr, $Brukeren) { 
  global $Timestamp, $FullDato;

  $Ut = explode("<br>", $Utstyr);
  
  // Informasjon om brukeren

  $I = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Brukeren'");
  $Bruker = mysql_fetch_assoc($I);
  $Liv = $Bruker['liv'];
  $AntRan = $Bruker['plan_ran'];
  $Land = $Bruker['land'];
  
  // Viktige variabler
  $Verktoy = array("Verktøykasse","Verktøykasse","Verktøykasse","Ingen","Ingen","Ingen","Verktøykasse","Ingen","Verktøykasse,Disrøpter","Ingen","Verktøykasse","Ingen","Verktøykasse,Disrøpter","Ingen","Verktøykasse","Ingen","Verktøykasse,Disrøpter","Ingen","Verktøykasse","Verktøykasse","Verktøykasse");
  $Oprator = array("Oppratørene bestikkes til å ignorere alt","Oppratørene bestikkes til å ignorere alt","Oppratørene bestikkes til å ignorere alt","Oppratørene bestikkes til å ignorere alt","Ingen","Oppratørene bestikkes til å ignorere alt","Ingen","Oppratørene bestikkes til å ignorere alt","Ingen","Oppratørene bestikkes til å ignorere alt","Ingen","Oppratører bestikkes til å arrangere strømbrudd","Oppratører bestikkes til å arrangere strømbrudd","Oppratører bestikkes til å arrangere strømbrudd","Oppratører bestikkes til å arrangere strømbrudd");
  $Vopen = array("Uzi","Pistol","Ingen","Pistol","Ingen","Pistol","Ingen","Pistol","Uzi","Uzi");
  $Ny_Liv = MisteLiv($Liv,$AntRan);
  $Ny_pros = NyRankpros($Bruker['rank_nivaa'],$Bruker['rankpros']);
  $Straff = $Timestamp + '360';
  $VenteTid = $Timestamp + '36000';
  
  // Variabler som skal sjekkes for å få et resultat
  $Verktoy = $Verktoy[array_rand($Verktoy)];  
  $Oprator = $Oprator[array_rand($Oprator)];  
  $Vopen = $Politi[array_rand($Vopen)];  

  // Sql spørringer
  $MY_Rulleblad = "INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$Brukeren','Planlagt ran','6','$FullDato','$Timestamp','','Organisert kriminalitet','')";
  $MY_Fengsel = "INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$Brukeren','Planlagt ran','6','6000000','$Straff','$Timestamp','$Land')";
  
  if($Verktoy == 'Verktøykasse' || $Verktoy == 'Verktøykasse,Disrøpter') { 
  if($Verktoy == 'Verktøykasse') { 
  if($Ut['0'] == 'Verktøykasse' || $Ut['0'] == 'Verktøykasse,Disrøpter') { 
  $Melding = array("Ranet feilet! Du gjorde din del av jobben men under selve frakoblingen fikk du strøm i kroppen, du skadet deg.","Ranet feilet! Du koblet fra alarmen men uheldigvis klarte du å skade deg mens du drev på.");
  } else { 
  $Melding = array("Ranet feilet! Du hadde ingen aning om hvordan du skulle koble fra alarmen, du og resten av teamet prøvde å stikke av men det endte med at du ble skutt og arrestert.","Ranet feilet! Du klarte ikke å koble fra alarmen, på vei ut falt du ned trappen og skadet deg. Du ble forlatt på stedet til politiet kom.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else { 
  if($Ut['0'] == 'Verktøykasse,Disrøpter') { 
  $Melding = array("Ranet feilet! Du slo ut alle kameraene på bygget men du slo hodet ditt i en vegg da en av de andre i teamet prøvde å presse seg forbi deg.","Ranet feilet! Disrøpteren slo ut alarmen, men det var noen på jobb den dagen som la merke til at overvåkningen var slått ut. Vakten på bygget gikk ned for å sjekke hva det var, han fant deg og dere begynte å sloss, du vant men du skadet deg desverre.");
  } else { 
  $Melding = array("Ranet feilet! Det var desverre politi på stedet fra før av, det endte med håndgemeng. Du skadet deg skikkelig i forsøket på å stikke fra purken men du klarte det ikke.","Ranet feilet! Du glemte disrøpteren hjemme, du prøvde å koble ut alarmen med verkøy men det nyttet ikke, alarmen ble utløst og det endte med skuddveksling mellom deg og politiet, du ble skutt og arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} 
  elseif($Oprator == 'Oppratører bestikkes til å arrangere strømbrudd' || $Oprator == 'Oppratørene bestikkes til å ignorere alt') { 
  if($Oprator == 'Oppratører bestikkes til å arrangere strømbrudd') { 
  if($Ut['1'] == 'Oppratører bestikkes til å arrangere strømbrudd' || $Ut['1'] == 'Oppratørene bestikkes til å ignorere alt') { 
  $Melding = array("Ranet feilet! Alt gikk greit, du trengte ikke engang å gjøre noe siden opratørene alt hadde arrangert strømbrudd som avtalt men de hadde uheldigvis tilkalt purken men du kom deg unna med mindre skader.","Ranet feilet! Strømbrudd var arrangert og alt gikk greit helt til du møtte på en voldelig vakt, du fikk svolk men kom deg unna.");
  } else { 
  $Melding = array("Ranet feilet! Du klarte ikke å koble fra alarmen, du skulle ha bestukket de ansatte, du skadet deg i forsøket på å stikke fra politiet, noe som foresten feilet.","Ranet feilet! Du klarte ikke å gjøre jobben din, du fikk juling av en i teamet og ble senere arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else { 
  if($Ut['1'] == 'Oppratørene bestikkes til å ignorere alt') { 
  $Melding = array("Ranet feilet! Du kom unna med mindre skader.","Ranet feilet! Heldigvis kom du deg unna med noen skrammer.");
  } else { 
  $Melding = array("Ranet feilet! Du ble fikk juling av en vakt, vakten foretokk en sivil arrestasjon, du skulle ha bestukket han.","Ranet feilet! Du skulle ha bestukket de ansatte på stedet men nei det gjorde du ikke, du ga deg juling og sendte deg til politistasjonen.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} 
  elseif($Vopen == 'Uzi' || $Vopen == 'Pistol') { 
  if($Vopen == 'Pistol') { 
  if($Ut['1'] == 'Pistol' || $Ut['1'] == 'Uzi') { 
  $Melding = array("Ranet feilet! Du tok helt av under skuddvekslingen, du fikk bare ett rift i høyre ben.","Ranet feilet! Skuddveksling gikk bra men du fikk ett rift i venstre arm men du kom deg unna.");
  } else { 
  $Melding = array("Ranet feilet! Det endte med skuddveksling, faen hvorfor handlet du ikke våpen, hadde du gjort det hadde du kansje ikke blitt skutt og arrestert.","Ranet feilet! Skuddveksling forekom i bygget, du ble skutt og arrestert, du skulle ha handlet våpen.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }} else {
  if($Ut['1'] == 'Uzi') { 
  $Melding = array("Ranet feilet! Du gikk berserk men uzien din.","Ranet feilet! Uzien din reddet livet ditt denne gangen, men det gjør den kansje ikke neste gang.");
  } else { 
  $Melding = array("Ranet feilet! De kom mot dere med uzi, du klarte ikke å måle opp mot det med din pistol.","Ranet feilet! Du ble arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  }}} else { $Melding = array("Ranet feilet! Du forlot rans-stedet.","Ranet feilet! Du kom deg unna."); }
  
  $Melding = $Melding[array_rand($Melding)];  

  mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',liv='$Ny_Liv',rankpros='$Ny_pros',plan_tid='$VenteTid' WHERE brukernavn='$Brukeren'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Brukeren','$Timestamp','$FullDato','Planlagt ran','$Melding','Ja')");
  }

  function planlegger($Brukeren,$AntRan,$IdEr) { 
  
  global $Timestamp, $FullDato, $liv, $rank_niva, $rankpros, $land;

  // Viktige variabler
  $Ny_Liv = MisteLiv($liv,$AntRan);
  $Ny_pros = NyRankpros($rank_niva,$rankpros);
  $Straff = $Timestamp + '360';
  $VenteTid = $Timestamp + '36000';
  
  // Sql spørringer
  $MY_Rulleblad = "INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$Brukeren','Planlagt ran','6','$FullDato','$Timestamp','','Organisert kriminalitet','')";
  $MY_Fengsel = "INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$Brukeren','Planlagt ran','6','6000000','$Straff','$Timestamp','$land')";
  
  if($AntRan >= '35') { $BliTatt = '2'; } 
  elseif($AntRan >= '30') { $BliTatt = rand(1,8); }
  elseif($AntRan >= '25') { $BliTatt = rand(1,7); }
  elseif($AntRan >= '20') { $BliTatt = rand(1,6); }
  elseif($AntRan >= '15') { $BliTatt = rand(1,5); }
  elseif($AntRan >= '10') { $BliTatt = rand(1,4); }
  elseif($AntRan >= '5') { $BliTatt = rand(1,3); }
  else { $BliTatt = '1'; }
  
  if($BliTatt == '1') { 
  $Melding = array("Ranet feilet! Det gikk ikke som planlagt, det endte med skuddveksling og du ble såret og senere arrestert.","Ranet feilet! Du ble arrestert.","Ranet feilet! Dere må sammarbeide mer, du ble utsatt for politivold og arrestert.","Ranet feilet! Dette var rot, det var ingen form for sammarbeid og dere viste ikke hva dere skulle gjøre når swat kom, det ble en skuddveksling som endte i dass.","Ranet feilet! Du ble påkjørt av en bil i lav hastighet men du fikk nok skader til å ikke komme deg vekk, du ble arrestert.","Ranet feilet! Du fikk juling av en politibetjent.","Ranet feilet!","Ranet feilet! Det gikk i dass, teamet ditt var talentløst i tilegg ble du skutt av en vakt på stedet samt arrestert.");

  mysql_query("$MY_Rulleblad") OR die(mysql_error());
  mysql_query("$MY_Fengsel") OR die(mysql_error());
  } else { 
  $Melding = array("Ranet feilet! Du fant en Ak-47, du skjøt deg forbi vaktene, men når du kom ut hadde driveren stukket av.","Ranet feilet! Det gikk ikke denne gangen, kansje du har flaks neste gang og kommer deg unna uten skader og med penger.","Ranet feilet! Du feilet som planlegger, alt gikk i dass og du ble slått ned men du kom deg værtfall unna uten arrestasjon.","Ranet feilet! Du kom unna med noen få sår.","Ranet feilet! Du sloss deg forbi de ansatte og ut i friheten.");
  }

  $Melding = $Melding[array_rand($Melding)];  

  mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',liv='$Ny_Liv',rankpros='$Ny_pros',plan_tid='$VenteTid' WHERE brukernavn='$Brukeren'"); 

  mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
  mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$Brukeren' AND id='$IdEr'");

  return $Melding;
  }
  
  
  }
  ?>