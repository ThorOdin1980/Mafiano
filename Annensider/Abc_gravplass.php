        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {

        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {
        
        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=Gravplass&s=0"); }}
        
        ?>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">GRAVPLASSEN TIL <?=strtoupper($land);?></span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/Gravplass.jpg"></div>
        <div class="Div_top_1"><span class="Span_str_1">Brukernavn</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Registrert</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Død</span></div>
        <div class="Div_top_2"><span class="Span_str_1">R.I.P</span></div>
        <?
      
        $gravplass_info_hent = mysql_query("SELECT * FROM brukere WHERE timestamp_dod > '0' AND land='$land' ORDER BY `timestamp_dod` DESC LIMIT $antall, 100");
        if (mysql_num_rows($gravplass_info_hent) == 0) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ingen som er begravet på gravplassen i '.$land.'.</span></div>';
        } else {
        while ($row = mysql_fetch_assoc($gravplass_info_hent)) { 
        echo '
        <div class="Div_bunn_1">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($row['brukernavn']).'">'.htmlspecialchars($row['brukernavn']).'</a></div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.htmlspecialchars($row['regtid']).'</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.htmlspecialchars($row['dato_drept']).'</div>
        <div class="Div_bunn_2">&nbsp;&nbsp;R.I.P</div>
        ';
        }}
        ?>
        
        
        <?
        // Viser side lenker
        $hent_info = mysql_query("SELECT * FROM brukere WHERE timestamp_dod > '0' AND land='$land'");
        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '100';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '100' * $i;
        $side_tall = $side_tall - '100';
        if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; }
        echo '&nbsp;&nbsp;<a href="game.php?side=Gravplass&s='.$side_tall.'">['.$ekstra.''.$i.']</a>';
        if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '80' || $i == '95') { echo '<br>'; }
        }
        echo '</div>';
        }
        ?>
        </div>
        <?
        // Lukker Toppen
        }}}}}
        ?>