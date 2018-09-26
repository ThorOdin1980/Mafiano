        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_mellomledd ">&nbsp;<form method="post" id="skfe"></div>
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2">REDIGER</span></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Firma</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="Firma_skjjj" value="<?=$KF_INFO['KF_Fabrikk'];?>" maxlength="30"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Bilde</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="Bilde" value="<?=$KF_INFO['KF_Banner'];?>" maxlength="200"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Gjeng</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="Gjeng" value="<?=$KF_INFO['KF_Gjeng'];?>" maxlength="30"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Salgspris</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="Salgspris" value="<?=$KF_INFO['KF_SlagsPris'];?>" maxlength="5" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1">&nbsp;</div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('skfe').submit()"><p class="pan_str_2">LAGRE</p></div></form>
        <?
        }}
        ?>