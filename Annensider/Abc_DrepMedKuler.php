  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if (empty($brukernavn)) { header("Location: index.php"); }
  elseif(basename($_SERVER['PHP_SELF']) == "Abc_DrepMedKuler.php") { header("Location: index.php"); } else {

  // Funksjoner
  function Styrke($Drap,$Respekt,$RankNiva) { $Drap = floor($Drap); $Respekt = floor($Respekt); $RankNiva = floor($RankNiva); if($Drap > '2') { $Stryke_2 = $Drap / '3'; } else { $Stryke_2 = '0'; } if($Respekt < '1000') { $Stryke_3 = '1'; } if($Respekt > '1000') { $Stryke_3 = '2'; } if($Respekt > '10000') { $Stryke_3 = '4'; } if($Respekt > '100000') { $Stryke_3 = '6'; } if($Respekt > '1000000') { $Stryke_3 = '8'; } $Styrke = ($Stryke_2 + $Stryke_3 + $RankNiva) * '7'; return $Styrke; }
  function VopenStyrke($Bruker) { $Styrke = '0';  $Hent = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$Bruker' AND type='1' AND forbruk_nr >= '1'"); if(mysql_num_rows($Hent) >= '1') { while($i = mysql_fetch_assoc($Hent)) { if($i['utstyr'] == 'Hammer' && $i['skytereningen'] >= '100') { $Pluss = '100'; } elseif($i['utstyr'] == 'Balltre' && $i['skytereningen'] >= '100') { $Pluss = '200'; } elseif($i['utstyr'] == 'Knokejern' && $i['skytereningen'] >= '100') { $Pluss = '300'; } elseif($i['utstyr'] == 'Kniv' && $i['skytereningen'] >= '100') { $Pluss = '400'; } elseif($i['utstyr'] == 'Glock 17' && $i['skytereningen'] >= '100') { $Pluss = '500'; } elseif($i['utstyr'] == 'Desert Eagle' && $i['skytereningen'] >= '100') { $Pluss = '600'; } elseif($i['utstyr'] == 'Uzi smg' && $i['skytereningen'] >= '100') { $Pluss = '700'; } elseif($i['utstyr'] == 'Ak-47' && $i['skytereningen'] >= '100') { $Pluss = '800'; } elseif($i['utstyr'] == 'Steyr aug a1' && $i['skytereningen'] >= '100') { $Pluss = '900'; } elseif($i['utstyr'] == 'SOPMOD M4' && $i['skytereningen'] >= '100') { $Pluss = '1900'; } else { $Pluss = '0'; } $Styrke = $Styrke + $Pluss; }} return $Styrke; }
  function TotalStyrke($Styrke,$Prosent) { $Styrke = floor($Styrke); $Ti_prosent = $Styrke / '100' * $Prosent; $Styrke = floor($Styrke - $Ti_prosent); if($Styrke < '1') { $Styrke = '0'; } return $Styrke; }
  function Kevlar($Bruker,$Kuler,$RankNiva) { $Styrke = '0';  $Hent = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$Bruker' AND type='2' AND forbruk_nr >= '1'"); if(mysql_num_rows($Hent) >= '1') { while($i = mysql_fetch_assoc($Hent)) { if($i['utstyr'] == 'Finnlandshette') { $Pluss = '100'; } elseif($i['utstyr'] == 'Hund') { $Pluss = '200'; } elseif($i['utstyr'] == 'Skuddsikker vest') { $Pluss = '300'; } elseif($i['utstyr'] == 'Livvakt') { $Pluss = '400'; } elseif($i['utstyr'] == 'Secret Service') { $Pluss = '1400'; } $Styrke = $Styrke + $Pluss; }} if($Styrke == '0') { $Prosent = '1'; } if($Styrke >= '100') { $Prosent = '10'; } if($Styrke >= '200') { $Prosent = '15'; } if($Styrke >= '400') { $Prosent = '20'; } if($Styrke >= '800') { $Prosent = '25'; } if($Styrke >= '1000') { $Prosent = '30'; } if($Styrke >= '2000') { $Prosent = '40'; } else { $Prosent = '1'; } $Minus = $Kuler / '100' * $Prosent; $KulerSendt = floor($Kuler - $Minus); $KulerTrengs = floor(($RankNiva + '1') * '10000'); $Skade = $KulerSendt / $KulerTrengs; $Skade = floor($Skade * '100'); if($KulerSendt > $KulerTrengs) { $Drep = 'Ja'; } else { $Drep = $Skade; } return $Drep; }

  // Variabler
  $Opp_Penger = floor($penger + '2000000');
  $Opp_Respekt = floor($respekt + '5000');
  $Opp_Rankpros = floor($rankpros + '4.5');
  $Opp_Poeng = floor($turns + '3');

  $DrapFeilerHelt = $rankpros + '0.1';
  $DrapSkaderPersonen = $rankpros + '0.5';
  $DrapVellykket = $rankpros + '2.5';
  $NyttDrapAntallBruker = $drap + '1';
  $Ny_Sum_Kuler = floor($kuler - $AntallKuler);

  // Sjekker om du har hette for da er du anonym
  $Sjekk_Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'");
  if(mysql_num_rows($Sjekk_Hette) == '0') { $HetteEll = 'Nei'; } else { $HetteEll = 'Ja'; }

  if($kjoonn == 'Gutt') { $Kjon_1 = 'mann'; $Kjon_2 = 'han'; } else { $Kjon_1 = 'dame'; $Kjon_2 = 'hun'; }
  if($offer_Sex == 'Gutt') { $Kjon_11 = 'mann'; $Kjon_22 = 'han'; } else { $Kjon_11 = 'dame'; $Kjon_22 = 'hun'; }



  // Feiler siden spiller ikke er i samme land
  if($offer_land != $land) { 
  if($HetteEll == 'Ja') { $TekstMelding = array("En medspiller prøvde å drepe deg men feilet.","En $Kjon_1 prøvde å drepe deg men feilet ettersom du befinner deg i en annen by.","En $Kjon_1 med finlandshette prøvde å drepe deg i en by du ikke befant deg i."); $DinMelding = array("Drapsforsøket ditt feilet.","Du fant ikke $Offer i $land en gang, åssen skal du da klare å drepe spillern.","Du feilet i drapsforsøket på $Offer."); } else { $TekstMelding = array("$brukernavn prøvde å gjevne deg med jorda.","$brukernavn lette etter deg i $land men fant deg ikke $Kjon_2 feilet derfor i drapsforsøket på deg.","$brukernavn prøvde å drep deg men feilet."); $DinMelding = array("Du feilet i drapsforsøket, $Offer vet hvem du er.","Du fant ikke $Offer, men $Kjon_22 vet at du prøvde å drepe $Kjon_22 og hun vet kansje hvor du befinner deg alt.","Drapsforsøket ditt feilet, du burde være obs på en vendetta."); }
  $TekstMelding = $TekstMelding[array_rand($TekstMelding)]; $DinMelding = $DinMelding[array_rand($DinMelding)];

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapFeilerHelt',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','0')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','$TekstMelding','Ja')");
  echo PrintTeksten("$DinMelding","1","Feilet");
  }
  
  // Feiler siden spiller sitter i fengsel
  elseif(mysql_num_rows(mysql_query("SELECT * FROM fengsel WHERE brukernavn='$Offer' AND timestamp_over > $tiden")) > '0') { 
  if($HetteEll == 'Ja') { $TekstMelding = array("En $Kjon_1 med finlandshette prøvde å drepe deg men feilet.","En $Kjon_1 feilet i forsøket på å drepe deg.","En medspiller prøvde å drepe deg i fengselet, du burde ikke utføre kriminelle handlinger som kan føre til fengsel straff mens drap er aktivert.","En medspiller feilet i forsøket på å drepe deg.","En $Kjon_1 prøvde å drepe deg mens du satt innelåst i fengselet, $Kjon_2 kom seg ikke igjenom muren."); $DinMelding = array("Drapsforsøket ditt var katastrofe, personen sitter i fengsel du burde vente til $Kjon_22 kommer ut av fengsel.","Drapsforsøket ditt var katastrofe, du stakk med en gang du så noen av fengselsvaktene. Det er ikke så lurt å prøve å drepe en som sitter i fengsel.","Du feilet.","Du feilet desverre i forsøket på å drepe $Offer, personen satt i fengsel du kom desverre ikke igjenom muren."); } else { $TekstMelding = array("$brukernavn feilet i forsøket på å drepe deg.","$brukernavn prøvde å drepe deg, men $Kjon_2 feilet siden du satt i fengsel under drapsforsøket."); $DinMelding = array("Du feilet i forsøket på drepe spilleren, $Kjon_22 vet hvem du er nå.","$Offer satt å flira igjennom fengselsvindune mens du desperat prøvde å drepe $Kjon_22, du feilet og $Offer vet hvem du er."); }
  $TekstMelding = $TekstMelding[array_rand($TekstMelding)]; $DinMelding = $DinMelding[array_rand($DinMelding)];

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapFeilerHelt',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','0')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','$TekstMelding','Ja')");
  echo PrintTeksten("$DinMelding","1","Feilet");
  } else { 
  
  // Feiler siden spiller sitter i bunkers

  $Bunkers = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$Offer' AND godtatt_elle='1' AND timestamp_ute > '$tiden'");
  if(mysql_num_rows($Bunkers) >= '1') { 
  if($HetteEll == 'Ja') { $TekstMelding = array("Et drapsforsøk på deg feilet.","En $Kjon_1 hadde plander om å drepe deg men han kom ikke inn i bunkeren.","En stygg medspiller prøvde å drepe deg men feilet.","En medspiller prøvde å drepe deg, $Kjon_2 fant ut at du var i $land men $Kjon_2 kom ikke inn i bunkeren."); $DinMelding = array("Drapsforsøket ditt feilet desverre.","Du klarte ikke å drike opp bunkerdøra, drapsforsøket feilet.","Drapsforsøket ditt feilet.","Du fant ut hvor $Offer befant seg i $land men du kom desverre ikke inn i bunkeren $Kjon_22 var i."); } else { $TekstMelding = array("$brukernavn forsøkte å drepe deg men feilet.","Et drapsforsøk på deg feilet, du så at det var $brukernavn som hadde planer om å drepe deg."); $DinMelding = array("Du feilet.","Drapsforsøket feilet.","Du fant bunkeren men du kom deg ikke inn, $Offer vet hvem du er og $Kjon_22 leier kansje inn en vendetta.","Du feilet i forsøket på å drepe $Offer, $Kjon_22 vet nå hvem du er."); }
  $TekstMelding = $TekstMelding[array_rand($TekstMelding)]; $DinMelding = $DinMelding[array_rand($DinMelding)];

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapFeilerHelt',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','0')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','$TekstMelding','Ja')");
  echo PrintTeksten("$DinMelding","1","Feilet");
  } else { 
  
  // Styrke
  $OfferStyrke = Styrke($offer_drap,$offer_respekt,$offer_rankniva) + VopenStyrke($Offer);
  $DinStyrke = Styrke($drap,$respekt,$rank_niva) + VopenStyrke($brukernavn);
  $OfferStyrke = TotalStyrke($OfferStyrke,'10');
  $DinStyrke = TotalStyrke($DinStyrke,'5');

  // Sjekker om du er sterkere en offeret
  if($DinStyrke >= $OffStyrke) { 
  if(Kevlar($Offer,$AntallKuler,$offer_rankniva) == 'Ja') { 
  
  if($Offer == 'Dirty krystal') { 
    
  // Du dreper offeret 

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$Opp_Rankpros',drap='$NyttDrapAntallBruker',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler',respekt='$Opp_Respekt',penger='$Opp_Penger',turns='$Opp_Poeng',oppdrag_nr='4',OppdragUtfort='' WHERE brukernavn='$brukernavn'");
  if(!empty($gjeng)) { mysql_query("UPDATE Gjenger SET drap=`drap`+'1' WHERE Gjeng_Navn='$gjeng'"); }
  echo PrintTeksten("Du drepte $Offer. Du kom unna med alt hun eide, 5.000 respekt, 2.000.000 kr og 3 poeng.","1","Vellykket");
  
  } else {
  
  // Du dreper offeret

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapVellykket',drap='$NyttDrapAntallBruker',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET liv='0',timestamp_dod='$tiden',aktiv_eller='0',dato_drept='$tid $nbsp $dato' WHERE brukernavn='$Offer'");
  if(!empty($gjeng)) { mysql_query("UPDATE Gjenger SET drap=`drap`+'1' WHERE Gjeng_Navn='$gjeng'"); }

  mysql_query("INSERT INTO drepte_spillere (morder_navn,offer,timestampen,dato) VALUES ('$brukernavn','$Offer','$tiden','$tid $nbsp $dato')");

  mysql_query("INSERT INTO DrapsLogg (DreptAv,BrukerDrept,DatoDrept,TimestampDrept) VALUES ('$brukernavn','$Offer','$AnnenDato','$tiden')");
  mysql_query("UPDATE drap_config SET max_kills = (max_kills - 1) WHERE id = 1"); // Reduserer max tillatte drap per dag med 1 om vellykket!
  include "./Annensider/Abc_drepeauto.php";
  echo PrintTeksten("Du drepte $Offer","1","Vellykket");
  
  }} else { 
  $StorSkade = Kevlar($Offer,$AntallKuler,$offer_rankniva);
  $NyttLiv = floor($offer_liv - $StorSkade);

  // Feiler i drapet
  if($StorSkade < '1') { 

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapFeilerHelt',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','0')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','En medspiller feilet i forsøket på å drepe deg.','Ja')");
  echo PrintTeksten("Du feilet.","1","Feilet");
  } else {
  if($NyttLiv < '1') { 
  
  if($Offer == 'Dirty krystal') { 
    
  // Du dreper offeret 

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$Opp_Rankpros',drap='$NyttDrapAntallBruker',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler',respekt='$Opp_Respekt',penger='$Opp_Penger',turns='$Opp_Poeng',oppdrag_nr='4',OppdragUtfort='' WHERE brukernavn='$brukernavn'");
  if(!empty($gjeng)) { mysql_query("UPDATE Gjenger SET drap=`drap`+'1' WHERE Gjeng_Navn='$gjeng'"); }
  echo PrintTeksten("Du drepte $Offer. Du kom unna med alt hun eide, 5.000 respekt, 2.000.000 kr og 3 poeng.","1","Vellykket");
  
  } else {
  
  // Du dreper offeret 

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapVellykket',drap='$NyttDrapAntallBruker',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET liv='0',timestamp_dod='$tiden',dato_drept='$tid $nbsp $dato' WHERE brukernavn='$Offer'");
  if(!empty($gjeng)) { mysql_query("UPDATE Gjenger SET drap=`drap`+'1' WHERE Gjeng_Navn='$gjeng'"); }

  mysql_query("INSERT INTO drepte_spillere (morder_navn,offer,timestampen,dato) VALUES ('$brukernavn','$Offer','$tiden','$tid $nbsp $dato')");

  mysql_query("INSERT INTO DrapsLogg (DreptAv,BrukerDrept,DatoDrept,TimestampDrept) VALUES ('$brukernavn','$Offer','$tid $nbsp $dato $nbsp $aar','$tiden')");

  include "Abc_drepeauto.php";
  echo PrintTeksten("Du drepte $Offer","1","Vellykket");
  
  
  }} else { 
  
  // Du skader offeret

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapSkaderPersonen',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("UPDATE brukere SET liv='$NyttLiv' WHERE brukernavn='$Offer'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','$StorSkade')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','En medspiller skadet deg via drapsfunksjonen.','Ja')");
  echo PrintTeksten("Du skadet $Offer, desverre døde ikke spilleren.","1","Vellykket");
  }}}} else { 
  
  // Feiler siden du er svakere
  if($HetteEll == 'Ja') { $TekstMelding = array("Et drapsforsøk på deg feilet.","Et drapsforsøk på deg feilet, du er enda tøffere en spillern som angrep deg.","En $Kjon_1 prøvde å drepe deg men feilet siden du er en harding.","En medspiller prøvde å drepe deg men feilet siden du var enda mer erfaren en $Kjon_2."); $DinMelding = array("Du klarte desverre ikke å drepe $Offer, $Kjon_22 er mer erfaren en deg.","Drapsforsøket ditt feilet, $Offer er mer erfaren en deg.","Du feilet i forsøket på å drepe $Offer, $Kjon_22 er mer erfaren en deg foreløpig."); } else { $TekstMelding = array("$brukernavn feilet i forsøket på å drepe deg.","Du kan kose deg nå fordi $brukernavn feilet i forsøket på å drepe deg.","Et dårlig drapsforsøk på deg feilet på høyt nivå, personen som prøvde seg på deg heter $brukernavn."); $DinMelding = array("Forsøket ditt feilet, $Kjon_22 vet hvem du er nå.","Du feilet i forsøket på å drepe $Offer, $Kjon_22 er sterkere en deg og $Kjon_22 vet hvem du er nå."); }
  $TekstMelding = $TekstMelding[array_rand($TekstMelding)]; $DinMelding = $DinMelding[array_rand($DinMelding)];

  mysql_query("DELETE FROM garage WHERE id='$Fluktbil' AND eier='$brukernavn'");
  mysql_query("UPDATE brukere SET rankpros='$DrapFeilerHelt',aktiv_eller='$Aktiv',kuler='$Ny_Sum_Kuler' WHERE brukernavn='$brukernavn'");
  mysql_query("INSERT INTO Mordforsok (Bruker,Offer,Dato,Stamp,Skade) VALUES ('$brukernavn','$Offer','$AnnenDato','$Timestamp','0')"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$Offer','$tiden','$AnnenDato','Drapsforsøk','$TekstMelding','Ja')");
  echo PrintTeksten("$DinMelding","1","Feilet");
  }}}}
  ?>