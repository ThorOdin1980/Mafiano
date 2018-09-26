  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 

  
  $NyVentetid = $Timestamp + '200';
  $NyGta = $biler_gjort + '1';
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $Straff = $Timestamp + '240';
  $NyRespekt = floor($respekt + '60');
  

  $GetBil = mysql_query("SELECT * FROM garage WHERE eier='$StjelFra' AND land='$land' AND forsikret='NEI' ORDER BY RAND() LIMIT 1");
  if(mysql_num_rows($GetBil) == '0') { 
  $Meld = array("Du fikk ikke dirka opp garasje døra til $StjelFra.", "Du feilet i forsøket på å åpne garasje døren.", "Du feilet.", "Du fant ikke fram til $StjelFra sin garasje.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  } else {
  $BilInfo = mysql_fetch_assoc($GetBil);
  $bil_stjele_Ab = $bil_info_hent2['bilmerke'];
  $bil_skade_Ab = $bil_info_hent2['skade'];
  $bil_iden_Ab = $bil_info_hent2['id'];
  if($biler_gjort <= '47') { $klare_svar = array("NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  if($biler_gjort >= '48') { $klare_svar = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  if($biler_gjort >= '54') { $klare_svar = array("JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  if($biler_gjort >= '60') { $klare_svar = array("JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  if($biler_gjort >= '66') { $klare_svar = array("JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI","NEI"); }
  if($biler_gjort >= '72') { $klare_svar = array("JA","JA","JA","JA","JA","NEI","NEI","NEI","NEI","NEI"); }
  $klare_svar = $klare_svar[array_rand($klare_svar)];
  if($klare_svar == 'JA') { 
  $Meld = array("Du dirka opp garasjen til $StjelFra og stakk av med en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.","Du sagde deg igjennom garasjeveggen og stjal en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.", "Garasjen var åpen, du gikk bare rett inn å tokk en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.", "Du stakk av med en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.", "Du tjuvkoblet en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.", "Du brøt deg inn i garasjen og stjal en $bil_stjele_Ab, bilen er $bil_skade_Ab prosent skadet.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("UPDATE garage SET eier='$brukernavn',stjelt_fra='$land',timestampen='$Timestamp' WHERE id='$bil_iden_Ab'"); 
  if($kjoonn == 'Gutt') { $tekst_din_eid_1 = "En mann brøt seg inn i garasjen din å stakk av med $bil_stjele_Ab."; $tekst_din_eid_2 = "En anonym mann brøt seg inn i garasjen din å stakk av med $bil_stjele_Ab."; $tekst_din_eid_3 = "En mann med finlandshette brøt seg inn i garasjen din å stakk av med $bil_stjele_Ab."; $tekst_din_eid_4 = "En mann tjuvkoblet å stjal bilen din."; $tekst_din_eid_5 = "Mannen ved navn $brukernavn stjal din $bil_stjele_Ab."; $tekst_din_eid_6 = "Din $bil_stjele_Ab har blitt stjelt."; } else { $tekst_din_eid_1 = "Ei dame brøt seg inn i garasjen din, hu stjal en $bil_stjele_Ab."; $tekst_din_eid_2 = "Ei velltrent dame brøt seg inn i garasjen din å stakk av med $bil_stjele_Ab."; $tekst_din_eid_3 = "Ei jente med et uskyldig smil brøt seg inn i garasjen din å stakk av med $bil_stjele_Ab."; $tekst_din_eid_4 = "En dame med tjuvkoblet å stjal bilen din."; $tekst_din_eid_5 = "Damen ved navn $brukernavn stjal din $bil_stjele_Ab."; $tekst_din_eid_6 = "Din $bil_stjele_Ab har blitt stjelt."; }
  $velg_tekst2 = array("$tekst_din_eid_1","$tekst_din_eid_2", "$tekst_din_eid_3", "$tekst_din_eid_4", "$tekst_din_eid_5", "$tekst_din_eid_6");
  $velg_tekst2 = $velg_tekst2[array_rand($velg_tekst2)];

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$StjelFra','$tiden','$AnnenDato','Biltyveri','$velg_tekst2','Ja')");
  if(!empty($gjeng) && !empty($SInfo['gjeng']) && $SInfo['gjeng'] != $gjeng) {  mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.9' WHERE Gjeng_Navn='$gjeng'"); mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.9' WHERE brukernavn='$brukernavn'"); }
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  } else { 
  $hendelse_svar = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
  $hendelse_svar = $hendelse_svar[array_rand($hendelse_svar)];
  if($hendelse_svar == 'Fengsel') {
  $Meld = array("Eieren ringte politiet.", "Purken så hva du drev med, du ble busta.", "Du ble tatt av en politimann.", "Du ble tatt.");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Biltyveri','4','4000000','$Straff','$Timestamp','$land')");
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  } 
  elseif($hendelse_svar == 'Ikkeno') { 
  if($offer_kjon == 'Jente') { $tekst_din_eid_1 = "Du feilet i forsøket på stjele fra damen som går under navnet $StjelFra."; $tekst_din_eid_2 = "Du prøvde å tjuvkoble bilen til $StjelFra men feilet desverre."; $tekst_din_eid_3 = "Kjerringa viste at du skulle prøve å stjele bilen hennes, du feilet."; $tekst_din_eid_4 = "Du prøvde å stjele en $bil_stjele_Ab men feilet desverre."; $tekst_din_eid_5 = "Du feilet."; } else { $tekst_din_eid_1 = "Du feilet i forsøket på stjele fra mannen som går under navnet $StjelFra."; $tekst_din_eid_2 = "Du prøvde å tjuvkoble bilen til $StjelFra men feilet desverre."; $tekst_din_eid_3 = "Mannen viste at du skulle prøve å stjele bilen hans, du feilet."; $tekst_din_eid_4 = "Du prøvde å stjele en $bil_stjele_Ab men feilet desverre."; $tekst_din_eid_5 = "Du feilet."; }
  $Meld = array("$tekst_din_eid_1", "$tekst_din_eid_2", "$tekst_din_eid_3", "$tekst_din_eid_4", "$tekst_din_eid_5");
  $Meld = $Meld[array_rand($Meld)];
  mysql_query("UPDATE brukere SET bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($hendelse_svar == 'Respekt') {
  if($offer_kjon == 'Gutt') { $tekst_din_eid_1 = "han"; } else { $tekst_din_eid_1 = "hu"; }
  $Meld = array("Du kom ikke inn i garasjen så du gikk rett inn i huset å slo ned $StjelFra, du gikk opp i respekt.","Du slo ned $StjelFra, du gikk opp i respekt men fikk ikke stjelt en bil.","$StjelFra prøvde å ringe purken så du slo $tekst_din_eid_1 ned å stakk hjem, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',bil_tid='$NyVentetid',biler_gjort='$NyGta',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$StjelFra','$tiden','$AnnenDato','Slått ned','$brukernavn slo deg ned.','Ja')"); 
  if(!empty($gjeng) && !empty($SInfo['gjeng']) && $SInfo['gjeng'] != $gjeng) {  mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.3' WHERE Gjeng_Navn='$gjeng'"); mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.3' WHERE brukernavn='$brukernavn'"); }
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  
  }}}
  ?>
  
