        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        $knulle_id = $knulle_id / '3663';
      
        $bang_hore = mysql_query("SELECT * FROM Horehus WHERE Bang_by='$land' AND Bang_stamp_over > '$tiden' AND id='$knulle_id'");
        if (mysql_num_rows($bang_hore) >= '1') {  
        $horens_info = mysql_fetch_assoc($bang_hore);
        $hore_brukernavn = $horens_info['Bang_hore_er'];
        $hore_husid = $horens_info['id'];
        $hore_status = $horens_info['Bang_status'];

        $prisen_blir = $horens_info['Bang_hore_skils'] + '2.5'; $prisen_blir = $prisen_blir * '100';

        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">HOREHUS</span><form method=\"post\" id=\"Horehus\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Horehus.jpg\" width=\"490\" height=\"200\"></div>
        ";
        
        if($hore_status != 'Klar for deg') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Denne hora er opptatt med en kunde.</span></div>';
        } else {
        
        if(isset($_POST['behandling'])) { 
        $HUKK_behandling_1 = mysql_real_escape_string($_POST['behandling']);
        $HUKK_stilling_1 = mysql_real_escape_string($_POST['stilling']);
        $HUKK_tidslengde_1 = '10';
        
        if(empty($HUKK_behandling_1) || empty($HUKK_stilling_1)) { 
        echo '<div class="Div_MELDING">';
        if(empty($HUKK_behandling_1)) { echo '<span class="Span_str_5">Du har ikke valgt hvilken behandling du skal gi hora.</span>'; }
        if(empty($HUKK_stilling_1)) { echo '<span class="Span_str_5">Du har ikke valgt hva slags stilling dere skal bruke.</span>'; }
        echo '</div>';
        } else { 
        
        if($HUKK_behandling_1 == 'Bondage' || $HUKK_behandling_1 == 'Vennelig' || $HUKK_behandling_1 == 'Voldtekt') { 
        if($HUKK_stilling_1 == 'Doggystyle' || $HUKK_stilling_1 == 'Oralsex' || $HUKK_stilling_1 == 'Plogen' || $HUKK_stilling_1 == 'Bindersen' || $HUKK_stilling_1 == 'Lotus' || $HUKK_stilling_1 == 'Myk misjonær') { 
        
        // SJEKKER OM HORA ER KIDNAPPET
      
        $kidnapp_sjekk_hore = mysql_query("SELECT * FROM kidnapping WHERE offer='$hore_brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_hore) >= '1') { $varriable_svar = 'kidnappet'; } else { 
        
        // SJEKKER OM HORA ER PÅ SYKEHUS
      
        $sykehus_sjekk_hore = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$hore_brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_hore) >= '1') { $varriable_svar = 'sykehus'; } else { 
        
        // SJEKKER OM HORA LIGGER I BUNKER
      
        $bunker_sjekk_hore = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert='$hore_brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_sjekk_hore) >= '1') { $varriable_svar = 'bunker'; } else { 
        
        // SJEKKER OM HORA SITTER I FENGSEL
      
        $fengsel_sjekk_hore = mysql_query("SELECT * FROM fengsel WHERE brukernavn='$hore_brukernavn' AND timestamp_over > '$tiden'");
        if (mysql_num_rows($fengsel_sjekk_hore) >= '1') { $varriable_svar = 'fengsel'; } else { 
        
        // SJEKKER OM HORA ER I SAMME LAND ELLER OM PERSONEN ER DOD
      
        $land_sjekk_hore = mysql_query("SELECT * FROM brukere WHERE brukernavn='$hore_brukernavn' AND land NOT LIKE '$land'");
        if (mysql_num_rows($land_sjekk_hore) >= '1') { $MER_INFO_LIV = mysql_fetch_assoc($land_sjekk_hore);
        if($MER_INFO_LIV['liv'] < '1') { $varriable_svar = 'dod'; } else { $varriable_svar = 'annen by'; }} else { $varriable_svar = 'ingen'; }
        
        }}}}
        if($varriable_svar == 'ingen') {
        $HUKK_tidslengde_12 = $HUKK_tidslengde_1;
        $prisen_blir2 = $prisen_blir * $HUKK_tidslengde_12;
        if($prisen_blir2 > $penger) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>';
        } else { 
        
        if($horens_info['Bang_hore_liker'] == $din_kat) { 

        
        $Knull_stamp_over = $tiden + ( $HUKK_tidslengde_1 * '60' );
        
        $ny_sum_spenn = floor($penger - $prisen_blir2);
        
      
        mysql_query("INSERT INTO Horehus_Knull (Knull_brukernavn,Knull_behandling,Knull_stilling,Knull_dato,Knull_stamp,Knull_stamp_over,Knull_horehus_id,Knull_sum,Knull_hore) VALUES ('$brukernavn','$HUKK_behandling_1','$HUKK_stilling_1','$tid $nbsp $dato','$tiden','$Knull_stamp_over','$hore_husid','$prisen_blir2','$hore_brukernavn')");
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE Horehus SET Bang_status='Opptatt med en kunde' WHERE id='$hore_husid'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$hore_brukernavn','$tiden','$tid $nbsp $dato','Seksuel aktivitet','$brukernavn har startet en seksuel aktivitet med deg.','Ja')");
        header("Location: game.php?side=Horehus"); 
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Hora tar ikke ditt kjønn.</span></div>'; }
        }} else { 
        if($varriable_svar == 'kidnappet') { $tekst_blir = 'Personen er kidnappet, du kan derfor ikke ha seksuel aktivitet med spilleren akkuratt nå.'; } 
        elseif($varriable_svar == 'sykehus') { $tekst_blir = 'Personen er innlagt på et sykehus, du kan derfor ikke ha seksuel aktivitet med spilleren akkuratt nå.'; }
        elseif($varriable_svar == 'bunker') { $tekst_blir = 'Personen har gått ned i en bunker, du kan derfor ikke ha seksuel aktivitet med spilleren akkuratt nå.'; }
        elseif($varriable_svar == 'fengsel') { $tekst_blir = 'Personen sitter innelåst i et fengsel, du kan derfor ikke ha seksuel aktivitet med spilleren akkuratt nå.'; }
        elseif($varriable_svar == 'dod') { $tekst_blir = 'Personen er død, du kan derfor ikke ha seksuel aktivitet med spilleren.'; }
        elseif($varriable_svar == 'annen by') { $tekst_blir = 'Personen befinner seg i en annen by akuratt nå, du kan derfor ikke ha seksuel aktivitet med spilleren.'; }
        
        echo '<div class="Div_MELDING"><span class="Span_str_5">'.$tekst_blir.'</span></div>';
        }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en stilling som ikke eksisterer i spillet.</span></div>';
        }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en form for behandling som ikke eksisterer i spillet.</span></div>';
        }}}
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Behandling</span></div>        
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"behandling\"><option>Bondage</option><option>Vennelig</option><option>Voldtekt</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Knullestilling</span></div>        
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"stilling\"><option>Doggystyle</option><option>Oralsex</option><option>Plogen</option><option>Bindersen</option><option>Lotus</option><option>Myk misjonær</option></select></div>
        <div class=\"Div_venstre_side_1\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Horehus').submit()\"><p class=\"pan_str_2\">START SEKSUEL AKTIVITET</form></p></div>
        ";
        
        }
        
        echo "</div>";
        
        }}
        ?>