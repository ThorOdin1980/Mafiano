  <?php
  if(basename($_SERVER['PHP_SELF']) == "SettStilling.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A') { 
  
  echo "
  <script>
  function SettStill() { 
  if($('#Navnet').val() == '') { alert('Brukernavn mangler'); } 
  else if($('#Navnet').val() == 'Brukernavn') { alert('Du må fylle inn brukernavnet.'); } else {
  var Navn = encodeURI($('#Navnet').val());
  var Still = encodeURI($('#V_Type').val());
  $('#SB_Midten2').load('post.php?Logger=GiStilling&Nab='+Navn+'&V_Type='+Still);
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\">
  <tr><td class=\"R_0\" colspan=\"2\"><span style=\"float:left; line-height:30px;\">Sett stilling</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Bruker');\">( Gå tilbake )</span></td></tr>
  <tr><td class=\"R_4\" colspan=\"2\"><img border=\"0\" src=\"../Bilder/Auction.jpg\"></td></tr>
  ";
  
  if($_GET['Nab']) { 
  $S_Bruker = Mysql_Klar($_GET['Nab']);
  $S_Valget = Mysql_Klar($_GET['V_Type']);
  

  $Sjekk_Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$S_Bruker'");
  $Person_Info = mysql_fetch_assoc($Sjekk_Person);
  
  if(empty($S_Bruker)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; }
  elseif(mysql_num_rows($Sjekk_Person) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">$S_Bruker eksisterer ikke.</span></td></tr>"; }
  elseif($Person_Info['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">Er allerede død.</span></td></tr>"; }
  elseif($Person_Info['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">Du kan ikke endre stilling p� din egen bruker.</span></td></tr>"; }
  elseif($Person_Info['type'] == 'A') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">".$Person_Info['brukernavn']." er vernet, du kan derfor ikke endre denne brukerens stilling.</span></td></tr>"; } 
  elseif($Person_Info['type'] == $S_Valget) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">Brukeren har allerede denne stillingen.</span></td></tr>"; }
  elseif($S_Valget == 'u' || $S_Valget == 'b' || $S_Valget == 's' || $S_Valget == 'sf' || $S_Valget == 'bz' || $S_Valget == 'mi' || $S_Valget == 'fm' || $S_Valget == 'm') { 
  
  if($S_Valget == 'u') { $Blir = 'vanlig bruker'; } elseif($S_Valget == 'b') { $Blir = 'bot bruker'; } elseif($S_Valget == 's') { $Blir = 'support spiller'; } elseif($S_Valget == 'sf') { $Blir = 'suppport sjef'; } elseif($S_Valget == 'bz') { $Blir = 'bugzorz'; } elseif($S_Valget == 'mi') { $Blir = 'mIRC ansvarlig'; } elseif($S_Valget == 'fm') { $Blir = 'forum moderator'; } elseif($S_Valget == 'm') { $Blir = 'moderator'; }
  if($Person_Info['type'] == 'u') { $Var = 'vanlig bruker'; } elseif($Person_Info['type'] == 'b') { $Var = 'bot bruker'; } elseif($Person_Info['type'] == 's') { $Var['type'] = 'support spiller'; } elseif($Person_Info == 'sf') { $Var['type'] = 'suppport sjef'; } elseif($Person_Info['type'] == 'bz') { $Var['type'] = 'bugzorz'; } elseif($Person_Info['type'] == 'mi') { $Var = 'mIRC ansvarlig'; } elseif($Person_Info['type'] == 'fm') { $Var = 'forum moderator'; } elseif($Person_Info['type'] == 'm') { $Var = 'moderator'; }
  
  $GiTil = $Person_Info['brukernavn'];
  

  mysql_query("INSERT INTO `StillingsLogg` (GittTil,GittAv,EndringsLogg,DatoEndret,StampEndret) VALUES ('$GiTil','$brukernavn','$Blir','$AnnenDato','$tiden')");

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('Game','$GiTil','$tiden','$FullDato','Ny stilling','$brukernavn har endret stillingen din fra $Var til $Blir.','Ja')");

  mysql_query("UPDATE brukere SET type='$S_Valget' WHERE brukernavn='$GiTil'");
  mysql_query("UPDATE brukere SET aktiv_eller='$tiden_aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_1\">Du har endret stillingen til $GiTil fra $Var til $Blir.</span></td></tr>";
  } else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"2\"><span class=\"T_2\">Ugyldig valg av stilling.</span></td></tr>";  }
  }
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"2\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select id=\"V_Type\"><option value=\"u\">Vanlig bruker</option><option value=\"b\">Mafiano bot bruker</option><option value=\"s\">Support spiller - ingen funksjoner ledige for denne stillingen</option><option value=\"sf\">Suppport sjef  - ingen funksjoner ledige for denne stillingen</option><option value=\"bz\">Bugzorz  - ingen funksjoner ledige for denne stillingen</option><option value=\"mi\">mIRC ansvarlig  - ingen funksjoner ledige for denne stillingen</option><option value=\"fm\">Forum moderator</option><option value=\"m\">Moderator</option></select>
  <p class=\"Post\" onclick=\"SettStill();\">Sett stilling!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Spiller</td><td class=\"R_4\">Dato</td></tr>";
  

  $I = mysql_query("SELECT * FROM StillingsLogg WHERE Id LIKE '%' ORDER BY `StampEndret` DESC LIMIT 0, 200");
  $Tell = "0";
  if(mysql_num_rows($I) >= '1') { 
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;

  $Dagen = substr($i['DatoEndret'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 

  
  echo "<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['GittTil'])." > ".$i['EndringsLogg']."<br>Gitt av ".$i['GittAv']."</td><td class=\"Linje Plassering\">$Sjekk".$i['DatoEndret']."</td></tr>";
  }}
  
  echo "</table></div>";

  
  }}
  ?>