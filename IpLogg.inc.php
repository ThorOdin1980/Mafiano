  <?php
  if(basename($_SERVER['PHP_SELF']) == "IpLogg.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { 
  
  function ByttUt($text) { $trans = array("¯" => '√∏',"ÿ" => '√ò',"Â" => '√•',"≈" => '√Ö',"Ê" => '√¶',"∆" => '√Ü',"ˆ" => '√∂'); $translated = strtr($text, $trans); return $translated; } 

  
  echo "
  <script>
  function SokEtter() { 
  if($('#Navnet').val() == '') { alert('Brukernavn / IP kan ikke st√• tomt.'); } 
  else if($('#Navnet').val() == 'Brukernavn / IP') { alert('Du m√• fylle inn feltet.'); } else { 
  var Sok = encodeURI($('#Navnet').val());
  $('#SB_Midten2').load('post.php?Logger=IpLogg&Sok='+Sok);
  }}
  </script>
  ";
  


  
  if($_GET['Sok']) { 
  $Sok = Mysql_Klar($_GET['Sok']);
  if(empty($Sok)) { $Let = "bruker LIKE '%'"; } 
  elseif(filter_var($Sok, FILTER_VALIDATE_IP)) { 
  $Let = "ip_brukt_nett LIKE '%".$Sok."%'";
  } else { 
  $Let = "bruker LIKE '%".$Sok."%'";
  }} else { $Let = "bruker LIKE '%'"; }
  

  $IP_Logg = mysql_query("SELECT * FROM Ip_logg WHERE $Let ORDER BY `timestampen` DESC LIMIT 200");
  $Tell = '0'; while($i = mysql_fetch_assoc($IP_Logg)) { $Tell++; 
  $Dagen = substr($i['dato'], 12, 7) . ''; $Dag2 = igaar($DatoIdag); $Dag3 = igaar($Dag2);
  if($Dagen == $DatoIdag) { $Sjekk = "<font color=\"#FFFFFF\">I dag</font><br>"; } elseif($Dagen == $Dag2) { $Sjekk = "<font color=\"#FFFFFF\">I g√•r</font><br>"; } elseif($Dagen == $Dag3) { $Sjekk = "<font color=\"#FFFFFF\">I forg√•rs</font><br>"; } else { $Sjekk = ''; }
  if($Dagen == $DatoIdag) { if($Tell % 2 == 0) { $Klasse = "Viktig_1"; } else { $Klasse = "Viktig_2"; }} elseif($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; } 
  $Logg = $Logg."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['bruker'])."</td><td class=\"Linje Plassering\"><font color=\"#FFFFFF\">".$i['ip_brukt_nett']."</font><br><font style=\"font-size:10px;\">".ByttUt($i['Stedet'])."<br>".$i['nettleser']."</font></td><td class=\"Linje Plassering\">$Sjekk".$i['dato']."</td></tr>"; }
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Ip logg</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( G√• tilbake )</span></td></tr>";
  
  echo "
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\" colspan=\"3\">
  <input type=\"text\" id=\"Navnet\" value=\"Brukernavn / IP\" maxlength=\"30\" onFocus=\"if(this.value=='Brukernavn / IP')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn / IP';\">
  <p class=\"Post\" onclick=\"SokEtter()\">S√∏k!</p>
  </td></tr>";
  
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Brukernavn</td><td class=\"R_4\">Informasjon</td><td class=\"R_4\">Dato</td></tr>$Logg";
  echo "</table></div>";
  
  }}
  ?>