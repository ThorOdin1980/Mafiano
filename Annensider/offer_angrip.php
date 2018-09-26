        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        if($vapen_mulighet_2k == '8' && $vopen_ferdig_2k < $tiden) { $b2ka_voopen = $vopen_lagd_2k; } elseif ($vapen_mulighet_2k == '8' && $vopen_ferdig_2k > $tiden) { $b2ka_voopen = "Våpenet er ferdig om $ventetid_vopen sekunder"; } else { $b2ka_voopen = 'Ingen'; }  
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GRAV DEG UT</span></div>
        ";
        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Våpen</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$b2ka_voopen."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"angrip_valg\"><option value=\"1\">Angrip fra høyre side</option><option value=\"2\">Angrip fra venstre side</option><option value=\"3\">Angrip bakenfra</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Angrip\"/>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">ANGRIP KIDNAPPEREN</p></form></div>
        ";
        
        }}
        ?>