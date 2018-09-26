        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {

        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=Hitlist&s=0"); }}

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta"><form method="post" id="hitlist">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">HITLIST EN MEDSPILLER</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/hitlist.jpg" width="490" height="200"></div>
        <?
        if (isset($_POST['brukernavn'])) {
        $brukernavn_hitlist = mysql_real_escape_string($_POST['brukernavn']);
        $sum_hitlist = mysql_real_escape_string($_POST['beloop']);
        $pay_type_hitlist = mysql_real_escape_string($_POST['betalingstype']);
        $sikkerhet_hitlist = mysql_real_escape_string($_POST['sikkerhet']);
        $tidslengde_hitlist = mysql_real_escape_string($_POST['tidslengde']);
        $anonymitet_hitlist = mysql_real_escape_string($_POST['anonymitet']);
       
        $brukernavn_hitlist = htmlspecialchars($brukernavn_hitlist);
        $sum_hitlist = htmlspecialchars($sum_hitlist);
        $pay_type_hitlist = htmlspecialchars($pay_type_hitlist);
        $sikkerhet_hitlist = htmlspecialchars($sikkerhet_hitlist);
        $tidslengde_hitlist = htmlspecialchars($tidslengde_hitlist);
        $anonymitet_hitlist = htmlspecialchars($anonymitet_hitlist);


        if(empty($_POST['brukernavn']) || empty($_POST['beloop']) || empty($_POST['betalingstype']) || empty($_POST['sikkerhet']) || empty($_POST['tidslengde']) || empty($_POST['anonymitet'])) {
        echo '<div class="Div_MELDING">';
        if(empty($_POST['brukernavn'])) { echo '<span class="Span_str_5">Du har glemt å skrive et brukernavn.</span>'; }
        if(empty($_POST['beloop'])) { echo '<span class="Span_str_5">Du har glemt å skrive beløpet.</span>'; } 
        if(empty($_POST['betalingstype'])) { echo '<span class="Span_str_5">Du har ikke valgt om du skal betale med penger eller poeng.</span>'; } 
        if(empty($_POST['sikkerhet'])) { echo '<span class="Span_str_5">Du har ikke valgt om spilleren kan bli kjøpt ut eller ikke.</span>'; } 
        if(empty($_POST['tidslengde'])) { echo '<span class="Span_str_5">Du har glemt å velge en tidslengde.</span>'; } 
        if(empty($_POST['anonymitet'])) { echo '<span class="Span_str_5">Du har ikke valgt om det skal være anonymt eller ikke.</span>'; } 
        echo '</div>';
        } else { 
        
        if($type == 'm' || $type == 'm') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke lov til å hitliste noen.</span>'; 
        echo '</div>';
        } else { 
      
        $sjekk_bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavn_hitlist'");
        if (mysql_num_rows($sjekk_bruker) == '0') { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Det eksisterer ingen brukere med dette brukernavnet.</span>'; 
        echo '</div>';
        } else {
        $row2 = mysql_fetch_assoc($sjekk_bruker);
        $brukernavn_hitlist = $row2['brukernavn'];
        $aktivert_ell = $row2['aktivert'];
        $liv_er = $row2['liv'];
        $Sex_er = $row2['Kjon'];
        $type_er = $row2['type'];
        if($Sex_er == 'Gutt') { $tekst_hehe = 'han'; } else { $tekst_hehe = 'hun'; }
        if($brukernavn_hitlist == $brukernavn) { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste deg selv.</span>'; 
        echo '</div>';
        } else {
        if($aktivert_ell == '0') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en bruker som ikke er aktivert.</span>'; 
        echo '</div>';
        } else { 
        if($liv_er < '1') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en død spiller.</span>'; 
        echo '</div>';
        } else { 
        if($type_er == 'm' || $type_er == 'm') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en administrator eller moderator.</span>'; 
        echo '</div>';
        } else {
        $sum_hitlist = ereg_replace("[^0-9]", "", $sum_hitlist);
        $sum_hitlist = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$sum_hitlist);
        if(is_numeric($sum_hitlist)) { 
        if($pay_type_hitlist == 'Penger' || $pay_type_hitlist == 'Poeng') { 
        if($pay_type_hitlist == 'Penger') { 
        
        
        // Bruker penger
        if($sum_hitlist < '10000000') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en for mindre en 10 millioner kroner.</span>'; 
        echo '</div>';
        } else { 
        if($sum_hitlist > '3000000000') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en for mer en 3 milliarder kroner.</span>'; 
        echo '</div>';
        } else {
        if($sum_hitlist > $penger) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke nok penger på hånda.</span>'; 
        echo '</div>';
        } else { 
        if($sikkerhet_hitlist == '1' || $sikkerhet_hitlist == '2') {
        if($sikkerhet_hitlist == '1') { $sikkerhet_trekk = '0'; }
        if($sikkerhet_hitlist == '2') { $sikkerhet_trekk = '1.9'; }
        if($tidslengde_hitlist == '2' || $tidslengde_hitlist == '4' || $tidslengde_hitlist == '6' || $tidslengde_hitlist == '8') {
        if($tidslengde_hitlist == '2') { $timestamp_pluss_ute = '259200'; $timestamp_trekk = '2.4'; }
        if($tidslengde_hitlist == '4') { $timestamp_pluss_ute = '518400'; $timestamp_trekk = '3.5'; }
        if($tidslengde_hitlist == '6') { $timestamp_pluss_ute = '777600'; $timestamp_trekk = '4.6'; }
        if($tidslengde_hitlist == '8') { $timestamp_pluss_ute = '1036800'; $timestamp_trekk = '5.7'; }
        if($anonymitet_hitlist == '1' || $anonymitet_hitlist == '2') { 
        if($anonymitet_hitlist == '1') { $anon_trekk = '0'; }
        if($anonymitet_hitlist == '2') { $anon_trekk = '1'; }
        
        // Slutt varriabler
        $timestamp_dusor_end = $tiden + $timestamp_pluss_ute;
        $prosent_dusor_trekk = $sikkerhet_trekk + $timestamp_trekk + $anon_trekk;
        $minus_sum = $sum_hitlist / '100' * $prosent_dusor_trekk;
        $dusoren_blir = $sum_hitlist - $minus_sum;
        
        // Din nye pengesum
        $ny_sum_spenn = $penger - $sum_hitlist;
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("INSERT INTO hitlist (hitlist_offer, hitlisters_navn, hitlist_dusor, anonymt, timestampen, timestampen_over, sikkerhet, betalings_typen, dato) VALUES ('$brukernavn_hitlist','$brukernavn','$dusoren_blir','$anonymitet_hitlist','$tiden','$timestamp_dusor_end','$sikkerhet_hitlist','$pay_type_hitlist','$tid $nbsp $dato')");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_hitlist','$tiden','$tid $nbsp $dato','Hitlist','En medspiller har plassert deg på hitlisten.','Ja')");
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_6">Du har hitlistet '.$brukernavn_hitlist.', dusøren er satt til '.number_format($dusoren_blir, 0, ",", ".").' kr av totalsummen som var '.number_format($sum_hitlist, 0, ",", ".").' kr.</span>';
        echo '</div>';
        
        
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun velge mellom anonymt og ikke anonymt.</span>'; 
        echo '</div>';
        }
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun velge mellom de tidslengdene vi tilbyr.</span>'; 
        echo '</div>';
        }
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun bruke den sikkerheten vi tilbyr.</span>'; 
        echo '</div>';
        }
        }}}
        // Bruker penger

        
        } else {
        
        
        // Bruker poeng
        if($sum_hitlist < '500') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en for mindre en 500 poeng.</span>'; 
        echo '</div>';
        } else { 
        if($sum_hitlist > '5000') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan ikke hitliste en for mer en 5 tusen poeng.</span>'; 
        echo '</div>';
        } else {
        if($sum_hitlist > $turns) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke nok poeng.</span>'; 
        echo '</div>';
        } else {
        if($sikkerhet_hitlist == '1' || $sikkerhet_hitlist == '2') {
        if($sikkerhet_hitlist == '1') { $sikkerhet_trekk = '0'; }
        if($sikkerhet_hitlist == '2') { $sikkerhet_trekk = '1.9'; }
        if($tidslengde_hitlist == '2' || $tidslengde_hitlist == '4' || $tidslengde_hitlist == '6' || $tidslengde_hitlist == '8') {
        if($tidslengde_hitlist == '2') { $timestamp_pluss_ute = '259200'; $timestamp_trekk = '2.4'; }
        if($tidslengde_hitlist == '4') { $timestamp_pluss_ute = '518400'; $timestamp_trekk = '3.5'; }
        if($tidslengde_hitlist == '6') { $timestamp_pluss_ute = '777600'; $timestamp_trekk = '4.6'; }
        if($tidslengde_hitlist == '8') { $timestamp_pluss_ute = '1036800'; $timestamp_trekk = '5.7'; }
        if($anonymitet_hitlist == '1' || $anonymitet_hitlist == '2') { 
        if($anonymitet_hitlist == '1') { $anon_trekk = '0'; }
        if($anonymitet_hitlist == '2') { $anon_trekk = '1'; }
        
        // Slutt varriabler
        $timestamp_dusor_end = $tiden + $timestamp_pluss_ute;
        $prosent_dusor_trekk = $sikkerhet_trekk + $timestamp_trekk + $anon_trekk;
        $minus_sum = $sum_hitlist / '100' * $prosent_dusor_trekk;
        $dusoren_blir = $sum_hitlist - $minus_sum;
        
        // Din nye pengesum
        $ny_sum_spenn = $turns - $sum_hitlist;
      
        mysql_query("UPDATE brukere SET turns='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("INSERT INTO hitlist (hitlist_offer, hitlisters_navn, hitlist_dusor, anonymt, timestampen, timestampen_over, sikkerhet, betalings_typen, dato) VALUES ('$brukernavn_hitlist','$brukernavn','$dusoren_blir','$anonymitet_hitlist','$tiden','$timestamp_dusor_end','$sikkerhet_hitlist','$pay_type_hitlist','$tid $nbsp $dato')");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_hitlist','$tiden','$tid $nbsp $dato','Hitlist','En medspiller har plassert deg på hitlisten.','Ja')");
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_6">Du har hitlistet '.$brukernavn_hitlist.', dusøren er satt til '.number_format($dusoren_blir, 0, ",", ".").' poeng av totalsummen som var '.number_format($sum_hitlist, 0, ",", ".").' poeng.</span>';
        echo '</div>';
        
        
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun velge mellom anonymt og ikke anonymt.</span>'; 
        echo '</div>';
        }
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun velge mellom de tidslengdene vi tilbyr.</span>'; 
        echo '</div>';
        }
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun bruke den sikkerheten vi tilbyr.</span>'; 
        echo '</div>';
        }
        }}}
        // Bruker poeng

        
        
        
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun bruke poeng eller penger som betalings type.</span>'; 
        echo '</div>';
        }} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du kan kun bruke tall i hitlist summen.</span>'; 
        echo '</div>'; }
        }}}}}}}}
        
        
        // Kjøp ut av hitlist
        if(isset($_POST['Valg_66'])) {
        if(empty($_POST['Valg_66'])) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Valget inneholder ikke en id, vennligst ikke prøv å endre html formen.</span>';
        echo '</div>'; 
        } else {
        $kjop_ut_id = mysql_real_escape_string($_POST['Valg_66']);
        $kjop_ut_id = ereg_replace("[^0-9]", "", $kjop_ut_id);
        $kjop_ut_id = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$kjop_ut_id);
        if(is_numeric($kjop_ut_id)) {
        $ekte_id = $kjop_ut_id / '43';

        $sjekk_id_kjoput = mysql_query("SELECT * FROM hitlist WHERE id='$ekte_id' AND timestampen_over > $tiden");
        if (mysql_num_rows($sjekk_id_kjoput) > '0') {
        
        $info_om_HITLIST = mysql_fetch_assoc($sjekk_id_kjoput);
        $hitlist_offer_TBA = $info_om_HITLIST['hitlist_offer'];
        $hitlist_dusor_TBA = $info_om_HITLIST['hitlist_dusor'];
        $sikkerhet_TBA = $info_om_HITLIST['sikkerhet'];
        $betalings_typen_TBA = $info_om_HITLIST['betalings_typen'];
        if($sikkerhet_TBA == '2') {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Personen som har hitlistet '.$hitlist_offer_TBA.' har betalt ekstra for at det ikke skal gå an og kjøpe ut personen.</span>';
        echo '</div>'; 
        } else { 
        if($brukernavn == $hitlist_offer_TBA) { $kjop_ut_pris_blir = $hitlist_dusor_TBA * '2'; } else { $femti_prosent = $hitlist_dusor_TBA / '2'; $kjop_ut_pris_blir = $hitlist_dusor_TBA + $femti_prosent; }
        
        if($betalings_typen_TBA == 'Penger') { 
        if($kjop_ut_pris_blir > $penger) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke nok penger på hånda.</span>';
        echo '</div>'; 
        } else {
        $ny_sum_dine_spenn = $penger - $kjop_ut_pris_blir;

        if($brukernavn != $hitlist_offer_TBA) { 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$hitlist_offer_TBA','$tiden','$tid $nbsp $dato','Hitlist','$brukernavn kjøpte deg ut av hitlisten.','Ja')");
        } 
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_dine_spenn' WHERE brukernavn='$brukernavn'");
        mysql_query("DELETE FROM hitlist WHERE id ='$ekte_id'") or die(mysql_error());
        if($brukernavn == $hitlist_offer_TBA) { 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt ut deg selv for '.number_format($kjop_ut_pris_blir, 0, ",", ".").' kroner.</span></div>';
        } else {
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt ut '.$hitlist_offer_TBA.' for '.number_format($kjop_ut_pris_blir, 0, ",", ".").' kroner.</span></div>';
        }}} else { 
        if($kjop_ut_pris_blir > $turns) {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har ikke nok poeng.</span>';
        echo '</div>'; 
        } else {
        $ny_sum_dine_turns = $turns - $kjop_ut_pris_blir;
        if($brukernavn != $hitlist_offer_TBA) { 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$hitlist_offer_TBA','$tiden','$tid $nbsp $dato','Hitlist','$brukernavn kjøpte deg ut av hitlisten.','Ja')");
        }
      
        mysql_query("UPDATE brukere SET turns='$ny_sum_dine_turns' WHERE brukernavn='$brukernavn'");
        mysql_query("DELETE FROM hitlist WHERE id ='$ekte_id'") or die(mysql_error());
        if($brukernavn == $hitlist_offer_TBA) { 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt ut deg selv for '.number_format($kjop_ut_pris_blir, 0, ",", ".").' poeng.</span></div>';
        } else {
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt ut '.$hitlist_offer_TBA.' for '.number_format($kjop_ut_pris_blir, 0, ",", ".").' poeng.</span></div>';
        }}}}} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Personen ligger ikke lengere på hitlisten.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Iden kan kun inneholde siffer.</span>';
        echo '</div>'; 
        }}}

        ?>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Brukernavn</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="brukernavn" maxlength="20" value=""></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Beløp</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="beloop" maxlength="10"  value="" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Velg betaling</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="betalingstype"><option>Penger</option><option>Poeng</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Sikkerhet</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="sikkerhet"><option value="1">Kan kjøpes ut ( Ingen trekk )</option><option value="2">Kan ikke kjøpes ut ( 1.9 prosent trekkes fra dusøren )</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Tidslengde</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="tidslengde"><option value="2">2 Dager ( 2.4 prosent trekkes fra dusøren )</option><option value="4">4 Dager ( 3.5 prosent trekkes fra dusøren )</option><option value="6">6 Dager ( 4.6 prosent trekkes fra dusøren )</option><option value="8">8 Dager ( 5.7 prosent trekkes fra dusøren )</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Anonym ?</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="anonymitet"><option value="1">Ikke anonymt ( Ingen trekk )</option><option value="2">Anonymt ( 1 prosent trekkes fra dusøren )</option></select></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('hitlist').submit()"><p class="pan_str_2">HITLIST SPILLER</p></div>
        <div class="Div_mellomledd ">&nbsp;</div></form>
        <div class="Div_innledning "><span class="Span_str_2">HITLIST</span><form method="post" id="kjop_ut"></div>
        <div class="Div_top_1"><span class="Span_str_1">Offer</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Hitlistet av</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Dusør</span></div>
        <div class="Div_top_2"><span class="Span_str_1">Merk</span></div>
        <?
      
        $ihehe = '0';
        $hitlist_info_hent = mysql_query("SELECT * FROM hitlist WHERE id LIKE '%' AND timestampen_over > '$tiden' ORDER BY `timestampen` DESC LIMIT $antall, 20");
        if (mysql_num_rows($hitlist_info_hent) == 0) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ingen som er hitlistet i dette øyeblikket.</span></div>';
        } else {
        while ($row = mysql_fetch_assoc($hitlist_info_hent)) { 
        $ihehe++;
        if($ihehe == '1') { $sjekka = 'checked'; } else { $sjekka = ''; }
        $fake_id = $row['id'] * '43';
        if($row['anonymt'] == '1') { $hitlistet_av_aak = '<a href="game.php?side=Bruker&navn='.urlencode($row['hitlisters_navn']).'">'.htmlspecialchars($row['hitlisters_navn']).'</a>'; } else { $hitlistet_av_aak = 'Anonym'; }
        if($row['betalings_typen'] == 'Penger') { $kr_eller_poeng = 'kr'; } else { $kr_eller_poeng = 'poeng'; }
        echo '
        <div class="Div_bunn_1">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($row['hitlist_offer']).'">'.htmlspecialchars($row['hitlist_offer']).'</a></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.$hitlistet_av_aak.'</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.number_format($row['hitlist_dusor'], 0, ",", ".").' '.$kr_eller_poeng.'</div>
        <div class="Div_bunn_2"><input name="Valg_66" value="'.$fake_id.'" type="radio" '.$sjekka.'></div>
        ';
        }}
        ?>
        <?
        // Viser side lenker
        $hent_info = mysql_query("SELECT * FROM hitlist WHERE id LIKE '%' AND timestampen_over > '$tiden'");
        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '20';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '20' * $i;
        $side_tall = $side_tall - '20';
        echo '&nbsp;&nbsp;<a href="game.php?side=Hitlist&s='.$side_tall.'">['.$i.']</a>';
        }
        echo '</div>';
        }
        ?>
        <div class="Div_submit_knapp_3" onclick="document.getElementById('kjop_ut').submit()"><p class="pan_str_2">KJØP UT</p></div></form>
        </div>
        <?
        // Lukker Toppen
        }}}}
        ?>