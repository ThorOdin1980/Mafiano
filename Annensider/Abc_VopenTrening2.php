       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?
        if (empty($brukernavn)) { header("Location: index.php"); } else { 
        
        
          $VopenListe = mysql_query("SELECT * FROM vapen_beskyttelse WHERE brukernavn='$brukernavn' AND type='1' AND forbruk_nr >= '1' ORDER BY `forbruk_nr` DESC");
          if(mysql_num_rows($VopenListe) == '0') { echo '<div class="Div_MELDING"><span class="Span_str_5">Du bærer ingen våpen, plasser våpen du eier før du skal trene.</span></div>'; } else { 
          while($VopenInfo = mysql_fetch_assoc($VopenListe)) {
        
          if($VopenInfo['utstyr'] == 'Hammer') { $tekst_blir_1 = "Slagtrening"; $tekst_blir_5 = "2.000 kroner for en treningsøkt"; } 
          elseif($VopenInfo['utstyr'] == 'Balltre') { $tekst_blir_1 = "Slengtrening"; $tekst_blir_5 = "2.500 kroner for en treningsøkt"; }
          elseif($VopenInfo['utstyr'] == 'Knokejern' || $VopenInfo['utstyr'] == 'Knokjern') { $tekst_blir_1 = "Slåtrening"; $tekst_blir_5 = "3.306 kroner for en treningsøkt"; }
          elseif($VopenInfo['utstyr'] == 'Kniv') { $tekst_blir_1 = "Stikktrening"; $tekst_blir_5 = "2.240 kroner for en treningsøkt"; } else { $tekst_blir_1 = "Skytetrening"; $tekst_blir_5 = "7.043 kroner for en treningsøkt"; }
          
          if($VopenInfo['skytereningen'] == '0') {      $tekst_blir_2 = "Du har aldri trent med dette våpenet før"; } 
          elseif($VopenInfo['skytereningen'] >= '1') {  $tekst_blir_2 = "".$VopenInfo['skytereningen']."% prosent utført"; }
          
          if(empty($VopenInfo['sist_brukt'])) { $tekst_blir_3 = "Våpenet har ikke blitt brukt i en trening enda"; } else { $tekst_blir_3 = $VopenInfo['sist_brukt']; }
          
          $fucka_id = $VopenInfo['id'] * '525236902';
          
          echo"
          <div class=\"Div_Porno\" onclick=\"document.getElementById('du_valgte').value='".$fucka_id."';document.getElementById('Trening').submit()\">
          <span class=\"Span_str_8\">
          <b>Våpen:</b> ".htmlspecialchars($VopenInfo['utstyr'])."<br>
          <b>".$tekst_blir_1.":</b> ".$tekst_blir_2."<br>
          <b>Kostnad:</b> ".$tekst_blir_5."<br>
          <b>Sist trening:</b> ".$tekst_blir_3."<br>
          </span><br>
          </div>
          ";
          }}
        
        }
        ?>