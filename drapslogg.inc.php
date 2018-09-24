  <?php
  if(basename($_SERVER['PHP_SELF']) == "drapslogg.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  echo "
  <script>
  function SokEtter() { 
  if($('#Navnet').val() == '' || $('#Navnet').val() == 'Brukernavn') { alert('Brukernavn mangler.'); } 
  else if($('#V_Type').val() == '') { alert('Du må velge mellom drapsman og offer.'); } 
  else if($('#V_Type').val() == 'Drapsman' || $('#V_Type').val() == 'Offer') {
  var Navnet = encodeURI($('#Navnet').val());
  var Valget = encodeURI($('#V_Type').val());
  $('#SB_Midten2').load('post.php?Logger=Drap&Sok='+Navnet+'&Valget='+Valget);
  }}
  </script>
  ";
  
  if($_GET['Sok'] && $_GET['Valget']) { 
  $Sok = Mysql_Klar($_GET['Sok']);
  $Valget = Mysql_Klar($_GET['Valget']);
  if(empty($Sok)) { $SokNavn = "DreptAv LIKE '%'"; } 
  elseif($Valget == 'Drapsman' || $Valget == 'Offer') { 
  if($Valget == 'Drapsman') { $SokNavn = "DreptAv LIKE '%".$Sok."%'";  } else { $SokNavn = "BrukerDrept LIKE '%".$Sok."%'"; }
  } else { $SokNavn = "DreptAv LIKE '%'"; }
  } else { $SokNavn = "DreptAv LIKE '%'"; }


  $Opp = mysql_query("SELECT * FROM DrapsLogg WHERE $SokNavn ORDER BY `TimestampDrept` DESC LIMIT 150");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  $Dagen = substr($i['DatoDrept'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Logg = $Logg."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['DreptAv'])."</td><td class=\"Linje Plassering\">".BrukerURL($i['BrukerDrept'])."</td><td class=\"Linje Plassering\">$Sjekk".$i['DatoDrept']."</td></tr>"; }
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Draps logg</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( Gå tilbake )</span></td></tr>";
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select id=\"V_Type\"><option>Drapsman</option><option>Offer</option></select>
  <p class=\"Post\" onclick=\"SokEtter();\">Søk!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Drapsman</td><td class=\"R_4\">Offer</td><td class=\"R_4\">Dato</td></tr>$Logg";
  echo "</table></div>";
  
  }}
  ?>