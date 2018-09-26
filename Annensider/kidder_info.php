        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else {
        
        function calc_tid($sek) { if ($sek < 1) { return "0 sek";} else { $hours = floor((($sek / 60) / 60)); $b = ($hours * 3600); $mins  = floor(($sek - $b) / 60); $a = ($hours * 3600) + ($mins * 60); $seks = $sek - $a; $ret = ""; if ($hours > 0) { $ret = $hours . " timer "; } if ($mins > 0) { $ret = $ret . $mins . " min "; } $ret = $ret . $seks . " sek"; return $ret; }}
        

    
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">INFORMASJON</span></div>
        <div class=\"Div_MELDING\">
        <span class=\"Span_str_0\">Generell info</span><br>
        <span class=\"Span_str_8\">
        Offer: <br><br>
        Dato bortført:<br><br>
        </span>
        </div>
        ";
        
        }}
        ?>