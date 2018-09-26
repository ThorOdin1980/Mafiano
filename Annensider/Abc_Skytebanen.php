        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
        <!-- 
        function countDown() { var s=document.getElementById('tell'); var cnt = parseInt(s.innerHTML) - 1; s.innerHTML=cnt; if(cnt > 0) { setTimeout("countDown();",1000); }} window.onload = countDown;
        // --> 
        </script>
        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
      
        $kidnapp_sjekk_om2K = mysql_query("SELECT * FROM kidnapping WHERE offer='$brukernavn'");
        if (mysql_num_rows($kidnapp_sjekk_om2K) > '0') { header("Location: game.php?side=kidnappet"); } else { 
 
      
        $sykehus_sjekk_om2K = mysql_query("SELECT * FROM sykehus WHERE brukernavn='$brukernavn' AND timestampen_ute > $tiden");
        if (mysql_num_rows($sykehus_sjekk_om2K) > '0') { header("Location: game.php?side=Sykehus"); } else { 
 
        // sjekker om du sitter i bunker
      
        $bunker_ell = mysql_query("SELECT * FROM bunker_invite WHERE kis_invitert ='$brukernavn' AND godtatt_elle LIKE '1'");
        if (mysql_num_rows($bunker_ell) >= '1') { header("Location: game.php?side=bunker"); } else {

        // Sjekker om du sitter i fengsel
      
        $fengsel_sjekk_om = mysql_query("SELECT * FROM fengsel WHERE brukernavn ='$brukernavn'");
        if (mysql_num_rows($fengsel_sjekk_om) > '0') { header("Location: game.php?side=Fengsel"); } else {
        
        // Sjekker om du trener ett vopen
        $VopenTrening = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND trener_ell LIKE '1'");
        if(mysql_num_rows($VopenTrening) >= '1') {  
        $TrenVopenInfo = mysql_fetch_assoc($VopenTrening);
        
          $ny_tid_tren11 = $TrenVopenInfo['skytetrening_over'] - $tiden;
        
          if($TrenVopenInfo['utstyr'] == 'Hammer') { $tekst_blir_1 = "Du trener med en hammer, målet ditt er å forbedre slagkraften. Treningen er over om <span id='tell'>".$ny_tid_tren11."</span> sekunder."; } 
          elseif($TrenVopenInfo['utstyr'] == 'Balltre') { $tekst_blir_1 = "Du trener med et balltre, målet ditt er å forbedre slengkraften. Treningen er over om <span id='tell'>".$ny_tid_tren11."</span> sekunder."; }
          elseif($TrenVopenInfo['utstyr'] == 'Knokejern' || $VopenInfo['utstyr'] == 'Knokjern') { $tekst_blir_1 = "Du trener med knokejern, målet ditt er å forbedre håndteringen av et knokejern. Treningen er over om <span id='tell'>".$ny_tid_tren11."</span> sekunder."; }
          elseif($TrenVopenInfo['utstyr'] == 'Kniv') { $tekst_blir_1 = "Du trener med en kniv, målet ditt er å forbedre måten du bruker kniven på. Treningen er over om <span id='tell'>".$ny_tid_tren11."</span> sekunder."; } else { $tekst_blir_1 = "Du trener med ".$TrenVopenInfo['utstyr'].", målet ditt er å forbedre skyte ferdighetene dine. Treningen er over om <span id='tell'>$ny_tid_tren11</span> sekunder."; }
          
          echo "
          <div class=\"Div_masta\">
          <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">VÅPEN TRENING</span></div>
          <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/tren_desert.jpg\" width=\"490\" height=\"200\"></div>
          <div class=\"Div_MELDING\"><span class=\"Span_str_5\">".$tekst_blir_1."</span></div>
          </div>";
        
        } else { 


          // Viser vopen du kan trene
          echo "
          <div class=\"Div_masta\"><form method=\"post\" id=\"Trening\">
          <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">VÅPEN TRENING</span></div>
          <div class=\"Div_bilde\"><img border=\"0\" src=\"../Bilder/tren_desert.jpg\" width=\"490\" height=\"200\"><input type=\"hidden\" name=\"action\" id=\"du_valgte\" /></div>
          ";
        
          function rengjor_tall($tall){ $tall = ereg_replace("[^0-9]", "",$tall); $tall = preg_replace("/[a-zA-Z-\+\-\*\.\,]/","",$tall); return $tall; }

        
          if (isset($_POST['action'])) { 
          $VoIdBli = rengjor_tall(mysql_real_escape_string($_POST['action']));
          if(empty($VoIdBli)) { 
          echo '<div class="Div_MELDING"><span class="Span_str_5">Du har valgt et ugyldig våpen, vist dette var uventet vennligst rapporter det til en medlem av Mafiano Crew.</span></div>';
          include "Abc_VopenTrening2.php";
          } else { 
          $VoIdBli = $VoIdBli / '525236902';
        
          $SjekkGunner = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND id LIKE '$VoIdBli' AND forbruk_nr >= '1'");
          if(mysql_num_rows($SjekkGunner) == '0') {  
          echo '<div class="Div_MELDING"><span class="Span_str_5">Du kan desverre ikke trene dette våpenet, vist dette var uventet vennligst rapporter det til en medlem av Mafiano Crew.</span></div>';
          include "Abc_VopenTrening2.php";
          } else {
          $ValgtVopenInfo = mysql_fetch_assoc($SjekkGunner);
          if($VopenInfo['skytereningen'] >= '100') { 
          echo '<div class="Div_MELDING"><span class="Span_str_5">Du har full trening med dette våpenet alt.</span></div>';
          include "Abc_VopenTrening2.php";
          } else {
          if($VopenInfo['utstyr'] == 'Hammer') { $Pris_Blir = "2000"; } 
          elseif($VopenInfo['utstyr'] == 'Balltre') { $Pris_Blir = "2500"; }
          elseif($VopenInfo['utstyr'] == 'Knokejern' || $VopenInfo['utstyr'] == 'Knokjern') { $Pris_Blir = "3306"; }
          elseif($VopenInfo['utstyr'] == 'Kniv') { $Pris_Blir = "2240"; } else { 
          $Pris_Blir = "7043"; }
          if($Pris_Blir > $penger) { 
          echo '<div class="Div_MELDING"><span class="Span_str_5">Du har desverre ikke nok penger på hånda.</span></div>';
          include "Abc_VopenTrening2.php";
          } else { 
          $ny_sum_spenn = floor($penger - $Pris_Blir);
          $trening_over = $tiden + '1346';
        
          mysql_query("UPDATE brukere SET penger='$ny_sum_spenn',aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'"); 
          mysql_query("UPDATE vapen_beskyttelse SET trener_ell='1',skytetrening_over='$trening_over',sist_brukt='$tid $nbsp $dato' WHERE brukernavn='$brukernavn' AND id LIKE '$VoIdBli'");
          echo '<div class="Div_MELDING"><span class="Span_str_6">Du har startet en økt med våpentrening, det kostet deg '.number_format($Pris_Blir, 0, ",", ".").' kroner.</span></div>';
          }}}}} else { include "Abc_VopenTrening2.php"; }
          echo "</div></form>";
          // Viser vopen du kan trene over
        
        }
        
        // Lukker toppen
        }}}}}
        ?>