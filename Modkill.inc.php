  <style>
  .Send .PostEn { width:150px; text-align:center; margin:2px 7px 0 7px; background-color:#444444; color:#b6e122; font-size:11px; font-weight:bold; padding:3px; filter:alpha(opacity=50); opacity:0.5; }
  .Send .PostEn:hover { cursor:pointer; filter:alpha(opacity=90); opacity:0.9; }
  </style>
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Modkill.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A') { 
  
  echo "
  <script>
  function Modkill(Valget) { 
  if($('#Navnet').val() == '') { alert('Brukernavn mangler'); } 
  else if($('#Navnet').val() == 'Brukernavn') { alert('Du må fylle inn brukernavnet.'); } else { 
  var Sok = encodeURI($('#Navnet').val());
  var Valget = encodeURI(Valget);
  var grunn = encodeURI($('#R_Info').val());
  $('#SB_Midten2').load('post.php?Logger=Modkill&Nab='+Sok+'&V_Type='+Valget+'&R_Info='+grunn);
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Modkill / Gjennoppliv</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Bruker');\">( Gå tilbake )</span></td></tr><tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/Modkill.jpg\"></td></tr>";
  
  if($_GET['Nab']) { 
  $S_Bruker = Mysql_Klar($_GET['Nab']);
  $S_Valget = Mysql_Klar($_GET['V_Type']);
  $S_Grunn = Mysql_Klar($_GET['R_Info']);

  $Sjekk_Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$S_Bruker'");
  $Person_Info = mysql_fetch_assoc($Sjekk_Person);
  if($S_Valget == 'Henrett') { 
  if(empty($S_Bruker)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; }
  elseif(mysql_num_rows($Sjekk_Person) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$S_Bruker eksisterer ikke.</span></td></tr>"; }
  elseif($Person_Info['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Er allerede død.</span></td></tr>"; }
  elseif($Person_Info['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke henrette din egen bruker.</span></td></tr>"; }
  elseif($Person_Info['type'] == 'A') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Administrator ranken er vernet.</span></td></tr>"; } else { 
  $S_Bruker = $Person_Info['brukernavn'];

  mysql_query("UPDATE brukere SET aktiv_eller='$Timestamp',modkilled='1',liv='0' WHERE brukernavn='$S_Bruker'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("INSERT INTO `modkill_logg` (offer,modkillet_av,dato,timestampen,arsak,hvilket) VALUES ('$S_Bruker','$brukernavn','$AnnenDato','$tiden','$S_Grunn','1')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Du har henrettet ".BrukerURL($S_Bruker).".</span></td></tr>"; 
  }} 
  elseif($S_Valget == 'Oppliv') { 
  if(empty($S_Bruker)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; }
  elseif(mysql_num_rows($Sjekk_Person) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">$S_Bruker eksisterer ikke.</span></td></tr>"; }
  elseif($Person_Info['liv'] > '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Er er ikke død.</span></td></tr>"; } else {
  $S_Bruker = $Person_Info['brukernavn'];

  mysql_query("UPDATE brukere SET modkilled='0',liv='100' WHERE brukernavn='$S_Bruker'");
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");

  mysql_query("INSERT INTO `modkill_logg` (offer,modkillet_av,dato,timestampen,arsak,hvilket) VALUES ('$S_Bruker','$brukernavn','$AnnenDato','$tiden','$S_Grunn','2')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Du har gjennopplivet ".BrukerURL($S_Bruker).".</span></td></tr>"; 
  }} else { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig valg.</span></td></tr>"; }
  }
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <textarea id=\"R_Info\" onFocus=\"if(this.value=='Grunnlag')this.value='';\" onblur=\"if(this.value=='')this.value='Grunnlag';\">Grunnlag</textarea>
  <p style=\"float:left;\" onclick=\"Modkill('Henrett')\" class=\"PostEn\">Henrett</p><p style=\"float:right;\" onclick=\"Modkill('Oppliv')\" class=\"PostEn\">Gjennoppliv</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Spiller</td><td class=\"R_4\">Dato</td><td class=\"R_4\">Grunnlag</td></tr>";
  

  $I = mysql_query("SELECT * FROM modkill_logg WHERE id LIKE '%' ORDER BY `timestampen` DESC LIMIT 0, 30");
  $Tell = "0";
  if(mysql_num_rows($I) >= '1') { 
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;

  $Dagen = substr($i['dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I går</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forgårs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 

  if($i['hvilket'] == '1') { $OI = 'Henrettet'; } else { $OI = "<font color=\"#3c943c\">Opplivet</font>"; }
  
  echo "<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['offer'])." > $OI<br> Av ".$i['modkillet_av']."</td><td class=\"Linje Plassering\">$Sjekk".$i['dato']."</td><td class=\"Linje Plassering\">".$i['arsak']."</td></tr>";
  }}
  
  echo "</table></div>";

  
  }}
  ?>