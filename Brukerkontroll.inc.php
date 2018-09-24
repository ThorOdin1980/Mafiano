  <?php
  if(basename($_SERVER['PHP_SELF']) == "Brukerkontroll.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  echo "
  <div class=\"Div_masta\">
  <div class=\"Div_innledning\" id=\"Div_innleding\"><span class=\"Span_str_2\">Bruker kontroll</span></div>
  <div class=\"Div_submeny_1\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Tidsstraff');\"><span class=\"Span_str_3\">Tids-straff</span><br><span class=\"Span_str_4\">Steng en spiller ute fra MafiaNo i en valgt tidslengde.</span></div>
  <div class=\"Div_submeny_1\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Derank');\"><span class=\"Span_str_3\">Nedranking</span><span class=\"Span_str_4\">Straff spilleren ved å endre spillerens rangering.</span></div>  
    <div class=\"Div_submeny_1\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Modkill');\"><span class=\"Span_str_3\">Modkill / Gjennoppliv</span><br><span class=\"Span_str_4\">Husk at modkill knappen kun skal brukes i umulige situasjoner hvor det ikke finnes noen annen løsning.</span></div>

  ";
        
  if($rad_B['type'] == 'A') { 
  
  echo "
  <div class=\"Div_submeny_1\" onclick=\"$('#SB_Midten2').load('post.php?Logger=IpBan');\"><span class=\"Span_str_3\">IP Bannlynsing</span><span class=\"Span_str_4\">Bannlys en spesefik ip-adresse fra MafiaNo. Dette alternativet skal kun brukes ved kritiske punkter.</span></div>  
  <div class=\"Div_submeny_1\" onclick=\"$('#SB_Midten2').load('post.php?Logger=GiStilling');\"><span class=\"Span_str_3\">Sett stilling</span><span class=\"Span_str_4\">Utdel en stilling til en valgt spiller.</span></div>";
  }
  echo "</div>";

        
  }}
  ?>