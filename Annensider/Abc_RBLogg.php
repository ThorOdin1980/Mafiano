        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if ($type == 'A') {  

        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=BankTrans&s=0"); }}

        echo "
        <div class=\"Div_masta\">
        ";

        function calc_tid($sek) { if ($sek < 1) { return "0 sek"; }else{ $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " minutter "; } $ret = $ret . $seks . " sekunder"; return $ret; }}
         
        echo "
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">BRUKER REDIGERINGS LOGG</span></div>
        ";
      
        $Transaksjoner = mysql_query("SELECT * FROM EndringsLogg WHERE EndretStamp LIKE '%' ORDER BY `EndretStamp` DESC LIMIT $antall, 200");
        if (mysql_num_rows($Transaksjoner) >= '1') {  
        while ($Info = mysql_fetch_assoc($Transaksjoner)) { 
        $tiden_seks_2ka = $tiden - $Info['EndretStamp'];

        echo "
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Endret av:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($Info['EndretAv'])."\">".htmlspecialchars($Info['EndretAv'])."</a><br>
        <b>Endret hos:</b> <a href=\"game.php?side=Bruker&navn=".urlencode($Info['EndretHos'])."\">".htmlspecialchars($Info['EndretHos'])."</a><br>
        <b>Dato:</b> ".$Info['EndretDato'].", det er ( ".calc_tid($tiden_seks_2ka)." ) siden<br><br>
        <b>Loggen finner du skrevet under:</b><br>
        ".$Info['EndretInfo']."
        </span><br><br>
        </div>
        ";
        
        }}
        
        // Viser side lenker
      
        $hent_info = mysql_query("SELECT * FROM EndringsLogg WHERE EndretStamp LIKE '%'");

        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '200';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '200' * $i;
        $side_tall = $side_tall - '200';
        if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; }
        echo '&nbsp;&nbsp;<a href="game.php?side=BankTrans&s='.$side_tall.'">['.$ekstra.''.$i.']</a>';
        if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '90') { echo '<br>'; }
        if($i == '99') { break; } 
        }
        echo '</div>';
        }

        echo "</div>";
        } else { header("Location: index.php"); }} 
        ?>
        