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
        include "priser_flyplass.php";
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">FLYPLASSEN</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Fly-1.jpg\"></div>
        ";

        $reise_sekunder_er = $reise_tid - $tiden;
        if($reise_tid > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente <span id="tell">'.$reise_sekunder_er.'</span> sekunder før du kan reise igjen.</span></div>'; } else { 
        if(isset($_POST['number'])) { 
        $valgt = mysql_real_escape_string($_POST['number']);
        if(empty($valgt)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å velge hvor du skal reise.</span></div>'; include "flyreise_html.php"; } else { 
        if($valgt == '1' || $valgt == '2' || $valgt == '3' || $valgt == '4' || $valgt == '5' || $valgt == '6' || $valgt == '7' || $valgt == '8' || $valgt == '9' || $valgt == '10' || $valgt == '11' || $valgt == '12') { 
        
        if($valgt == '1') { $prisen_blir = $flyplass_pris1; $reisested = 'Drammen'; if(date("i") > '04' && date("i") < '16') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '2') { $prisen_blir = $flyplass_pris2; $reisested = 'Lillehammer'; if(date("i") > '09' && date("i") < '21') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '3') { $prisen_blir = $flyplass_pris3; $reisested = 'Hamar'; if(date("i") > '14' && date("i") < '26') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '4') { $prisen_blir = $flyplass_pris4; $reisested = 'Alta'; if(date("i") > '19' && date("i") < '31') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '5') { $prisen_blir = $flyplass_pris5; $reisested = 'Bergen'; if(date("i") > '24' && date("i") < '36') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '6') { $prisen_blir = $flyplass_pris6; $reisested = 'Bodø'; if(date("i") > '29' && date("i") < '41') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '7') { $prisen_blir = $flyplass_pris7; $reisested = 'Oslo'; if(date("i") > '34' && date("i") < '46') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '8') { $prisen_blir = $flyplass_pris8; $reisested = 'Stavanger'; if(date("i") > '39' && date("i") < '51') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '9') { $prisen_blir = $flyplass_pris9; $reisested = 'Trondheim'; if(date("i") > '44' && date("i") < '56') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '10') { $prisen_blir = $flyplass_pris10; $reisested = 'Tromsø'; if(date("i") >= '50' || date("i") == '00') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '11') { $prisen_blir = $flyplass_pris11; $reisested = 'Kristiansand'; if(date("i") >= '55' || date("i") <= '05') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        elseif($valgt == '12') { $prisen_blir = $flyplass_pris12; $reisested = 'Sandefjord'; if(date("i") >= '00' && date("i") < '11') { $reise_ell = 'JA'; } else { $reise_ell = 'NEI'; }}
        if($reisested == $land) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du er i '.$reisested.' nå.</span></div>'; include "flyreise_html.php"; } else {
        if($reise_ell == 'JA') { 
        if($prisen_blir > $penger) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; include "flyreise_html.php"; } else { 
        $ny_sum_penger_blir = $penger - $prisen_blir;
        $ny_reise_ventetid = $tiden + '900';
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_penger_blir',land='$reisested',reise_tid='$ny_reise_ventetid',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har reist til '.$reisested.'.</span></div>';
        }} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Flyet til '.$reisested.' har ikke avreise nå.</span></div>'; }
        }} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke reise til et sted som ikke med i spillet.</span></div>'; include "flyreise_html.php"; }}} else { include "flyreise_html.php"; }}
        echo "</div>";
        }}}}}
        ?>