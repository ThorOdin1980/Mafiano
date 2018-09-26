        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') { 
                $besok_brukernavn = $I_Brukernavn;

        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=Bruker&navn=$besok_brukernavn&TikkTakkMistaSkittFakk=IpLogg&s=0"); }}
        
        function getBrowserType ($skit) {
        $HTTP_USER_AGENT = $skit;
        if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[2]; $browser_agent = 'Opera'; } 
        else if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[1]; $browser_agent = 'Internet explorer'; } 
        else if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[1]; $browser_agent = 'Omniweb'; } 
        else if (ereg('Netscape([0-9]{1})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[1]; $browser_agent = 'Netscape'; } 
        else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[1]; $browser_agent = 'Mozilla firefox'; } 
        else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) { $browser_version = $log_version[1]; $browser_agent = 'Konqueror'; } 
        else { $browser_version = 0; $browser_agent = 'other'; }
        return $browser_agent;
        }
        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">IP LOGG</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Ip adresse</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Nettleser</span></div>
        <div class="Div_top_1"><span class="Span_str_1">Dato</span></div>
        <div class="Div_top_2"><span class="Span_str_1">Merk</span></div>
        <?
        
      
        $IP_Logg = mysql_query("SELECT * FROM Ip_logg WHERE bruker='$besok_brukernavn' ORDER BY `timestampen` DESC LIMIT $antall, 100");
        if (mysql_num_rows($IP_Logg) == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">Personen har ikke logget inn enda, ellers er loggen tømt.</span></div>'; } else { 
        while ($M_info_2k = mysql_fetch_assoc($IP_Logg)) { 
        
        $Ipen_er_TUP = $M_info_2k['ip_brukt_nett']; 
        $Id_er_TUP = $M_info_2k['ip_brukt_data']; 
        $Dato_er_TUP = $M_info_2k['dato']; 
        $Nettleser_er_TUP = getBrowserType($M_info_2k['nettleser']); 
        

        echo "
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;$Ipen_er_TUP</div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;$Nettleser_er_TUP</div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;$Dato_er_TUP</div>
        <div class=\"Div_bunn_2\">&nbsp;&nbsp;</div>
        ";
        
        }}

        // Viser side lenker
      
        $hent_info = mysql_query("SELECT * FROM Ip_logg WHERE bruker='$besok_brukernavn'");
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
        echo "&nbsp;&nbsp;<a href=\"game.php?side=Bruker&navn=$besok_brukernavn&TikkTakkMistaSkittFakk=IpLogg&s=$side_tall\">[$ekstra$i]</a>";
        if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '90') { echo '<br>'; }
        if($i == '99') { break; } 
        }
        echo '</div>';
        }

        echo "<div class=\"Div_mellomledd\">&nbsp;</div>";
        }}
        ?>