        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {
        
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }

        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">POKER</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/mangler_bilde.jpg\" width=\"490\" height=\"200\"></div>";
        
      
        $sjekk_om_du_spiller = mysql_query("SELECT * FROM Poker WHERE P_brukernavn='$brukernavn' LIMIT 1");
        if(mysql_num_rows($sjekk_om_du_spiller) > '0') { 
        include "Poker_spiller.php";
        } else { 
        if(isset($_POST['action'])) { 
        $var = Mysql_Klar($_POST['action']);
        if(empty($var)) { echo PrintTeksten("Ugyldig post.",'1','Feilet'); } else { 
      
        $Hent = mysql_query("SELECT * FROM Poker WHERE P_brukernavn LIKE '$var' AND P_brukernavn=`BordEier` AND Alle_Klare < '4'");
        if (mysql_num_rows($Hent) >= '1') {
        $r = mysql_fetch_assoc($Hent);
        if($r['P_satset'] > $penger) { echo PrintTeksten("Du har ikke nok penger på hånda.",'1','Feilet'); } else { 
        $ny_sum_spenn = $penger - $r['P_satset'];
        $Startet_Av = $r['BordEier'];
        $Ditt_kortbilde = array("Hjerter-ess","Hjerter-2","Hjerter-3","Hjerter-4","Hjerter-5","Hjerter-6","Hjerter-7","Hjerter-8","Hjerter-9","Hjerter-10","Hjerter-knekt","Hjerter-dron","Hjerter-konge","Klover-ess","Klover-2","Klover-3","Klover-4","Klover-5","Klover-6","Klover-7","Klover-8","Klover-9","Klover-10","Klover-knekt","Klover-dron","Klover-konge","Ruter-ess","Ruter-2","Ruter-3","Ruter-4","Ruter-5","Ruter-6","Ruter-7","Ruter-8","Ruter-9","Ruter-10","Ruter-knekt","Ruter-dron","Ruter-konge","Spar-ess","Spar-2","Spar-3","Spar-4","Spar-5","Spar-6","Spar-7","Spar-8","Spar-9","Spar-10","Spar-knekt","Spar-dron","Spar-konge");
        $rand_cards = array_rand($Ditt_kortbilde, 10);
        $kort_1 = $Ditt_kortbilde[$rand_cards[0]];
        $kort_2 = $Ditt_kortbilde[$rand_cards[1]];
        $kort_3 = $Ditt_kortbilde[$rand_cards[2]];
        $kort_4 = $Ditt_kortbilde[$rand_cards[3]];
        $kort_5 = $Ditt_kortbilde[$rand_cards[4]];
        $kort_6 = $Ditt_kortbilde[$rand_cards[5]];
        $kort_7 = $Ditt_kortbilde[$rand_cards[6]];
        $kort_8 = $Ditt_kortbilde[$rand_cards[7]];
        $kort_9 = $Ditt_kortbilde[$rand_cards[8]];
        $kort_10 = $Ditt_kortbilde[$rand_cards[9]];
        $kort_11 = $Ditt_kortbilde[$rand_cards[10]];
        
        $tid_1 = $tiden + '1';
        $tid_2 = $tiden + '2';
        $tid_3 = $tiden + '3';
        $tid_4 = $tiden + '4';
        $tid_5 = $tiden + '5';

      
        mysql_query("UPDATE Poker SET Alle_Klare=`Alle_Klare`+'1' WHERE P_brukernavn LIKE '$var' AND P_brukernavn=`BordEier`");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_1','$tid_1','$tid $nbsp $dato','$sum','JA','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_2','$tid_2','$tid $nbsp $dato','$sum','JA','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_3','$tid_3','$tid $nbsp $dato','$sum','JA','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_4','$tid_4','$tid $nbsp $dato','$sum','JA','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_5','$tid_5','$tid $nbsp $dato','$sum','JA','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_6','$tid_1','$tid $nbsp $dato','$sum','Nei','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_7','$tid_2','$tid $nbsp $dato','$sum','Nei','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_8','$tid_3','$tid $nbsp $dato','$sum','Nei','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_9','$tid_4','$tid $nbsp $dato','$sum','Nei','$Startet_Av')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_10','$tid_5','$tid $nbsp $dato','$sum','Nei','$Startet_Av')");

      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        header("Location: game.php?side=Poker");
        
        
        }} else { echo PrintTeksten("Ugyldig post.",'1','Feilet'); }
        }}elseif (isset($_POST['sats_POKER'])) { 
        $sum = rengjor_tall(mysql_real_escape_string($_POST['sats_POKER']));
        if(empty($sum)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har glemt å skrive inn en sum.</span></div>'; } else { 
        if($sum > '10000000000') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke satse så mye</span></div>'; } else {
        if($sum > $penger) {  echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke satse mer penger en det du har ute på hånda.</span></div>'; } else {  
        if($sum < '100000') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke satse et beløp som er mindre en 100.00 kr.</span></div>'; } else {
        $ny_sum_spenn = $penger - $sum;
        $Ditt_kortbilde = array("Hjerter-ess","Hjerter-2","Hjerter-3","Hjerter-4","Hjerter-5","Hjerter-6","Hjerter-7","Hjerter-8","Hjerter-9","Hjerter-10","Hjerter-knekt","Hjerter-dron","Hjerter-konge","Klover-ess","Klover-2","Klover-3","Klover-4","Klover-5","Klover-6","Klover-7","Klover-8","Klover-9","Klover-10","Klover-knekt","Klover-dron","Klover-konge","Ruter-ess","Ruter-2","Ruter-3","Ruter-4","Ruter-5","Ruter-6","Ruter-7","Ruter-8","Ruter-9","Ruter-10","Ruter-knekt","Ruter-dron","Ruter-konge","Spar-ess","Spar-2","Spar-3","Spar-4","Spar-5","Spar-6","Spar-7","Spar-8","Spar-9","Spar-10","Spar-knekt","Spar-dron","Spar-konge");
        $rand_cards = array_rand($Ditt_kortbilde, 10);
        $kort_1 = $Ditt_kortbilde[$rand_cards[0]];
        $kort_2 = $Ditt_kortbilde[$rand_cards[1]];
        $kort_3 = $Ditt_kortbilde[$rand_cards[2]];
        $kort_4 = $Ditt_kortbilde[$rand_cards[3]];
        $kort_5 = $Ditt_kortbilde[$rand_cards[4]];
        $kort_6 = $Ditt_kortbilde[$rand_cards[5]];
        $kort_7 = $Ditt_kortbilde[$rand_cards[6]];
        $kort_8 = $Ditt_kortbilde[$rand_cards[7]];
        $kort_9 = $Ditt_kortbilde[$rand_cards[8]];
        $kort_10 = $Ditt_kortbilde[$rand_cards[9]];
        $kort_11 = $Ditt_kortbilde[$rand_cards[10]];
        
        $tid_1 = $tiden + '1';
        $tid_2 = $tiden + '2';
        $tid_3 = $tiden + '3';
        $tid_4 = $tiden + '4';
        $tid_5 = $tiden + '5';

      
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_1','$tid_1','$tid $nbsp $dato','$sum','JA','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_2','$tid_2','$tid $nbsp $dato','$sum','JA','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_3','$tid_3','$tid $nbsp $dato','$sum','JA','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_4','$tid_4','$tid $nbsp $dato','$sum','JA','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_5','$tid_5','$tid $nbsp $dato','$sum','JA','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_6','$tid_1','$tid $nbsp $dato','$sum','Nei','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_7','$tid_2','$tid $nbsp $dato','$sum','Nei','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_8','$tid_3','$tid $nbsp $dato','$sum','Nei','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_9','$tid_4','$tid $nbsp $dato','$sum','Nei','$brukernavn')");
        mysql_query("INSERT INTO `Poker` (P_brukernavn, P_kort, P_timestamp, P_dato, P_satset, P_ibruk, BordEier) VALUES ('$brukernavn','$kort_10','$tid_5','$tid $nbsp $dato','$sum','Nei','$brukernavn')");

      
        mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        header("Location: game.php?side=Poker");
        }}}}}

        
        echo "
        <div class=\"Div_venstre_side_1\"><form method=\"post\" id=\"SPILL_P\"><span class=\"Span_str_1\">Beløp</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"sats_POKER\" value=\"\" maxlength=\"20\" onKeyPress=\"return numbersonly(this, event)\"></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('SPILL_P').submit()\"><p class=\"pan_str_2\">START NY RUNDE</p></div></form>
        ";
      
        $Hent = mysql_query("SELECT DISTINCT P_brukernavn,BordEier,P_satset FROM Poker WHERE P_brukernavn=`BordEier` AND Alle_Klare < '4'");
        if (mysql_num_rows($Hent) >= '1') {  
        
        echo"
        <div class=\"Div_mellomledd\">&nbsp;</div><form method=\"post\" id=\"Poker\"><input type=\"hidden\" name=\"action\" id=\"Pokerbord\" /></form>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">POKER</span></div>
        ";
        
        $I = '0';
        while ($r = mysql_fetch_assoc($Hent)) { 
        $I++;
        $BrukAV = $r['BordEier'];
        $Inn = VerdiSum($r['P_satset'],'kr');
        $IdBlir = $r['P_brukernavn'];
        echo "
        <div class=\"Div_Porno\" onclick=\"document.getElementById('Pokerbord').value='$IdBlir';document.getElementById('Poker').submit()\">
        <span class=\"Span_str_8\">
        <b>Pokerbord $I</b> Bordet er startet av $BrukAV, bet beløp er $Inn.<br>
        </span><br>
        </div>
        "; }
        
        
        
        }
        
        
        }
        

        
        echo "</div>";
        
        }}}}
        ?>