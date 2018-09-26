        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        
        // Jo høyere sum det blir jo vanskeligere blir det.
        
        $ventetid_feng_blir = $tiden + '60';
        
        if($kjop_ut_sum_insatt == '1000000') { $respekt_mottar_1 = '10'; include "Annensider/Abc_fengsel_rand_1.php"; }
        if($kjop_ut_sum_insatt == '1500000') { $respekt_mottar_1 = '15'; include "Annensider/Abc_fengsel_rand_2.php"; }
        if($kjop_ut_sum_insatt == '2000000') { $respekt_mottar_1 = '20'; include "Annensider/Abc_fengsel_rand_3.php"; }
        if($kjop_ut_sum_insatt == '2500000') { $respekt_mottar_1 = '25'; include "Annensider/Abc_fengsel_rand_4.php"; }
        if($kjop_ut_sum_insatt == '3000000') { $respekt_mottar_1 = '30'; include "Annensider/Abc_fengsel_rand_5.php"; }
        if($kjop_ut_sum_insatt == '3500000') { $respekt_mottar_1 = '35'; include "Annensider/Abc_fengsel_rand_6.php"; }
        if($kjop_ut_sum_insatt == '4000000') { $respekt_mottar_1 = '40'; include "Annensider/Abc_fengsel_rand_7.php"; }
        if($kjop_ut_sum_insatt == '4500000') { $respekt_mottar_1 = '45'; include "Annensider/Abc_fengsel_rand_8.php"; }
        if($kjop_ut_sum_insatt == '5000000') { $respekt_mottar_1 = '50'; include "Annensider/Abc_fengsel_rand_9.php"; }
        if($kjop_ut_sum_insatt == '5500000') { $respekt_mottar_1 = '55'; include "Annensider/Abc_fengsel_rand_10.php"; }
        if($kjop_ut_sum_insatt == '6000000') { $respekt_mottar_1 = '60'; include "Annensider/Abc_fengsel_rand_11.php"; }
        if($kjop_ut_sum_insatt == '6500000') { $respekt_mottar_1 = '65'; include "Annensider/Abc_fengsel_rand_12.php"; }
        if($kjop_ut_sum_insatt == '7000000') { $respekt_mottar_1 = '70'; include "Annensider/Abc_fengsel_rand_13.php"; }
        if($kjop_ut_sum_insatt == '7500000') { $respekt_mottar_1 = '75'; include "Annensider/Abc_fengsel_rand_14.php"; }
        if($kjop_ut_sum_insatt == '8000000') { $respekt_mottar_1 = '80'; include "Annensider/Abc_fengsel_rand_15.php"; }
        if($kjop_ut_sum_insatt == '8500000') { $respekt_mottar_1 = '85'; include "Annensider/Abc_fengsel_rand_16.php"; }
        if($kjop_ut_sum_insatt == '9000000') { $respekt_mottar_1 = '90'; include "Annensider/Abc_fengsel_rand_17.php"; }
        if($kjop_ut_sum_insatt == '9500000') { $respekt_mottar_1 = '95'; include "Annensider/Abc_fengsel_rand_18.php"; }
        $klare_bryt_eller = $klare_bryt_eller[array_rand($klare_bryt_eller)];
        
        if($klare_bryt_eller == 'NEI') {
        if($bryt_ut_antall >= '0')  { $resultat_feng = array("Fengsel","Fengsel","Ikkeno"); }
        if($bryt_ut_antall >= '2')  { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '4')  { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '6')  { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '8')  { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '10') { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '12') { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '14') { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        if($bryt_ut_antall >= '16') { $resultat_feng = array("Fengsel","Fengsel","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Ikkeno"); }
        $resultat_feng = $resultat_feng[array_rand($resultat_feng)];
        if($resultat_feng == 'Fengsel') { 
        $feng_feng = array("Du ble tatt i forsøket på å bryte ut $brukernavn_insatt.", "Du ble busta under forsøket.", "Boler Anders slo deg ned med en gang han fikk øye på deg, du ble busta.", "Du prøvde og bryte ut $brukernavn_insatt fra fengselet men feilet.");
        $feng_feng_tekst = $feng_feng[array_rand($feng_feng)];
        $fengsel_straff = $tiden + '210';
        $ny_utbryt_skit = $bryt_ut_antall + '1';
      
        mysql_query("INSERT INTO rulleblad_til_spillere (rullebladet_til, krim_type, straff, dato_tatt, timestampen, offer, tekst, land) VALUES ('$brukernavn','Utbrytning','3,5','$tid $nbsp $dato','$tiden','','Utbrytning, forsøkte å bryte ut $brukernavn_bryt_ut fra fengselet i $land.','$land')") OR die(mysql_error());
        mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Utbrytning','3,5','3500000','$fengsel_straff','$tiden','$land')") OR die(mysql_error());
        mysql_query("UPDATE brukere SET bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        if($kjoonn == 'Gutt') { $kjon_tekst_aa = 'han'; } else { $kjon_tekst_aa = 'hun'; }
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_insatt','$tiden','$tid $nbsp $dato','Fengsel','$brukernavn forsøkte å bryte deg ut av fengsel men $kjon_tekst_aa ble desverre busta under forsøket.','Ja')");
        echo PrintTeksten("$feng_feng_tekst","1","Feilet");
        } else { 
        if($resultat_feng == 'Ikkeno') { 
        $feilet_feng = array("Du feilet.", "Du klarte ikke å bryte ut $brukernavn_insatt.", "Du fant ikke fram til fengselet i $land.", "Du klarte ikke å bryte opp låsen til fengselet i $land.", "Du feilet", "Du prøvde og sprenge veggen men det var ikke nok sprengstoff.", "Forsøket ditt på å bryte ut $brukernavn_insatt feilet.");
        $feilet_feng = $feilet_feng[array_rand($feilet_feng)];
      
        $ny_utbryt_skit = $bryt_ut_antall + '1';
        mysql_query("UPDATE brukere SET bryt_ut_antall='$ny_utbryt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_insatt','$tiden','$tid $nbsp $dato','Fengsel','$brukernavn forsøkte å bryte deg ut av fengsel.','Ja')");
        echo PrintTeksten("$feilet_feng","1","Feilet");
        }}
        } else { 
        if($insatt_Kjon == 'Gutt') { $vel_feng = array("Du brøt $brukernavn_insatt ut av fengsel, du gikk opp med $respekt_mottar_1 i respekt.","Du sprengte veggen til fengselet og hjalp $brukernavn_insatt med og rømme, du gikk opp med $respekt_mottar_1 i respekt.","Du klarte det, du gikk opp med $respekt_mottar_1 i respekt.","Du banka dritten ut av politimannen Hans og hjalp $brukernavn_insatt med å rømme du gikk opp med $respekt_mottar_1 i respekt.","Du flørtet litt med fengselsvakten og fikk stjelt nøklene, du brøt ut $brukernavn_insatt, du gikk opp med $respekt_mottar_1 i respekt.","Du brøt deg inn i fengselet for å hjelpe en mann med å rømme, velykket du gikk opp med $respekt_mottar_1 i respekt."); } else { $vel_feng = array("Du brøt $brukernavn_insatt ut av fengsel, du gikk opp med $respekt_mottar_1 i respekt.","Du sprengte veggen til fengselet og hjalp $brukernavn_insatt med og rømme, du gikk opp med $respekt_mottar_1 i respekt.","Du klarte det, du gikk opp med $respekt_mottar_1 i respekt.","Du banka dritten ut av politimannen Hans og hjalp $brukernavn_insatt med å rømmedu gikk opp med $respekt_mottar_1 i respekt.","Du flørtet litt med fengselsvakten og fikk stjelt nøklene, du brøt ut $brukernavn_insatt, du gikk opp med $respekt_mottar_1 i respekt.","Du brøt deg inn i fengselet for å hjelpe ei dame med å rømme, velykket du gikk opp med $respekt_mottar_1 i respekt."); }
        $vel_feng_tekst = $vel_feng[array_rand($vel_feng)];
        $ny_utbryt_skit = $bryt_ut_antall + '1';
        $ny_respekt_skit = $respekt + $respekt_mottar_1;
      
        mysql_query("UPDATE brukere SET bryt_ut_antall='$ny_utbryt_skit',respekt='$ny_respekt_skit',vente_tid_bryt_ut='$ventetid_feng_blir',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("DELETE FROM fengsel WHERE brukernavn='$brukernavn_insatt'") or die(mysql_error());
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_insatt','$tiden','$tid $nbsp $dato','Fengsel','$brukernavn brøt deg ut av fengsel.','Ja')");
        echo PrintTeksten("$vel_feng_tekst","1","Vellykket");
        }
              
        ?>
        
