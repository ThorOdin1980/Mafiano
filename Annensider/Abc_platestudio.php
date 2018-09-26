        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown1() { var s=document.getElementById('tell1'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown1();",1000); }} window.onload = countDown1;
        function countDown2() { var s=document.getElementById('tell2'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown2();",1000); }} window.onload = countDown2;

		function startFunks() { countDown1(); countDown2(); }
		window.onload = startFunks;
        // --> 
        </script>
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
        
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }

        function fortjeneste($X_AntallSalg, $X_IntektPerSalg, $X_FirmaProd) { 
        if($X_FirmaProd == 'Hyperbeats Studio' || $X_FirmaProd == 'Alta Gruppen AS' || $X_FirmaProd == 'Myhrbraaten Musikk AS') { $GangeSum = '6'; } 
        elseif($X_FirmaProd == 'Lydverket' || $X_FirmaProd == 'Generalens Verk AS' || $X_FirmaProd == 'Cutting Edge Productions AS' || $X_FirmaProd == 'Lydproduksjon DA' || $X_FirmaProd == 'Karlbart AS') { $GangeSum = '9'; }
        elseif($X_FirmaProd == 'Gran Production' || $X_FirmaProd == 'Torkils Studio' || $X_FirmaProd == 'Mats Grønner' || $X_FirmaProd == 'Carambole Ltd' || $X_FirmaProd == 'Bandit Beats AS' || $X_FirmaProd == 'Stardust Productions' || $X_FirmaProd == 'Innspillings Studio' || $X_FirmaProd == 'Sandefjord Melodi AS') { $GangeSum = '10'; }
        elseif($X_FirmaProd == 'Cutting Music' || $X_FirmaProd == 'Marks M Records' || $X_FirmaProd == 'Lett Lyd AS' || $X_FirmaProd == 'DaVinci Studio' || $X_FirmaProd == 'Nidaros Studio' || $X_FirmaProd == 'Sunking DA' || $X_FirmaProd == 'Tone Reds DA' || $X_FirmaProd == 'Tromsø Platestudio') { $GangeSum = '11'; }
        elseif($X_FirmaProd == 'Pure Sound Records' || $X_FirmaProd == 'Killakrem Media' || $X_FirmaProd == 'Jallamekk Beats' || $X_FirmaProd == 'Max Grønner AS' || $X_FirmaProd == 'Bodhi Beats' || $X_FirmaProd == 'Vox Media As' || $X_FirmaProd == 'Kingzize AS' || $X_FirmaProd == 'Studio Vipslash' || $X_FirmaProd == 'Lindberg Lyd AS') { $GangeSum = '13'; }
        elseif($X_FirmaProd == 'Granberg Lyd' || $X_FirmaProd == 'Hyperklikk Studio' || $X_FirmaProd == 'Musikkloftet AS' || $X_FirmaProd == 'Lydbølgen') { $GangeSum = '7'; }
        elseif($X_FirmaProd == 'Lillehammer Media' || $X_FirmaProd == 'Musikk Utvikling DA' || $X_FirmaProd == 'Pure Music Production') { $GangeSum = '12'; }
        elseif($X_FirmaProd == 'Spanit NTG' || $X_FirmaProd == 'CC Platestudio' || $X_FirmaProd == 'Jamtrackz Records' || $X_FirmaProd == 'Vakk Musikk Production' || $X_FirmaProd == 'Studio Generations AS' || $X_FirmaProd == 'Kvålsvoll Audio Art & Production' || $X_FirmaProd == 'Dagfinn & Bernt AS') { $GangeSum = '14'; }
        elseif($X_FirmaProd == 'Deathrow Records' || $X_FirmaProd == 'Midtbakken Studio' || $X_FirmaProd == 'MO Platestudio') { $GangeSum = '16'; }
        elseif($X_FirmaProd == 'Mix Studio' || $X_FirmaProd == 'Bogen Studio' || $X_FirmaProd == 'Fabrikken Nedregate AS' || $X_FirmaProd == 'Studio 24' || $X_FirmaProd == 'Touchdown Music AS' || $X_FirmaProd == 'Lydproduksjon Tromsø AS') { $GangeSum = '8'; }
        elseif($X_FirmaProd == 'Gramo' || $X_FirmaProd == 'Abdu Raman Lyd') { $GangeSum = '5'; } else { $GangeSum = '8'; }
        $X_IntektPerSalgTo = $X_IntektPerSalg + $GangeSum;
        $Fortjenste = $X_AntallSalg * $X_IntektPerSalgTo;
        return $Fortjenste;
        }
        
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">BAND</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/PlateStudio.jpg\" width=\"490\" height=\"200\"></div>
        ";
        
        // Sjekker om du har høy nok rank
        if($rank_niva >= '0') { 
      
        $Band = mysql_query("SELECT * FROM Platestudio WHERE Brukernavn='$brukernavn'");
        if (mysql_num_rows($Band) > '0') { 
        $StudioInfo = mysql_fetch_assoc($Band);

        $OpptreInnen2 = $StudioInfo['GiUtSkiveStamp'] - '600';
        $StudId = $StudioInfo['Id'];
        
        
        // Fordel penger tjent
        $FordelSpenna = mysql_real_escape_string($_REQUEST['DinDelAvKaka']);
        if(!empty($FordelSpenna)) { 
        if($FordelSpenna == 'FordelUt') {
        if($StudioInfo['konto'] == '0') { 
        header("Location: game.php?side=Platestudio");
        } else { 
        $DinSum = $StudioInfo['konto'] / '2';
        $NySumPenger = $penger + $DinSum;
      
        mysql_query("UPDATE Platestudio SET konto='0' WHERE Id='$StudId'");
      
        mysql_query("UPDATE brukere SET penger='$NySumPenger',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $Meld = "Du tok ut femti prosent av det dere har tjent på å opptre, resten av pengene ble fordelt ut til bandmedlemmene. ".number_format($DinSum, 0, ",", ".")." kr ble plassert på hånda.";
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato $nbsp $aar','Band fordeling','$Meld','Ja')");
        header("Location: game.php?side=Platestudio");
        }} else { 
        $FordelSpenna = rengjor_tall($FordelSpenna);
        if(!empty($FordelSpenna)) { 
        $FordelSpenna = $FordelSpenna / '285292542';
      
        $SjekkPlate = mysql_query("SELECT * FROM PlatestudioPlater WHERE Id LIKE '$FordelSpenna'");
        if (mysql_num_rows($SjekkPlate) == '0') { header("Location: game.php?side=Platestudio"); } else {
        $HentInfo = mysql_fetch_assoc($SjekkPlate);
        $HentUtBlir = fortjeneste($HentInfo['AntallSalg'], $HentInfo['IntektPerSalg'], $HentInfo['FirmaProd']);
        $HentUtBlir = $HentUtBlir - $HentInfo['MinusSum'];
        if($HentUtBlir == '0') { 
        header("Location: game.php?side=Platestudio");
        } else {
        $HentUtBlir2 = $HentUtBlir / '2';
        $NySumSpenn = $penger + $HentUtBlir2;
        $NySumMinus = $HentUtBlir + $HentInfo['MinusSum'];
        $PlateBlirDa = $HentInfo['PlateNavn'];
      
        mysql_query("UPDATE PlatestudioPlater SET MinusSum='$NySumMinus' WHERE Id='$FordelSpenna'");
      
        mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        $Meld = "Du tok ut femti prosent av salgsfortjenesten til følgende plate: $PlateBlirDa, resten av pengene ble fordelt ut til bandmedlemmene. ".number_format($HentUtBlir2, 0, ",", ".")." kr ble plassert på hånda.";
      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$tiden','$tid $nbsp $dato $nbsp $aar','Platesalg','$Meld','Ja')");
        header("Location: game.php?side=Platestudio");
        }}}}}
        
        
        

        if(isset($_POST['PlateNavn']) && $StudioInfo['PlaterUtgitt'] < '12') {
        if($StudioInfo['GiUtSkiveStamp'] < $tiden) { 
        $PlateNavn = htmlspecialchars(mysql_real_escape_string($_POST['PlateNavn']));
        $PlateNavn = ereg_replace("[^A-Za-z0-9 ]", "", $PlateNavn);
        $PlateStudio = htmlspecialchars(mysql_real_escape_string($_POST['platestudio']));
        $AntallSanger = mysql_real_escape_string($_POST['antallsanger']);
        
        $AntallSanger = substr($AntallSanger, 0, 2);
        $AntallSanger = ereg_replace("[^0-9]", "", $AntallSanger);
          
        $PlateFirma = ereg_replace("[^A-Za-z ]", "", $PlateStudio);
        $PlateFirma = substr($PlateFirma, 0, -2);

        if(empty($PlateNavn) || empty($PlateStudio) || empty($AntallSanger)) { 
        echo "<div class=\"Div_MELDING\">";
        if(empty($PlateNavn)) { echo "<span class=\"Span_str_5\">Du har glemt å fylle inn platenavnet.</span>"; }
        if(empty($PlateStudio)) { echo "<span class=\"Span_str_5\">Du har ikke valgt et platestudio.</span>"; }
        if(empty($AntallSanger)) { echo "<span class=\"Span_str_5\">Du har ikke valgt antall låter det skal være på cden.</span>"; }
        echo "</div>";
        } else { 
        
        if($land == 'Drammen') { if($PlateStudio == 'Hyperbeats Studio - 6.000 kr' || $PlateStudio == 'Lydverket - 9.400 kr' || $PlateStudio == 'Gran Production - 10.000 kr' || $PlateStudio == 'Torkils Studio - 10.600 kr' || $PlateStudio == 'Cutting Music - 11.050 kr' || $PlateStudio == 'Pure Sound Records - 13.399 kr' || $PlateStudio == 'Killakrem Media - 13.500 kr' || $PlateStudio == 'Jallamekk Beats - 13.043 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }} 
        elseif($land == 'Lillehammer') { if($PlateStudio == 'Granberg Lyd - 7.000 kr' || $PlateStudio == 'Blue Studio DA - 7.400 kr' || $PlateStudio == 'Generalens Verk AS - 9.000 kr' || $PlateStudio == 'Marks M Records - 11.900 kr' || $PlateStudio == 'Lillehammer Media - 12.000 kr' || $PlateStudio == 'Spanit NTG - 14.600 kr' || $PlateStudio == 'Deathrow Records - 15.900 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Hamar') { if($PlateStudio == 'Max Grønner AS - 13.004 kr' || $PlateStudio == 'CC Platestudio - 13.510 kr' || $PlateStudio == 'Musikk Utvikling DA - 13.715 kr' || $PlateStudio == 'Jamtrackz Records - 14.000 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Alta') { if($PlateStudio == 'Alta Gruppen AS - 6.660 kr' || $PlateStudio == 'Mix Studio - 9.666 kr' || $PlateStudio == 'Lett Lyd AS - 11.000 kr' || $PlateStudio == 'Vakk Musikk Production - 14.420 kr' || $PlateStudio == 'Midtbakken Studio - 17.000 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Bergen') { if($PlateStudio == 'Hyperklikk Studio - 8.008 kr' || $PlateStudio == 'Bogen Studio - 9.000 kr' || $PlateStudio == 'Bodhi Beats - 12.044 kr' || $PlateStudio == 'Mats Grønner - 13.000 kr' || $PlateStudio == 'Vox Media As - 13.069 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Bodø') { if( $PlateStudio == 'Mix Studio - 9.666 kr' || $PlateStudio == 'Lett Lyd AS - 11.000 kr' || $PlateStudio == 'Mats Grønner - 13.000 kr' || $PlateStudio == 'Jamtrackz Records - 14.000 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Oslo') { if($PlateStudio == 'Gramo - 6.340 kr' || $PlateStudio == 'Myhrbraaten Musikk AS - 6.390 kr' || $PlateStudio == 'Musikkloftet AS - 7.420 kr' || $PlateStudio == 'Fabrikken Nedregate AS - 8.000 kr' || $PlateStudio == 'Carambole Ltd - 10.006 kr' || $PlateStudio == 'DaVinci Studio - 11.250 kr' || $PlateStudio == 'Pure Music Production - 12.000 kr' || $PlateStudio == 'Lindberg Lyd AS - 12.700 kr' || $PlateStudio == 'Studio Generations AS - 13.500 kr' || $PlateStudio == 'Kvålsvoll Audio Art & Production - 14.000 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Stavanger') { if($PlateStudio == 'Studio 24 - 8.000 kr' || $PlateStudio == 'Cutting Edge Productions AS - 9.600 kr' || $PlateStudio == 'Deathrow Records - 15.900 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Trondheim') { if($PlateStudio == 'Touchdown Music AS - 8.000 kr' || $PlateStudio == 'Lydproduksjon DA - 9.000 kr' || $PlateStudio == 'Nidaros Studio - 10.300 kr' || $PlateStudio == 'Sunking DA - 10.700 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Tromsø') { if($PlateStudio == 'Abdu Raman Lyd - 3.600 kr' || $PlateStudio == 'Lydproduksjon Tromsø AS - 8.700 kr' || $PlateStudio == 'Bandit Beats AS - 9.600 kr' || $PlateStudio == 'Tone Reds DA - 11.000 kr' || $PlateStudio == 'Tromsø Platestudio - 11.200 kr' || $PlateStudio == 'Kingzize AS - 13.002 kr' || $PlateStudio == 'Studio Vipslash - 13.028 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Kristiansand') { if($PlateStudio == 'Studio 24 - 8.000 kr' || $PlateStudio == 'Lydbølgen - 9.330 kr' || $PlateStudio == 'Stardust Productions - 10.000 kr' || $PlateStudio == 'Sunking DA - 10.700 kr' || $PlateStudio == 'Deathrow Records - 15.900 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}
        elseif($land == 'Sandefjord') { if($PlateStudio == 'Karlbart AS - 9.600 kr' || $PlateStudio == 'Innspillings Studio - 9.700 kr' || $PlateStudio == 'Sandefjord Melodi AS - 10.290 kr' || $PlateStudio == 'Dagfinn & Bernt AS - 14.606 kr' || $PlateStudio == 'MO Platestudio - 15.000 kr') { $Svar = "Godtatt"; } else { $Svar = "Avslatt"; }}

        if($StudioInfo['PlaterUtgitt'] >= '0' && $StudioInfo['PlaterUtgitt'] < '3') { $MinSanger2 = '3'; $MaxSanger2 = '6'; } 
        elseif($StudioInfo['PlaterUtgitt'] >= '3' && $StudioInfo['PlaterUtgitt'] < '6') { $MinSanger2 = '4'; $MaxSanger2 = '9'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '6' && $StudioInfo['PlaterUtgitt'] < '9') { $MinSanger2 = '5'; $MaxSanger2 = '12'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '9' && $StudioInfo['PlaterUtgitt'] < '12') { $MinSanger2 = '6'; $MaxSanger2 = '15'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '12' && $StudioInfo['PlaterUtgitt'] < '15') { $MinSanger2 = '7'; $MaxSanger2 = '18'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '15') { $MinSanger2 = '8'; $MaxSanger2 = '21'; }
        
        if($Svar == 'Godtatt') { 
        if($AntallSanger >= $MinSanger2 && $AntallSanger <= $MaxSanger2) { 
        $LaatPris = $AntallSanger * '4450';
        $PlatePris = ereg_replace("[^0-9]", "", $PlateStudio);
        $TotalKostnad = floor($LaatPris + $PlatePris);
        if($TotalKostnad > $penger) { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke nok penger på hånda.</span></div>";
        } else {
        $StudId = $StudioInfo['Id'];
      
        $NavnSjekk = mysql_query("SELECT * FROM PlatestudioPlater WHERE StudioID LIKE '$StudId' AND PlateNavn='$PlateNavn'");
        if (mysql_num_rows($NavnSjekk) == '0') {
         
        $NySumSpenn = floor($penger - $TotalKostnad);
        $NySumUtgitt = $StudioInfo['PlaterUtgitt'] + '1';
        $NyStamp = $tiden + '18000';
        $NyttOppdrag = $StudioInfo['OppdragNr'] + '1';
        mysql_query("INSERT INTO `PlatestudioPlater` (StudioID,PlateNavn,DatoProd,TimestampProd,LandProd,FirmaProd,AntallSanger,PlateNr) VALUES ('$StudId','$PlateNavn','$tid $nbsp $dato $nbsp $aar','$tiden','$land','$PlateFirma','$AntallSanger','$NyttOppdrag')");
        mysql_query("UPDATE Platestudio SET PlaterUtgitt='$NySumUtgitt',OppdragNr='$NyttOppdrag',GiUtSkiveStamp='$NyStamp',OppdragUtfort='' WHERE Id='$StudId'");
      
        mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du har spilt inn $PlateNavn, det kostet deg ".number_format($TotalKostnad, 0, ",", ".")." kroner.</span></div>";
        } else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har gitt ut en plate med samme navn før, finn på et nytt.</span></div>";
        }}} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ugyldig antall sanger.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har valgt et ugyldig valg av platestudio.</span></div>";
        }}}} 
        elseif($land == 'Bergen' && $StudioInfo['OppdragNr'] == '2' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
      
        include "PlatestudioProsent.php";
        $NyRankpros = $rankpros + $RankPluss;
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',rankpros='$NyRankpros' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '150000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '2'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Kennys klubb, publikumet likte ikke sangene deres, men betalt fikk dere. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '3' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '400');
        $NyRankpros = $rankpros + $RankPluss;
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '156000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '3'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Alta skiforening sitt klubbhus, publikumet likte svært få av sangene deres, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '4' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '400');
        $NyBombechips = floor($bombechips + '16');
        $NyRankpros = $rankpros + $RankPluss;
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '372000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '4'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte i partyhulen til araberene, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Trondheim' && $StudioInfo['OppdragNr'] == '5' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '400');
        $NyBombechips = floor($bombechips + '200');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '100000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '571000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '5'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Platon, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Bodø' && $StudioInfo['OppdragNr'] == '6' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '400');
        $NyBombechips = floor($bombechips + '250');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '200000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '600000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '6'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Flash Night, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '7' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '420');
        $NyBombechips = floor($bombechips + '280');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '450000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '620000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '7'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Tonys cafe, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Stavanger' && $StudioInfo['OppdragNr'] == '8' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '460');
        $NyBombechips = floor($bombechips + '280');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '630000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '8'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Stav Pub, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Kristiansand' && $StudioInfo['OppdragNr'] == '9' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '470');
        $NyBombechips = floor($bombechips + '300');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '600000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '700000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '9'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Tolbooth cafe, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '10' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '500');
        $NyBombechips = floor($bombechips + '500');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '800000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '10'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte på Vallhall Arena, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '11' && $OpptreInnen2 > $tiden && isset($_POST['actionman']) && $StudioInfo['OppdragUtfort'] == '') { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '550');
        $NyBombechips = floor($bombechips + '550');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '900000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragUtfort='Fullfort' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '11'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte i vikingskipet, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Lillehammer' && $StudioInfo['OppdragNr'] == '12' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Stavanger' && $StudioInfo['OppdragNr'] == '13' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Bergen' && $StudioInfo['OppdragNr'] == '14' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Lillehammer' && $StudioInfo['OppdragNr'] == '15' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Kristiansand' && $StudioInfo['OppdragNr'] == '16' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Tromsø' && $StudioInfo['OppdragNr'] == '17' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Sandefjord' && $StudioInfo['OppdragNr'] == '18' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Trondheim' && $StudioInfo['OppdragNr'] == '19' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '20' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '500000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '1000000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '21' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Bodø' && $StudioInfo['OppdragNr'] == '22' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '23' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '24' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '25' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '26' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '27' && isset($_POST['actionman'])) { 
        include "PlatestudioProsent.php";
        $NyRespekt = floor($respekt + '100');
        $NyBombechips = floor($bombechips + '100');
        $NyRankpros = $rankpros + $RankPluss;
        $NySumSpenn = $penger + '250000';
        $RandPlate = rand(1,11);
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv',respekt='$NyRespekt',rankpros='$NyRankpros',bombechips='$NyBombechips',penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        $NySumKonto = $StudioInfo['konto'] + '500000';
      
        mysql_query("UPDATE Platestudio SET konto='$NySumKonto',OppdragNr=`OppdragNr`+'1' WHERE Brukernavn='$brukernavn'");
        mysql_query("UPDATE PlatestudioPlater SET AntallGangerSpilt=`AntallGangerSpilt`+'1' WHERE StudioID='$StudId' AND PlateNr LIKE '$RandPlate'");
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Bandet spilte bra, dere fikk betalt som avtalt. Pengene ble plassert i bandets felles-konto.</span></div>";
        }
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Band</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Bandnavn']."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Grunlagt</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['DatoOprettet']."</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Front vokalist</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Hovedstemme']." er hovedstemmen til bandet</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Annen vokalist</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Bakstemme']." er bandets bakstemme</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gitar</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Gitar']." er gitaristen til bandet</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">El gitar</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['ElGitar']." spiller på el gitaren</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bass gitar</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Bass']." spiller på bass gitaren</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Trommer</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Trommer']." spiller noen fete lyder på trommer</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Piano</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$StudioInfo['Piano']." spiller på piano når det trengs</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Felles-konto</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".number_format($StudioInfo['konto'], 0, ",", ".")." kr ( <a href=\"game.php?side=Platestudio&DinDelAvKaka=FordelUt\">FORDEL PENGER</a> )</span></div>
        ";
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">TILBUD</span></div>
        <div class=\"Div_MELDING\"><span style=\"width: 480px; float: left; margin-left:5px; color:#FFFFFF;\">";
                
        if($StudioInfo['OppdragNr'] == '1') { echo "Du må gi ut en skive før du får oppdrag fra klubber."; } 
        elseif($StudioInfo['OppdragNr'] == '2') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar3.jpg\"><b>Kennys utested:</b><br> Du har fått et tilbud av kenny, dere kan spille på hans utested i Bergen men han forventer at dere opptrer innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 150.000 kr betalt for jobben, pengene blir fordelt utover medlemmene i bandet. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Bergen og gå på platestudio for å opptre på Kenny sitt utested."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar3.jpg\"><b>Kennys utested:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '3') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar1.jpg\"><b>Alta skiforening:</b><br> Du har fått et tilbud fra Alta skiforening, dere kan spille på deres klubbhus men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 156.000 kr for jobben, du får også 400 respekt på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Alta og gå på platestudio for å opptre på klubbhuset."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar1.jpg\"><b>Alta skiforening:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '4') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar2.jpg\"><b>Arabisk partyhule:</b><br> Du har fått et tilbud fra eieren av Arabisk Partyhule, dere kan spille i dems hule men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 372.000 kr for jobben, du får også 400 respekt samt 16 bombechips på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Oslo og gå på platestudio for å opptre i partyhulen."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar2.jpg\"><b>Arabisk partyhule:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '5') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar4.jpg\"><b>Platon:</b><br> Du har fått et tilbud fra eieren av Platon, dere kan spille i dems bar men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 571.000 kr for jobben, du får også 400 respekt, 200 bombechips og 100.000 kr på brukeren din. Dette er en gylden mulighet til å fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Trondheim og gå på platestudio for å opptre på platon."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar4.jpg\"><b>Platon:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '6') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar5.jpg\"><b>Flash Night:</b><br> Du har fått et tilbud fra eieren av Flash Night, dere kan spille i dems discokjeller men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 600.000 kr for jobben, du får også 400 respekt, 250 bombechips og 200.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Bodø og gå på platestudio for å opptre på flash night."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar5.jpg\"><b>Flash Night:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '7') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar6.jpg\"><b>Tonys cafe:</b><br> Du har fått et tilbud av Tony, dere kan spille på deres cafe men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 620.000 kr for jobben, du får også 420 respekt, 280 bombechips og 450.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Drammen og gå på platestudio for å opptre på Tonys cafe."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar6.jpg\"><b>Tonys cafe:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '8') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar7.jpg\"><b>Stav Pub:</b><br> Du har fått et tilbud fra eieren av Stav Pub, dere kan spille på puben men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 630.000 kr for jobben, du får også 460 respekt, 280 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Stavanger og gå på platestudio for å opptre på stav pub."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar7.jpg\"><b>Stav Pub:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '9') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/Tolboothcafe.jpg\"><b>Tolbooth cafe:</b><br> Du har fått et tilbud fra eieren av Tolbooth cafe, dere kan spille hos dem men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 700.000 kr for jobben, du får også 470 respekt, 300 bombechips og 600.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Kristiansand og gå på platestudio for å opptre."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/Tolboothcafe.jpg\"><b>Tolbooth cafe:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '10') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/vallhallarena.jpg\"><b>Vallhall Arena:</b><br> Dere har fått tilbud om å opptre på konserten som blir arrangert på vallhall arena, dere kan spille hos dem men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 1.000.000 kr for jobben, du får også 500 respekt, 500 bombechips og 800.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Oslo og gå på platestudio for å opptre."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/vallhallarena.jpg\"><b>Vallhall Arena:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '11') { if($OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { $OpptreInnen = $OpptreInnen2 - $tiden; echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/vikingskipet.jpg\"><b>Vikingskipet:</b><br> Dere har fått tilbud om å opptre på konserten som blir arrangert i vikingskipet, dere kan spille hos dem men det må skje innen <span id=\"tell2\">$OpptreInnen</span> sekunder. Bandet får 1.500.000 kr for jobben, du får også 550 respekt, 550 bombechips og 900.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Hamar og gå på platestudio for å opptre."; } else { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/vikingskipet.jpg\"><b>Vikingskipet:</b><br> Tilbudet er ikke lengere tilgjenglig.<br><br>Du må produsere en ny plate for å tilgang til et nytt oppdrag."; }}
        elseif($StudioInfo['OppdragNr'] == '12') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/strippeklubb.jpg\"><b>GoGo Baren:</b><br> Dere har muligheten til og opptre på baren til Jonas. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Lillehammer og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '13') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar8.jpg\"><b>Øltønna:</b><br> Dere har muligheten til og opptre på baren til Arnold. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Stavanger og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '14') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar9.jpg\"><b>Festspillene:</b><br> Dere har muligheten til og opptre på en festival. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Bergen og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '15') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar10.jpg\"><b>Lillehammer Rockfestival:</b><br> Dere har muligheten til og opptre på en festival. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Lillehammer og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '16') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar11.jpg\"><b>Quart Festivalen:</b><br> Dere har muligheten til og opptre på en festival. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Kristiansand og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '17') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar12.jpg\"><b>Rocko Bar:</b><br> Dere har muligheten til og opptre på Rocko sin bar. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Tromsø og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '18') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar13.jpg\"><b>Krem Festivalen:</b><br> Dere har muligheten til og opptre på en lokal festival. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Sandefjord og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '19') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar14.jpg\"><b>Strippeklubben:</b><br> Dere har muligheten til og opptre på en strippeklubb. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Trondheim og gå på platestudio for å opptre."; }        
        elseif($StudioInfo['OppdragNr'] == '20') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar15.jpg\"><b>Radisson SAS Plaza Hotel:</b><br> Dere har muligheten til og opptre på et hotel. Bandet får 1.000.000 kr for jobben, du får også 100 respekt, 100 bombechips og 500.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Oslo og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '21') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar16.jpg\"><b>Alta treffet:</b><br> Dere har muligheten til og opptre på et lokalt treff. Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Alta og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '22') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar17.jpg\"><b>Bodø musikk festival:</b><br> Dere har muligheten til og opptre på et lokalt treff. Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Bodø og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '23') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar18.jpg\"><b>Landstreffet:</b><br> Dere har muligheten til og opptre på et landstreffet. Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Hamar og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '24') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar19.jpg\"><b>Byfesten:</b><br> Dere har muligheten til og opptre på en fest Drammen har vært år, Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Drammen og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '25') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/hotel20.jpg\"><b>Star hotel:</b><br> Dere har muligheten til og opptre på Star hotel, Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Alta og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '26') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/bar23.jpg\"><b>Stallgården:</b><br> Dere har muligheten til og opptre på Stallgården, Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Hamar og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '27') { echo "<img style=\"float: left; margin-right:5px;\" src=\"../Bars/hotel22.jpg\"><b>Hotel Daniel:</b><br> Dere har muligheten til og opptre på hotellet til Daniel, Bandet får 500.000 kr for jobben, du får også 100 respekt, 100 bombechips og 250.000 kr på brukeren din. Dette er en gylden mulighet til å få fans, og med fans så kan det hende at dere får solgt noen plater om dagen.<br><br>Dra til Drammen og gå på platestudio for å opptre."; }
        elseif($StudioInfo['OppdragNr'] == '28') { }
        elseif($StudioInfo['OppdragNr'] == '29') { }
        elseif($StudioInfo['OppdragNr'] == '30') { }
        echo "</span></div>";
        
        $VarriabelEkko = "<form method=\"post\" id=\"$submit_knapp_1\"><div class=\"Div_submit_knapp_3\" onclick=\"document.getElementById('$submit_knapp_1').submit()\"><p class=\"pan_str_2\">SPILL</p><input type=\"hidden\" name=\"actionman\" id=\"du_valgte\" /></div></form>";
        
        if($land == 'Bergen' && $StudioInfo['OppdragNr'] == '2' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '3' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '4' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Trondheim' && $StudioInfo['OppdragNr'] == '5' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Bodø' && $StudioInfo['OppdragNr'] == '6' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '7' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Stavanger' && $StudioInfo['OppdragNr'] == '8' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Kristiansand' && $StudioInfo['OppdragNr'] == '9' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '10' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '11' && $OpptreInnen2 > $tiden && $StudioInfo['OppdragUtfort'] == '') { echo $VarriabelEkko; }
        elseif($land == 'Lillehammer' && $StudioInfo['OppdragNr'] == '12') { echo $VarriabelEkko; }
        elseif($land == 'Stavanger' && $StudioInfo['OppdragNr'] == '13') { echo $VarriabelEkko; }
        elseif($land == 'Bergen' && $StudioInfo['OppdragNr'] == '14') { echo $VarriabelEkko; }
        elseif($land == 'Lillehammer' && $StudioInfo['OppdragNr'] == '15') { echo $VarriabelEkko; }
        elseif($land == 'Kristiansand' && $StudioInfo['OppdragNr'] == '16' ) { echo $VarriabelEkko; }
        elseif($land == 'Tromsø' && $StudioInfo['OppdragNr'] == '17' ) { echo $VarriabelEkko; }
        elseif($land == 'Sandefjord' && $StudioInfo['OppdragNr'] == '18' ) { echo $VarriabelEkko; }
        elseif($land == 'Trondheim' && $StudioInfo['OppdragNr'] == '19' ) { echo $VarriabelEkko; }
        elseif($land == 'Oslo' && $StudioInfo['OppdragNr'] == '20' ) { echo $VarriabelEkko; }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '21' ) { echo $VarriabelEkko; }
        elseif($land == 'Bodø' && $StudioInfo['OppdragNr'] == '22' ) { echo $VarriabelEkko; }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '23' ) { echo $VarriabelEkko; }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '24' ) { echo $VarriabelEkko; }
        elseif($land == 'Alta' && $StudioInfo['OppdragNr'] == '25' ) { echo $VarriabelEkko; }
        elseif($land == 'Hamar' && $StudioInfo['OppdragNr'] == '26' ) { echo $VarriabelEkko; }
        elseif($land == 'Drammen' && $StudioInfo['OppdragNr'] == '27' ) { echo $VarriabelEkko; }

        
        if($StudioInfo['PlaterUtgitt'] >= '12') { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">GI UT PLATE</span></div>
        <div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke produsere flere plater, du må prøve å få fans til platene dine nå.</span></div>
        ";
        
        } else { 
        if($StudioInfo['GiUtSkiveStamp'] > $tiden) { 
        $TidIgjen = $StudioInfo['GiUtSkiveStamp'] - $tiden;
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">GI UT PLATE</span></div>
        <div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du kan ikke gi ut skive før det har gått <span id=\"tell1\">$TidIgjen</span> sekunder.</span></div>
        ";
        
        } else { include "Abc_GiUtSkive.php"; }}
        
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">PLATER UTGITT</span></div>
        ";
        
      
        $Plater3 = mysql_query("SELECT * FROM PlatestudioPlater WHERE StudioID LIKE '$StudId' ORDER BY `TimestampProd` DESC");
        if (mysql_num_rows($Plater3) == '0') { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke gitt ut noen plater.</span></div>"; } else { 
        while($PlaterUtgitt = mysql_fetch_assoc($Plater3)) { 
        $Fortjeneste = fortjeneste($PlaterUtgitt['AntallSalg'], $PlaterUtgitt['IntektPerSalg'], $PlaterUtgitt['FirmaProd']);
        $Fortjeneste = $Fortjeneste - $PlaterUtgitt['MinusSum'];
        $IdFake = $PlaterUtgitt['Id'] * '285292542';
        echo "
        <div class=\"Div_Porno_0\">
        <span class=\"Span_str_8\">
        <b>Plate:</b> ".$PlaterUtgitt['PlateNavn']."<br>
        <b>Utgitt av:</b> ".$PlaterUtgitt['FirmaProd']." i ".$PlaterUtgitt['LandProd']." by<br>
        <b>Dato:</b> ".$PlaterUtgitt['DatoProd']."<br>
        <b>Antall plater solgt:</b> ".number_format($PlaterUtgitt['AntallSalg'], 0, ",", ".")." stk<br>
        <b>Plate-konto:</b> ".number_format($Fortjeneste, 0, ",", ".")." kr ( <a href=\"game.php?side=Platestudio&DinDelAvKaka=$IdFake\">FORDEL PENGER</a> )<br>
        </span><br>
        </div>
        ";
        }}
        
        } else { 
        include "Abc_startband.php";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ingen rank krav lengere i denne funksjonen.</span></div>";
        }
        echo "</div>";
        
        
        }}}}}
        ?>
