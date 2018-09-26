        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PRESS OFFERET</span></div>
        ";
        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Muligheter</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"valg\">
        <option value=\"1\">Press offeret til å gi deg penger.</option>
        <option value=\"2\">Press offeret til å gi deg bombechips.</option>
        <option value=\"3\">Press offeret til å gi deg respekt.</option>
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Press\" />
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">PRESS OFFER</p></form></div>
        ";
        
        }}
        ?>