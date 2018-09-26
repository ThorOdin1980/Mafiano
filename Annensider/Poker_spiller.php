        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
        function StorstHond($i) {
        
        if(array_search('Royal straight flush', $i)) { $H = "Royal straight flush"; }
        elseif(array_search('Straight flush', $i)) { $H = "Straight flush"; }
        elseif(array_search('Fire like', $i)) { $H = "Fire like"; }
        elseif(array_search('Hus', $i)) { $H = "Hus"; }
        elseif(array_search('Flush', $i)) { $H = "Flush"; }
        elseif(array_search('Straight', $i)) { $H = "Straight"; }
        elseif(array_search('Tre like', $i)) { $H = "Tre like"; }
        elseif(array_search('To par', $i)) { $H = "To par"; }
        elseif(array_search('Et par', $i)) { $H = "Et par"; }
        elseif(array_search('Ingenting', $i)) { $H = "Ingenting"; } else { $H = "Ingenting"; }
        return $H;
        }
        $SpelL = mysql_fetch_assoc($sjekk_om_du_spiller);
        
      
        $Dealer = $SpelL['BordEier'];
        $Bordeier = mysql_query("SELECT * FROM Poker WHERE BordEier='$Dealer' AND P_brukernavn ='$Dealer' LIMIT 1");
        $Bord = mysql_fetch_assoc($Bordeier);
        $Satsen = $Bord['P_satset'];
           
        if(isset($_POST['action']) && $_POST['action'] == "VisKort" && $SpelL['Sta'] == 'Ja' && $Bord['Alle_Klare'] == '4') { 
        if($Bord['Alle_Klare'] == '4') { 
        $KortHolder = array('Ingenting');
      
        $It = mysql_query("SELECT DISTINCT P_brukernavn,Kortverdi FROM Poker WHERE BordEier LIKE '$Dealer'"); 
        while ($Im = mysql_fetch_assoc($It)) { $Var = $Im['Kortverdi']; array_push($KortHolder,$Var); }
        $Storst = StorstHond($KortHolder);
        $HentFolket = mysql_query("SELECT DISTINCT P_brukernavn,Kortverdi FROM Poker WHERE BordEier='$Dealer'");
        $HI = mysql_query("SELECT DISTINCT P_brukernavn,Kortverdi FROM Poker WHERE Kortverdi LIKE '$Storst'"); 
        $DIN = mysql_query("SELECT DISTINCT P_brukernavn,Kortverdi FROM Poker WHERE P_brukernavn LIKE '$brukernavn'"); 
        $DINO = mysql_fetch_assoc($DIN);
        $x_vinnere = mysql_num_rows($HI);

        if($x_vinnere == '4') { 
        $SumVis = VerdiSum($Satsen,'kr');
        while($Bl = mysql_fetch_assoc($HentFolket)) {
        $BRUKER = $Bl['P_brukernavn'];
      
        mysql_query("UPDATE brukere SET penger=`penger`+'$Satsen' WHERE brukernavn='$BRUKER'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Alle spillerene hadde lik kortverdi, du fikk tilbake $SumVis.','Ja')");
        }
        echo PrintTeksten("Alle spillerene hadde lik kortverdi, du har fått pengene tilbake.",'1',"Vellykket");
        }
        elseif($x_vinnere == '3') {
        $Sum = floor(($Satsen * '4') / '3');
        $SumVis = VerdiSum($Sum,'kr');
        while($Bl = mysql_fetch_assoc($HentFolket)) {
        $BRUKER = $Bl['P_brukernavn'];
        if($Bl['Kortverdi'] == $Storst) { 
      
        mysql_query("UPDATE brukere SET penger=`penger`+'$Sum' WHERE brukernavn='$BRUKER'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du og 2 andre hadde lik hånd, men du vant $SumVis','Ja')");
        } else { 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du tapte mot en høyere hånd.','Ja')");
        }}
        if($DINO['Kortverdi'] == $Storst) { echo PrintTeksten("Du vant sammen med to andre spillere.",'1',"Vellykket"); } else { echo PrintTeksten("Du tapte mot kortverdi: $Storst.",'1',"Feilet"); }
        }
        elseif($x_vinnere == '2') { 
        $Sum = floor(($Satsen * '4') / '2');
        $SumVis = VerdiSum($Sum,'kr');
        while($Bl = mysql_fetch_assoc($HentFolket)) {
        $BRUKER = $Bl['P_brukernavn'];
        if($Bl['Kortverdi'] == $Storst) { 
      
        mysql_query("UPDATE brukere SET penger=`penger`+'$Sum' WHERE brukernavn='$BRUKER'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du og en annen hadde lik hånd, men du vant $SumVis','Ja')");
        } else { 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du tapte mot en høyere hånd.','Ja')");
        }}
        if($DINO['Kortverdi'] == $Storst) { echo PrintTeksten("Du vant sammen med en annen spillere.",'1',"Vellykket"); } else { echo PrintTeksten("Du tapte mot kortverdi: $Storst.",'1',"Feilet"); }
        }
        elseif($x_vinnere == '1') { 
        $Sum = floor($Satsen * '4');
        $SumVis = VerdiSum($Sum,'kr');
        while($Bl = mysql_fetch_assoc($HentFolket)) {
        $BRUKER = $Bl['P_brukernavn'];
        if($Bl['Kortverdi'] == $Storst) { 
      
        mysql_query("UPDATE brukere SET penger=`penger`+'$Sum' WHERE brukernavn='$BRUKER'");
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du vant $SumVis','Ja')");
        } else { 
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$BRUKER','$tiden','$tid $nbsp $dato','Poker','Du tapte mot en høyere hånd.','Ja')");
        }}
        if($DINO['Kortverdi'] == $Storst) { echo PrintTeksten("Du hadde sterkest hånd på dette bordet, du vant.",'1',"Vellykket"); } else { echo PrintTeksten("Du tapte mot kortverdi: $Storst",'1',"Feilet"); }
        }

        }}
        elseif($SpelL['Sta'] == 'Nei') {
        if(isset($_POST['action']) && $_POST['action'] == "Kast") { 
        $box = $_POST['box1'];
        $box_count = count($box);
        if($box_count =='0') { echo PrintTeksten("Du har ikke valgt noen kort.",'1',"Feilet"); } else { 
        if($box_count > '5') { echo PrintTeksten("Du har merket fler en fem kort.",'1',"Feilet"); } else { 
        
        foreach ($box as $dear) {
        $dear = Dekrypt_Tall(Bare_Bokstaver($dear));
        if(is_numeric($dear)) { 
        mysql_query("DELETE FROM Poker WHERE P_brukernavn='$brukernavn' AND P_ibruk LIKE 'JA' AND Id LIKE '$dear'");
        mysql_query("UPDATE Poker SET P_ibruk='JA',Id='$dear' WHERE P_brukernavn='$brukernavn' AND P_ibruk LIKE 'Nei' LIMIT 1;");
        }}
        
      
        $HentKort = mysql_query("SELECT * FROM Poker WHERE P_brukernavn='$brukernavn' AND P_ibruk LIKE 'JA'");
        if(mysql_num_rows($HentKort) == '0') { echo PrintTeksten("Kan ikke hente ut dine kort, kontant MafiaNo Crew.",'1',"Feilet"); } else { 
        
        // Kort farger og kort verdier
        $Verdi = array();
        $Farge = array();
        while ($R = mysql_fetch_assoc($HentKort)) { 
        $Kort = $R['P_kort'];
        $str = explode('-', $Kort);
        $KortFarge = $str[0];
        $KortVerdi = $str[1];
        array_push($Verdi, $KortVerdi);
        array_push($Farge, $KortFarge);
        }
        sort($Verdi);

        // Sjekk om alle kortene har samme farge
        if($Farge['0'] == 'Hjerter' && $Farge['1'] == 'Hjerter' &&  $Farge['2'] == 'Hjerter' && $Farge['3'] == 'Hjerter' && $Farge['4'] == 'Hjerter') { $FargeLik = 'Ja'; } 
        elseif($Farge['0'] == 'Klover' && $Farge['1'] == 'Klover' &&  $Farge['2'] == 'Klover' && $Farge['3'] == 'Klover' && $Farge['4'] == 'Klover') { $FargeLik = 'Ja'; }
        elseif($Farge['0'] == 'Spar' && $Farge['1'] == 'Spar' &&  $Farge['2'] == 'Spar' && $Farge['3'] == 'Spar' && $Farge['4'] == 'Spar') { $FargeLik = 'Ja'; }
        elseif($Farge['0'] == 'Ruter' && $Farge['1'] == 'Ruter' &&  $Farge['2'] == 'Ruter' && $Farge['3'] == 'Ruter' && $Farge['4'] == 'Ruter') { $FargeLik = 'Ja'; }
        else { $FargeLik = 'Nei'; }

        // Royal straight flush
        if($FargeLik == 'Ja' && $Verdi['0'] == '9' && $Verdi['1'] == '10' && $Verdi['2'] == 'dron' && $Verdi['3'] == 'ess' && $Verdi['4'] == 'knekt' ) { $VerdiD = 'Royal straight flush'; echo PrintTeksten("Royal straight flush.",'1',"Vellykket"); }
        // Straight flush
        elseif($FargeLik == 'Nei' && $Verdi['0'] == '9' && $Verdi['1'] == '10' && $Verdi['2'] == 'dron' && $Verdi['3'] == 'ess' && $Verdi['4'] == 'knekt' ) { $VerdiD = 'Straight flush'; echo PrintTeksten("Straight flush.",'1',"Vellykket"); }
        // Fire Like
        elseif(($Verdi[1] == $Verdi[3]) && ($Verdi[1] == $Verdi[0] || $Verdi[1] == $Verdi[4])) { $VerdiD = 'Fire like'; echo PrintTeksten("Fire like.",'1',"Vellykket"); }
        // Hus
        elseif($Verdi[0] == $Verdi[1] && $Verdi[3] == $Verdi[4] && ($Verdi[0] == $kVerdi[2] || $Verdi[4] == $Verdi[2])) { $VerdiD = 'Hus'; echo PrintTeksten("Hus.",'1',"Vellykket"); }
        // Flush
        elseif($FargeLik == 'Ja') { $VerdiD = 'Flush'; echo PrintTeksten("Flush.",'1',"Vellykket"); }
        // Straight
        elseif($Verdi[0] == '5' && $Verdi[1] == '6' && $Verdi[2] == '7' && $Verdi[3] == '8' && $Verdi[4] == '9') { $VerdiD = 'Straight'; echo PrintTeksten("Straight.",'1',"Vellykket"); }
        // Tre like
        elseif($Verdi[0] == $Verdi[2] || $Verdi[1] == $Verdi[3] || $Verdi[2] == $Verdi[4]) { $VerdiD = 'Tre like'; echo PrintTeksten("Tre like.",'1',"Vellykket"); }
        // To par
        elseif(($Verdi[0] == $Verdi[1] && ($Verdi[2] == $Verdi[3] || $Verdi[3] == $Verdi[4])) || (($Verdi[0] == $Verdi[1] || $Verdi[1] == $Verdi[2]) && $Verdi[3] == $Verdi[4])) { $VerdiD = 'To par'; echo PrintTeksten("To par.",'1',"Vellykket"); }
        // Et par
        elseif($Verdi[0] == $Verdi[1] || $Verdi[1] == $Verdi[2] || $Verdi[2] == $Verdi[3] || $Verdi[3] == $Verdi[4]) { $VerdiD = 'Et par'; echo PrintTeksten("Et par.",'1',"Vellykket"); } else { $VerdiD = 'Ingenting'; echo PrintTeksten("Ingen kombinasjoner.",'1',"Feilet"); }
        
      
        mysql_query("UPDATE Poker SET Kortverdi='$VerdiD',Sta='Ja',Alle_Klare=`Alle_Klare`+'1' WHERE P_brukernavn='$brukernavn'");
        $skal_slettes = 'JAdada';        
        }
        
        }}}
        elseif(isset($_POST['action']) && $_POST['action'] == "Sta") { 
        
      
        $HentKort = mysql_query("SELECT * FROM Poker WHERE P_brukernavn='$brukernavn' AND P_ibruk LIKE 'JA'");
        if(mysql_num_rows($HentKort) == '0') { echo PrintTeksten("Kan ikke hente ut dine kort, kontant MafiaNo Crew.",'1',"Feilet"); } else { 
        
        // Kort farger og kort verdier
        $Verdi = array();
        $Farge = array();
        while ($R = mysql_fetch_assoc($HentKort)) { 
        $Kort = $R['P_kort'];
        $str = explode('-', $Kort);
        $KortFarge = $str[0];
        $KortVerdi = $str[1];
        array_push($Verdi, $KortVerdi);
        array_push($Farge, $KortFarge);
        }
        sort($Verdi);

        // Sjekk om alle kortene har samme farge
        if($Farge['0'] == 'Hjerter' && $Farge['1'] == 'Hjerter' &&  $Farge['2'] == 'Hjerter' && $Farge['3'] == 'Hjerter' && $Farge['4'] == 'Hjerter') { $FargeLik = 'Ja'; } 
        elseif($Farge['0'] == 'Klover' && $Farge['1'] == 'Klover' &&  $Farge['2'] == 'Klover' && $Farge['3'] == 'Klover' && $Farge['4'] == 'Klover') { $FargeLik = 'Ja'; }
        elseif($Farge['0'] == 'Spar' && $Farge['1'] == 'Spar' &&  $Farge['2'] == 'Spar' && $Farge['3'] == 'Spar' && $Farge['4'] == 'Spar') { $FargeLik = 'Ja'; }
        elseif($Farge['0'] == 'Ruter' && $Farge['1'] == 'Ruter' &&  $Farge['2'] == 'Ruter' && $Farge['3'] == 'Ruter' && $Farge['4'] == 'Ruter') { $FargeLik = 'Ja'; }
        else { $FargeLik = 'Nei'; }

        // Royal straight flush
        if($FargeLik == 'Ja' && $Verdi['0'] == '9' && $Verdi['1'] == '10' && $Verdi['2'] == 'dron' && $Verdi['3'] == 'ess' && $Verdi['4'] == 'knekt' ) { $VerdiD = 'Royal straight flush'; echo PrintTeksten("Royal straight flush.",'1',"Vellykket"); }
        // Straight flush
        elseif($FargeLik == 'Nei' && $Verdi['0'] == '9' && $Verdi['1'] == '10' && $Verdi['2'] == 'dron' && $Verdi['3'] == 'ess' && $Verdi['4'] == 'knekt' ) { $VerdiD = 'Straight flush'; echo PrintTeksten("Straight flush.",'1',"Vellykket"); }
        // Fire Like
        elseif(($Verdi[1] == $Verdi[3]) && ($Verdi[1] == $Verdi[0] || $Verdi[1] == $Verdi[4])) { $VerdiD = 'Fire like'; echo PrintTeksten("Fire like.",'1',"Vellykket"); }
        // Hus
        elseif($Verdi[0] == $Verdi[1] && $Verdi[3] == $Verdi[4] && ($Verdi[0] == $kVerdi[2] || $Verdi[4] == $Verdi[2])) { $VerdiD = 'Hus'; echo PrintTeksten("Hus.",'1',"Vellykket"); }
        // Flush
        elseif($FargeLik == 'Ja') { $VerdiD = 'Flush'; echo PrintTeksten("Flush.",'1',"Vellykket"); }
        // Straight
        elseif($Verdi[0] == '5' && $Verdi[1] == '6' && $Verdi[2] == '7' && $Verdi[3] == '8' && $Verdi[4] == '9') { $VerdiD = 'Straight'; echo PrintTeksten("Straight.",'1',"Vellykket"); }
        // Tre like
        elseif($Verdi[0] == $Verdi[2] || $Verdi[1] == $Verdi[3] || $Verdi[2] == $Verdi[4]) { $VerdiD = 'Tre like'; echo PrintTeksten("Tre like.",'1',"Vellykket"); }
        // To par
        elseif(($Verdi[0] == $Verdi[1] && ($Verdi[2] == $Verdi[3] || $Verdi[3] == $Verdi[4])) || (($Verdi[0] == $Verdi[1] || $Verdi[1] == $Verdi[2]) && $Verdi[3] == $Verdi[4])) { $VerdiD = 'To like'; echo PrintTeksten("To par.",'1',"Vellykket"); }
        // To par
        elseif($Verdi[0] == $Verdi[1] || $Verdi[1] == $Verdi[2] || $Verdi[2] == $Verdi[3] || $Verdi[3] == $Verdi[4]) { $VerdiD = 'Et par'; echo PrintTeksten("Et par.",'1',"Vellykket"); } else { $VerdiD = 'Ingenting'; echo PrintTeksten("Ingen kombinasjoner.",'1',"Feilet"); }
        
      
        mysql_query("UPDATE Poker SET Kortverdi='$VerdiD',Sta='Ja',Alle_Klare=`Alle_Klare`+'1' WHERE P_brukernavn='$brukernavn'");
        $skal_slettes = 'JAdada';
        }}
        
        }

        echo "<div class=\"Div_MELDING\"><form method=\"post\" id=\"Poker\"><input type=\"hidden\" name=\"action\" id=\"Valg\" />";
      
        $Dine_P_Kort = mysql_query("SELECT * FROM Poker WHERE P_brukernavn='$brukernavn' AND P_ibruk LIKE 'JA' ORDER BY `P_timestamp` ASC");
        $TellePelle = '0';
        while($DineKort = mysql_fetch_assoc($Dine_P_Kort)) { 
        $TellePelle++;
        $Id_eR = Krypt_Tall($DineKort['Id']);
        if($TellePelle == '1') { $mellomrom = "57.5"; } else { $mellomrom = "5"; }
        
        if($SpelL['Sta'] == 'Ja' || $skal_slettes == 'JAdada') { 
        echo '
        <div style="float:left; margin-left:'.$mellomrom.'px;">
        <img border="0" src="../kortstokk/HJERTER/'.$DineKort['P_kort'].'.jpg"></div>
        '; 
        } else { 
        echo '
        <div style="float:left; margin-left:'.$mellomrom.'px;">
        <img border="0" src="../kortstokk/HJERTER/'.$DineKort['P_kort'].'.jpg"><p align="center"><input style="" size="9" type="checkbox" name="box1[]" value="'.$Id_eR.'"></p></div>
        '; 
        
        }}
        
        echo "</div>";
        

        if(isset($_POST['action']) && $_POST['action'] == "VisKort" && $SpelL['Sta'] == 'Ja' && $Bord['Alle_Klare'] == '4') { 
      
        mysql_query("DELETE FROM Poker WHERE BordEier LIKE '$Dealer'") or die(mysql_error());
        } elseif(($SpelL['Sta'] == 'Ja' || $skal_slettes == 'JAdada') && $Bord['Alle_Klare'] == '4') {  echo "<div class=\"Div_submit_knapp_3\" onclick=\"document.getElementById('Valg').value='VisKort';document.getElementById('Poker').submit()\"><p class=\"pan_str_2\">VIS KORT</p></div></form>"; } 
        elseif($SpelL['Sta'] == 'Ja' || $skal_slettes == 'JAdada') { } else { echo "<div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('Valg').value='Kast';document.getElementById('Poker').submit()\"><p class=\"pan_str_2\">KAST VALGTE KORT</p></div><div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('Valg').value='Sta';document.getElementById('Poker').submit()\"><p class=\"pan_str_2\">STÅ</p></div></form>"; }
        
        }
        ?>