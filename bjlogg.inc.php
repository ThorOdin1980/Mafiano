  <?php
  if(basename($_SERVER['PHP_SELF']) == "bjlogg.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  echo "
  <script>
  function SokEtter() { 
  if($('#Navnet').val() == '' || $('#Navnet').val() == 'Brukernavn' ) { alert('Brukernavn mangler.'); } else { 
  var Navnet = encodeURI($('#Navnet').val());
  $('#SB_Midten2').load('post.php?Logger=Blackjack&Sok='+Navnet);
  }}
  </script>
  ";
  
  if($_GET['Sok']) { 
  $Sok = Mysql_Klar($_GET['Sok']);
  if(empty($Sok)) { $SokNavn = "Brukernavn LIKE '%'"; } else {
  $SokNavn = "Brukernavn LIKE '%".$Sok."%'";
  }} else { $SokNavn = "Brukernavn LIKE '%'"; }
  

  $Opp = mysql_query("SELECT * FROM BjLogg WHERE $SokNavn ORDER BY `Stamp` DESC LIMIT 700");
  $Tell = '0'; while($i = mysql_fetch_assoc($Opp)) { $Tell++; 
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Dagen = substr($i['Dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  if($i['Gevinst'] == '0') { $Svar = ""; } else { $Svar = "<br><font color=\"#3c943c\">Vant ".VerdiSum($i['Gevinst'],'kr')."</font>"; }

  
  $Logg = $Logg."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['Brukernavn'])."<br>Sats ".VerdiSum($i['Satset'],'kr')."</td><td class=\"Linje Plassering\">".$i['Svar']."$Svar</td><td class=\"Linje Plassering\">$Sjekk".$i['Dato']."</td></tr>"; }
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Blackjack logg</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( Gå tilbake )</span></td></tr>";
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <p class=\"Post\" onclick=\"SokEtter();\">Søk!</p>
  </td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Gambler</td><td class=\"R_4\">Svar</td><td class=\"R_4\">Dato</td></tr>$Logg";
  echo "</table></div>";
    
  }}
  ?>