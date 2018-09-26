        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A') { 
        
        
        
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">BAN IP-ADRESSE</span><form method=\"post\" id=\"$submit_knapp_3\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/mangler_bilde.jpg\"></div>";
        
        if(isset($_POST['action']) && $_POST['action'] == "Ban") { 
        $S_Ip =  Fiks_Space(Mysql_Klar($_POST['ipadresse']));
        $S_Gjelder =  Mysql_Klar($_POST['Gjelder_P']);
        $Tidslengde = $tiden + '2592000';
        if(empty($S_Ip)) { echo PrintTeksten('Vennligst fyll ut alle feltene.','1','Feilet'); } 
        elseif(empty($S_Gjelder)) { echo PrintTeksten('Vennligst fyll ut alle feltene.','1','Feilet'); }
        elseif($S_Gjelder == 'Spam' || $S_Gjelder == 'Bryter norsk lov' || $S_Gjelder == 'Annet') {
        if($S_Ip == $DinIpAdresse) { echo PrintTeksten('Du kan ikke bannlyse din egen ip-adresse.','1','Feilet'); } else { 
      
        $Straffer = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$S_Ip' AND Tidslengde > '$tiden'");
        if(mysql_num_rows($Straffer) >= '1') { echo PrintTeksten('Ip adressen er allerede bannlyst.','1','Feilet'); } else {
        mysql_query("INSERT INTO `IpBan` (IpAdresse,Av,Stamp,Dato,Tidslengde,Grunnlag) VALUES ('$S_Ip','$brukernavn','$tiden','$FullDato','$Tidslengde','$S_Gjelder')");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du har bannlysten følgende ip: $S_Ip.",'1','Vellykket');
        }}} else { echo PrintTeksten('Vennligst fyll ut alle feltene.','1','Feilet'); }
        } elseif(isset($_POST['action']) && $_POST['action'] == "BanFjern") { 
        $S_Ip =  Fiks_Space(Mysql_Klar($_POST['ipadresse']));
        if(empty($S_Ip)) { echo PrintTeksten('Vennligst fyll inn en ip-adresse.','1','Feilet'); } else {
      
        $Straffer = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$S_Ip' AND Tidslengde > '$tiden'");
        if(mysql_num_rows($Straffer) == '0') { echo PrintTeksten('Ip-adressen er ikke bannlyst fra før av.','1','Feilet'); } else {
        mysql_query("UPDATE IpBan SET Tidslengde='$tiden' WHERE IpAdresse='$S_Ip' AND Tidslengde > '$tiden'");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du har fjernet bannlysningen av følgende ip: $S_Ip",'1','Vellykket');
        }}}

        if(empty($_POST['ipadresse'])) { $En = ''; } else { $En = $_POST['ipadresse']; }
        if(empty($_POST['Gjelder_P']) || $_POST['Gjelder_P'] == 'Ingen') { $To = 'Ingen'; $Tre = 'Velg alternativ'; } else { $Tre = "<b>Velg alternativ:</b> ".$_POST['Gjelder_P'];  $To = $_POST['Gjelder_P']; }

        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Ip-adresse</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"ipadresse\" value=\"$En\" maxlength=\"30\"></div>
        <input type=\"hidden\" name=\"Gjelder_P\" id=\"Gjelder_P\" value=\"$To\"/>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Grunnlag</span></div>
        <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Grunnlag')\">
        <div id=\"Velg alternativ\" class=\"Span_str_9\">$Tre</div><div id=\"Grunnlag\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Spam','Gjelder_P')\">---> Ip-adressen spammer spillet</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Bryter norsk lov','Gjelder_P')\">---> Ip-adressen bryter norsk lov</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Annet','Gjelder_P')\">---> Annet</div></div></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"action\" id=\"du_valgte\" />
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='Ban';document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">IP-BAN</p></div>
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='BanFjern';document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">FJERN IP-BAN</p></form></div>
        </div>";
                
        } else { header("Location: index.php"); }}}
        ?>