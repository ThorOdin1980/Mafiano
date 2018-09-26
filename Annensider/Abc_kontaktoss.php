        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta"><form method="post" id="t">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">KONTAKT OSS</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/kontaktoss.jpg" width="490" height="200"></div>
        <?
        // Antibott
        $IdForumstart = $_SESSION['IdForumstart'];      
      
        $HentBott = mysql_query("SELECT * FROM AntibottEn WHERE id LIKE '%' ORDER BY RAND() LIMIT 1");
        $Antibott = mysql_fetch_assoc($HentBott);
        $_SESSION['IdForumstart'] = $Antibott['id'];
        // Antibott
        
        if(isset($_POST['navn'])) {
        $svar_GLEM = strtolower(mysql_real_escape_string($_POST['svar'])); 
        $navn_KON = mysql_real_escape_string($_POST['navn']);
        $epost_KON = mysql_real_escape_string($_POST['epost']);
        $gjelder_KON = mysql_real_escape_string($_POST['gjelder']);
        $melding_KON = mysql_real_escape_string($_POST['melding']);
        
        if(empty($svar_GLEM)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inne et svar til antibott spørsmålet.</span></div>'; } else {
        if(empty($IdForumstart)) { echo '<div class="Div_MELDING"><span class="Span_str_5">En feil har oppstått, prøv igjen.</span></div>'; } else { 
        $ID_BLIR = $IdForumstart;
      
        $SjekkBottSvar = mysql_query("SELECT * FROM AntibottEn WHERE id='$ID_BLIR'");
        if (mysql_num_rows($SjekkBottSvar) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">En feil har oppstått, prøv igjen 1.</span></div>';  } else {
        $SjekkSvarBott = mysql_fetch_assoc($SjekkBottSvar);
        $RiktigSvar = strtolower($SjekkSvarBott['Svar']);
        if($svar_GLEM != $RiktigSvar) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du svarte feil på antibott spørsmålet, riktig svar var: '.$RiktigSvar.'.</span></div>'; } else {
        if(empty($navn_KON) || empty($epost_KON) || empty($gjelder_KON) || empty($melding_KON)) { 
        echo '<div class="Div_MELDING">';
        if(empty($navn_KON)) { echo '<span class="Span_str_5">Du har glemt å skrive navnet ditt.</span>'; }
        if(empty($epost_KON)) { echo '<span class="Span_str_5">Du har glemt å skrive e-post adressen din.</span>'; }
        if(empty($gjelder_KON)) { echo '<span class="Span_str_5">Du har glemt å skrive hva dette gjelder.</span>'; }
        if(empty($melding_KON)) { echo '<span class="Span_str_5">Du har glemt å skrive selve meldingen.</span>'; }
        echo '</div>';
        } else { 
        function ValidateEmail($epost_KON) { if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i", $epost_KON)) {return 1; } else { return 0; }}
        if(ValidateEmail($epost_KON) == 1) { 
        $sonny_MAIL = "brudvik1990@gmail.com";
        mail($sonny_MAIL, $gjelder_KON, $melding_KON, "From: $epost_KON");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Meldingen er nå sendt.</span></div>';
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Dette er ikke en gyldig epost adresse.</span></div>'; }
        }}}}}}
        
        if(empty($navn_KON)) { $navn_VISES = ''; } else { $navn_VISES = $navn_KON; }
        if(empty($epost_KON)) { $epost_VISES = ''; } else { $epost_VISES = $epost_KON; }
        if(empty($gjelder_KON)) { $gjelder_VISES = ''; } else { $gjelder_VISES = $gjelder_KON; }
        if(empty($melding_KON)) { $melding_VISES = ''; } else { $melding_VISES = $melding_KON; }

        ?>

        <?
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$Antibott['Sporsmol']."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antibott svar</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"svar\" maxlength=\"30\" value=\"\"></div>
        ";
                
        
        ?>

        <div class="Div_venstre_side_1"><span class="Span_str_1">Ditt navn</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="navn" maxlength="70" value="<?=$navn_VISES;?>"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Din e-post</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="epost" maxlength="200" value="<?=$epost_VISES;?>"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Gjelder</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="gjelder" maxlength="50" value="<?=$gjelder_VISES;?>"></div>
        <div class="Div_venstre_side_2"></div>
        <div class="Div_hoyre_side_2"><textarea class="texterea" name="melding"><?=$melding_VISES;?></textarea></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('t').submit()"><p class="pan_str_2">SEND</p></div>
        </form></div>