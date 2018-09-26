         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <?
         if (empty($brukernavn)) { header("Location: index.php"); } else {
  
         function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }

         // Henter ut informasjon
         $kidnappings_offer_du = mysql_fetch_assoc($kidnapp_sjekk_om2K);
         $dato_kidnappet_2k = $kidnappings_offer_du['dato_tatt'];
         $politiet_leter_2k = $kidnappings_offer_du['politi_starter'];
         $politi_finner_2k = $kidnappings_offer_du['politi_finner'];
         $timestampen_tatt_2k = $kidnappings_offer_du['timestampen_tatt'];
         $landet_tatt_2k = $kidnappings_offer_du['landet'];
         $kidnappers_navn_2k = $kidnappings_offer_du['kidnappers_navn'];
         $grav_ventetid_2k = $kidnappings_offer_du['grav_ventetid'];
         $grav_2k = $kidnappings_offer_du['grav'];
         $vapen_mulighet_2k = $kidnappings_offer_du['vapen_mulighet'];
         $vopen_ferdig_2k = $kidnappings_offer_du['vopen_ferdig'];
         $vopen_lagd_2k = $kidnappings_offer_du['vapen_lagd'];
         $angrip_timestamp_2k = $kidnappings_offer_du['angrip_timestamp'];
         $angrip_antall_2k = $kidnappings_offer_du['angrip'];

         $ventetid_angrip = $angrip_timestamp_2k - $tiden;
         $ventetid_vopen = $vopen_ferdig_2k - $tiden;
         $vente_sek_grav = $grav_ventetid_2k - $tiden;
         $leting_Starter_bka = $politiet_leter_2k - $tiden;
         
       
         $Kidnapper_info_heha = mysql_query("SELECT * FROM brukere WHERE brukernavn='$kidnappers_navn_2k'");
         $Kidnapper_info = mysql_fetch_assoc($Kidnapper_info_heha);
         $KiddersPenger = $Kidnapper_info['penger'];
         $KiddersKuler = $Kidnapper_info['kuler'];
         $KiddersRespekt = $Kidnapper_info['respekt'];
         $KiddersBombechips = $Kidnapper_info['bombechips'];
         $KiddersPoeng = $Kidnapper_info['turns'];

         echo "
         <div class=\"Div_masta\">
         <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">KIDNAPPING</span></div>
         <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Kidnapping.jpg\" width=\"490\" height=\"200\"></div>
         ";
         
         // Mekk våpen
         if(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Lag v') {
         if($vapen_mulighet_2k == '8' && $vopen_ferdig_2k < $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har lagd våpen alt.</span></div>'; } else {
         if($vapen_mulighet_2k == '8' && $vopen_ferdig_2k > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du er ferdig med å lage våpenet om '.$ventetid_vopen.' sekunder.</span></div>'; } else {
         if($vapen_mulighet_2k == '1') { $vapen_lages = 'Hjemmelagd kniv'; }
         if($vapen_mulighet_2k == '2') { $vapen_lages = 'Hjemmelagd balltre'; }
         if($vapen_mulighet_2k == '3') { $vapen_lages = 'Hjemmelagd sprettert'; }
         if($vapen_mulighet_2k == '4') { $vapen_lages = 'Hjemmelagd flammekaster'; }
         if($vapen_mulighet_2k == '5') { $vapen_lages = 'Hjemmelagd øks'; }
         if($vapen_mulighet_2k == '6') { $vapen_lages = 'Hjemmelagd pil og bue'; }
         $tiden_blir_ferdig2ka = $tiden + '200';
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
       
         mysql_query("UPDATE kidnapping SET vopen_ferdig='$tiden_blir_ferdig2ka',vapen_mulighet='8',vapen_lagd='$vapen_lages' WHERE offer='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har startet å mekke et våpen.</span></div>';
         }}} 
         // Stikk av
         elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Grav ut') { 
         if($grav_ventetid_2k > $tiden) { 
         echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente til det har gått '.$vente_sek_grav.' sekunder.</span></div>';
         } else {
         $ny_sum_graV = $grav_2k + '1';
         $klarer_du_stikke_av = rand (8, 20);
         if($ny_sum_graV > '14') {
         if($ny_sum_graV > $klarer_du_stikke_av) {
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
       
         mysql_query("DELETE FROM kidnapping WHERE offer='$brukernavn'") or die(mysql_error());
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Stakk av','Personen du kidnappet har klart å rømme.','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du klarte å rømme.</span></div>';
         } else { 
         $tekst_vises = array("Du så noen utenfor hullet så du krøp inn igjen", "Du så en skygge utenfor hullet å krøp derfor inn igjen", "Du så en rotte i hullet så du krøp tilbake igjen", "Det hadde akkuratt regnet så du klarte ikke å komme deg ut");
         $tekst_vises1K = $tekst_vises[array_rand($tekst_vises)];
       
         $ventetid_grac = $tiden + '120';
         mysql_query("UPDATE kidnapping SET grav_ventetid='$ventetid_grac',grav='$ny_sum_graV' WHERE offer='$brukernavn'");
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">'.$tekst_vises1K.'.</span></div>';
         }} else {
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
       
         $ventetid_grac = $tiden + '120';
         mysql_query("UPDATE kidnapping SET grav_ventetid='$ventetid_grac',grav='$ny_sum_graV' WHERE offer='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gravd hullet ditt større.</span></div>';
         }}}elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Angrip') {
         

         include "kid_prosent.php";
         $angrips_valg = mysql_real_escape_string($_POST['angrip_valg']);
         if($vapen_mulighet_2k == '8' && $vopen_ferdig_2k > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du er ferdig med å lage våpenet om '.$ventetid_vopen.' sekunder.</span></div>'; } else {
         if($vapen_mulighet_2k == '8' && $vopen_ferdig_2k < $tiden) {   
         if($angrips_valg == '1' || $angrips_valg == '2' || $angrips_valg == '3') {
         if($angrip_timestamp_2k > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente til det har gått '.$ventetid_angrip.' sekunder.</span></div>'; } else {
         $angrip_du_a_komme_los = rand (4, 8);
         $nytt_antall_bla9 = $angrip_antall_2k + '1';
         $ny_angrips_tid_bla9 = $tiden + '150';
         if($angrip_antall_2k > $angrip_du_a_komme_los) { 
         $angrip_klare_det = rand (1, 3);
         $hent_info_gjerningsmann = mysql_query("SELECT * FROM brukere WHERE brukernavn='$kidnappers_navn_2k'") or die(mysql_error());
         $hent_info_gjern = mysql_fetch_assoc($hent_info_gjerningsmann);
         $liv_gjerningsmann2 = $hent_info_gjern['liv'];
         $liv_gjerningsmann = floor($liv_gjerningsmann2);
         if($angrips_valg == $angrip_klare_det) { 
         $rand_skade = array("0.4","0.5","0.6","0.7","0.8","0.9","1","1.1","1.2","1.3");
         $rand_skade = $rand_skade[array_rand($rand_skade)];
         $ny_skade_gjerningsmann = $liv_gjerningsmann - $rand_skade;
         if ($ny_skade_gjerningsmann < '1') { 
       
         // Henter hitlist spenn og gir dem til deg.
         $sjekk_hitlista_aa = mysql_query("SELECT * FROM hitlist WHERE hitlist_offer='$kidnappers_navn_2k'");
         if (mysql_num_rows($sjekk_hitlista_aa) >= '1') { 
         $spenn_liste_hent = '0';
         while($info_hitlist22 = mysql_fetch_assoc($sjekk_hitlista_aa)) {
         $spenn_liste_hent = floor($info_hitlist22['hitlist_dusor'] + $spenn_liste_hent);
         $id_hitlisten_slett = $info_hitlist22['id'];
         mysql_query("DELETE FROM hitlist WHERE id = '$id_hitlisten_slett'") or die(mysql_error());
         }
       
         $ny_sum_spenn = $bank + $spenn_liste_hent;
         $penger_faa = number_format($spenn_liste_hent, 0, ",", ".");
         mysql_query("UPDATE brukere SET penger ='$ny_sum_spenn' WHERE brukernavn='$brukernavn'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Hitlist penger levert','Du klarte å drepe '.$kidnappers_navn_2k.' og du har nå fått '.$penger_faa.' kroner plassert i din bank.','Ja')");
         }
         $ny_rank_pros2ka = $rankpros + '2';
         $ny_rank_respekt2ka = $respekt + '2000';
         $ny_drap_sum2ka = $drap + '1';
       
       
         mysql_query("UPDATE brukere SET liv ='0',timestamp_dod='$tiden',aktiv_eller='0',dato_drept='$tid $nbsp $dato' WHERE brukernavn='$kidnappers_navn_2k'");
       
         mysql_query("INSERT INTO drepte_spillere (morder_navn, offer, timestampen, dato) VALUES ('$brukernavn','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato')");
       
         mysql_query("UPDATE brukere SET drap='$ny_drap_sum2ka',aktiv_eller='$tiden_aktiv',respekt='$ny_rank_respekt2ka',rankpros='$ny_rank_pros2ka' WHERE brukernavn='$brukernavn'");
       
         mysql_query("DELETE FROM kidnapping WHERE offer='$brukernavn'") or die(mysql_error());
         
         $Offer = $kidnappers_navn_2k;
         include "Abc_drepeauto.php";

         echo '<div class="Div_MELDING"><span class="Span_str_5">Du drepte '.$kidnappers_navn_2k.'.</span></div>'; 
         } else { 
         $ny_rank_pros2ka = $rankpros + $Kid_prosent_s;
         $ny_rank_respekt2ka = $respekt + '40';
         $tekst_vises = array("Du skadet kidnapperen, men han slo deg ned å kastet deg inn i kjelleren", "Kidnapperen ble skadet til blods men han fikk kasta deg i kjelleren", "Våpenet ditt funka fett, kidnapperen ble skadet men fikk kastet deg ned i kjelleren igjen", "Du feiga ut");
         $tekst_vises1K = $tekst_vises[array_rand($tekst_vises)];
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$ny_rank_respekt2ka',rankpros='$ny_rank_pros2ka' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET liv ='$ny_skade_gjerningsmann' WHERE brukernavn='$kidnappers_navn_2k'");
       
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Du ble skadet','Personen du har kidnappet angrep deg å skadet deg, du klarte å få kastet han ned i kjelleren igjen.','Ja')");
       
         mysql_query("UPDATE kidnapping SET angrip='$nytt_antall_bla9',angrip_timestamp='$ny_angrips_tid_bla9' WHERE offer='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_5">'.$tekst_vises1K.'.</span></div>'; 
         }} else { 
         $tekst_vises = array("Du angrep kiddnapperen med våpenet, men han slo deg ned å kastet deg inn i kjelleren", "Kidnapperen sparka deg rett før du fikk brukt våpenet på han/hun", "Våpenet ditt svikta, kidnapperen kastet deg ned i kjelleren igjen", "Du feiga ut");
         $tekst_vises1K = $tekst_vises[array_rand($tekst_vises)];
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
       
         mysql_query("UPDATE kidnapping SET angrip='$nytt_antall_bla9',angrip_timestamp='$ny_angrips_tid_bla9' WHERE offer='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_5">'.$tekst_vises1K.'.</span></div>'; 
         }} else {
         $tekst_vises = array("Du klarte ikke å komme deg fram til kidnapperen", "Du klarte ikke å samle nok krefter til å angrip kidnapperen", "Du klarte ikke å dirka opp døren", "Du feiga ut");
         $tekst_vises1K = $tekst_vises[array_rand($tekst_vises)];
       
         mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
       
         mysql_query("UPDATE kidnapping SET angrip='$nytt_antall_bla9',angrip_timestamp='$ny_angrips_tid_bla9' WHERE offer='$brukernavn'");
         echo '<div class="Div_MELDING"><span class="Span_str_5">'.$tekst_vises1K.'.</span></div>'; 
         }}} else { echo '<div class="Div_MELDING"><span class="Span_str_6">Du kan ikke velge et alternativ som ikke er en av mulighetene.</span></div>'; }
         } else { echo '<div class="Div_MELDING"><span class="Span_str_6">Du har ikke lagd våpenet ditt enda.</span></div>'; }}
         }elseif(isset($_POST['Lag_v']) && $_POST['Lag_v'] == 'Gave') {
         $GaveSum = rengjor_tall(mysql_real_escape_string($_POST['gavesum']));
         $GaveValg = rengjor_tall(mysql_real_escape_string($_POST['gave_valg']));
         if(empty($GaveSum) || empty($GaveValg)) {
         echo '<div class="Div_MELDING">';
         if(empty($GaveSum)) { echo '<span class="Span_str_6">Du har ikke skrevet inn summen du skal gi.</span>'; }
         if(empty($GaveValg)) { echo '<span class="Span_str_6">Du har ikke valgt hva du skal gi som gave.</span>'; }
         echo "</div>";
         } else { 
         $Ti_prosent = $GaveSum / '100' * '10'; $GaveSumGi = $GaveSum - $Ti_prosent;
         if($kjoonn == 'Gutt') { $tekst_22 = "Han håper på at du kan slippe han fri nå som takk for gaven du fikk av ham."; } else { $tekst_22 = "Hun håper på at du kan slippe hu fri nå som takk for gaven du fikk."; }
         $GaveSum111 = number_format($GaveSum, 0, ",", ".");
         if($GaveValg == '1') { 
         if($GaveSum > $turns) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok poeng.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($turns - $GaveSum);
         $HansNyeSum = floor($KiddersPoeng + $GaveSumGi);
         mysql_query("UPDATE brukere SET turns='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET turns='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 poeng ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' poeng ( -10% ).</span></div>';
         }}}
         elseif($GaveValg == '2') {
         if($GaveSum > $penger) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger cash.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($penger - $GaveSum);
         $HansNyeSum = floor($KiddersPenger + $GaveSumGi);
         mysql_query("UPDATE brukere SET penger='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET penger='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 kr ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' kroner ( -10% ).</span></div>';
         }}}
         elseif($GaveValg == '3') {
         if($GaveSum > $bank) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på kontoen.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($bank - $GaveSum);
         $HansNyeSum = floor($KiddersPenger + $GaveSumGi);
         mysql_query("UPDATE brukere SET bank='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET penger='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 kr ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' kroner ( -10% ).</span></div>';
         }}}
         elseif($GaveValg == '4') {
         if($GaveSum > $bombechips) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok bombechips.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($bombechips - $GaveSum);
         $HansNyeSum = floor($KiddersBombechips + $GaveSumGi);
         mysql_query("UPDATE brukere SET bombechips='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET bombechips='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 bombechips ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' bombechips ( -10% ).</span></div>';
         }}}
         elseif($GaveValg == '5') {
         if($GaveSum > $respekt) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok respekt.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($respekt - $GaveSum);
         $HansNyeSum = floor($KiddersRespekt + $GaveSumGi);
         mysql_query("UPDATE brukere SET respekt='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET respekt='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 respekt ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' respekt ( -10% ).</span></div>';
         }}}
         elseif($GaveValg == '6') {
         if($GaveSum > $kuler) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok kuler.</span></div>'; } else { 
         if(strlen($GaveSum) > '10') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gi så stor gave på en gang.</span></div>'; } else {
         $DinNyeSum = floor($kuler - $GaveSum);
         $HansNyeSum = floor($KiddersKuler + $GaveSumGi);
         if($HansNyeSum > '10000000') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan desverre ikke gi kidnapperen kuler nå.</span></div>'; } else {
         mysql_query("UPDATE brukere SET kuler='$DinNyeSum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET kuler='$HansNyeSum' WHERE brukernavn='$kidnappers_navn_2k'");
       
         $melding = "$brukernavn som du har kidnappet har gitt deg $GaveSum111 kuler ( -10% ). $tekst_22";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kidnappers_navn_2k','$tiden','$tid $nbsp $dato','Kidnappings gave','$melding','Ja')");
         echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gitt kidnapperen en gave på '.$GaveSum111.' kuler ( -10% ).</span></div>';
         }}}}}}

         
         
         echo "
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Informasjon</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=kidnappet&JallaMekk=Info\">Informasjon om kidnappingen</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Stikk av</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=kidnappet&JallaMekk=StikkAv\">Du kan forsøke å rømme fra kidnappingen</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Lag våpen</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=kidnappet&JallaMekk=LagVopen\">Lag våpen av gjennstander rundt deg</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gi gaver</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=kidnappet&JallaMekk=GiGave\">Gi kidnapperen gaver ihåp om at han slipper deg fri</a></span></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Angrip</span></div>
         <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a href=\"game.php?side=kidnappet&JallaMekk=Angrip\">Angrip kidnapperen, skad kisen</a></span></div>
         ";
         
         $SKAL_VISE = mysql_real_escape_string($_REQUEST['JallaMekk']);

         switch ($SKAL_VISE) {
         case "Info": include "Annensider/offer_info.php"; break;
         case "StikkAv": include "Annensider/offer_stikkav.php"; break;
         case "LagVopen": include "Annensider/offer_lagvopen.php"; break;
         case "GiGave": include "Annensider/offer_gigave.php"; break;
         case "Angrip": include "Annensider/offer_angrip.php"; break;

         }
         
         
         echo "</div>";
         
         }
         ?>
