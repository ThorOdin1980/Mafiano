        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {

        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {

        // Henter ut informasjon om hvor mange som ligger inne på sykehuset
      
        $antall_inne_sykehus = mysql_query("SELECT * FROM sykehus WHERE brukernavn LIKE '%'");
        $antall_innlagt = mysql_num_rows($antall_inne_sykehus);
        if($antall_innlagt == '0') { $teskt_stk = "Det er ingen spillere som blir behandlet i dette øyeblikket"; }
        if($antall_innlagt >= '1') { $teskt_stk = "1 person ligger inne for behandling"; }
        if($antall_innlagt >= '2') { $teskt_stk = "$antall_innlagt stk ligger inne for behandling"; }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">SYKEHUS</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/Sykehus.jpg" width="490" height="200"></div>
        <?
        // Html som skal vises
      
        $sykehus_sjekk_om23 = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn'");
        if (mysql_num_rows($sykehus_sjekk_om23) > '0') {
        $syk_vises1ka = mysql_fetch_assoc($sykehus_sjekk_om23);
        $tiden_uta_akla = $syk_vises1ka['timestampen_ute'] - $tiden;
        if($tiden_uta_akla <= '0') { $tiden_vente_blir = '0'; } else { $tiden_vente_blir = $tiden_uta_akla; }
        ?>
        <div class="Div_MELDING"><span class="Span_str_5">Du kommer ut av sykehuset om <span id="tell"><?=$tiden_vente_blir;?></span> sekunder.</span></div>
        <?
        } else { 
        ?>
        <?
        if(isset($_POST['tidslengde'])) { 
        if(empty($_POST['tidslengde'])) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt hvor lenge du skal ligge inne.</span></div>'; 
        } else { 
        $tidslengde_blir = mysql_real_escape_string($_POST['tidslengde']);
        if(is_numeric($tidslengde_blir)) {
        $tidslengde_blir = ereg_replace("[^0-9]", "", $tidslengde_blir);
        $tidslengde_blir = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tidslengde_blir);
        if($tidslengde_blir == '1' || $tidslengde_blir == '2' || $tidslengde_blir == '3' || $tidslengde_blir == '4' || $tidslengde_blir == '5' || $tidslengde_blir == '6' || $tidslengde_blir == '7' || $tidslengde_blir == '8' || $tidslengde_blir == '9') { 
        if($tidslengde_blir == '1') { $pris_blir = '1000'; $tidslengde_timestamp = '3600';  $liv_opp = '5'; }
        if($tidslengde_blir == '2') { $pris_blir = '2000'; $tidslengde_timestamp = '7200';  $liv_opp = '10'; }
        if($tidslengde_blir == '3') { $pris_blir = '3000'; $tidslengde_timestamp = '10800'; $liv_opp = '15'; }
        if($tidslengde_blir == '4') { $pris_blir = '4000'; $tidslengde_timestamp = '14400'; $liv_opp = '20'; }
        if($tidslengde_blir == '5') { $pris_blir = '5000'; $tidslengde_timestamp = '18000'; $liv_opp = '25'; }
        if($tidslengde_blir == '6') { $pris_blir = '6000'; $tidslengde_timestamp = '21600'; $liv_opp = '30'; }
        if($tidslengde_blir == '7') { $pris_blir = '7000'; $tidslengde_timestamp = '25200'; $liv_opp = '35'; }
        if($tidslengde_blir == '8') { $pris_blir = '8000'; $tidslengde_timestamp = '28800'; $liv_opp = '40'; }
        if($tidslengde_blir == '9') { $pris_blir = '9000'; $tidslengde_timestamp = '32400'; $liv_opp = '45'; }
        if($tidslengde_blir == '1') { $teskt_vises = 'time'; } else { $teskt_vises = 'timer'; }
        if($pris_blir > $penger) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; 
        } else {
        if($liv >= '100') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har fult liv.</span></div>'; 
        } else {
        $timestampen_db_blir = $tiden + $tidslengde_timestamp;
        $ny_sum_penger = $penger - $pris_blir;
      
        mysql_query("INSERT INTO `sykehus` (brukernavn,dato,timestampen_inne,timestampen_ute,antall_liv_opp) VALUES ('$brukernavn','$tid $nbsp $dato','$tiden','$timestampen_db_blir','$liv_opp')"); 
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_penger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        header("Location: game.php?side=Sykehus");
        }}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst ikke prøv å endre kildekoden.</span></div>'; 
        }} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst ikke prøv å endre kildekoden.</span></div>'; 
        }}}
        ?>
        <div class="Div_venstre_side_1"><form method="post" id="legg_deg_inn"><span class="Span_str_1">Antall innlagt</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$teskt_stk;?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Pris per time</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9">1.000 kr</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall timer</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="tidslengde"><option value="1">1 time ( øker 5 prosent )</option><option value="2">2 timer ( øker 10 prosent )</option><option value="3">3 timer ( øker 15 prosent )</option><option value="4">4 timer ( øker 20 prosent )</option><option value="5">5 timer ( øker 25 prosent )</option><option value="6">6 timer ( øker 30 prosent )</option><option value="7">7 timer ( øker 35 prosent )</option><option value="8">8 timer ( øker 40 prosent )</option><option value="9">9 timer ( øker 45 prosent )</option></select></div>
        <div class="Div_venstre_side_1"></div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('legg_deg_inn').submit()"><p class="pan_str_2">LEGG DEG INN</p></div></form>
        <?
        }
        ?>
        </div>
        <?
        // Lukker toppen
        }}}}
        ?>