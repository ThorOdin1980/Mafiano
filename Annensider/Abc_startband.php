        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        if(isset($_POST['Bandnavn'])) { 
        $Bandnavn = mysql_real_escape_string($_POST['Bandnavn']);
        $Bandnavn = ereg_replace("[^A-Za-z0-9 ]", "", $Bandnavn);
        $Trommer = htmlspecialchars(mysql_real_escape_string($_POST['Trommer']));
        $Gitar = htmlspecialchars(mysql_real_escape_string($_POST['Gitar']));
        $ElGitar = htmlspecialchars(mysql_real_escape_string($_POST['ElGitar']));
        $Bass = htmlspecialchars(mysql_real_escape_string($_POST['Bass']));
        $Piano = htmlspecialchars(mysql_real_escape_string($_POST['Piano']));
        $FrontVokal = htmlspecialchars(mysql_real_escape_string($_POST['FrontVokal']));
        $BakVokal = htmlspecialchars(mysql_real_escape_string($_POST['BakVokal']));

        if(empty($Bandnavn) || empty($Trommer) || empty($Gitar) || empty($ElGitar) || empty($Bass) || empty($Piano) || empty($FrontVokal) || empty($BakVokal)) { 
        echo "<div class=\"Div_MELDING\">";
        if(empty($Bandnavn)) { echo "<span class=\"Span_str_5\">Du har glemt å velge et bandnavn, husk kun tall og bokstaver er godtatt.</span>"; }
        if(empty($Trommer)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal spille trommer.</span>"; }
        if(empty($Gitar)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal spille gitar.</span>"; }
        if(empty($ElGitar)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal spille el gitar.</span>"; }
        if(empty($Bass)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal spille bass.</span>"; }
        if(empty($Piano)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal spille piano.</span>"; }
        if(empty($FrontVokal)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal synge som front vokalist.</span>"; }
        if(empty($BakVokal)) { echo "<span class=\"Span_str_5\">Du har ikke valgt hvem som skal synge som bak vokalist.</span>"; }
        echo "</div>";
        } else { 
        if($Trommer == 'Deiniol Aksel' || $Trommer == 'Ylli Behar' || $Trommer == 'Aleksander Kostandin' || $Trommer == 'Karam Yahya' || $Trommer == 'Olaf Gerolf' || $Trommer == 'Simon Merit' || $Trommer == 'Chip Marvin' || $Trommer == 'Lorna Sunny' || $Trommer == 'Rosemonde Tatienne' || $Trommer == 'Gunnvor Marte' || $Trommer == 'Sofia Janina' || $Trommer == 'Kylli Ilona' || $Trommer == 'Orville Humbert' || $Trommer == 'Dag Pontus' || $Trommer == 'Poul Jannick' || $Trommer == 'Huan Xiang' || $Trommer == 'Kaloyan Miroslav' || $Trommer == 'Firuz Abdul') { 
        if($Gitar == 'Anna Hansen' || $Gitar == 'Shane Collin' || $Gitar == 'Tony Brekstad' || $Gitar == 'Heidi Peci' || $Gitar == 'Inge Quinton' || $Gitar == 'Yusuf Nardjin' || $Gitar == 'Bill Kremts' || $Gitar == 'Mike Jell' || $Gitar == 'Brittney Dunst' || $Gitar == 'Cassie Goldfing' || $Gitar == 'Anja Anker' || $Gitar == 'Sebastian Riseng' || $Gitar == 'Torkil Jovik' || $Gitar == 'Tylor Clinton' || $Gitar == 'Hedda Montana') { 
        if($ElGitar == 'Joshua Kregmitch' || $ElGitar == 'Leonardo Fernando' || $ElGitar == 'Shawn Twain' || $ElGitar == 'Isabella Kregbush' || $ElGitar == 'Bente Thoresen' || $ElGitar == 'Kai Rash' || $ElGitar == 'Tor Hark Sveen' || $ElGitar == 'Lex Mark Indiana' || $ElGitar == 'Freddy Dylan' || $ElGitar == 'Christina Jensen' || $ElGitar == 'Andrew Kissinger' || $ElGitar == 'Frida Slettvold' || $ElGitar == 'Felicity Scot' || $ElGitar == 'Timmi Ingfjel' || $ElGitar == 'Muhammed Garcia') { 
        if($Bass == 'Destiny Juset' || $Bass == 'Kara Shirley' || $Bass == 'Albert Wong' || $Bass == 'Espen Ulriksen' || $Bass == 'Trine Lise Stromgods' || $Bass == 'Harold Storm' || $Bass == 'Leonard Karland' || $Bass == 'Natalya Banks' || $Bass == 'Diaz Campton' || $Bass == 'Emmy Addams' || $Bass == 'Shamal Abdu Raman' || $Bass == 'Tommy Coen' || $Bass == 'Hillary Duff' || $Bass == 'Espen Minkstuen' || $Bass == 'Mikkel Lindstad') { 
        if($Piano == 'Jack Jones' || $Piano == 'Andreas Hoel' || $Piano == 'Emilie Fees' || $Piano == 'Dominic Fees' || $Piano == 'Edward Brenden' || $Piano == 'Matt Ryder' || $Piano == 'Ruben Griffin' || $Piano == 'Steve Usher' || $Piano == 'Sheila Dimitrio' || $Piano == 'Frank Payton' || $Piano == 'Carrie Vincent' || $Piano == 'Mira Mothus' || $Piano == 'Diego Hunter' || $Piano == 'Henriette Godager' || $Piano == 'Truls Einsen') { 
        if($FrontVokal == 'Marcus Colt Rage' || $FrontVokal == 'Vladimir Haugstad' || $FrontVokal == 'Samuel Gill' || $FrontVokal == 'Fred Egil Dahl' || $FrontVokal == 'Morten Fegland' || $FrontVokal == 'Maria Tofte' || $FrontVokal == 'Sofie Moen' || $FrontVokal == 'Johnny Trans' || $FrontVokal == 'Kate Temper' || $FrontVokal == 'Emil Svensson' || $FrontVokal == 'Fredrik Karset' || $FrontVokal == 'Aron Berntz' || $FrontVokal == 'Amalie Opdal' || $FrontVokal == 'Maximus Sagan' || $FrontVokal == 'Colin Porw') { 
        if($BakVokal == 'Rebekka Hagen' || $BakVokal == 'John Cage' || $BakVokal == 'Gabriel Mess' || $BakVokal == 'Xavier Nilsen' || $BakVokal == 'Carlos Santana' || $BakVokal == 'Sean Kingston' || $BakVokal == 'Jesse James' || $BakVokal == 'Geir Johnsen' || $BakVokal == 'Arne Barmoen' || $BakVokal == 'Kenny Vibeto' || $BakVokal == 'Carlye Teddy' || $BakVokal == 'Fredrik Akre' || $BakVokal == 'Emilo Ziaie' || $BakVokal == 'Thommas Lee' || $BakVokal == 'Jonas Fagervik') { 
        if($penger >= '200000') { 
        if(strlen($Bandnavn) > '30') { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Bandnavnet er for langt.</span></div>";
        } else { 
      
        $SjekkBand = mysql_query("SELECT * FROM Platestudio WHERE Bandnavn='$Bandnavn'");
        if (mysql_num_rows($SjekkBand) >= '1') {  
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">$Bandnavn er allerede ibruk, velg et nytt bandnavn.</span></div>";
        } else { 
        $NySumSpenn = floor($penger - '200000');
      
        mysql_query("INSERT INTO `Platestudio` (Brukernavn,DatoOprettet,StampOprettet,Trommer,Gitar,Piano,Bass,ElGitar,Hovedstemme,Bakstemme,Bandnavn) VALUES ('$brukernavn','$tid $nbsp $dato $nbsp $aar','$tiden','$Trommer','$Gitar','$Piano','$Bass','$ElGitar','$FrontVokal','$BakVokal','$Bandnavn')");
      
        mysql_query("UPDATE brukere SET penger='$NySumSpenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        header("Location: game.php?side=Platestudio"); 
        }}} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har desverre ikke nok penger på hånda.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal synge som bak vokalist er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal synge som front vokalist er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal spille piano er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal spille bass er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal spille el gitar er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal spille gitar er ugyldig.</span></div>";
        }} else { 
        echo "<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Personen som skal spille trommer er ugyldig.</span></div>";
        }}}

        
        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bandnavn</span><form method=\"post\" id=\"StartBand\"></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Bandnavn\" value=\"\" maxlength=\"30\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Trommer</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"Trommer\">
        <option value=\"Deiniol Aksel\">Deiniol Aksel</option>
        <option value=\"Ylli Behar\">Ylli Behar</option>
        <option value=\"Aleksander Kostandin\">Aleksander Kostandin</option>
        <option value=\"Karam Yahya\">Karam Yahya</option>
        <option value=\"Olaf Gerolf\">Olaf Gerolf</option>
        <option value=\"Simon Merit\">Simon Merit</option>
        <option value=\"Chip Marvin\">Chip Marvin</option>
        <option value=\"Lorna Sunny\">Lorna Sunny</option>
        <option value=\"Rosemonde Tatienne\">Rosemonde Tatienne</option>
        <option value=\"Gunnvor Marte\">Gunnvor Marte</option>
        <option value=\"Sofia Janina\">Sofia Janina</option>
        <option value=\"Kylli Ilona\">Kylli Ilona</option>
        <option value=\"Orville Humbert\">Orville Humbert</option>
        <option value=\"Dag Pontus\">Dag Pontus</option>
        <option value=\"Poul Jannick\">Poul Jannick</option>
        <option value=\"Huan Xiang\">Huan Xiang</option>
        <option value=\"Kaloyan Miroslav\">Kaloyan Miroslav</option>
        <option value=\"Firuz Abdul\">Firuz Abdul</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Gitar</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"Gitar\">
        <option value=\"Anna Hansen\">Anna Hansen</option>
        <option value=\"Shane Collin\">Shane Collin</option>
        <option value=\"Tony Brekstad\">Tony Brekstad</option>
        <option value=\"Heidi Peci\">Heidi Peci</option>
        <option value=\"Inge Quinton\">Inge Quinton</option>
        <option value=\"Yusuf Nardjin\">Yusuf Nardjin</option>
        <option value=\"Bill Kremts\">Bill Kremts</option>
        <option value=\"Mike Jell\">Mike Jell</option>
        <option value=\"Brittney Dunst\">Brittney Dunst</option>
        <option value=\"Cassie Goldfing\">Cassie Goldfing</option>
        <option value=\"Anja Anker\">Anja Anker</option>
        <option value=\"Sebastian Riseng\">Sebastian Riseng</option>
        <option value=\"Torkil Jovik\">Torkil Jovik</option>
        <option value=\"Tylor Clinton\">Tylor Clinton</option>
        <option value=\"Hedda Montana\">Hedda Montana</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">El gitar</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"ElGitar\">
        <option value=\"Joshua Kregmitch\">Joshua Kregmitch</option>
        <option value=\"Leonardo Fernando\">Leonardo Fernando</option>
        <option value=\"Shawn Twain\">Shawn Twain</option>
        <option value=\"Isabella Kregbush\">Isabella Kregbush</option>
        <option value=\"Bente Thoresen\">Bente Thoresen</option>
        <option value=\"Kai Rash\">Kai Rash</option>
        <option value=\"Tor Hark Sveen\">Tor Hark Sveen</option>
        <option value=\"Lex Mark Indiana\">Lex Mark Indiana</option>
        <option value=\"Freddy Dylan\">Freddy Dylan</option>
        <option value=\"Christina Jensen\">Christina Jensen</option>
        <option value=\"Andrew Kissinger\">Andrew Kissinger</option>
        <option value=\"Frida Slettvold\">Frida Slettvold</option>
        <option value=\"Felicity Scot\">Felicity Scot</option>
        <option value=\"Timmi Ingfjel\">Timmi Ingfjel</option>
        <option value=\"Muhammed Garcia\">Muhammed Garcia</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bass</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"Bass\">
        <option value=\"Destiny Juset\">Destiny Juset</option>
        <option value=\"Kara Shirley\">Kara Shirley</option>
        <option value=\"Albert Wong\">Albert Wong</option>
        <option value=\"Espen Ulriksen\">Espen Ulriksen</option>
        <option value=\"Trine Lise Stromgods\">Trine Lise Stromgods</option>
        <option value=\"Harold Storm\">Harold Storm</option>
        <option value=\"Leonard Karland\">Leonard Karland</option>
        <option value=\"Natalya Banks\">Natalya Banks</option>
        <option value=\"Diaz Campton\">Diaz Campton</option>
        <option value=\"Emmy Addams\">Emmy Addams</option>
        <option value=\"Shamal Abdu Raman\">Shamal Abdu Raman</option>
        <option value=\"Tommy Coen\">Tommy Coen</option>
        <option value=\"Hillary Duff\">Hillary Duff</option>
        <option value=\"Espen Minkstuen\">Espen Minkstuen</option>
        <option value=\"Mikkel Lindstad\">Mikkel Lindstad</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Piano</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"Piano\">
        <option value=\"Jack Jones\">Jack Jones</option>
        <option value=\"Andreas Hoel\">Andreas Hoel</option>
        <option value=\"Emilie Fees\">Emilie Fees</option>
        <option value=\"Dominic Fees\">Dominic Fees</option>
        <option value=\"Edward Brenden\">Edward Brenden</option>
        <option value=\"Matt Ryder\">Matt Ryder</option>
        <option value=\"Ruben Griffin\">Ruben Griffin</option>
        <option value=\"Steve Usher\">Steve Usher</option>
        <option value=\"Sheila Dimitrio\">Sheila Dimitrio</option>
        <option value=\"Frank Payton\">Frank Payton</option>
        <option value=\"Carrie Vincent\">Carrie Vincent</option>
        <option value=\"Mira Mothus\">Mira Mothus</option>
        <option value=\"Diego Hunter\">Diego Hunter</option>
        <option value=\"Henriette Godager\">Henriette Godager</option>
        <option value=\"Truls Einsen\">Truls Einsen</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Front vokalist</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"FrontVokal\">
        <option value=\"Marcus Colt Rage\">Marcus Colt Rage</option>
        <option value=\"Vladimir Haugstad\">Vladimir Haugstad</option>
        <option value=\"Samuel Gill\">Samuel Gill</option>
        <option value=\"Fred Egil Dahl\">Fred Egil Dahl</option>
        <option value=\"Morten Fegland\">Morten Fegland</option>
        <option value=\"Maria Tofte\">Maria Tofte</option>
        <option value=\"Sofie Moen\">Sofie Moen</option>
        <option value=\"Johnny Trans\">Johnny Trans</option>
        <option value=\"Kate Temper\">Kate Temper</option>
        <option value=\"Emil Svensson\">Emil Svensson</option>
        <option value=\"Fredrik Karset\">Fredrik Karset</option>
        <option value=\"Aron Berntz\">Aron Berntz</option>
        <option value=\"Amalie Opdal\">Amalie Opdal</option>
        <option value=\"Maximus Sagan\">Maximus Sagan</option>
        <option value=\"Colin Porw\">Colin Porw</option>
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Bak vokalist</span></div>
        <div class=\"Div_hoyre_side_1\">
        <select class=\"textbox\" name=\"BakVokal\">
        <option value=\"Rebekka Hagen\">Rebekka Hagen</option>
        <option value=\"John Cage\">John Cage</option>
        <option value=\"Gabriel Mess\">Gabriel Mess</option>
        <option value=\"Xavier Nilsen\">Xavier Nilsen</option>
        <option value=\"Carlos Santana\">Carlos Santana</option>
        <option value=\"Sean Kingston\">Sean Kingston</option>
        <option value=\"Jesse James\">Jesse James</option>
        <option value=\"Geir Johnsen\">Geir Johnsen</option>
        <option value=\"Arne Barmoen\">Arne Barmoen</option>
        <option value=\"Kenny Vibeto\">Kenny Vibeto</option>
        <option value=\"Carlye Teddy\">Carlye Teddy</option>
        <option value=\"Fredrik Akre\">Fredrik Akre</option>
        <option value=\"Emilo Ziaie\">Emilo Ziaie</option>
        <option value=\"Thommas Lee\">Thommas Lee</option>
        <option value=\"Jonas Fagervik\">Jonas Fagervik</option>
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('StartBand').submit()\"><p class=\"pan_str_2\">START BAND - 200.000 KR</p></div></form>
        ";
        
        }
        ?>