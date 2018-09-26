        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        // Dine nye varriabler
        $nytt_ventetid_he2 = $tiden + '300';
        $nytt_antall_kid = $kidnapping_antall + '1';
        $nytt_rankpros = $rankpros + '0.02';
 
        // Tekst blir valgt
        $endelig_svar2k = array("Du fant ikke $kid_brukernavn i $land.", "Du søkte igjennom hele byen men fant ikke $kid_brukernavn.");
        $endelig_svar = $endelig_svar2k[array_rand($endelig_svar2k)];
 
        // Tekst blir valgt melding
        $endelig_pm2k = array("$brukernavn prøvde å kidnappe deg men feilet.", "En anonym prøvde å kidnappe deg.", "$brukernavn fulgte etter deg men du klarte å riste han av deg.","En anonym prøvde å kidnappe deg.");
        $endelig_pm = $endelig_pm2k[array_rand($endelig_pm2k)];
 
        // Email blir sendt ut
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kid_brukernavn','$tiden','$tid $nbsp $dato','Kidnapping','$endelig_pm','Ja')");

        // Oppdater db
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',kid_timestampen='$nytt_ventetid_he2',kid_antall='$nytt_antall_kid',rankpros='$nytt_rankpros' WHERE brukernavn='$brukernavn'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">$endelig_svar</span></div>";                 
        }
        ?>