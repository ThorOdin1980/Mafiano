        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($brukernavn)) { header("Location: index.php"); }
        if(empty($_POST['hovedrolle']) || empty($_POST['middels_rolle']) || empty($_POST['liten_rolle']) || empty($_POST['statister']) || empty($_POST['filming']) || empty($_POST['bilde_kvalitet']) || empty($_POST['lyd_kvalitet']) || empty($_POST['vis']) || empty($_POST['markedsforing'])) { 
        echo '<div class="Div_MELDING">';
        if(empty($_POST['hovedrolle']))     { echo '<span class="Span_str_5">Du har ikke valgt en/ei som skal spille hovedrollen i filmen.</span>'; }
        if(empty($_POST['middels_rolle']))  { echo '<span class="Span_str_5">Du har ikke valgt en/ei som skal spille middels rollen i filmen.</span>'; }
        if(empty($_POST['liten_rolle']))    { echo '<span class="Span_str_5">Du har ikke valgt en/ei som skal spille den lille rollen i filmen.</span>'; }
        if(empty($_POST['statister']))      { echo '<span class="Span_str_5">Du har ikke valgt hvor stor varriasjon det skal være blandt statistene.</span>'; }
        if(empty($_POST['filming']))        { echo '<span class="Span_str_5">Du har ikke valgt åssen type filming du skal ha.</span>'; }
        if(empty($_POST['bilde_kvalitet'])) { echo '<span class="Span_str_5">Du har ikke valgt bilde kvalitet.</span>'; }
        if(empty($_POST['lyd_kvalitet']))   { echo '<span class="Span_str_5">Du har ikke valgt lyd kvalitet.</span>'; }
        if(empty($_POST['vis']))            { echo '<span class="Span_str_5">Du har ikke valgt om du skal vise filmen globalt eller lokalt.</span>'; }
        if(empty($_POST['markedsforing']))  { echo '<span class="Span_str_5">Du har ikke valgt hvor mange dvder du skal produsere.</span>'; }
        echo '</div>';
        } else {
        $hovedrolle_TV_film = mysql_real_escape_string($_POST['hovedrolle']);
        $middelsrolle_TV_film = mysql_real_escape_string($_POST['middels_rolle']);
        $litensrolle_TV_film = mysql_real_escape_string($_POST['liten_rolle']);
        $statister_TV_film = mysql_real_escape_string($_POST['statister']);
        $filming_TV_film = mysql_real_escape_string($_POST['filming']);
        $bildekvalitet_TV_film = mysql_real_escape_string($_POST['bilde_kvalitet']);
        $lydekvalitet_TV_film = mysql_real_escape_string($_POST['lyd_kvalitet']);
        $vis_TV_film = mysql_real_escape_string($_POST['vis']);
        $markedsforing_TV_film = mysql_real_escape_string($_POST['markedsforing']);
        
        // Sjekker roller
        if($hovedrolle_TV_film == 'Kirsten Dunst' || $hovedrolle_TV_film == 'Salma Hayek' || $hovedrolle_TV_film == 'Quentin Tarantino' || $hovedrolle_TV_film == 'Woody Harrelson' || $hovedrolle_TV_film == 'Jennifer Aniston' || $hovedrolle_TV_film == 'Sandra Bullock' || $hovedrolle_TV_film == 'Joe Pesci' || $hovedrolle_TV_film == 'Jim Carrey' || $hovedrolle_TV_film == 'Tom Cruise' || $hovedrolle_TV_film == 'Pierce Brosnan' || $hovedrolle_TV_film == 'Vin Diesel' || $hovedrolle_TV_film == 'Bruce willis' || $hovedrolle_TV_film == 'Wesley Snipes' || $hovedrolle_TV_film == 'Mel Gibson' || $hovedrolle_TV_film == 'Will Smith' || $hovedrolle_TV_film == 'Sylvester Stallone' || $hovedrolle_TV_film == 'Samuel L. Jackson' || $hovedrolle_TV_film == 'Al Pacino' || $hovedrolle_TV_film == 'John Travolta' || $hovedrolle_TV_film == 'Nicolas Cage') {
        if($middelsrolle_TV_film == 'Cillian Murphy' || $middelsrolle_TV_film == 'Sarah Michelle' || $middelsrolle_TV_film == 'Don Cheadle' || $middelsrolle_TV_film == 'Martin Lawrence' || $middelsrolle_TV_film == 'Anthony Anderson' || $middelsrolle_TV_film == 'Taylor Momsen' || $middelsrolle_TV_film == 'Jeffrey Tambor' || $middelsrolle_TV_film == 'Andy Dick' || $middelsrolle_TV_film == 'Jack Black' || $middelsrolle_TV_film == 'Duane Whitaker' || $middelsrolle_TV_film == 'Rosanna Arquette' || $middelsrolle_TV_film == 'Tim Robbins' || $middelsrolle_TV_film == 'Vince Vaughn' || $middelsrolle_TV_film == 'Owen Wilson' || $middelsrolle_TV_film == 'Ben Stiller' || $middelsrolle_TV_film == 'Renée Zellweger') { 
        if($litensrolle_TV_film == 'Ralph Fiennes' || $litensrolle_TV_film == 'David Herman' || $litensrolle_TV_film == 'Dempsey Pappion' || $litensrolle_TV_film == 'Nigel Harbach' || $litensrolle_TV_film == 'Miranda R' || $litensrolle_TV_film == 'Anjelica Huston' || $litensrolle_TV_film == 'Stacey Travis' || $litensrolle_TV_film == 'Gloria Garayua' || $litensrolle_TV_film == 'William Sadler' || $litensrolle_TV_film == 'Diya Mirza' || $litensrolle_TV_film == 'Bill Young' || $litensrolle_TV_film == 'Monica Bellucci' || $litensrolle_TV_film == 'Steve Bastoni' || $litensrolle_TV_film == 'Jessica Biel' || $litensrolle_TV_film == 'Sonny Chiba' || $litensrolle_TV_film == 'Vivica A. Fox' || $litensrolle_TV_film == 'Jessica Simpson' || $litensrolle_TV_film == 'Johnny Knoxville' || $litensrolle_TV_film == 'Seann William') { 
        if($statister_TV_film == '1' || $statister_TV_film == '2' || $statister_TV_film == '3' || $statister_TV_film == '4' || $statister_TV_film == '5' || $statister_TV_film == '6' || $statister_TV_film == '7' || $statister_TV_film == '8' || $statister_TV_film == '9') { 
        if($filming_TV_film == 'Bollywood' || $filming_TV_film == 'Hollywood') { 
        if($bildekvalitet_TV_film == 'Lucas ltd' || $bildekvalitet_TV_film == 'Paramonte pictures' || $bildekvalitet_TV_film == 'Warner Bros') {
        if($lydekvalitet_TV_film == '1' || $lydekvalitet_TV_film == '2' || $lydekvalitet_TV_film == '3') { 
        if($vis_TV_film == 'Vis i scandinavia' || $vis_TV_film == 'Vis i europa' || $vis_TV_film == 'Vis globalt') {
        if($markedsforing_TV_film == '1' || $markedsforing_TV_film == '2' || $markedsforing_TV_film == '3' || $markedsforing_TV_film == '4') {
        
        // Velger pris for hovedroller
        if($hovedrolle_TV_film == 'Kirsten Dunst') {     $pris_1 = '2700000'; }
        if($hovedrolle_TV_film == 'Salma Hayek') {       $pris_1 = '2800000'; }
        if($hovedrolle_TV_film == 'Quentin Tarantino') { $pris_1 = '2900000'; }
        if($hovedrolle_TV_film == 'Woody Harrelson') {   $pris_1 = '3000000'; }
        if($hovedrolle_TV_film == 'Jennifer Aniston') {  $pris_1 = '3100000'; }
        if($hovedrolle_TV_film == 'Sandra Bullock') {    $pris_1 = '3200000'; }
        if($hovedrolle_TV_film == 'Joe Pesci') {         $pris_1 = '3400000'; }
        if($hovedrolle_TV_film == 'Jim Carrey') {        $pris_1 = '3600000'; }
        if($hovedrolle_TV_film == 'Tom Cruise') {        $pris_1 = '3700000'; }  
        if($hovedrolle_TV_film == 'Pierce Brosnan') {    $pris_1 = '3800000'; }
        if($hovedrolle_TV_film == 'Vin Diesel') {        $pris_1 = '3900000'; }
        if($hovedrolle_TV_film == 'Bruce willis') {      $pris_1 = '4000000'; }
        if($hovedrolle_TV_film == 'Wesley Snipes') {     $pris_1 = '4200000'; }   
        if($hovedrolle_TV_film == 'Mel Gibson') {        $pris_1 = '4300000'; }
        if($hovedrolle_TV_film == 'Will Smith') {        $pris_1 = '4400000'; }
        if($hovedrolle_TV_film == 'Sylvester Stallone') {$pris_1 = '4500000'; }   
        if($hovedrolle_TV_film == 'Samuel L. Jackson') { $pris_1 = '4600000'; }
        if($hovedrolle_TV_film == 'Al Pacino') {         $pris_1 = '4700000'; }   
        if($hovedrolle_TV_film == 'John Travolta') {     $pris_1 = '4800000'; }
        if($hovedrolle_TV_film == 'Nicolas Cage') {      $pris_1 = '5900000'; }   
        
        // Velger pris for nestrolle
        if($middelsrolle_TV_film == 'Cillian Murphy') {   $pris_2 = '600000'; }
        if($middelsrolle_TV_film == 'Sarah Michelle') {   $pris_2 = '700000'; }
        if($middelsrolle_TV_film == 'Don Cheadle') {      $pris_2 = '800000'; }
        if($middelsrolle_TV_film == 'Martin Lawrence') {  $pris_2 = '900000'; }
        if($middelsrolle_TV_film == 'Anthony Anderson') { $pris_2 = '1000000'; }
        if($middelsrolle_TV_film == 'Taylor Momsen') {    $pris_2 = '1100000'; }
        if($middelsrolle_TV_film == 'Jeffrey Tambor') {   $pris_2 = '1200000'; }
        if($middelsrolle_TV_film == 'Andy Dick') {        $pris_2 = '1300000'; }
        if($middelsrolle_TV_film == 'Jack Black') {       $pris_2 = '1400000'; }       
        if($middelsrolle_TV_film == 'Duane Whitaker') {   $pris_2 = '1500000'; }
        if($middelsrolle_TV_film == 'Rosanna Arquette') { $pris_2 = '1600000'; }
        if($middelsrolle_TV_film == 'Tim Robbins') {      $pris_2 = '1700000'; }        
        if($middelsrolle_TV_film == 'Vince Vaughn') {     $pris_2 = '2000000'; }
        if($middelsrolle_TV_film == 'Owen Wilson') {      $pris_2 = '2200000'; }
        if($middelsrolle_TV_film == 'Ben Stiller') {      $pris_2 = '2400000'; }    
        if($middelsrolle_TV_film == 'Renée Zellweger') {  $pris_2 = '2600000'; }    
        
        // Velger pris for liten rolle
        if($litensrolle_TV_film == 'Ralph Fiennes') {   $pris_3 = '10000'; }
        if($litensrolle_TV_film == 'David Herman') {    $pris_3 = '20000'; }
        if($litensrolle_TV_film == 'Dempsey Pappion') { $pris_3 = '30000'; }
        if($litensrolle_TV_film == 'Nigel Harbach') {   $pris_3 = '40000'; }
        if($litensrolle_TV_film == 'Miranda R') {       $pris_3 = '50000'; }
        if($litensrolle_TV_film == 'Anjelica Huston') { $pris_3 = '100000'; }
        if($litensrolle_TV_film == 'Stacey Travis') {   $pris_3 = '110000'; }
        if($litensrolle_TV_film == 'Gloria Garayua') {  $pris_3 = '120000'; }
        if($litensrolle_TV_film == 'William Sadler') {  $pris_3 = '130000'; }
        if($litensrolle_TV_film == 'Diya Mirza') {      $pris_3 = '140000'; }
        if($litensrolle_TV_film == 'Bill Young') {      $pris_3 = '150000'; }
        if($litensrolle_TV_film == 'Monica Bellucci') { $pris_3 = '160000'; }
        if($litensrolle_TV_film == 'Steve Bastoni') {   $pris_3 = '170000'; }
        if($litensrolle_TV_film == 'Jessica Biel') {    $pris_3 = '180000'; }
        if($litensrolle_TV_film == 'Sonny Chiba') {     $pris_3 = '190000'; }
        if($litensrolle_TV_film == 'Vivica A. Fox') {   $pris_3 = '200000'; }                
        if($litensrolle_TV_film == 'Jessica Simpson') { $pris_3 = '300000'; }
        if($litensrolle_TV_film == 'Johnny Knoxville') {$pris_3 = '400000'; }
        if($litensrolle_TV_film == 'Seann William') {   $pris_3 = '500000'; }
     
        // Velger statist pris
        if($statister_TV_film == '1') { $pris_4 = '100000'; $tekst_statister = '100 forsjellige statister'; }
        if($statister_TV_film == '2') { $pris_4 = '200000'; $tekst_statister = '200 forsjellige statister'; }
        if($statister_TV_film == '3') { $pris_4 = '300000'; $tekst_statister = '300 forsjellige statister'; }
        if($statister_TV_film == '4') { $pris_4 = '400000'; $tekst_statister = '400 forsjellige statister'; }
        if($statister_TV_film == '5') { $pris_4 = '500000'; $tekst_statister = '500 forsjellige statister'; }
        if($statister_TV_film == '6') { $pris_4 = '600000'; $tekst_statister = '600 forsjellige statister'; }
        if($statister_TV_film == '7') { $pris_4 = '700000'; $tekst_statister = '700 forsjellige statister'; }
        if($statister_TV_film == '8') { $pris_4 = '800000'; $tekst_statister = '800 forsjellige statister'; }
        if($statister_TV_film == '9') { $pris_4 = '900000'; $tekst_statister = '900 forsjellige statister'; }
        
        // Velger filming pris
        if($filming_TV_film == 'Bollywood') { $pris_5 = '1270000'; }
        if($filming_TV_film == 'Hollywood') { $pris_5 = '4350000'; }

        // Velger bildekvalitet pris
        if($bildekvalitet_TV_film == 'Lucas ltd') {          $pris_6 = '100000'; }
        if($bildekvalitet_TV_film == 'Paramonte pictures') { $pris_6 = '200000'; }
        if($bildekvalitet_TV_film == 'Warner Bros') {        $pris_6 = '250000'; }

        // Velger lydkvalitet pris
        if($lydkvalitet_TV_film == '1') { $pris_7 = '200000'; }
        if($lydkvalitet_TV_film == '2') { $pris_7 = '400000'; }
        if($lydkvalitet_TV_film == '3') { $pris_7 = '800000'; }

        // Velger vis pris
        if($vis_TV_film == 'Vis i scandinavia') { $pris_8 = '1203000'; }
        if($vis_TV_film == 'Vis i europa') {      $pris_8 = '2421462'; }
        if($vis_TV_film == 'Vis globalt') {       $pris_8 = '7421462'; }
      
        // Produser dvder pris
        if($markedsforing_TV_film == '1') { $pris_9 = '600000';  $tekst_dvd = '1 million dvder'; }
        if($markedsforing_TV_film == '2') { $pris_9 = '1203000'; $tekst_dvd = '2 millioner dvder'; }
        if($markedsforing_TV_film == '3') { $pris_9 = '3524010'; $tekst_dvd = '6 millioner dvder'; }
        if($markedsforing_TV_film == '4') { $pris_9 = '5064000'; $tekst_dvd = '9 millioner dvder'; }

        $total_pris_blir = $pris_1 + $pris_2 + $pris_3 + $pris_4 + $pris_5 + $pris_6 + $pris_7 + $pris_8 + $pris_9 + $film_pris_K2;
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
        mysql_query("UPDATE filmer_produser SET hovedrolle='$hovedrolle_TV_film',middelsrolle='$middelsrolle_TV_film',litenrolle='$litensrolle_TV_film',statister='$tekst_statister',filming='$filming_TV_film',vis='$vis_TV_film',markeds='$tekst_dvd',film_igang='2',film_pris='$total_pris_blir' WHERE ditt_brukernavn='$brukernavn'");
        header("Location: game.php?side=FilmProdusering");
        } else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt å produsere en sum dvder som ikke eksisterer i spillet.</span>';
        echo '</div>'; 
        }} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt å vise filmen på et sted som ikke er en av valgmulighetene.</span>';
        echo '</div>'; 
        }} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en lydekvalitet som ikke er en av mulighetene.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en bildekvalitet som ikke er en av mulighetene.</span>';
        echo '</div>'; 
        }} else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt et stede å filme filmen din som eksisterer i spillet.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en statist varriasjon som ikke eksisterer i spillet.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en liten rolle som ikke er en av valgtmulighetene.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en middelsrolle som ikke er en av valgtmulighetene.</span>';
        echo '</div>'; 
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en hovedrolle som ikke er en av valgtmulighetene.</span>';
        echo '</div>'; 
        }}
        
        ?>
        