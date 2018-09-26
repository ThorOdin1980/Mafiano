        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 

        $Info_om_deg = mysql_fetch_assoc($sjekk_horehus);
        $knull_id = $Info_om_deg['id'];
        $KK_HvorLenge2 = ( $Info_om_deg['Bang_stamp_over'] - $Info_om_deg['Bang_stamp_lagt_ut'] ) / '3600';
        if($KK_HvorLenge2 == '1') { $time_skit = 'time'; } else { $time_skit = 'timer'; }
        
            if($Info_om_deg['Bang_hore_liker'] == 'Mann' And $kjoonn == 'Gutt') { $tekst_blir_55 = 'du er ute etter å få fangst hos de som er av samme kjønn som deg altså gutter'; } 
        elseif($Info_om_deg['Bang_hore_liker'] == 'Dame' And $kjoonn == 'Gutt') { $tekst_blir_55 = 'du er ute etter å få fangst hos de som er av motsatt kjønn altså jenter'; }
        elseif($Info_om_deg['Bang_hore_liker'] == 'Mann' And $kjoonn == 'Jente') { $tekst_blir_55 = 'du er ute etter å få fangst hos de som er av motsatt kjønn altså gutter'; }
        elseif($Info_om_deg['Bang_hore_liker'] == 'Dame' And $kjoonn == 'Jente') { $tekst_blir_55 = 'du er ute etter å få fangst hos de som er av samme kjønn som deg altså jenter'; }
    
        if($Info_om_deg['Bang_status'] == 'Klar for deg') { 
        $tekst_blir_66 = 'Du har ikke samleie akuratt nå.';
        } else { 
      
        $horehus_knull = mysql_query("SELECT * FROM Horehus_Knull WHERE Knull_horehus_id='$knull_id'");
        $hent_knull_info = mysql_fetch_assoc($horehus_knull);
        $tekst_blir_66 = "Du har samleie med <a href=\"game.php?side=Bruker&navn=".urlencode($hent_knull_info['Knull_brukernavn'])."\">".htmlspecialchars($hent_knull_info['Knull_brukernavn'])."</a>.";
        }
    
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">HOREHUS</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Horehus.jpg\" width=\"490\" height=\"200\"></div>
        <div class=\"Div_MELDING\">
        <span class=\"Span_str_0\">Informasjon</span><br>
        <span class=\"Span_str_8\">Du plasserte deg på strøket på følgende dato ".$Info_om_deg['Bang_dato_lagt_ut'].", planen din er å sanke inn masse hore-kunder i ".$KK_HvorLenge2." ".$time_skit.". Prisen for å ha samleie med deg ligger på ".number_format($prisen_blir, 0, ",", ".")." kroner per minutt, ".$tekst_blir_55.".</span><br>
        <span class=\"Span_str_0\">Aktivitet</span><br>
        <span class=\"Span_str_8\">".$tekst_blir_66."</span><br>
        <span class=\"Span_str_8\">&nbsp;</span>
        </div></div>";
        
        } 
       ?>