  <?php
  if(basename($_SERVER['PHP_SELF']) == "Pm.inc.php") { header("Location: index.php"); exit; } else {
  if($rad_B['type'] == 'A') { 
  
  echo "
  <script>
  function SokEtter() { 
  if($('#FraBla').val() == '') { alert('Fra bruker kan ikke stå tomt.'); } 
  else if($('#TilBla').val() == '') { alert('Til bruker kan ikke stå tomt.'); } else { 
  var Fra = encodeURI($('#FraBla').val());
  var Til = encodeURI($('#TilBla').val());
  $('#SB_Midten2').load('post.php?Logger=Pm&Fra='+Fra+'&Til='+Til);
  }}
  </script>
  ";
  
  if($_GET['Fra'] && $_GET['Til']) { 
  $FraBr = Mysql_Klar($_GET['Fra']);
  $TilBr = Mysql_Klar($_GET['Til']);
  if(empty($FraBr) || $FraBr == 'Fra bruker') { $SokFra = "fra_bruker LIKE '%'"; } else { $SokFra = "fra_bruker LIKE '%".$FraBr."%'"; }
  if(empty($TilBr) || $TilBr == 'Til bruker') { $SokTil = "til_bruker LIKE '%'"; } else { $SokTil = "til_bruker LIKE '%".$TilBr."%'"; }
  } else { $SokFra = "fra_bruker LIKE '%'"; $SokTil = "til_bruker LIKE '%'"; }
  

  $I = mysql_query("SELECT * FROM pm_system WHERE $SokFra AND $SokTil AND fra_game_ell='Nei' ORDER BY `timestampen` DESC LIMIT 200");
  $R_Inn = "";
  $Tell = "0";
  if(mysql_num_rows($I) == '0') { $R_Inn = "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Meldings arkivet er tomt.</span></td></tr>"; } else {
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  $I_UrlNavn = urlencode($i['fra_bruker']);
  $TekstVis = smil(html_entity_decode($i['melding']));
  $TittelVis = html_entity_decode($i['tittel']);
  $TittelBlir = 're.'.$TittelVis;
  if(strlen($TittelBlir) >= '23') { $TittelBlir = substr($TittelBlir, 0, 23) . '...'; } else { $TittelBlir = $TittelBlir; }
  $TittelBlir = urlencode($TittelBlir);
  $R_Inn = $R_Inn."
  <tr class=\"$Klasse SjekkMeld\"><td class=\"Linje Innboks\">
  <span class=\"Meld\"><p class=\"fra\">Fra ".BrukerURL($i['fra_bruker'])." Til ".BrukerURL($i['til_bruker'])."</p><p class=\"dato\">".$i['dato_sendt']."</p></span>
  <span class=\"Melden\"><p class=\"tittel\">Tittel: $TittelVis</p><br><p class=\"beskjed\">$TekstVis</p></span>
  </td></tr>";
  }}
  
  echo "<div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Private meldinger</span><span class=\"Opprett\" onclick=\"$('#SB_Midten2').load('post.php?Logger=Alle');\">( Gå tilbake )</span></td></tr>
  <tr class=\"Viktig_0\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"FraBla\" value=\"Fra bruker\" maxlength=\"30\" onFocus=\"if(this.value=='Fra bruker')this.value='';\" onblur=\"if(this.value=='')this.value='Fra bruker';\">
  <input type=\"text\" id=\"TilBla\" value=\"Til bruker\" maxlength=\"30\" onFocus=\"if(this.value=='Til bruker')this.value='';\" onblur=\"if(this.value=='')this.value='Til bruker';\">
  <p class=\"Post\" onclick=\"SokEtter()\">Søk!</p>
  </td></tr>$R_Inn</table></div>";

    
  }}
  ?>