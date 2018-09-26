        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Utpressing', 'utpressing_kode1', time(), $db);
        
        // Sjekker om motstanderen er død
        if($mottaker_liv < '1') {
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Brukeren $mottaker er død.</span></div>";
        } else {
        
        // Sjekker om det er deg selv
        if($mottaker == $brukernavn) {
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke presse deg selv for penger.</span></div>";
        } else {
        
        // Sjekker om det er en med stilling
        if($mottaker_type == 'A' || $mottaker_type == 'm') {
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke presse en moderator/administrator.</span></div>";
        } else {
        
        // Sjekker om personen sitter i fengsel, vist han eller hun gjør så feiler du
        $fengsel_sjekk_om2 = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$mottaker' AND timestamp_over > '$tiden'");
        if (mysql_num_rows($fengsel_sjekk_om2) > '0') { 
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du fant ikke $mottaker.</span></div>";
        } else { 
        
        // Sjekker om personen ligger på sykehus, vist han eller hun gjør så feiler du
      
        $sykehus_sjekk_om2K2 = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$mottaker' AND timestampen_ute > '$tiden'");
        if (mysql_num_rows($sykehus_sjekk_om2K2) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du fant ikke ut hvor $mottaker befinner seg.</span></div>";
        } else { 
        
        // Sjekker om personen sitter i bunkers, om han eller hun gjør så feiler du
      
        $bunker_ell2 = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$mottaker' AND godtatt_elle LIKE '1' AND timestamp_ute > '$tiden'");
        if (mysql_num_rows($bunker_ell2) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du fant ikke brukeren $mottaker.</span></div>";
        } else {
        
        // Sjekker om personen er kidnappet, vist det er tilfelle så feiler du
      
        $kidnapp_sjekk_om2K4 = mysql_query("SELECT * FROM kidnapping WHERE offer='$mottaker' AND politi_finner < $tiden");
        if (mysql_num_rows($kidnapp_sjekk_om2K4) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du fant ikke $mottaker.</span></div>";
        } else { 
        
        // Sjekker om dere er i samme land, om dere ikke er feiler du
        if($mottaker_land != $land) {
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du fant ikke $mottaker i $land.</span></div>";
        } else {
        
        
        if($mottaker_rank > $rank_niva) {

        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; $tekst_din_eid_2 = 'han'; } else { $tekst_din_eid_1 = 'kvinnlig'; $tekst_din_eid_2 = 'hun'; }
        include "Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller prøvde å presse ut litt spenn, du dyttet $tekst_din_eid_2 vekk.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn feilet i forsøket på å utpresse deg, du lo av personen.','Ja')");
        }
        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("Du prøvde å presse $mottaker men feilet desverre.", "Han du prøvde å presse hadde større muskler, du feilet.", "Forsøket ditt feilet.", "Du prøvde å presse en med høyere rank, det gikk ikke som forventet.","Mannen du forsøkte å presse stakk av.","Du turte ikke å presse $mottaker."); } else { $tekst_melding = array("Du prøvde å presse $mottaker men feilet desverre.", "Hun du prøvde å presse var sterkere en deg, du feilet.", "Forsøket ditt feilet.", "Du prøvde å presse ei med høyere rank, det gikk ikke som forventet.","Damen du prøvde å presse stakk av.","Du turte ikke å presse $mottaker."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">$tekst_valgt_22</span></div>";
        } elseif($mottaker_rank == $rank_niva) { 
        if($mottaker_press_antall > $utpresse_antall) { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
        include "Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller prøvde å presse deg for penger, du beskyttet deg og klarte å komme deg unna.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn feilet i forsøket på å utpresse deg.','Ja')");
        }
        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("$mottaker hadde mer skils en deg, du feilet.", "Mannen du prøvde å presse dreit i deg å gikk videre.", "Du feilet hardt.", "Det gikk ikke som forventet.","Mannen du prøvde å presse dytta deg vekk.","Du feiga ut."); } else { $tekst_melding = array("Hun du prøvde å presse hadde mer skils en deg, du feilet.", "Hun du prøvde å presse var sterkere en deg, du feilet.", "Forsøket ditt feilet.", "Damen dyttet deg ned på bakken og stakk av.","Damen du prøvde å presse stakk av.","Du gadd ikke å utføre utpressingen alikavel."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">$tekst_valgt_22</span></div>";      
        } else {
        if($mottaker_penger == '0') { 
        $din_nye_rankprosent = $rankpros + $utpressing_prosent_s;
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv',rankpros='$din_nye_rankprosent' WHERE brukernavn='$brukernavn'");
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
        include "Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller prøvde å presse deg men du hadde heldigvis ingen penger kontant.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn forsøkte å presse deg men du hadde heldigvis ingen penger på deg.','Ja')");
        }
        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("Forsøket på å presse $mottaker var vellykket men han hadde desverre ingen penger kontant.", "Mannen du presset hadde ingen penger.", "Du klarte det men $mottaker hadde ingen penger cash.", "Mannen var villig til å gi deg alt han hadde men uheldigvis hadde han ingen penger på seg."); } else { $tekst_melding = array("Forsøket på å presse $mottaker var vellykket men damen hadde desverre ingen penger cash.", "Hun du prøvde å presse hadde ikke penger på seg.", "Forsøket var vellykket men damen hadde ikke penger på seg."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        
        if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
      
        mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.3' WHERE Gjeng_Navn='$gjeng'"); 
        mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.3' WHERE brukernavn='$brukernavn'"); 
        }
        
        
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">$tekst_valgt_22</span></div>";
        } else {
        
        
        include "Abc_utpressing_kode1-55.php";
        }}} else {
        
        include "Abc_utpressing_kode1-55.php";
        }
        
        
       
        
        }}}}}}}}
        ?>
