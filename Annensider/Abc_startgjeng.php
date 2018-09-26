        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        
        echo "
        <div class=\"Div_masta\"><form method=\"post\" id=\"Start\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">START GJENG</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/gjeng.jpg\" width=\"490\" height=\"200\"></div>
        ";
        
        $form_kjop = "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gjengnavn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"GjengNavn\" maxlength=\"20\"  value=\"\"></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Start').submit()\"><p class=\"pan_str_2\">START GJENG</p></div>
        ";
        
      
        $Sjekk_Gjeng_antall = mysql_query("SELECT * FROM Gjenger WHERE id LIKE '%'");
        if(mysql_num_rows($Sjekk_Gjeng_antall) >= '9') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ikke plass til fler gjenger.</span></div>'; 
        } else { 
        if(!empty($gjeng)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det er plass til fler gjenger nå men du kan desverre ikke kjøpe en ettersom at du allerede er med i en annen gjeng.</span></div>'; 
        } else { 
        if($rank_niva >= '5' && $respekt >= '2000') { 
        

        if (isset($_POST['GjengNavn'])) {
        $GjengNavn = mysql_real_escape_string($_POST['GjengNavn']);
        $GjengNavn = htmlspecialchars($GjengNavn);
        $GjengNavn = ereg_replace("[^A-Za-z0-9 ]", "", $GjengNavn);
        if(empty($GjengNavn)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt et gjengnavn.</span></div>'; } else { 
        if(strlen($GjengNavn) > '20') { echo '<div class="Div_MELDING"><span class="Span_str_5">Gjengnavnet er for langt.</span></div>'; } else { 
       $Sjekk_GjengNavn = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn='$GjengNavn'");
        if(mysql_num_rows($Sjekk_GjengNavn) >= '1') { echo '<div class="Div_MELDING"><span class="Span_str_5">Det eksisterer allerede en gjeng med det gjengnavnet.</span></div>'; } else { 
        if($penger >= '200000000') { 
        $ny_sum_spenn = floor($penger - '200000000');
        
        mysql_query("UPDATE brukere SET gjeng='$GjengNavn',aktiv_eller='$tiden_aktiv',turns='$ny_sum_poeng',penger='$ny_sum_spenn' WHERE brukernavn='$brukernavn'"); 
        mysql_query("INSERT INTO Gjenger (Gjeng_Navn,Dato_Startet,Stamp_Startet) VALUES ('$GjengNavn','$tid $nbsp $dato','$tiden')");
        $gjeng_id2k = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn='$GjengNavn'");
        $rad_BadGirls = mysql_fetch_assoc($gjeng_id2k);
        $gjeng_id = $rad_BadGirls['id'];
        mysql_query("INSERT INTO Gjeng_medlemmer (gjeng_id,brukernavn,stilling,ansatt_dato,ansatt_stamp) VALUES ('$gjeng_id','$brukernavn','Boss','$tid $nbsp $dato','$tiden')");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Gratulerer med gjeng, du betalte 200 millioner. Gjengen din heter '.$GjengNavn.'.</span></div>';
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda, en gjeng koster 200 millioner.</span></div>'; }
        }}}} 
        

        
        
        echo $form_kjop;
        
        
        } else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det er ledig gjengplass men du har ikke det som skal til for å starte en gjeng enda. Man må ha 2 tusen eller mer i respekt samt en rank som er høyere eller lik Gangster/Gangsterinne.</span></div>'; 
        }}}   

        
        echo "
        </form></div>
        ";
        
        }}}}}
        ?>