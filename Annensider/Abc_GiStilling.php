        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A') { 
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GI / ENDRE STILLING</span><form method=\"post\" id=\"$submit_knapp_3\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/mangler_bilde.jpg\"></div>
        ";

        if(isset($_POST['brukernavn'])) { 
        $GiTil = mysql_real_escape_string($_POST['brukernavn']);
        $GiStilling = mysql_real_escape_string($_POST['stilling']);
        
        $GiStilling = ereg_replace("[^A-Za-z0-9 ]", "", $GiStilling);
        $GiTil = ereg_replace("[^A-Za-z0-9 ]", "", $GiTil);

        if(empty($GiStilling) || empty($GiTil)) {
        echo '<div class="Div_MELDING">';
        if(empty($GiTil)) { echo '<span class="Span_str_5">Du har glemt å fylle inn brukernavn feltet.</span>'; } 
        if(empty($GiStilling)) { echo '<span class="Span_str_5">Du har ikke valgt hvilken stilling du skal endre til.</span>'; }
        echo '</div>';
        } else { 
        if($GiStilling == 'u' || $GiStilling == 'b' || $GiStilling == 's' || $GiStilling == 'sf' || $GiStilling == 'bz' || $GiStilling == 'mi' || $GiStilling == 'fm' || $GiStilling == 'm') { 
      
        $Sjekk = mysql_query("SELECT * FROM brukere WHERE brukernavn='$GiTil'");
        if (mysql_num_rows($Sjekk) == 0) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det eksisterer ingen brukere ved navnet '.$GiTil.'.</span></div>';
        } else { 
        $Info = mysql_fetch_assoc($Sjekk);
        if($Info['brukernavn'] == $brukernavn) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke endre din egen stilling.</span></div>';
        } else { 
        if($Info['type'] == 'A') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke endre stillingen til en som er administrator.</span></div>';
        } else { 
        if($GiStilling == $Info['type']) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Brukeren har denne stillingen fra før av.</span></div>';
        } else { 
        
        if($GiStilling == 'u') { $Blir = 'vanlig bruker'; } 
        elseif($GiStilling == 'b') { $Blir = 'bot bruker'; }
        elseif($GiStilling == 's') { $Blir = 'support spiller'; }
        elseif($GiStilling == 'sf') { $Blir = 'suppport sjef'; }
        elseif($GiStilling == 'bz') { $Blir = 'bugzorz'; }
        elseif($GiStilling == 'mi') { $Blir = 'mIRC ansvarlig'; }
        elseif($GiStilling == 'fm') { $Blir = 'forum moderator'; }
        elseif($GiStilling == 'm') { $Blir = 'moderator'; }
 
        if($Info['type'] == 'u') { $Var = 'vanlig bruker'; } 
        elseif($Info['type'] == 'b') { $Var = 'bot bruker'; }
        elseif($Info['type'] == 's') { $Var = 'support spiller'; }
        elseif($Info['type'] == 'sf') { $Var = 'suppport sjef'; }
        elseif($Info['type'] == 'bz') { $Var = 'bugzorz'; }
        elseif($Info['type'] == 'mi') { $Var = 'mIRC ansvarlig'; }
        elseif($Info['type'] == 'fm') { $Var = 'forum moderator'; }
        elseif($Info['type'] == 'm') { $Var = 'moderator'; }
        
        $GiTil = $Info['brukernavn'];
        
        $Tekst = "Stillingen ble endret fra $Var til $Blir.";
      
        mysql_query("INSERT INTO `StillingsLogg` (GittTil,GittAv,EndringsLogg,DatoEndret,StampEndret) VALUES ('$GiTil','$brukernavn','$Tekst','$tid $nbsp $dato $nbsp $aar','$tiden')");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$GiTil','$tiden','$tid $nbsp $dato','Ny stilling','$brukernavn har endret stillingen din fra $Var til $Blir.','Ja')");
      
        mysql_query("UPDATE brukere SET type='$GiStilling' WHERE brukernavn='$GiTil'");
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du har endret stillingen til ".$Info['brukernavn']." fra $Var til $Blir.</span></div>";
        }}}}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Ugyldig stilling.</span></div>';
        }}}



        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"brukernavn\" value=\"\" maxlength=\"30\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg stilling</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"stilling\">
        <option value=\"u\">Vanlig bruker</option>
        <option value=\"b\">Mafiano bot bruker</option>
        <option value=\"s\">Support spiller - ingen funksjoner ledige for denne stillingen</option>
        <option value=\"sf\">Suppport sjef  - ingen funksjoner ledige for denne stillingen</option>
        <option value=\"bz\">Bugzorz  - ingen funksjoner ledige for denne stillingen</option>
        <option value=\"mi\">mIRC ansvarlig  - ingen funksjoner ledige for denne stillingen</option>
        <option value=\"fm\">Forum moderator</option>
        <option value=\"m\">Moderator</option>
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">GI STILLING / ENDRE STILLING</p></form></div>
        </div>
        ";
        
        } else { header("Location: index.php"); }}}
        ?>