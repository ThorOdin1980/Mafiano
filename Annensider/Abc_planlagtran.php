        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else {
        
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
        
      
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
        
        // Sjekker om du har startet et planlagt ran
      
        $PrSjekk = mysql_query("SELECT * FROM PlanlagtRan WHERE StartetAv='$brukernavn'");
        if(mysql_num_rows($PrSjekk) == '1') { 
        $RanInfo = mysql_fetch_assoc($PrSjekk);
        $SjekkYoen = 'femti';
        include "Annensider/Abc_dittplanlagteran.php";
        } else { 
        // Sjekker om du er med i et planlagt ran
      
        $PrSjekkTo = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Ja'");
        if(mysql_num_rows($PrSjekkTo) == '1') { 
        $MedlemInfo = mysql_fetch_assoc($PrSjekkTo);
        $RanID = $MedlemInfo['RanID'];
        $IDenER = $MedlemInfo['Id'];

        $HentRan = mysql_query("SELECT * FROM PlanlagtRan WHERE id='$RanID'");
        $RanInfo = mysql_fetch_assoc($HentRan);

        // Hent mer info
      
        $PrSjekkFire = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE RanID='$RanID' AND ErMedEll='Ja'");
        $AntallBlir = mysql_num_rows($PrSjekkFire) + '1';
        if($AntallBlir == '0') { $ForbrytereMed = 'Det er ingen forbrytere med på ranet enda.'; } else { $ForbrytereMed = "Det er $AntallBlir forbryter/e med på ranet."; }
        if(mysql_num_rows($PrSjekkFire) == '4') { $KlartEll = "Alle er klare, venter bare på at lederen skal starte."; } else { $KlartEll = 'Alle er ikke klare enda.';  }

        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PLANLAGT RAN</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/planlagtran.jpg\" width=\"490\" height=\"200\"></div>";
        
        if(isset($_POST['HandlePR2'])) { 
        if($MedlemInfo['BetaltEll'] == 'Nei') { 
        if($MedlemInfo['DinJobb'] == 'Sjåfør') { 
        $ValgBiler = mysql_real_escape_string($_POST['Biler']); 
        $ValgArmering = mysql_real_escape_string($_POST['Armer']); 
        $ValgBestikk = mysql_real_escape_string($_POST['Bestikk']); 
        $ValgVopen = mysql_real_escape_string($_POST['Vopen']); 
        if(empty($ValgBiler) || empty($ValgArmering) || empty($ValgBestikk) || empty($ValgVopen)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du fylte ikke ut alle feltene, fyll inn alt på nytt.</span></div>'; } else { 
        if($ValgBiler == 'Nissan Sunny' || $ValgBiler == 'Ford Explorer' || $ValgBiler == 'Audi A3' || $ValgBiler == 'Hummer H3' || $ValgBiler == 'BMW 520' || $ValgBiler == 'Dodge RAM' || $ValgBiler == 'Jeep Commander' || $ValgBiler == 'BMW 750' || $ValgBiler == 'Porsche Cayenne 4,8 Turbo') { 
        if($ValgArmering == 'Skal ikke armere bilen' || $ValgArmering == 'Oppgrader bilen til skuddsikker bil' || $ValgArmering == 'Oppgrader bilen til bombesikker') { 
        if($ValgBestikk == 'Skal ikke bestikke' || $ValgBestikk == 'Bestikk lokale politibiler' || $ValgBestikk == 'Bestikk all politivirksomhet som har med trafikk') { 
        if($ValgVopen == 'Skal ikke ha våpen' || $ValgVopen == 'Pistol' || $ValgVopen == 'Uzi') { 
        if($ValgBiler == 'Nissan Sunny') { $BilKostnad = '50000'; } elseif($ValgBiler == 'Ford Explorer') { $BilKostnad = '140000'; } elseif($ValgBiler == 'Audi A3') { $BilKostnad = '200000'; } elseif($ValgBiler == 'Hummer H3') { $BilKostnad = '400000'; } elseif($ValgBiler == 'BMW 520') { $BilKostnad = '500000'; } elseif($ValgBiler == 'Dodge RAM') { $BilKostnad = '650000'; } elseif($ValgBiler == 'Jeep Commander') { $BilKostnad = '789060'; } elseif($ValgBiler == 'BMW 750') { $BilKostnad = '1500000'; } elseif($ValgBiler == 'Porsche Cayenne 4,8 Turbo') { $BilKostnad = '2254000'; }
        if($ValgArmering == 'Skal ikke armere bilen') { $ArmerKostnad = '0'; $Armor = ''; } elseif($ValgArmering == 'Oppgrader bilen til skuddsikker bil') { $ArmerKostnad = '10000'; $Armor = 'Ingen armering Skuddsikker bil'; } elseif($ValgArmering == 'Oppgrader bilen til bombesikker') { $ArmerKostnad = '150000'; $Armor = 'Bombesikker bil';  }
        if($ValgBestikk == 'Skal ikke bestikke') { $BestikkKostnad = '0'; $Bestikko = 'Ingen bestikkes'; } elseif($ValgBestikk == 'Bestikk lokale politibiler') { $BestikkKostnad = '3'; $Bestikko = 'Betalte lokale politibiler mot at dem holder munn'; } elseif($ValgBestikk == 'Bestikk all politivirksomhet som har med trafikk') { $BestikkKostnad = '5'; $Bestikko = '
        All politivirksomhet som gjelder trafikk er sikkret'; }
        if($ValgVopen == 'Skal ikke ha våpen') { $VopenKostnad = '0'; $Vopeno = 'Ingen'; } elseif($ValgVopen == 'Pistol') { $VopenKostnad = '30000'; $Vopeno = 'Pistol'; } elseif($ValgVopen == 'Uzi') { $VopenKostnad = '90000'; $Vopeno = 'Uzi'; }
        $Kostnad_KR = $BilKostnad + $ArmerKostnad + $VopenKostnad;
        $Kostnad_PG = $BestikkKostnad;
        $Utstyr = "$ValgBiler<br>$Armor<br>$Bestikko<br>$Vopeno";
        if($penger > $Kostnad_KR) {  
        if($turns >= $Kostnad_PG) { 
        $NySumCash = floor($penger - $Kostnad_KR);
        $NySumPoeng = $turns - $Kostnad_PG;
      
        mysql_query("UPDATE brukere SET penger='$NySumCash',turns='$NySumPoeng',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE PlanlagtRan SET PoengBrukt=`PoengBrukt`+'$Kostnad_PG',PengerBrukt=`PengerBrukt`+'$Kostnad_KR' WHERE id='$RanID'"); 
        mysql_query("UPDATE PlanlagtRanBrukere SET PengerBrukt='$Kostnad_KR',PoengBrukt='$Kostnad_PG',Utstyr='$Utstyr',BetaltEll='Ja' WHERE Id='$IDenER' AND Brukernavn='$brukernavn'"); 
        header("Location: game.php?side=PlanlagtRan");
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok poeng.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av våpen.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av bestikkelse.</span></div>';  }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av armering.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte en ugyldig bil.</span></div>'; }
        }} 
        elseif($MedlemInfo['DinJobb'] == 'Våpenmann') { 
        $ValgVopen = mysql_real_escape_string($_POST['Vopen']); 
        $ValgBeskyttelse = mysql_real_escape_string($_POST['Beskyttelse']); 
        $ValgBestikk = mysql_real_escape_string($_POST['Bestikk']); 
        if(empty($ValgVopen) || empty($ValgBeskyttelse) || empty($ValgBestikk)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du fylte ikke ut alle feltene, fyll inn alt på nytt.</span></div>'; } else { 
        if($ValgVopen == 'Pistol' || $ValgVopen == 'Uzi' || $ValgVopen == 'Ak-47' || $ValgVopen == 'Pistol,Uzi,Ak-47') { 
        if($ValgBeskyttelse == 'Skal ikke ha beskyttelse' || $ValgBeskyttelse == 'Skuddsikker vest' || $ValgBeskyttelse == 'Skuddsikker drakt') { 
        if($ValgBestikk == 'Skal ikke bestikke' || $ValgBestikk == 'Bestikk lokale politimenn' || $ValgBestikk == 'Bestikk all politivirksomhet langs gata') {
        if($ValgVopen == 'Pistol') { $VopenKostnad = '30000'; } elseif($ValgVopen == 'Uzi') { $VopenKostnad = '90000'; } elseif($ValgVopen == 'Ak-47') { $VopenKostnad = '450000'; } elseif($ValgVopen == 'Pistol,Uzi,Ak-47') { $VopenKostnad = '570000'; }
        if($ValgBeskyttelse == 'Skal ikke ha beskyttelse') { $BeskyttKostnad = '0'; $Beskyto = 'Ingen beskyttelse'; } elseif($ValgBeskyttelse == 'Skuddsikker vest') { $BeskyttKostnad = '50000'; $Beskyto = 'Skuddsikker vest'; } elseif($ValgBeskyttelse == 'Skuddsikker drakt') { $BeskyttKostnad = '150000'; $Beskyto = 'Skuddsikker drakt'; }
        if($ValgBestikk == 'Skal ikke bestikke') { $Bestikko = 'Ingen bestikkes'; $BestikkKostnad = '0'; } elseif($ValgBestikk == 'Bestikk lokale politimenn') { $Bestikko = 'Bestikk lokale politimenn'; $BestikkKostnad = '3'; } elseif($ValgBestikk == 'Bestikk all politivirksomhet langs gata') { $Bestikko = 'Bestikk all politivirksomhet langs gata'; $BestikkKostnad = '5'; }
        $Kostnad_KR = $VopenKostnad + $BeskyttKostnad;
        $Kostnad_PG = $BestikkKostnad;
        $Utstyr = "$ValgVopen<br>$Beskyto<br>$Bestikko";
        if($penger > $Kostnad_KR) {  
        if($turns >= $Kostnad_PG) { 
        $NySumCash = floor($penger - $Kostnad_KR);
        $NySumPoeng = $turns - $Kostnad_PG;
      
        mysql_query("UPDATE brukere SET penger='$NySumCash',turns='$NySumPoeng',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE PlanlagtRan SET PoengBrukt=`PoengBrukt`+'$Kostnad_PG',PengerBrukt=`PengerBrukt`+'$Kostnad_KR' WHERE id='$RanID'"); 
        mysql_query("UPDATE PlanlagtRanBrukere SET PengerBrukt='$Kostnad_KR',PoengBrukt='$Kostnad_PG',Utstyr='$Utstyr',BetaltEll='Ja' WHERE Id='$IDenER' AND Brukernavn='$brukernavn'"); 
        header("Location: game.php?side=PlanlagtRan");
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok poeng.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av bestikkelse.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte en ugyldig beskyttelse.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av våpen.</span></div>'; }
        }}
        elseif($MedlemInfo['DinJobb'] == 'Eksplosiv') {
        $ValgTnt = mysql_real_escape_string($_POST['Tnt']); 
        $ValgBeskyttelse = mysql_real_escape_string($_POST['Beskyttelse']); 
        $ValgVopen = mysql_real_escape_string($_POST['Vopen']); 
        if(empty($ValgTnt) || empty($ValgBeskyttelse) || empty($ValgVopen)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du fylte ikke ut alle feltene, fyll inn alt på nytt.</span></div>'; } else { 
        if($ValgTnt == '1kg tnt' || $ValgTnt == '2kg tnt' || $ValgTnt == '4kg tnt' || $ValgTnt == '8kg tnt') { 
        if($ValgBeskyttelse == 'Skal ikke ha beskyttelse' || $ValgBeskyttelse == 'Bombesikker vest' || $ValgBeskyttelse == 'Bombesikker drakt') { 
        if($ValgVopen == 'Skal ikke ha våpen' || $ValgVopen == 'Pistol' || $ValgVopen == 'Uzi') { 
        if($ValgTnt == '1kg tnt') { $TntKostnad = '30000'; } elseif($ValgTnt == '2kg tnt') { $TntKostnad = '60000'; } elseif($ValgTnt == '4kg tnt') { $TntKostnad = '120000'; } elseif($ValgTnt == '8kg tnt') { $TntKostnad = '240000'; } 
        if($ValgBeskyttelse == 'Skal ikke ha beskyttelse') { $BeskKostnad = '0'; $Beskytto = 'Ingen beskyttelse'; } elseif($ValgBeskyttelse == 'Bombesikker vest') { $BeskKostnad = '70000'; $Beskytto = $ValgBeskyttelse; } elseif($ValgBeskyttelse == 'Bombesikker drakt') { $BeskKostnad = '145000'; $Beskytto = $ValgBeskyttelse; }
        if($ValgVopen == 'Skal ikke ha våpen') { $VopenKostnad = '0'; $Voppeno = 'Ingen'; } elseif($ValgVopen == 'Pistol') { $VopenKostnad = '30000'; $Voppeno = 'Pistol'; } elseif($ValgVopen == 'Uzi') { $VopenKostnad = '90000'; $Voppeno = 'Uzi'; }
        $Kostnad_KR = $TntKostnad + $BeskKostnad + $VopenKostnad;
        $Utstyr = "$ValgTnt<br>$Beskytto<br>$Voppeno";
        if($penger > $Kostnad_KR) {  
        $NySumCash = floor($penger - $Kostnad_KR);
      
        mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE PlanlagtRan SET PengerBrukt=`PengerBrukt`+'$Kostnad_KR' WHERE id='$RanID'"); 
        mysql_query("UPDATE PlanlagtRanBrukere SET PengerBrukt='$Kostnad_KR',PoengBrukt='0',Utstyr='$Utstyr',BetaltEll='Ja' WHERE Id='$IDenER' AND Brukernavn='$brukernavn'"); 
        header("Location: game.php?side=PlanlagtRan");
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av våpen.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte en ugyldig beskyttelse.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av tnt.</span></div>'; }
        }}
        elseif($MedlemInfo['DinJobb'] == 'Alarm ekspert') {
        $ValgVerktoy = mysql_real_escape_string($_POST['Verktoy']); 
        $ValgBestikk = mysql_real_escape_string($_POST['Bestikk']); 
        $ValgVopen = mysql_real_escape_string($_POST['Vopen']);  
        if(empty($ValgVerktoy) || empty($ValgBestikk) || empty($ValgVopen)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du fylte ikke ut alle feltene, fyll inn alt på nytt.</span></div>'; } else { 
        if($ValgVerktoy == 'Verktøykasse' || $ValgVerktoy == 'Verktøykasse,Disrøpter') { 
        if($ValgBestikk == 'Skal ikke bestikke' || $ValgBestikk == 'Arranger strømbrudd' || $ValgBestikk == 'Bestikk overvåkings-opratørene') { 
        if($ValgVopen == 'Skal ikke ha våpen' || $ValgVopen == 'Pistol' || $ValgVopen == 'Uzi') { 
        if($ValgVerktoy == 'Verktøykasse') { $VerkKostnad = '100000'; } elseif($ValgVerktoy == 'Verktøykasse,Disrøpter') { $VerkKostnad = '490000'; }
        if($ValgBestikk == 'Skal ikke bestikke') { $BestikkKostnad = '0'; $Bestikko = 'Ingen bestikkes'; } elseif($ValgBestikk == 'Arranger strømbrudd') { $BestikkKostnad = '3'; $Bestikko = 'Oppratører bestikkes til å arrangere strømbrudd'; } elseif($ValgBestikk == 'Bestikk overvåkings-opratørene') { $BestikkKostnad = '5'; $Bestikko = 'Oppratørene bestikkes til å ignorere alt'; }
        if($ValgVopen == 'Skal ikke ha våpen') { $Voppo = 'Ingen'; $VopenKostnad = '0'; } elseif($ValgVopen == 'Pistol') { $Voppo = 'Pistol'; $VopenKostnad = '30000'; } elseif($ValgVopen == 'Uzi') { $Voppo = 'Uzi'; $VopenKostnad = '90000'; }
        $Kostnad_KR = $VerkKostnad + $VopenKostnad;
        $Kostnad_PG = $BestikkKostnad;
        $Utstyr = "$ValgVerktoy<br>$Bestikko<br>$Voppo<br>";
        if($penger > $Kostnad_KR) {  
        if($turns >= $Kostnad_PG) { 
        $NySumCash = floor($penger - $Kostnad_KR);
        $NySumPoeng = $turns - $Kostnad_PG;
      
        mysql_query("UPDATE brukere SET penger='$NySumCash',turns='$NySumPoeng',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE PlanlagtRan SET PoengBrukt=`PoengBrukt`+'$Kostnad_PG',PengerBrukt=`PengerBrukt`+'$Kostnad_KR' WHERE id='$RanID'"); 
        mysql_query("UPDATE PlanlagtRanBrukere SET PengerBrukt='$Kostnad_KR',PoengBrukt='$Kostnad_PG',Utstyr='$Utstyr',BetaltEll='Ja' WHERE Id='$IDenER' AND Brukernavn='$brukernavn'"); 
        header("Location: game.php?side=PlanlagtRan");
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok poeng.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av våpen.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du valgte et ugyldig valg av bestikkelse.</span></div>'; }
        } else { echo '<div class="Div_MELDING"><span class="Span_str_5">Ugyldig valg av verktøy.</span></div>';  }
        }}} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har handlet det du trenger tidligere.</span></div>'; }} elseif(isset($_POST['ForlatPR2'])) {
      
        $HentInfos = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Ja'");
        $Infos = mysql_fetch_assoc($HentInfos);
        $PengerBrukt = $Infos['PengerBrukt'];
        $PoengBrukt = $Infos['PoengBrukt'];
        $RanIDp = $Infos['RanID'];
        $IDenERp = $Infos['Id'];
      
        mysql_query("UPDATE brukere SET penger=`penger`+'$PengerBrukt',turns=`turns`+'$PoengBrukt',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("UPDATE PlanlagtRan SET PoengBrukt=`PoengBrukt`-'$PoengBrukt',PengerBrukt=`PengerBrukt`-'$PengerBrukt' WHERE Id='$RanIDp'"); 
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND Id='$IDenERp'");
        header("Location: game.php?side=PlanlagtRan");
        }
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Ran startet</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">".$RanInfo['DatoStartet']." av <a href=\"game.php?side=Bruker&navn=".urlencode($RanInfo['StartetAv'])."\">".htmlspecialchars($RanInfo['StartetAv'])."</a></span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Forbrytere</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$ForbrytereMed</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Klarsignal</span></div>
        <div class=\"Div_hoyre_side_1\"><span class=\"Span_str_9\">$KlartEll</span></div>";

                
        if($MedlemInfo['BetaltEll'] == 'Nei') { 
        if($MedlemInfo['DinJobb'] == 'Sjåfør') { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">KJØP UTSTYR</span></div>
        <div class=\"Div_venstre_side_1\"><form method=\"post\" id=\"HandlePR\"><span class=\"Span_str_1\">Bil</span></div><input type=\"hidden\" value=\"Post\" name=\"HandlePR2\" id=\"HandlePR2\">
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Biler\"><option value=\"Nissan Sunny\">Nissan Sunny - 50.000 kr</option><option value=\"Ford Explorer\">Ford Explorer - 140.000 kr</option><option value=\"Audi A3\">Audi A3 - 200.000 kr</option><option value=\"Hummer H3\">Hummer H3 - 400.000 kr</option><option value=\"BMW 520\">BMW 520 - 500.000 kr</option><option value=\"Dodge RAM\">Dodge RAM - 650.000 kr</option><option value=\"Jeep Commander\">Jeep Commander - 789.060 kr</option><option value=\"BMW 750\">BMW 750 - 1.500.000 kr</option><option value=\"Porsche Cayenne 4,8 Turbo\">Porsche Cayenne 4,8 Turbo - 2.254.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Armer bilen</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Armer\"><option value=\"Skal ikke armere bilen\">Skal ikke armere bilen - 0 kr</option><option value=\"Oppgrader bilen til skuddsikker bil\">Oppgrader bilen til skuddsikker bil - 100.000 kr</option><option value=\"Oppgrader bilen til bombesikker\">Oppgrader bilen til bombesikker - 150.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bestikk</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Bestikk\"><option value=\"Skal ikke bestikke\">Skal ikke bestikke - 0 poeng</option><option value=\"Bestikk lokale politibiler\">Bestikk lokale politibiler - 3 poeng</option><option value=\"Bestikk all politivirksomhet som har med trafikk\">Bestikk all politivirksomhet som har med trafikk - 5 poeng</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Våpen</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Vopen\"><option value=\"Skal ikke ha våpen\">Skal ikke ha våpen - 0 kr</option><option value=\"Pistol\">Pistol - 30.000 kr</option><option value=\"Uzi\">Uzi - 90.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('HandlePR').submit()\"><p class=\"pan_str_2\">BETAL</p></form></div>
        "; 
        } 
        elseif($MedlemInfo['DinJobb'] == 'Våpenmann') { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">KJØP UTSTYR</span></div>
        <div class=\"Div_venstre_side_1\"><form method=\"post\" id=\"HandlePR\"><span class=\"Span_str_1\">Våpen</span></div><input type=\"hidden\" value=\"Post\" name=\"HandlePR2\" id=\"HandlePR2\">
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Vopen\"><option value=\"Pistol\">Pistol - 30.000 kr</option><option value=\"Uzi\">Uzi - 90.000 kr</option><option value=\"Ak-47\">Ak-47 - 450.000 kr</option><option value=\"Pistol,Uzi,Ak-47\">Pistol + Uzi + Ak-47 - 570.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Beskyttelse</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Beskyttelse\"><option value=\"Skal ikke ha beskyttelse\">Skal ikke ha beskyttelse - 0 kr</option><option value=\"Skuddsikker vest\">Skuddsikker vest - 50.000 kr</option><option value=\"Skuddsikker drakt\">Skuddsikker drakt - 150.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bestikk</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Bestikk\"><option value=\"Skal ikke bestikke\">Skal ikke bestikke - 0 poeng</option><option value=\"Bestikk lokale politimenn\">Bestikk lokale politimenn - 3 poeng</option><option value=\"Bestikk all politivirksomhet langs gata\">Bestikk all politivirksomhet langs gata - 5 poeng</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('HandlePR').submit()\"><p class=\"pan_str_2\">BETAL</p></form></div>
        "; 
        } 
        elseif($MedlemInfo['DinJobb'] == 'Eksplosiv') { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">KJØP UTSTYR</span></div>
        <div class=\"Div_venstre_side_1\"><form method=\"post\" id=\"HandlePR\"><span class=\"Span_str_1\">Eksplosiver</span></div><input type=\"hidden\" value=\"Post\" name=\"HandlePR2\" id=\"HandlePR2\">
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Tnt\"><option value=\"1kg tnt\">1 kg tnt - 30.000 kr</option><option value=\"2kg tnt\">2 kg tnt - 60.000 kr</option><option value=\"4kg tnt\">4 kg tnt - 120.000 kr</option><option value=\"8kg tnt\">8 kg tnt - 240.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Beskyttelse</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Beskyttelse\"><option value=\"Skal ikke ha beskyttelse\">Skal ikke ha beskyttelse - 0 kr</option><option value=\"Bombesikker vest\">Bombesikker vest - 70.000 kr</option><option value=\"Bombesikker drakt\">Bombesikker drakt - 145.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Våpen</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Vopen\"><option value=\"Skal ikke ha våpen\">Skal ikke ha våpen - 0 kr</option><option value=\"Pistol\">Pistol - 30.000 kr</option><option value=\"Uzi\">Uzi - 90.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('HandlePR').submit()\"><p class=\"pan_str_2\">BETAL</p></form></div>
        "; 
        }
        elseif($MedlemInfo['DinJobb'] == 'Alarm ekspert') { 
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">KJØP UTSTYR</span></div>
        <div class=\"Div_venstre_side_1\"><form method=\"post\" id=\"HandlePR\"><span class=\"Span_str_1\">Utstyr</span></div><input type=\"hidden\" value=\"Post\" name=\"HandlePR2\" id=\"HandlePR2\">
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Verktoy\"><option value=\"Verktøykasse\">Verktøykasse - 100.000 kr</option><option value=\"Verktøykasse,Disrøpter\">Verktøykasse + Disrøpter - 490.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bestikk</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Bestikk\"><option value=\"Skal ikke bestikke\">Skal ikke bestikke - 0 poeng</option><option value=\"Arranger strømbrudd\">Strømbrudd på 50% av all overvåking - 3 poeng</option><option value=\"Bestikk overvåkings-opratørene\">Bestikk overvåknings-opratørene - 5 poeng</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Våpen</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Vopen\"><option value=\"Skal ikke ha våpen\">Skal ikke ha våpen - 0 kr</option><option value=\"Pistol\">Pistol - 30.000 kr</option><option value=\"Uzi\">Uzi - 90.000 kr</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('HandlePR').submit()\"><p class=\"pan_str_2\">BETAL</p></form></div>
        ";
        }}

        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\"></span><form method=\"post\" id=\"ForlatPr\"><input type=\"hidden\" value=\"Post\" name=\"ForlatPR2\" id=\"ForlatPR2\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('ForlatPr').submit()\"><p class=\"pan_str_2\">FORLAT DETTE PLANLAGTE RANET</p></form></div>
        </div>";
        
        } else {
        if($plan_tid > $tiden) { 
        $TidenVente = $plan_tid - $tiden;
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PLANLAGT RAN</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/planlagtran.jpg\" width=\"490\" height=\"200\"></div>
        <div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du må vente <span id=\"tell\">$TidenVente</span> sekunder før du kan utføre et nytt ran.</span></div>
        </div>";
        } else {

        if ($rank_niva < '5' ) { 
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PLANLAGT RAN</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/planlagtran.jpg\" width=\"490\" height=\"200\"></div>";
        
        if(isset($_POST['action42s'])) { 
        $DittValg = mysql_real_escape_string($_POST['action42s']); 
        $IdErHva = rengjor_tall(mysql_real_escape_string($_POST['Gill'])); 
        if($DittValg == 'Godta') { 
        if(empty($IdErHva)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en invitasjon.</span></div>'; } else { 
      
        $InvSjekk = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei' AND Id='$IdErHva'");
        if(mysql_num_rows($InvSjekk) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en invitasjon som ikke eksisterer.</span></div>'; } else { 
        mysql_query("UPDATE PlanlagtRanBrukere SET ErMedEll='Ja' WHERE Brukernavn='$brukernavn' AND Id='$IdErHva'"); 
        header("Location: game.php?side=PlanlagtRan");
        }}}elseif($DittValg == 'Avslaa') { 
        if(empty($IdErHva)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en invitasjon.</span></div>'; } else { 
      
        $InvSjekk = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei' AND Id='$IdErHva'");
        if(mysql_num_rows($InvSjekk) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en invitasjon som ikke eksisterer.</span></div>'; } else { 
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND Id='$IdErHva'");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har avlsått en invitasjon.</span></div>';
        }}}} else { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har ikke høy nok rank til å starte et ran.</span></div>"; }
               
        echo "
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">INVITASJONER TIL PLANLAGT RAN</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Invitert av</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Oppgave</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Dato</span></div>
        <div class=\"Div_top_2\"><span class=\"Span_str_1\">Merk</span><form method=\"post\" id=\"Invitasjoner\"><input type=\"hidden\" name=\"action42s\" id=\"du_valgteInv\"></div>";
        

      
        $SjekkInvitasjon = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei'");
        if(mysql_num_rows($SjekkInvitasjon) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ingen invitasjoner.</span></div>'; } else { 
        while($Rader = mysql_fetch_assoc($SjekkInvitasjon)) {
        $Idos = $Rader['Id'];  
        echo "
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;<a href=\"game.php?side=Bruker&navn=".urlencode($Rader['InvitertAv'])."\">".htmlspecialchars($Rader['InvitertAv'])."</a></div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;".$Rader['DinJobb']."</div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;".$Rader['dato']."</div>
        <div class=\"Div_bunn_2\">&nbsp;<input type=\"radio\" value=\"$Idos\" name=\"Gill\"></div>
        ";
        }}
        
        
        echo "
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('du_valgteInv').value='Godta';document.getElementById('Invitasjoner').submit()\"><p class=\"pan_str_2\">GODTA</p></div>
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('du_valgteInv').value='Avslaa';document.getElementById('Invitasjoner').submit()\"><p class=\"pan_str_2\">AVSLÅ</p></div>
        </form></div>";
        
        } else { 

        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">PLANLAGT RAN</span><form method=\"post\" id=\"PlanlagtRan\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/planlagtran.jpg\" width=\"490\" height=\"200\"></div>";
        
        if(isset($_POST['ranvalg'])) {
        $ranvalg = mysql_real_escape_string($_POST['ranvalg']); 
        if(empty($ranvalg)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må velge et av ran valgene.</span></div>'; } else { 
        if($ranvalg == 'En kiosk' || $ranvalg == 'En matbutikk' || $ranvalg == 'En kulefabrikk' || $ranvalg == 'En bank') { 
        if($ranvalg == 'En kiosk') { $Kostnad = '200000'; } 
        elseif($ranvalg == 'En matbutikk') { $Kostnad = '300000'; }
        elseif($ranvalg == 'En kulefabrikk') { $Kostnad = '400000'; }
        elseif($ranvalg == 'En bank') { $Kostnad = '500000'; }
        if($Kostnad > $penger) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; } else { 
        $NySumCash = floor($penger - $Kostnad);
      
        mysql_query("UPDATE brukere SET penger='$NySumCash',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
      
        mysql_query("INSERT INTO `PlanlagtRan` (DatoStartet,StampStartet,RanValg,PengerBrukt,StartetAv,Land) VALUES ('$tid $nbsp $dato $nbsp $aar','$tiden','$ranvalg','$Kostnad','$brukernavn','$land')");
        header("Location: game.php?side=PlanlagtRan");
        }} else { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig ran valg.</span></div>'; }}} elseif(isset($_POST['action42s'])) { 
        $DittValg = mysql_real_escape_string($_POST['action42s']); 
        $IdErHva = rengjor_tall(mysql_real_escape_string($_POST['Gill'])); 
        if($DittValg == 'Godta') { 
        if(empty($IdErHva)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en invitasjon.</span></div>'; } else { 
      
        $InvSjekk = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei' AND Id='$IdErHva'");
        if(mysql_num_rows($InvSjekk) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en invitasjon som ikke eksisterer.</span></div>'; } else { 
        mysql_query("UPDATE PlanlagtRanBrukere SET ErMedEll='Ja' WHERE Brukernavn='$brukernavn' AND Id='$IdErHva'"); 
        header("Location: game.php?side=PlanlagtRan");
        }}}elseif($DittValg == 'Avslaa') { 
        if(empty($IdErHva)) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke valgt en invitasjon.</span></div>'; } else { 
      
        $InvSjekk = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei' AND Id='$IdErHva'");
        if(mysql_num_rows($InvSjekk) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en invitasjon som ikke eksisterer.</span></div>'; } else { 
        mysql_query("DELETE FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND Id='$IdErHva'");
        echo '<div class="Div_MELDING"><span class="Span_str_6">Du har avlsått en invitasjon.</span></div>';
        }}}}
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Ran</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"ranvalg\"><option value=\"En kiosk\">En kiosk - 200.000 kr i startkostnad</option><option value=\"En matbutikk\">En matbutikk - 300.000 kr i startkostnad</option><option value=\"En kulefabrikk\">En kulefabrikk - 400.000 kr i startkostnad</option><option value=\"En bank\">En bank - 500.000 kr i startkostnad</option></select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('PlanlagtRan').submit()\"><p class=\"pan_str_2\">START PLANLAGT RAN</p></div></form>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">INVITASJONER TIL PLANLAGT RAN</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Invitert av</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Oppgave</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Dato</span></div>
        <div class=\"Div_top_2\"><span class=\"Span_str_1\">Merk</span><form method=\"post\" id=\"Invitasjoner\"><input type=\"hidden\" name=\"action42s\" id=\"du_valgteInv\"></div>";
        

      
        $SjekkInvitasjon = mysql_query("SELECT * FROM PlanlagtRanBrukere WHERE Brukernavn='$brukernavn' AND ErMedEll='Nei'");
        if(mysql_num_rows($SjekkInvitasjon) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ingen invitasjoner.</span></div>'; } else { 
        while($Rader = mysql_fetch_assoc($SjekkInvitasjon)) {
        $Idos = $Rader['Id']; 
        echo "
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;<a href=\"game.php?side=Bruker&navn=".urlencode($Rader['InvitertAv'])."\">".htmlspecialchars($Rader['InvitertAv'])."</a></div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;".$Rader['DinJobb']."</div>
        <div class=\"Div_bunn_1\">&nbsp;&nbsp;".$Rader['dato']."</div>
        <div class=\"Div_bunn_2\">&nbsp;<input type=\"radio\" value=\"$Idos\" name=\"Gill\"></div>
        ";
        }}

        echo "
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('du_valgteInv').value='Godta';document.getElementById('Invitasjoner').submit()\"><p class=\"pan_str_2\">GODTA</p></div>
        <div class=\"Div_submit_knapp_4\" onclick=\"document.getElementById('du_valgteInv').value='Avslaa';document.getElementById('Invitasjoner').submit()\"><p class=\"pan_str_2\">AVSLÅ</p></div>
        </form></div>";
                
        }}}}}}}}}
        ?>
        
        
