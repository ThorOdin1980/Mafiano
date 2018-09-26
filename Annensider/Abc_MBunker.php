        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }
        
        $PlassBUNKER = "
        <div class=\"Div_venstre_side_1\"><span class=\"Span_str_1\">Tidslengde</span></div>
        <div class=\"Div_hoyre_side_1\"><select class=\"textbox\" name=\"Tidslengde\">
        <option value=\"1\">1 Time - 50.000 kr</option>
        <option value=\"2\">2 Timer - 150.000 kr</option>
        <option value=\"3\">3 Timer - 250.000 kr</option>
        <option value=\"4\">4 Timer - 350.000 kr</option>
        <option value=\"5\">5 Timer - 450.000 kr</option>
        <option value=\"6\">6 Timer - 550.000 kr</option>
        <option value=\"7\">7 Timer - 650.000 kr</option>
        <option value=\"8\">8 Timer - 750.000 kr</option>
        <option value=\"9\">9 Timer - 850.000 kr</option>
        </select></div>
        <div class=\"Div_venstre_side_1\">&nbsp;</div>
        <div class=\"Div_submit_knapp_2\" onclick=\"document.getElementById('Bunker').submit()\"><p class=\"pan_str_2\">GÅ INN I BUNKER</p></div>
        ";
        
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') {  
         
          $BuInfo = mysql_fetch_assoc($bunker_ell);
          $TidUte = $BuInfo['timestamp_ute'];
          
          $TidIgjen = $BuInfo['timestamp_ute'] - $tiden;
          
          
          if($tiden > $TidUte) { 
        
          mysql_query("UPDATE bunker_invite SET godtatt_elle='2',timestamp_ute='0',kis_invitert='',invitert_av='$brukernavn' WHERE kis_invitert LIKE '$brukernavn' AND godtatt_elle LIKE '1'");
          header("Location: game.php?side=Bunker");
          } else { 
          
         
          echo "
          <div class=\"Div_masta\">
          <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">MIDLERTIDIG BUNKER SYSTEM</span></div>
          <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Bunker-1.jpg\"></div>
          <div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du gikk ned i bunkeren ".$BuInfo['dato_statt_inn'].", du kommer ut om <span id=\"tell\">".$TidIgjen."</span> sekunder.</span></div>
          </div>
          ";
          }
         
       

        
        } else {

        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {
        
        echo "
        <div class=\"Div_masta\"><form method=\"post\" id=\"Bunker\">
        <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">MIDLERTIDIG BUNKER SYSTEM</span></div>
        <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/Bunker-1.jpg\"></div>
        ";
        
        if (isset($_POST['Tidslengde'])) {
        $tidslengde = rengjor_tall(mysql_real_escape_string($_POST['Tidslengde']));
        if(empty($tidslengde)) { 
        echo"<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ugyldig valg.</span></div>";
        echo $PlassBUNKER;
        } else { 
        if($tidslengde == '1' || $tidslengde == '2' || $tidslengde == '3' || $tidslengde == '4' || $tidslengde == '5' || $tidslengde == '6' || $tidslengde == '7' || $tidslengde == '8' || $tidslengde == '9') { 
        
        $LengdeBlir = '3600' * $tidslengde;
        $bunkerLengde = $tiden + $LengdeBlir;
        
        if($tidslengde == '1') { $TekstEN = "1 time"; } else { $TekstEN = "$tidslengde timer"; }

        if($tidslengde == '1') {     $pris = "50000";   } 
        elseif($tidslengde == '2') { $pris = "150000";  }
        elseif($tidslengde == '3') { $pris = "250000";  }
        elseif($tidslengde == '4') { $pris = "350000";  }
        elseif($tidslengde == '5') { $pris = "450000";  }
        elseif($tidslengde == '6') { $pris = "550000";  }
        elseif($tidslengde == '7') { $pris = "650000";  }
        elseif($tidslengde == '8') { $pris = "750000";  }
        elseif($tidslengde == '9') { $pris = "850000";  }

        if($pris > $penger) { 
        echo"<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Du har desverre ikke nok penger på hånda, det koster ".number_format($pris, 0, ",", ".")." kr for å være bunkerplassert i $TekstEN.</span></div>";
        echo $PlassBUNKER;
        } else { 
        
        $NySumSpenn = floor($penger - $pris);
      
        mysql_query("INSERT INTO BunkerLogg (LagtInnStamp,LagtInnDato,Brukernavn,AntallTimer,LagtinnHos,TimestampUte) VALUES ('$tiden','$tid $nbsp $dato $nbsp $aar','$brukernavn','$tidslengde','','$bunkerLengde')");
              
        mysql_query("INSERT INTO `bunker_invite` (invitert_av,kis_invitert,dato,antall_timer,timestamp_invitert,pris,timestamp_ute,godtatt_elle,dato_statt_inn) VALUES ('Havers','$brukernavn','$tid $nbsp $dato','$tidslengde','$tiden','$pris','$bunkerLengde','1','$tid $nbsp $dato')"); 
              
        mysql_query("UPDATE brukere SET penger='$NySumSpenn' WHERE brukernavn='$brukernavn'");
        echo"<div class=\"Div_MELDING\"><span class=\"Span_str_6\">Du er nå plassert i stats bunkern, det kostet deg ".number_format($pris, 0, ",", ".")." kr. Du er trygg i $TekstEN.</span></div>";
        }} else { 
        echo"<div class=\"Div_MELDING\"><span class=\"Span_str_5\">Ugyldig valg.</span></div>";
        echo $PlassBUNKER;
        }}} else { echo $PlassBUNKER; }

        
        echo "</form></div>";
        
        


        
        
        }}}}}
        ?>