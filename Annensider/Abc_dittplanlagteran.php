        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        if (empty($SjekkYoen)) { header("Location: index.php"); } else { 
                
        $IdEr = $RanInfo['Id'];
      
        $PrSjekkFire = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        $AntallBlir = mysql_num_rows($PrSjekkFire) + '1';
        if($AntallBlir == '0') { $ForbrytereMed = 'Det er ingen forbrytere med på ranet enda.'; } else { $ForbrytereMed = "Det er $AntallBlir forbryter/e med på ranet."; }
        if(mysql_num_rows($PrSjekkFire) == '4') { $KlartEll = "Ditt planlagte ran er klart, du kan utføre det nå."; } else { $KlartEll = 'Ditt planlagte ran kan ikke startes før du har med folk.';  }
       
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PLANLAGT RAN</span><form method=\"post\" id=\"Inviter\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/planlagtran.jpg\" width=\"490\" height=\"200\"></div>";
        
        if(isset($_POST['brukernavn'])) {
        $Inviter = mysql_real_escape_string($_POST['brukernavn']); 
        $Oppgave = mysql_real_escape_string($_POST['ranvalg']); 
        if(empty($Inviter)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må skrive inn et brukernavn.</span></div>'; } else { 
        if(empty($Oppgave)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må velge en oppgave til brukeren.</span></div>'; } else { 
        if($Oppgave == 'Sjåfør' || $Oppgave == 'Våpenmann' || $Oppgave == 'Eksplosiv' || $Oppgave == 'Alarm ekspert') { 
      
        $sjekk_bruker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Inviter'");
        if (mysql_num_rows($sjekk_bruker) == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">brukeren '.$Inviter.' eksisterer ikke.</span></div>'; } else { 
        $sjekk_bruker = mysql_fetch_assoc($sjekk_bruker);
        $Inviter = $sjekk_bruker['brukernavn'];
        $LivetEr = $sjekk_bruker['liv'];
        if($Inviter == $brukernavn) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke invitere deg selv.</span></div>'; } else {
        if($LivetEr < '1') { echo '<div class="Div_MELDING"><span class="Span_str_5">'.$Inviter.' er død, du kan ikke invitere en død spiller.</span></div>'; } else {
      
        $SjekkOMLedig = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND DinJobb='$Oppgave'");
        if(mysql_num_rows($SjekkOMLedig) == '0') { 
        
        mysql_query("INSERT INTO `PlanlagtRanBrukere` (RanID,Brukernavn,DinJobb,StampInvitert,DatoInvitert,InvitertAv) VALUES ('$IdEr','$Inviter','$Oppgave','$tiden','$tid $nbsp $dato','$brukernavn')");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har invitert '.$Inviter.' som '.$Oppgave.'.</span></div>';
        } else {  echo '<div class="Div_MELDING"><span class="Span_str_5">Det er alt en spiller med denne oppgaven. eventuelt kast ut spilleren for å så invitere en ny en.</span></div>'; }}}
        }} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Ugyldig valg.</span></div>'; }
        }}} elseif(isset($_POST['action'])) { 
        $KastUt = mysql_real_escape_string($_POST['action']); 
        if(empty($KastUt)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må velge hvem du skal kaste ut.</span></div>'; } else {
      
        $Sjekk0Pers = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND Brukernavn='$KastUt'");
        if(mysql_num_rows($Sjekk0Pers) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Spilleren er ikke invitert eller med på ditt planlagte ran, ugyldig valg.</span></div>'; } else { 
        $Sjekk0Pers = mysql_fetch_assoc($Sjekk0Pers);
        $BrukerEr = $Sjekk0Pers['Brukernavn'];
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND Brukernavn='$BrukerEr'");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kastet ut '.$BrukerEr.'.</span></div>';
        }}} elseif(isset($_POST['actionman'])) {
        $Valg = mysql_real_escape_string($_POST['actionman']); 
        if($Valg == 'Avslutt') {
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$brukernavn' AND id='$IdEr'");
        header("Location: game.php?side=PlanlagtRan");
        } elseif($Valg == 'Start') {
        include "StartRan.php";
        }} 

        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Ran startet</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$RanInfo['DatoStartet'].".</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Forbrytere</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$ForbrytereMed."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Klarsignal</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$KlartEll</span></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">INVITER FORBRYTERE</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Brukernavn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"brukernavn\" maxlength=\"30\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Oppgave</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"ranvalg\"><option>Sjåfør</option><option>Våpenmann</option><option>Eksplosiv</option><option>Alarm ekspert</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Inviter').submit()\"><p class=\"pan_str_2\">INVITER</p></form></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">RAN MEDLEMMER</span><form method=\"post\" id=\"Soppel\"></div>
        <input type=\"hidden\" name=\"action\" id=\"du_valgte\">
        ";
        
      
        $HentMedlemmer = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        if(mysql_num_rows($HentMedlemmer) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Ingen brukere er er med på ranet, ingen er invitert heller.</span></div>'; } else {
        while($Rad = mysql_fetch_assoc($HentMedlemmer)) {
        if($Rad['ErMedEll'] == 'Ja') { $GG = 'er klar for ran'; } else { $GG = 'er ikke klar'; }
        $IDS = $Rad['Brukernavn'];
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">".$Rad['DinJobb']."</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Rad['Brukernavn']." $GG - <span onclick=\"document.getElementById('du_valgte').value='$IDS';document.getElementById('Soppel').submit()\"><B>(KAST UT)</B></span>.</span></div>
        ";
        }}
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</form><form method=\"post\" id=\"Svar\"></div>
        <input type=\"hidden\" name=\"actionman\" id=\"Svaraberg\">
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">START / AVSLUTT RANET</span></div>
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('Svaraberg').value='Start';document.getElementById('Svar').submit()\"><p class=\"pan_str_2\">START</p></div>
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('Svaraberg').value='Avslutt';document.getElementById('Svar').submit()\"><p class=\"pan_str_2\">AVSLUTT</p></div>
        </form></div>";
        
        }} 
        ?>

