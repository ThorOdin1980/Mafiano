        <?
        if(empty($brukernavn)) { header("Location: index.php"); }
        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_venstre_side_1"><span class="Span_str_1">Hovedrolle</span></div>
        <div class="Div_hoyre_side_1"><form method="post" id="produser_film">
        <select class="textbox" name="hovedrolle">
        <?

        if($antall_film_prod >= '0') { echo '
        <option value="Kirsten Dunst">Kirsten Dunst ( 2.700.000 kr )</option>
        <option value="Salma Hayek">Salma Hayek ( 2.800.000 kr )</option>
        <option value="Quentin Tarantino">Quentin Tarantino ( 2.900.000 kr )</option>
        '; } 
        if($antall_film_prod >= '1') { echo '
        <option value="Woody Harrelson">Woody Harrelson ( 3.000.000 kr )</option>
        <option value="Jennifer Aniston">Jennifer Aniston ( 3.100.000 kr )</option>
        <option value="Sandra Bullock">Sandra Bullock ( 3.200.000 kr )</option>
        '; } 
        if($antall_film_prod >= '3') { echo '
        <option value="Joe Pesci">Joe Pesci ( 3.400.000 kr )</option>
        <option value="Jim Carrey">Jim Carrey ( 3.600.000 kr )</option>
        <option value="Tom Cruise">Tom Cruise ( 3.700.000 kr )</option>
        '; } 
        if($antall_film_prod >= '5') { echo '
        <option value="Pierce Brosnan">Pierce Brosnan ( 3.800.000 kr )</option>
        <option value="Vin Diesel">Vin Diesel ( 3.900.000 kr )</option>
        <option value="Bruce willis">Bruce willis ( 4.000.000 kr )</option>
        '; } 
        if($antall_film_prod >= '7') { echo '
        <option value="Wesley Snipes">Wesley Snipes ( 4.200.000 kr )</option>
        <option value="Mel Gibson">Mel Gibson ( 4.300.000 kr )</option>
        <option value="Will Smith ">Will Smith ( 4.400.000 kr )</option>
        '; }
        if($antall_film_prod >= '9') { echo '
        <option value="Sylvester Stallone">Sylvester Stallone ( 4.500.000 kr )</option>
        <option value="Samuel L. Jackson">Samuel L. Jackson ( 4.600.000 kr )</option>
        <option value="Al Pacino">Al Pacino ( 4.700.000 kr )</option>
        '; } 
        if($antall_film_prod >= '11') { echo '
        <option value="John Travolta">John Travolta ( 4.800.000 kr )</option>
        <option value="Nicolas Cage">Nicolas Cage ( 5.900.000 kr )</option>
        '; } 
   
        ?>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Middels rolle</span></div>
        <div class="Div_hoyre_side_1">
        <select class="textbox" name="middels_rolle">
        <?

        if($antall_film_prod >= '0') { echo '
        <option value="Cillian Murphy">Cillian Murphy ( 600.000 kr )</option>
        <option value="Sarah Michelle">Sarah Michelle ( 700.000 kr )</option>
        <option value="Don Cheadle">Don Cheadle ( 800.000 kr )</option>
        '; } 
        if($antall_film_prod >= '1') { echo '
        <option value="Martin Lawrence">Martin Lawrence ( 900.000 kr )</option>
        <option value="Anthony Anderson">Anthony Anderson ( 1.000.000 kr )</option>
        <option value="Taylor Momsen">Taylor Momsen ( 1.100.000 kr )</option>
        '; } 
        if($antall_film_prod >= '3') { echo '
        <option value="Jeffrey Tambor">Jeffrey Tambor ( 1.200.000 kr )</option>
        <option value="Andy Dick">Andy Dick ( 1.300.000 kr )</option>
        <option value="Jack Black">Jack Black ( 1.400.000 kr )</option>
        '; } 
        if($antall_film_prod >= '5') { echo '
        <option value="Duane Whitaker">Duane Whitaker ( 1.500.000 kr )</option>
        <option value="Rosanna Arquette">Rosanna Arquette ( 1.600.000 kr )</option>
        <option value="Tim Robbins">Tim Robbins ( 1.700.000 kr )</option>
        '; } 
        if($antall_film_prod >= '7') { echo '
        <option value="Vince Vaughn">Vince Vaughn ( 2.000.000 kr )</option>
        <option value="Owen Wilson">Owen Wilson ( 2.200.000 kr )</option>
        '; }
        if($antall_film_prod >= '9') { echo '
        <option value="Ben Stiller">Ben Stiller ( 2.400.000 kr )</option>
        <option value="Renée Zellweger">Renée Zellweger ( 2.600.000 kr )</option>
        '; } 
        
        ?>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Liten rolle</span></div>
        <div class="Div_hoyre_side_1">
        <select class="textbox" name="liten_rolle">
        <?

        if($antall_film_prod >= '0') { echo '
        <option value="Ralph Fiennes">Ralph Fiennes ( 10.000 kr )</option>
        <option value="David Herman">David Herman ( 20.000 kr )</option>
        <option value="Dempsey Pappion">Dempsey Pappion ( 30.000 kr )</option>
        '; } 
        if($antall_film_prod >= '1') { echo '
        <option value="Nigel Harbach">Nigel Harbach ( 40.000 kr )</option>
        <option value="Miranda R">Miranda R ( 50.000 kr )</option>
        <option value="Anjelica Huston">Anjelica Huston ( 100.000 kr )</option>
        '; } 
        if($antall_film_prod >= '3') { echo '
        <option value="Stacey Travis">Stacey Travis ( 110.000 kr )</option>
        <option value="Gloria Garayua">Gloria Garayua ( 120.000 kr )</option>
        <option value="William Sadler">William Sadler ( 130.000 kr )</option>
        '; } 
        if($antall_film_prod >= '5') { echo '
        <option value="Diya Mirza">Diya Mirza ( 140.000 kr )</option>
        <option value="Bill Young">Bill Young ( 150.000 kr )</option>
        <option value="Monica Bellucci">Monica Bellucci ( 160.000 kr )</option>
        '; } 
        if($antall_film_prod >= '7') { echo '
        <option value="Steve Bastoni">Steve Bastoni ( 170.000 kr )</option>
        <option value="Jessica Biel">Jessica Biel ( 180.000 kr )</option>
        <option value="Sonny Chiba">Sonny Chiba ( 190.000 kr )</option>
        '; }
        if($antall_film_prod >= '9') { echo '
        <option value="Vivica A. Fox">Vivica A. Fox ( 200.000 kr )</option>
        <option value="Jessica Simpson">Jessica Simpson ( 300.000 kr )</option>
        <option value="Johnny Knoxville">Johnny Knoxville ( 400.000 kr )</option>
        <option value="Seann William">Seann William ( 500.000 kr )</option>
        '; } 

        ?>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Statister</span></div>
        <div class="Div_hoyre_side_1">
        <select class="textbox" name="statister">
        <?
        if($antall_film_prod >= '0') { echo '
        <option value="1">100 forsjellige statister ( 100.000 kr )</option>
        <option value="2">200 forsjellige statister ( 200.000 kr )</option>
        <option value="3">300 forsjellige statister ( 300.000 kr )</option>
        '; } 
        if($antall_film_prod >= '1') { echo '
        <option value="4">400 forsjellige statister ( 400.000 kr )</option>
        <option value="5">500 forsjellige statister ( 500.000 kr )</option>
        <option value="6">600 forsjellige statister ( 600.000 kr )</option>
        '; } 
        if($antall_film_prod >= '3') { echo '
        <option value="7">700 forsjellige statister ( 700.000 kr )</option>
        <option value="8">800 forsjellige statister ( 800.000 kr )</option>
        <option value="9">900 forsjellige statister ( 900.000 kr )</option>
        '; } 
        ?>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Filming</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="filming">
		<option value="Bollywood">Bollywood ( 1.270.000 kr )</option>
		<option value="Hollywood">Hollywood ( 4.350.000 kr )</option>
		</select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Bilde kvalitet</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="bilde_kvalitet">
		<option value="Lucas ltd">Lucas ltd ( 100.000 kr )</option>
		<option value="Paramonte pictures">Paramonte pictures ( 200.000 kr )</option>
        <option value="Warner Bros">Warner Bros ( 250.000 kr )</option>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Lyd kvalitet</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="lyd_kvalitet">
        <option value="1">Dolby Digital - billig version ( 200.000 kr )</option>
        <option value="2">Dolby Digital - medium version ( 400.000 kr )</option>
        <option value="3">Dolby Digital - ekslusiv version ( 800.000 kr )</option>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Vis</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="vis">
        <option value="Vis i scandinavia">Vis i scandinavia ( 1.203.000 kr )</option>
        <option value="Vis i europa">Vis i europa ( 2.421.462 kr )</option>
        <option value="Vis globalt">Vis globalt ( 7.421.462 kr )</option>
        </select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Dvd filmer</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="markedsforing">
        <option value="1">Produser 1,000,000 dvder ( 600.000 kr )</option>
        <option value="2">Produser 2,000,000 dvder ( 1.203.000 kr )</option>
        <option value="3">Produser 6,000,000 dvder ( 3.524.010 kr )</option>
        <option value="4">Produser 9,000,000 dvder ( 5.064.000 kr )</option>
        </select></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('produser_film').submit()"><p class="pan_str_2">NESTE STEG</p></div></form>
