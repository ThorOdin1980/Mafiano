        <?
        if(empty($DIN_SUBMIT_KNAPP)) { header("Location: index.php"); }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta"><form method="post" id="<?=$DIN_SUBMIT_KNAPP;?>">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">GLEMT PASSORD</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/ny_glemt_pass.jpg" width="490" height="200"></div>
        <?
        // Antibott
        session_start();
        $IdForumstart = $_SESSION['IdForumstart'];      
      
        $HentBott = mysql_query("SELECT * FROM AntibottEn WHERE id LIKE '%' ORDER BY RAND() LIMIT 1");
        $Antibott = mysql_fetch_assoc($HentBott);
        $_SESSION['IdForumstart'] = $Antibott['id'];
        // Antibott

        if(isset($_POST['email'])) {
      
        $IP_2KA = $_SERVER['REMOTE_ADDR'];
        $Bannlyst = mysql_query("SELECT * FROM IpBan WHERE IpAdresse='$IP_2KA' AND Tidslengde > '$tiden'");    
        if(mysql_num_rows($Bannlyst) >= '1') { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ip-adressen du bruker er bannlyst.</span></div>"; } else {
 
        $email_GLEM = mysql_real_escape_string($_POST['email']);
        $svar_GLEM = strtolower(mysql_real_escape_string($_POST['svar']));
                
        if(empty($svar_GLEM)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inne et svar til antibott spørsmålet.</span></div>'; } else {
        if(empty($IdForumstart)) { echo '<div class="Div_MELDING"><span class="Span_str_5">En feil har oppstått, prøv igjen.</span></div>'; } else { 
        $ID_BLIR = $IdForumstart;
        
      
        $SjekkBottSvar = mysql_query("SELECT * FROM AntibottEn WHERE id='$ID_BLIR'");
        if (mysql_num_rows($SjekkBottSvar) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">En feil har oppstått, prøv igjen.</span></div>';  } else {
        $SjekkSvarBott = mysql_fetch_assoc($SjekkBottSvar);
        $RiktigSvar = strtolower($SjekkSvarBott['Svar']);
        if($svar_GLEM != $RiktigSvar) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du svarte feil på antibott spørsmålet, riktig svar var: '.$RiktigSvar.'.</span></div>'; } else {
        if(empty($_POST['email'])) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å fylle inn e-post adresse feltet.</span></div>'; } else { 
        function ValidateEmail($email_GLEM) { if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i", $email_GLEM)) {return 1; } else { return 0; }}
        if(ValidateEmail($email_GLEM) == 1) { 
        
      
        $velg_fra = mysql_query("SELECT * FROM brukere WHERE email='$email_GLEM' AND liv >= '1'");
        if (mysql_num_rows($velg_fra) > '0') {  
        $rad_B = mysql_fetch_assoc($velg_fra);
        $passordet = $rad_B['passord'];
        $brukernavn = $rad_B['brukernavn'];
        $emailen = $rad_B['email'];
        $ipaddress_22 = $_SERVER['REMOTE_ADDR'];
        $db_passwordet_202_11 = md5($passordet);
        $db_passwordet_202_22 = md5($db_passwordet_202_11);
        $db_passwordet_202_33 = md5($db_passwordet_202_22);  
        $passordet_blir = substr($db_passwordet_202_33, 0, 8) . ''; 
        $passordet_db = md5($passordet_blir);

        $email_M = "Support@mafiano.no";
        $subject = "Glemt Passord";
        $message = "
        En fra følgende ip har bedt om nytt passord $ipaddress_22.
        
        Brukernavn: $brukernavn
        Nytt passord: $passordet_blir";
        mail($emailen, $subject, $message, "From: $email_M");
        mysql_query("UPDATE brukere SET passord='$passordet_db' WHERE email='$emailen' AND liv > '0'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Et nytt passord har nå blitt sendt til '.$emailen.'.</span></div>';
        
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Det eksisterer ingen levende brukere som er registrert på denne emailen.</span></div>';}
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Dette er ikke en gyldig epost adresse.</span></div>'; }
        }}}}}}}
        
        if(empty($email_GLEM)) { $email_VISES = ''; } else { $email_VISES = $email_GLEM; }
        ?>
        <div class="Div_MELDING">
        <span class="Span_str_0">Opplysninger</span><br>
        <span class="Span_str_8">1. Mafiano tar vare på informasjon om hvem som spør om nytt passord.</span>
        <span class="Span_str_8">2. Du kan kun tilbakestille passordet en gang i timen.</span>
        <span class="Span_str_8">3. Om du ikke mottar et nytt passord så kan du kontakte oss <a href="index.php?side=6IND"><font color="#908656">her</font></a>.</span>
        <span class="Span_str_8">&nbsp;</span>
        </div>
        
        <?
        
        if(empty($Antibott['Bilde']) || $Antibott['Bilde'] == 'Skriv url til et bilde hvis du skal stille spørsmål til et bilde.') { 
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Antibott['Sporsmol']."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott svar</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\" value=\"\"></div>
        ";
        
        } else { 
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Antibott['Sporsmol']."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bilde</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\"><a target=\"_blank\" href=\"".$Antibott['Bilde']."\">Klikk her for å se bilde</a></span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott svar</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\" value=\"\"></div>
        ";
        
        
        }
        
        
        ?>
        
        <div class="Div_venstre_side_1"><span class="Span_str_1">E-Post adresse</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="email" value="<?=$email_VISES;?>"></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('<?=$DIN_SUBMIT_KNAPP;?>').submit()"><p class="pan_str_2">SEND NYTT PASSORD</p></div>
        </form></div>