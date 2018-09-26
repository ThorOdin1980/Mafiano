        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
        // Verdier
        $Tall_1 = '0'; // Din kort total sum
        $Tall_2 = '0'; // Dealer kort total sum
        $Tall_3 = '0';
        
        // Andre verdier
        $skal_slettes = 'NEI';
        $ess = 'ess';
        
        // Random verdier
        $RAND_Tall_1 = '0';
        $RAND_Tall_2 = '0';
        $RAND_Tall_3 = '0';
        
        // Finner ut hva kortet er i tallsum
        function Kortverdi($kortet_er){  
        $Sjekk_1 = ereg_replace("[^0-9]", "",$kortet_er);
        if($kortet_er == 'Hjerter-ess' || $kortet_er == 'Klover-ess' || $kortet_er == 'Spar-ess' || $kortet_er == 'Ruter-ess') { $verdi_paa_kort = '11'; } 
        elseif($kortet_er == 'Hjerter-knekt' || $kortet_er == 'Klover-knekt' || $kortet_er == 'Spar-knekt' || $kortet_er == 'Ruter-knekt') { $verdi_paa_kort = '10'; }
        elseif($kortet_er == 'Hjerter-dron' || $kortet_er == 'Klover-dron' || $kortet_er == 'Spar-dron' || $kortet_er == 'Ruter-dron') { $verdi_paa_kort = '10'; }
        elseif($kortet_er == 'Hjerter-konge' || $kortet_er == 'Klover-konge' || $kortet_er == 'Spar-konge' || $kortet_er == 'Ruter-konge') { $verdi_paa_kort = '10'; }
        elseif($Sjekk_1 == '2' || $Sjekk_1 == '3' || $Sjekk_1 == '4' || $Sjekk_1 == '5' || $Sjekk_1 == '6' || $Sjekk_1 == '7' || $Sjekk_1 == '8' || $Sjekk_1 == '9' || $Sjekk_1 == '10') { $verdi_paa_kort = $Sjekk_1; } else { $verdi_paa_kort = '0'; }
        $kortet_er = $verdi_paa_kort;
        return $kortet_er;
        }
        
        // Henter dine kort
      
        $Dine_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
        $Dealer_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
      
        // Henter dine og dealers ess kort
        $Dine_BJ_Kort_Ess = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' AND B_kort LIKE '%".$ess."%'");
        $Dealer_BJ_Kort_Ess = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' AND B_kort LIKE '%".$ess."%'");
        
        // Antall ess du og dealer har
        $Antall_ess_du_har = mysql_num_rows($Dine_BJ_Kort_Ess);
        $Antall_ess_dealer_har = mysql_num_rows($Dealer_BJ_Kort_Ess);
  
        // Henter antall kort det er
        $X_antall_kort_du_har = mysql_num_rows($Dine_BJ_Kort);
        $X_antall_kort_pc_har = mysql_num_rows($Dealer_BJ_Kort);
        
        // Henter total summen til kortene dine
        while($Dine_kort_sjekk = mysql_fetch_assoc($Dine_BJ_Kort)) { 
        $kortet_er = $Dine_kort_sjekk['B_kort']; 
        $sats_er = $Dine_kort_sjekk['B_satset']; 
        $staa_ell = $Dine_kort_sjekk['B_staa']; 
        $verdi_paa_kort = Kortverdi($kortet_er); 
        $Tall_1 = $Tall_1 + $verdi_paa_kort;
        }

        // Henter total summen til dealeren sine kort
        while($Dealer_kort_sjekk = mysql_fetch_assoc($Dealer_BJ_Kort)) {
        $kortet_er_2 = $Dealer_kort_sjekk['B_kort'];
        $verdi_paa_kort_2 = Kortverdi($kortet_er_2);
        $Tall_2 = $Tall_2 + $verdi_paa_kort_2;
        } 
        
        // Finner ut hvor mye du har i kortverdi
        if($Tall_1 > '21') { 
        while ($Antall_ess_du_har > $RAND_Tall_1) { 
        $RAND_Tall_1++;
        $Tall_1 = $Tall_1 - '10';
        if($Tall_1 <= '21') { break; }
        }}
        // MASTA KODE SLUTTER
        
        // Finner ut hvor mye dealeren har i kortverdi
        if($Tall_2 > '21') { 
        while ($Antall_ess_dealer_har > $RAND_Tall_2) { 
        $RAND_Tall_2++;
        $Tall_2 = $Tall_2 - '10';
        if($Tall_2 <= '21') { break; }
        }}
        // MASTA KODE SLUTTER
        
        if($staa_ell == 'JA') {
         
        if($Tall_2 == $Tall_1) {
        $ny_sum_spenn = floor($penger + $sats_er);
        echo '<div class="Div_MELDING"><span class="Span_str_6">Det ble push, du fikk tilbake '.number_format($sats_er, 0, ",", ".").' kr.</span></div>';
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '$Tall_2', 'Push', '0')");
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA';
        }elseif($Tall_2 > '21') {
        $ny_sum_spenn_blir = floor($sats_er * '2'); 
        $ny_sum_spenn = floor($penger + $ny_sum_spenn_blir);
        echo '<div class="Div_MELDING"><span class="Span_str_6">Dealeren brøt, du vant '.number_format($ny_sum_spenn_blir, 0, ",", ".").' kr.</span></div>';
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '$Tall_2', 'Dealeren brøt', '$ny_sum_spenn_blir')");
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA';
        }elseif($Tall_2 > $Tall_1) { 
        echo '<div class="Div_MELDING"><span class="Span_str_6">Dealeren fikk '.$Tall_2.', du tapte '.number_format($sats_er, 0, ",", ".").' kr.</span></div>';
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '$Tall_2', 'Dealer vant', '0')");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA'; 
        }elseif($Tall_2 < $Tall_1) { 
        $ny_sum_spenn_blir = floor($sats_er * '2'); 
        $ny_sum_spenn = floor($penger + $ny_sum_spenn_blir);
        echo '<div class="Div_MELDING"><span class="Span_str_6">Dealeren fikk en lavere totalsum, du vant '.number_format($ny_sum_spenn_blir, 0, ",", ".").' kr.</span></div>';
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '$Tall_2', 'Dealer tapte', '$ny_sum_spenn_blir')");
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA'; }
        
        } else { 
        
        if($X_antall_kort_du_har == '2' && $X_antall_kort_pc_har == '2' && $Tall_1 == '21') {
        $ny_sum_spenn_blir = floor($sats_er * '3'); 
        $ny_sum_spenn = floor($penger + $ny_sum_spenn_blir);
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk 21 på første forsøk, du vant '.number_format($ny_sum_spenn_blir, 0, ",", ".").' kr.</span></div>';
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '0', '21 på første trekk', '$ny_sum_spenn_blir')");
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA';
        } else { 
        
        if(isset($_POST['action'])) { 
        $du_valgte = mysql_real_escape_string($_POST['action']); 

        
        if($du_valgte == 'STA') {  

        if($Tall_2 >= $Tall_1) { 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
      
        mysql_query("UPDATE Blackjack SET B_staa='JA' WHERE B_brukernavn='$brukernavn'");
        header("Location: game.php?side=Blackjack");
        } else {
        
        // STARTER FUNKSJON EKSTRA KORT TIL DEALER
      
        $Hent_inn_ekstra_kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_ibruk LIKE 'NEI' ORDER BY `B_timestamp` ASC");
        while ($Dealer_fler_kort = mysql_fetch_assoc($Hent_inn_ekstra_kort)) { 
        $kortet_blir_2ka = $Dealer_fler_kort['B_kort'];
        $id_blir_2ka = $Dealer_fler_kort['id'];
        $verdi_paa_kort_2ka = Kortverdi($kortet_blir_2ka); 
        $Tall_2 = $Tall_2 + $verdi_paa_kort_2ka;
        mysql_query("UPDATE Blackjack SET B_ibruk='JA',B_dealer='JA' WHERE id='$id_blir_2ka'");
        
        if($Tall_2 > '21') { while ($Antall_ess_dealer_har > $RAND_Tall_2) { $RAND_Tall_2++; $Tall_2 = $Tall_2 - '10'; if($Tall_2 <= '21') { break; }}}
        if($Tall_2 > '21') {  if($kortet_blir_2ka == 'Hjerter-ess' || $kortet_blir_2ka == 'Klover-ess' || $kortet_blir_2ka == 'Spar-ess' || $kortet_blir_2ka == 'Ruter-ess') { $Tall_2 = $Tall_2 - '10'; }}        
        if($Tall_2 > $Tall_1 || $Tall_2 >= '21' || $Tall_2 == $Tall_1) { break; }}
        mysql_query("UPDATE Blackjack SET B_staa='JA' WHERE B_brukernavn='$brukernavn'");
        header("Location: game.php?side=Blackjack"); }
        // LUKKER FUNKSJON EKSTRA KORT TIL DEALER
        
        }elseif($du_valgte == 'VIDERE') { 
        
      
        $VELG_ETT_KORT_ID = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_ibruk LIKE 'NEI' ORDER BY `B_timestamp` ASC LIMIT 1");
        $VELG_ETT_KORT_ID = mysql_fetch_assoc($VELG_ETT_KORT_ID);
        $KORT_ID = $VELG_ETT_KORT_ID['id'];
        $KORT_BILDE = $VELG_ETT_KORT_ID['B_kort'];
        mysql_query("UPDATE Blackjack SET B_ibruk='JA',B_dealer='NEI' WHERE id='$KORT_ID'");
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        $verdi_paa_kortET_2 = Kortverdi($KORT_BILDE); 
        $Tall_1 = $Tall_1 + $verdi_paa_kortET_2;
        if($KORT_BILDE == 'Hjerter-ess' || $KORT_BILDE == 'Klover-ess' || $KORT_BILDE == 'Spar-ess' || $KORT_BILDE == 'Ruter-ess') { $Antall_ess_du_har = $Antall_ess_du_har + '1'; }
        if($Tall_1 > '21') { while ($Antall_ess_du_har > $RAND_Tall_1) { $RAND_Tall_1++; $Tall_1 = $Tall_1 - '10'; if($Tall_1 <= '21') { break; }}}
        
        // Sjekker om du får over 21
        if($Tall_1 > '21') {
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '0', 'Spiller brøt', '0')"); 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA';
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk over 21 og tapte '.number_format($sats_er, 0, ",", ".").' kr.</span></div>';
        }elseif($Tall_1 == '21') { 
        $ny_sum_spenn_blir = floor($sats_er * '3'); 
        $ny_sum_spenn = floor($penger + $ny_sum_spenn_blir);
       
        mysql_query("INSERT INTO BjLogg (Brukernavn, Dato, Stamp, Satset, DinSumKort, DealerSumKort, Svar, Gevinst) VALUES('$brukernavn', '$tid $nbsp $dato $nbsp $aar', '$tiden', '$sats_er', '$Tall_1', '0', 'Spiller fikk 21', '$ny_sum_spenn_blir')");
      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $skal_slettes = 'JA';
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du fikk 21, du vant '.number_format($ny_sum_spenn_blir, 0, ",", ".").' kr.</span></div>';
        }}}}}

        
        echo '
        <div class="Div_mellomledd">&nbsp;</div>
        <div class="Div_innledning"><span class="Span_str_2">DEALERS KORT</span></div>
        <div class="Div_MELDING">
        ';
        
        // Henter dealer og dine kort om igjen
      
        $Dine_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'NEI' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
        $Dealer_BJ_Kort = mysql_query("SELECT * FROM Blackjack WHERE B_brukernavn='$brukernavn' AND B_dealer LIKE 'JA' AND B_ibruk LIKE 'JA' ORDER BY `B_timestamp` ASC");
        
        // Viser kortene til dealer
        while ($Dealer_kort = mysql_fetch_assoc($Dealer_BJ_Kort)) { 
        $Tall_3++;
        if($Tall_3 == '2' && $X_antall_kort_pc_har == '2' && $staa_ell == 'NEI') { 
        echo '<img style="margin-left:5px;" border="0" src="../kortstokk/HJERTER/top_kort.jpg">'; } else { echo '<img style="margin-left:5px;" border="0" src="../kortstokk/HJERTER/'.$Dealer_kort['B_kort'].'.jpg">';
        }}

        echo '
        </div>
        <div class="Div_mellomledd">&nbsp;</div>
        <div class="Div_innledning"><span class="Span_str_2">DINE KORT</span></div>
        <div class="Div_MELDING">
        '; 
        
        // Viser dine kort
        while ($Dine_kort = mysql_fetch_assoc($Dine_BJ_Kort)) { 
        echo '<img style="margin-left:5px;" border="0" src="../kortstokk/HJERTER/'.$Dine_kort['B_kort'].'.jpg">';
        }
        
        echo "</div>";
        
        // Javascript varriabler
        $varIable_1 = "document.getElementById('BJ_VALG').value='STA';document.getElementById('SPILL_BJ').submit()";
        $varIable_2 = "document.getElementById('BJ_VALG').value='VIDERE';document.getElementById('SPILL_BJ').submit()";

        echo "
        <form method=\"post\" id=\"SPILL_BJ\"><input type=\"hidden\" name=\"action\" id=\"BJ_VALG\" />
        <div class=\"Div_submit_knapp_4\" onclick=\"$varIable_1\"><p class=\"pan_str_2\">STÅ</p></div>
        <div class=\"Div_submit_knapp_4\" onclick=\"$varIable_2\"><p class=\"pan_str_2\">NYTT KORT</p></form></div>
        ";

        // Skal du slette litt db ell
        if($skal_slettes == 'JA') {
      
        mysql_query("DELETE FROM Blackjack WHERE B_brukernavn = '$brukernavn'") or die(mysql_error());
        }




        
        
        }
        ?>