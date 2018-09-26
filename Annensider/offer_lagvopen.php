        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        if($vapen_mulighet_2k == '1') { $vapen_tekst = 'Du kan lage en kniv av barberblad, malingskost, ducktape'; }
        if($vapen_mulighet_2k == '2') { $vapen_tekst = 'Du kan lage et balltre av trestokk, barberblad, tau'; }
        if($vapen_mulighet_2k == '3') { $vapen_tekst = 'Du kan lage en sprettert av  gummistrikk, blanker, lim'; }
        if($vapen_mulighet_2k == '4') { $vapen_tekst = 'Du kan lage en flammekaster av bensin, vanngevær, fyrstiker'; }
        if($vapen_mulighet_2k == '5') { $vapen_tekst = 'Du kan lage en øks av metallbiter, trestokk, lim'; }
        if($vapen_mulighet_2k == '6') { $vapen_tekst = 'Du kan lage en pil og bue av trepinner, tau, lim, barberblad, metall'; }
        if($vapen_mulighet_2k == '8') { if($vopen_ferdig_2k > $tiden) { $vapen_tekst = 'Du holder på å lage våpenet'; } else { $vapen_tekst = 'Ditt hjemmelagde våpen er ferdig'; }}        


        
                
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"Send\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">LAG VÅPEN</span></div>
        ";
                
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Våpen</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$vapen_tekst."</span></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"Lag_v\" id=\"du_valgte\" value=\"Lag v\" />
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Send').submit()\"><p class=\"pan_str_2\">LAG VÅPEN</p></form></div>
        ";
        
        }}
        ?>