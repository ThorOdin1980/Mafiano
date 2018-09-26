        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        
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
        $ret = $ret . $mins . " min ";
        }	
        $ret = $ret . $seks . " sek";
        return $ret;
        }}

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_mellomledd">&nbsp;<form method="post" id="kjop_ratt_3k"></div>
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">KJØP MATRIALE</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Kjøp varer</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="handle_tba_aa"><option value="Bly">Bly - koster <? echo number_format($Bly_pris_kg, 0, ",", "."); ?> kroner per kg</option><option value="Staal">Stål - koster <? echo number_format($Staal_pris_kg, 0, ",", "."); ?> kroner per kg</option><option value="Krutt">Krutt - koster <? echo number_format($Krutt_pris_kg, 0, ",", "."); ?> kroner per kg</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall varer</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="antall_tba_aa"><option value="10">10 Kilo</option><option value="20">20 Kilo</option><option value="30">30 Kilo</option><option value="40">40 Kilo</option><option value="50">50 Kilo</option><option value="60">60 Kilo</option><option value="70">70 Kilo</option><option value="80">80 Kilo</option><option value="90">90 Kilo</option><option value="2000">2.000 Kilo</option><option value="20000">20.000 Kilo</option></select></div>
        <div class="Div_venstre_side_1"></div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('kjop_ratt_3k').submit()"><p class="pan_str_2">KJØP</p></div></form>
        <?
        if($KF_INFO['KF_Prod_Stamp'] > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente '.calc_tid($tiden_seks_3ka).' før du kan produsere fler kuler.</span></div>'; } else { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"prod_3k\"></div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PRODUSER KULER</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Produser</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"summmen_produ\" value=\"\" maxlength=\"10\" onKeyPress=\"return numbersonly(this, event)\"></div>
        <div class=\"Div_venstre_side_1\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('prod_3k').submit()\"><p class=\"pan_str_2\">PRODUSER</p></div></form>
        ";
        
        }
        }}
        ?>