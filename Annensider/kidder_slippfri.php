        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">SLIPP FRI / SELG VIDERE</span></div>
        ";
        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Pris</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"pris\" value=\"\" maxlength=\"20\" onKeyPress=\"return numbersonly(this, event)\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Anonym?</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"valg\"><option value=\"1\">Ikke anonymt - brukernavnet dit vises</option><option value=\"2\">Anonymt - brukernavnet ditt blir ikke vist, koster 10.000 kr ekstra</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" />
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='SlippFri';document.getElementById('Send').submit()\"><p class=\"pan_str_2\">SLIPP PERSONEN FRI</p></div>
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='Selg';document.getElementById('Send').submit()\"><p class=\"pan_str_2\">SELG VIDERE</p></form></div>
        ";
        
        }}
        ?>