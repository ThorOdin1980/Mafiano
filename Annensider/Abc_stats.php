    <?php
    if (empty($brukernavn)) { header("Location: index.php"); } else { 
       
    function RowAntall($I) { $Return = mysql_num_rows(mysql_query($I)); return $Return; }
    function GetInfo($I) { $Return =  mysql_fetch_array(mysql_query($I)); return $Return; }
    function igaar($Dato) { 
    $Dag = Bare_Siffer($Dato);
    $Monde = Bare_Bokstaver($Dato);
    $Dag = $Dag - '1';
    if($Dag >= '1') { $Data = "$Dag. $Monde"; } else { 
    if($Monde == 'Jan') { $TidMonde = "Dec"; $TidDag = "31"; }
    elseif($Monde == 'Feb') { $TidMonde = "Jan"; $TidDag = "31"; }
    elseif($Monde == 'Mar') { $TidMonde = "Feb"; $TidDag = "28"; }
    elseif($Monde == 'Apr') { $TidMonde = "Mar"; $TidDag = "31"; }
    elseif($Monde == 'Mai') { $TidMonde = "Apr"; $TidDag = "30"; }
    elseif($Monde == 'Jun') { $TidMonde = "Mai"; $TidDag = "31"; }
    elseif($Monde == 'Jul') { $TidMonde = "Jun"; $TidDag = "30"; }
    elseif($Monde == 'Aug') { $TidMonde = "Jul"; $TidDag = "31"; }
    elseif($Monde == 'Sep') { $TidMonde = "Aug"; $TidDag = "31"; }
    elseif($Monde == 'Oct') { $TidMonde = "Sep"; $TidDag = "30"; }
    elseif($Monde == 'Nov') { $TidMonde = "Oct"; $TidDag = "31"; }
    elseif($Monde == 'Dec') { $TidMonde = "Nov"; $TidDag = "30"; }
    $Data = "$TidDag. $TidMonde";
    }    
    return $Data;
    }


    // Sjekker om du skal oppdatere loggen
  
    $Sjekk = mysql_query("SELECT * FROM `StatsLogg` ORDER BY `Id` DESC LIMIT 0 , 1");
    if (mysql_num_rows($Sjekk) == '1') { 
    $LoggInfo = mysql_fetch_assoc($Sjekk);
    $TiMin = $tiden - '150';
    if($TiMin > $LoggInfo['Timestamp']) { 
    mysql_query("INSERT INTO `StatsLogg` (SkrevetAv,LoggDato,Timestamp) VALUES ('$brukernavn','$tid $nbsp $dato $nbsp $aar','$tiden')");
        
    // Tider minus
    $D24Tim = $tiden - '86400';
    $D48Tim = $tiden - '172800';
    $D72Tim = $tiden - '259200';
    $D96Tim = $tiden - '345600';

  
    $Kf = mysql_query("SELECT * FROM Kulefabrikker WHERE KF_Fabrikk LIKE '%' ORDER BY `KF_Opprettet_Stamp` DESC");
    $FabrikkSpenn = mysql_fetch_object(mysql_query("SELECT SUM(KF_Konto)AS Spennfabrikk FROM Kulefabrikker WHERE KF_Gjeng NOT LIKE 'MafiaNo Crew'"));

  
    $Butikker = mysql_query("SELECT * FROM Butikker WHERE id LIKE '%'");
    $ButikkSpenn = mysql_fetch_object(mysql_query("SELECT SUM(Butikk_Konto)AS Spennbutikk FROM Butikker WHERE Butikk_Gjeng NOT LIKE 'MafiaNo Crew'"));

  
    $Gjenger = mysql_query("SELECT * FROM Gjenger WHERE Gjeng_Navn LIKE '%' ORDER BY `Stamp_Startet` DESC");  

    // Antall
    $RankOgPeng = mysql_query("SELECT * FROM brukere WHERE type NOT LIKE 'A' AND type NOT LIKE 'm' AND type NOT LIKE 'b'");
    $Medlemmer = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%'"),"stk");
    $Gutt = VerdiSum(RowAntall("SELECT * FROM brukere WHERE liv >= '1' AND kjon LIKE 'Gutt'"),"stk");
    $Jente = VerdiSum(RowAntall("SELECT * FROM brukere WHERE liv >= '1' AND kjon LIKE 'Jente'"),"stk");
    $Online_24 = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $D24Tim"),"stk");
    $Online_48 = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $D48Tim"),"stk");
    $Online_72 = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $D72Tim"),"stk");
    $Online_96 = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND aktiv_eller > $D96Tim"),"stk");
    $GjengSpenn = mysql_fetch_object(mysql_query("SELECT SUM(floor(Gjeng_Penger))AS Spenngjeng FROM Gjenger WHERE Gjeng_Navn NOT LIKE 'MafiaNo Crew'"));
    $Bank = mysql_fetch_object(mysql_query("SELECT SUM(floor(bank))AS Spennbank,SUM(floor(penger))AS Spenncash FROM brukere WHERE liv >= '1' AND type NOT LIKE 'A' AND type NOT LIKE 'm' AND type NOT LIKE 'b'"));	
    $BrukerStats = mysql_fetch_object(mysql_query("SELECT SUM(meldinger_sendt)AS MeldingerSendt,SUM(Forumemner)AS Forumemner,SUM(Forumsvar)AS Forumsvar FROM brukere WHERE brukerid LIKE '%'"));	
    $PlantasjeSpenn = mysql_fetch_object(mysql_query("SELECT SUM(floor(plantasje.konto))AS Spennplantasje FROM plantasje INNER JOIN brukere ON brukere.brukernavn=plantasje.brukernavn WHERE brukere.liv >= '1' AND brukere.type NOT LIKE 'A' AND brukere.type NOT LIKE 'm'"));

    // Annen informasjon
    $MeldSendt = VerdiSum(($BrukerStats->MeldingerSendt),"stk");      
    $Forumemner = VerdiSum(($BrukerStats->Forumemner),"stk");      
    $Forumsvar = VerdiSum(($BrukerStats->Forumsvar),"stk");      


    // Penger i spillet
    $PengerPlantasje = VerdiSum(($PlantasjeSpenn->Spennplantasje),"kr");      
    $PengerBank = VerdiSum(($Bank->Spennbank),"kr");      
    $PengerCash = VerdiSum(($Bank->Spenncash),"kr");
    $PengerGjeng = VerdiSum(($GjengSpenn->Spenngjeng),"kr");      
    $PengerButikk = VerdiSum((($ButikkSpenn->Spennbutikk) + ($FabrikkSpenn->Spennfabrikk)),"kr");      
    $PengerTotalt = VerdiSum((($Bank->Spennbank) + ($Bank->Spenncash) + ($GjengSpenn->Spenngjeng) + ($ButikkSpenn->Spennbutikk) + ($FabrikkSpenn->Spennfabrikk) + ($PlantasjeSpenn->Spennplantasje)),"kr");
        
    // Flest

    $F_DRap = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`drap`) DESC LIMIT 0, 1");
    $F_Brekk = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`brekk_gjort`) DESC LIMIT 0, 1");
    $F_Gta = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`biler_gjort`) DESC LIMIT 0, 1");
    $F_Filmer = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`antall_film_prod`) DESC LIMIT 0, 1");
    $F_Kid = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`kid_antall`) DESC LIMIT 0, 1");
    $F_Press = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' OR type LIKE 'fm' ORDER BY floor(`presse_antall`) DESC LIMIT 0, 1");
    $F_Horer = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`horer_pult`) DESC LIMIT 0, 1");
    $F_MeldSendt = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`meldinger_sendt`) DESC LIMIT 0, 1");
    $F_ForumSvar = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`Forumsvar`) DESC LIMIT 0, 1");
    $F_ForumEmner = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`Forumemner`) DESC LIMIT 0, 1");
    $F_Herverk = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`herverk_gjort`) DESC LIMIT 0, 1");
    $F_Bryt = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`bryt_ut_antall`) DESC LIMIT 0, 1");
    $F_PR = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`plan_ran`) DESC LIMIT 0, 1");
    $F_Respekt = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`respekt`) DESC LIMIT 0, 1");
    $F_Rankpros = GetInfo("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`rankpros`) DESC LIMIT 0, 1");
        
    // Rikest spiller
    $richest_player = mysql_query("SELECT brukernavn, penger + bank AS allepengene FROM `brukere` WHERE `liv` >= '1' AND `type` = 'u' ORDER BY allepengene DESC LIMIT 3");
    while($richest = mysql_fetch_array($richest_player))    {
        $rich[] = $richest['brukernavn'];
    }


    // Dato blir osv
    $DatoIdag = date("d. M");
    $DatoIgar = igaar($DatoIdag);
    $DatoIforigors = igaar($DatoIgar);
    
    $ReggaIdag = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND regtid LIKE '%$DatoIdag%'"),'brukere');
    $ReggaIgar = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND regtid LIKE '%$DatoIgar%'"),'brukere');
    $ReggaIforigors = VerdiSum(RowAntall("SELECT * FROM brukere WHERE brukernavn LIKE '%' AND regtid LIKE '%$DatoIforigors%'"),'brukere');

    $SistRegga = "";
    $D15Regga = mysql_query("SELECT * FROM brukere WHERE brukernavn LIKE '%' ORDER BY `regtid_stamp` DESC LIMIT 0, 15");
    while($I = mysql_fetch_assoc($D15Regga)) { $SistRegga = $SistRegga."<tr><td class=\"R_3\">".BrukerURL($I['brukernavn'])."</td><td class=\"R_2\">".$I['regtid']."</td></tr>"; }
        
    $SistAktiv = "";
    $D15Aktiv = mysql_query("SELECT * FROM brukere WHERE brukernavn LIKE '%' ORDER BY `aktiv_eller` DESC LIMIT 0, 15");
    while($I = mysql_fetch_assoc($D15Aktiv)) { 
    $SistAktivitet = RegnTid(Bare_Siffer((($I['aktiv_eller'] - '3600') - $Timestamp)));
    $SistAktiv = $SistAktiv."<tr><td class=\"R_3\">".BrukerURL($I['brukernavn'])."</td><td class=\"R_2\">$SistAktivitet</td></tr>"; }

    $SistDrept = "";
    $D15Drept = mysql_query("SELECT * FROM brukere WHERE dato_drept NOT LIKE '' AND liv < '1' ORDER BY `timestamp_dod` DESC LIMIT 0, 15");
    while($I = mysql_fetch_assoc($D15Drept)) { $SistDrept = $SistDrept."<tr><td class=\"R_3\">".BrukerURL($I['brukernavn'])."</td><td class=\"R_2\">".$I['dato_drept']."</td></tr>"; }
    
    $SistRank = "";
    $D15Rank = mysql_query("SELECT * FROM NyRank WHERE TallRank >='1'ORDER BY `Timestamp` DESC LIMIT 0, 15");
    while($I = mysql_fetch_assoc($D15Rank)) { $SistRank = $SistRank."<tr><td class=\"R_3\">".BrukerURL($I['Brukernavn'])."</td><td class=\"R_2\">".$I['RankNavn']."</td></tr>"; }

    
    // Bedrifter
    $Drammen = array();
    $Lillehammer = array();
    $Hamar = array();
    $Alta = array();
    $Bergen = array();
    $Bodo = array();
    $Oslo = array();
    $Stavanger = array();
    $Trondheim = array();
    $Tromso = array();
    $Kristiansand = array();
    $Sandefjord = array();

    while($I = mysql_fetch_assoc($Kf)) { 
    $Var = "<td class=\"R_6\">".$I['KF_Fabrikk']."</font></td><td class=\"R_2\">Kulefabrikk</td><td class=\"R_5\">".BrukerURL($I['KF_Eier'])."</td>";
    if($I['KF_Sted'] == 'Drammen') { array_push($Drammen, $Var); } 
    elseif($I['KF_Sted'] == 'Lillehammer') { array_push($Lillehammer, $Var); }
    elseif($I['KF_Sted'] == 'Hamar') { array_push($Hamar, $Var); }
    elseif($I['KF_Sted'] == 'Alta') { array_push($Alta, $Var); }
    elseif($I['KF_Sted'] == 'Bergen') { array_push($Bergen, $Var); }
    elseif($I['KF_Sted'] == 'Bodø') { array_push($Bodo, $Var); }
    elseif($I['KF_Sted'] == 'Oslo') { array_push($Oslo, $Var); }
    elseif($I['KF_Sted'] == 'Stavanger') { array_push($Stavanger, $Var); }
    elseif($I['KF_Sted'] == 'Trondheim') { array_push($Trondheim, $Var); }
    elseif($I['KF_Sted'] == 'Tromsø') { array_push($Tromso, $Var); }
    elseif($I['KF_Sted'] == 'Kristiansand') { array_push($Kristiansand, $Var); }
    elseif($I['KF_Sted'] == 'Sandefjord') { array_push($Sandefjord, $Var); }
    }
        
    while($I = mysql_fetch_assoc($Butikker)) {
    $Var = "<td class=\"R_6\">".$I['Butikk_Navn']."</font></td><td class=\"R_2\">".$I['Butikk_Type']."</td><td class=\"R_5\">".BrukerURL($I['Butikk_eier'])."</td>";
    if($I['Butikk_Land'] == 'Drammen') { array_push($Drammen, $Var); } 
    elseif($I['Butikk_Land'] == 'Lillehammer') { array_push($Lillehammer, $Var); }
    elseif($I['Butikk_Land'] == 'Hamar') { array_push($Hamar, $Var); }
    elseif($I['Butikk_Land'] == 'Alta') { array_push($Alta, $Var); }
    elseif($I['Butikk_Land'] == 'Bergen') { array_push($Bergen, $Var); }
    elseif($I['Butikk_Land'] == 'Bodø') { array_push($Bodo, $Var); }
    elseif($I['Butikk_Land'] == 'Oslo') { array_push($Oslo, $Var); }
    elseif($I['Butikk_Land'] == 'Stavanger') { array_push($Stavanger, $Var); }
    elseif($I['Butikk_Land'] == 'Trondheim') { array_push($Trondheim, $Var); }
    elseif($I['Butikk_Land'] == 'Tromsø') { array_push($Tromso, $Var); }
    elseif($I['Butikk_Land'] == 'Kristiansand') { array_push($Kristiansand, $Var); }
    elseif($I['Butikk_Land'] == 'Sandefjord') { array_push($Sandefjord, $Var); }
    }
    
    // Gjenger
    $Tell = '0';
    $GjengerB = '';
    while($I = mysql_fetch_assoc($Gjenger)) { 
    $Tell++;
    $Gjengnavn = $I['Gjeng_Navn'];
    $Gjengid = $I['id'];
    
    $MedlemmerER = mysql_query("SELECT * FROM Gjeng_medlemmer WHERE gjeng_id LIKE '$Gjengid' ORDER BY 'ansatt_stamp'");
    $Sjefer = '';
    $Med = '';
    while($I2 = mysql_fetch_assoc($MedlemmerER)) { 
    if($I2['stilling'] == 'Boss') { $Sjefer = $Sjefer.BrukerURL($I2['brukernavn'])."<br>"; } 
    else { $Med = $Med.BrukerURL($I2['brukernavn'])."<br>"; }
    }
    
    if(empty($Med)) { $Med = "&nbsp;"; } 
    
    $GjengerB = "$GjengerB
    <tr><td class=\"R_6\">$Tell</td><td class=\"R_5\"><a href=\"game.php?side=Gjeng&navn=".urlencode($Gjengnavn)."\">$Gjengnavn</a></td><td class=\"R_5\">$Sjefer</td><td class=\"R_5\">$Med</td><td class=\"R_5\">".$I['Dato_Startet']."</td></tr>
    ";
    }
    
    
    while($T = mysql_fetch_assoc($RankOgPeng)) { 
    
    if($T['liv'] >= '1') { 
    if($T['rank_nivaa'] == '1') { $RankEn++; } 
    elseif($T['rank_nivaa'] == '2') { $RankTo++; }
    elseif($T['rank_nivaa'] == '3') { $RankTre++; }
    elseif($T['rank_nivaa'] == '4') { $RankFire++; }
    elseif($T['rank_nivaa'] == '5') { $RankFem++; }
    elseif($T['rank_nivaa'] == '6') { $RankSeks++; }
    elseif($T['rank_nivaa'] == '7') { $RankSju++; }
    elseif($T['rank_nivaa'] == '8') { $RankAtte++; }
    elseif($T['rank_nivaa'] == '9') { $RankNi++; }
    elseif($T['rank_nivaa'] == '10') { $RankTi++; }
    elseif($T['rank_nivaa'] == '11') { $RankElve++; }
    elseif($T['rank_nivaa'] == '12') { $RankTolv++; }
    elseif($T['rank_nivaa'] == '13') { $RankTretten++; }
    elseif($T['rank_nivaa'] == '14') { $RankFjorten++; }
    elseif($T['rank_nivaa'] == '15') { $RankFemten++; }


    $SumPeng = floor($T['penger']);
    if($SumPeng < '10000') { $PengEn++; } 
    if($SumPeng >= '10000') { $PengTo++; }
    if($SumPeng >= '60000') { $PengTre++; }
    if($SumPeng >= '300000') { $PengFire++; }
    if($SumPeng >= '700000') { $PengFem++; }
    if($SumPeng >= '1000000') { $PengSeks++; }
    if($SumPeng >= '2000000') { $PengSju++; }
    if($SumPeng >= '10000000') { $PengAtte++; }
    if($SumPeng >= '100000000') { $PengNi++; }
    if($SumPeng >= '1000000000') { $PengTi++; }
    if($SumPeng >= '5000000000') { $PengElve++; }
    if($SumPeng >= '100000000000') { $PengTolv++; }
    
        
    }}

    
    $Flest_drap = $db->prepare("SELECT * FROM brukere WHERE liv >= '1' AND type LIKE 'u' OR type LIKE 'sf' OR type LIKE 's' OR type LIKE 'fm' ORDER BY floor(`drap`) DESC LIMIT 0, 1");
    $Flest_drap->execute();
    $Flest_drap_info = $Flest_drap->fetch();
    
    $DataUt = "
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">Nøkkeltall</td></tr>
    <tr><td class=\"R_1\">Statistikk skrevet</td><td class=\"R_2\"><B>KL</B>&nbsp;$Klokke</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Medlemmer</td><td class=\"R_2\">$Medlemmer</td></tr>
    <tr><td class=\"R_1\">Mannlige medlemmer</td><td class=\"R_2\">$Gutt</td></tr>
    <tr><td class=\"R_1\">kvinnelige medlemmer</td><td class=\"R_2\">$Jente</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Online siste 24 timene</td><td class=\"R_2\">$Online_24</td></tr>
    <tr><td class=\"R_1\">Online siste 48 timene</td><td class=\"R_2\">$Online_48</td></tr>
    <tr><td class=\"R_1\">Online siste 72 timene</td><td class=\"R_2\">$Online_72</td></tr>
    <tr><td class=\"R_1\">Online siste 96 timene</td><td class=\"R_2\">$Online_96</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Registrert i dag</td><td class=\"R_2\">$ReggaIdag</td></tr>
    <tr><td class=\"R_1\">Registrert i går</td><td class=\"R_2\">$ReggaIgar</td></tr>
    <tr><td class=\"R_1\">Registrert i forigårs</td><td class=\"R_2\">$ReggaIforigors</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Penger i omløp</td><td class=\"R_2\">$PengerTotalt</td></tr>
    <tr><td class=\"R_1\">Penger i bank</td><td class=\"R_2\">$PengerBank</td></tr>
    <tr><td class=\"R_1\">Penger kontant</td><td class=\"R_2\">$PengerCash</td></tr>
    <tr><td class=\"R_1\">Penger i plantasje</td><td class=\"R_2\">$PengerPlantasje</td></tr>
    <tr><td class=\"R_1\">Penger i gjeng</td><td class=\"R_2\">$PengerGjeng</td></tr>
    <tr><td class=\"R_1\">Penger i bedrift</td><td class=\"R_2\">$PengerButikk</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Antall meldinger sendt</td><td class=\"R_2\">$MeldSendt</td></tr>
    <tr><td class=\"R_1\">Antall forumemner</td><td class=\"R_2\">$Forumemner</td></tr>
    <tr><td class=\"R_1\">Antall forumsvar</td><td class=\"R_2\">$Forumsvar</td></tr>
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">Flest / Mest</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>

    <tr><td class=\"R_1\">Flest - drap</td><td class=\"R_2\">".BrukerURL($Flest_drap_info['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - kidnappinger</td><td class=\"R_2\">".BrukerURL($F_Kid['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - brekk</td><td class=\"R_2\">".BrukerURL($F_Brekk['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - biltyveri</td><td class=\"R_2\">".BrukerURL($F_Gta['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - upressninger</td><td class=\"R_2\">".BrukerURL($F_Press['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - utbryninger</td><td class=\"R_2\">".BrukerURL($F_Bryt['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - herverk</td><td class=\"R_2\">".BrukerURL($F_Herverk['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - horer pult</td><td class=\"R_2\">".BrukerURL($F_Horer['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - filmer produsert</td><td class=\"R_2\">".BrukerURL($F_Filmer['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - planlagte ran</td><td class=\"R_2\">".BrukerURL($F_PR['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Flest - meldinger sendt</td><td class=\"R_2\">".BrukerURL($F_MeldSendt['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - forumemner</td><td class=\"R_2\">".BrukerURL($F_ForumEmner['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Flest - forumsvar</td><td class=\"R_2\">".BrukerURL($F_ForumSvar['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\">Mest - respekt</td><td class=\"R_2\">".BrukerURL($F_Respekt['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\">Mest - rankprosent</td><td class=\"R_2\">".BrukerURL($F_Rankpros['brukernavn'])."</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>


    <tr><td class=\"R_1\">Rikeste spiller</td><td class=\"R_2\">".BrukerURL($rich[0])."</td></tr>
    <tr><td class=\"R_1\">Nest rikeste spiller</td><td class=\"R_2\">".BrukerURL($rich[1])."</td></tr>
    <tr><td class=\"R_1\">Tredje rikeste spiller</td><td class=\"R_2\">".BrukerURL($rich[2])."</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    <tr><td class=\"R_1\" colspan=\"2\">&nbsp;</td></tr>
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">15 sist registrert</td></tr>
    <tr><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Dato</td></tr>
    $SistRegga
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">15 sist aktive spillere</td></tr>
    <tr><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Sekunder siden</td></tr>
    $SistAktiv
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">15 drept sist</td></tr>
    <tr><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Dato</td></tr>
    $SistDrept
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"2\">15 siste forfremmelser</td></tr>
    <tr><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Rank</td></tr>
    $SistRank
    </table></div>

    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"3\">Rank oversikt</td></tr>
    <tr><td class=\"R_4\">#</td><td class=\"R_4\">Rank</td><td class=\"R_4\">Antall</td></tr>
    <tr><td class=\"R_3\">15</td><td class=\"R_2\">Capo Crimini</td><td class=\"R_5\">".VerdiSum($RankFemten,"stk")."</td></tr>
    <tr><td class=\"R_3\">14</td><td class=\"R_2\">Leg.Don / Herskerinne</td><td class=\"R_5\">".VerdiSum($RankFjorten,"stk")."</td></tr>
    <tr><td class=\"R_3\">13</td><td class=\"R_2\">Don / Grevinne</td><td class=\"R_5\">".VerdiSum($RankTretten,"stk")."</td></tr>
    <tr><td class=\"R_3\">12</td><td class=\"R_2\">Leg.Gudfar / Leg.Gudmor</td><td class=\"R_5\">".VerdiSum($RankTolv,"stk")."</td></tr>
    <tr><td class=\"R_3\">11</td><td class=\"R_2\">Gudfar / Gudmor</td><td class=\"R_5\">".VerdiSum($RankElve,"stk")."</td></tr>
    <tr><td class=\"R_3\">10</td><td class=\"R_2\">Sjef</td><td class=\"R_5\">".VerdiSum($RankTi,"stk")."</td></tr>
    <tr><td class=\"R_3\">09</td><td class=\"R_2\">Narko Baron / Baronesse</td><td class=\"R_5\">".VerdiSum($RankNi,"stk")."</td></tr>
    <tr><td class=\"R_3\">08</td><td class=\"R_2\">Kaptein</td><td class=\"R_5\">".VerdiSum($RankAtte,"stk")."</td></tr>
    <tr><td class=\"R_3\">07</td><td class=\"R_2\">Torpedo / Morderske</td><td class=\"R_5\">".VerdiSum($RankSju,"stk")."</td></tr>
    <tr><td class=\"R_3\">06</td><td class=\"R_2\">Attentatmann / Attentatdame</td><td class=\"R_5\">".VerdiSum($RankSeks,"stk")."</td></tr>
    <tr><td class=\"R_3\">05</td><td class=\"R_2\">Gangster / Gangsterinne</td><td class=\"R_5\">".VerdiSum($RankFem,"stk")."</td></tr>
    <tr><td class=\"R_3\">04</td><td class=\"R_2\">Kriminell</td><td class=\"R_5\">".VerdiSum($RankFire,"stk")."</td></tr>
    <tr><td class=\"R_3\">03</td><td class=\"R_2\">Bråkmaker / Forførerske</td><td class=\"R_5\">".VerdiSum($RankTre,"stk")."</td></tr>
    <tr><td class=\"R_3\">02</td><td class=\"R_2\">Lærling / Luremus</td><td class=\"R_5\">".VerdiSum($RankTo,"stk")."</td></tr>
    <tr><td class=\"R_3\">01</td><td class=\"R_2\">Uteligger</td><td class=\"R_5\">".VerdiSum($RankEn,"stk")."</td></tr>
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_2\">
    <tr><td class=\"R_0\" colspan=\"3\">Pengestatus</td></tr>
    <tr><td class=\"R_4\">#</td><td class=\"R_4\">Navn</td><td class=\"R_4\">Antall</td></tr>
    <tr><td class=\"R_3\">12</td><td class=\"R_2\">Billionær</td><td class=\"R_5\">".VerdiSum($PengTolv,"stk")."</td></tr>
    <tr><td class=\"R_3\">11</td><td class=\"R_2\">Vellykket milliardær</td><td class=\"R_5\">".VerdiSum($PengElve,"stk")."</td></tr>
    <tr><td class=\"R_3\">10</td><td class=\"R_2\">Milliardær</td><td class=\"R_5\">".VerdiSum($PengTi,"stk")."</td></tr>
    <tr><td class=\"R_3\">09</td><td class=\"R_2\">Farlig rik</td><td class=\"R_5\">".VerdiSum($PengNi,"stk")."</td></tr>
    <tr><td class=\"R_3\">08</td><td class=\"R_2\">Mange millionær</td><td class=\"R_5\">".VerdiSum($PengAtte,"stk")."</td></tr>
    <tr><td class=\"R_3\">07</td><td class=\"R_2\">Millionær</td><td class=\"R_5\">".VerdiSum($PengSju,"stk")."</td></tr>
    <tr><td class=\"R_3\">06</td><td class=\"R_2\">Overklasse</td><td class=\"R_5\">".VerdiSum($PengSeks,"stk")."</td></tr>
    <tr><td class=\"R_3\">05</td><td class=\"R_2\">Vellykket arbeider</td><td class=\"R_5\">".VerdiSum($PengFem,"stk")."</td></tr>
    <tr><td class=\"R_3\">04</td><td class=\"R_2\">Arbeider</td><td class=\"R_5\">".VerdiSum($PengFire,"stk")."</td></tr>
    <tr><td class=\"R_3\">03</td><td class=\"R_2\">Streber</td><td class=\"R_5\">".VerdiSum($PengTre,"stk")."</td></tr>
    <tr><td class=\"R_3\">02</td><td class=\"R_2\">Fattig</td><td class=\"R_5\">".VerdiSum($PengTo,"stk")."</td></tr>
    <tr><td class=\"R_3\">01</td><td class=\"R_2\">Boms</td><td class=\"R_5\">".VerdiSum($PengEn,"stk")."</td></tr>
    <tr><td class=\"R_3\" colspan=\"3\">&nbsp;</td></tr>
    <tr><td class=\"R_3\" colspan=\"3\">&nbsp;</td></tr>
    <tr><td class=\"R_3\" colspan=\"3\">&nbsp;</td></tr>
    </table></div>
    
    <div class=\"Div_masta\">
    <table class=\"Rute_1\">
	<tr><td class=\"R_0\" colspan=\"4\">Bedrifter</td></tr>
	<tr><td class=\"R_4\" style=\"width:120px;\">&nbsp;</td><td class=\"R_4\">Bedrift</td><td class=\"R_4\">Type</td><td class=\"R_4\">Eier</td></tr>
    <tr><td rowspan=\"5\" class=\"R_4\">Drammen</td>".$Drammen[0]."</tr><tr>".$Drammen[1]."</tr><tr>".$Drammen[2]."</tr><tr>".$Drammen[3]."</tr><tr>".$Drammen[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Lillehammer</td>".$Lillehammer[0]."</tr><tr>".$Lillehammer[1]."</tr><tr>".$Lillehammer[2]."</tr><tr>".$Lillehammer[3]."</tr><tr>".$Lillehammer[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Hamar</td>".$Hamar[0]."</tr><tr>".$Hamar[1]."</tr><tr>".$Hamar[2]."</tr><tr>".$Hamar[3]."</tr><tr>".$Hamar[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Alta</td>".$Alta[0]."</tr><tr>".$Alta[1]."</tr><tr>".$Alta[2]."</tr><tr>".$Alta[3]."</tr><tr>".$Alta[4]."</tr>
    <tr><td rowspan=\"5\" class=\"R_4\">Bergen</td>".$Bergen[0]."</tr><tr>".$Bergen[1]."</tr><tr>".$Bergen[2]."</tr><tr>".$Bergen[3]."</tr><tr>".$Bergen[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Bodø</td>".$Bodo[0]."</tr><tr>".$Bodo[1]."</tr><tr>".$Bodo[2]."</tr><tr>".$Bodo[3]."</tr><tr>".$Bodo[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Oslo</td>".$Oslo[0]."</tr><tr>".$Oslo[1]."</tr><tr>".$Oslo[2]."</tr><tr>".$Oslo[3]."</tr><tr>".$Oslo[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Stavanger</td>".$Stavanger[0]."</tr><tr>".$Stavanger[1]."</tr><tr>".$Stavanger[2]."</tr><tr>".$Stavanger[3]."</tr><tr>".$Stavanger[4]."</tr>
    <tr><td rowspan=\"5\" class=\"R_4\">Trondheim</td>".$Trondheim[0]."</tr><tr>".$Trondheim[1]."</tr><tr>".$Trondheim[2]."</tr><tr>".$Trondheim[3]."</tr><tr>".$Trondheim[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Tromsø</td>".$Tromso[0]."</tr><tr>".$Tromso[1]."</tr><tr>".$Tromso[2]."</tr><tr>".$Tromso[3]."</tr><tr>".$Tromso[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Kristiansand</td>".$Kristiansand[0]."</tr><tr>".$Kristiansand[1]."</tr><tr>".$Kristiansand[2]."</tr><tr>".$Kristiansand[3]."</tr><tr>".$Kristiansand[4]."</tr>
	<tr><td rowspan=\"5\" class=\"R_4\">Sandefjord</td>".$Sandefjord[0]."</tr><tr>".$Sandefjord[1]."</tr><tr>".$Sandefjord[2]."</tr><tr>".$Sandefjord[3]."</tr><tr>".$Sandefjord[4]."</tr>
	</table></div>
	
	<div class=\"Div_masta\">
    <table class=\"Rute_1\">
	<tr><td class=\"R_0\" colspan=\"5\">Gjenger</td></tr>
	<tr><td class=\"R_4\">#</td><td class=\"R_4\">Gjeng</td><td class=\"R_4\">Gjengstyre</td><td class=\"R_4\">Medlemmer</td><td class=\"R_4\">Opprettet</td></tr>
	$GjengerB
	</table></div>
	";
        

 
                
                
        $File = "Stats.txt"; 
        $Handle = fopen($File, 'w');
        $Data = $DataUt;
        fwrite($Handle, $Data); 
        fclose($Handle); 


        }}

        $file=fopen("Stats.txt","r") or exit("Kan ikke åpne loggen desverre!");
        while (!feof($file)) { echo fgetc($file); }
        fclose($file);
        }
        ?>