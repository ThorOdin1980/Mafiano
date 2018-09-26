        <?
        if(SjekkPlassering($brukernavn) == 'klar') { 

        include "priser_undergrunden.php";
         
      
        
        // Varer i land
      
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

        // Varer totalt
      
        $Varer = mysql_query("SELECT * FROM Undergrunn_varer WHERE vare_eier='$brukernavn'");
        
        $Kokain_varer_totalt= "0";
        $Hasj_varer_totalt = "0";
        $Marihuana_varer_totalt = "0";
        $Heroin_varer_totalt = "0";
        $Ecstasy_varer_totalt = "0";
        $Flatskjerm_varer_totalt = "0";
        $pc_varer_totalt = "0";
        $Mobiltelefon_varer_totalt = "0";
        $Xbox_varer_totalt = "0";
        $Ipod_varer_totalt = "0";
        
        while($Narkotika = mysql_fetch_assoc($Varer)) { 
        if($Narkotika['vare_er'] == 'Kokain') { $Kokain_varer_totalt++; } 
        elseif($Narkotika['vare_er'] == 'Hasj') { $Hasj_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Marihuana') { $Marihuana_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Heroin') { $Heroin_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Ecstasy') { $Ecstasy_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Flatskjerm tv') { $Flatskjerm_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Komplett pc') { $pc_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Mobiltelefon') { $Mobiltelefon_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Xbox 360') { $Xbox_varer_totalt++; }
        elseif($Narkotika['vare_er'] == 'Ipod') { $Ipod_varer_totalt++; }
        }

        $varer_totalt_er = $Kokain_varer_totalt + $Hasj_varer_totalt + $Marihuana_varer_totalt + $Heroin_varer_totalt + $Ecstasy_varer_totalt + $Flatskjerm_varer_totalt + $pc_varer_totalt + $Mobiltelefon_varer_totalt + $Xbox_varer_totalt + $Ipod_varer_totalt;

      


        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="Div_masta">
        <div class="Div_innledning" id="Div_innleding"><span class="Span_str_2 ">UNDERGRUNNEN</span></div>
        <div class="Div_bilde"><img border="0" src="../Bilder/Undergrunnen-1.jpg" width="490" height="200"><form method="post" id="Handle"></div>
        <?
        if(isset($_POST['antall_varer'])) { 
        
        include "undergrunn_handle.php";
        
        }

        ?>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Narkotika</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Pris per gram</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Du har ( By )</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Du har ( Totalt )</span></div>
        <div class="Div_bunn_4"><span class="Span_str_1">Merk</span></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Kokain</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris1, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Kokain_varer_land, 0, ",", "."); ?> g</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Kokain_varer_totalt, 0, ",", "."); ?> g</div>
        <div class="Div_bunn_3"><input type="radio" value="Kokain" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Hasj</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris2, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Hasj_varer_land, 0, ",", "."); ?> g</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Hasj_varer_totalt, 0, ",", "."); ?> g</div>
        <div class="Div_bunn_3"><input type="radio" value="Hasj" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Marihuana</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris3, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Marihuana_varer_land, 0, ",", "."); ?> g</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Marihuana_varer_totalt, 0, ",", "."); ?> g</div>
        <div class="Div_bunn_3"><input type="radio" value="Marihuana" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Heroin</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris4, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Heroin_varer_land, 0, ",", "."); ?> g</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Heroin_varer_totalt, 0, ",", "."); ?> g</div>
        <div class="Div_bunn_3"><input type="radio" value="Heroin" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Ecstasy</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris5, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Ecstasy_varer_land, 0, ",", "."); ?> g</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Ecstasy_varer_totalt, 0, ",", "."); ?> g</div>
        <div class="Div_bunn_3"><input type="radio" value="Ecstasy" name="number"></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Tyvegods</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Pris per stk</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Du har ( By )</span></div>
        <div class="Div_venstre_side_4"><span class="Span_str_1">Du har ( Totalt )</span></div>
        <div class="Div_bunn_4"><span class="Span_str_1">Merk</span></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Flatskjerm-tv</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris6, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Flatskjerm_varer_land, 0, ",", "."); ?> stk</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Flatskjerm_varer_totalt, 0, ",", "."); ?> stk</div>
        <div class="Div_bunn_3"><input type="radio" value="Flatskjerm tv" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Komplett pc</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris7, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($pc_varer_land, 0, ",", "."); ?> stk</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($pc_varer_totalt, 0, ",", "."); ?> stk</div>
        <div class="Div_bunn_3"><input type="radio" value="Komplett pc" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Mobiltelefon</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris8, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Mobiltelefon_varer_land, 0, ",", "."); ?> stk</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Mobiltelefon_varer_totalt, 0, ",", "."); ?> stk</div>
        <div class="Div_bunn_3"><input type="radio" value="Mobiltelefon" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Xbox 360</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris9, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Xbox_varer_land, 0, ",", "."); ?> stk</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Xbox_varer_totalt, 0, ",", "."); ?> stk</div>
        <div class="Div_bunn_3"><input type="radio" value="Xbox 360" name="number"></div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;Ipod</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($undergrund_pris10, 0, ",", ".");?> kr</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Ipod_varer_land, 0, ",", "."); ?> stk</div>
        <div class="Div_venstre_side_3">&nbsp;&nbsp;<?=number_format($Ipod_varer_totalt, 0, ",", "."); ?> stk</div>
        <div class="Div_bunn_3"><input type="radio" value="Ipod" name="number"></div>
        <div class="Div_mellomledd">&nbsp;</div>
        <div class="Div_innledning"><span class="Span_str_2">KJØP / SELG</span></div><div class="Div_venstre_side_1"><span class="Span_str_1">Antall</span></div>
        <div class="Div_hoyre_side_1"><input class="textbox" type="text" name="antall_varer" maxlength="10" value="" onKeyPress="return numbersonly(this, event)"></div>
        <div class="Div_venstre_side_1"><span class="Span_str_1">Velg handling</span></div>
        <div class="Div_hoyre_side_1"><select class="textbox" name="valget_er"><option value="1">Kjøp</option><option value="2">Selg</option></select></div>
        <div class="Div_venstre_side_1"></div>
        <div class="Div_submit_knapp_2" onclick="document.getElementById('Handle').submit()"><p class="pan_str_2">UTFØR</p></div></form>
        </div>
        <?
        // Lukker toppen
        }
        ?>