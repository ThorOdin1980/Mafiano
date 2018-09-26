         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <?
         if (empty($brukernavn)) { header("Location: index.php"); } else {
 
       
         $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE kidnappers_navn='$brukernavn'");
         if (mysql_num_rows($kidnapp_sjekk_om2K) == '0') { header("Location: game.php?side=hoved"); } else {
  
         // Sjekk sykehus
       
         $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
         if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=sykehuset"); } else { 
 
         // sjekker om du sitter i bunker
       
         $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
         if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {
 
       
         $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
         if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=fengsel"); } else {
 
         function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }

         // Henter ut informasjon
       
         $kidnappings_offer_du = mysql_fetch_assoc($kidnapp_sjekk_om2K);
         $dato_kidnappet_2k = $kidnappings_offer_du['dato_tatt'];
         $politiet_leter_2k = $kidnappings_offer_du['politi_starter'];
         $politi_finner_2k = $kidnappings_offer_du['politi_finner'];
         $timestampen_tatt_2k = $kidnappings_offer_du['timestampen_tatt'];
         $landet_tatt_2k = $kidnappings_offer_du['landet'];
         $offer_navn_2k = $kidnappings_offer_du['offer'];
         $TORTUR_STAMP_3K = $kidnappings_offer_du['TORTUR_STAMP'];
         $antall_tortur_3K = $kidnappings_offer_du['antall_tortur'];
         $antall_voldtekt_3K = $kidnappings_offer_du['antall_voldtekter'];
         $Voldtekt_stamp_3K = $kidnappings_offer_du['Voldtekt_stamp'];
         $pressings_stamp_3K = $kidnappings_offer_du['pressings_stamp'];
         $antall_press_3K = $kidnappings_offer_du['antall_press'];
         $Selges_ell_3K = $kidnappings_offer_du['Selges_ell'];
         $stamp_selg_start_3K = $kidnappings_offer_du['stamp_selg_start'];
         $dato_selg_start_3K = $kidnappings_offer_du['dato_selg_start'];
         $selges_for_3K = $kidnappings_offer_du['selges_for'];
         $anonymt_ell_3K = $kidnappings_offer_du['anonymt_ell'];
         $selg_igjen_3K = $kidnappings_offer_du['kidnapp_selg_videre'];

         $vente_selg_igjen = $selg_igjen_3K - $tiden;
         $tiden_salg_over = $stamp_selg_start_3K - $tiden;

         $pressings_ventetid = $pressings_stamp_3K - $tiden;
         $voldtekt_ventetid = $Voldtekt_stamp_3K - $tiden;
         $torturering_ventetid = $TORTUR_STAMP_3K - $tiden;

       
         $offer_info_bla2 = mysql_query("SELECT * FROM brukere WHERE brukernavn='$offer_navn_2k'") or die(mysql_error());
         $offer_info_ble = mysql_fetch_assoc($offer_info_bla2);
         $liv_offer_2kn = $offer_info_ble['liv'];
         $liv_offer_2k = floor($liv_offer_2kn);
         $respekt_offer_2k = $offer_info_ble['respekt'];
         
         echo "
         <div class=\"Div_masta\">
         <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">KIDNAPPING</span></div>
         <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Kidnapping.jpg\" width=\"490\" height=\"200\"></div>
         ";
         
         if(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'SlippFri') {
       
         $ventetid_eid = $tiden + '30';
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',kid_timestampen='$ventetid_eid' WHERE brukernavn='$brukernavn'");
       
         mysql_query("DELETE FROM kidnapping WHERE kidnappers_navn='$brukernavn'") or die(mysql_error());
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Sluppet fri','Kidnapperen har sluppet deg fri.','Ja')");
         header("Location: game.php?side=Kidnapping");   
         }elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Selg') {
         if($selg_igjen_3K > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Spilleren har nylig blitt kjøpt du må vente '.$vente_selg_igjen.' sekunder før du kan selge personen.</span></div>'; } else {
         if($Selges_ell_3K == '1' &&  $stamp_selg_start_3K > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Et salg er alt igang, salgsrunden er over om '.$tiden_salg_over.' sekunder.</span></div>'; } else {
         if(empty($_POST['valg'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt om det skal være anonymt eller ikke.</span></div>'; } else {
         if(empty($_POST['pris'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke skrevet inn summen du skal ha.</span></div>'; } else { 
         $type_anon_blir = rengjor_tall(mysql_real_escape_string($_POST['valg']));
         $selg_spenn_blir = rengjor_tall(mysql_real_escape_string($_POST['pris']));        
         $tiden_over_salg_aa = $tiden + '3600';
         if(strlen($selg_spenn_blir) > '20') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke legge ut offeret til salgs for en så stor sum.</span></div>'; } else {
         if($type_anon_blir == '1' || $type_anon_blir == '2') { 
         if($type_anon_blir == '1') { 
       
         mysql_query("UPDATE kidnapping SET anonymt_ell='1',selges_for='$selg_spenn_blir',dato_selg_start='$tid $nbsp $dato',stamp_selg_start='$tiden_over_salg_aa',Selges_ell='1' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har lagt ut '.$offer_navn_2k.' for '.number_format($selg_spenn_blir, 0, ",", ".").' kr.</span></div>';
         } else {
         if($penger < '10000') { 
         echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda til å sette deg selv som anonym.</span></div>';
         } else { 
         $ny_sum_spen_pga_salg = $penger - '10000';
       
         mysql_query("UPDATE kidnapping SET anonymt_ell='2',selges_for='$selg_spenn_blir',dato_selg_start='$tid $nbsp $dato',stamp_selg_start='$tiden_over_salg_aa',Selges_ell='1' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET penger='$ny_sum_spen_pga_salg',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har lagt ut '.$offer_navn_2k.' for '.number_format($selg_spenn_blir, 0, ",", ".").' kr, du forblir anonym under salgt.</span></div>';
         }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>'; 
         }}}}}}
         }elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Tortur') { 
         $type_tortur = mysql_real_escape_string($_POST['valg']);
         if($TORTUR_STAMP_3K > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente til det har gått '.$torturering_ventetid.' sekunder.</span></div>'; } else {
         if(empty($_POST['valg'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt hvilken måte du skal torturere offeret med.</span></div>'; } else {
         if($type_tortur == '1' || $type_tortur == '2' || $type_tortur == '3' || $type_tortur == '4') {
         include "kid_prosent.php";
         if($type_tortur == '1') { 
         $HANDLING2B = array("Du spytta på tryne til $offer_navn_2k.", "Du spytta i øyet til $offer_navn_2k.", "Du spytta på hånda til $offer_navn_2k.", "Du spytta på håret til $offer_navn_2k.", "Du spytta på tanna til $offer_navn_2k.", "Du spytta på $offer_navn_2k.");
         $MELDING2B = array("Kidnapperen spytta på deg.");
         $DIN_NYE_RESPEKT = $respekt + '50';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_TOR_VENTETID = $tiden + '110';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.4';
         }
         elseif($type_tortur == '2') { 
         $HANDLING2B = array("Du slo inn tryne til $offer_navn_2k.", "Vellykket du slo $offer_navn_2k.", "Du tokk rennafart og klinte til $offer_navn_2k.");
         $MELDING2B = array("Kidnapperen slo deg.");
         $DIN_NYE_RESPEKT = $respekt + '60';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_TOR_VENTETID = $tiden + '120';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.5';
         }
         elseif($type_tortur == '3') { 
         $HANDLING2B = array("Du sparka inn tryne til $offer_navn_2k.", "Vellykket flykick.", "Du sparket $offer_navn_2k i skrittet.", "Du sparket $offer_navn_2k i magen.", "Du sparka leggen til $offer_navn_2k.");
         $MELDING2B = array("Kidnapperen sparka deg.");
         $DIN_NYE_RESPEKT = $respekt + '70';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_TOR_VENTETID = $tiden + '130';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.6';
         }
         elseif($type_tortur == '4') { 
         $HANDLING2B = array("Du sendte strøm inn i kroppen til $offer_navn_2k.", "Vellykket, strømmen gikk rett inn i kroppen til $offer_navn_2k.","Strømmen ga $offer_navn_2k kramper, vellykket.");
         $MELDING2B = array("Kidnapperen sendte strøm inn i kroppen din.");
         $DIN_NYE_RESPEKT = $respekt + '80';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_TOR_VENTETID = $tiden + '140';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.7';
         } else { 
         $DIN_NYE_RESPEKT = $respekt;
         $OFFER_NYE_RESPEKT = $respekt_offer_2k;
         $DIN_NYE_RANKPROS = $rankpros;
         }
         if($OFFER_NYE_RESPEKT < '1') { $OFFER_NYE_RESPEKT = '0'; }
         $HANDLING2B_tekst = $HANDLING2B[array_rand($HANDLING2B)];
         $MELDING2B_tekst = $MELDING2B[array_rand($MELDING2B)];
         $ny_tortur_antall = $antall_tortur_3K + '1';
       
         mysql_query("UPDATE brukere SET rankpros='$DIN_NYE_RANKPROS',respekt='$DIN_NYE_RESPEKT',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET respekt='$OFFER_NYE_RESPEKT' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Tortur','$MELDING2B_tekst','Ja')");
       
         mysql_query("UPDATE kidnapping SET TORTUR_STAMP='$DIN_NYE_TOR_VENTETID',antall_tortur='$ny_tortur_antall' WHERE kidnappers_navn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">'.$HANDLING2B_tekst.'</span></div>';
         } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke velge noe som ikke eksisterer i spillet.</span></div>'; }}}}
         elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Voldtekt') { 
         if($Voldtekt_stamp_3K > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente til det har gått '.$voldtekt_ventetid.' sekunder.</span></div>'; } else {
         if(empty($_POST['valg'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt hvilken måte du skal voldta offeret på.</span></div>'; } else {
         $type_voldtekt = mysql_real_escape_string($_POST['valg']);
         if($type_voldtekt == '1' || $type_voldtekt == '2') { 
         include "kid_prosent.php";
         if($type_voldtekt == '1') {
         $HANDLING2B = array("Du voldtokk $offer_navn_2k.", "Du voldtokk $offer_navn_2k til tårene falt.", "Vellykket voldtekt på $offer_navn_2k.");
         $MELDING2B = array("Kidnapperen voldtokk deg.");
         $DIN_NYE_RESPEKT = $respekt + '40';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_VOLD_VENTETID = $tiden + '150';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.8';
         }
         elseif($type_voldtekt == '2') {
         $HANDLING2B = array("Du slo $offer_navn_2k mens du holdt på å voldta.", "Vellykket du slo $offer_navn_2k under voldtekten.", "Vellykket voldtekt på $offer_navn_2k.");
         $MELDING2B = array("Kidnapperen voldtokk deg.");
         $DIN_NYE_RESPEKT = $respekt + '60';
         $DIN_NYE_RANKPROS = $rankpros + $Kid_prosent_s;
         $DIN_NYE_VOLD_VENTETID = $tiden + '160';
         $OFFER_NYE_RESPEKT = $respekt_offer_2k - '0.9';
         }
         if($OFFER_NYE_RESPEKT < '1') { $OFFER_NYE_RESPEKT = '0'; }
         $HANDLING2B_tekst = $HANDLING2B[array_rand($HANDLING2B)];
         $MELDING2B_tekst = $MELDING2B[array_rand($MELDING2B)];
         $ny_voldtekt_antall = $antall_voldtekt_3K + '1';
         $horer_pult_ny = $horer_pult + '1';
       
         mysql_query("UPDATE brukere SET horer_pult='$horer_pult_ny',rankpros='$DIN_NYE_RANKPROS',respekt='$DIN_NYE_RESPEKT',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET respekt='$OFFER_NYE_RESPEKT' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Voldtekt','$MELDING2B_tekst','Ja')");
       
         mysql_query("UPDATE kidnapping SET Voldtekt_stamp='$DIN_NYE_VOLD_VENTETID',antall_voldtekter='$ny_voldtekt_antall' WHERE kidnappers_navn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">'.$HANDLING2B_tekst.'</span></div>';
         } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke velge noe som ikke eksisterer i spillet.</span></div>'; }}}}
         elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Press') { 
         if($pressings_stamp_3K > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente til det har gått '.$pressings_ventetid.' sekunder.</span></div>'; } else {
         if(empty($_POST['valg'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en måte å presse offer for penger.</span></div>'; } else {
         $type_press_blir = mysql_real_escape_string($_POST['valg']);
         if($type_press_blir == '1' || $type_press_blir == '2' || $type_press_blir == '3') { 
        
         if($antall_press_3K >= '0' ) { $rand_svar_valgt = rand (1, 6); }
         if($antall_press_3K >= '3' ) { $rand_svar_valgt = rand (1, 5); }
         if($antall_press_3K >= '5' ) { $rand_svar_valgt = rand (1, 4); }
         if($antall_press_3K >= '7' ) { $rand_svar_valgt = rand (1, 3); }
         if($antall_press_3K >= '11' ) { $rand_svar_valgt = $type_press_blir; }

       
         $offer_ba_status = mysql_query("SELECT * FROM brukere WHERE brukernavn ='$offer_navn_2k'") or die(mysql_error());
         $offer_info_ba = mysql_fetch_assoc($offer_ba_status);
         $penger_offer_ba = $offer_info_ba['penger'];
         $bank_offer_ba = $offer_info_ba['bank'];
         $bombechips_offer_ba = floor($offer_info_ba['bombechips']);
         $respekt_offer_ba = $offer_info_ba['respekt'];

         if($type_press_blir == '1') {
         if($penger_offer_ba >= '10000') {
         if($type_press_blir == $rand_svar_valgt) { 
         if($penger_offer_ba >= '10000') { $rand_sum_valgt = rand (5, 15); }  
         if($penger_offer_ba >= '100000') { $rand_sum_valgt = rand (5, 14); } 
         if($penger_offer_ba >= '1000000') { $rand_sum_valgt = rand (5, 10); } 
         if($penger_offer_ba >= '5000000') { $rand_sum_valgt = rand (4, 8); } 
         if($penger_offer_ba >= '10000000') { $rand_sum_valgt = rand (4, 6); } 
         if($penger_offer_ba >= '20000000') { $rand_sum_valgt = rand (2, 4); }  
         $minus_prosenten = $penger_offer_ba / '100' * $rand_sum_valgt;
         $ny_sum_penger_offer = $penger_offer_ba - $minus_prosenten;
         $ny_sum_cash_deg = $penger + $minus_prosenten;
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
         $sum_presser = number_format($minus_prosenten, 0, ",", ".");
       
         mysql_query("UPDATE brukere SET penger='$ny_sum_cash_deg',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET penger='$ny_sum_penger_offer' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Presset','Kidnapperen presset deg for $sum_presser kroner, pengene ble trekt fra hånda di.','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Vellykket du presset ut '.$sum_presser.' kr.</span></div>';
         } else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Offeret følte seg ikke truet nok til å gi deg penger.</span></div>';  
         }}elseif($bank_offer_ba >= '10000') {
         if($type_press_blir == $rand_svar_valgt) { 
         if($bank_offer_ba >= '10000') { $rand_sum_valgt = rand (5, 15); }  
         if($bank_offer_ba >= '100000') { $rand_sum_valgt = rand (5, 14); } 
         if($bank_offer_ba >= '1000000') { $rand_sum_valgt = rand (5, 10); } 
         if($bank_offer_ba >= '5000000') { $rand_sum_valgt = rand (4, 8); } 
         if($bank_offer_ba >= '10000000') { $rand_sum_valgt = rand (4, 6); } 
         if($bank_offer_ba >= '20000000') { $rand_sum_valgt = rand (2, 4); } 
         $minus_prosenten = $bank_offer_ba / '100' * $rand_sum_valgt;
         $ny_sum_bank_offer = $bank_offer_ba - $minus_prosenten;
         $ny_sum_cash_deg = $penger + $minus_prosenten;
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
         $sum_presser = number_format($minus_prosenten, 0, ",", ".");
       
         mysql_query("UPDATE brukere SET penger='$ny_sum_cash_deg',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET bank='$ny_sum_bank_offer' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Presset','Kidnapperen presset deg for $sum_presser kroner, pengene ble trekt fra banken din.','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Vellykket du presset ut '.$sum_presser.' kr.</span></div>';
         } else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Offeret følte seg ikke truet nok til å gi deg penger.</span></div>';  
         }} else {
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk ikke en dritt ut av offeret.</span></div>';  
         }} 
         elseif($type_press_blir == '2') { 
         
         
         if($type_press_blir == $rand_svar_valgt) { 
         if($offer_info_ba['bombechips'] > '250') { 
         $rand_sum_valgt_Press = rand (50, 233);
         $offer_ny_sum_bombechips = floor($bombechips_offer_ba - $rand_sum_valgt_Press);
         $din_ny_sum_bombechips = floor($bombechips + $rand_sum_valgt_Press);
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
         $sum_presser = number_format($rand_sum_valgt_Press, 0, ",", ".");
       
         mysql_query("UPDATE brukere SET bombechips='$din_ny_sum_bombechips',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET bombechips='$offer_ny_sum_bombechips' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Presset','Kidnapperen presset deg for $sum_presser bombechips.','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Vellykket du presset ut '.$sum_presser.' bombechips.</span></div>';
         } else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk ikke en dritt ut av offeret.</span></div>';  
         }} else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk ikke en dritt ut av offeret.</span></div>';
         }
         
         
         }
         elseif($type_press_blir == '3') { 
         if($type_press_blir == $rand_svar_valgt) { 
         if($respekt_offer_ba > '250') { 
         $rand_sum_valgt_Press = rand (21, 51);
         $offer_ny_sum_respekt = floor($respekt_offer_ba - $rand_sum_valgt_Press);
         $din_ny_sum_respekt = floor($respekt + $rand_sum_valgt_Press);
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
         $sum_presser = number_format($rand_sum_valgt_Press, 0, ",", ".");
       
         mysql_query("UPDATE brukere SET respekt='$din_ny_sum_respekt',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET respekt='$offer_ny_sum_respekt' WHERE brukernavn='$offer_navn_2k'");
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$offer_navn_2k','$tiden','$tid $nbsp $dato','Presset','Kidnapperen presset deg til å gi $sum_presser respekt.','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Vellykket du presset offeret til å gi deg '.$sum_presser.' respekt.</span></div>';
         } else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk ikke en dritt ut av offeret.</span></div>';  
         }} else { 
         $ny_sum_antall_press = $antall_press_3K + '1';
         $ny_sum_ventetid_press = $tiden + '170';
       
         mysql_query("UPDATE kidnapping SET antall_press='$ny_sum_antall_press',pressings_stamp='$ny_sum_ventetid_press' WHERE kidnappers_navn='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk ikke en dritt ut av offeret.</span></div>';  
         }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke velge noe som ikke eksisterer i spillet.</span></div>'; }}}}



         
         echo "
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Informasjon</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=Kidnapping&JallaMekk=Info\">Informasjon om kidnappingen</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Slipp fri / selg</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=Kidnapping&JallaMekk=FreeWillie\">Slipp personen fri eller selg videre</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tortur</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=Kidnapping&JallaMekk=Tortur\">Torturer personen</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Voldtekt</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=Kidnapping&JallaMekk=Voldtekt\">Voldta personen</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Utpresning</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=Kidnapping&JallaMekk=GiMegPenga\">Press personen for penger / bombechips</a></span></div>
         ";
         
         $SKAL_VISE = mysql_real_escape_string($_REQUEST['JallaMekk']);

         switch ($SKAL_VISE) {
         case "Info": include "Annensider/kidder_info.php"; break;
         case "FreeWillie": include "Annensider/kidder_slippfri.php"; break;
         case "Tortur": include "Annensider/kidder_tortur.php"; break;
         case "Voldtekt": include "Annensider/kidder_voldtekt.php"; break;
         case "GiMegPenga": include "Annensider/kidder_press.php"; break;
         }
         
         echo "</div>";
         
         }}}}}
         ?>
