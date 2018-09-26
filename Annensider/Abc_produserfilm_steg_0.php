        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(isset($_POST['tittel'])) { 
        if(empty($_POST['tittel']) || empty($_POST['genre']) || empty($_POST['tidslengde'])) {
        echo '<div class="Div_MELDING">';
        if(empty($_POST['tittel'])) { echo '<span class="Span_str_5">Du har ikke skrevet inn en tittel.</span>'; }
        if(empty($_POST['genre'])) { echo '<span class="Span_str_5">Du har ikke valgt en kategori.</span>'; }
        if(empty($_POST['tidslengde'])) { echo '<span class="Span_str_5">Du har ikke valgt tidslengden på filmen.</span>'; }
        echo '</div>';
        } else {
        $tittel_film = mysql_real_escape_string($_POST['tittel']);
        $kategori_film = mysql_real_escape_string($_POST['genre']);
        $tidslengde_film = mysql_real_escape_string($_POST['tidslengde']);
        
        $tittel_film = htmlspecialchars($tittel_film);
        $kategori_film = htmlspecialchars($kategori_film);
        $tidslengde_film = htmlspecialchars($tidslengde_film);

        if($kategori_film == 'Action' || $kategori_film == 'Komedie' || $kategori_film == 'Grøsser' || $kategori_film == 'Drama') { 
        if($tidslengde_film == '100' || $tidslengde_film == '120' || $tidslengde_film == '140' || $tidslengde_film == '160') { 
        
        if($tidslengde_film == '100') { $tids_pris = '100000'; }
        if($tidslengde_film == '120') { $tids_pris = '200000'; }
        if($tidslengde_film == '140') { $tids_pris = '300000'; }
        if($tidslengde_film == '160') { $tids_pris = '400000'; }
        
        $database_penger = $tids_pris + '10000';
      
        mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
        mysql_query("INSERT INTO `filmer_produser` (ditt_brukernavn,genere,film_igang,film_pris,tittel,tidslengde_film,dato_startet) VALUES ('$brukernavn','$kategori_film','1','$database_penger','$tittel_film','$tidslengde_film','$tid $nbsp $dato')");
        header("Location: game.php?side=FilmProdusering");
        } else { 
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en tidslengde som ikke eksisterer i spillet.</span>';
        echo '</div>';
        }} else {
        echo '<div class="Div_MELDING">';
        echo '<span class="Span_str_5">Du har valgt en kategori som ikke eksisterer i spillet.</span>';
        echo '</div>';
        }}}
        ?>
        <div class="Div_venstre_side_1"><form method="post" id="produser_film"><span class="Span_str_1">Resigør status</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><?=$produsent_status;?> </span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Filmens tittel</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="tittel" maxlength="30" value=""></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Kategori</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="genre"><option value="Action">Action ( 10,000 kr )</option><option value="Komedie">Komedie ( 10,000 kr )</option><option value="Grøsser">Grøsser ( 10,000 kr )</option><option value="Drama">Drama ( 10,000 kr )</option></select></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Lengde på filmen</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="tidslengde"><option value="100">100 Minutter ( 100,000 kr )</option><option value="120">120 Minutter ( 200,000 kr  )</option><option value="140">140 Minutter ( 300,000 kr )</option><option value="160">160 Minutter ( 400,000 kr )</option></select></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('produser_film').submit()"><p class="pan_str_2">NESTE STEG</p></div></form>