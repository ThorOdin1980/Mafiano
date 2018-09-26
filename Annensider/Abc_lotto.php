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
        
        $rundetid = "86400";    // Hvor lenge runden varer i sek
        $makskjop = "100";      // Max lodd en spiller kan kjøpe
        $loddpris = "300000";    // Hvor mye lodd koster per stk.
        $rentefot = "75";       // Hvor mangen % av potten vinneren for
        $br = $brukernavn;
        $peng = $penger;
        $top = ("Lotto");

        function sjekk_belop($tall) { if(ereg("^[0-9]+$",$tall) && strlen($tall) < 50) return true; else return false; }
        function tall_input($spenn){ $a = array('.','kr',' ',','); $spenn = str_replace($a, '', $spenn); return $spenn; }
        function calc_tid($sek) { if ($sek < 1) { return "0 sek"; } else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}
        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta"><form method="post" id="kjop">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">LOTTO</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/lotto.jpg" width="490" height="200"></div>
        <?php
        include("lottosjekk.inc.php");
        if ($_POST[lodd]) {
        $atkjop = tall_input($_POST[lodd]);
        if(!sjekk_belop($atkjop)) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det var ikke tall.</span></div>';
        } elseif(($atkjop * $loddpris) > $peng) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger.</span></div>';
        } elseif($dinelodd == $makskjop) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke kjøpe flere lodd.</span></div>';
        } elseif(($dinelodd + $atkjop) > $makskjop) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke kjøpe så mange lodd.</span></div>';
        }else {
        $pengbruk = ($peng - ($atkjop * $loddpris));
        $pengkost = number_format(($atkjop * $loddpris));
        $i = 1;
        while ($i <= $atkjop) {
      
        $sqlan = mysql_query("INSERT INTO `lottokupp` (`lottoid` ,`nick`, `tid` ) VALUES ('$lottorunde[rundeid]', '$br', '$tid $nbsp $dato')") or die(mysql_error());
        $i++;
        }
      
        mysql_query("UPDATE brukere SET penger='$pengbruk',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$br'"); 

        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du kjøpte $atkjop lodd for $pengkost kr.</span></div>";
        }
        }
        ?>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Startet</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo $lottorunde['startet']; ?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Potten</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo $potten; ?> kr</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Tid igjen</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo calc_tid($sekkigjen); ?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall deltakere</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo $anspillere; ?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall lodd solgt</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo $anlottokupp; ?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Du har kjøpt</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?php echo $dinelodd . " av " . $makskjop; ?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Pris pr stk</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><? echo number_format($loddpris, 0, ",", "."); ?> kr</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antal lodd</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="lodd" maxlength="3" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1"></span></div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('kjop').submit()"><p class="pan_str_2">KJØP LODD</p></div>
        <div class="Div_mellomledd">&nbsp;</div></form>
        <div class="Div_innledning"><span class="Span_str_2">DINE LODD</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Lottorunde</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Dine lodd</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Dato kjøpt</span></div>
        <div class="Div_top_2"><span class="Span_str_1">Merk</span></div>
        <?php echo $echodine; ?>
        <div class="Div_mellomledd">&nbsp;</div>
        <div class="Div_innledning"><span class="Span_str_2">10 SISTE LOTTO VINNERE</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Brukernavn</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Gevinst</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Dato</span></div>
        <div class="Div_top_2"><span class="Span_str_1">Merk</span></div>
        <?php
      
        $sqlansss = mysql_query('SELECT * FROM `lottovinn` ORDER BY `lottovinn`.`id` DESC LIMIT 0 , 10') or die(mysql_error());
        $atvinn = mysql_num_rows($sqlansss);
        if ($atvinn == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ingen som har vunnet enda.</span></div>'; } else { 
        while ($row = mysql_fetch_array($sqlansss)) { 
        echo "
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;<a href=\"game.php?side=Bruker&navn=".urlencode($row[nick])."\">".htmlspecialchars($row[nick])."</a></div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;" . number_format($row[vunnet]) . "</div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;$row[tid]</div>
        <div class=\"Div_bunn_2\">&nbsp;</div>
        ";
        }}
        ?>
        </div>
        <?
        // Lukker toppen
        }}}}}
        ?>