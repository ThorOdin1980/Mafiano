        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        if($grav_2k == '0') { $hull_storrelse = 'Du har ikke startet å grave'; }
        if($grav_2k >= '1') { $hull_storrelse = 'Veldig lite hull'; }
        if($grav_2k >= '5') { $hull_storrelse = 'Hullet begyner å bli litt større'; }
        if($grav_2k >= '8') { $hull_storrelse = 'Hullet er stort'; }
        if($grav_2k >= '10') { $hull_storrelse = 'Hullet har nådd grunnmuren, du er snart framme'; }
        if($grav_2k >= '14') { $hull_storrelse = 'Du er igjenom grunnmuren, snart framme'; }
        if($grav_2k >= '18') { $hull_storrelse = 'Det gjennstår bare noen få meter nå'; }
        if($grav_2k >= '20') { $hull_storrelse = 'Tunellen er klar for nå, det er bare å stikke av'; }        


        
                
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">GRAV DEG UT</span></div>
        ";
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Utgravningshull</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$hull_storrelse."</span></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Grav ut\"/>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">START GRAVING</p></form></div>
        ";
        
        }}
        ?>