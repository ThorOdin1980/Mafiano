        <?
        if(SjekkPlassering($brukernavn) == 'klar') { 

        include "Annensider/Abc_utpressing_prosent.php"; 

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2 ">UTPRESSING</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/utpressing.jpg" width="490" height="200"></div>
        <?
        if ($tiden < $upressings_tid) { $tiden_vente_blir = $upressings_tid - $tiden; } else { $tiden_vente_blir = '0'; }
        if ($tiden < $upressings_tid) { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du må vente <span id="tell">'.$tiden_vente_blir.'</span> sekunder før du kan utføre utpressing igjen.</span>';
        echo '</div>';
        } else { 
        if (isset($_POST['action'])) { 
        $type_valgt = mysql_real_escape_string($_POST['action']);
        if(empty($type_valgt)) { 
        echo PrintTeksten("Formen mangler value.",'1',"Feilet");
        } else { 
        if($type_valgt == 'press_random' || $type_valgt == 'press_valgt') { 
        if($type_valgt == 'press_random') { 
        
        if($rank_niva <= '2') { $rank_nivaa_velge = $rank_niva; } else { 
        if($rank_niva >= '12') { $rank_nivaa_velge = '14'; } else { $rank_nivaa_velge = $rank_niva + '2'; 
        }}

        $velg_offer_presse = mysql_query("SELECT * FROM brukere WHERE aktivert='1' AND liv > '1' AND penger > '100' AND rank_nivaa <= '$rank_nivaa_velge' AND land='$land' ORDER BY RAND() LIMIT 1");
        $motakers_info = mysql_fetch_assoc($velg_offer_presse);
        $mottaker = $motakers_info['brukernavn'];
        $mottaker_liv = $motakers_info['liv'];
        $mottaker_penger = $motakers_info['penger'];
        $mottaker_type = $motakers_info['type'];
        $mottaker_rank = $motakers_info['rank_nivaa'];
        $mottaker_press_antall = $motakers_info['presse_antall'];
        $mottaker_kjon = $motakers_info['Kjon'];
        $mottaker_land = $motakers_info['land'];
        
        $utpressing_ny_tid = $tiden + '420';
        $nytt_antall_forsok = $utpresse_antall + '1';
        
        include "Annensider/Abc_utpressing_kode2.php"; 

        } else {
        if($type_valgt == 'press_valgt') {
        $press_en_spiller = mysql_real_escape_string($_POST['brukernavn']);
        if(empty($press_en_spiller)) {
        echo PrintTeksten("Du har ikke skrevet inn ett brukernavn.",'1',"Feilet");
        include "Annensider/Abc_form_utpressing.php"; 
        } else {
        $sjekk_mottaker = mysql_query("SELECT * FROM brukere WHERE brukernavn='$press_en_spiller'") or die(mysql_error());
        if (mysql_num_rows($sjekk_mottaker) == 0) { 
        echo PrintTeksten("Det eksisterer ingen brukere med brukernavnet $press_en_spiller.",'1',"Feilet");
        include "Annensider/Abc_form_utpressing.php"; 
        } else {
        $motakers_info = mysql_fetch_assoc($sjekk_mottaker);
        $mottaker = $motakers_info['brukernavn'];
        $mottaker_liv = $motakers_info['liv'];
        $mottaker_penger = $motakers_info['penger'];
        $mottaker_type = $motakers_info['type'];
        $mottaker_rank = $motakers_info['rank_nivaa'];
        $mottaker_press_antall = $motakers_info['presse_antall'];
        $mottaker_kjon = $motakers_info['Kjon'];
        $mottaker_land = $motakers_info['land'];

        $utpressing_ny_tid = $tiden + '420';
        $nytt_antall_forsok = $utpresse_antall + '1';
        
        include "Annensider/Abc_utpressing_kode1.php"; 
        }}}}} else { 
        echo PrintTeksten("Du kan ikke endre på valgt mulighetene.",'1',"Feilet");
        include "Annensider/Abc_form_utpressing.php"; 
        }}
        } else {
        include "Annensider/Abc_form_utpressing.php"; 
        }} ?> 
        </div>
        <?
        // Lukker Toppen
        }
        ?>