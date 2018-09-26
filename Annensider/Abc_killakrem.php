        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if ($type == 'A') {  

        function calc_tid($sek) {
        if ($sek < 1) {
        return "0 sek";
        }else {
        $hours = floor((($sek / 60) / 60));
        $b = ($hours * 3600);
        $mins  = floor(($sek - $b) / 60);
        $a = ($hours * 3600) + ($mins * 60);
        $seks = $sek - $a;
        $ret = "";
        if ($hours > 0) {
        $ret = $hours . " timer ";
        }
        if ($mins > 0) {
        $ret = $ret . $mins . " minutter ";
        }	
        $ret = $ret . $seks . " sekunder";
        return $ret;
        }}

        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">MODKILLING / GJENOPPLIVNING</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Modkill.jpg\" width=\"490\" height=\"200\"><form method=\"post\" id=\"Drep_hora\"></div>
        ";
        
        if (isset($_POST['action']) && $_POST['action'] == "modkill") {
        $brukernavn_KILLA = htmlspecialchars(mysql_real_escape_string($_POST['brukernavn']));
        $hvorfor_KILLA = htmlspecialchars(mysql_real_escape_string($_POST['melding']));

        if(empty($brukernavn_KILLA)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inn ett brukernavn.</span></div>';
        } else { 
        $Sjekk_Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavn_KILLA'");
        if (mysql_num_rows($Sjekk_Person) == '0') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det eksisterer ingen med følgende brukernavn: '.$brukernavn_KILLA.'.</span></div>';
        } else { 
        $Person_Info = mysql_fetch_assoc($Sjekk_Person);
        if($Person_Info['brukernavn'] == $brukernavn) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke modkille deg selv.</span></div>';
        } else {
        if($Person_Info['liv'] < '1') {  
        echo '<div class="Div_MELDING"><span class="Span_str_5">Denne brukeren er allerede død.</span></div>';
        } else { 
        if($Person_Info['type'] == 'A') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Personener med stilling administrator/moderator kan ikke modkilles før stillingen er avsatt.</span></div>';
        } else {
        $brukernavn_KILLA = $Person_Info['brukernavn'];
      
        mysql_query("UPDATE brukere SET aktiv_eller='0',modkilled='1',liv='0' WHERE brukernavn='$brukernavn_KILLA'");
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
      
        mysql_query("INSERT INTO `modkill_logg` (offer,modkillet_av,dato,timestampen,arsak,hvilket) VALUES ('$brukernavn_KILLA','$brukernavn','$tid $nbsp $dato','$tiden','$hvorfor_KILLA','1')");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har modda '.$brukernavn_KILLA.'.</span></div>';
        }}}}}}elseif(isset($_POST['action']) && $_POST['action'] == "gjennoppliv") { 
        $brukernavn_KILLA = htmlspecialchars(mysql_real_escape_string($_POST['brukernavn']));
        $hvorfor_KILLA = htmlspecialchars(mysql_real_escape_string($_POST['melding']));
        if(empty($brukernavn_KILLA)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inn ett brukernavn.</span></div>';
        } else { 
        $Sjekk_Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavn_KILLA'");
        if (mysql_num_rows($Sjekk_Person) == '0') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det eksisterer ingen med følgende brukernavn: '.$brukernavn_KILLA.'.</span></div>';
        } else { 
        $Person_Info = mysql_fetch_assoc($Sjekk_Person);
        if($Person_Info['brukernavn'] == $brukernavn) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke gjennopplive deg selv, btw så lever du i spillet fra før av.</span></div>';
        } else {
        if($Person_Info['liv'] >= '1') {  
        echo '<div class="Div_MELDING"><span class="Span_str_5">Denne brukeren lever fra før av.</span></div>';
        } else { 
        $brukernavn_KILLA = $Person_Info['brukernavn'];

        
      
        mysql_query("UPDATE brukere SET modkilled='0',liv='100' WHERE brukernavn='$brukernavn_KILLA'");
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
      
        mysql_query("INSERT INTO `modkill_logg` (offer,modkillet_av,dato,timestampen,arsak,hvilket) VALUES ('$brukernavn_KILLA','$brukernavn','$tid $nbsp $dato','$tiden','$hvorfor_KILLA','2')");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har gjenopplivet '.$brukernavn_KILLA.'.</span></div>';
        
        }}}}}
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"brukernavn\" maxlength=\"30\"  value=\"\"></div>
        <div class=\"Div_venstre_side_2\"></div>
        <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"melding\">Du må skrive noen setninger om hvorfor personen skal gjennopplives / modkilles. Hver hyggelig når du skriver, ikke skriv noe som kan utløse følser eller irritasjon hos spilleren eller annet frekt.</textarea></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"action\" id=\"du_valgte\" />
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='modkill';document.getElementById('Drep_hora').submit()\"><p class=\"pan_str_2\">MODKILL</p></div>
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='gjennoppliv';document.getElementById('Drep_hora').submit()\"><p class=\"pan_str_2\">GJENOPPLIV</p></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\">
        <span class=\"Span_str_2\">MODKILL LOGG</span></div>
        ";
        
      
        $Hent_Logg_Mod = mysql_query("SELECT * FROM modkill_logg WHERE id LIKE '%' AND hvilket='1' ORDER BY `timestampen` DESC LIMIT 0, 30");
        if (mysql_num_rows($Hent_Logg_Mod) >= '1') { 
        while ($row_1 = mysql_fetch_assoc($Hent_Logg_Mod)) { 
        $tiden_seks_2ka = $tiden - $row_1['timestampen'];
        echo"
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Brukernavn:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($row_1['offer'])."\">".htmlspecialchars($row_1['offer'])."</a><br>
        <b>Henrettet av:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($row_1['modkillet_av'])."\">".htmlspecialchars($row_1['modkillet_av'])."</a><br>
        <b>Dato:</b> ".$row_1['dato'].", det er ( ".calc_tid($tiden_seks_2ka)." ) siden.<br>
        <b>Grunlag:</b> ".htmlspecialchars($row_1['arsak'])."<br>
        </span><br>
        </div>
        ";
        }}
        
        echo"
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">OPPLIVNINGS LOGG</span></div>
        ";
        
      
        $Hent_Logg_Oppliv = mysql_query("SELECT * FROM modkill_logg WHERE id LIKE '%' AND hvilket='2' ORDER BY `timestampen` DESC LIMIT 0, 30");
        if (mysql_num_rows($Hent_Logg_Oppliv) >= '1') { 
        while ($row_2 = mysql_fetch_assoc($Hent_Logg_Oppliv)) { 
        $tiden_seks_2ka = $tiden - $row_2['timestampen'];
        echo"
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Brukernavn:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($row_2['offer'])."\">".htmlspecialchars($row_2['offer'])."</a><br>
        <b>Gjenpplivet av:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($row_2['modkillet_av'])."\">".htmlspecialchars($row_2['modkillet_av'])."</a><br>
        <b>Dato:</b> ".$row_2['dato'].", det er ( ".calc_tid($tiden_seks_2ka)." ) siden.<br>
        <b>Grunlag:</b> ".htmlspecialchars($row_2['arsak'])."<br>
        </span><br>
        </div>
        ";
        }}
        
        echo "</form></div>";
        }else{ header("Location: index.php"); }} 
        ?>
        