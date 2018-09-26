        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">HOREHUS</span><form method=\"post\" id=\"Horehus\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Horehus.jpg\" width=\"490\" height=\"200\"></div>
        ";
                
        if(isset($_POST['soker'])) { 
        $HUKK_Soker = mysql_real_escape_string($_POST['soker']);
        $HUKK_Tid = mysql_real_escape_string($_POST['tidslengde']);

        if(empty($HUKK_Soker) || empty($HUKK_Tid)) { 
        echo '<div class="Div_MELDING">';
        if(empty($HUKK_Soker)) { echo '<span class="Span_str_5">Du har ikke valgt hvilket kjønn du liker.</span>'; }
        if(empty($HUKK_Tid)) { echo '<span class="Span_str_5">Du har ikke valgt hvor lenge du skal holde på.</span>'; }
        echo '</div>';
        } else { 
        if($HUKK_Soker == 'Mann' || $HUKK_Soker == 'Dame') { 
        if($HUKK_Tid == '1 Time' || $HUKK_Tid == '2 Timer' || $HUKK_Tid == '3 Timer' || $HUKK_Tid == '4 Timer' || $HUKK_Tid == '5 Timer' || $HUKK_Tid == '6 Timer' || $HUKK_Tid == '7 Timer') { 
        $HUKK_Tid = ereg_replace("[^0-9]", "", $HUKK_Tid); $HUKK_Tid = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$HUKK_Tid); 
        $HUKK_Tid = $HUKK_Tid * '3600'; $HUKK_Tid = $HUKK_Tid + $tiden;
      
        mysql_query("INSERT INTO Horehus (Bang_hore_er, Bang_hore_skils, Bang_hore_liker, Bang_dato_lagt_ut, Bang_stamp_lagt_ut, Bang_stamp_over, Bang_by, Bang_kjonn) VALUES ('$brukernavn','$horer_pult','$HUKK_Soker','$tid $nbsp $dato','$tiden','$HUKK_Tid','$land','$kjoonn')");
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du er nå plassert på strøket i '.$land.'.</span></div>';
        } else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en tidslengde som ikke eksisterer i spillet.</span></div>';
        }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et kjønn som ikke eksisterer i spillet.</span></div>';
        }}}

        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Din verdi</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".number_format($prisen_blir, 0, ",", ".")." kroner</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Du søker</span></div>        
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"soker\"><option>Mann</option><option>Dame</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tidslengde</span></div>        
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"tidslengde\"><option>1 Time</option><option>2 Timer</option><option>3 Timer</option><option>4 Timer</option><option>5 Timer</option><option>6 Timer</option><option>7 Timer</option></select></div>
        <div class=\"Div_venstre_side_1\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Horehus').submit()\"><p class=\"pan_str_2\">START HOREARBEID</p></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">STRØKET</span></form></div>
        ";

      
        $hent_horer = mysql_query("SELECT * FROM Horehus WHERE Bang_by='$land' AND Bang_stamp_over > '$tiden' ORDER BY `Bang_stamp_lagt_ut` DESC LIMIT $antall, 20");
        if (mysql_num_rows($hent_horer) == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ingen horer ute på strøket i '.$land.'.</span></div>'; } else { 
        while ($hore_info = mysql_fetch_assoc($hent_horer)) { 
        
        $tiden_lagt_ut = $tiden - $hore_info['Bang_stamp_lagt_ut'];
                
        if($hore_info['Bang_hore_liker'] == $din_kat) { $tekst_blir = 'Hora liker kjønnet ditt'; } else { $tekst_blir = 'Horen liker ikke kjønnet ditt'; }
        
        $fake_id = $hore_info['id'] * '3663';
        
        $horer_pult22 = $hore_info['Bang_hore_skils'] + '2.5';
        $prisen_blir2 = $horer_pult22 * '100';
        
        echo "
        <div class=\"Div_Porno\" onclick='document.location.href=\"game.php?side=Horehus&Banger=$fake_id\"'>
        <span class=\"Span_str_8\">
        <b>Hore:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($hore_info['Bang_hore_er'])."\">".htmlspecialchars($hore_info['Bang_hore_er'])."</a> ( ".$hore_info['Bang_kjonn']." )<br>
        <b>Pris per minutt:</b> ".number_format($prisen_blir2, 0, ",", ".")." kr<br>
        <b>Seksuelle skils:</b> ".calc_skils($hore_info['Bang_hore_skils'])."<br>
        <b>Horen forholder seg til:</b> ".$hore_info['Bang_hore_liker']." ( ".$tekst_blir." )<br>
        <b>Dato utlagt:</b> ".$hore_info['Bang_dato_lagt_ut'].", det er ( ".calc_tid($tiden_lagt_ut)." ) siden<br>
        <b>Status:</b> ".$hore_info['Bang_status']."<br>
        </span><br>
        </div>
        ";
        
        }}

        // Viser side lenker
      
        $hent_info = mysql_query("SELECT * FROM Horehus WHERE Bang_by='$land' AND Bang_stamp_over > '$tiden'");
        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '20';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '20' * $i;
        $side_tall = $side_tall - '20';
        if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; }
        echo '&nbsp;&nbsp;<a href="game.php?side=Horehus&s='.$side_tall.'">['.$ekstra.''.$i.']</a>';
        if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '90') { echo '<br>'; }
        if($i == '99') { break; } 
        }
        echo '</div>';
        }

        echo "</div>";
        
        }
        ?>