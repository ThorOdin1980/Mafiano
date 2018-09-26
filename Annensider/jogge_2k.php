        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if($Kick_energi <= '13') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du er for slapp til å utføre en trening på grunn av manglende energi fra fettet, du må spise litt mat.</span></div>';
        } else { 
        $ny_tren_ventetid = $tiden + '60';
        if($Kick_utholdenhet >= '200') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har max utholdenhet.</span></div>';
        } else {
        if($Kick_utholdenhet <= '10') { $plusse_paa_er = '1.0'; }
        if($Kick_utholdenhet <= '20') { $plusse_paa_er = '0.8'; }
        if($Kick_utholdenhet <= '30') { $plusse_paa_er = '0.6'; } else { $plusse_paa_er = '0.6'; }
        $ny_utholdenhet_blir = $Kick_utholdenhet + $plusse_paa_er;
        $ny_utholdenhet_xx_trening = $Kick_utholdenhet_Xx + '1';
        if($ny_utholdenhet_blir > '200') { $ny_utholdenhet_blir = '201'; }
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE kick_boksing SET Kick_energi='$Kick_energi',Kick_styrke='$Kick_styrke',Kick_ferdighet='$Kick_ferdighet',Kick_utholdenhet='$ny_utholdenhet_blir',Kick_synke='$tiden',Kick_tren_ventetid='$ny_tren_ventetid',Kick_utholdenhet_treninger='$ny_utholdenhet_xx_trening' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har trent utholdenheten din ved å jogge '.$jogge_blir_da.' kilometer.</span></div>';
        }}}
        ?>