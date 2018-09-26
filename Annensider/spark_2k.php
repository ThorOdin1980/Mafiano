        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if($Kick_energi <= '13') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du er for slapp til å utføre en trening på grunn av manglende energi fra fettet, du må spise litt mat.</span></div>';
        } else { 
        $ny_tren_ventetid = $tiden + '60';
        if($Kick_ferdighet >= '200') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har max ferdighet.</span></div>';
        } else {
        if($Kick_ferdighet <= '10') { $plusse_paa_er = '1.0'; }
        if($Kick_ferdighet <= '20') { $plusse_paa_er = '0.8'; }
        if($Kick_ferdighet <= '30') { $plusse_paa_er = '0.6'; } else { $plusse_paa_er = '0.6'; }
        $ny_ferdighet_blir = $Kick_ferdighet + $plusse_paa_er;
        $ny_ferdighet_xx_trening = $Kick_ferdighet_Xx + '1';
        if($ny_ferdighet_blir > '200') { $ny_ferdighet_blir = '201'; }
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE kick_boksing SET Kick_energi='$Kick_energi',Kick_styrke='$Kick_styrke',Kick_ferdighet='$ny_ferdighet_blir',Kick_utholdenhet='$Kick_utholdenhet',Kick_synke='$tiden',Kick_tren_ventetid='$ny_tren_ventetid',Kick_ferdigheter_treninger='$ny_ferdighet_xx_trening' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har trent "sparke" ferdigheten din.</span></div>';
        }}}
        ?>