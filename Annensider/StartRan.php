        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn) || empty($SjekkYoen)) { header("Location: index.php"); } else { 
      
        $Klare = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        if(mysql_num_rows($Klare) < '4') { echo PrintTeksten('Alle er medlemmene er ikke klare enda.','1','Feilet'); } else { 
        
        // Hent ut brukernavn til medlemmene i ranet
        $Ie = '0'; $Bruker_1 = ''; $Bruker_2 = ''; $Bruker_3 = ''; $Bruker_4 = '';
        while($I = mysql_fetch_assoc($Klare)) { $Ie++; if($Ie == '1') { $Bruker_1 = $I['Brukernavn']; }elseif($Ie == '2') { $Bruker_2 = $I['Brukernavn']; }elseif($Ie == '3') { $Bruker_3 = $I['Brukernavn']; }elseif($Ie == '4') { $Bruker_4 = $I['Brukernavn']; }}

        // Hent ut informasjon om hver medlem i ranet
      
        $BrukerEn = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Bruker_1'");
        $BrukerTo = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Bruker_2'");
        $BrukerTre = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Bruker_3'");
        $BrukerFire = mysql_query("SELECT * FROM brukere WHERE brukernavn='$Bruker_4'");
        $BrukerEn = mysql_fetch_assoc($BrukerEn);
        $BrukerTo = mysql_fetch_assoc($BrukerTo);
        $BrukerTre = mysql_fetch_assoc($BrukerTre);
        $BrukerFire = mysql_fetch_assoc($BrukerFire);
        
        include "Annensider/FunkPR.php";
        
        // Viktige tall
        $PengerB = $RanInfo['PengerBrukt'];
        $BcB = $RanInfo['BcBrukt'];
        $PoengB = $RanInfo['PoengBrukt'];
        $TotalRan = floor($BrukerEn['plan_ran'] + $BrukerTo['plan_ran'] + $BrukerTre['plan_ran'] + $BrukerFire['plan_ran'] + $plan_ran);
        $TotalLevel = floor($BrukerEn['rank_nivaa'] + $BrukerTo['rank_nivaa'] + $BrukerTre['rank_nivaa'] + $BrukerFire['rank_nivaa'] + $rank_niva);
        $TotalDrap = floor($BrukerEn['drap'] + $BrukerTo['drap'] + $BrukerTre['drap'] + $BrukerFire['drap'] + $drap);
        $TotalRespekt = floor($BrukerEn['respekt'] + $BrukerTo['respekt'] + $BrukerTre['respekt'] + $BrukerFire['respekt'] + $respekt);
        $VenteTid = $tiden + '36000';

        // Viktige variabler
        $GrunnGevinst = GrunnSum($TotalDrap,$TotalRespekt,$TotalLevel);
        $GrunnGevinst = ekstrapenger($TotalRan,$GrunnGevinst);
        $Kulerekstra = '50000' + rand(1000,2000);
        $TjenerKuler = ekstrapenger($TotalRan,$Kulerekstra);

        // Sjekk hva dere raner
        if($RanInfo['RanValg'] == 'En kiosk') { if(KlareRan($TotalRan,'3') == 'Kansje') { 
        
        // Viktige variabler
        $DuTjener = sumblir($GrunnGevinst,'20');
        $TjenerVis = VerdiSum($DuTjener,'kr');
        $VenteTid = $Timestamp + '36000';

        // Brukernavn
        $MedEn = $BrukerEn['brukernavn'];
        $MedTo = $BrukerTo['brukernavn'];
        $MedTre = $BrukerTre['brukernavn'];
        $MedFire = $BrukerFire['brukernavn'];
        
        // Ny rankprosent
        $MedEnRank = NyRankpros($BrukerEn['rank_nivaa'],$BrukerEn['rankpros']);
        $MedToRank = NyRankpros($BrukerTo['rank_nivaa'],$BrukerTo['rankpros']);
        $MedTreRank = NyRankpros($BrukerTre['rank_nivaa'],$BrukerTre['rankpros']);
        $MedFireRank = NyRankpros($BrukerFire['rank_nivaa'],$BrukerFire['rankpros']);
        $MedFemRank = NyRankpros($rank_niva,$rankpros);

      
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedEnRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedEn'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedToRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTo'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedTreRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTre'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFireRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedFire'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFemRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$brukernavn'")or die(mysql_error());

      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedEn','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTo','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTre','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedFire','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Planlagt ran','Ranet ditt var vellykket, alle fikk $TjenerVis hver.','Ja')");

      
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$brukernavn' AND id='$IdEr'");
        echo PrintTeksten("Ranet var vellykket!",'1',"Vellykket");
    
        } else {
      
        $Klare = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        while($Info = mysql_fetch_assoc($Klare)) { 
        if($Info['DinJobb'] == 'Sjåfør') { sjofor($Info['Utstyr'], $Info['Brukernavn']); } 
        elseif($Info['DinJobb'] == 'Våpenmann') { vopenmann($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Eksplosiv') { eksplosiv($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Alarm ekspert') { alarmekspert($Info['Utstyr'], $Info['Brukernavn']); }}
        $Tekst = planlegger($brukernavn,$plan_ran,$IdEr);
        echo PrintTeksten("$Tekst",'1',"Feilet");
        }} elseif($RanInfo['RanValg'] == 'En matbutikk') {  if(KlareRan($TotalRan,'40') == 'Kansje') { 
        

        // Viktige variabler
        $DuTjener = sumblir($GrunnGevinst,'30');
        $TjenerVis = VerdiSum($DuTjener,'kr');
        $VenteTid = $Timestamp + '36000';

        // Brukernavn
        $MedEn = $BrukerEn['brukernavn'];
        $MedTo = $BrukerTo['brukernavn'];
        $MedTre = $BrukerTre['brukernavn'];
        $MedFire = $BrukerFire['brukernavn'];
        
        // Ny rankprosent
        $MedEnRank = NyRankpros($BrukerEn['rank_nivaa'],$BrukerEn['rankpros']);
        $MedToRank = NyRankpros($BrukerTo['rank_nivaa'],$BrukerTo['rankpros']);
        $MedTreRank = NyRankpros($BrukerTre['rank_nivaa'],$BrukerTre['rankpros']);
        $MedFireRank = NyRankpros($BrukerFire['rank_nivaa'],$BrukerFire['rankpros']);
        $MedFemRank = NyRankpros($rank_niva,$rankpros);

      
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedEnRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedEn'")or die(mysql_error()); 
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedToRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTo'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedTreRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTre'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFireRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedFire'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFemRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$brukernavn'")or die(mysql_error());

      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedEn','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTo','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTre','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedFire','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Planlagt ran','Ranet ditt var vellykket, alle fikk $TjenerVis hver.','Ja')");

      
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$brukernavn' AND id='$IdEr'");
        echo PrintTeksten("Ranet var vellykket!",'1',"Vellykket");


        
        } else { 
      
        $Klare = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        while($Info = mysql_fetch_assoc($Klare)) { 
        if($Info['DinJobb'] == 'Sjåfør') { sjofor($Info['Utstyr'], $Info['Brukernavn']); } 
        elseif($Info['DinJobb'] == 'Våpenmann') { vopenmann($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Eksplosiv') { eksplosiv($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Alarm ekspert') { alarmekspert($Info['Utstyr'], $Info['Brukernavn']); }}
        $Tekst = planlegger($brukernavn,$plan_ran,$IdEr);
        echo PrintTeksten("$Tekst",'1',"Feilet");
        }}elseif($RanInfo['RanValg'] == 'En kulefabrikk') { if(KlareRan($TotalRan,'80') == 'Kansje') { 

        // Viktige variabler
        $TjenerKuler = sumblir($TjenerKuler,'1.2');
        $DuTjener = sumblir($GrunnGevinst,'40');
        $TjenerVis = VerdiSum($DuTjener,'kr');
        $TjenerKulerVis = VerdiSum($TjenerKuler,'kuler');

        $VenteTid = $Timestamp + '36000';
        
        // Brukernavn
        $MedEn = $BrukerEn['brukernavn'];
        $MedTo = $BrukerTo['brukernavn'];
        $MedTre = $BrukerTre['brukernavn'];
        $MedFire = $BrukerFire['brukernavn'];
        
        // Ny rankprosent
        $MedEnRank = NyRankpros($BrukerEn['rank_nivaa'],$BrukerEn['rankpros']);
        $MedToRank = NyRankpros($BrukerTo['rank_nivaa'],$BrukerTo['rankpros']);
        $MedTreRank = NyRankpros($BrukerTre['rank_nivaa'],$BrukerTre['rankpros']);
        $MedFireRank = NyRankpros($BrukerFire['rank_nivaa'],$BrukerFire['rankpros']);
        $MedFemRank = NyRankpros($rank_niva,$rankpros);

      
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedEnRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener',kuler=`kuler`+'$TjenerKuler' WHERE brukernavn='$MedEn'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedToRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener',kuler=`kuler`+'$TjenerKuler' WHERE brukernavn='$MedTo'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedTreRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener',kuler=`kuler`+'$TjenerKuler' WHERE brukernavn='$MedTre'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFireRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener',kuler=`kuler`+'$TjenerKuler' WHERE brukernavn='$MedFire'")or die(mysql_error());
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFemRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener',kuler=`kuler`+'$TjenerKuler' WHERE brukernavn='$brukernavn'")or die(mysql_error()); 

      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedEn','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis og $TjenerKulerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTo','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis og $TjenerKulerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTre','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis og $TjenerKulerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedFire','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis og $TjenerKulerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Planlagt ran','Ranet ditt var vellykket, alle fikk $TjenerVis og $TjenerKulerVis hver.','Ja')");

      
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$brukernavn' AND id='$IdEr'");
        echo PrintTeksten("Ranet var vellykket!",'1',"Vellykket");

        
        } else { 
      
        $Klare = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        while($Info = mysql_fetch_assoc($Klare)) { 
        if($Info['DinJobb'] == 'Sjåfør') { sjofor($Info['Utstyr'], $Info['Brukernavn']); } 
        elseif($Info['DinJobb'] == 'Våpenmann') { vopenmann($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Eksplosiv') { eksplosiv($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Alarm ekspert') { alarmekspert($Info['Utstyr'], $Info['Brukernavn']); }}
        $Tekst = planlegger($brukernavn,$plan_ran,$IdEr);
        echo PrintTeksten("$Tekst",'1',"Feilet");
        }}elseif($RanInfo['RanValg'] == 'En bank') { if(KlareRan($TotalRan,'160') == 'Kansje') { 


        // Viktige variabler
        $DuTjener = sumblir($GrunnGevinst,'50');
        $TjenerVis = VerdiSum($DuTjener,'kr');
        $VenteTid = $Timestamp + '36000';

        // Brukernavn
        $MedEn = $BrukerEn['brukernavn'];
        $MedTo = $BrukerTo['brukernavn'];
        $MedTre = $BrukerTre['brukernavn'];
        $MedFire = $BrukerFire['brukernavn'];
        
        // Ny rankprosent
        $MedEnRank = NyRankpros($BrukerEn['rank_nivaa'],$BrukerEn['rankpros']);
        $MedToRank = NyRankpros($BrukerTo['rank_nivaa'],$BrukerTo['rankpros']);
        $MedTreRank = NyRankpros($BrukerTre['rank_nivaa'],$BrukerTre['rankpros']);
        $MedFireRank = NyRankpros($BrukerFire['rank_nivaa'],$BrukerFire['rankpros']);
        $MedFemRank = NyRankpros($rank_niva,$rankpros);

      
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedEnRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedEn'"); 
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedToRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTo'"); 
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedTreRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedTre'"); 
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFireRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$MedFire'"); 
        mysql_query("UPDATE brukere SET plan_ran=`plan_ran`+'1',rankpros='$MedFemRank',plan_tid='$VenteTid',penger=`penger`+'$DuTjener' WHERE brukernavn='$brukernavn'"); 

      
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedEn','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTo','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedTre','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$MedFire','$Timestamp','$FullDato','Planlagt ran','Ranet var vellykket, du kom unna med $TjenerVis.','Ja')");
        mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$brukernavn','$Timestamp','$FullDato','Planlagt ran','Ranet ditt var vellykket, alle fikk $TjenerVis hver.','Ja')");

      
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE RanID='$IdEr'");
        mysql_query("DELETE FROM PlanlagtRan WHERE StartetAv='$brukernavn' AND id='$IdEr'");
        echo PrintTeksten("Ranet var vellykket!",'1',"Vellykket");

        
        } else { 
      
        $Klare = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$IdEr' AND ErMedEll='Ja'");
        while($Info = mysql_fetch_assoc($Klare)) { 
        if($Info['DinJobb'] == 'Sjåfør') { sjofor($Info['Utstyr'], $Info['Brukernavn']); } 
        elseif($Info['DinJobb'] == 'Våpenmann') { vopenmann($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Eksplosiv') { eksplosiv($Info['Utstyr'], $Info['Brukernavn']); }
        elseif($Info['DinJobb'] == 'Alarm ekspert') { alarmekspert($Info['Utstyr'], $Info['Brukernavn']); }}
        $Tekst = planlegger($brukernavn,$plan_ran,$IdEr);
        echo PrintTeksten("$Tekst",'1',"Feilet");
        }}}}
        ?>