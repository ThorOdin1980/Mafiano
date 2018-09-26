        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_MELDING"><form method="post" id="film">
        <span class="Span_str_0">Produserings informasjon til filmen <?=$tittel_pris_K2;?></span><br>
        <span class="Span_str_8">Produseringen av filmen startet <?=$dato_startet_K2;?>.</span><br>
        <span class="Span_str_8">Du har ansatt <?=$hovedrolle_K2;?> til å spille hovedrollen i filmen.</span><br>
        <span class="Span_str_8">Du har ansatt <?=$middelsrolle_K2;?> til å spille en middelsrolle i filmen.</span><br>
        <span class="Span_str_8">Du har ansatt <?=$litenrolle_K2;?> til å spille hovedrollen en liten rolle i filmen.</span><br>
        <span class="Span_str_8">Du har ansatt <?=$statister_K2;?>.</span><br>
        <span class="Span_str_8">Du har valgt at filmen din skal spilles inn i <?=$filming_K2;?>.</span><br>
        <span class="Span_str_8">Filmen din skal ha en tidslengde på minutter <?=$tidslengde_K2;?>.</span><br>
        <span class="Span_str_8">Filmen din skal vises <? echo substr($vis_K2, 4); ?></span><br>
        <span class="Span_str_8">Du skal produsere  <?=$markeds_K2;?>.</span><br>
        <span class="Span_str_8">Prisen for å produsere filmen blir <? echo number_format($film_pris_K2, 0, ",", "."); ?> Kr.</span><br><br>
        <span class="Span_str_0">Annen informasjon</span><br>
        <span class="Span_str_8">Du går opp i rankprosent for hver film du produserer, du får kun respekt om filmen er vellykket.</span>
        <span class="Span_str_8">&nbsp;</span>
        </div><input type="hidden" name="action" id="du_valgte" />
        <div class="Div_submit_knapp_4" onclick="document.getElementById('du_valgte').value='produser';document.getElementById('film').submit()"><p class="pan_str_2">PRODUSER FILM</p></div>
        <div class="Div_submit_knapp_4" onclick="document.getElementById('du_valgte').value='avslutt';document.getElementById('film').submit()"><p class="pan_str_2">AVSLUTT PRODUSERINGEN</p></div></form>
        <?
        }
        ?>