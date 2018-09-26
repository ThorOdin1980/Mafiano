        <?
        if(SjekkPlassering($brukernavn) == 'klar') { 

        // Sjekker om du eier denne kf
        
        $KF_ID2 = mysql_real_escape_string($_REQUEST['valgt']);
        if(empty($KF_ID2)) { Header("Location: game.php?side=hoved"); } else { 
        $KF_ID = Dekrypt_Tall($KF_ID2);

      
        $KF_Hent = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Eier='$brukernavn' AND id='$KF_ID'");
        if(mysql_num_rows($KF_Hent) >= '1') { 
        $KF_INFO = mysql_fetch_assoc($KF_Hent);
        
        $Fabrikk_navn = $KF_INFO['KF_Fabrikk'];
        $Prod_stamp = $KF_INFO['KF_Prod_Stamp'];
        $Prod_nivaa = $KF_INFO['KF_Prod_Nivaa'];
        $Prod_pris = $KF_INFO['KF_Prod_Pris'];
        $Fabrikk_opprettet = $KF_INFO['KF_Opprettet_Dato'];
        $Fabrikk_opp_stamp = $KF_INFO['KF_Opprettet_Stamp'];
        $Tjent_totalt = $KF_INFO['KF_Tjent_Totalt'];
        $Brukt_totalt = $KF_INFO['KF_Brukt_Totalt'];
        $KF_kuler = $KF_INFO['KF_Kuler'];
        $KF_konto = $KF_INFO['KF_Konto'];
        $KF_gjeng = $KF_INFO['KF_Gjeng'];
        $KF_banner = $KF_INFO['KF_Banner'];
        $KF_sted = $KF_INFO['KF_Sted'];
        $Kulesalgspris = $KF_INFO['KF_SlagsPris'];
        $Bly_pris_kg = $KF_INFO['KF_bly_pris'];
        $Staal_pris_kg = $KF_INFO['KF_staal_pris'];
        $Krutt_pris_kg = $KF_INFO['KF_krutt_pris'];
        $Ditt_staal = $KF_INFO['KF_staal'];
        $Ditt_bly = $KF_INFO['KF_bly'];
        $Ditt_krutt = $KF_INFO['KF_krutt'];
        
        $tiden_seks_3ka = $KF_INFO['KF_Prod_Stamp'] - $tiden;
        
        $er_det_overskudd = $Tjent_totalt - $Brukt_totalt;
        
      
        if($Prod_nivaa == '1' && $er_det_overskudd > '100000000' && $KF_INFO['KF_AntallSalg'] > '100') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='2',KF_Prod_Pris='600',KF_bly_pris='98',KF_staal_pris='135',KF_krutt_pris='290' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        } 
        elseif($Prod_nivaa == '2' && $er_det_overskudd > '200000000' && $KF_INFO['KF_AntallSalg'] > '200') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='3',KF_Prod_Pris='500',KF_bly_pris='90',KF_staal_pris='130',KF_krutt_pris='280' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '3' && $er_det_overskudd > '300000000' && $KF_INFO['KF_AntallSalg'] > '300') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='4',KF_Prod_Pris='450',KF_bly_pris='87',KF_staal_pris='129',KF_krutt_pris='277' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '4' && $er_det_overskudd > '400000000' && $KF_INFO['KF_AntallSalg'] > '400') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='5',KF_Prod_Pris='400',KF_bly_pris='85',KF_staal_pris='120',KF_krutt_pris='270' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '5' && $er_det_overskudd > '500000000' && $KF_INFO['KF_AntallSalg'] > '500') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='6',KF_Prod_Pris='390',KF_bly_pris='80',KF_staal_pris='119',KF_krutt_pris='268' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '6' && $er_det_overskudd > '600000000' && $KF_INFO['KF_AntallSalg'] > '600') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='7',KF_Prod_Pris='370',KF_bly_pris='77',KF_staal_pris='115',KF_krutt_pris='267' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '7' && $er_det_overskudd > '700000000' && $KF_INFO['KF_AntallSalg'] > '700') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='8',KF_Prod_Pris='364',KF_bly_pris='73',KF_staal_pris='111',KF_krutt_pris='259' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '8' && $er_det_overskudd > '800000000' && $KF_INFO['KF_AntallSalg'] > '800') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='9',KF_Prod_Pris='363',KF_bly_pris='70',KF_staal_pris='105',KF_krutt_pris='255' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        elseif($Prod_nivaa == '9' && $er_det_overskudd > '900000000' && $KF_INFO['KF_AntallSalg'] > '900') { 
        mysql_query("UPDATE Kulefabrikker SET KF_Prod_Nivaa='10',KF_Prod_Pris='360',KF_bly_pris='67',KF_staal_pris='100',KF_krutt_pris='254' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato','Kulefabrikk','Fabrikken din gjør det bra og dine ingenører har funnet ut en måte som gjør produksjons prisen billigere. Fabrikken du kjøper råvarene hos er så takknemlig for at du handler så mye hos dem at de har senket prisene på råvarene.','Ja')");
        }
        
        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">DIN KULEFABRIKK</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/kf.jpg" width="490" height="200"></div>
        <?
        if(isset($_POST['action']) && $_POST['action'] == "Sett_inn") { 
        $summen = mysql_real_escape_string($_POST['summmen']);
        $summen = preg_replace("[^0-9]", "", $summen);
        $summen = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$summen);
        if(empty($summen)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive hvor mye du skal sette inn.</span></div>';
        } else { 
        if(is_numeric($summen)) { 
        if($summen > '1000000000') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan max sette inn 1 milliard kroner om gangen.</span></div>';
        } else { 
        if($summen > $penger) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>';
        } else { 
        $Ny_sum_konto = $KF_konto + $summen;
        $Ny_sum_bruker = $penger - $summen;
        $Ny_sum_konto_2 = floor($Ny_sum_konto);
        $Ny_sum_bruker_2 = floor($Ny_sum_bruker);
      
        mysql_query("UPDATE brukere SET penger='$Ny_sum_bruker_2',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE Kulefabrikker SET KF_Konto='$Ny_sum_konto_2' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har satt inn '.number_format($summen, 0, ",", ".").' kr.</span></div>';
        }}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vi tillater bare tallkombinasjoner.</span></div>';
        }}
        } 
        // her tar man ut penger
        elseif(isset($_POST['action']) && $_POST['action'] == "Ta_ut") { 
        $summen = mysql_real_escape_string($_POST['summmen']);
        $summen = preg_replace("[^0-9]", "", $summen);
        $summen = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$summen);
        if(empty($summen)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive hvor mye du skal ta ut.</span></div>';
        } else { 
        if(is_numeric($summen)) {
        if($summen > '1000000000') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan max ta ut 1 milliard kroner om gangen.</span></div>';
        } else { 
        if($summen > $KF_konto) {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke så mye penger i fabrikk kontoen din.</span></div>';
        } else { 
        $Ny_sum_konto = $KF_konto - $summen;
        $Ny_sum_bruker = $penger + $summen;
        $Ny_sum_konto_2 = floor($Ny_sum_konto);
        $Ny_sum_bruker_2 = floor($Ny_sum_bruker);
      
        mysql_query("UPDATE brukere SET penger='$Ny_sum_bruker_2',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE Kulefabrikker SET KF_Konto='$Ny_sum_konto_2' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har tatt ut '.number_format($summen, 0, ",", ".").' kr.</span></div>';
        }}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vi tillater bare tallkombinasjoner.</span></div>';
        }}}
        
        if(isset($_POST['Firma_skjjj'])) { 
        $Firma_3k = mysql_real_escape_string($_POST['Firma_skjjj']);
        $Bilde_3k = mysql_real_escape_string($_POST['Bilde']);
        $Gjeng_3k = mysql_real_escape_string($_POST['Gjeng']);
        $Salgspris_3k = mysql_real_escape_string($_POST['Salgspris']);
        
        $Gjeng_3k = preg_replace("[^A-Za-z0-9 ]", "", $Gjeng_3k);
        $Firma_3k = preg_replace("[^A-Za-z0-9 ]", "", $Firma_3k);
        
        if(empty($Firma_3k) || empty($Bilde_3k) || empty($Salgspris_3k) || empty($Gjeng_3k)) { 
        echo '<div class="Div_MELDING">';
        if(empty($Firma_3k)) { echo '<span class="Span_str_5">Du har ikke skrevet inn et fabrikk navn.</span>'; }
        if(empty($Bilde_3k)) { echo '<span class="Span_str_5">Du har ikke skrevet inn en lenke til et bilde.</span>'; }
        if(empty($Gjeng_3k)) { echo '<span class="Span_str_5">Gjengnavnet kan ikke stå tomt, hvis du ikke vil ha den i en gjeng så skriver du "ingen".</span>'; }
        if(empty($Salgspris_3k)) { echo '<span class="Span_str_5">Du har ikke skrevet inn prisen for en kule.</span>'; }
        echo '</div>';
        } else { 
        if($Firma_3k == $Fabrikk_navn && $Bilde_3k == $KF_banner && $Salgspris_3k == $Kulesalgspris && $Gjeng_3k == $KF_gjeng) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke endret noe som helst.</span></div>';
        } else { 
        if(is_numeric($Salgspris_3k)) { 
        if($Salgspris_3k < '1') {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Salgspirsen kan ikke være under 1 krone.</span></div>';
        } else { 
        if($Salgspris_3k > '100000') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Salgspirsen kan ikke være over 100.000 kroner.</span></div>';
        } else { 
        if(strlen($Bilde_3k) > '200') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Bilde lenken kan maks ha 250 tegn/siffer/bokstaver.</span></div>';
        }elseif(strlen($Gjeng_3k) > '30') { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Gjengnavnet kan maks ha 30 siffer/bokstaver.</span></div>';
        } else { 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        echo '<div class="Div_MELDING">';
      
        if($Firma_3k != $Fabrikk_navn) { mysql_query("UPDATE Kulefabrikker SET KF_Fabrikk='$Firma_3k' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); echo '<span class="Span_str_6">Du har endret fabrikk navnet til '.$Firma_3k.'.</span>'; }
        if($Bilde_3k != $KF_banner) { mysql_query("UPDATE Kulefabrikker SET KF_Banner='$Bilde_3k' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); echo '<span class="Span_str_6">Du har endret bilde lenken.</span>'; }
        if($Gjeng_3k != $KF_gjeng) { mysql_query("UPDATE Kulefabrikker SET KF_Gjeng='$Gjeng_3k' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); echo '<span class="Span_str_6">Du har endret gjengnavnet.</span>'; }
        if($Salgspris_3k != $Kulesalgspris) { mysql_query("UPDATE Kulefabrikker SET KF_SlagsPris='$Salgspris_3k' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); echo '<span class="Span_str_6">Du har endret salgsprisen per kule til '.number_format($Salgspris_3k, 0, ",", ".").' kr.</span>'; }
        echo '</div>';
        }}}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Salgsprisen kan kun inneholde siffer.</span></div>';
        }}}}

        if(isset($_POST['handle_tba_aa'])) { 
        $Du_skal_ha_2k = mysql_real_escape_string($_POST['handle_tba_aa']);
        $Antall_du_skal_ha_2k = mysql_real_escape_string($_POST['antall_tba_aa']);
        if($Du_skal_ha_2k == 'Bly' || $Du_skal_ha_2k == 'Staal' || $Du_skal_ha_2k == 'Krutt') { 
        if($Antall_du_skal_ha_2k == '10' || $Antall_du_skal_ha_2k == '20' || $Antall_du_skal_ha_2k == '30' || $Antall_du_skal_ha_2k == '40' || $Antall_du_skal_ha_2k == '50' || $Antall_du_skal_ha_2k == '60' || $Antall_du_skal_ha_2k == '70' || $Antall_du_skal_ha_2k == '80' || $Antall_du_skal_ha_2k == '90' || $Antall_du_skal_ha_2k == '2000' || $Antall_du_skal_ha_2k == '20000') { 
        
        if($Du_skal_ha_2k == 'Bly') { $prisen_blir = $Antall_du_skal_ha_2k * $Bly_pris_kg; $vare_er_ss = 'KF_bly'; $antall_fra_for = $Ditt_bly; $tekst_sssssss = 'bly'; }
        elseif($Du_skal_ha_2k == 'Staal') { $prisen_blir = $Antall_du_skal_ha_2k * $Staal_pris_kg; $vare_er_ss = 'KF_staal'; $antall_fra_for = $Ditt_staal; $tekst_sssssss = 'Stål'; }
        elseif($Du_skal_ha_2k == 'Krutt') { $prisen_blir = $Antall_du_skal_ha_2k * $Krutt_pris_kg; $vare_er_ss = 'KF_krutt'; $antall_fra_for = $Ditt_krutt; $tekst_sssssss = 'krutt'; }
        
        if($prisen_blir > $KF_konto) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger i fabrikk kontoen.</span></div>';
        } else { 
        
        $ny_sum_konto_bla = $KF_konto - $prisen_blir;
        $ny_sum_utgift_bla = $prisen_blir + $Brukt_totalt;
        $ny_sum_vare = $antall_fra_for + $Antall_du_skal_ha_2k;
        
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE Kulefabrikker SET KF_Konto='$ny_sum_konto_bla',KF_Brukt_Totalt='$ny_sum_utgift_bla',$vare_er_ss='$ny_sum_vare' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har kjøpt '.$Antall_du_skal_ha_2k.' kilo '.$tekst_sssssss.' for '.number_format($prisen_blir, 0, ",", ".").' kr.</span></div>';
        }} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst slutt å med å endre kildekodene, det fungerer ikke.</span></div>';
        }} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Vennligst slutt å med å endre kildekodene, det fungerer ikke.</span></div>';
        }}
        
        if(isset($_POST['summmen_produ'])) { 
        if($KF_INFO['KF_Prod_Stamp'] > $tiden) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke produsere kuler enda.</span></div>';
        } else { 
        $summmen_kuler = mysql_real_escape_string($_POST['summmen_produ']);
        $summmen_kuler = preg_replace("[^0-9]", "", $summmen_kuler);
        $summmen_kuler = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$summmen_kuler);
        if(empty($summmen_kuler)) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke skrevet inn hvor mange kuler du skal produsere.</span></div>';
        } else { 
        if($Prod_pris > $KF_konto) { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger i fabrikk kontoen til å starte produksjonen.</span></div>';
        } else {
        $Bly_trengs = $summmen_kuler * '0.015';
        $Krutt_trengs = $summmen_kuler * '0.035';
        $Stal_trengs = $summmen_kuler * '0.021';
        
        $ny_sum_konto = $KF_konto - $Prod_pris;
        $ny_sum_utgift = $Brukt_totalt + $Prod_pris;

        $ny_sum_krutt = $Ditt_krutt - $Krutt_trengs;
        $ny_sum_bly = $Ditt_bly - $Bly_trengs;
        $ny_sum_stal = $Ditt_staal - $Stal_trengs;
        $ny_sum_kuler = $KF_kuler + $summmen_kuler;
        $ny_prod_stamp = $tiden + '3600';
        
        if($Bly_trengs > $Ditt_bly || $Krutt_trengs > $Ditt_krutt || $Stal_trengs > $Ditt_staal) { 
        echo '<div class="Div_MELDING">';
        if($Bly_trengs > $Ditt_bly) { echo '<span class="Span_str_5">Du har ikke nok bly til å produsere kulene.</span>'; }
        if($Krutt_trengs > $Ditt_krutt) { echo '<span class="Span_str_5">Du har ikke nok krutt til å produsere kulene.</span>'; }
        if($Stal_trengs > $Ditt_staal) { echo '<span class="Span_str_5">Du har ikke nok stål til å produsere kulene.</span>'; }
        echo '</div>';
        } else { 
        
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE Kulefabrikker SET KF_Konto='$ny_sum_konto',KF_Brukt_Totalt='$ny_sum_utgift',KF_krutt='$ny_sum_krutt',KF_bly='$ny_sum_bly',KF_staal='$ny_sum_stal',KF_Kuler='$ny_sum_kuler',KF_Prod_Stamp='$ny_prod_stamp' WHERE KF_Eier='$brukernavn' AND id='$KF_ID'"); 
      
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har produsert '.number_format($summmen_kuler, 0, ",", ".").' kuler, det kostet '.number_format($Prod_pris, 0, ",", ".").' kroner for å starte produksjonen.</span></div>';
        }}}}}
        
        ?>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Informasjon</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><a href="game.php?side=DinKulefabrikk&valgt=<?=$KF_ID2;?>&Vis=Info">Her finner du litt informasjon om din kulefabrikk.</a></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Rediger</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><a href="game.php?side=DinKulefabrikk&valgt=<?=$KF_ID2;?>&Vis=Red">Her kan du redigere din kulefabrikk.</a></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Produksjon</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><a href="game.php?side=DinKulefabrikk&valgt=<?=$KF_ID2;?>&Vis=Prod">Her er selve kulelageret ditt, her skjer også produksjonen.</a></span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Bank-konto</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><a href="game.php?side=DinKulefabrikk&valgt=<?=$KF_ID2;?>&Vis=Bank">Her kan du sette inn samt ta ut penger fra fabrikk kontoen.</a></span></div>
        <?
        switch ($_GET['Vis']) {
        case "Info": include "Annensider/Din_kf_info.php"; break;
        case "Red": include "Annensider/Din_kf_red.php"; break;
        case "Prod": include "Annensider/Din_kf_prod.php"; break;
        case "Bank": include "Annensider/Din_kf_bank.php"; break;
        default: echo "";
        }
        ?>

        
        </div>
        <?
        } else { Header("Location: game.php?side=hoved"); }}
        }
        ?>