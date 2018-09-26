  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(SjekkPlassering($brukernavn) == 'klar') { 

  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Hitlist</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/hitlist.jpg\"></td></tr>";

  echo "
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <input type=\"text\" id=\"Sum\" value=\"Sum\" onKeyPress=\"return numbersonly(this, event)\" onFocus=\"if(this.value=='Sum')this.value='';\" onblur=\"if(this.value=='')this.value='Sum';\">
  <select id=\"Betaling\"><option>Penger</option><option>Poeng</option></select>
  <select id=\"Sikkerhet\"><option>Kan kjøpes ut ( ingen trekk )</option><option>Kan ikke kjøpes ut ( 1.9% trekkes fra dusøren )</option></select>
  <select id=\"Dager\"><option>2 Dager ( 2.4% trekkes fra dusøren )</option><option>4 Dager ( 3.5% trekkes fra dusøren )</option><option>6 Dager ( 4.6% trekkes fra dusøren )</option><option>8 Dager ( 5.7% trekkes fra dusøren )</option></select>
  <select id=\"Anonym\"><option>Ikke anonymt ( ingen trekk )</option><option>Anonymt ( 1% trekkes fra dusøren )</option></select>
  <p class=\"Post\">Hitlist spiller!</p>
  </td></tr></table></div>";


  $Opp = mysql_query("SELECT * FROM hitlist WHERE id LIKE '%' AND timestampen_over > '$tiden' ORDER BY `timestampen` DESC");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  if($i['anonymt'] == '1') { $Utsendt = BrukerURL($i['hitlisters_navn']); } else { $Utsendt = 'Anonym'; }
  if($i['betalings_typen'] == 'Penger') { $ver = 'kr'; } else { $ver = 'poeng'; }
  $Logg = $Logg."<tr class=\"$Klasse Ekstra\"><td class=\"Linje Plassering\">".BrukerURL($i['hitlist_offer'])."</td><td class=\"Linje Plassering\">$Utsendt</td><td class=\"Linje Plassering\">".VerdiSum($i['hitlist_dusor'],$ver)."</td></tr>"; }

  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Hitlisten</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Mål</td><td class=\"R_4\">Utsendt av</td><td class=\"R_4\">Dusør</td></tr>$Logg";
  echo "</table></div>";

  }
  ?>
        