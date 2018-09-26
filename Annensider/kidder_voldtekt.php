        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">VOLDTEKT</span></div>
        ";
        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Muligheter</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"valg\">
        <option value=\"1\">Voldta ".$offer_navn_2k." - øker med 40 respekt samt litt rank %.</option>
        <option value=\"2\">Slå mens du voldtar ".$offer_navn_2k." - øker med 50 respekt samt litt rank %.</option>
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Voldtekt\" />
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">VOLDTA</p></form></div>
        ";
        
        }}
        ?>