        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GI GAVE</span></div>
        ";
        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gavesum</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"gavesum\" value=\"\" maxlength=\"10\" onKeyPress=\"return numbersonly(this, event)\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg gave</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"gave_valg\"><option value=\"1\">Poeng</option><option value=\"2\">Penger - fra hånda</option><option value=\"3\">Penger - fra bank</option><option value=\"4\">Bombechips</option><option value=\"5\">Respekt</option><option value=\"6\">Kuler</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Gave\"/>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">GI GAVE</p></form></div>
        ";
        
        }}
        ?>