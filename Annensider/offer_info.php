        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        function calc_tid($sek) { if ($sek < 1) { return "0 sek";} else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}
        
        // Sjekk kidnapper og vopen
        $nick_t = "<a href=\"game.php?side=Bruker&navn=".urlencode($kidnappers_navn_2k)."\">$kidnappers_navn_2k</a>";
      
        $sjekk_kidder = mysql_query("SELECT * FROM brukere WHERE brukernavn='$kidnappers_navn_2k'");
        $kidders_info = mysql_fetch_assoc($sjekk_kidder);
        $SJEKK_HETTE = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$kidnappers_navn_2k' AND type='2' AND forbruk_nr >= '1' AND utstyr LIKE 'Finnlandshette'");
        if (mysql_num_rows($SJEKK_HETTE) == '0') { 
        if($kidders_info['Kjon'] == 'Gutt') { $tekst_1 = "Du har blitt kidnappet av en mann, mannen bruker ikke finlandshette nå, kidnapperens navn er $nick_t."; } else { $tekst_1 = "Du har blitt kidnappet av ei jente, jenta bruker ikke finlandshette nå, kidnapperens navn er $nick_t."; }
        } else { 
        if($kidders_info['Kjon'] == 'Gutt') { $tekst_1 = "Du har blitt kidnappet av en mannlig medspiller, mannen bruker finlandshette."; } else { $tekst_1 = "Du har blitt kidnappet av en kvinnlig medspiller, jenta bruker finlandshette."; }
        }
        $timestampen_tatt_2kkk = $tiden - $timestampen_tatt_2k;
    
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">INFORMASJON</span></div>
        <div class=\"Div_MELDING\">
        <span class=\"Span_str_0\">Generell info</span><br>
        <span class=\"Span_str_8\">
        Kidnapper: ".$tekst_1."<br><br>
        Dato bortført: ".$dato_kidnappet_2k." , det er ( ".calc_tid($timestampen_tatt_2kkk)." ) siden.<br><br>
        </span>
        </div>
        ";
        
        }}
        ?>