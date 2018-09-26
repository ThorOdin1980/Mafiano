        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') { 
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">TIDS-STRAFF</span><form method=\"post\" id=\"$submit_knapp_3\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/tidsstraff.jpg\"></div>";
        
        if(isset($_POST['action']) && $_POST['action'] == "Straff") { 
        $S_Bruker =  Mysql_Klar($_POST['bruker']);
        $S_Gjelder =  Mysql_Klar($_POST['Gjelder_P']);
        $TallStraff = Bare_Siffer($S_Gjelder);
        if(empty($S_Bruker)) { echo PrintTeksten('Vennligst fyll ut alle feltene.','1','Feilet'); } 
        elseif(empty($S_Gjelder)) { echo PrintTeksten('Vennligst velg tidslengde','1','Feilet'); } 
        elseif($S_Gjelder == '24 timer' || $S_Gjelder == '48 timer' || $S_Gjelder == '72 timer' || $S_Gjelder == '96 timer' || $S_Gjelder == '120 timer' || $S_Gjelder == '144 timer') { 
      
        $Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$S_Bruker'");
        $Info = mysql_fetch_assoc($Person);
        if (mysql_num_rows($Person) == '0') { echo PrintTeksten("$S_Bruker eksisterer ikke.",'1','Feilet'); } 
        elseif($Info['brukernavn'] == $brukernavn) { echo PrintTeksten("Du kan ikke straffe din egen bruker.",'1','Feilet'); }
        elseif($Info['type'] == 'A' || $Info['type'] == 'm') { echo PrintTeksten("Du kan ikke straffe en medlem av MafiaNo Crew.",'1','Feilet'); }
        elseif($Info['liv'] < '1') { echo PrintTeksten("Du kan ikke straffe en død spiller",'1','Feilet'); } else { 
      
        $Straffer = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$S_Bruker' AND StampOver > '$tiden'");
        if(mysql_num_rows($Straffer) == '0') { 
        $S_Bruker = $Info['brukernavn'];
        $TallStraff = $tiden + ($TallStraff * '3600');
        mysql_query("INSERT INTO `TidsStraff` (Straffes,Av,Grunnlag,StampStartet,StampOver,DatoStartet) VALUES ('$S_Bruker','$brukernavn','$S_Gjelder','$tiden','$TallStraff','$FullDato')");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        $StraffeDomt = BrukerURL($S_Bruker);
        echo PrintTeksten("Du har gitt $StraffeDomt en straff på $S_Gjelder.",'1','Vellykket');
        } else { echo PrintTeksten("$S_Bruker har allerede en tidstraff.",'1','Feilet');
        }}} else { echo PrintTeksten('Vennligst velg tidslengde','1','Feilet');       
        }} 
        elseif(isset($_POST['action']) && $_POST['action'] == "FjernStraff") { 
        $S_Bruker =  Mysql_Klar($_POST['bruker']);
        if(empty($S_Bruker)) { echo PrintTeksten('Vennligst fyll inn et brukernavn.','1','Feilet'); } else { 
      
        $Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$S_Bruker'");
        $Info = mysql_fetch_assoc($Person);
        if (mysql_num_rows($Person) == '0') { echo PrintTeksten("$S_Bruker eksisterer ikke.",'1','Feilet'); } else { 
      
        $S_Bruker = $Info['brukernavn'];
        $StraffeDomt = BrukerURL($S_Bruker);
        $Straffer = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$S_Bruker' AND StampOver > '$tiden'");
        if(mysql_num_rows($Straffer) == '0') { echo PrintTeksten("$StraffeDomt soner ingen straff.",'1','Feilet'); } else { 
        mysql_query("UPDATE TidsStraff SET StampOver='$tiden' WHERE Straffes='$S_Bruker' AND StampOver > '$tiden'");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
        echo PrintTeksten("Du har fjernet straffen til $StraffeDomt.",'1','Vellykket');
        }}}}

        if(empty($_POST['bruker'])) { $En = ''; } else { $En = $_POST['bruker']; }
        if(empty($_POST['Gjelder_P']) || $_POST['Gjelder_P'] == 'Ingen') { $To = 'Ingen'; $Tre = 'Velg alternativ'; } else { $Tre = "<b>Velg alternativ:</b> ".$_POST['Gjelder_P'];  $To = $_POST['Gjelder_P']; }
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"bruker\" value=\"$En\" maxlength=\"30\"></div>
        <input type=\"hidden\" name=\"Gjelder_P\" id=\"Gjelder_P\" value=\"$To\"/>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tidslengde</span></div>
        <div class=\"Div_hoyre_side_1\" onclick=\"VisAlternativer('Tids')\">
        <div id=\"Velg alternativ\" class=\"Span_str_9\">$Tre</div><div id=\"Tids\" class=\"D_Boks\"><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','24 timer','Gjelder_P')\">---> 24 timer</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','48 timer','Gjelder_P')\">---> 48 timer</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','72 timer','Gjelder_P')\">---> 72 timer</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','96 timer','Gjelder_P')\">---> 96 timer</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','120 timer','Gjelder_P')\">---> 120 timer</div><div class=\"D_Over\" onclick=\"VisValg('Velg alternativ','144 timer','Gjelder_P')\">---> 144 timer</div></div></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div><input type=\"hidden\" name=\"action\" id=\"du_valgte\" />
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='Straff';document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">STRAFF</p></div>
        <div class=\"Div_submit_knapp_1\" onclick=\"document.getElementById('du_valgte').value='FjernStraff';document.getElementById('$submit_knapp_3').submit()\"><p class=\"pan_str_2\">FJERN STRAFF</p></form></div>
        </div>";
                
        } else { header("Location: index.php"); }}}
        ?>