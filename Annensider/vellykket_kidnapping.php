        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        // Starter sjekk om du er innlogget
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if (empty($type)) { header("Location: index.php"); } else { 
 
        // Dine nye varriabler
        $nytt_ventetid_he2 = $tiden + '1500';
        $nytt_antall_kid = $kidnapping_antall + '1';
        include "kid_prosent.php";
        $nytt_rankpros = $rankpros + $Kid_prosent_s;
        $vapen_mulighet = rand (1, 6);
        $finner_timestamP_politi = $tiden + rand (4000, 6500);
        $starter_timestamP_politi = $tiden + '2500';

        // Tekst blir valgt
        $endelig_svar2k = array("Vellykket, du kidnappet $kid_brukernavn.", "Du forfulgte $kid_brukernavn, etter noen få minutter slo du til og kastet $kid_brukernavn inn i bilen.");
        $endelig_svar = $endelig_svar2k[array_rand($endelig_svar2k)];
 
        // Tekst blir valgt melding
        $endelig_pm2k = array("Du har blitt kidnappet.", "En person i spillet har kidnappet deg.");
        $endelig_pm = $endelig_pm2k[array_rand($endelig_pm2k)];
 
        // Email blir sendt ut
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$kid_brukernavn','$tiden','$tid $nbsp $dato','Kidnappet','$endelig_pm','Ja')");

      
        mysql_query("INSERT INTO kidnapping (kidnappers_navn,offer,landet,dato_tatt,timestampen_tatt,politi_finner,politi_starter,vapen_mulighet) VALUES ('$brukernavn','$kid_brukernavn','$land','$tid $nbsp $dato','$tiden','$finner_timestamP_politi','$starter_timestamP_politi','$vapen_mulighet')"); 

        // Oppdater db
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',kid_timestampen='$nytt_ventetid_he2',kid_antall='$nytt_antall_kid',rankpros='$nytt_rankpros' WHERE brukernavn='$brukernavn'"); 
        mysql_query("DELETE FROM garage WHERE id ='$bil_kid' AND eier='$brukernavn'") or die(mysql_error());

      
        $kidnapp_sjekk_om2Kbla = mysql_query("SELECT * FROM kidnapping WHERE kidnappers_navn='$kid_brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2Kbla) > '0') {  
        $kidnappings_offer_to = mysql_fetch_assoc($kidnapp_sjekk_om2Kbla);
        $brukernavn_kidnappet_2kb = $kidnappings_offer_to['offer'];
        mysql_query("DELETE FROM kidnapping WHERE kidnappers_navn='$kid_brukernavn'") or die(mysql_error());
 
        // Email blir sendt ut
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_kidnappet_2kb','$tiden','$tid $nbsp $dato','Sluppet fri','Du er nå sluppet fri ettersom personen som kidnappet deg har selv blitt kidnappet.','Ja')");
        }
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">$endelig_svar</span></div>";          
        }}
        ?>