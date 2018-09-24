  <?php
  if(basename($_SERVER['PHP_SELF']) == "banklogg.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  echo "
  <script>
  function SokEtter() { 
  if($('#Navnet').val() == '' || $('#Navnet').val() == 'Brukernavn') { alert('Brukernavn mangler.'); } 
  else if($('#V_Type').val() == '') { alert('Du må velge mellom avsender og mottaker.'); } 
  else if($('#V_Type').val() == 'Avsender' || $('#V_Type').val() == 'Mottaker') {
  var Navnet = encodeURI($('#Navnet').val());
  var Valget = encodeURI($('#V_Type').val());
  $('#SB_Midten2').load('post.php?Logger=Bank&Sok='+Navnet+'&Valget='+Valget);
  }}
  </script>
  ";
  
  if($_GET['Sok'] && $_GET['Valget']) { 
  $Sok = Mysql_Klar($_GET['Sok']);
  $Valget = Mysql_Klar($_GET['Valget']);
  if(empty($Sok)) { $SokNavn = "motakers_brukernavn LIKE '%'"; } 
  elseif($Valget == 'Avsender' || $Valget == 'Mottaker') { 
  if($Valget == 'Avsender') { $SokNavn = "senders_brukernavn LIKE '%".$Sok."%'";  } else { $SokNavn = "motakers_brukernavn LIKE '%".$Sok."%'"; }
  } else { $SokNavn = "motakers_brukernavn LIKE '%'"; }
  } else { $SokNavn = "motakers_brukernavn LIKE '%'"; }
  

  $Opp = mysql_query("SELECT * FROM bank_overforinger WHERE $SokNavn ORDER BY `timestampen` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  $Dagen = substr($i['dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Logg = $Logg."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['senders_brukernavn'])."<br>".VerdiSum($i['sum'],'kr')."</td><td class=\"Linje Plassering\">".BrukerURL($i['motakers_brukernavn'])."</td><td class=\"Linje Plassering\">$Sjekk".$i['dato']."</td></tr>"; }
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"4\"><span style=\"float:left; line-height:30px;\">Bank transaksjoner</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( Gå tilbake )</span></td></tr>";
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select id=\"V_Type\"><option>Avsender</option><option>Mottaker</option></select>
  <p class=\"Post\" onclick=\"SokEtter();\">Søk!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Avsender</td><td class=\"R_4\">Mottaker</td><td class=\"R_4\">Dato</td></tr>$Logg";
  echo "</table></div>";
  
  }}
  ?>