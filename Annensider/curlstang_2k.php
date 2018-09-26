        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if($Kick_energi <= '13') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du er for slapp til å utføre en trening på grunn av manglende energi fra fettet, du må spise litt mat.</span></div>';
        } else { 
        $ny_tren_ventetid = $tiden + '60';
        if($Kick_styrke >= '200') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har max styrke.</span></div>';
        } else {
        if($Kick_styrke <= '10') { $plusse_paa_er = '1.0'; }
        if($Kick_styrke <= '20') { $plusse_paa_er = '0.8'; }
        if($Kick_styrke <= '30') { $plusse_paa_er = '0.6'; } else { $plusse_paa_er = '0.6'; }
        $ny_styrke_blir = $Kick_styrke + $plusse_paa_er;
        $ny_styrke_xx_trening = $Kick_styrke_Xx + '1';
        if($ny_styrke_blir > '200') { $ny_styrke_blir = '201'; }
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE kick_boksing SET Kick_energi='$Kick_energi',Kick_styrke='$ny_styrke_blir',Kick_ferdighet='$Kick_ferdighet',Kick_utholdenhet='$Kick_utholdenhet',Kick_synke='$tiden',Kick_tren_ventetid='$ny_tren_ventetid',Kick_styrke_treninger='$ny_styrke_xx_trening' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har trent styrken din ved å løfte '.$benkpress_blir_da.' kilo med curlstanga.</span></div>';
        }}}
        ?>