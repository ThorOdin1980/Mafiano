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
        


        echo "<div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GJENG INFORMASJON</span><form method=\"post\" id=\"Gjeng_info\"></div>";

        if (isset($_POST['Valg'])) { 
        if(empty($Gjeng_Navn) || empty($Gjeng_Id)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke slette en gjeng som ikke eksisterer.</span></div>';
        } else {
        if($Gjeng_Navn == 'Mafiano Crew') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke slette denne gjengen.</span></div>'; } else {
      
        mysql_query("UPDATE brukere SET gjeng='' WHERE gjeng LIKE '$Gjeng_Navn'") or die(mysql_error());
        mysql_query("DELETE FROM Gjenger WHERE id='$Gjeng_Id'") or die(mysql_error());
        mysql_query("DELETE FROM Gjeng_medlemmer WHERE gjeng_id LIKE '$Gjeng_Id'") or die(mysql_error());
        echo '<div class="Div_MELDING"><span class="Span_str_6">Gjengen er nå slettet.</span></div>';
      
        }}}

          
          
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Slett gjeng?</span></div><input type=\"hidden\" name=\"Valg\" id=\"Valg\" />
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Gjeng_info').submit()\"><p class=\"pan_str_2\">Fjern gjengen nå!</p></form></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        ";
        
        }} else { 
        header("Location: index.php");
        }}
        ?>
        
        
        
        
        
        
        