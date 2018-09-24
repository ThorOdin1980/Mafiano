  <?php
  if(basename($_SERVER['PHP_SELF']) == "innboks.inc.php") { header("Location: index.php"); exit; } else {
  
  if(!isset($_GET['SlettAlt'])) { $_GET['SlettAlt'] = ''; }
  if(!isset($_GET['Meld'])) { $_GET['Meld'] = ''; }

  if($_GET['SlettAlt'] == 'True') {

  mysql_query("UPDATE pm_system SET `slettet_ell`='Ja' WHERE `til_bruker`='$brukernavn' AND `fra_game_ell`='Nei' AND `slettet_ell`='Nei' AND `lest_ell`='Ja'");
  }
  elseif($_GET['SlettAlt']) { 
  $Markert = Mysql_Klar($_GET['SlettAlt']);
  $Markert = explode(",",$Markert); 
  $Rader = ""; $it = '0'; foreach ($Markert as $dear) { $dear = Bare_Siffer($dear); $it++; if($it == '1') { $Rader = $Rader."'$dear'"; } else { $Rader = $Rader.",'$dear'"; }} 

  mysql_query("UPDATE pm_system SET `slettet_ell`='Ja' WHERE `til_bruker`='$brukernavn' AND `fra_game_ell`='Nei' AND `slettet_ell`='Nei' AND `lest_ell`='Ja' AND id IN ($Rader)");
  }
  

  $I = mysql_query("SELECT * FROM pm_system WHERE til_bruker='$brukernavn' AND fra_game_ell='Nei' AND slettet_ell='Nei' ORDER BY `timestampen` DESC LIMIT 300");
  $R_Inn = "";
  $Tell = "0";
  if(mysql_num_rows($I) == '0') { $R_Inn = "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Innboksen er tom.</span></td></tr>"; } else {
  while($i = mysql_fetch_assoc($I)) { 
  $Tell++;
  if($Tell % 2 == 0) { $Klasse = "Vanlig_1"; } else { $Klasse = "Vanlig_2"; }
  
  $I_UrlNavn = urlencode($i['fra_bruker']);
  $TekstVis = smil(html_entity_decode($i['melding']));
  $TittelVis = html_entity_decode($i['tittel']);
  $TittelBlir = 're.'.$TittelVis;
  if(strlen($TittelBlir) >= '23') { $TittelBlir = substr($TittelBlir, 0, 23) . '...'; } else { $TittelBlir = $TittelBlir; }
  $TittelBlir = urlencode($TittelBlir);
  $KunstigId2 = Krypt_Tall($i['id'])."EE";
  $Raden = $i['id']."46";
  if($i['lest_ell'] == 'Nei') { $Ny = "<p class=\"Ny\" id=\"$KunstigId2\">( NY )</p>"; $KunstigId = Krypt_Tall($i['id']); } else { $Ny = ''; $KunstigId = 'Lest'; }
  
  $R_Inn = $R_Inn."
  <tr class=\"$Klasse SjekkMeld\" id=\"$KunstigId\"><td class=\"Linje Innboks\" id=\"FF".$i['id']."\">
  <span class=\"Meld\"><p class=\"fra\">".BrukerURL($i['fra_bruker'])."</p><p class=\"dato\">".$i['dato_sendt']."</p></span>
  <span class=\"Melden\">$Ny<p class=\"tittel\">$TittelVis</p><p class=\"merk\" id=\"$Raden\">(Merk)</p><p class=\"svar\" onclick=\"$('#SB_Midten2').load('post.php?du_valgte=Innboks&Meld=True&Til=$I_UrlNavn&Gjelder=$TittelBlir'); $('html, body').animate({scrollTop:100}, 'slow');\">(Svar)</p><br><p class=\"beskjed\">$TekstVis</p></span>
  </td></tr>";

  }}
  
  echo "
  <script> 
  // Slett meldinger
  $('#SlettMeld').click(function() { 
  if($('.Markert').length == 0) { 
  if(confirm('Du har ikke markert hvilke meldinger som skal slettes.\\nSlett alle leste meldinger ?')) { 
  $('#SB_Midten2').load('post.php?du_valgte=Innboks&SlettAlt=True');
  }} else { var valgt = Array(); $('.Markert').each(function() { var id = this.id.slice(2); valgt.push(id); });
  var valgt = encodeURI(valgt);
  $('#SB_Midten2').load('post.php?du_valgte=Innboks&SlettAlt='+valgt);
  }
  
  });
  
  // Merk melding
  $('.merk').click(function() { 
  var id = '#FF' + this.id.slice(0,-2);
  if($(id).hasClass('Markert') == 0) { $(id).addClass('Markert'); } else { $(id).removeClass('Markert'); }
  });
  
  // Opprett melding
  $('#Opprett').click(function() { if($('#SendMeld').length == 0) { $('#SB_Midten2').load('post.php?du_valgte=Innboks&Meld=True'); } else if($('#SendMeld').is(\":hidden\")) { $('#SendMeld').show(); } else { $('#SendMeld').hide(); }});

  // Sjekk melding
  $('.SjekkMeld').hover(function(){var id = this.id; this.timer=window.setTimeout(function(){ 
  if(id != 'Lest') { var rad = '#'+id; ny = '#'+id+'EE'; var vare = encodeURI(id); $(ny).fadeOut(1000); $(rad).attr(\"id\",'Lest');
  $.post('post.php?du_valgte=Innboks&MeldLest='+vare); }},700);}, function(){if(this.timer)window.clearTimeout(this.timer); });

  // Send melding
  function Send() { var Til = encodeURI($('#SendTil').val()); var Gjelder = encodeURI($('#SendGjelder').val()); var Melding = encodeURI($('#SendInnhold').val()); $('#SB_Midten2').load('post.php?du_valgte=Innboks&Meld=True&Til='+Til+'&Gjelder='+Gjelder+'&Melding='+Melding); }
  </script>
  <div class=\"Div_masta\"><table class=\"Rute_1\"><tr><td class=\"R_0\"><span style=\"float:left; line-height:30px;\">Innboks</span><span class=\"Opprett\" id=\"SlettMeld\">( Slett )</span><span class=\"Opprett\" id=\"Opprett\">( Opprett ny melding )</span></td></tr><tr><td class=\"R_4\"><img border=\"0\" src=\"../Bilder/les%20melding.jpg\"></td></tr>
  ";
  
  if($_GET['Meld'] == 'True') {
  // Post melding
  if(isset($_GET['Melding'])) {
  $Tile = Mysql_Klar($_GET['Til']);
  $Gjel = Mysql_Klar($_GET['Gjelder']);
  $Innh = Mysql_Klar($_GET['Melding']);
  $MeldVent = $rad_B['MeldingStamp'] - $Timestamp;
  if($rad_B['MeldingStamp'] > $Timestamp) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du må vente <font id=\"MeldVent\" class=\"TellNed\">$MeldVent</font> sekunder.</span></td></tr>"; } 
  elseif(empty($Tile) || $Tile == 'Brukernavn') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukernavn mangler.</span></td></tr>"; } 
  elseif(empty($Gjel) || $Gjel == 'Hovedskrift') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Hovedskrift mangler.</span></td></tr>"; }
  elseif(empty($Innh)) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Meldingen mangler.</span></td></tr>"; } 
  elseif(strlen($Tile) >= '30') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukernavnet er for langt.</span></td></tr>"; }
  elseif(strlen($Gjel) >= '35') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Hovedskriften er for lang.</span></td></tr>"; }
  elseif(strlen($Innh) >= '5000') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Meldingen er for lang.</span></td></tr>"; } else { 

  $B = mysql_query("SELECT brukere.brukernavn,brukere.liv,kontakter.status FROM brukere LEFT JOIN kontakter ON kontakter.kontaktnavn='$brukernavn' AND kontakter.dittbrukernavn='$Tile' AND kontakter.status='Blodfinde' WHERE brukere.brukernavn='$Tile'");
  $Bi = mysql_fetch_assoc($B);
  if(mysql_num_rows($B) == '0') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren $Tile eksisterer ikke.</span></td></tr>"; }
  elseif($Bi['brukernavn'] == $brukernavn) { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke sende en melding til egen bruker.</span></td></tr>"; }
  elseif($Bi['liv'] < '1') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Brukeren $Tile er død.</span></td></tr>"; }
  elseif($Bi['status'] == 'Blodfinde') { echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">Du kan ikke sende melding til denne spilleren.</span></td></tr>"; } else {
  $Tile = $Bi['brukernavn'];

  if($brukernavn == 'Havers') { $StampVente = $Timestamp; } else { $StampVente = $Timestamp + '20'; }
  mysql_query("UPDATE brukere SET aktiv_eller='$Aktiv',meldinger_sendt=`meldinger_sendt`+'1',MeldingStamp='$StampVente' WHERE brukernavn='$brukernavn'"); 

  mysql_query("INSERT INTO pm_system (fra_bruker,til_bruker,timestampen,dato_sendt,tittel,melding,fra_game_ell) VALUES ('$brukernavn','$Tile','$Timestamp','$FullDato','$Gjel','$Innh','Nei')"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">Meldingen er sendt til ".BrukerURL($Tile).".</span></td></tr>";  
  
  }}}
    
  if(empty($_GET['Til'])) { $Tile_V = 'Brukernavn'; } else { $Tile_V = $_GET['Til']; }
  if(empty($_GET['Gjelder'])) { $Gjel_V = 'Hovedskrift'; } else { $Gjel_V = $_GET['Gjelder']; }
  if(empty($Innh)) { $Innh_V = ''; } else { $Innh_V = $_GET['Melding']; }

  echo "
  <tr class=\"Vanlig_2\" id=\"SendMeld\"><td class=\"Linje Send\" style=\"padding-bottom:9px;\">
  <input type=\"text\" id=\"SendTil\" value=\"$Tile_V\" onFocus=\"if(this.value=='Brukernavn')this.value='';\" onblur=\"if(this.value=='')this.value='Brukernavn';\">
  <input type=\"text\" id=\"SendGjelder\" value=\"$Gjel_V\" onFocus=\"if(this.value=='Hovedskrift')this.value='';\" onblur=\"if(this.value=='')this.value='Hovedskrift';\">
  <textarea id=\"SendInnhold\">$Innh_V</textarea>
  <p class=\"Post\" onclick=\"Send()\">Send melding!</p>
  </td></tr>"; }
  
  echo "$R_Inn</table></div>";
  
  }
  ?>