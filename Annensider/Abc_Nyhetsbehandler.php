        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?
        if(empty($type)) { header("Location: index.php"); } else { 
        if(empty($brukernavn)) { header("Location: index.php"); } else { 
        if($type == 'A' || $type == 'm') { 
        
        echo "
        <div class=\"Div_masta\"><form method=\"post\" id=\"Nyhetsbehandler\"><input type=\"hidden\" name=\"action\" id=\"du_valgte\" />
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">NYHETSBEHANDLER</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Nyheter-2.jpg\" width=\"490\" height=\"200\"></div>
        ";
        
        
        if(isset($_POST['action']) && $_POST['action'] == "NyNyhet") { 
        $Overskrift = Mysql_Klar($_POST['Overskrift']);
        $Nyhet = Mysql_Klar($_POST['Nyhet']);
        if(empty($Overskrift)) { echo PrintTeksten("Nyheten mangler en overskirft.",'1',"Feilet"); } 
        elseif(empty($Nyhet)) { echo PrintTeksten("Nyheten mangler selve innholdet.",'1',"Feilet"); } 
        else { 
        
        mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
        
        mysql_query("INSERT INTO Nyheter (Brukernavn,Nyhet,Dato,Stamp,Overskrift) VALUES ('$brukernavn','$Nyhet','$FullDato','$Timestamp','$Overskrift')");
        echo PrintTeksten('Nyheten er nå publisert.','1','Vellykket');
        }}
        elseif(isset($_POST['action']) && $_POST['action'] == "SlettNyhet") { 
        $box = $_POST['box1'];
        $box_count = count($box);
        if($box_count > '20') { echo PrintTeksten('Du kan maks slette 20 nyheter på en gang.','1','Feilet'); } else {
        $it_ma = '0'; 
      
        foreach ($box as $dear) {
        $dear = Dekrypt_Tall($dear);
        mysql_query("DELETE FROM `Nyheter` WHERE `id` = '$dear'");
        $it_ma++;
        }
        if($it_ma == '0') { 
        echo PrintTeksten('Du har ikke valgt hvilke nyheter du skal slette.','1','Feilet');
        } else {
        echo PrintTeksten("Du har slettet $it_ma nyhet/er.",'1','Vellykket');
        }}}
        
        if(empty($_POST['Overskrift'])) { $En = ''; } else { $En = $_POST['Overskrift']; }
        if(empty($_POST['Nyhet'])) { $To = ''; } else { $To = $_POST['Nyhet']; }

        
        echo "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Overskrift</span></div>
        <div class=\"Div_hoyre_side_1\"><input class=\"textbox\" type=\"text\" name=\"Overskrift\" maxlength=\"70\" value=\"$En\"></div>
        <div class=\"Div_venstre_side_2\"></div>
        <div class=\"Div_hoyre_side_2\"><textarea class=\"texterea\" name=\"Nyhet\">$To</textarea></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('du_valgte').value='NyNyhet';document.getElementById('Nyhetsbehandler').submit()\"><p class=\"pan_str_2\">POST NYHET</p></div>
        <div class=\"Div_mellomledd\">&nbsp;</div>
        <div class=\"Div_innledning\"><span class=\"Span_str_2\">NYHETER</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Overskrift</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Skrevet av</span></div>
        <div class=\"Div_top_1\"><span class=\"Span_str_1\">Dato</span></div>
        <div class=\"Div_top_2\"><span class=\"Span_str_1\">Merk</span></div>
        ";
        
        $antall = AntallSider($_REQUEST['s']);
        
      
        $Il = mysql_query("SELECT * FROM Nyheter WHERE id LIKE '%' ORDER BY `Stamp` DESC LIMIT $antall, 20");
        while ($Rad = mysql_fetch_assoc($Il)) {   
        $fake_id = Krypt_Tall($Rad['id']);
        echo '
        <div class="Div_bunn_1">&nbsp;&nbsp;'.$Rad['Overskrift'].'</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.BrukerURL($Rad['Brukernavn']).'</div>
        <div class="Div_bunn_1">&nbsp;&nbsp;'.$Rad['Dato'].'</div>
        <div class="Div_bunn_2">&nbsp;&nbsp;<input type="checkbox" name="box1[]" value="'.$fake_id.'"></div>
        ';
        }
        
      
        $Rader = mysql_query("SELECT * FROM Nyheter WHERE id LIKE '%'");
        echo VisSideListe(mysql_num_rows($Rader),'Nyhetsbehandler');

        echo "
        <div class=\"Div_submit_knapp_3\" onclick=\"document.getElementById('du_valgte').value='SlettNyhet';document.getElementById('Nyhetsbehandler').submit()\"><p class=\"pan_str_2\">SLETT</p></div></form>
        </div>
        ";
        }}}
        ?>
        