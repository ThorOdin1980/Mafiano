    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?
    if(SjekkPlassering($brukernavn) == 'klar') { 

    $P_Eiendom = ""; $P_Utstyr = ""; $P_Bil = ""; $P_Fly = ""; $P_Bat = "";    
        
    if($_POST['du_valgte'] == 'Eiendom') { $P_Eiendom = PrintTeksten('Du kan redigere eiendom så fort du kan kjøpe eiendom.','2','Feilet','2'); } 
    elseif($_POST['du_valgte'] == 'Utstyr') {  
    $box = $_POST['box1']; $box_count = count($box);
    if($box_count > '1') { $P_Utstyr = PrintTeksten('Du kan kun velge et utstyr om gangen.','2','Feilet','2'); } else { 
    if($_POST['vUtstyr'] == 'nr:1' || $_POST['vUtstyr'] == 'nr:2' || $_POST['vUtstyr'] == 'nr:3') {  
    $Nummer = Bare_Siffer(Mysql_Klar($_POST['vUtstyr']));
    $VopenID = Dekrypt_Tall(Bare_Bokstaver($box['0']));
  
    $Sjekk = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND id='$VopenID'");
    if(mysql_num_rows($Sjekk) == 0) { $P_Utstyr = PrintTeksten('Du eier ikke det utstyret.','2','Feilet','2'); } else { 
    $Info = mysql_fetch_assoc($Sjekk);
    $Type = $Info['type'];
    $Utstyr = $Info['utstyr'];
    $Nr = $Info['forbruk_nr'];
    if($Nr == $Nummer) { $P_Utstyr = PrintTeksten("Du bruker alt dette som nr $Nr fra før av.",'2','Feilet','2'); } else { 
    $SjekkIgjen = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='$Type' AND forbruk_nr='$Nummer'");
    if(mysql_num_rows($SjekkIgjen) == '0') { 
  
    mysql_query("UPDATE vapen_beskyttelse SET forbruk_nr='$Nummer' WHERE brukernavn='$brukernavn' AND type='$Type' AND id='$VopenID'");
    $P_Utstyr = PrintTeksten("Du bruker nå $Utstyr som nr: $Nummer.",'2','Vellykket','2');
    } else { 
  
    mysql_query("UPDATE vapen_beskyttelse SET forbruk_nr='0' WHERE brukernavn='$brukernavn' AND type='$Type' AND forbruk_nr='$Nummer'");
    mysql_query("UPDATE vapen_beskyttelse SET forbruk_nr='$Nummer' WHERE brukernavn='$brukernavn' AND type='$Type' AND id='$VopenID'");
    $P_Utstyr = PrintTeksten("Du bruker nå $Utstyr som nr: $Nummer.",'2','Vellykket','2');
    }}}} else { $P_Utstyr = PrintTeksten('Du må velge hvilket nr utstyret skal bli brukt på.','2','Feilet','2'); }}
    }
    elseif($_POST['du_valgte'] == 'Bil') { 
    if($_POST['vBilValg'] == 'Selg') { 
    $box = $_POST['box2']; $box_count = count($box);
    if($box_count > '20') { $P_Bil = PrintTeksten('Maks 20 biler om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
    if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }} $Tjen = '0'; $TellPelle = '0'; $TellMazda = '0'; $HentBiler = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id IN ($Rader)");
    if(mysql_num_rows($HentBiler) == '0') { $P_Bil = PrintTeksten('Du har ikke valgt hvilke biler du skal selge.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentBiler)) { 
    if($SalgInfo['skade'] <= '0') { $skade = '0'; } else { $skade = $SalgInfo['skade']; } $verdi = bilens_verdi($SalgInfo['bilmerke']); $minus_prosenten = $verdi / '100' * $skade; $verdi = $verdi - $minus_prosenten; $Tjen = $Tjen + $verdi; $IdBlir = $SalgInfo['id'];
    if($SalgInfo['bilmerke'] == 'Mazda RX-8' && $SalgInfo['stjelt_fra'] == 'Hamar' && $SalgInfo['land'] == 'Oslo' && $oppdrag_nr == '1') { $TellMazda++; } mysql_query("DELETE FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id LIKE '$IdBlir'"); $TellePelle++; }
    if($TellMazda >= '1' && $oppdrag_nr == '1') { $TotaltFraktet = $OppdragNiva + $TellMazda;
    if($TotaltFraktet >= '7') { $NySumSpenn = floor($bank + '1000000'); $NyttOppdrag = $oppdrag_nr + '1'; $NyRanprosent = $rankpros + '0.4';  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$FullDato','Oppdrag','Du har fullført oppdraget for young guns, du har mottatt 1.000.000 kroner på bank-konten din.','Ja')");  mysql_query("UPDATE brukere SET rankpros='$NyRanprosent',bank='$NySumSpenn',oppdrag_nr='$NyttOppdrag',OppdragUtfort='Tony Casanabo 00 Abdulhai Shankman 00 Lee Jang 00' WHERE brukernavn='$brukernavn'"); } else { mysql_query("UPDATE brukere SET OppdragUtfort='$TotaltFraktet' WHERE brukernavn='$brukernavn'"); }} $NySumCash = floor($penger + $Tjen); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); $P_Bil = PrintTeksten("Du solgte $TellePelle bil/er for totalt ".number_format($Tjen, 0, ",", ".")." kr.",'2','Vellykket','2'); }}
    }
    elseif($_POST['vBilValg'] == 'Reparer') { 
    $box = $_POST['box2']; $box_count = count($box);
    if($box_count > '20') { $P_Bil = PrintTeksten('Maks 20 biler om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
    if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; } 
    }
    if($it_ma == '0') { $P_Bil = PrintTeksten('Du må velge bil/er','2','Feilet','2'); } else { $Kostnader = '0'; $TellPelle = '0'; $HentBiler = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id IN ($Rader)");
    if(mysql_num_rows($HentBiler) == '0') { $P_Bil = PrintTeksten('Du må velge bil/er.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentBiler)) { $verdi = bilens_verdi($SalgInfo['bilmerke']); $KosterDeg = $verdi / '100' * $SalgInfo['skade']; $Kostnader = $Kostnader + $KosterDeg; $TellPelle++; }
    if($Kostnader > $penger) { $P_Bil = PrintTeksten('Du har ikke nok penger kontant.','2','Feilet','2'); } else { mysql_query("UPDATE garage SET skade='0' WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id IN ($Rader)"); $NySumCash = floor($penger - $Kostnader); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); $P_Bil = PrintTeksten("Du har reparert $TellPelle bil/er, dette kostet deg ".number_format($Kostnader, 0, ",", ".")." kr.",'2','Vellykket','2'); }}}}
    }
    elseif($_POST['vBilValg'] == 'Vrak') { 
    $box = $_POST['box2']; $box_count = count($box);
    if($box_count > '20') { $P_Bil = PrintTeksten('Maks 20 biler om gangen.','2','Feilet','2'); } else { $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); mysql_query("DELETE FROM garage WHERE eier='$brukernavn' AND id='$dear'"); $it_ma++; }
    if($it_ma == '0') { $P_Bil = PrintTeksten('Du har ikke valg bil/er.','2','Feilet','2'); } else { $P_Bil = PrintTeksten("Du vraket $it_ma bil/er.",'2','Vellykket','2'); }
    }
    } elseif($_POST['vBilValg'] == 'Drammen' || $_POST['vBilValg'] == 'Lillehammer' || $_POST['vBilValg'] == 'Hamar' || $_POST['vBilValg'] == 'Alta' || $_POST['vBilValg'] == 'Bergen' || $_POST['vBilValg'] == 'Bodø' || $_POST['vBilValg'] == 'Oslo' || $_POST['vBilValg'] == 'Stavanger' || $_POST['vBilValg'] == 'Trondheim' || $_POST['vBilValg'] == 'Tromsø' || $_POST['vBilValg'] == 'Kristiansand' || $_POST['vBilValg'] == 'Sandefjord') { 
    $LandValgt = Mysql_Klar($_POST['vBilValg']);
    $box = $_POST['box2']; $box_count = count($box);
    if($box_count > '20') { $P_Bil = PrintTeksten('Du kan ikke frakte fler en 20 biler om gangen.','2','Feilet','2'); } else { 
    $Rader = ""; $it_ma = '0'; $Koster = '0'; $TellPelle = '0'; $Tiden_ferdig = $tiden + '600';
    foreach ($box as $dear) { $dear = Dekrypt_Tall($dear); $it_ma++; if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }}
  
    $HentBiler = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND land NOT LIKE '$LandValgt' AND TransportEll < '$tiden' AND id IN ($Rader)");
    if (mysql_num_rows($HentBiler) == '0') { $P_Bil = PrintTeksten('Bilene du skal frakte kan ikke befinne seg i samme land som de skal fraktes til.','2','Feilet','2'); } else { 
    while($SalgInfo = mysql_fetch_assoc($HentBiler)) { $TellPelle++; $Koster = $Koster + '1250'; }
    if($Koster > $penger) { $P_Bil = PrintTeksten("Du har ikke råd til å frakte $TellPelle bil/er til $LandValgt.",'2','Feilet','2'); } else {
    $NySumCash = floor($penger - $Koster);
    mysql_query("UPDATE garage SET TransportEll='$Tiden_ferdig',land='$LandValgt' WHERE eier='$brukernavn' AND TransportEll < '$tiden' AND id IN ($Rader)"); 
    mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
    $P_Bil = PrintTeksten("Du frakter  $TellPelle bil/er til $LandValgt, det kostet deg ".VerdiSum($Koster,'kr').". Når transporten er ferdig vil bilene bli synlige, det vil ta 10 minutter.",'2','Vellykket','2');
    }}}} else { $P_Bil = PrintTeksten('Du må velge hva som skal gjøres.','2','Feilet','2'); }
    }
    elseif($_POST['du_valgte'] == 'Fly') {
    if($_POST['vFlyValg'] == 'Selg') { 
    $box = $_POST['box3']; $box_count = count($box);
    if($box_count > '20') { $P_Fly = PrintTeksten('Maks 20 fly om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++; if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }} $Tjen = '0'; $TellPelle = '0';  $HentFly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' AND id IN ($Rader)");
    if(mysql_num_rows($HentFly) == '0') { $P_Fly = PrintTeksten('Du har ikke valgt hvilke fly du skal selge.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentFly)) { 
    if($SalgInfo['skade'] <= '0') { $skade = '0'; } else { $skade = $SalgInfo['Frakt_skade']; } $verdi = FlyVerdi($SalgInfo['Frakt_navn']) / '1.5'; $minus_prosenten = $verdi / '100' * $skade; $verdi = $verdi - $minus_prosenten; $Tjen = $Tjen + $verdi; }  $NySumCash = floor($penger + $Tjen); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("DELETE FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' AND id IN ($Rader)"); $P_Fly = PrintTeksten("Du solgte $TellePelle fly for totalt ".number_format($Tjen, 0, ",", ".")." kr.",'2','Vellykket','2'); }}
    }
    elseif($_POST['vFlyValg'] == 'Reparer') { 
    $box = $_POST['box3']; $box_count = count($box);
    if($box_count > '20') { $P_Fly = PrintTeksten('Maks 20 fly om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
    if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }}
    if($it_ma == '0') { $P_Fly = PrintTeksten('Du må velge fly.','2','Feilet','2'); } else { $Kostnader = '0'; $TellPelle = '0';  $HentFly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' AND id IN ($Rader)");
    if(mysql_num_rows($HentFly) == '0') { $P_Fly = PrintTeksten('Du må velge fly.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentFly)) { $verdi = FlyVerdi($SalgInfo['Frakt_navn']); $KosterDeg = $verdi / '100' * $SalgInfo['Frakt_skade']; $Kostnader = $Kostnader + $KosterDeg; $TellPelle++; }
    if($Kostnader > $penger) { $P_Fly = PrintTeksten('Du har ikke nok penger kontant.','2','Feilet','2'); } else { mysql_query("UPDATE fly_osv SET Frakt_skade='0' WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' AND id IN ($Rader)"); $NySumCash = floor($penger - $Kostnader); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); $P_Fly = PrintTeksten("Du har reparert $TellPelle fly, dette kostet deg ".number_format($Kostnader, 0, ",", ".")." kr.",'2','Vellykket','2'); }}}}
    }
    elseif($_POST['vFlyValg'] == 'Vrak') { 
    $box = $_POST['box3']; $box_count = count($box);
    if($box_count > '20') { $P_Fly = PrintTeksten('Maks 20 fly om gangen.','2','Feilet','2'); } else {
    $Rader = ""; $it_ma = '0'; 
    foreach ($box as $dear) { 
    $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
  
    mysql_query("DELETE FROM fly_osv WHERE Frakt_eier='$brukernavn' AND id LIKE '$dear'");
  
    mysql_query("DELETE FROM Undergrunn_varer WHERE varer_ligger_hos LIKE '$dear'"); }
    if($it_ma == '0') { $P_Fly = PrintTeksten('Du har ikke valgt fly.','2','Feilet','2'); } else { $P_Fly = PrintTeksten("Du vraket $it_ma fly.",'2','Vellykket','2'); }
    }} else { $P_Fly = PrintTeksten('Du må velge hva som skal gjøres.','2','Feilet','2'); }
    }
    elseif($_POST['du_valgte'] == 'Bat') { 
    if($_POST['vBatValg'] == 'Selg') { 
    $box = $_POST['box4']; $box_count = count($box);
    if($box_count > '20') { $P_Bat = PrintTeksten('Maks 20 båter om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++; if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }} $Tjen = '0'; $TellPelle = '0';  $HentBat = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' AND id IN ($Rader)");
    if(mysql_num_rows($HentBat) == '0') { $P_Bat = PrintTeksten('Du har ikke valgt hvilke båter du skal selge.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentBat)) { 
    if($SalgInfo['skade'] <= '0') { $skade = '0'; } else { $skade = $SalgInfo['Frakt_skade']; } $verdi = BatVerdi($SalgInfo['Frakt_navn']) / '1.5'; $minus_prosenten = $verdi / '100' * $skade; $verdi = $verdi - $minus_prosenten; $Tjen = $Tjen + $verdi; }  $NySumCash = floor($penger + $Tjen); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); mysql_query("DELETE FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' AND id IN ($Rader)"); $P_Bat = PrintTeksten("Du solgte $TellePelle båt/er for totalt ".number_format($Tjen, 0, ",", ".")." kr.",'2','Vellykket','2'); }}
    }
    elseif($_POST['vBatValg'] == 'Reparer') { 
    $box = $_POST['box4']; $box_count = count($box);
    if($box_count > '20') { $P_Bat = PrintTeksten('Maks 20 båter om gangen.','2','Feilet','2'); } else { $Rader = ""; $it_ma = '0'; foreach ($box as $dear) { $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
    if($it_ma == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }}
    if($it_ma == '0') { $P_Bat = PrintTeksten('Du må velge båt/er.','2','Feilet','2'); } else { $Kostnader = '0'; $TellPelle = '0';  $HentBat = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' AND id IN ($Rader)");
    if(mysql_num_rows($HentBat) == '0') { $P_Bat = PrintTeksten('Du må velge båt/er.','2','Feilet','2'); } else { while($SalgInfo = mysql_fetch_assoc($HentBat)) { $verdi = BatVerdi($SalgInfo['Frakt_navn']); $KosterDeg = $verdi / '100' * $SalgInfo['Frakt_skade']; $Kostnader = $Kostnader + $KosterDeg; $TellPelle++; }
    if($Kostnader > $penger) { $P_Bat = PrintTeksten('Du har ikke nok penger kontant.','2','Feilet','2'); } else { mysql_query("UPDATE fly_osv SET Frakt_skade='0' WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' AND id IN ($Rader)"); $NySumCash = floor($penger - $Kostnader); mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); $P_Bat = PrintTeksten("Du har reparert $TellPelle båt/er, dette kostet deg ".number_format($Kostnader, 0, ",", ".")." kr.",'2','Vellykket','2'); }}}}
    }
    elseif($_POST['vBatValg'] == 'Vrak') { 
    $box = $_POST['box4']; $box_count = count($box);
    if($box_count > '20') { $P_Bat = PrintTeksten('Maks 20 båter om gangen.','2','Feilet','2'); } else {
    $Rader = ""; $it_ma = '0'; 
    foreach ($box as $dear) { 
    $dear = Mysql_Klar($dear); $dear = Dekrypt_Tall($dear); $it_ma++;
  
    mysql_query("DELETE FROM fly_osv WHERE Frakt_eier='$brukernavn' AND id LIKE '$dear'");
  
    mysql_query("DELETE FROM Undergrunn_varer WHERE varer_ligger_hos LIKE '$dear'"); }
    if($it_ma == '0') { $P_Bat = PrintTeksten('Du har ikke valg båt/er.','2','Feilet','2'); } else { $P_Bat = PrintTeksten("Du vraket $it_ma båt/er.",'2','Vellykket','2'); }
    }} else { $P_Bat = PrintTeksten('Du må velge hva som skal gjøres.','2','Feilet','2'); }
    }

        
    if(empty($_POST['vEie'])) { $DD1 = 'Ingen'; $D1 = '<b>Eiendom:</b> Ingen'; } else { $D1 = "<b>Eiendom:</b> ".$_POST['vEie']; $DD1 = $_POST['vEie']; }
    if(empty($_POST['vUtstyr'])) { $DD2 = 'Ingen'; $D2 = '<b>Bruk utstyr:</b> Ingen'; } else { $D2 = "<b>Bruk utstyr:</b> ".$_POST['vUtstyr']; $DD2 = $_POST['vUtstyr']; }
    if(empty($_POST['vBilValg'])) { $DD3 = 'Ingen'; $D3 = '<b>Bil:</b> Ingen'; } else { $D3 = "<b>Bil:</b> ".$_POST['vBilValg']; $DD3 = $_POST['vBilValg']; }
    if(empty($_POST['vFlyValg'])) { $DD4 = 'Ingen'; $D4 = '<b>Fly:</b> Ingen'; } else { $D4 = "<b>Fly:</b> ".$_POST['vFlyValg']; $DD4 = $_POST['vFlyValg']; }
    if(empty($_POST['vBatValg'])) { $DD5 = 'Ingen'; $D5 = '<b>Båt:</b> Ingen'; } else { $D5 = "<b>Båt:</b> ".$_POST['vBatValg']; $DD5 = $_POST['vBatValg']; }

    echo "
    <div class=\"Div_masta\"><form method=\"post\" id=\"EiendomD\">
    <input type=\"hidden\" name=\"vEie\" id=\"vEie\" value=\"$DD1\"/>
    <input type=\"hidden\" name=\"vUtstyr\" id=\"vUtstyr\" value=\"$DD2\"/>
    <input type=\"hidden\" name=\"vBilValg\" id=\"vBilValg\" value=\"$DD3\"/>
    <input type=\"hidden\" name=\"vFlyValg\" id=\"vFlyValg\" value=\"$DD4\"/>
    <input type=\"hidden\" name=\"vBatValg\" id=\"vBatValg\" value=\"$DD5\"/>
    <input type=\"hidden\" name=\"du_valgte\" id=\"du_valgte\" value=\"\"/>
    ";


    echo "<table class=\"Rute_2\" id=\"Rute_2\"><tr><td class=\"R_0\" colspan=\"2\">EIENDOM</td></tr><tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/Eiendom-33.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/Eiendom-33.jpg\"></A></p></td></tr>";
    echo $P_Eiendom;
    echo "<tr><td class=\"R_4\">Eiendom</td><td class=\"R_4\">Skade</td></tr>";
    
  
    $Eiendom = mysql_query("SELECT * FROM Eiendom WHERE Eier='$brukernavn'");
    if(mysql_num_rows($Eiendom) >= '1') {  
    while($Inull = mysql_fetch_assoc($Eiendom)) {
    $FakeID = Krypt_Tall($Ifire['id']); 
    echo "<tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box0[]\" value=\"$FakeID\">".$Inull['Eiendom']." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$Inull['Land']." ]</font></td><td class=\"R_2\">".$Inull['Skade']."%</td></tr>";
    }}
    
    echo "
    <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisEie')\">
    <div id=\"Eiendom\">$D1</div>
    <div id=\"VisEie\" class=\"D_BoksTo\">
    <div class=\"D_Over\" onclick=\"VisValg('Eiendom','Selg','vEie')\">---> Selg eiendom</div>
    <div class=\"D_Over\" onclick=\"VisValg('Eiendom','Reparer','vEie')\">---> Reparer eiendom</div>
    <div class=\"D_Over\" onclick=\"VisValg('Eiendom','Vrak','vEie')\">---> Vrak eiendom</div>
    </div>
    </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Eiendom';document.getElementById('EiendomD').submit()\">OK</td></tr>
    </table><table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">VÅPEN / VERN</td></tr><tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/Vopen.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/Vopen.jpg\"></A></p></td></tr>";
    echo $P_Utstyr;
    echo "<tr><td class=\"R_4\">Utstyr</td><td class=\"R_4\">Trening</td></tr>";
    
  
    $Utstyr = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' ORDER BY `type`");
    if(mysql_num_rows($Utstyr) >= '1') {  
    while($Ien = mysql_fetch_assoc($Utstyr)) {
    $FakeID = Krypt_Tall($Ien['id']);
    if($Ien['type'] == '1') { $Tekst = $Ien['skytereningen']."%"; } else { $Tekst = "Trengs ikke"; }
    echo "<tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box1[]\" value=\"$FakeID\">".$Ien['utstyr']."</td><td class=\"R_2\">$Tekst</td></tr>";
    }}
    
    echo "
    <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisUtstyr')\">
    <div id=\"Bruk utstyr\">$D2</div>
    <div id=\"VisUtstyr\" class=\"D_BoksTo\">
    <div class=\"D_Over\" onclick=\"VisValg('Bruk utstyr','nr:1','vUtstyr')\">---> Bruk som nr:1</div>
    <div class=\"D_Over\" onclick=\"VisValg('Bruk utstyr','nr:2','vUtstyr')\">---> Bruk som nr:2</div>
    <div class=\"D_Over\" onclick=\"VisValg('Bruk utstyr','nr:3','vUtstyr')\">---> Bruk som nr:3</div>
    </div>
    </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Utstyr';document.getElementById('EiendomD').submit()\">OK</td></tr>
    </table></div>
    ";
    
    echo "<div class=\"Div_masta\"><table class=\"Rute_2\"><tr><td class=\"R_0\" colspan=\"2\">BILER</td></tr><tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/garage22.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/garage22.jpg\"></A></p></td></tr>";
    echo $P_Bil;
    echo "<tr><td class=\"R_4\">Biler</td><td class=\"R_4\">Skade</td></tr>";
    
    $ABiler = AntallSider($_REQUEST['Biler']);

  
    $Bil = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' ORDER BY `timestampen` DESC LIMIT $ABiler, 20");
    if (mysql_num_rows($Bil) >= '1') { 
    while ($Ito = mysql_fetch_assoc($Bil)) { 
    $FakeID = Krypt_Tall($Ito['id']);
    if($Ito['skade'] <= '0') { $Skade = '0%'; } else { $Skade = floor($Ito['skade'])."%"; }
    echo "<tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box2[]\" value=\"$FakeID\">".$Ito['bilmerke']." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$Ito['land']." ]</font></td><td class=\"R_2\">$Skade</td></tr>";
    }}
    
    $Bilo = mysql_query("SELECT * FROM garage WHERE eier='$brukernavn' AND TransportEll < '$tiden' ORDER BY `timestampen`");
    echo VisSideListeTo(mysql_num_rows($Bilo),"Eiendeler","Biler");
    
    echo "
    <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisBil')\">
    <div id=\"Bil\">$D3</div>
    <div id=\"VisBil\" class=\"D_BoksTo\">
    <div class=\"D_Over\" onclick=\"VisValg('Bil','Selg','vBilValg')\">---> Selg bil/er</div>
    <div class=\"D_Over\" onclick=\"VisValg('Bil','Reparer','vBilValg')\">---> Reparer bil/biler</div>
    <div class=\"D_Over\" onclick=\"VisValg('Bil','Vrak','vBilValg')\">---> Vrak bil/er</div>
    <div>---------------------------</div>
    <div>---> <b>1.250 kroner per bil</b></div>
    ";
    if($land != 'Drammen') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Drammen','vBilValg')\">---> Frakt til Drammen</div>"; }
    if($land != 'Lillehammer') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Lillehammer','vBilValg')\">---> Frakt til Lillehammer</div>"; }
    if($land != 'Hamar') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Hamar','vBilValg')\">---> Frakt til Hamar</div>"; }
    if($land != 'Alta') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Alta','vBilValg')\">---> Frakt til Alta</div>"; }
    if($land != 'Bergen') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Bergen','vBilValg')\">---> Frakt til Bergen</div>"; }
    if($land != 'Bodø') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Bodø','vBilValg')\">---> Frakt til Bodø</div>"; }
    if($land != 'Oslo') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Oslo','vBilValg')\">---> Frakt til Oslo</div>"; }
    if($land != 'Stavanger') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Stavanger','vBilValg')\">---> Frakt til Stavanger</div>"; }
    if($land != 'Trondheim') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Trondheim','vBilValg')\">---> Frakt til Trondheim </div>"; }
    if($land != 'Tromsø') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Tromsø','vBilValg')\">---> Frakt til Tromsø</div>"; }
    if($land != 'Kristiansand') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Kristiansand','vBilValg')\">---> Frakt til Kristiansand</div>"; }
    if($land != 'Sandefjord') { echo "<div class=\"D_Over\" onclick=\"VisValg('Bil','Sandefjord','vBilValg')\">---> Frakt til Sandefjord</div>"; }
    echo "
    </div>
    </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Bil';document.getElementById('EiendomD').submit()\">OK</td></tr>
    </table><table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">FLY</td></tr><tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/fly.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/fly.jpg\"></A></p></td></tr>";
    echo $P_Fly;
    echo "<tr><td class=\"R_4\">Fly</td><td class=\"R_4\">Skade</td></tr>";
    
  
    $Fly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '1' ORDER BY `Frakt_navn`");
    if(mysql_num_rows($Fly) >= '1') {  
    while($Itre = mysql_fetch_assoc($Fly)) {
    $FakeID = Krypt_Tall($Itre['id']);
    echo "<tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box3[]\" value=\"$FakeID\">".$Itre['Frakt_navn']." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$Itre['Frakt_sted']." ]</font></td><td class=\"R_2\">".$Itre['Frakt_skade']."%</td></tr>";
    }}
    
    echo "
    <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisFly')\">
    <div id=\"Fly\">$D4</div>
    <div id=\"VisFly\" class=\"D_BoksTo\">
    <div class=\"D_Over\" onclick=\"VisValg('Fly','Selg','vFlyValg')\">---> Selg fly</div>
    <div class=\"D_Over\" onclick=\"VisValg('Fly','Reparer','vFlyValg')\">---> Reparer fly</div>
    <div class=\"D_Over\" onclick=\"VisValg('Fly','Vrak','vFlyValg')\">---> Vrak fly</div>
    </div>
    </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Fly';document.getElementById('EiendomD').submit()\">OK</td></tr>
    </table><table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">BÅTER</td></tr><tr><td class=\"R_9\" colspan=\"2\"><p align=\"center\"><A class=thickbox title=\"\" href=\"../Bilder/bater.jpg\"><img style=\"max-width:236px; max-height: 136px;\" border=\"0\" src=\"../Bilder/bater.jpg\"></A></p></td></tr>";
    
    echo $P_Bat;

    echo "<tr><td class=\"R_4\">Båter</td><td class=\"R_4\">Skade</td></tr>";

  
    $Bat = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er LIKE '2' ORDER BY `Frakt_navn`");
    if(mysql_num_rows($Bat) >= '1') {  
    while($Ifire = mysql_fetch_assoc($Bat)) {
    $FakeID = Krypt_Tall($Ifire['id']); 
    echo "<tr><td class=\"R_1\"><input type=\"checkbox\" name=\"box4[]\" value=\"$FakeID\">".$Ifire['Frakt_navn']." <font style=\"color:#85a8bf; font-size:10px;\">[ ".$Ifire['Frakt_sted']." ]</font></td><td class=\"R_2\">".$Ifire['Frakt_skade']."%</td></tr>";
    }}

    echo "
    <tr><td class=\"R_1\" onclick=\"VisAlternativer('VisBat')\">
    <div id=\"Båt\">$D5</div>
    <div id=\"VisBat\" class=\"D_BoksTo\">
    <div class=\"D_Over\" onclick=\"VisValg('Båt','Selg','vBatValg')\">---> Selg båt</div>
    <div class=\"D_Over\" onclick=\"VisValg('Båt','Reparer','vBatValg')\">---> Reparer båt</div>
    <div class=\"D_Over\" onclick=\"VisValg('Båt','Vrak','vBatValg')\">---> Vrak båt</div>
    </div>
    </td><td class=\"R_7\" onclick=\"document.getElementById('du_valgte').value='Bat';document.getElementById('EiendomD').submit()\">OK</td></tr>
    </table>
    </form></div>
    ";
    
    }
    ?>