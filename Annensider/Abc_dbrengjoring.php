  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if($type == 'A') {
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Viktig informasjon</span></td></tr>";
  echo "<tr class=\"Vanlig_1\"><td class=\"Linje Innboks\"><span class=\"Meld\"><p class=\"fra\">Server</p><p class=\"dato\">Kommer</p></span><span class=\"Melden\"><p class=\"tittel\">Info kommer</p><br><p class=\"beskjed\"></p></span></td></tr>";
  echo "<tr class=\"Vanlig_2 SjekkMeld\"><td class=\"Linje Innboks\"><span class=\"Meld\"><p class=\"fra\">Database</p><p class=\"dato\">Kommer</p></span><span class=\"Melden\"><p class=\"tittel\">Info kommer</p><br><p class=\"beskjed\"></p></span></td></tr>";
  echo "<tr class=\"Vanlig_1 SjekkMeld\"><td class=\"Linje Innboks\"><span class=\"Meld\"><p class=\"fra\">Statistikk</p><p class=\"dato\">Kommer</p></span><span class=\"Melden\"><p class=\"tittel\">Info kommer</p><br><p class=\"beskjed\"></p></span></td></tr>";
  echo "</table></div>";
        

  } else { header("Location: index.php"); }
  ?>