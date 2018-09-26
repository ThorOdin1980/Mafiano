        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
        echo "
        <div class=\"Div_masta\"><form method=\"post\" id=\"Support_Post\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">SUPPORT SPILLERE</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/SupportSpillere.jpg\"></div>";
        
        if(isset($_GET['Les'])) { 
        if($type == 'sf' || $type == 's' || $type == 'bz' || $type == 'fm' || $type == 'mi' || $type == 'm' || $type == 'A') {    
        $IDMeld = Bare_Bokstaver(Mysql_Klar($_GET['Les']));
        if(empty($IDMeld)) { header("Location: game.php?side=SupportSpillere"); } else {
        $IDMeld = Dekrypt_Tall($IDMeld);
        
      
        $Se = mysql_query("SELECT * FROM pm_system WHERE id='$IDMeld' AND til_bruker='..Support..Panel..'");
        if(mysql_num_rows($Se) == '0') { header("Location: game.php?side=SupportSpillere"); } else {
        $GetInfo = mysql_fetch_assoc($Se);
        $Dato = $GetInfo['dato_sendt'];
        $Tittel = $GetInfo['tittel'];
        $Melding = $GetInfo['melding'];
        $Fra = Mysql_Klar($GetInfo['fra_bruker']);
        $Ny_Melding = wordwrap($Melding, 45, "\n", true); 
        }}}}
        
        if(isset($_POST['Gjelder_P']) && isset($_GET['Les']) && $GetInfo['lest_ell'] == 'Nei') { 
        $Melding_P = Mysql_Klar($_POST['Melding_P']);
        $MeldingSend = "".$Melding_P."\n--------------------------------\nMELDINGEN UNDER ER SKREVET AV ".$GetInfo['fra_bruker']."\n--------------------------------\n".$GetInfo['melding']."";
        
        $MeldingSend = wordwrap($MeldingSend, 45, "\n", true);

        
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv', meldinger_sendt=`meldinger_sendt`+'1' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell,Support) VALUES ('..Support..Panel..','$Fra','$Timestamp','$FullDato','$Tittel','$MeldingSend','Nei','$brukernavn')");
        mysql_query("UPDATE pm_system SET lest_ell='Ja',melding='$MeldingSend' WHERE id LIKE '$IDMeld'"); 
        echo PrintTeksten("Melding besvart",'1',"Vellykket");

        } 
        elseif(isset($_POST['Gjelder_P'])) { 
        $Gjelder_P = Mysql_Klar($_POST['Gjelder_P']);
        $Melding_P = Mysql_Klar($_POST['Melding_P']);
        
        if(empty($Gjelder_P) || empty($Melding_P) || $Gjelder_P == 'Ingen') { echo PrintTeksten('Vennligst fyll ut alle feltene.','1','Feilet'); } 
        elseif($Gjelder_P == 'Sms tjenester' || $Gjelder_P == 'Feil i spillet' || $Gjelder_P == 'Funksjoner' || $Gjelder_P == 'Mobbing' || $Gjelder_P == 'Regelverk' || $Gjelder_P == 'Annet') { 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('$brukernavn','..Support..Panel..','$Timestamp','$FullDato','$Gjelder_P','$Melding_P','Nei')");
        echo PrintTeksten('Din beskjed er nå sendt','1','Vellykket');
        } else { echo PrintTeksten('Vennligst prøv på nytt.','1','Feilet'); }}
        
        if(empty($_POST['Melding_P'])) { $En = ''; } else { $En = Mysql_Klar($_POST['Melding_P']); }
        if(empty($_POST['Gjelder_P']) || $_POST['Gjelder_P'] == 'Ingen') { $To = 'Ingen'; $Tre = 'Velg alternativ'; } else { $Tre = "<b>Velg alternativ:</b> ".$_POST['Gjelder_P'];  $To = $_POST['Gjelder_P']; }
        
        $PrintForm = "
        <input type=\"hidden\" name=\"Gjelder_P\" id=\"Gjelder_P\" value=\"$To\"/>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjelder</span></div>
        <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Support')\">
        <div id=\"Velg alternativ\" class=\"Span_str_9\">$Tre</div><div id=\"Support\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Sms tjenester','Gjelder_P')\">---> Sms tjenester</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Feil i spillet','Gjelder_P')\">---> Feil i spillet</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Funksjoner','Gjelder_P')\">---> Funksjoner</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Mobbing','Gjelder_P')\">---> Mobbing</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Regelverk','Gjelder_P')\">---> Regelverk</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','Annet','Gjelder_P')\">---> Annet</div></div></div>
        <div class=\"Div_venstre_side_2\"></div>
        <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"Melding_P\">$En</textarea></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Support_Post').submit()\"><p class=\"pan_str_2\">POST</p></div>
        ";
        
        if(isset($_GET['Les'])) { 
        if($type == 'sf' || $type == 's' || $type == 'bz' || $type == 'fm' || $type == 'mi' || $type == 'm' || $type == 'A') {     
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Fra</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".BrukerURL($Fra)."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Kategori</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$Tittel</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Dato mottatt</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$Dato, det er ( ".RegnTid($Timestamp - $GetInfo['timestampen'])." ) siden</span></div>
        <div class=\"Div_venstre_side_2\"></div><div class=\"Div_hoyre_side_2\"><textarea readonly=\"readonly\" class=\"texterea\" name=\"melding\">$Ny_Melding</textarea></div>";
        if($GetInfo['lest_ell'] == 'Nei') { 
        echo "
        <input type=\"hidden\" name=\"Gjelder_P\" id=\"Gjelder_P\" value=\"SupportSvar\"/>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">SVAR</span></div>
        <div class=\"Div_venstre_side_2\"></div>
        <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"Melding_P\"></textarea></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Support_Post').submit()\"><p class=\"pan_str_2\">SEND</p></div>
        "; }}} else { echo $PrintForm; }
        
        echo "</div></form>";

        if($type == 'sf' || $type == 's' || $type == 'bz' || $type == 'fm' || $type == 'mi' || $type == 'm' || $type == 'A') { 
        
      
        $Hent = mysql_query("SELECT * FROM pm_system WHERE til_bruker='..Support..Panel..' AND slettet_ell='Nei'");
        $Sms = "";
        $Feil = "";
        $Funksjoner = "";
        $Mobbing = "";
        $Regelverk = "";
        $Annet = "";
        while($I = mysql_fetch_assoc($Hent)) { 
        
        $Meld_Kort = substr($I['melding'], 0, 30) . '...';
        $IdEr = Krypt_Tall($I['id']);
        $Datoen = $I['dato_sendt'];
        if($I['lest_ell'] == 'Nei') { $Ekstra = '<font color="red" style="font-weight:bold;">( Ubesvart )</font>'; } else { $Ekstra = '<font color="green" style="font-weight:bold;">( Besvart )</font>'; }
        $Var = "<a href=\"game.php?side=SupportSpillere&Les=$IdEr\">$Meld_Kort</a> $Ekstra <b style=\"color:#d5d2d2;\">( $Datoen )</b><br>";

        if($I['tittel'] == 'Sms tjenester') { $Sms = $Sms.$Var; } 
        elseif($I['tittel'] == 'Feil i spillet') { $Feil = $Feil.$Var; }
        elseif($I['tittel'] == 'Funksjoner') { $Funksjoner = $Funksjoner.$Var; }
        elseif($I['tittel'] == 'Mobbing') { $Mobbing = $Mobbing.$Var; }
        elseif($I['tittel'] == 'Regelverk') { $Regelverk = $Regelverk.$Var; }
        elseif($I['tittel'] == 'Annet') { $Annet = $Annet.$Var; }
        }
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <table class=\"Rute_1\">
	    <tr><td class=\"R_0\" colspan=\"2\">INNBOKS</td></tr>
	    <tr><td class=\"R_4\"></td><td class=\"R_4\">Beskjed</td></tr>
	    <tr><td class=\"R_4\">Sms tjenester</td><td class=\"R_2\">$Sms</td></tr>
	    <tr><td class=\"R_4\">Feil i spillet</td><td class=\"R_2\">$Feil</td></tr>
	    <tr><td class=\"R_4\">Funksjoner</td><td class=\"R_2\">$Funksjoner</td></tr>
	    <tr><td class=\"R_4\">Mobbing</td><td class=\"R_2\">$Mobbing</td></tr>
	    <tr><td class=\"R_4\">Regelverk</td><td class=\"R_2\">$Regelverk</td></td></tr>
	    <tr><td class=\"R_4\">Annet</td><td class=\"R_2\">$Annet</td></tr>
	    </table></div>";
        }
        
        
        
        
        
        } 
        ?>

