        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        echo "<div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">GI UT PLATE</span><form method=\"post\" id=\"$submit_knapp_2\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Platens navn</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"PlateNavn\" maxlength=\"30\"></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Platestudio</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"platestudio\">";

        if($land == 'Drammen') {  
        echo "<option>Hyperbeats Studio - 6.000 kr</option>"; 
        echo "<option>Lydverket - 9.400 kr</option>"; 
        echo "<option>Gran Production - 10.000 kr</option>"; 
        echo "<option>Torkils Studio - 10.600 kr</option>"; 
        echo "<option>Cutting Music - 11.050 kr</option>"; 
        echo "<option>Pure Sound Records - 13.399 kr</option>"; 
        echo "<option>Killakrem Media - 13.500 kr</option>"; 
        echo "<option>Jallamekk Beats - 13.043 kr</option>"; 
        } 
        elseif($land == 'Lillehammer') { 
        echo "<option>Granberg Lyd - 7.000 kr</option>"; 
        echo "<option>Blue Studio DA - 7.400 kr</option>"; 
        echo "<option>Generalens Verk AS - 9.000 kr</option>"; 
        echo "<option>Marks M Records - 11.900 kr</option>"; 
        echo "<option>Lillehammer Media - 12.000 kr</option>"; 
        echo "<option>Spanit NTG - 14.600 kr</option>"; 
        echo "<option>Deathrow Records - 15.900 kr</option>"; 
        }
        elseif($land == 'Hamar') { 
        echo "<option>Max Grønner AS - 13.004 kr</option>"; 
        echo "<option>CC Platestudio - 13.510 kr</option>"; 
        echo "<option>Musikk Utvikling DA - 13.715 kr</option>"; 
        echo "<option>Jamtrackz Records - 14.000 kr</option>"; 
        }
        elseif($land == 'Alta') { 
        echo "<option>Alta Gruppen AS - 6.660 kr</option>";
        echo "<option>Mix Studio - 9.666 kr</option>";
        echo "<option>Lett Lyd AS - 11.000 kr</option>";
        echo "<option>Vakk Musikk Production - 14.420 kr</option>";
        echo "<option>Midtbakken Studio - 17.000 kr</option>";
        }
        elseif($land == 'Bergen') { 
        echo "<option>Hyperklikk Studio - 8.008 kr</option>"; 
        echo "<option>Bogen Studio - 9.000 kr</option>"; 
        echo "<option>Bodhi Beats - 12.044 kr</option>"; 
        echo "<option>Mats Grønner - 13.000 kr</option>"; 
        echo "<option>Vox Media As - 13.069 kr</option>"; 
        }
        elseif($land == 'Bodø') {
        echo "<option>Mix Studio - 9.666 kr</option>";
        echo "<option>Lett Lyd AS - 11.000 kr</option>";
        echo "<option>Mats Grønner - 13.000 kr</option>";
        echo "<option>Jamtrackz Records - 14.000 kr</option>"; 
        }
        elseif($land == 'Oslo') { 
        echo "<option>Gramo - 6.340 kr</option>"; 
        echo "<option>Myhrbraaten Musikk AS - 6.390 kr</option>"; 
        echo "<option>Musikkloftet AS - 7.420 kr</option>"; 
        echo "<option>Fabrikken Nedregate AS - 8.000 kr</option>"; 
        echo "<option>Carambole Ltd - 10.006 kr</option>"; 
        echo "<option>DaVinci Studio - 11.250 kr</option>"; 
        echo "<option>Pure Music Production - 12.000 kr</option>"; 
        echo "<option>Lindberg Lyd AS - 12.700 kr</option>"; 
        echo "<option>Studio Generations AS - 13.500 kr</option>"; 
        echo "<option>Kvålsvoll Audio Art & Production - 14.000 kr</option>"; 
        }
        elseif($land == 'Stavanger') { 
        echo "<option>Studio 24 - 8.000 kr</option>";
        echo "<option>Cutting Edge Productions AS - 9.600 kr</option>";
        echo "<option>Deathrow Records - 15.900 kr</option>"; 
        }
        elseif($land == 'Trondheim') { 
        echo "<option>Touchdown Music AS - 8.000 kr</option>";
        echo "<option>Lydproduksjon DA - 9.000 kr</option>";
        echo "<option>Nidaros Studio - 10.300 kr</option>";
        echo "<option>Sunking DA - 10.700 kr</option>";
        }
        elseif($land == 'Tromsø') {
        echo "<option>Abdu Raman Lyd - 3.600 kr</option>"; 
        echo "<option>Lydproduksjon Tromsø AS - 8.700 kr</option>";
        echo "<option>Bandit Beats AS - 9.600 kr</option>";
        echo "<option>Tone Reds DA - 11.000 kr</option>";
        echo "<option>Tromsø Platestudio - 11.200 kr</option>";
        echo "<option>Kingzize AS - 13.002 kr</option>";
        echo "<option>Studio Vipslash - 13.028 kr</option>";
        }
        elseif($land == 'Kristiansand') { 
        echo "<option>Studio 24 - 8.000 kr</option>";
        echo "<option>Lydbølgen - 9.330 kr</option>";
        echo "<option>Stardust Productions - 10.000 kr</option>";
        echo "<option>Sunking DA - 10.700 kr</option>";
        echo "<option>Deathrow Records - 15.900 kr</option>"; 
        }
        elseif($land == 'Sandefjord') { 
        echo "<option>Karlbart AS - 9.600 kr</option>";
        echo "<option>Innspillings Studio - 9.700 kr</option>";
        echo "<option>Sandefjord Melodi AS - 10.290 kr</option>";
        echo "<option>Dagfinn & Bernt AS - 14.606 kr</option>";
        echo "<option>MO Platestudio - 15.000 kr</option>";
        }
        
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Antall låter</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"antallsanger\">";
        
        if($StudioInfo['PlaterUtgitt'] >= '0' && $StudioInfo['PlaterUtgitt'] < '3') { $MinSanger = '3'; $MaxSanger = '6'; } 
        elseif($StudioInfo['PlaterUtgitt'] >= '3' && $StudioInfo['PlaterUtgitt'] < '6') { $MinSanger = '4'; $MaxSanger = '9'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '6' && $StudioInfo['PlaterUtgitt'] < '9') { $MinSanger = '5'; $MaxSanger = '12'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '9' && $StudioInfo['PlaterUtgitt'] < '12') { $MinSanger = '6'; $MaxSanger = '15'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '12' && $StudioInfo['PlaterUtgitt'] < '15') { $MinSanger = '7'; $MaxSanger = '18'; }
        elseif($StudioInfo['PlaterUtgitt'] >= '15') { $MinSanger = '8'; $MaxSanger = '21'; }
        $TallTell = $MinSanger - '1';
        $MaxSanger = $MaxSanger - '1';
        while($TallTell <= $MaxSanger) { 
        $TallTell++;
        $PrisBlir = $TallTell * '4450';
        echo "<option>$TallTell Låter - ".number_format($PrisBlir, 0, ",", ".")." kr</option>";
        }
        echo "
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('$submit_knapp_2').submit()\"><p class=\"pan_str_2\">GI UT PLATE</p></div></form>
        ";
        
        }
        ?>