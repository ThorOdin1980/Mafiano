        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
        $dine_arbeidere = $din_hasj_biz['Arbeidere'] + $din_hasj_biz['Sysselsatte'];

        
        ?> 
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">DIN PLANTASJE</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/plantasje.jpg" width="490" height="200"></div>
        <?
        
        // Konto funksjon
        
        if(isset($_POST['konto_penger']) || isset($_POST['action'])) { 
        
        // FUNKSJON EN
        if(isset($_POST['konto_penger']) || isset($_POST['action'])) {
        $Summen_er = mysql_real_escape_string($_POST['konto_penger']);
        $ta_ut_eller = mysql_real_escape_string($_POST['action']);
        if(empty($Summen_er)) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inn en sum.</span></div>';
        } else { 
        $Summen_er = ereg_replace("[^0-9]", "", $Summen_er);
        $Summen_er = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$Summen_er);
        if(is_numeric($Summen_er)) { 
        if($Summen_er > '999999999') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Summen kan ikke være så stor.</span></div>';
        } else { 
        if($ta_ut_eller == 'sett_inn' || $ta_ut_eller == 'ta_ut') { 
        if($ta_ut_eller == 'sett_inn') { 
        if($Summen_er > $penger) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>';
        } else { 
        $ny_suM_cash = $penger - $Summen_er;
        $ny_suM_konto = floor($din_hasj_biz['konto'] + $Summen_er);
      
        mysql_query("UPDATE brukere SET penger='$ny_suM_cash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET konto='$ny_suM_konto' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har satt inn '.number_format($Summen_er, 0, ",", ".").' kroner i plantasje kontoen din.</span></div>';
        

        $plantasje_logg = $db->prepare("INSERT INTO `plantasje_logg` (`userid`, `username`, `sum`, `time`, `vei`) VALUES (:userid, :username, :sum, :time, :vei)");
        $plantasje_logg->bindValue(':userid', $_SESSION['id']);
        $plantasje_logg->bindValue(':username', $userinfo['brukernavn']);
        $plantasje_logg->bindValue(':sum', $Summen_er);
        $plantasje_logg->bindValue(':time', time());
        $plantasje_logg->bindValue(':vei', 'Inn');
        $plantasje_logg->execute();


        }} 
        elseif($ta_ut_eller == 'ta_ut') { 
        if($Summen_er > $din_hasj_biz['konto']) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger i plantasje kontoen.</span></div>';
        } else { 
        $ny_suM_cash = $penger + $Summen_er;
        $ny_suM_konto = floor($din_hasj_biz['konto'] - $Summen_er);
      
        mysql_query("UPDATE brukere SET penger='$ny_suM_cash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET konto='$ny_suM_konto' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har tatt ut '.number_format($Summen_er, 0, ",", ".").' kroner fra plantasje kontoen din.</span></div>';
       

        $plantasje_logg = $db->prepare("INSERT INTO `plantasje_logg` (`userid`, `username`, `sum`, `time`, `vei`) VALUES (:userid, :username, :sum, :time, :vei)");
        $plantasje_logg->bindValue(':userid', $_SESSION['id']);
        $plantasje_logg->bindValue(':username', $userinfo['brukernavn']);
        $plantasje_logg->bindValue(':sum', $Summen_er);
        $plantasje_logg->bindValue(':time', time());
        $plantasje_logg->bindValue(':vei', 'Ut');
        $plantasje_logg->execute();

        }}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Ugyldig post.</span></div>';
        }}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan kun bruke siffer i summen.</span></div>';
        }}}
        // FUNKSJON EN
        
        } 
        elseif(isset($_POST['flytt_arbeidere'])) { 
        
        // FUNKSJON TO
        if(isset($_POST['flytt_arbeidere'])) { 
        $antall_flytte = mysql_real_escape_string($_POST['flytt_arbeidere']);
        $flytte_fra = mysql_real_escape_string($_POST['flytt_arbeidere_1']);
        $flytte_til = mysql_real_escape_string($_POST['flytt_arbeidere_2']);
        if(empty($antall_flytte) || empty($flytte_fra) || empty($flytte_til)) {
        echo '<div class="Div_MELDING">';
        if(empty($antall_flytte)) { echo '<span class="Span_str_5">Du har ikke valgt hvor mange arbeidere du skal flytte.</span>'; }
        if(empty($flytte_fra)) { echo '<span class="Span_str_5">Du har ikke valgt hvor du skal flytte arbeiderene fra.</span>'; }
        if(empty($flytte_til)) { echo '<span class="Span_str_5">Du har ikke valgt hvor du skal flytte arbeiderene til.</span>'; }
        echo '</div>';        
        } else { 
        $antall_flytte = ereg_replace("[^0-9]", "", $antall_flytte);
        $antall_flytte = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall_flytte);
        if(is_numeric($antall_flytte)) { 
        if(strlen($antall_flytte) > '4') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Antall arbeidere du skal flytte kan ikke være så stort.</span></div>';
        } else {
        if($flytte_fra == 'Sysselsatte arbeidere' || $flytte_fra == 'Arbeidsløse arbeidere') {
        if($flytte_til == 'Sysselsatte arbeidere' || $flytte_til == 'Arbeidsløse arbeidere') {
        if($flytte_fra == $flytte_til) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt og flytte arbeidere til samme sted som de kommer fra, det fungerer ikke.</span></div>';
        } else {
        if($flytte_fra == 'Sysselsatte arbeidere') { $antall_arbeiere_flytte = $din_hasj_biz['Sysselsatte']; } 
        elseif($flytte_fra == 'Arbeidsløse arbeidere') { $antall_arbeiere_flytte = $din_hasj_biz['Arbeidere']; }
        if($antall_flytte > $antall_arbeiere_flytte) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke flytte flere arbeidere en du har.</span></div>';
        } else { 
        if($flytte_fra == 'Sysselsatte arbeidere') { 
        $ny_suM_sysselsatte = $din_hasj_biz['Sysselsatte'] - $antall_flytte;
        $ny_suM_arbeidere = $din_hasj_biz['Arbeidere'] + $antall_flytte;
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET Sysselsatte='$ny_suM_sysselsatte',Arbeidere='$ny_suM_arbeidere' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har flyttet '.$antall_flytte.' sysselsatte arbeidere over til arbeidsløse arbeidere.</span></div>';
        } 
        elseif( $flytte_fra == 'Arbeidsløse arbeidere') { 
        $ny_suM_sysselsatte = $din_hasj_biz['Sysselsatte'] + $antall_flytte;
        $ny_suM_arbeidere = $din_hasj_biz['Arbeidere'] - $antall_flytte;
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET Sysselsatte='$ny_suM_sysselsatte',Arbeidere='$ny_suM_arbeidere' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har flyttet '.$antall_flytte.' arbeidsløse arbeidere over til sysselsatte arbeidere.</span></div>';
        }}}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>';
        }} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>';
        }}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Antallet kan kun inneholde siffer.</span></div>';
        }}}
        // FUNKSJON TO
        
        }
        elseif(isset($_POST['Velg_vare'])) { 
        
        // FUNKSJON TRE
        if(isset($_POST['Velg_vare'])) { 
        $vare_er = mysql_real_escape_string($_POST['Velg_vare']);
        $antall_varer = mysql_real_escape_string($_POST['velg_antall_kjop']);
        if(empty($vare_er) || empty($antall_varer)) { 
        echo '<div class="Div_MELDING">';
        if(empty($vare_er)) { echo '<span class="Span_str_5">Du har ikke valgt hva du skal handle.</span>'; }
        if(empty($antall_varer)) { echo '<span class="Span_str_5">Du har ikke valgt antall kvadratmeter / arbeidere du skal handle.</span>'; }
        echo '</div>';
        } else { 
        if($vare_er == 'Tomt' || $vare_er == 'Arbeidere') { 
        $antall_varer = ereg_replace("[^0-9]", "", $antall_varer);
        $antall_varer = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$antall_varer);
        if(is_numeric($antall_varer)) { 
        if(strlen($antall_varer) > '6') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Antallet du skal handle kan ikke være så høyt.</span></div>';
        } else { 
        if($antall_varer > '10000') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Antallet du skal handle kan ikke være så høyt.</span></div>';
        } else {
        if($vare_er == 'Tomt') { 
        $pris_blir = '50000'; 
        $prisen_totalt = $pris_blir * $antall_varer;
        $nytt_antall_tomt = $din_hasj_biz['Tomt'] + $antall_varer;
        $ny_sum_konto = $din_hasj_biz['konto'] - $prisen_totalt;
        if($nytt_antall_tomt > '10000') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan maks ha 10.000 kvadratmeter.</span></div>';
        } else { 
        if($prisen_totalt > $din_hasj_biz['konto']) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger i plantasje kontoen din.</span></div>';
        } else { 
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE plantasje SET konto='$ny_sum_konto',Tomt='$nytt_antall_tomt' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt '.$antall_varer.' kvadratmeter for '.number_format($prisen_totalt, 0, ",", ".").' kroner.</span></div>';
        }}} elseif($vare_er == 'Arbeidere') { 
        $pris_blir = '20000'; 
        $prisen_totalt = $pris_blir * $antall_varer;
        $nytt_antall_arbeidere = $din_hasj_biz['Arbeidere'] + $din_hasj_biz['Sysselsatte'] + $antall_varer;
        $nytt_antall_arbeidere2 = $din_hasj_biz['Arbeidere'] + $antall_varer;
        $ny_sum_konto = $din_hasj_biz['konto'] - $prisen_totalt;
        if($nytt_antall_arbeidere > '10000') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan maks ha 10.000 arbeidere totalt.</span></div>';
        } else { 
        if($prisen_totalt > $din_hasj_biz['konto']) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger i plantasje kontoen din.</span></div>';
        } else { 
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE plantasje SET konto='$ny_sum_konto',Arbeidere='$nytt_antall_arbeidere2' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har ansatt '.$antall_varer.' arbeidere for '.number_format($prisen_totalt, 0, ",", ".").' kroner.</span></div>';
        }}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst prøv på nytt.</span></div>'; 
        }}}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Antallet du skal handle kan kunn inneholde siffer.</span></div>';
        }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan kunn velge mellom tomt og arbeidere.</span></div>';
        }}}
        // FUNKSJON TRE
        
        }
        elseif(isset($_POST['Velg_narko_selg_PP'])) { 
        
        // FUNKSJON FIRE
        if(isset($_POST['Velg_narko_selg_PP'])) { 
        $Valgt_narko_er = mysql_real_escape_string($_POST['Velg_narko_selg_PP']);
        $Valgt_antall_er = mysql_real_escape_string($_POST['velg_antall_narko_PP']);
        if(empty($Valgt_narko_er) || empty($Valgt_antall_er)) { 
        echo '<div class="Div_MELDING">'; 
        if(empty($Valgt_narko_er)) { echo '<span class="Span_str_5">Du har ikke valgt hva slags narkotika du skal selge.</span>'; }
        if(empty($Valgt_antall_er)) { echo '<span class="Span_str_5">Du har ikke valgt x antall narkotika du skal selge.</span>'; }
        echo '</div>'; 
        } else { 
        if($Valgt_narko_er == 'Kokain' || $Valgt_narko_er == 'Hasj' || $Valgt_narko_er == 'Marihuana' || $Valgt_narko_er == 'Heroin' || $Valgt_narko_er == 'Ecstasy') { 
        $Valgt_antall_er = ereg_replace("[^0-9]", "", $Valgt_antall_er);
        $Valgt_antall_er = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$Valgt_antall_er);
        if(is_numeric($Valgt_antall_er)) { 
        if($Valgt_antall_er >= '1000000000') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke selge så mye på en gang.</span></div>'; } else { 
        
        if($Valgt_narko_er == 'Kokain') { $Antall_narko_eier = floor($din_hasj_biz['Kokain']); $type_blir_da = 'Kokain'; $gange_med = '260'; } 
        elseif($Valgt_narko_er == 'Hasj') { $Antall_narko_eier = floor($din_hasj_biz['Hasj']); $type_blir_da = 'Hasj'; $gange_med = '149'; }
        elseif($Valgt_narko_er == 'Marihuana') { $Antall_narko_eier = floor($din_hasj_biz['Marihuana']); $type_blir_da = 'Marihuana'; $gange_med = '181'; }
        elseif($Valgt_narko_er == 'Heroin') { $Antall_narko_eier = floor($din_hasj_biz['Heroin']); $type_blir_da = 'Heroin'; $gange_med = '500'; }
        elseif($Valgt_narko_er == 'Ecstasy') { $Antall_narko_eier = floor($din_hasj_biz['Ecstasy']); $type_blir_da = 'Ecstasy'; $gange_med = '340'; }
        if($Valgt_antall_er > $Antall_narko_eier) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke selge mer '.$type_blir_da.' enn du eier.</span></div>'; } else { 
        $ny_sum_i_db = $Antall_narko_eier - $Valgt_antall_er;
        $penger_blir_hh = $Valgt_antall_er * $gange_med;
        $ny_sum_i_db_konto = $din_hasj_biz['konto'] + $penger_blir_hh;
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE plantasje SET $type_blir_da='$ny_sum_i_db',konto='$ny_sum_i_db_konto' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har solgt '.$Valgt_antall_er.' gram/tabeletter '.$type_blir_da.' for  '.number_format($penger_blir_hh, 0, ",", ".").' kroner.</span></div>';
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Antallet du skal selge kan kun inneholde siffer.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig valg.</span></div>'; }
        }}
        // FUNKSJON FIRE
        
        }

        

        
        









        if ($tiden > $din_hasj_biz['timestampen_prod']) { $tiden_over = '0'; } else { $tiden_over =  $din_hasj_biz['timestampen_prod'] - $tiden; }

        // Sjekker om du produserer narko
        if ($tiden > $din_hasj_biz['timestampen_prod'] && $din_hasj_biz['startet_prod'] == '0') {
        // Ny produserings tidKokain
        $prod_tid = $tiden + '36000';
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET startet_prod='1',timestampen_prod='$prod_tid' WHERE brukernavn='$brukernavn'"); 
        Header("Location: game.php?side=Plantasjen");
        }
        
        // Produser osv
        if ($tiden > $din_hasj_biz['timestampen_prod'] && $din_hasj_biz['startet_prod'] == '1') {
        $finner_ut_hvor_mye = $din_hasj_biz['Tomt'] / $din_hasj_biz['Sysselsatte'];
        if ($finner_ut_hvor_mye >= '0' ) { $gange = '0'; }
        if ($finner_ut_hvor_mye >= '0.2' ) { $gange = '2'; }
        if ($finner_ut_hvor_mye >= '0.4' ) { $gange = '4'; }
        if ($finner_ut_hvor_mye >= '0.6' ) { $gange = '4.6'; }
        if ($finner_ut_hvor_mye >= '0.8' ) { $gange = '4.8'; }
        if ($finner_ut_hvor_mye >= '1' ) {   $gange = '5'; }
        if ($finner_ut_hvor_mye >= '1.2' ) { $gange = '4.8'; }
        if ($finner_ut_hvor_mye >= '1.4' ) { $gange = '4.6'; }
        if ($finner_ut_hvor_mye >= '1.6' ) { $gange = '4.4'; }
        if ($finner_ut_hvor_mye >= '1.8' ) { $gange = '4.2'; }
        if ($finner_ut_hvor_mye >= '2' ) {   $gange = '4'; }
        if ($finner_ut_hvor_mye >= '2.2' ) { $gange = '3.8'; }
        if ($finner_ut_hvor_mye >= '2.4' ) { $gange = '3.6'; }
        if ($finner_ut_hvor_mye >= '2.6' ) { $gange = '3.4'; }
        if ($finner_ut_hvor_mye >= '2.8' ) { $gange = '3.2'; }
        if ($finner_ut_hvor_mye >= '3' ) {   $gange = '3'; }
        if ($finner_ut_hvor_mye >= '3.2' ) { $gange = '2.8'; }
        if ($finner_ut_hvor_mye >= '3.4' ) { $gange = '2.6'; }
        if ($finner_ut_hvor_mye >= '3.6' ) { $gange = '2.4'; }
        if ($finner_ut_hvor_mye >= '3.8' ) { $gange = '2.2'; }
        if ($finner_ut_hvor_mye >= '4' ) {   $gange = '2'; }
        if ($finner_ut_hvor_mye >= '4.2' ) { $gange = '1.8'; }
        if ($finner_ut_hvor_mye >= '4.4' ) { $gange = '1.6'; }
        if ($finner_ut_hvor_mye >= '4.6' ) { $gange = '1.4'; }
        if ($finner_ut_hvor_mye >= '4.8' ) { $gange = '1.2'; }
        if ($finner_ut_hvor_mye >= '5' ) {   $gange = '1'; }
        if ($finner_ut_hvor_mye >= '5.2' ) { $gange = '0.8'; }
        if ($finner_ut_hvor_mye >= '5.4' ) { $gange = '0.6'; }
        if ($finner_ut_hvor_mye >= '5.6' ) { $gange = '0.4'; }
        if ($finner_ut_hvor_mye >= '5.8' ) { $gange = '0.2'; }
        $narko_fordelt2 = $din_hasj_biz['Tomt'] * $gange;
        $narko_fordelt = floor($narko_fordelt2);
        $ny_sum_kokain = $din_hasj_biz['Kokain'] + $narko_fordelt;
        $ny_sum_hasj = $din_hasj_biz['Hasj'] + $narko_fordelt;
        $ny_sum_marihuana = $din_hasj_biz['Marihuana'] + $narko_fordelt;
        $ny_sum_heroin = $din_hasj_biz['Heroin'] + $narko_fordelt;
        $ny_sum_ecstasy = $din_hasj_biz['Ecstasy'] + $narko_fordelt;
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("UPDATE plantasje SET Kokain='$ny_sum_kokain',Hasj='$ny_sum_hasj',Marihuana='$ny_sum_marihuana',Heroin='$ny_sum_heroin',Ecstasy='$ny_sum_ecstasy',startet_prod='0' WHERE brukernavn='$brukernavn'") OR die(mysql_error());
        Header("Location: game.php?side=Plantasjen");
        }
        
        ?>
        <div class="Div_venstre_side_1"><form method="post" id="Plantasje_funksjon"><span class="Span_str_1">Arbeidsløse</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$din_hasj_biz['Arbeidere'];?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Sysselsatte</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$din_hasj_biz['Sysselsatte'];?></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Tomt</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$din_hasj_biz['Tomt'];?> kvadratmeter</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Produsering</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9">Produseringen er over innen <span id='tell'><?=$tiden_over;?></span> sekunder</span></div>
        
        <div class="Div_mellomledd ">&nbsp;</div>
        <div class="Div_innledning "><span class="Span_str_2">KONTO</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Konto-balanse</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=number_format($din_hasj_biz['konto'], 0, ",", ".");?> Kr</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Sum</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="konto_penger" maxlength="9" onKeyPress="return numbersonly(this, event)"><input type="hidden" name="action" id="du_valgte" /></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='sett_inn';document.getElementById('Plantasje_funksjon').submit()"><p class="pan_str_2">SETT INN</p></div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='ta_ut';document.getElementById('Plantasje_funksjon').submit()"><p class="pan_str_2">TA UT</p></div></form>
        
        <div class="Div_mellomledd ">&nbsp;<form method="post" id="Plantasje_funksjon_2"></div>
        <div class="Div_innledning "><span class="Span_str_2">FLYTT ARBEIDERE</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall arbeidere</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="flytt_arbeidere" maxlength="4" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Flytt fra</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="flytt_arbeidere_1" size="1"><option>Sysselsatte arbeidere</option><option>Arbeidsløse arbeidere</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Flytt til</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="flytt_arbeidere_2" size="1"><option>Sysselsatte arbeidere</option><option>Arbeidsløse arbeidere</option></select></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('Plantasje_funksjon_2').submit()"><p class="pan_str_2">FLYTT</p></div></form>
        
        <div class="Div_mellomledd">&nbsp;<form method="post" id="Plantasje_funksjon_3"></div>
        <div class="Div_innledning"><span class="Span_str_2">KJØP / ANSETT</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Velg</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="Velg_vare"><option value="Tomt">Tomt - Pris: 50.000 kr - Du har: <?=$din_hasj_biz['Tomt'];?></option><option value="Arbeidere">Arbeidere - Pris: 20.000 kr - Du har: <?=$dine_arbeidere;?></option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="velg_antall_kjop" maxlength="6" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('Plantasje_funksjon_3').submit()"><p class="pan_str_2">KJØP / ANSETT</p></div></form>
        
        <div class="Div_mellomledd">&nbsp;<form method="post" id="Plantasje_funksjon_4"></div>
        <div class="Div_innledning "><span class="Span_str_2">SELG NARKOTIKA</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Velg</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="Velg_narko_selg_PP">
        <option value="Kokain">Kokain - Salgsverdi: 260 kr - Du har: <?=number_format(floor($din_hasj_biz['Kokain']), 0, ",", ".");?> gram</option>
        <option value="Hasj">Hasj - Salgsverdi: 149 kr - Du har: <?=number_format(floor($din_hasj_biz['Hasj']), 0, ",", ".");?> gram</option>
        <option value="Marihuana">Marihuana - Salgsverdi: 181 kr - Du har: <?=number_format(floor($din_hasj_biz['Marihuana']), 0, ",", ".");?> gram</option>
        <option value="Heroin">Heroin - Salgsverdi: 500 kr - Du har: <?=number_format(floor($din_hasj_biz['Heroin']), 0, ",", ".");?> gram</option>
        <option value="Ecstasy">Ecstasy - Salgsverdi: 340 kr - Du har: <?=number_format(floor($din_hasj_biz['Ecstasy']), 0, ",", ".");?> tabeletter</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Antall</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="velg_antall_narko_PP" maxlength="10" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('Plantasje_funksjon_4').submit()"><p class="pan_str_2">SELG</p></div></form>
        </div>
        
        <?
        }
        ?>