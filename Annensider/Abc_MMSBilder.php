        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">MMS BILDER INNSENDT</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/mmsbilde.jpg\" width=\"490\" height=\"200\"></div>
        ";
        
        if(!empty($_REQUEST['Bilde'])) { 
        $Bilde_Vises = htmlspecialchars(mysql_real_escape_string($_REQUEST['Bilde']));
        $bilde_URL = "http://www.mafiano.no/httpinboxview_example.php?imageId=$Bilde_Vises";
        echo "<div class=\"MSS_2\"><p align=\"center\"><img src=\"$bilde_URL\" style=\"max-width:450px;\"></p></div>";

        } else {
        
        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=MMSBilder&s=0"); }}
        
      
        $Hent_MSS_Bilder = mysql_query("SELECT * FROM HttpInbox WHERE MessageType LIKE 'mms' ORDER BY Timestamp DESC LIMIT $antall, 21");
        if(mysql_num_rows($Hent_MSS_Bilder) >= '1') { 
        while ($Bilde_info_kk = mysql_fetch_assoc($Hent_MSS_Bilder)) { 

        $bilde_URL2 = rawurlencode($Bilde_info_kk['Id']);
        $bilde_URL = "http://www.mafiano.no/httpinboxview_example.php?imageId=$bilde_URL2";

        echo "<div class=\"MSS\" onclick='document.location.href=\"game.php?side=MMSBilder&Bilde=$bilde_URL2\"'><img src=\"$bilde_URL\" width=\"122\" height=\"152\" style=\"padding-left:20px;\"></div>";
        
        }}
        
        // Viser side lenker
        $hent_info = mysql_query("SELECT * FROM HttpInbox WHERE MessageType LIKE 'mms'");
        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '21';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '21' * $i;
        $side_tall = $side_tall - '21';
        if($i < '10') { $ekstra = '0'; } else { $ekstra = ''; }
        echo '&nbsp;&nbsp;<a href="game.php?side=MMSBilder&s='.$side_tall.'">['.$ekstra.''.$i.']</a>';
        if($i == '15' || $i == '30' || $i == '45' || $i == '60' || $i == '75' || $i == '90') { echo '<br>'; }
        if($i == '99') { break; } 
        }
        echo '</div>';
        }
        
        }
        
        
        
        echo "</div>";
        
        } 
        ?>
