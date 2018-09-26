        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <SCRIPT TYPE="text/javascript">
        <!--
        function numbersonly(myfield, e, dec) { var key; var keychar;
        if (window.event) key = window.event.keyCode; else if (e) key = e.which; else return true; keychar = String.fromCharCode(key);
        if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
        return true; else if ((("0123456789").indexOf(keychar) > -1)) return true; else if (dec && (keychar == ".")) { myfield.form.elements[dec].focus(); return false; } else return false; }
        //-->
        </SCRIPT>
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
       
      
        $Varer = mysql_query("SELECT * FROM Undergrunn_varer WHERE vare_eier='$brukernavn' AND vare_plassert='$land' AND varer_ligger_hos LIKE 'Ingen'");
                                                                                                                         
        $Kokain_varer_land = "0";
        $Hasj_varer_land = "0";
        $Marihuana_varer_land = "0";
        $Heroin_varer_land = "0";
        $Ecstasy_varer_land = "0";
        $Flatskjerm_varer_land = "0";
        $pc_varer_land = "0";
        $Mobiltelefon_varer_land = "0";
        $Xbox_varer_land = "0";
        $Ipod_varer_land = "0";
        
        while($Narkotika = mysql_fetch_assoc($Varer)) { 
        if($Narkotika['vare_er'] == 'Kokain') { $Kokain_varer_land++; } 
        elseif($Narkotika['vare_er'] == 'Hasj') { $Hasj_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Marihuana') { $Marihuana_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Heroin') { $Heroin_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Ecstasy') { $Ecstasy_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Flatskjerm tv') { $Flatskjerm_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Komplett pc') { $pc_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Mobiltelefon') { $Mobiltelefon_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Xbox 360') { $Xbox_varer_land++; }
        elseif($Narkotika['vare_er'] == 'Ipod') { $Ipod_varer_land++; }
        }
        
        $reise_sekunder_er = $reise_tid - $tiden;
                
        echo "
        <div class=\"Div_masta\">
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">REIS MED PRIVATFLY</span><form method=\"post\" id=\"ReisPrivatfly\"></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Reis-fly-1.jpg\"></div>
        ";
        
        if (isset($_POST['VelgAntall'])) {
        $Velg_AntallVarer = rengjor_tall(mysql_real_escape_string($_POST['VelgAntall']));
        $Velg_NarkoVare = mysql_real_escape_string($_POST['NarkoValg']);
        $Velg_Handling = mysql_real_escape_string($_POST['HandlingFly']);
        $Velg_Fly = rengjor_tall(mysql_real_escape_string($_POST['FlyValg']));

        if(empty($Velg_NarkoVare) || empty($Velg_Handling) || empty($Velg_Fly)) { 
        echo "<div class=\"Div_MELDING\">";
        if(empty($Velg_NarkoVare)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hva du skal plassere på flyet.</span>"; }
        if(empty($Velg_Handling)) { echo "<span class=\"Span_str_5\">Du har ikke valgt om du skal avplassere varer eller plassere.</span>"; }
        if(empty($Velg_Fly)) { echo "<span class=\"Span_str_5\">Du har ikke valgt et fly.</span>"; }
        echo "</div>";
        } else {
        $Velg_Fly = $Velg_Fly / '23';
        if(strlen($Velg_AntallVarer) > '15') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke poste så mange siffer å forvente at det skal bli godkjent.</span></div>'; } else { 
        if($Velg_NarkoVare == 'Kokain' || $Velg_NarkoVare == 'Hasj' || $Velg_NarkoVare == 'Marihuana' || $Velg_NarkoVare == 'Heroin' || $Velg_NarkoVare == 'Ecstasy' || $Velg_NarkoVare == 'Flatskjerm' || $Velg_NarkoVare == 'Komplett' || $Velg_NarkoVare == 'Mobiltelefon' || $Velg_NarkoVare == 'Xbox' || $Velg_NarkoVare == 'Ipod') { 
        if($Velg_Handling == 'Avplasser' || $Velg_Handling == 'Plasser') { 
        if($Velg_Fly == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har desverre ingen fly i denne byen.</span></div>'; } else {
      
        $SjekkFly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er='1' AND Frakt_sted='$land' AND id LIKE '$Velg_Fly'");
        if (mysql_num_rows($SjekkFly) >= '1') {
        $GetFlyInfo = mysql_fetch_assoc($SjekkFly);
        $FlyetsNavn = $GetFlyInfo['Frakt_navn'];
        if($Velg_Handling == 'Avplasser') { 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE fly_osv SET PlassBrukt='0' WHERE id LIKE '$Velg_Fly'"); 
      
        mysql_query("UPDATE Undergrunn_varer SET varer_ligger_hos='Ingen',vare_plassert='$land' WHERE vare_eier='$brukernavn' AND varer_ligger_hos LIKE '$Velg_Fly'"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du har avplassert alle varene i det flyet du valgte</span></div>";
        } else { 
        if(empty($Velg_AntallVarer)) { echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har glemt å skrive inn antall varer du skal plassere på flyet.</span></div>"; } else { 
        if($Velg_NarkoVare == 'Kokain') { $DuHar = $Kokain_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer gram kokain på $FlyetsNavn."; } 
        elseif($Velg_NarkoVare == 'Hasj') { $DuHar = $Hasj_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer hasj kokain på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Marihuana') { $DuHar = $Marihuana_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer gram marihuana på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Heroin') { $DuHar = $Heroin_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer gram heroin på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Ecstasy') { $DuHar = $Ecstasy_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer tabeletter med ecstasy på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Flatskjerm') { $DuHar = $Flatskjerm_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer flatskjermer på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Komplett') { $DuHar = $pc_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer komplette pcer på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Mobiltelefon') { $DuHar = $Mobiltelefon_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer mobiltelefoner på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Xbox') { $DuHar = $Xbox_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer xboxer på $FlyetsNavn."; }
        elseif($Velg_NarkoVare == 'Ipod') { $DuHar = $Ipod_varer_land; $Tekst = "Du har plassert $Velg_AntallVarer ipoder på $FlyetsNavn."; }
        $AntallVarerBlir = $Velg_AntallVarer + $GetFlyInfo['PlassBrukt'];
        if($Velg_AntallVarer > $DuHar) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke plassere flere varer en du har.</span></div>'; } else { 
        if($AntallVarerBlir > $GetFlyInfo['Frakt_kapasistet']) { echo '<div class="Div_MELDING"><span class="Span_str_5">Totalsummen av varer på flyet og varer du skal plassere på flyet overstiger max plassen til dette flyet, du har ikke plass til alle varene på flyet..</span></div>'; } else { 
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE fly_osv SET PlassBrukt='$AntallVarerBlir' WHERE id LIKE '$Velg_Fly'"); 
      
        mysql_query("UPDATE Undergrunn_varer SET varer_ligger_hos='$Velg_Fly' WHERE vare_plassert='$land' AND vare_er='$Velg_NarkoVare' AND vare_eier='$brukernavn' AND varer_ligger_hos='Ingen' LIMIT $Velg_AntallVarer"); 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_6\">$Tekst</span></div>";
        }}}}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et fly du ikke har i denne byen, det går ikke.</span></div>'; }}} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en handling som ikke er et alternativ.</span></div>'; }} else { 
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt en vare som ikke eksisterer i spillet.</span></div>';
        }}}}elseif(isset($_POST['Velg_sted'])) {
        if($reise_tid > $tiden) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du må vente <span id="tell">'.$reise_sekunder_er.'</span> sekunder før du kan reise igjen.</span></div>'; } else {
        $valgt_fly = mysql_real_escape_string($_POST['velg_ett_fly']);
        $valgt_sted = mysql_real_escape_string($_POST['Velg_sted']);
        if(empty($valgt_fly) || empty($valgt_sted)) { 
        echo '<div class="Div_MELDING">';
        if(empty($valgt_fly)) { echo '<span class="Span_str_5">Du har ikke valgt et fly.</span>'; }
        if(empty($valgt_sted)) { echo '<span class="Span_str_5">Du har ikke valgt stedet du vil reise til.</span>'; }
        echo '</div>';
        } else {
        if($valgt_fly == 'Ingen') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har desverre ikke et fly i denne byen.</span></div>'; } else {
        $valgt_fly = rengjor_tall($valgt_fly);
        $valgt_fly_id = $valgt_fly / '250';
      
        $sjekk_opp_flyet = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er='1' AND Frakt_sted='$land' AND id LIKE '$valgt_fly_id'");
        if (mysql_num_rows($sjekk_opp_flyet) == 0) { echo '<div class="Div_MELDING"><span class="Span_str_5">Enten så eier du ikke dette flyet ellers er det plassert i en annen by, du kan desverre ikke bruke dette flyet.</span></div>'; } else { 
        if($valgt_sted == 'Drammen' || $valgt_sted == 'Lillehammer' || $valgt_sted == 'Hamar' || $valgt_sted == 'Alta' || $valgt_sted == 'Bergen' || $valgt_sted == 'Bodø' || $valgt_sted == 'Oslo' || $valgt_sted == 'Stavanger' || $valgt_sted == 'Trondheim' || $valgt_sted == 'Tromsø' || $valgt_sted == 'Kristiansand' || $valgt_sted == 'Sandefjord') { 
        if($valgt_sted == $land) { echo '<div class="Div_MELDING"><span class="Span_str_5">Du er allerede i denne byen fra før av.</span></div>'; } else { 
        if($penger < '900') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du har ikke nok penger på hånda.</span></div>'; } else {
        $row2 = mysql_fetch_assoc($sjekk_opp_flyet);
        if($row2['Frakt_skade'] >= '0')  { $Fly_svar = array("VANLIG","VANLIG"); }
        if($row2['Frakt_skade'] >= '54') { $Fly_svar = array("VANLIG","VANLIG","VANLIG","VANLIG","VANLIG","NESTEN","NESTEN","KRASJER"); }
        if($row2['Frakt_skade'] >= '60') { $Fly_svar = array("VANLIG","VANLIG","VANLIG","VANLIG","NESTEN","NESTEN","KRASJER","KRASJER"); }
        if($row2['Frakt_skade'] >= '70') { $Fly_svar = array("VANLIG","VANLIG","NESTEN","NESTEN","NESTEN","KRASJER","KRASJER","KRASJER"); }
        if($row2['Frakt_skade'] >= '80') { $Fly_svar = array("VANLIG","NESTEN","NESTEN","NESTEN","KRASJER","KRASJER","KRASJER","KRASJER"); }
        if($row2['Frakt_skade'] >= '90') { $Fly_svar = array("NESTEN","NESTEN","KRASJER","KRASJER","KRASJER","KRASJER"); }
        $Fly_svar = $Fly_svar[array_rand($Fly_svar)];
        if($Fly_svar == 'VANLIG') { include "vanlig_privat_reise.php"; } 
        elseif($Fly_svar == 'NESTEN') { include "nesten_privat_reise.php"; }
        elseif($Fly_svar == 'KRASJER') { include "krasjer_privat_reise.php"; } else { include "vanlig_privat_reise.php"; }
        }}} else {
        echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan ikke reise til en by som ikke eksisterer i spillet.</span></div>';
        }}}}}}
        

        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg fly</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"velg_ett_fly\">";
        
      
        $hent_rader = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er='1' AND Frakt_sted='$land' ORDER BY `Frakt_timestamp` DESC");
        if (mysql_num_rows($hent_rader) == '0') { echo "<option value=\"Ingen\">Du har desverre ingen fly i denne byen</option>"; } else { 
        $id_teller = '1';
        while ($row = mysql_fetch_assoc($hent_rader)) { 
        $fake_id = $row['id'] * '250';
        if($row['Frakt_skade'] >= '0') {  $tillstand = 'Veldig bra'; } 
        if($row['Frakt_skade'] >= '18') { $tillstand = 'Bra'; }
        if($row['Frakt_skade'] >= '36') { $tillstand = 'Duger'; }
        if($row['Frakt_skade'] >= '54') { $tillstand = 'Dårlig'; }
        if($row['Frakt_skade'] >= '72') { $tillstand = 'Veldig dårlig'; }
        if($row['Frakt_skade'] >= '90') { $tillstand = 'Ekstremt dårlig'; }
        echo '<option value="'.$fake_id.'">'.$id_teller++.' Fly: '.htmlspecialchars($row['Frakt_navn']).' Tillstand: '.$tillstand.'</option>';
        }}
        
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg sted</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Velg_sted\">";
        
        if($land != 'Drammen') { echo '<option>Drammen</option>'; }
        if($land != 'Lillehammer') { echo '<option>Lillehammer</option>'; }
        if($land != 'Hamar') { echo '<option>Hamar</option>'; }
        if($land != 'Alta') { echo '<option>Alta</option>'; }
        if($land != 'Bergen') { echo '<option>Bergen</option>'; }
        if($land != 'Bodø') { echo '<option>Bodø</option>'; }
        if($land != 'Oslo') { echo '<option>Oslo</option>'; }
        if($land != 'Stavanger') { echo '<option>Stavanger</option>'; }
        if($land != 'Trondheim') { echo '<option>Trondheim</option>'; }
        if($land != 'Tromsø') { echo '<option>Tromsø</option>'; }
        if($land != 'Kristiansand') { echo '<option>Kristiansand</option>'; }
        if($land != 'Sandefjord') { echo '<option>Sandefjord</option>'; }
        
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('ReisPrivatfly').submit()\"><p class=\"pan_str_2\">REIS MED PRIVAT FLY</p></div></form>
        <div class=\"Div_mellomledd\">&nbsp;<form method=\"post\" id=\"PlasseringFly\"></div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">FRAKT / PLASSERING</span></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Plasser antall</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"VelgAntall\" value=\"\" maxlength=\"10\" onKeyPress=\"return numbersonly(this, event)\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg vare</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"NarkoValg\"><option value=\"Kokain\">Kokain - du har $Kokain_varer_land gram i denne byen</option><option value=\"Hasj\">Hasj - du har $Hasj_varer_land gram i denne byen</option><option value=\"Marihuana\">Marihuana - du har $Marihuana_varer_land gram i denne byen</option><option value=\"Heroin\">Heroin - du har $Heroin_varer_land gram i denne byen</option><option value=\"Ecstasy\">Ecstasy - du har $Ecstasy_varer_land tabeletter i denne byen</option><option value=\"Flatskjerm\">Flatskjerm - du har $Flatskjerm_varer_land stk i denne byen</option><option value=\"Komplett\">Komplett pc - du har $pc_varer_land stk i denne byen</option><option value=\"Mobiltelefon\">Mobiltelefon - du har $Mobiltelefon_varer_land stk i denne byen</option><option value=\"Xbox\">Xbox - du har $Xbox_varer_land stk i denne byen</option><option value=\"Ipod\">Ipod - du har $Ipod_varer_land stk i denne byen</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Handling</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"HandlingFly\"><option value=\"Avplasser\">Ta alle varene ut av flyet</option><option value=\"Plasser\">Plasser varer på flyet</option></select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Velg fly</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"FlyValg\">";
        
      
        $HentFly = mysql_query("SELECT * FROM fly_osv WHERE Frakt_eier='$brukernavn' AND Frakt_er='1' AND Frakt_sted='$land' ORDER BY `Frakt_timestamp` DESC");
        if (mysql_num_rows($HentFly) == '0') { echo "<option value=\"0\">Du har desverre ingen fly i denne byen.</option>"; } else {  
        $TellePelle = "0";
        while($FlyInfo = mysql_fetch_assoc($HentFly)) { 
        $FakeID = $FlyInfo['id'] * '23';
        $TellePelle++;
        echo "<option value=\"$FakeID\">Fly: ".htmlspecialchars($FlyInfo['Frakt_navn'])." // Bagsje: ".htmlspecialchars($FlyInfo['PlassBrukt'])." // Rommer: ".htmlspecialchars($FlyInfo['Frakt_kapasistet'])." varer</option>";
        }}
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\"></div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('PlasseringFly').submit()\"><p class=\"pan_str_2\">UTFØR</p></div></form>
        ";

        echo "</div>";
        
        }}}}}
        ?>