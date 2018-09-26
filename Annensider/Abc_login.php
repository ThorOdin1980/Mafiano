        <?php
        if(empty($DIN_SUBMIT_KNAPP)) { header("Location: index.php"); }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta"><form method="post" id="<?=$DIN_SUBMIT_KNAPP;?>">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2 ">LOGG INN</span></div>
        <div class="Div_bilde">
			<img border="0" src="../Bilder/hovedbilde.jpg" width="490" height="200"></div>
        <?
        include "db.php";

        function geoCheckIP($ip) {
        if(!filter_var($ip, FILTER_VALIDATE_IP)) { throw new InvalidArgumentException("IP is not valid"); }
        $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
        if(empty($response)) { /*throw new InvalidArgumentException("Error contacting Geo-IP-Server"); */ return 'Ingenting'; }
        $Domene = preg_match('#Domain: (.*?)&nbsp;#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Land = preg_match('#Country: (.*?)&nbsp;#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Fylke = preg_match('#State/Region: (.*?)<br#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        $Byen = preg_match('#City: (.*?)<br#i',$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
        return "$Domene<br>$Land > $Fylke > $Byen";
        }

 function getBrowser($Agent) { 
 $u_agent = $Agent; $bname = 'Unknown'; $platform = 'Unknown'; $version= "";
 if(preg_match('/linux/i', $u_agent)) { $platform = 'linux'; }
 elseif(preg_match('/macintosh|mac os x/i', $u_agent)) { $platform = 'mac'; }
 elseif(preg_match('/windows|win32/i', $u_agent)) { $platform = 'windows'; }
 if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { $bname = 'Internet Explorer'; $ub = "MSIE"; }
 elseif(preg_match('/Firefox/i',$u_agent)) { $bname = 'Mozilla Firefox'; $ub = "Firefox"; }
 elseif(preg_match('/Chrome/i',$u_agent)) { $bname = 'Google Chrome'; $ub = "Chrome"; }
 elseif(preg_match('/Safari/i',$u_agent)) { $bname = 'Apple Safari'; $ub = "Safari"; }
 elseif(preg_match('/Opera/i',$u_agent)) { $bname = 'Opera'; $ub = "Opera"; }
 elseif(preg_match('/Netscape/i',$u_agent)) { $bname = 'Netscape'; $ub = "Netscape"; }
 $known = array('Version', $ub, 'other');
 $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
 if (!preg_match_all($pattern, $u_agent, $matches)) { }
 $i = count($matches['browser']);
 if($i != 1) { if(strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; } else { $version= $matches['version'][1]; }}
 else { $version= $matches['version'][0]; }
 if($version==null || $version=="") {$version="?";}
 $Brow = "$platform > $bname $version";
 return $Brow;
 }
        // Login til mafiano
        if(isset($_POST['brukernavn']) || isset($_POST['passord'])) {
                
        $IP_2KA = $_SERVER['REMOTE_ADDR'];
        $NETT_2KA = $_SERVER['HTTP_USER_AGENT'];
      
        $IP_2KA = $_SERVER['REMOTE_ADDR'];
        $Bannlyst = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$IP_2KA' AND Tidslengde > '$tiden'");    
        if(mysql_num_rows($Bannlyst) >= '1') { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ip-adressen du bruker er bannlyst.</span></div>"; } else {
        
        $brukernavnet_LOG = mysql_real_escape_string($_POST['brukernavn']);
        $passordet_LOG = mysql_real_escape_string($_POST['passord']);
        if(empty($_POST['brukernavn']) && empty($_POST['passord'])) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å fylle inn brukernavn feltet.</span><span class="Span_str_5">Du har glemt å fylle inn passord feltet.</span></div>';
        } else {
        if(empty($_POST['brukernavn'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å fylle inn brukernavn feltet.</span></div>'; } else { 
        if(empty($_POST['passord'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å fylle inn passord feltet.</span></div>';  } else {
        $passordet_LOG2 = md5($passordet_LOG);
      
        $sjekk_bruker2 = mysql_query("SELECT * FROM brukere WHERE brukernavn='$brukernavnet_LOG' AND passord='$passordet_LOG2'");
        if (mysql_num_rows($sjekk_bruker2) > '0') { 
        $row = mysql_fetch_assoc($sjekk_bruker2); 
        
        $brukernavnet_LOG = $row['brukernavn'];
        $liv_LOG = $row['liv'];
        $aktivert_LOG = $row['aktivert'];

        if($aktivert_LOG == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Denne brukeren er ikke aktivert.</span></div>'; } else { 
        if($liv_LOG < '1') { echo '<div class="Div_MELDING"><span class="Span_str_5">Denne brukeren har blitt drept eller modkillet.</span></div>';  } else { 

      
        $Straffer = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$brukernavnet_LOG' AND StampOver > '$tiden'");
        if(mysql_num_rows($Straffer) >= '1') { 
        $Info = mysql_fetch_assoc($Straffer);
        $StraffIgjen = $Info['StampOver'] - $tiden;
        $StraffIgjen = RegnTid($StraffIgjen);
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Det gjennstår $StraffIgjen av tidstraffen din.<br><br>Du har ikke lov til å opprette en annen bruker mens du soner tidstraff. Hvis det blir gjort vil denne brukeren bli modkillet.</span></div>"; } else {
        $tiden = time();
        $tiden_aktiv = $tiden + '3600';
        
        $BRUKER_2KA = $brukernavnet_LOG;
        $PASSORD_2KA = $passordet_LOG2;

        $ID_2KA = session_id();
 
        $_SESSION['bruker_SES'] = $BRUKER_2KA;
        $_SESSION['pass_SES'] = $PASSORD_2KA;
        $_SESSION['id_SES'] = $ID_2KA;
        $_SESSION['ip_SES'] = md5($_SERVER['REMOTE_ADDR']);
        $_SESSION['nett_SES'] = md5($_SERVER['HTTP_USER_AGENT']);

        $Stedet = mysql_real_escape_string(geoCheckIP($_SERVER['REMOTE_ADDR']));
        $Nettet = mysql_real_escape_string(getBrowser($_SERVER['HTTP_USER_AGENT']));

      
        mysql_query("UPDATE brukere SET sistinne='$tid $nbsp $dato',ip='$IP_2KA',timestamp_inne='$tiden',aktiv_eller='$tiden_aktiv',logg_in_id='$ID_2KA' WHERE brukernavn='$BRUKER_2KA'") or die (mysql_error());
      
        mysql_query("INSERT INTO Ip_logg (bruker,ip_brukt_nett,dato,nettleser,timestampen,Stedet) VALUES('$BRUKER_2KA','$IP_2KA','$AnnenDato','$Nettet','$tiden','$Stedet')") or die (mysql_error());
        Header("Location: game.php");

        }}}        
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Feil brukernavn / passord.</span></div>'; }
        
        }}}}}
        
        if(empty($brukernavnet_LOG)) { $brukernavnet_VISES = ''; } else { $brukernavnet_VISES = $brukernavnet_LOG; }
        if(empty($passordet_LOG)) { $passord_VISES = ''; } else { $passord_VISES = $passordet_LOG; }

        ?>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Brukernavn</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="brukernavn" maxlength="20" value="<?=$brukernavnet_VISES;?>"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Passord</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="password" name="passord"></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('<?=$DIN_SUBMIT_KNAPP;?>').submit()"><p class="pan_str_2">LOGG INN</p></div>
        </form></div>