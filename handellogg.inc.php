  <?php
  if(basename($_SERVER['PHP_SELF']) == "handellogg.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  echo "
  <script>
  function SokEtter() { 
  if($('#Navnet').val() == '' || $('#Navnet').val() == 'Brukernavn') { alert('Brukernavn mangler.'); } 
  else if($('#V_Type').val() == '') { alert('Du må velge mellom avsenter og mottaker.'); } 
  else if($('#V_Type').val() == 'Selger' || $('#V_Type').val() == 'Kjoper') {
  var Navnet = encodeURI($('#Navnet').val());
  var Valget = encodeURI($('#V_Type').val());
  $('#SB_Midten2').load('post.php?Logger=Handel&Sok='+Navnet+'&Valget='+Valget);
  }}
  </script>
  ";
  
  if($_GET['Sok'] && $_GET['Valget']) { 
  $Sok = Mysql_Klar($_GET['Sok']);
  $Valget = Mysql_Klar($_GET['Valget']);
  if(empty($Sok)) { $SokNavn = "id LIKE '%'"; } 
  elseif($Valget == 'Selger' || $Valget == 'Kjoper') { 
  if($Valget == 'Selger') { $SokNavn = "Selger LIKE '%".$Sok."%'";  } else { $SokNavn = "Kjoper LIKE '%".$Sok."%'"; }
  } else { $SokNavn = "id LIKE '%'"; }
  } else { $SokNavn = "id LIKE '%'"; }
  
  

  $Opp = mysql_query("SELECT * FROM AuksjonLogg WHERE $SokNavn ORDER BY `Stamp` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  $Dagen = substr($i['Dato'], 12, 7) . '';
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Logg = $Logg."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['Selger'])."</td><td class=\"Linje Plassering\">".$i['Info']."</td><td class=\"Linje Plassering\">".BrukerURL($i['Kjoper'])."<br>".$i['Dato']."</td></tr>"; }
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Handel</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( Gå tilbake )</span></td></tr>";
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select id=\"V_Type\"><option>Selger</option><option>Kjoper</option></select>
  <p class=\"Post\" onclick=\"SokEtter();\">Søk!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Selger</td><td class=\"R_4\">Vare</td><td class=\"R_4\">Kjøpt</td></tr>$Logg";
  echo "</table></div>";
  
  }}
  ?>