         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
         if (empty($brukernavn)) { header("Location: index.php"); } else {
 
       
         $kidnapp_sjekk_om2Kb = mysql_query("SELECT * FROM kidnapping WHERE kidnappers_navn='$brukernavn'");
         if (mysql_num_rows($kidnapp_sjekk_om2Kb) > '0') { include "du_er_kidnapper.php"; } else {
 
       
         $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
         if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { include "du_er_offer.php"; } else {
 
         // Sjekk sykehus
       
         $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
         if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=sykehuset"); } else { 
 
         // sjekker om du sitter i bunker
       
         $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
         if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {
 
       
         $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
         if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=fengsel"); } else {
         
         function rengjor_tall($tall){ $tall = preg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
         function calc_tid($sek) {if ($sek < 1) { return "0 sek"; } else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}

         
         echo "
         <div class=\"Div_masta\">
         <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">KIDNAPPING</span><form method=\"post\" id=\"kid\"><input type=\"hidden\" name=\"actionman\" id=\"id_ha\" /><input type=\"hidden\" name=\"action\" id=\"du_valgte\" /></div>
         <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Kidnapping.jpg\" width=\"490\" height=\"200\"></div>
         ";

         $time_vente = $kidnapping_stamp - $tiden;


         if ($rank_niva < '7') {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke høy nok rank til å bruke denne funksjonen.</span></div>"; 
         } else { 
         if($kidnapping_stamp > $tiden) { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du må vente ".$time_vente." sekunder før du kan bruke kidnappings funksjonen igjen.</span></div>"; 
         } else { 
         
         if (isset($_POST['action']) && $_POST['action'] == "kjop") { 
         $bruker_id = rengjor_tall(mysql_real_escape_string($_POST['actionman']));
         if(empty($bruker_id)) {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har valgt et ugyldig valg.</span></div>"; 
         } else { 
         $bruker_id = $bruker_id / '2473';
       
         $SJEKK_SALG = mysql_query("SELECT * FROM kidnapping WHERE Selges_ell='1' AND stamp_selg_start > $tiden AND id='$bruker_id'");
         if (mysql_num_rows($SJEKK_SALG) >= '1') {
         if($type == 'dd' || $type == 'm') { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke lov til å kjøpe spillere.</span></div>"; 
         } else { 

         $info_kid_2a = mysql_fetch_assoc($SJEKK_SALG);
         $selgers_navn_eid2 = $info_kid_2a['kidnappers_navn'];
         $selgers_pris_eid2 = $info_kid_2a['selges_for'];
         $selgers_land_eid2 = $info_kid_2a['landet'];
         $selgers_politi_eid2 = $info_kid_2a['politi_finner'];
         $selgers_offer_eid2 = $info_kid_2a['offer'];
 
         if($land != $selgers_land_eid2) { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du må være i samme by som salget.</span></div>"; } else {
         if($penger < $selgers_pris_eid2) { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke nok penger på hånda.</span></div>"; } else { 
 
         $tiden_ranD = rand (500, 1500);
         $rand_ny_tid = $selgers_politi_eid2 + $tiden_ranD;
         $ventetid_selge_igjen = $tiden + '2000';

         $din_nye_sum_spenn = floor($penger - $selgers_pris_eid2);
         $Ti_prosent = $selgers_pris_eid2 / '100' * '10'; 
         $SUM_EIER_FA = $selgers_pris_eid2 - $Ti_prosent;

       
         mysql_query("UPDATE kidnapping SET kidnappers_navn='$brukernavn',anonymt_ell='0',selges_for='0',dato_selg_start='',stamp_selg_start='0',Selges_ell='0',politi_finner='$rand_ny_tid',TORTUR_STAMP='0',Voldtekt_stamp='0',pressings_stamp='0',kidnapp_selg_videre='$ventetid_selge_igjen' WHERE id='$bruker_id'");
       
         mysql_query("UPDATE brukere SET penger='$din_nye_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
         mysql_query("UPDATE brukere SET `bank`=`bank`+$SUM_EIER_FA WHERE brukernavn='$selgers_navn_eid2'");
       
         $melding_l = "Du solgte $selgers_offer_eid2 til en medspiller for ".number_format($selgers_pris_eid2, 0, ",", ".")." kroner - (10%), pengene er plassert på din bank-konto nå.";
         $melding_2 = "Du har blitt solgt til en annen spiller i spillet.";
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$selgers_navn_eid2','$tiden','$tid $nbsp $dato','Kidnappings salgs','$melding_l','Ja')");
         mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$selgers_offer_eid2','$tiden','$tid $nbsp $dato','Solgt videre','$melding_2','Ja')");
         header("Location: game.php?side=Kidnapping");
         }}}} else {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Dette salget eksisterer desverre ikke.</span></div>"; 
         }}}elseif(isset($_POST['action']) && $_POST['action'] == "kidnapp") {
         $brukernavn_kid = mysql_real_escape_string($_POST['brukernavn']);
         $bil_kid = rengjor_tall(mysql_real_escape_string($_POST['bil_valgt']));
         $bil_kid = $bil_kid - '421';
         if($type == 'A' || $type == 'm') { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har desverre ikke lov til å kidnappe spillere.</span></div>"; 
         } else { 
         if(date("H") == '16' || date("H") == '19' || date("H") == '22') { 
         if(empty($_POST['brukernavn']) || empty($_POST['bil_valgt'])) { 
         echo "<div class=\"Div_MELDING\">"; 
         if(empty($_POST['brukernavn'])) { echo "<span class=\"Span_str_5\">Du har glemt å skrive inn et brukernavn.</span>";  }
         if(empty($_POST['bil_valgt'])) { echo "<span class=\"Span_str_5\">Du har glemt å velge en bil.</span>"; }
         echo "</div>"; 
         } else { 
       
         $sjekk_om_du_har_kid = mysql_query("SELECT * FROM kidnapping WHERE kidnappers_navn='$brukernavn'");
         if (mysql_num_rows($sjekk_om_du_har_kid) >= '1') {  
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan kun ha en spiler om gangen og du har alt en.</span></div>"; 
         } else { 
         if($kidnapping_stamp > $tiden) {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du må vente noen sekunder før du kan kidnappe igjen.</span></div>"; 
         } else { 
       
         $sjekk_bruker2k = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavn_kid'");
         if (mysql_num_rows($sjekk_bruker2k) == 0) {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Det eksisterer ingen brukere med dette brukernavnet.</span></div>"; 
         } else {
         $kid_info = mysql_fetch_assoc($sjekk_bruker2k);
         $kid_brukernavn = $kid_info['brukernavn'];
         $kid_rank_niva = $kid_info['rank_nivaa'];
         $kid_respekt = $kid_info['respekt'];
         $kid_land = $kid_info['land'];
         $kid_antall_kid = $kid_info['kid_antall'];
         $kid_liv = $kid_info['liv'];
         $kid_type = $kid_info['type'];
         $kid_regtid = $kid_info['regtid_stamp'];
         $kid_imun = $kid_regtid + '300000';

         $KanKidde = $regtid_stamp_din + '300000';
         $Tid_igjen = $KanKidde - $tiden;

         if($KanKidde > $tiden && $rank_niva < '7') {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke kidnappe før $Tid_igjen sekunder er omme.</span></div>"; 
         } else {
         if($kid_imun > $tiden && $kid_rank_niva < '7') {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Denne spilleren har nylig blitt registrert og har derfor muligheten til å være imun i noen dager.</span></div>"; 
         } else {
         if($kid_type == 'A' || $kid_type == 'm' || $kid_type == 'b') { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke kidnappe administratorer/moderatorer eller botter.</span></div>";          
         } else { 
         if($kid_liv < '1') {
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke kidnappe en død spiller.</span></div>";          
         } else { 
         if($brukernavn == $kid_brukernavn) { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke kidnappe deg selv.</span></div>";          
         } else { 
       
         $sjekk_bil2ka = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND land='$land' AND id='$bil_kid' AND TransportEll < '$tiden' AND skade='0'");
         if (mysql_num_rows($sjekk_bil2ka) == 0) { 
         echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har desverre ingen biler med null skade i denne byen.</span></div>";          
         } else { 
         $bil_info_tba = mysql_fetch_assoc($sjekk_bil2ka);
         $KIDNAPPER_Bil = $bil_info_tba['bilmerke'];
         
       
         $kidnapp_sjekk_om2Kkk = mysql_query("SELECT * FROM kidnapping WHERE offer='$kid_brukernavn'");
         if (mysql_num_rows($kidnapp_sjekk_om2Kkk) > '0') { include "feiler_kidnapp_kidfrafor.php"; } else {
 
       
         $fengsel_sjekk_om_KID = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$kid_brukernavn' AND timestamp_over > $tiden");
         if (mysql_num_rows($fengsel_sjekk_om_KID) > '0') { include "feiler_kidnapp_feng.php"; } else { 
 
       
         $bunker_ell_KID = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$kid_brukernavn' AND godtatt_elle='1' AND timestamp_ute > $tiden");
         if (mysql_num_rows($bunker_ell_KID) >= '1') { include "feiler_kidnapp_bunk.php"; } else {
         
         if($land != $kid_land) { include "feiler_kidnapp_land.php"; } else {

         $Din_V_styrke = '0';
         $Offer_V_styrke = '0';
         $Offer_V_styrke_2 = '0';
        
         // Dine våpen styrke
       
         $Hent_vopen_dine = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND forbruk_nr >= '1'");
         if (mysql_num_rows($Hent_vopen_dine) == '0') { $pluss_1 = '0'; } else {
         while($vopen_1_row = mysql_fetch_assoc($Hent_vopen_dine)) { 
         if($vopen_1_row['utstyr'] == 'Hammer') { $pluss_1 = '100'; } 
         elseif($vopen_1_row['utstyr'] == 'Balltre') { $pluss_1 = '200'; }
         elseif($vopen_1_row['utstyr'] == 'Knokejern') { $pluss_1 = '300'; }
         elseif($vopen_1_row['utstyr'] == 'Kniv') { $pluss_1 = '400'; }
         elseif($vopen_1_row['utstyr'] == 'Glock 17') { $pluss_1 = '500'; }
         elseif($vopen_1_row['utstyr'] == 'Desert Eagle') { $pluss_1 = '600'; }
         elseif($vopen_1_row['utstyr'] == 'Uzi smg') { $pluss_1 = '700'; }
         elseif($vopen_1_row['utstyr'] == 'Ak-47') { $pluss_1 = '800'; }
         elseif($vopen_1_row['utstyr'] == 'Steyr aug a1') { $pluss_1 = '900'; }
         elseif($vopen_1_row['utstyr'] == 'SOPMOD M4') { $pluss_1 = '1900'; }
         $Din_V_styrke = $Din_V_styrke + $pluss_1;
         }}

         // Offer våpen styrke
         $Hent_vopen_offer = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$kid_brukernavn' AND type='1' AND forbruk_nr >= '1'");
         if (mysql_num_rows($Hent_vopen_offer) == '0') { $pluss_11 = '0'; } else {
         while($vopen_2_row = mysql_fetch_assoc($Hent_vopen_offer)) { 
         if($vopen_2_row['utstyr'] == 'Hammer') { $pluss_11 = '100'; } 
         elseif($vopen_2_row['utstyr'] == 'Balltre') { $pluss_11 = '200'; }
         elseif($vopen_2_row['utstyr'] == 'Knokejern') { $pluss_11 = '300'; }
         elseif($vopen_2_row['utstyr'] == 'Kniv') { $pluss_11 = '400'; }
         elseif($vopen_2_row['utstyr'] == 'Glock 17') { $pluss_11 = '500'; }
         elseif($vopen_2_row['utstyr'] == 'Desert Eagle') { $pluss_11 = '600'; }
         elseif($vopen_2_row['utstyr'] == 'Uzi smg') { $pluss_11 = '700'; }
         elseif($vopen_2_row['utstyr'] == 'Ak-47') { $pluss_11 = '800'; }
         elseif($vopen_2_row['utstyr'] == 'Steyr aug a1') { $pluss_11 = '900'; }
         elseif($vopen_2_row['utstyr'] == 'SOPMOD M4') { $pluss_11 = '1900'; }
         $Offer_V_styrke = $Offer_V_styrke + $pluss_11;
         }}
         
         // Offer beskytelse styrke
         $Hent_besk_offer = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$kid_brukernavn' AND type='2' AND forbruk_nr >= '1'");
         if (mysql_num_rows($Hent_besk_offer) == '0') { $pluss_22 = '0'; } else {
         while($besk_2_row = mysql_fetch_assoc($Hent_besk_offer)) { 
         if($besk_2_row['utstyr'] == 'Finnlandshette') { $pluss_22 = '100'; } 
         elseif($besk_2_row['utstyr'] == 'Hund') { $pluss_22 = '200'; }
         elseif($besk_2_row['utstyr'] == 'Skuddsikker vest') { $pluss_22 = '300'; }
         elseif($besk_2_row['utstyr'] == 'Livvakt') { $pluss_22 = '400'; }
         elseif($besk_2_row['utstyr'] == 'Secret Service') { $pluss_22 = '1400'; }
         $Offer_V_styrke_2 = $Offer_V_styrke_2 + $pluss_22;
         }}
         
         // Styrke offer
         $Offer_V_styrke = $Offer_V_styrke * '5.42';
         $Offer_V_styrke_2 = $Offer_V_styrke_2 * '3.45';
         $Offer_V_styrke = $Offer_V_styrke + $Offer_V_styrke_2;
         $Offer_sjangs_kid = $kid_rank_niva + $kid_antall_kid + $Offer_V_styrke + $kid_respekt;

         // Styrke deg
         $Din_V_styrke = $Din_V_styrke * '5.42';
         $Din_sjangs_kid = $rank_niva + $kidnapping_antall + $Din_V_styrke + $respekt;

         if($Din_sjangs_kid >= $Offer_sjangs_kid) { 
         
         if(!empty($gjeng) && !empty($kid_info['gjeng']) && $gjeng != $kid_info['gjeng']) { 
       
         mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'1.4' WHERE Gjeng_Navn='$gjeng'"); 
         mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'1.4' WHERE brukernavn='$brukernavn'"); 
         }
         
         include "vellykket_kidnapping.php"; } else { include "feiler_kidnapp_mulig_skade.php"; }
         
         }}}}}}}}}}}} 
         
         
         } 
         
         
         }}}}
         
         
         if(date("H") == '16' || date("H") == '19' || date("H") == '22') {
         } else {
         echo '
         <div class="Div_MELDING"><span class="Span_str_5">Kidnapping er åpent mellom 16:00 - 17:00, 19:00 - 20:00 og 22:00 - 23:00.</span></div>';
         }

         echo "
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
         <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"brukernavn\" value=\"\" maxlength=\"25\"></div>
         <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Fluktbil</span></div>
         <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"bil_valgt\" size=\"1\">
         ";
        
       
         $Hent_biler_by = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND land='$land' AND TransportEll < '$tiden' AND skade='0'");
         if (mysql_num_rows($Hent_biler_by) == 0) { echo '<option>Du har desverre ingen biler med null skade i denne byen</option>'; } else { 
         $id_teller = '1';
         while ($bilinfo_by = mysql_fetch_assoc($Hent_biler_by)) { 
         $fake_bil_id = $bilinfo_by['id'] + '421';
         $hk_blir2 = substr($bilinfo_by['hestekrefter'], 0, 1);
         if($hk_blir2 == '0') { $hk_blir = substr($bilinfo_by['hestekrefter'], 1); } else { $hk_blir = $bilinfo_by['hestekrefter']; }
         echo $hk_blir2;
         echo '<option value="'.$fake_bil_id.'">'.$id_teller++.' Bilmerke: '.$bilinfo_by['bilmerke'].' Hestekrefter: '.$hk_blir.'</option>'; 
         }}
        
         echo "
         </select></div>
         <div class=\"Div_venstre_side_1\">&nbsp;</div>
         <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('du_valgte').value='kidnapp';document.getElementById('kid').submit()\"><p class=\"pan_str_2\">KIDNAPP</p></div>
         ";
         
         }
         
         echo "
         <div class=\"Div_mellomledd\">&nbsp;</div>
         <div class=\"Div_innledning\"><span class=\"Span_str_2\">PERSONER TIL SALGS</span></div>
         ";
         
       
         $SALG = mysql_query("SELECT * FROM kidnapping WHERE Selges_ell='1' AND stamp_selg_start > $tiden ORDER BY `stamp_selg_start` DESC");
         if (mysql_num_rows($SALG) >= '1') {
         while($SALG_INFO = mysql_fetch_assoc($SALG)) { 
         
         if($SALG_INFO['anonymt_ell'] == '1') { $SelgersNavn = '<a href="game.php?side=Bruker&navn='.urlencode($SALG_INFO['kidnappers_navn']).'">'.htmlspecialchars($SALG_INFO['kidnappers_navn']).'</a>'; } else { $SelgersNavn = 'Anonym spiller'; }
         
         $FuckaId = $SALG_INFO['id'] * '2473';
         
         $tiden_starta = $tiden - $SALG_INFO['stamp_selg_start'];
         
         echo "
         <div class=\"Div_Porno_0\">
         <span class=\"Span_str_8\">
         <b>Offer:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($SALG_INFO['offer'])."\">".htmlspecialchars($SALG_INFO['offer'])."</a><br>
         <b>Plassert:</b> ".htmlspecialchars($SALG_INFO['landet'])."<br>
         <b>Selges for:</b> ".number_format($SALG_INFO['selges_for'], 0, ",", ".")." kroner<br>
         <b>Selger:</b> ".$SelgersNavn."<br>
         <span style=\"float:right;\"><b><a onclick=\"document.getElementById('id_ha').value='$FuckaId';document.getElementById('du_valgte').value='kjop';document.getElementById('kid').submit()\">KJØP</a></b></span>
         </span><br>
         </div>";
         
         }} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Det ligger ingen ute tilsalgs.</span></div>'; }
         

         
         
         }
         

         
         
         
         echo "</div></form>";
         }}}}}}
         ?>
        
