  <?php
  if(basename($_SERVER['PHP_SELF']) == "finnspiller.inc.php") { header("Location: index.php"); exit; } else {
  
  // Funksjoner
  function Finn($String,$Finn) { $String = strtolower($String); $Finn = strtolower($Finn); $p = strpos($String, $Finn); if($p === false) { $T = ''; } else { $T = preg_replace("/$Finn/", "<font color=\"#ffffff\">$Finn</font>", $String)."<br>"; } return $T; }

  
  // Henter s�k
  if($_GET['Sok']) { $Soker = explode(",",strtolower(Mysql_Klar($_GET['Sok']))); }
  if(empty($Soker['0']) || $Soker['0'] == '00000000') { $En = "Brukernavn"; } else { $En = $Soker['0']; }
  if(empty($Soker['1']) || $Soker['1'] == '00000000') { $To = "Epost adresse"; } else { $To = $Soker['1']; }
  if(empty($Soker['2']) || $Soker['2'] == '00000000') { $Tre = "Kommune"; } else { $Tre = $Soker['2']; }
  
  // Hoved html
  echo "
  <script>
  $('.Post').click(function() {
  var Sok = Array();
  if($('#Epost').length == 0) { var Epost = 'Epost adresse'; } else { var Epost = $('#Epost').val(); }
  if($('#Ord').val() == 'Brukernavn' && $('#Kommune').val() == 'Kommune' && Epost == 'Epost adresse') { alert('Du må fylle inn minst et av feltene.'); } else { 
  if($('#Ord').val().length > 30 || $('#Kommune').val().length > 70 || Epost.length > 150) { alert('Søket er for stort.'); } else {
  if($('#Ord').val() == 'Søk etter') { Sok.push('00000000'); } else { Sok.push($('#Ord').val()); }
  if(Epost == 'Epost adresse') { Sok.push('00000000'); } else { Sok.push(Epost); }
  if($('#Kommune').val() == 'Kommune') { Sok.push('00000000'); } else { Sok.push($('#Kommune').val()); }
  var Sok = encodeURI(Sok);
  $('#SB_Midten2').load('post.php?FinnSpiller=True&Sok='+Sok);
  }}});
  </script>
  <div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"3\"><span style=\"float:left; line-height:30px;\">Finn spiller</span></td></tr><tr><td class=\"R_4\" colspan=\"3\"><img border=\"0\" src=\"../Bilder/FinnSpiller.jpg\"></td></tr>";
  
  echo "
  <tr class=\"Vanlig_2\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"Ord\" value=\"$En\" maxlength=\"29\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <input type=\"text\" id=\"Kommune\" value=\"$Tre\" maxlength=\"69\" onFocus=\"if(this.value=='Kommune')this.value='';\" onblur=\"if(this.value=='')this.value='Kommune';\">
  ";
  
  if($rad_B['type'] == 'A' || $rad_B['type'] == 'm') { echo "
  <input type=\"text\" id=\"Epost\" value=\"$To\" maxlength=\"149\" onFocus=\"if(this.value=='Epost adresse')this.value='';\" onblur=\"if(this.value=='')this.value='Epost adresse';\">
  "; }
  
  echo "<p class=\"Post\">Søk!</p></td></tr>";
    
  echo "</table></div>";

  if($_GET['Sok']) {  
  if($Soker['0'] == '00000000') { $SokEn = ""; } else { $SokEn = "|| brukernavn LIKE '%".$Soker['0']."%'"; }
  if($Soker['1'] == '00000000') { $SokTo = ""; } else { $SokTo = "|| email LIKE '%".$Soker['1']."%'"; }
  if($Soker['2'] == '00000000') { $SokTre = ""; } else { $SokTre = "|| bosted_i_norge LIKE '%".$Soker['2']."%'"; }
  $Soket = "$SokEn $SokTo $SokTre"; $Soket = substr($Soket, 2) . '';
  $Resultat = mysql_query("SELECT * FROM brukere WHERE $Soket LIMIT 70") or die(mysql_error());
  $Tell = '0'; $Res = ''; 
  
  while($i = mysql_fetch_assoc($Resultat)) { 
  $Tell++; 
  $Treff = '';
  if($Soker['0'] != '00000000') { $Treff = $Treff.Finn($i['brukernavn'],$Soker['0']); }
  if($Soker['1'] != '00000000') { $Treff = $Treff.Finn($i['email'],$Soker['1']); }
  if($Soker['2'] != '00000000') { $Treff = $Treff.Finn($i['bosted_i_norge'],$Soker['2']); }
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  $Res = $Res."<tr class=\"$Klasse\"><td class=\"Linje Plassering\">".BrukerURL($i['brukernavn'])."</td><td class=\"Linje Plassering\">$Treff</td></tr>"; 
  }

  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\" colspan=\"2\"><span style=\"float:left; line-height:30px;\">Resultat: $Tell</span></td></tr>";
  echo "<tr style=\"height:20px;\"><td class=\"R_4\">Bruker</td><td class=\"R_4\">Treff</td></tr>$Res";
  echo "</table></div>";
  }}
  ?>