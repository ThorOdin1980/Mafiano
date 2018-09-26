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
       
        // Sjekker om du eier plantasje fra før av
        $plantasje_sjekk_om = mysql_query("SELECT * FROM plantasje WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($plantasje_sjekk_om) > '0') { $din_hasj_biz = mysql_fetch_assoc($plantasje_sjekk_om); include "plantasjen_din.php"; } else {
                

        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">PLANTASJEN</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/plantasje.jpg"></div>
        <?
        if($kjoonn == 'Gutt') { $ranken_du_ha = 'Lærling'; } else { $ranken_du_ha = 'Luremus'; }
        if(isset($_POST['action'])) {
        if($rank_niva < '2') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke høy nok rank.</span></div>'; } else { 
        if($penger < '500000') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke råd, det koster 500 hundre tusen kroner.</span></div>'; } else {
        $skade_kommer = $tiden + '250000';
        $ny_sum = $penger - '500000';
        mysql_query("UPDATE brukere SET penger='$ny_sum',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("INSERT INTO `plantasje` (brukernavn,startet,skade_kommer) VALUES ('$brukernavn','$tid $nbsp $dato','$skade_kommer')");
        header("Location: game.php?side=Plantasjen");
        }}}
        if ($rank_niva < '2') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må ha en høyere eller lik rank som '.$ranken_du_ha.' for å opprette en plantasje.</span></div>'; } else { 
        ?>
        <form method="post" id="Send"><input type="hidden" name="action" value="50" /><div class="Div_submit_knapp_3" onclick="document.getElementById('Send').submit()"><p class="pan_str_2">KJØP PLANTASJEN FOR 500.000 KR</p></div></form>
        <?
        }
        ?>
        </div>
        <?
        // Lukker Toppen
        }}}}}}
        ?>