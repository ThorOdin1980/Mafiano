        <SCRIPT TYPE="text/javascript">
        <!--
        function numbersonly(myfield, e, dec) { var key; var keychar;
        if (window.event) key = window.event.keyCode; else if (e) key = e.which; else return true; keychar = String.fromCharCode(key);
        if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
        return true; else if ((("0123456789").indexOf(keychar) > -1)) return true; else if (dec && (keychar == ".")) { myfield.form.elements[dec].focus(); return false; } else return false; }
        //-->
        </SCRIPT>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') {
        if($type3 == 'A' && $type == 'm') { echo "Du kan ikke redigere på en administrators brukerinfo."; } else {  
        
        // Funksjoner
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
        function fiks_tall($tall){ $tall = floor($tall); $tall = number_format($tall, 0, ",", "."); return $tall; }
        


        echo "<div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GJENG MEDLEMMER</span><form method=\"post\" id=\"Gjeng_info\"></div>";


        if (isset($_POST['Medlem'])) {
        $Medlem = rengjor_tall(mysql_real_escape_string($_POST['Medlem']));
        $Stilling = mysql_real_escape_string($_POST['Stilling']); 
        if($Gjeng_Navn == 'Mafiano Crew') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke endre stillinger i denne gjengen.</span></div>'; } else {
        if(empty($Medlem) || empty($Stilling)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Mangler informasjon.</span></div>'; } else { 
        if($Stilling == 'Sett som boss' || $Stilling == 'Sett som medlem') {  
      
        $Sjekk_Medlem = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE id LIKE '$Medlem'");
        if (mysql_num_rows($Sjekk_Medlem) == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">Finner ikke brukeren i denne gjengen.</span></div>'; } else { 
        if($Stilling == 'Sett som boss') { $Stillingener = "Boss"; } else { $Stillingener = 'Medlem'; }
        mysql_query("UPDATE Gjeng_medlemmer SET stilling='$Stillingener' WHERE id LIKE '$Medlem'") or die(mysql_error());
        echo '<div class="Div_MELDING"><span class="Span_str_6">Stillingen er endret nå med mindre personen hadde samme stilling fra før.</span></div>';
        }
        
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst slutt å endre kildekodene.</span></div>'; 
        }}}}

        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg medlem</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Medlem\">";
        
        if (mysql_num_rows($Gjeng_Medlemmer) == 0) { echo '<option>DET ER INGEN MEDLEMMER</option>'; } else { 
        while ($Medlem_info55 = mysql_fetch_assoc($Gjeng_Medlemmer)) {
        $IS = $Medlem_info55['id'];
        $IT = $Medlem_info55['brukernavn'];
        echo "<option value=\"$IS\">$IT</option>";
        }}
        
        echo "</select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg stilling</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Stilling\"><option>Sett som boss</option><option>Sett som medlem</option></select></div>
        <div class=\"Div_venstre_side_1\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Gjeng_info').submit()\"><p class=\"pan_str_2\">Endre stilling!</p></form></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        ";
        
        }} else { 
        header("Location: index.php");
        }}
        ?>
        
        
        
        
        
        
        