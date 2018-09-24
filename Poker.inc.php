  <?php
  if(basename($_SERVER['PHP_SELF']) == "Poker.inc.php") { header("Location: index.php"); exit; } else {
  
  function StorstHond($i) { if(array_search('Royal straight flush', $i)) { $H = "Royal straight flush"; } elseif(array_search('Straight flush', $i)) { $H = "Straight flush"; } elseif(array_search('Fire like', $i)) { $H = "Fire like"; } elseif(array_search('Hus', $i)) { $H = "Hus"; } elseif(array_search('Flush', $i)) { $H = "Flush"; } elseif(array_search('Straight', $i)) { $H = "Straight"; } elseif(array_search('Tre like', $i)) { $H = "Tre like"; } elseif(array_search('To par', $i)) { $H = "To par"; } elseif(array_search('Et par', $i)) { $H = "Et par"; } elseif(array_search('Ingenting', $i)) { $H = "Ingenting"; } else { $H = "Ingenting"; } return $H; }
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Poker</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Kasino')\">( Tilbake til kasino )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/Gambling.jpg\"></td></tr>";
  

  $Sjekk = mysql_query("SELECT * FROM Poker WHERE P_brukernavn='$brukernavn' LIMIT 1");
  if(mysql_num_rows($Sjekk) > '0') { 
  
  
  
  
  
  } else { 

  echo "
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Sats\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\">
  <p class=\"Post\">Start bord!</p>
  </td></tr>"; 
  }
  
  
  echo "</table></div>";
  }
  ?>