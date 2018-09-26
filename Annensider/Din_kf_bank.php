        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_mellomledd">&nbsp;<form method="post" id="Kf_bank"></div>
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">KF KONTO</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Kontobalanse</span></div>
        <div class="Div_hoyre_side_1"><span class="Span_str_9"><? echo number_format($KF_INFO['KF_Konto'], 0, ",", "."); ?> Kr</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Sum</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="summmen" value="" maxlength="10" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1">&nbsp;<input type="hidden" name="action" id="du_valgte" /></div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='Sett_inn';document.getElementById('Kf_bank').submit()"><p class="pan_str_2">SETT INN</p></div>
        <div class="Div_submit_knapp_1" onclick="document.getElementById('du_valgte').value='Ta_ut';document.getElementById('Kf_bank').submit()"><p class="pan_str_2">TA UT</p></div></form>
        

        <?
        }}
        ?>