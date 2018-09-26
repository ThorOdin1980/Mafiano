        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
                botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Utpressing', 'utpressing_kode1-55', time(), $db);
        
        
        if($mottaker_penger >= '2000') { 
        if($mottaker_penger >= '2000') {
        if($utpresse_antall >= '0') {  $prosent = rand (1, 3); }
        if($utpresse_antall >= '5') {  $prosent = rand (2, 4); }
        if($utpresse_antall >= '10') { $prosent = rand (3, 6); }
        if($utpresse_antall >= '15') { $prosent = rand (4, 7); }
        if($utpresse_antall >= '20') { $prosent = rand (4, 8); }
        } 
        elseif($mottaker_penger >= '20000') {
        if($utpresse_antall >= '0') {  $prosent = rand (2, 4); }
        if($utpresse_antall >= '5') {  $prosent = rand (3, 6); }
        if($utpresse_antall >= '10') { $prosent = rand (4, 8); }
        if($utpresse_antall >= '15') { $prosent = rand (5, 10); }
        if($utpresse_antall >= '20') { $prosent = rand (6, 12); }
        }
        elseif($mottaker_penger >= '200000') {
        if($utpresse_antall >= '0') {  $prosent = rand (3, 6);  }
        if($utpresse_antall >= '5') {  $prosent = rand (4, 8);  }
        if($utpresse_antall >= '10') { $prosent = rand (5, 10); }
        if($utpresse_antall >= '15') { $prosent = rand (6, 12); }
        if($utpresse_antall >= '20') { $prosent = rand (7, 14); }
        }
        elseif($mottaker_penger >= '2000000') {
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
        include "Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') { 
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','En $tekst_din_eid_1 medspiller presset deg for $spenn kroner.','Ja')");
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn presset deg for $spenn kroner.','Ja')");
        }
        if($mottaker_kjon == 'Gutt') { $tekst_melding = array("Du presset mannen ved navn $mottaker for $spenn kroner.", "Du presset $mottaker for $spenn kroner.", "Vellykket du presset $mottaker for $spenn kroner."); } else { $tekst_melding = array("Du presset ei dame ved navn $mottaker for $spenn kroner.", "Du presset $mottaker for $spenn kroner.", "Vellykket du presset ei dame for for $spenn kroner."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        
        if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
      
        mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.6' WHERE Gjeng_Navn='$gjeng'"); 
        mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.6' WHERE brukernavn='$brukernavn'"); 
        }
        
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">$tekst_valgt_22</span></div>";
        } else { 
        $personen_har_igjen = $mottaker_penger - $mottaker_penger;
        $din_nye_sum_cash = $penger + $mottaker_penger;
        $din_nye_rankprosent = $rankpros + $utpressing_prosent_s;
      
        $spenn = number_format($mottaker_penger, 0, ",", ".");
        mysql_query("UPDATE brukere SET penger='$personen_har_igjen' WHERE brukernavn='$mottaker'"); 
        mysql_query("UPDATE brukere SET presse_antall='$nytt_antall_forsok',utpressing_tid='$utpressing_ny_tid',aktiv_eller='$tiden_aktiv',penger='$din_nye_sum_cash',rankpros='$din_nye_rankprosent' WHERE brukernavn='$brukernavn'");
      
        if($kjoonn == 'Gutt') { $tekst_din_eid_1 = 'mannlig'; } else { $tekst_din_eid_1 = 'kvinnlig'; }
        include "Abc_utpressing_fovite.php"; 
        if($rand_hehe == '2') {
        } else {
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$mottaker','$tiden','$tid $nbsp $dato','Utpressing','$brukernavn presset deg for $spenn kroner.','Ja')");
        }
        if($mottaker_kjon == 'Gutt') { 
        $tekst_melding = array("Du presset $mottaker for alt han hadde som var usle $spenn kroner.", "Du presset $mottaker for alt han hadde cash som var $spenn kroner.", "Vellykket du tømte pengeboken hans for alt, du fikk med deg $spenn kroner."); } else { $tekst_melding = array("Du presset hun for $spenn kroner, pengeboken hennes er nå tom.", "Du presset $mottaker for alt hun hadde på seg, du fikk med deg $spenn kroner.", "Vellykket du presset henne for $spenn kroner."); }
        $tekst_valgt_22 = $tekst_melding[array_rand($tekst_melding)];
        
        if(!empty($gjeng) && !empty($motakers_info['gjeng']) && $gjeng != $motakers_info['gjeng']) { 
      
        mysql_query("UPDATE Gjenger SET AngrepsPros=`AngrepsPros`+'0.6' WHERE Gjeng_Navn='$gjeng'"); 
        mysql_query("UPDATE Gjeng_medlemmer SET OppdragUtfort=`OppdragUtfort`+'0.6' WHERE brukernavn='$brukernavn'"); 
        }
        
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">$tekst_valgt_22</span></div>";
        }
        
        }
        ?>
