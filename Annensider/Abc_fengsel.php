        
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=Bunker"); } else {
        
        $antall = mysql_real_escape_string($_REQUEST['s']);
        if (empty($antall)) { $antall = '0'; } else {
        if (is_numeric($antall)) { 
        $antall = ereg_replace("[^0-9]", "", $antall);
        $antall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall); 
        if ($antall > '1') { $antall = $antall - '1'; }
        } else { header("Location: game.php?side=Fengsel&s=0"); }}

        if($oppdrag_nr == '2') {      
        $Tony = substr($OppdragNiva, 0, 17);
        $Abdulhai = substr($OppdragNiva, 17, 21);
        $Lee = substr($OppdragNiva, 38, 11);
        $XxTony = ereg_replace("[^0-9]", "", $Tony);
        $XxAbdulhai = ereg_replace("[^0-9]", "", $Abdulhai);
        $XxLee = ereg_replace("[^0-9]", "", $Lee);
        $Tony = substr($Tony, 0, 13); 
        $Abdulhai = substr($Abdulhai, 0, 17);
        $Abdulhai2 = substr($Abdulhai, 0, 10);
        $Lee = substr($Lee, 0, 8);
        }
    
        ?>
        
        
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') {  
        
        include "Annensider/Abc_fengsel_sitterinne.php";
        
        } else {
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">FENGSEL</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/Fengsel.jpg" width="490" height="200"></div>
        <?

        if(isset($_POST['action'])) { 
        $handling = mysql_real_escape_string($_POST['action']);
        $fengsel_id_numb = mysql_real_escape_string($_POST['number']);
        if(empty($handling)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt om du skal kjøpe eller bryte ut personen.</span></div>'; } else {
        if(empty($fengsel_id_numb)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en spiller.</span></div>'; } else { 
        if($handling == 'bryt_ut' || $handling == 'kjop_ut') { 
        $tiden_vente = $bryt_ut_tiden - $tiden;
        $fengsel_id_numb = ereg_replace("[^0-9]", "", $fengsel_id_numb);
        $fengsel_id_numb = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$fengsel_id_numb);
        if($handling == 'bryt_ut') { 
        if ($bryt_ut_tiden > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente <span id="tell">'.$tiden_vente.'</span> sekunder før du kan bryte ut en spiller igjen.</span></div>'; } else { 
        if(is_numeric($fengsel_id_numb)) { 
        if($fengsel_id_numb == '0004' && $oppdrag_nr == '2' && $land == 'Bergen' && $XxTony < '25') {
        include "BrytTony.php";
        } 
        elseif($fengsel_id_numb == '0005' && $oppdrag_nr == '2' && $land == 'Alta' && $XxAbdulhai < '15') { 
        include "BrytAbdulhai.php";
        }
        elseif($fengsel_id_numb == '0006' && $oppdrag_nr == '2' && $land == 'Oslo' && $XxLee < '33') {
        include "BrytLee.php";
        } else {
        $fengsel_id_numb = $fengsel_id_numb / '521218';
      
        $hent_insatt_spiller2 = mysql_query("SELECT * FROM fengsel WHERE id LIKE '$fengsel_id_numb' AND timestamp_over > '$tiden'");
        if (mysql_num_rows($hent_insatt_spiller2) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Finner ikke spilleren du hadde tenkt til å bryte ut, kansje personen ikke lengere er i fengsel.</span></div>'; } else {
        $insatt_info2 = mysql_fetch_assoc($hent_insatt_spiller2);
        $brukernavn_insatt = $insatt_info2['brukernavn'];
        $land_insatt = $insatt_info2['land'];
        $kjop_ut_sum_insatt = $insatt_info2['kjop_ut_sum'];
        if($land == $land_insatt) { 
        if($brukernavn == $brukernavn_insatt) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke bryte deg selv ut.</span></div>'; } else { 
      
        $finn_personen = mysql_query("SELECT * FROM brukere WHERE aktivert='1' AND brukernavn='$brukernavn_insatt'");
        if (mysql_num_rows($finn_personen) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Spilleren du prøver å bryte ut er slettet.</span></div>'; } else {
        $spiller_insatt_info = mysql_fetch_assoc($finn_personen);
        $insatt_rank_nivaa = $spiller_insatt_info['rank_nivaa'];
        $insatt_Kjon = $spiller_insatt_info['Kjon'];
        include "Annensider/Abc_fengsel_bryt_ut2.php";
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">'.$brukernavn_insatt.' sitter ikke i fengselet i '.$land.', for å kunne bryte '.$brukernavn_insatt.' ut så må du være i samme by.</span></div>';
        }}}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst slutt å endre kildekoden, ugyldig valg.</span></div>';
        }}} else { 
        if(is_numeric($fengsel_id_numb)) { 
        if($fengsel_id_numb == '0004' && $oppdrag_nr == '2' && $land == 'Bergen' && $XxTony < '25') { echo '<div class="Div_MELDING"><span class="Span_str_5">Tony kan ikke kjøpes fri, spilleren soner livstid.</span></div>'; } 
        elseif($fengsel_id_numb == '0005' && $oppdrag_nr == '2' && $land == 'Alta' && $XxAbdulhai < '15') {  echo '<div class="Div_MELDING"><span class="Span_str_5">Abdulhai kan ikke kjøpes fri, spilleren soner livstid.</span></div>'; }
        elseif($fengsel_id_numb == '0006' && $oppdrag_nr == '2' && $land == 'Oslo' && $XxLee < '33') {  echo '<div class="Div_MELDING"><span class="Span_str_5">Lee kan ikke kjøpes fri, spilleren soner livstid.</span></div>'; } else {
        $fengsel_id_numb = $fengsel_id_numb / '521218';
      
        $hent_insatt_spiller = mysql_query("SELECT * FROM fengsel WHERE id LIKE '$fengsel_id_numb' AND timestamp_over > '$tiden'");
        if (mysql_num_rows($hent_insatt_spiller) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Finner ikke spilleren du prøver å kjøpe ut, kansje personen ikke lengere er i fengsel.</span></div>'; } else {  
        $insatt_info = mysql_fetch_assoc($hent_insatt_spiller);
        $brukernavn_insatt = $insatt_info['brukernavn'];
        $land_insatt = $insatt_info['land'];
        $sum_for_insatt = $insatt_info['kjop_ut_sum'];
        $sum_innstatt_2 = number_format($sum_for_insatt, 0, ",", ".");
        if($land == $land_insatt) { 
        if($brukernavn == $brukernavn_insatt) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke kjøpe deg selv ut av fengsel.</span></div>'; } else {
        if($sum_for_insatt > $penger) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; } else { 
        $ny_sum_spenn = $penger - $sum_for_insatt;
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("DELETE FROM fengsel WHERE brukernavn ='$brukernavn_insatt'") or die(mysql_error());
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn_insatt','$tiden','$tid $nbsp $dato','Kjøpt ut','$brukernavn kjøpte deg ut av fengselet i $land for $sum_innstatt_2 kroner..','Ja')");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du kjøpte ut '.$brukernavn_insatt.' for en sum på '.$sum_innstatt_2.' kroner.</span></div>';
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">'.$brukernavn_insatt.' sitter ikke i fengselet i '.$land.', for å kunne kjøpe '.$brukernavn_insatt.' ut så må du være i samme by.</span></div>'; }
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke endre kildekoden, ugyldig valg.</span></div>'; 
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke endre kildekoden, ugyldig valg.</span></div>'; }}}}
        
        ?>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Brukernavn</span><form method="post" id="UTFOR"></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Tatt for</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Straff</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Bailout</span></div>
        <div class="Div_bunn_4"><span class="Span_str_1">Merk</span></div>
        <?
                
        if($oppdrag_nr == '2' && $land == 'Bergen' && $XxTony < '25') { $Yey = '1'; } 
        elseif($oppdrag_nr == '2' && $land == 'Alta' && $XxAbdulhai < '15') { $Yey = '1'; }
        elseif($oppdrag_nr == '2' && $land == 'Oslo' && $XxLee < '33') { $Yey = '1'; } else { $Yey = '0'; }
        
      
        $fengsel_info_hent = mysql_query("SELECT * FROM fengsel WHERE id LIKE '%' AND land='$land' AND timestamp_over > '$tiden' ORDER BY `timestampen` DESC LIMIT $antall, 20");
        $Rader = mysql_num_rows($fengsel_info_hent) + $Yey;
        if($Rader == 0) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Det sitter ingen i fengselet i '.$land.' akuratt nå.</span></div>';
        } else {
        if($oppdrag_nr == '2' && $land == 'Bergen' && $XxTony < '25') { echo '<div class="Div_venstre_side_3">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($Tony).'">'.htmlspecialchars($Tony).'</a></div><div class="Div_venstre_side_3">&nbsp;&nbsp;Drap</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Livstid</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Ingen bailout</div><div class="Div_bunn_3"><input type="radio" value="0004" name="number"></div>'; }
        if($oppdrag_nr == '2' && $land == 'Alta' && $XxAbdulhai < '15') { echo '<div class="Div_venstre_side_3">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($Abdulhai).'">'.htmlspecialchars($Abdulhai2).'</a></div><div class="Div_venstre_side_3">&nbsp;&nbsp;Drap</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Livstid</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Ingen bailout</div><div class="Div_bunn_3"><input type="radio" value="0005" name="number"></div>'; }
        if($oppdrag_nr == '2' && $land == 'Oslo' && $XxLee < '33') { echo '<div class="Div_venstre_side_3">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($Lee).'">'.htmlspecialchars($Lee).'</a></div><div class="Div_venstre_side_3">&nbsp;&nbsp;Drap</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Livstid</div><div class="Div_venstre_side_3">&nbsp;&nbsp;Ingen bailout</div><div class="Div_bunn_3"><input type="radio" value="0006" name="number"></div>'; }
        
        $sjekka_ell = '0';
        while ($row = mysql_fetch_assoc($fengsel_info_hent)) { 
        $straff_tiden =  $row['timestamp_over'] - $tiden;
        $fake_id_2k = $row['id'] * '521218';
        $sjekka_ell++;
        if($sjekka_ell == '1') { $sjekka = 'checked'; } else { $sjekka = ''; }
        echo '
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<a href="game.php?side=Bruker&navn='.urlencode($row['brukernavn']).'">'.htmlspecialchars($row['brukernavn']).'</a></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;'.htmlspecialchars($row['tatt_for']).'</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;'.$straff_tiden.' sekunder</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;'.number_format($row['kjop_ut_sum'], 0, ",", ".").' kr</div>
        <div class="Div_bunn_3"><input type="radio" value="'.$fake_id_2k.'" '.$sjekka.' name="number"></div>
        ';
        }}
        ?>
        <?
        // Viser side lenker
        $hent_info = mysql_query("SELECT * FROM fengsel WHERE id LIKE '%' AND land='$land' AND timestamp_over > '$tiden'");
        $antall_rader = mysql_num_rows($hent_info);
        $antall_sider = $antall_rader / '20';
        if($antall_sider < '1') { $antall_sider = '0'; } else {
        echo '<div class="Div_MELDING">';
        $i = '0';
        while ($i <= $antall_sider) {
        $i++;
        $side_tall = '20' * $i;
        $side_tall = $side_tall - '20';
        echo '&nbsp;&nbsp;<a href="game.php?side=Fengsel&s='.$side_tall.'">['.$i.']</a>';
        }
        echo '</div>';
        }
        ?>
        <input type="hidden" name="action" id="du_valgte" />
        <div class="Div_submit_knapp_4" onclick="document.getElementById('du_valgte').value='bryt_ut';document.getElementById('UTFOR').submit()"><p class="pan_str_2">BRYT UT</p></div>
        <div class="Div_submit_knapp_4" onclick="document.getElementById('du_valgte').value='kjop_ut';document.getElementById('UTFOR').submit()"><p class="pan_str_2">KJØP UT</p></div>
        </div>
        <?
        // Lukker Toppen
        }}}}}
        ?>