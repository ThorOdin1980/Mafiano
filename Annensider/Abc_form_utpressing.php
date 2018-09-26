        <?
        if (empty($brukernavn)) { header("Location: index.php"); }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <form method="post" id="<?=$submit_knapp_1;?>">
        <div class="Div_venstre_side_1"><span class="Span_str_1">Brukernavn</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="brukernavn" maxlength="30" value=""><input type="hidden" name="action" id="du_valgte" /></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='press_random';document.getElementById('<?=$submit_knapp_1;?>').submit()"><p class="pan_str_2">PRESS RANDOM SPILLER</p></div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='press_valgt';document.getElementById('<?=$submit_knapp_1;?>').submit()"><p class="pan_str_2">PRESS VALGT SPILLER</p></div>
        </form>