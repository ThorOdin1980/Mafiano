  <style>
  .knappo: { font-size:13px; }
  .knappo:hover { font-weight:bold; cursor:pointer; font-size:13px; }
  </style>  
  <?php
  if(basename($_SERVER['PHP_SELF']) == "Tidsstraff.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  echo "
  <script>
  function Straff() { 
  if($('#Navnet').val() == '') { alert('Brukernavn mangler'); } 
  else if($('#Navnet').val() == 'Brukernavn') { alert('Du må fylle inn brukernavnet.'); } else { 
  var Sok = encodeURI($('#Navnet').val());
  var kkk = encodeURI($('#V_Type').val());
  var grunn = encodeURI($('#R_Info').val());
  $('#SB_Midten2').load('post.php?Logger=Tidsstraff&Nab='+Sok+'&V_Type='+kkk+'&R_Info='+grunn);
  }}
  
  function Opphev(Num) { 
  if(Num == '') { alert('id mangler'); } else {
  var Num = encodeURI(Num);
  $('#SB_Midten2').load('post.php?Logger=Tidsstraff&Opphev='+Num);
  $('html, body').animate({scrollTop:100}, 'slow');
  }}
  </script>
  ";
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Tids-straff</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Bruker');\">( Gå tilbake )</span></td></tr><tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/tidsstraff.jpg\"></td></tr>";
  
  
  if($_GET['Opphev']) { 
  $S_Opphev = Bare_Siffer(Dekrypt_Tall(Mysql_Klar($_GET['Opphev'])));
  if(empty($S_Opphev)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Ugyldig id.</span></td></tr>"; } else { 

  $StraffSje = mysql_query("SELECT * FROM TidsStraff WHERE id = '$S_Opphev'");
  if(mysql_num_rows($StraffSje) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Finner ikke feltet i databasen.</span></td></tr>"; } else { 
  $Info = mysql_fetch_assoc($StraffSje);
  if($Info['StampOver'] < $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Straffen har allerede nåd enden, er ikke behov for opphevning..</span></td></tr>"; } else { 
  mysql_query("UPDATE TidsStraff SET StampOver='$Timestamp' WHERE id = '$S_Opphev'");

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Straff opphevet!</span></td></tr>";
  }}}} elseif($_GET['Nab']) { 
  $S_Bruker = Mysql_Klar($_GET['Nab']);
  $S_Lengde = Bare_Siffer(Mysql_Klar($_GET['V_Type']));
  $S_Grunn = Mysql_Klar($_GET['R_Info']);
  if(empty($S_Bruker)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; } 
  elseif(empty($S_Lengde)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Tidslengden mangler.</span></td></tr>"; } 
  elseif($S_Lengde == '24' || $S_Lengde == '48' || $S_Lengde == '72' || $S_Lengde == '96' || $S_Lengde == '120') { 

  $Person = mysql_query("SELECT * FROM brukere WHERE brukernavn='$S_Bruker'");
  $Info = mysql_fetch_assoc($Person);
  if(mysql_num_rows($Person) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukeren eksisterer ikke.</span></td></tr>"; } 
  elseif($Info['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke straffe din egen bruker.</span></td></tr>"; }
  elseif($Info['type'] == 'A' || $Info['type'] == 'm') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke straffe en medlem av MafiaNo Crew.</span></td></tr>"; }
  elseif($Info['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Du kan ikke straffe en spiller som ikke lever.</span></td></tr>"; } else { 

  $Straffer = mysql_query("SELECT * FROM TidsStraff WHERE Straffes='$S_Bruker' AND StampOver > '$tiden'");
  if(mysql_num_rows($Straffer) == '0') { 
  $S_Bruker = $Info['brukernavn'];
  $TallStraff = $tiden + ($S_Lengde * '3600');
  mysql_query("INSERT INTO `TidsStraff` (Straffes,Av,Grunnlag,StampStartet,StampOver,DatoStartet,Info) VALUES ('$S_Bruker','$brukernavn','$S_Lengde timer','$tiden','$TallStraff','$FullDato','$S_Grunn')");

  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_1\">Du har gitt $S_Bruker en straff.</span></td></tr>";
  } else { 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\" colspan=\"3\"><span class=\"T_2\">Brukeren soner en straff alt.</span></td></tr>";
  }}}}

  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <select id=\"V_Type\"><option>24 Timer</option><option>48 Timer</option><option>72 Timer</option><option>96 Timer</option><option>120 Timer</option></select>
  <textarea id=\"R_Info\" onFocus=\"if(this.value=='Grunnlag')this.value='';\" onblur=\"if(this.value=='')this.value='Grunnlag';\">Grunnlag</textarea>
  <p class=\"Post\" onclick=\"Straff()\">Straff!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Dømt</td><td class=\"R_4\">Straff</td><td class=\"R_4\">Kommer</td></tr>";
  

  $I = mysql_query("SELECT * FROM TidsStraff WHERE Straffes LIKE '%' ORDER BY `StampStartet` DESC LIMIT 75");
  $Tell = "0";
  if(mysql_num_rows($I) >= '1') { 
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }  
  
  $StampIgjEN = $i['StampOver'] - $tiden; 
  $TelleID = $Tell * '35';
  $Iden = Krypt_Tall($i['id']);
  if($i['StampOver'] > $tiden) { $sonEll = "<font color=\"#cc3f01\"><b>Soner</b> ( <font id=\"$TelleID\" class=\"TellNed\">$StampIgjEN</font> sek )</font>"; } else { $sonEll = "<font color=\"#3c943c\"><b>Ferdig</b></font>"; }
  
  echo "<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['Straffes'])."<br>Av ".$i['Av']."</td><td class=\"Linje Plassering\">".$i['Grunnlag']."<br>$sonEll</td><td class=\"Linje Plassering knappo\" onclick=\"Opphev('$Iden')\">Opphev</td></tr>";
  }}
  
  echo "</table></div>";

  }}
  ?>