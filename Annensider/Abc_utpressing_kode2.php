        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Utpressing', 'utpressing_kode2', time(), $db);
        
        // Sjekker om det er en med stilling
        if($mottaker_type == 'A' || $mottaker_type == 'm') {
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_6">Du fant ingen å presse.</span>';
        echo '</div>'; 
        } else {
        
        // Feiler om det er deg selv
        if($mottaker == $brukernavn) { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_6">Du fant ingen å presse.</span>';
        echo '</div>'; 
        } else { 
        
        // Sjekker om personen sitter i fengsel, vist han eller hun gjør så feiler du
        $fengsel_sjekk_om2 = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$mottaker' AND timestamp_over > '$tiden'");
        if (mysql_num_rows($fengsel_sjekk_om2) > '0') { 
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Forsøket ditt feilet.</span>';
        echo '</div>'; 
        } else { 
        
        // Sjekker om personen ligger på sykehus, vist han eller hun gjør så feiler du
      
        $sykehus_sjekk_om2K2 = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$mottaker' AND timestampen_ute > '$tiden'");
        if (mysql_num_rows($sykehus_sjekk_om2K2) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Forsøket ditt feilet.</span>';
        echo '</div>'; 
        } else { 
        
        // Sjekker om personen sitter i bunkers, om han eller hun gjør så feiler du
      
        $bunker_ell2 = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$mottaker' AND godtatt_elle LIKE '1' AND timestamp_ute > '$tiden'");
        if (mysql_num_rows($bunker_ell2) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">'.$mottaker.' stakk av før du rakk å presse ut penga.</span>';
        echo '</div>'; 
        } else {
        
        // Sjekker om personen er kidnappet, vist det er tilfelle så feiler du
      
        $kidnapp_sjekk_om2K4 = mysql_query("SELECT * FROM kidnapping WHERE offer='$mottaker' AND politi_finner < $tiden");
        if (mysql_num_rows($kidnapp_sjekk_om2K4) > '0') { 
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">'.$mottaker.' dyttet deg unna og gikk videre.</span>';
        echo '</div>'; 
        } else { 
        
        // Du feiler siden han andre har mer skils
        if($mottaker_press_antall > $utpresse_antall) {
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
        include "Annensider/Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller prøvde å presse deg for penger, du beskyttet deg og klarte å komme deg unna.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn feilet i forsøket på å utpresse deg.','Ja')");
        }
        
        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("$mottaker hadde mer skils en deg, du feilet.", "Mannen du prøvde å presse dreit i deg å gikk videre.", "Du feilet hardt.", "Det gikk ikke som forventet.","Mannen du prøvde å presse dytta deg vekk.","Du feiga ut."); } else { $tekst_melding = array("Hun du prøvde å presse hadde mer skils en deg, du feilet.", "Hun du prøvde å presse var sterkere en deg, du feilet.", "Forsøket ditt feilet.", "Damen dyttet deg ned på bakken og stakk av.","Damen du prøvde å presse stakk av.","Du gadd ikke å utføre utpressingen alikavel."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">'.$tekst_valgt_22.'</span>';
        echo '</div>'; 
        } else { 
        
        if($mottaker_penger == '0') {
        $din_nye_rankprosent = $rankpros + $utpressing_prosent_s;
      
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv',rankpros='$din_nye_rankprosent' WHERE brukernavn='$brukernavn'");
       
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
        include "Annensider/Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller prøvde å presse deg men du hadde heldigvis ingen penger kontant.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn forsøkte å presse deg men du hadde heldigvis ingen penger på deg.','Ja')");
        }

          if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
        
          mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.3' WHERE Gjeng_Navn='$gjeng'"); 
          mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.3' WHERE brukernavn='$brukernavn'"); 
          }

        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("Forsøket på å presse $mottaker var vellykket men han hadde desverre ingen penger cash.", "Mannen du presset hadde ingen penger.", "Du klarte det men $mottaker hadde ingen penger cash.", "Mannen var villig til å gi deg alt han hadde men desverre hadde han ingen penger cash."); } else { $tekst_melding = array("Forsøket på å presse $mottaker var vellykket men damen hadde desverre ingen penger cash.", "Hun du prøvde å presse hadde ikke penger på seg.", "Forsøket var vellykket men damen hadde ikke penger på seg."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_6">'.$tekst_valgt_22.'</span>';
        echo '</div>'; 
        } else {
        
        // Finner ut om du skal presse personen for alt eller om du skal ta x antall prosent
        if($mottaker_penger >= '2000') {
        
          // Finn ut hvor mye du skal presse personen for
          if($mottaker_penger >= '2000') {
          if($utpresse_antall >= '0') {  $prosent = rand (1, 3); }
          if($utpresse_antall >= '5') {  $prosent = rand (2, 4); }
          if($utpresse_antall >= '10') { $prosent = rand (3, 6); }
          if($utpresse_antall >= '15') { $prosent = rand (4, 7); }
          if($utpresse_antall >= '20') { $prosent = rand (4, 8); }
          }
          if($mottaker_penger >= '20000') {
          if($utpresse_antall >= '0') {  $prosent = rand (2, 4); }
          if($utpresse_antall >= '5') {  $prosent = rand (3, 6); }
          if($utpresse_antall >= '10') { $prosent = rand (4, 8); }
          if($utpresse_antall >= '15') { $prosent = rand (5, 10); }
          if($utpresse_antall >= '20') { $prosent = rand (6, 12); }
          }
          if($mottaker_penger >= '200000') {
          if($utpresse_antall >= '0') {  $prosent = rand (3, 6);  }
          if($utpresse_antall >= '5') {  $prosent = rand (4, 8);  }
          if($utpresse_antall >= '10') { $prosent = rand (5, 10); }
          if($utpresse_antall >= '15') { $prosent = rand (6, 12); }
          if($utpresse_antall >= '20') { $prosent = rand (7, 14); }
          }
          if($mottaker_penger >= '2000000') {
          if($utpresse_antall >= '0') {  $prosent = rand (4, 8);  }
          if($utpresse_antall >= '5') {  $prosent = rand (5, 10); }
          if($utpresse_antall >= '10') { $prosent = rand (6, 12); }
          if($utpresse_antall >= '15') { $prosent = rand (7, 14); }
          }
        
          $XX_prosent = $mottaker_penger / '100' * $prosent;
          if($XX_prosent > '20000000') { $XX_prosent = rand (16000000, 20000000); }

          $personen_har_igjen = $mottaker_penger - $XX_prosent;
          $din_nye_sum_cash = $penger + $XX_prosent;
          $din_nye_rankprosent = $rankpros + $utpressing_prosent_s;
        
          $spenn = number_format($XX_prosent, 0, ",", ".");
          mysql_query("UPDATE brukere SET penger='$personen_har_igjen' WHERE brukernavn='$mottaker'"); 
          mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv',penger='$din_nye_sum_cash',rankpros='$din_nye_rankprosent' WHERE brukernavn='$brukernavn'");
          
        
          if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
          include "Annensider/Abc_utpressing_fovite.php"; 
          if($rand_hehe == '2') { 
          mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller presset deg for $spenn kroner.','Ja')");
          } else {
          mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn presset deg for $spenn kroner.','Ja')");
          }
          
          if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
        
          mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.6' WHERE Gjeng_Navn='$gjeng'"); 
          mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.6' WHERE brukernavn='$brukernavn'"); 
          }
          
          if($mottaker_kjon == 'Gutt') { $tekst_melding = array("Du presset mannen som går under navnet $mottaker for $spenn kroner.", "Du presset $mottaker for $spenn kroner.", "Vellykket du presset $mottaker for $spenn kroner."); } else { $tekst_melding = array("Du presset $mottaker for $spenn kroner.", "Du presset $mottaker for $spenn kroner.", "Vellykket du presset hun for $spenn kroner."); }
          $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
          echo '<div class="Div_MELDING">';
          echo '<span class="Span_str_6">'.$tekst_valgt_22.'</span>';
          echo '</div>'; 
         
        } else { 
          
          $personen_har_igjen = $mottaker_penger - $mottaker_penger;
          $din_nye_sum_cash = $penger + $mottaker_penger;
          $din_nye_rankprosent = $rankpros + $utpressing_prosent_s;
        
          $spenn = number_format($mottaker_penger, 0, ",", ".");
          mysql_query("UPDATE brukere SET penger='$personen_har_igjen' WHERE brukernavn='$mottaker'"); 
          mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv',penger='$din_nye_sum_cash',rankpros='$din_nye_rankprosent' WHERE brukernavn='$brukernavn'");
          
        
          if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
          include "Annensider/Abc_utpressing_fovite.php"; 
          if($rand_hehe == '2') { 
          mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller presset deg for $spenn kroner.','Ja')");
          } else {
          mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn presset deg for $spenn kroner.','Ja')");
          }
          
          if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
        
          mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.6' WHERE Gjeng_Navn='$gjeng'"); 
          mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.6' WHERE brukernavn='$brukernavn'"); 
          }
          
          if($mottaker_kjon == 'Gutt') { 
          $tekst_melding = array("Du presset $mottaker for alt han hadde som var usle $spenn kroner.", "Du presset $mottaker for alt han hadde cash $spenn kroner.", "Vellykket du tømte pengeboken til $mottaker for alt, du fikk med deg $spenn kroner."); } else { $tekst_melding = array("Du presset damen ved navnet $mottaker for $spenn kroner, pengeboken hennes er nå tom.", "Du presset $mottaker for alt hun hadde på seg, du fikk med deg $spenn kroner.", "Vellykket du presset $mottaker for $spenn kroner."); }
          $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
          echo '<div class="Div_MELDING">';
          echo '<span class="Span_str_6">'.$tekst_valgt_22.'</span>';
          echo '</div>'; 
        
        }}}}}}}}}
        ?>
        
        
        

