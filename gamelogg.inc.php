  <?php
  if(basename($_SERVER['PHP_SELF']) == "gamelogg.inc.php") { header("Location: index.php"); exit; } else {
  

  $I = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Ja' AND slettet_ell='Nei' ORDER BY `timestampen` DESC LIMIT 75");
  $R_Log = "";
  $Tell = "0";
  if(mysql_num_rows($I) >= '1') { 
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }  
  $R_Log = $R_Log."<tr class=\"$Klasse\"><td class=\"Linje\"><span style=\"font-size:11px; font-weight:bold;\">".$i['tittel']." <i style=\"font-size:10px;\">".$i['dato_sendt']."</i></span><br><span style=\"font-size:10px;\">".$i['melding']."</span></td></tr>";
  }}
  echo "
  <div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Logg</span></td></tr>
  <tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/les%20melding.jpg\"></td></tr>$R_Log</table></div>
  ";
  
  $SlettEll = $Timestamp - '288000';
  mysql_query("DELETE FROM `pm_system` WHERE til_bruker='$brukernavn' AND fra_game_ell='Ja' AND timestampen < $SlettEll") or die(mysql_error());

  
  }
  ?>