  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else { 

  if($SexLengde == '40') { if($Gir['horer_pult'] >= '80') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }} 
  elseif($SexLengde == '35') { if($Gir['horer_pult'] >= '70') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '30') { if($Gir['horer_pult'] >= '60') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '25') { if($Gir['horer_pult'] >= '50') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '20') { if($Gir['horer_pult'] >= '40') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '15') { if($Gir['horer_pult'] >= '30') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  elseif($SexLengde == '10') { if($Gir['horer_pult'] >= '10') { $Holder = 'Ja'; } else { $Holder = 'Nei'; }}
  
  $Din_V_styrke = '0';
  $Offer_V_styrke = '0';
  $Offer_V_styrke_2 = '0';
  

  $V1 = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$PersEn' AND type='1' AND forbruk_nr >= '1'");
  if(mysql_num_rows($V1) == '0') { $pluss_1 = '0'; } else {
  while($R1 = mysql_fetch_assoc($V1)) { 
  if($R1['utstyr'] == 'Hammer') { $pluss_1 = '100'; } 
  elseif($R1['utstyr'] == 'Balltre') { $pluss_1 = '200'; }
  elseif($R1['utstyr'] == 'Knokejern') { $pluss_1 = '300'; }
  elseif($R1['utstyr'] == 'Kniv') { $pluss_1 = '400'; }
  elseif($R1['utstyr'] == 'Glock 17') { $pluss_1 = '500'; }
  elseif($R1['utstyr'] == 'Desert Eagle') { $pluss_1 = '600'; }
  elseif($R1['utstyr'] == 'Uzi smg') { $pluss_1 = '700'; }
  elseif($R1['utstyr'] == 'Ak-47') { $pluss_1 = '800'; }
  elseif($R1['utstyr'] == 'Steyr aug a1') { $pluss_1 = '900'; }
  elseif($R1['utstyr'] == 'SOPMOD M4') { $pluss_1 = '1900'; }
  $Din_V_styrke = $Din_V_styrke + $pluss_1;
  }}
  
  $V2 = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$PersTo' AND type='1' AND forbruk_nr >= '1'");
  if(mysql_num_rows($V2) == '0') { $pluss_2 = '0'; } else {
  while($R2 = mysql_fetch_assoc($V2)) { 
  if($R2['utstyr'] == 'Hammer') { $pluss_2 = '100'; } 
  elseif($R2['utstyr'] == 'Balltre') { $pluss_2 = '200'; }
  elseif($R2['utstyr'] == 'Knokejern') { $pluss_2 = '300'; }
  elseif($R2['utstyr'] == 'Kniv') { $pluss_2 = '400'; }
  elseif($R2['utstyr'] == 'Glock 17') { $pluss_2 = '500'; }
  elseif($R2['utstyr'] == 'Desert Eagle') { $pluss_2 = '600'; }
  elseif($R2['utstyr'] == 'Uzi smg') { $pluss_2 = '700'; }
  elseif($R2['utstyr'] == 'Ak-47') { $pluss_2 = '800'; }
  elseif($R2['utstyr'] == 'Steyr aug a1') { $pluss_2 = '900'; }
  elseif($R2['utstyr'] == 'SOPMOD M4') { $pluss_2 = '1900'; }
  $Offer_V_styrke = $Offer_V_styrke + $pluss_2;
  }}
  
  $Hette = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$PersEn' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'");
  if(mysql_num_rows($Hette) == '0') { $HetteEll = 'Nei'; } else { $HetteEll = 'Ja'; }
  
  include "knull_prosent.php";
  $NyPult = $Tar['horer_pult'] + '1';


  if($Holder == 'Ja') { 
  if($Din_V_styrke >= $Offer_V_styrke) { 
  
  
  if($HetteEll == 'Ja') { 
  $Meld_1 = array("Tidslengden du betalte for var ikke lang nok til å få orgasme så du voldtok $PersTo i 15 minutter ekstra.","Du knullet $PersTo helt til betalingen var over, men du hadde lyst på mer så du tok deg retten til å knulle hora 10 minutter til uten ekstra kostnader."); 
  $Meld_2 = array("Du ble voldtat av en spiller med finlandshette, ikke nok med det spilleren inviterte med tre andre. Du fikk likevel betalt for de første minuttene av seksaktiviteten.","Du ble desverre voldtat etter at seksrunden var over. Du fikk likevel betalt for de første minuttene av seksaktiviteten.","Du ble voldtat med strapon og penetrert av en hockykølle, du fikk ikke med deg hvem som gjorde dette mot deg. Du fikk likevel betalt for de første minuttene av aktiviteten.","Du ble voldtat av en anonym spiller, du vet ikke engang om det var en mann eller dame ettersom du ble slått bevistløs. Du fikk likevel betalt for de første minuttene."); 
  } else { 
  $Meld_1 = array("Tidslengden du betalte for var ikke lang nok til å få orgasme så du voldtok $PersTo. Spilleren fikk med seg hvem du var.","Du knullet $PersTo i starten men det gikk over til agresiv aktivitet, du voldtok spilleren. Du dreit på draget du skulle ha benytte deg av en finlandshette, spilleren vet nå hvem du er og hva du har gjort."); 
  $Meld_2 = array("$PersEn og tre venner knullet deg i munnen.","$PersEn voldtok deg.","$PersEn voldtok deg så jevlig hardt at du besja på deg.","Du ble voldtat av en spiller, spileren som voldtok deg heter $PersEn."); 
  }
  $Meld_1 = $Meld_1[array_rand($Meld_1)];
  $Meld_2 = $Meld_2[array_rand($Meld_2)];
  
  // Du voldtar personen
  $Res_1 = ( $Gir['horer_pult'] + '2.53' ) * '2.2'; if($Res_1 > '900') { $Res_1 = '900'; } $Res_2 = ( $Gir['rank_nivaa'] + '2.53' ) * '2'; $Res_3 = $SexLengde * '3.3'; 
  $GiResp = floor($Res_1 + $Res_2 + $Res_3);
  

  mysql_query("UPDATE brukere SET respekt=`respekt`+'$GiResp',rankpros=`rankpros`+'$knull_prosent_s',horer_pult=`horer_pult`+'1' WHERE brukernavn='$PersEn'"); 
  mysql_query("UPDATE brukere SET horer_pult='$NyPult',penger=`penger`+'$PengeSum' WHERE brukernavn='$PersTo'"); 
  mysql_query("UPDATE Horehus SET Bang_hore_skils='$NyPult',Bang_Status='Klar for deg' WHERE id='$HorehusID'"); 
  mysql_query("DELETE FROM Horehus_Knull WHERE Knull_horehus_id='$HorehusID' AND Knull_brukernavn='$PersEn'");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersEn','$Timestamp','$FullDato','Voldtekt utført','$Meld_1','Ja')");
  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersTo','$Timestamp','$FullDato','Voldtat','$Meld_2','Ja')");

  
  if(!empty($Gir['gjeng']) && !empty($Tar['gjeng']) && $Tar['gjeng'] != $Gir['gjeng']) { 
  $Gjengen = $Gir['gjeng'];
  mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.6' WHERE Gjeng_Navn='$Gjengen'"); 
  mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.6' WHERE brukernavn='$PersEn'"); 
  }
  
  } else { 
  $Meld_1 = "Du knullet hora til betalingen var brukt opp, du skulle så voldta spilleren men feilet desverre. Purken var like rundt hjørne, du ble arrestert."; 
  $Meld_2 = "En medspiller prøvde å voldta deg etter betalingen var oppgjort, du slo ned kunden og ringte purken."; 

  mysql_query("UPDATE brukere SET rankpros=`rankpros`+'$knull_prosent_s',horer_pult=`horer_pult`+'1' WHERE brukernavn='$PersEn'"); 
  mysql_query("UPDATE brukere SET horer_pult='$NyPult',penger=`penger`+'$PengeSum' WHERE brukernavn='$PersTo'"); 
  mysql_query("UPDATE Horehus SET Bang_hore_skils='$NyPult',Bang_Status='Klar for deg' WHERE id='$HorehusID'");   
  mysql_query("DELETE FROM Horehus_Knull WHERE Knull_horehus_id='$HorehusID' AND Knull_brukernavn='$PersEn'");  

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersEn','$Timestamp','$FullDato','Fengsel','$Meld_1','Ja')");  
  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersTo','$Timestamp','$FullDato','Voldtekts forsøk','$Meld_2','Ja')");

  $Landet = $Gir['land'];
  $Straff = $Timestamp + '240';
  mysql_query("INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$PersEn','Voldtekt','4','$FullDato','$Timestamp','','Voldteksforsøk på $PersTo.','$Landet')");
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$PersEn','Voldtekt','4','4000000','$Straff','$Timestamp','$Landet')");
  }} else { 
  
  $Meld_1 = array("Du klarte ikke å pule ferdig runden du betalte for, åssen skal du da orke å voldta hora etterpå.","Du holdt ikke ut runden du betalte for, åssen skal du da klare å voldta spilleren etterpå."); 
  $Meld_1 = $Meld_1[array_rand($Meld_1)];
  

  mysql_query("UPDATE brukere SET horer_pult=`horer_pult`+'1' WHERE brukernavn='$PersEn'"); 
  mysql_query("UPDATE brukere SET horer_pult='$NyPult',penger=`penger`+'$PengeSum' WHERE brukernavn='$PersTo'"); 
  mysql_query("UPDATE Horehus SET Bang_hore_skils='$NyPult',Bang_Status='Klar for deg' WHERE id='$HorehusID'");   
  mysql_query("DELETE FROM Horehus_Knull WHERE Knull_horehus_id='$HorehusID' AND Knull_brukernavn='$PersEn'");   

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersEn','$Timestamp','$FullDato','Voldtekt feilet','$Meld_1','Ja')");
  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$PersTo','$Timestamp','$FullDato','Sex over','Du har akuratt fullført en seksuel aktivitet med en medspiller.','Ja')");

  }}
  ?>

        
